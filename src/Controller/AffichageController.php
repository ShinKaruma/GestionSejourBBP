<?php

namespace App\Controller;
use App\Entity\Patient;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AffichageController extends AbstractController
{
    /**
     * @Route("/affichage", name="affichage")
     */
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('affichage/index.html.twig', [
            'controller_name' => 'AffichageController',
            'user'=>$user,
        ]);
    }

    /**
     * @Route("/patient-liste", name="patient_liste")
     */
    public function lstPatient(): Response
    {$user = $this->getUser();

        $repository=$this->getDoctrine()->getRepository(Patient::class);
        $lesPatients=$repository->findAll();
        return $this->render('affichage/listepatients.html.twig', [
            'patients'=>$lesPatients,
            'user'=>$user,
        ]);
    }
}
