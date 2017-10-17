<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RegisterController extends Controller
{
    /**
     * @Route("/inscription", name="user_register")
     */
    public function registerAction(Request $request)
    {
        $registerForm = $this->createFormBuilder(new User())
            ->add('nickname', TextType::class, ['label' => 'Votre pseudo'])
            ->add('email', EmailType::class, ['label' => 'Votre e-mail'])
            ->add('password', PasswordType::class, ['label' => 'Votre mot de passe'])
            ->add('save', SubmitType::class, array('label' => "Créer un compte"))
            ->getForm()
        ;
        
        $registerForm->handleRequest($request);
        if ($registerForm->isSubmitted() && $registerForm->isValid()) {
            $user = $registerForm->getData();
            $user->setRoles(['ROLE_USER']);
            
            $plainPassword = $user->getPassword();
            $passwordEncoder = $this->get('security.password_encoder');
            $user->setPassword($passwordEncoder->encodePassword($user, $plainPassword));
            
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($user);
            $em->flush();
            
            $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
            $this->get('security.token_storage')->setToken($token);
            $this->get('session')->set('_security_main', serialize($token));
            
            $this->sendWelcomeEmail($user);

            $this->addFlash(
                'notice',
                'Bravo vous êtes inscrit ! 👏'
            );
            
            return $this->redirectToRoute('team_list');
        }
        
        return $this->render('UserBundle:Register:register.html.twig',  [
            'register_form' => $registerForm->createView(),
        ]);
    }
    
    private function sendWelcomeEmail($user)
    {
        $message = (new \Swift_Message('Bienvenue sur Students Rating'))
            ->setFrom('contact@gabrielpillet.com')
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView('UserBundle:Email:welcome.html.twig',
                    array('user' => $user)
                ),
                'text/html'
            )
        ;
        
        $mailer = $this->container->get('mailer');
        $mailer->send($message);
    }
}
