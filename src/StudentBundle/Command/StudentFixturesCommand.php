<?php

namespace StudentBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
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
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
    
        $student = new Student();
        $student->setFirstname("Gabriel");
        $student->setLastname("Pillet");
        
        // met dans une file d'attente
        $em->persist($student);
        
        // insère les objets persistés dans la base de donnée
        $em->flush();
        
        // à partir d'ici $student->getId() me renvoit le bon $id qui vient d'être sauvegardé
        
        $team = new Team();
        $team->setName('Notation des projets des élèves');
        $team->setGithubRepository('https://github.com/tentacode/students-review');
        $team->setStudentIds([1]);
        
        $em->persist($team);
        $em->flush();
        
        $output->writeln('<info>OK</info>');
    }

}
