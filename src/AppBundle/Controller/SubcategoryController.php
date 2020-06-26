<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Subcategory;

class SubcategoryController extends Controller {
	public function subcategoryAction(Request $request){
		

		$em = $this->getDoctrine()->getManager();

		$obj_subcategory = new Subcategory;

		$form = $this->createForm(\AppBundle\Form\SubcategoryType::class, $obj_subcategory);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()){
			$em->persist($obj_subcategory);
			$em->flush();
			$this->addFlash('success', 'Se ha registrado correctamente');
			return $this->redirectToRoute('app_admin_subcategory');
		}

		//FIND Doctrine
		$repo = $em->getRepository('AppBundle:Subcategory');

		//FINDALL : Traer todos los elementos de una Tabla
		$list_subcategories = $repo->findAll();

		//find(id)... buscar por id
		//fndBy(['name' => 'Desarrollo web']) busca todos donde el nombre
		//fndOneBy(['name' => 'Desarrollo web']) busca donde pero solo trae uno

		return $this->render('administration/subcategory.html.twig', array(
			'formSubcategory' => $form->createView(),
			'lista' => $list_subcategories
		));
	}

	public function subcategoryDeleteAction($id){

		$em = $this->getDoctrine()->getManager();
		$repo = $em->getRepository('AppBundle:Subcategory');
		$obj = $repo->find($id);

		if($obj){
			$em->remove($obj);
			$em->flush();
			$this->addFlash('success', "Se ha eliminado correctamente");
		}

		return $this->redirectToRoute('app_admin_subcategory');

	}
	
}