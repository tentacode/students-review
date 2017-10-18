<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StudentBundle\Repository\TeamRepository;
use StudentBundle\Entity\Team;
use StudentBundle\Entity\Student;
use StudentBundle\Statistics\GithubService;
use ReviewBundle\Entity\Review;
use ReviewBundle\Form\ReviewType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TeamDetailController extends Controller
{
    /**
     * @Route("/projet/{teamId}", name="team_detail")
     */
    public function detailAction(int $teamId, Request $request)
    {
        $teamRepository = $this->getDoctrine()->getRepository(Team::class);
        $team = $teamRepository->find($teamId);
        
        $user = $this->getUser();
        if ($user) {
            $reviewForm = $this->createForm(ReviewType::class, new Review());
            
            $reviewForm->handleRequest($request);

            if ($reviewForm->isSubmitted() && $reviewForm->isValid()) {
                $review = $reviewForm->getData();
                
                $review->setUser($this->getUser());
                $review->setTeam($team);

                $em = $this->getDoctrine()->getManager();
                $em->persist($review);
                $em->flush();
                
                $this->addFlash(
                    'notice',
                    'Votre avis a bien été pris en compte. 👌'
                );

                return $this->redirectToRoute('team_detail', [
                    'teamId' => $teamId,
                ]);
            }
        }
        
        $githubService = $this->container->get('student.statistics.github');
        
        return $this->render('StudentBundle:Team:detail.html.twig', [
            'team' => $team,
            'review_form' => $user ? $reviewForm->createView() : null,
            'github_stats' => $githubService->getStats($teamId),
            'random_commits' => $githubService->getRandomCommits($teamId),
        ]);
    }
}
