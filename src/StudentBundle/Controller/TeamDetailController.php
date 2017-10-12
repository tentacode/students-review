<?php

namespace StudentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use StudentBundle\Repository\TeamRepository;
use StudentBundle\Entity\Team;
use StudentBundle\Entity\Student;
use ReviewBundle\Entity\Review;
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
            $reviewForm = $this->getReviewForm();
            
            $reviewForm->handleRequest($request);

            if ($reviewForm->isSubmitted() && $reviewForm->isValid()) {
                $review = $reviewForm->getData();
                
                $review->setUser($this->getUser());
                $review->setTeam($team);

                $em = $this->getDoctrine()->getManager();
                $em->persist($review);
                $em->flush();

                return $this->redirectToRoute('team_detail', [
                    'teamId' => $teamId,
                ]);
            }
        }
        
        return $this->render('StudentBundle:Team:detail.html.twig', [
            'team' => $team,
            'review_form' => $user ? $reviewForm->createView() : null,
        ]);
    }
    
    private function getReviewForm()
    {
        $review = new Review();

        $form = $this->createFormBuilder($review)
            ->add('rating', IntegerType::class, ['label' => "Note sur 5"])
            ->add('comment', TextareaType::class, [
                'label' => "Commentaire",
                'required' => false,
            ])
            ->add('save', SubmitType::class, array('label' => "Noter l'équipe"))
            ->getForm()
        ;
        
        return $form;
    }
}
