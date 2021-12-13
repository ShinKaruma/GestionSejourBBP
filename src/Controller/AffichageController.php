<?php

namespace App\Controller;
use App\Entity\Patient;
use App\Entity\Sejour;

use App\Form\SejourType;
use App\Form\SejourPreType;
use App\Form\SejourPatientType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/sejour-liste", name="sejour_liste")
     */
    public function affichageDebutSejour(): Response
    {
        $user = $this->getUser();
        $repository=$this->getDoctrine()->getRepository(Sejour::class);
        $lesSejours=$repository->findAll();
        return $this->render('affichage/affichagesejour.html.twig', [
            'controller_name' => 'Les séjours qui débute ce jour',
            'sejours'=>$lesSejours,
            'user'=>$user,
        ]);
    }

    /**
     * @Route("/sejour-liste-avenir", name="sejour_liste_avenir")
     */
    public function affichageSejourAVenir(): Response
    {
        $user = $this->getUser();
        $repository=$this->getDoctrine()->getRepository(Sejour::class);
        $lesSejours=$repository->findAll();
        return $this->render('affichage/affichagesejouravenir.html.twig', [
            'controller_name' => 'Les séjours à venir',
            'sejours'=>$lesSejours,
            'user'=>$user,
        ]);
    }

    /**
     * @Route("/sejour-liste-encour", name="sejour_listecour")
     */
    public function affichageSejourEnCour(): Response
    {
        $user = $this->getUser();
        $repository=$this->getDoctrine()->getRepository(Sejour::class);
        $lesSejours=$repository->findAll();

        return $this->render('affichage/affichagesejourencour.html.twig', [
            'controller_name' => 'Les séjours en cours',
            'sejours'=>$lesSejours,
            'user'=>$user,
        ]);
    }   

    /**
     * @Route("/sejour-liste-dateprecise", name="sejour_liste_dateprecise")
     */
    public function affichageSejourDatePreciseForm(Request $request): Response
    {
        $user = $this->getUser();
        $repository=$this->getDoctrine()->getRepository(Sejour::class);

        $form=$this->createForm(SejourPreType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){

            $date=$form['dateArrivee']->getData();
            
            $lesSejours=$repository->findByDateArrivee($date);

            
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            //redirection vers l'accueil des sejours
            return $this->render('affichage/affichagesdatejour.html.twig', ['controller_name'=>'Séjours à une date précise', 'user'=>$user, 'sejours'=>$lesSejours]);
        }

        return $this->render('affichage/affichageSejourDatePreciseForm.html.twig',array('form'=>$form->createView(),
            'user'=>$user,
        ));
    }

    /**
     * @Route("/sejour-liste-patient", name="sejour_liste_patient")
     */
    public function affichageSejourPatientForm(Request $request): Response
    {
        $user = $this->getUser();
        $repository=$this->getDoctrine()->getRepository(Sejour::class);
        $form=$this->createForm(SejourPatientType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){

            $numPatient=$form['numPatient']->getData();
            
            $lesSejours=$repository->findByNumPatient($numPatient);

            
            $em=$this->getDoctrine()->getManager();
            $em->flush();
            //redirection vers l'accueil des sejours
            return $this->render('affichage/affichagesdatejour.html.twig', ['controller_name'=>'Séjours à un patient précis', 'user'=>$user, 'sejours'=>$lesSejours]);
        }
        
        return $this->render('affichage/affichagesejourpatientform.html.twig',array('form'=>$form->createView(),
            'user'=>$user,
        ));
    }

    /**
     * @Route("/sejour-liste-details/{id}", name="sejour_liste_details")
     */
    public function affichageSejourDetails($id): Response
    {
        $user = $this->getUser();
        $repository=$this->getDoctrine()->getRepository(Sejour::class);
        $lesSejours=$repository->findById($id);
        return $this->render('affichage/affichagesdetails.html.twig', [
            'controller_name' => 'Détails du séjour',
            'sejours'=>$lesSejours,
            'user'=>$user,
        ]);
    }

    /**
     * @Route("/patient-liste", name="patient_liste")
     */
    public function affichagePatient(): Response
    {$user = $this->getUser();

        $repository=$this->getDoctrine()->getRepository(Patient::class);
        $lesPatients=$repository->findAll();
        return $this->render('affichage/listepatients.html.twig', [
            'patients'=>$lesPatients,
            'user'=>$user,
        ]);
    }
}
