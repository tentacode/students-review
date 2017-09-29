<?php

namespace StudentBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use StudentBundle\Entity\Student;

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
        $student = new Student();
        $student->setFirstname("Gabriel");
        $student->setLastname("Pillet");
        
        // $em = $this->getDoctrine()->getManager();
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        
        // met dans une file d'attente
        $em->persist($student);
        
        // insère les objets persistés dans la base de donnée
        $em->flush();
        
        $output->writeln('<info>OK</info>');
    }

}
