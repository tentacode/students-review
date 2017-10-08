<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StudentBundle\Repository\TeamRepository;
use StudentBundle\Entity\Team;
use StudentBundle\Entity\Student;

class StudentListController extends Controller
{
    /**
     * @Route("/etudiants", name="student_list")
     */
    public function listAction()
    {    
        $studentRepository = $this->getDoctrine()->getRepository(Student::class);
        $students = $studentRepository->findAll();
        
        return $this->render('StudentBundle:Student:list.html.twig', [
            'students' => $students,
        ]);
    }
}
