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

}
