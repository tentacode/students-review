<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StudentBundle\Repository\TeamRepository;
use StudentBundle\Entity\Team;
use StudentBundle\Entity\Student;

class TeamDetailController extends Controller
{
    /**
     * @Route("/projet/{teamId}", name="team_detail")
     */
    public function detailAction(int $teamId)
    {
        $teamRepository = $this->getDoctrine()->getRepository(Team::class);
        $team = $teamRepository->find($teamId);
        
        $studentRepository = $this->getDoctrine()->getRepository(Student::class);
        $students = $studentRepository->findAll();
        
        return $this->render('StudentBundle:Team:detail.html.twig', [
            'team' => $team,
            'students' => $students,
        ]);
    }
}
