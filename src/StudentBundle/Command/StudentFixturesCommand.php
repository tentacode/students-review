<?php

namespace StudentBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use StudentBundle\Entity\Student;
use StudentBundle\Entity\Team;
use UserBundle\Entity\User;
use ReviewBundle\Entity\Review;

class StudentFixturesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('student:fixtures')
            ->setDescription('Chargement du jeu d\'essai')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {    
        $finder = new Finder;
        $finder->files()->in(sprintf('%s/../Resources/teams', __DIR__));
        
        foreach ($finder as $file) {
            $filePath = $file->getRealPath();
            $team = json_decode(file_get_contents($filePath), true);
            
            $output->write(sprintf('Import de la team %s… ', $team['name']));
            $this->importTeam($team);
            
            $output->writeln('<info>OK !</info>');
        }
        
        $this->importUsers($output);
        $this->importReviews($output);
    }
    
    private function importTeam(array $teamData)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        $team = new Team();
        $team->setName($teamData['name']);
        $team->setGithubRepository($teamData['githubRepository']);
        
        $students = [];
        foreach ($teamData['students'] as $studentData) {
            $student = new Student();
            $student->setFirstname($studentData['firstname']);
            $student->setLastname($studentData['lastname']);
            $student->setTeam($team);
            
            $em->persist($student);
            
            $students[] = $student;
        }
        
        $em->persist($team);
        $em->flush();
    }
    
    private function importUsers($output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $user = new User();
        $user->setEmail('contact@gabrielpillet.com');
        $user->setPassword('gabriel');
        $user->setRoles(['ROLE_ADMIN']);
        $em->persist($user);

        $user = new User();
        $user->setEmail('charles.terrasse@gmail.com');
        $user->setPassword('charles');
        $user->setRoles(['ROLE_USER']);
        $em->persist($user);

        $em->flush();
        $output->writeln('<info>Import users OK !</info>');
    }
    
    private function importReviews($output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $doctrine = $this->getContainer()->get('doctrine');
        $users = $doctrine->getRepository(User::class)->findAll();
        $teams = $doctrine->getRepository(Team::class)->findAll();
        
        foreach ($users as $user) {
            foreach ($teams as $team) {
                $review = new Review();
                $review->setUser($user);
                $review->setTeam($team);
                $review->setRating(mt_rand(0, 5));
                $review->setComment('Foobar');
                
                $em->persist($review);
            }
        }
        
        $em->flush();
        $output->writeln('<info>Import reviews OK !</info>');
    }
}
