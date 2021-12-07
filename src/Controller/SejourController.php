<?php

namespace App\Controller;

use App\Entity\Sejour;
use App\Entity\Chambre;
use App\Entity\Patient;
use App\Form\SejourType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SejourController extends AbstractController
{
    /**
     * @Route("/sejour", name="sejour")
     */
    public function index(): Response
    {
        return $this->render('sejour/index.html.twig', [
            'controller_name' => 'SejourController',
        ]);
    }
	/**
     * @Route("/sejour-ajout", name="sejour_ajout")
     */
	public function ajoutsejour(Request $request){

		$user = $this->getUser();

		$sejour=new Sejour();
		$form=$this->createForm(SejourType::class,$sejour);
		$form->handleRequest($request);
		if($form->isSubmitted()&&$form->isValid()){
			$sejour=$form->getData();
			$em=$this->getDoctrine()->getManager();
			$em->persist($sejour);
			$em->flush();
			//redirection vers l'accueil des sejours
			return $this->redirectToRoute('sejour_liste');
		}
		return $this->render('sejour/ajoutsejour.html.twig',array('form'=>$form->createView(),
			'user'=>$user,
		));
	}
	/**
     * @Route("/modifsejour/{id}", name="modifsejour")
     */
	public function modiformulaire($id,Request $request): Response
    {
		$user = $this->getUser();
		$repository=$this->getDoctrine()->getRepository(Sejour::class);
		$sejour=$repository->find($id);
		$form=$this->createFormBuilder($sejour)
					->add('dateArrivee', DateType::class,['widget' => 'single_text','input'  => 'datetime', 'label'  =>'Date d\'Arrivee : '])
					->add('dateDepart', DateType::class,['widget' => 'single_text','input'  => 'datetime', 'label'  =>'Date de Depart : '])
					->add('Commentaire', TextType::class, array('label'=>'Commentaire optionnel : '))
					->add('numChambre',EntityType::class, array('class'=>Chambre::class, 'choice_label'=>'id', 'placeholder'=>'Choisir une Chambre'))
					->add('numPatient',EntityType::class, array('class'=>Patient::class, 'choice_label'=>'id', 'placeholder'=>'Choisir un Patient'))
					->add('save',SubmitType::class, array('label'=>'Modifier le Sejour'))
					->getForm();
					
		$form->handleRequest($request);
		if($form->isSubmitted() && $form->isValid()){
			$sejour= $form->getData();
			$em=$this->getDoctrine()->getManager();
			$em->persist($sejour);
			$em->flush();
		
			return $this->redirectToRoute('sejour_liste');
		}
		return $this->render('sejour/modifsejour.html.twig',array(
				'form'=>$form->createView(),
				'user'=>$user,
			));
	
	
	}
}
