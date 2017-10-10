<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class LoginController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        
        return $this->render('UserBundle:Security:login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}
