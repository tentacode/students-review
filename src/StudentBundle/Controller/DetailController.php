<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StudentBundle\Repository\StudentRepository;

class DetailController extends Controller
{
    /**
     * @Route("/student/{studentId}", name="student_detail")
     */
    public function detailAction($studentId)
    {
        $studentRepository = new StudentRepository();
        $student = $studentRepository->findById($studentId);
        
        return $this->render('StudentBundle:Student:detail.html.twig', [
            'student' => $student,
        ]);
    }
}
