<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StudentBundle\Repository\TeamRepository;

class ListTeamController extends Controller
{
    /**
     * @Route("/", name="team_list")
     */
    public function listAction()
    {
        $teamRepository = new TeamRepository();
        $teams = $teamRepository->findAllTeams();
        
        return $this->render('StudentBundle:Team:list.html.twig', [
            'teams' => $teams,
        ]);
    }
}
