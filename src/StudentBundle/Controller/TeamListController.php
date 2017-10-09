<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StudentBundle\Repository\TeamRepository;
use StudentBundle\Entity\Team;
use StudentBundle\Entity\Student;

class TeamListController extends Controller
{
    /**
     * @Route("/", name="team_list")
     */
    public function listAction()
    {
        $teamRepository = $this->getDoctrine()->getRepository(Team::class);
        $teams = $teamRepository->findAll();
        
        return $this->render('StudentBundle:Team:list.html.twig', [
            'teams' => $teams,
        ]);
    }
}
