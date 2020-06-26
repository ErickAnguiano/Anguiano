<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Lang;

class LangController extends Controller {
	public function langAction(Request $request){
	

		$em = $this->getDoctrine()->getManager();

		$obj_lang = new lang;

		$form = $this->createForm(\AppBundle\Form\LangType::class, $obj_lang);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()){
			$em->persist($obj_lang);
			$em->flush();
			$this->addFlash('success', 'Se ha registrado correctamente');
			return $this->redirectToRoute('app_admin_lang');
		}

		return $this->render('administration/lang.html.twig', array(
			'formLang' => $form->createView()
		));

	}

}