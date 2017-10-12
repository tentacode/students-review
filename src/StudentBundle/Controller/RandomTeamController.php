<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StudentBundle\Repository\TeamRepository;
use StudentBundle\Entity\Team;
use StudentBundle\Entity\Student;

class RandomTeamController extends Controller
{
    /**
     * @Route("/equipe_aleatoire", name="random_team")
     */
    public function randomAction()
    {
        $teamRepository = $this->getDoctrine()->getRepository(Team::class);
        $teams = $teamRepository->findAll();
        $team = $teams[mt_rand(0, 133700) % count($teams)];

        return $this->redirectToRoute('team_detail', [
            'teamId' => $team->getId(),
        ]);
    }
}
