<?php

namespace App\Controller;

use App\Entity\Sejour;
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
}
