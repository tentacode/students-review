<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StudentBundle\Repository\StudentRepository;
use StudentBundle\Entity\Student;

class StudentDetailController extends Controller
{
    /**
     * @Route("/student/{studentId}", name="student_detail")
     */
    public function detailAction($studentId)
    {
        // $studentRepository = new StudentRepository();
        $studentRepository = $this->getDoctrine()->getRepository(Student::class);
        $student = $studentRepository->find($studentId);
        // var_du
        
        return $this->render('StudentBundle:Student:detail.html.twig', [
            'student' => $student,
        ]);
    }
}
