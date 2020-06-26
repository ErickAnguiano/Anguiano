<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Category;

class CategoryController extends Controller {
	public function categoryAction(Request $request){
		

		$em = $this->getDoctrine()->getManager();

		$obj_category = new Category;

		$form = $this->createForm(\AppBundle\Form\CategoryType::class, $obj_category);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()){
			$em->persist($obj_category);
			$em->flush();
			$this->addFlash('success', 'Se ha registrado correctamente');
			return $this->redirectToRoute('app_admin_category');
		}

		return $this->render('administration/category.html.twig', array(
			'formCategory' => $form->createView()
		));

	}
	
}