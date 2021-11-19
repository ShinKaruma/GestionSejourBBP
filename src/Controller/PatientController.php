<?php

namespace App\Controller;
use App\Entity\Patient;
use App\Form\PatientType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
    /**
     * @Route("/patient", name="patient")
     */
    public function index(): Response
    {
		$repository=$this->getDoctrine()->getRepository(Patient::class);
		$lesPatients=$repository->findAll();
        return $this->render('patient/index.html.twig', [
            'controller_name' => 'PatientController',
			'patients'=>$lesPatients,
        ]);
    }
	/**
     * @Route("/ajoutpatient", name="ajout_patient")
     */
	public function ajoutpatient(Request $request){
		$patient=new Patient();
		$form=$this->createForm(PatientType::class,$patient);
		$form->handleRequest($request);
		if($form->isSubmitted()&&$form->isValid()){
			$patient=$form->getData();
			$em=$this->getDoctrine()->getManager();
			$em->persist($patient);
			$em->flush();
			//redirection vers l'accueil des patients
			return $this->redirectToRoute('patient');
		}
		return $this->render('patient/ajoutpatient.html.twig',array('form'=>$form->createView(),
		));
	}
	
	
	
}
