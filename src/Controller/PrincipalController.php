<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrincipalController extends AbstractController
{
    /**
     * @Route("/", name="principal")
     */
    public function index(): Response
    {
        $user = $this->getUser();
        return $this->render('principal/index.html.twig', [
            'controller_name' => 'PrincipalController',
            'user'=>$user,
        ]);
    }
}
