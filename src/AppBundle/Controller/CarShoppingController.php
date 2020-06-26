<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\CourseSale;
use AppBundle\Entity\CourseSaleDetails;

class CarShoppingController extends Controller
{

	public function addCarAction(Request $request, $code)
	{
	//CODIGO PARA AGREGAR EL ITEM AL CARRITO DE COMPRAS
		$session = $request->getSession();
	//IF Operador ternario (condicion) ? valor si es verdadero, falso
	//Si existe la variable carshopping en la sesión:: la recupera y sino que cree un array

	//IF NOT_NULL carshopping
		$carrito = $session->get('carshopping') ? $session->get('carshopping') : array();
		
		$em = $this->getDoctrine()->getManager();
		$course_buy = $em->getRepository('AppBundle:CourseSaleDetails')->findBy(
			[

				'student'=> $this->getUser()->getId(),
				'course' => $code
			]
		);

		if($course_buy){
			$this->addFlash('warning','El curso ya ha sido comprado');
		} else {

			$course_exist = array_search($code, $carrito);
			if (is_numeric($course_exist)) {
			$this->addFlash('warning','Ya esta el curso en el carrito!');
			} else {
				$carrito[] = $code;
				$this->addFlash('success','Se agrego correctamente');
			}

			$session->set('carshopping', $carrito);
			$session->save();
		}

		return $this->redirectToRoute('app_dashboard');
	}

	public function showCarAction(Request $request) {
		$session = $request->getSession();
		$carrito = $session->get('carshopping') ? $session->get('carshopping') : array();
		$em = $this->getDoctrine()->getManager();

		$carshopping = $em->getRepository('AppBundle:Course')->findBy(['id'=>$carrito]);

		return $this->render('student/carshopping.html.twig', array(
			'list_carshopping' => $carshopping
		));

	}

	public function deleteCarAction(Request $request, $code) {

		$session = $request->getSession();
		$carrito = $session->get('carshopping') ? $session->get('carshopping') : array();
		$course_exist = array_search($code, $carrito);
		if (is_numeric($course_exist)) {
			unset($carrito[$course_exist]);
			$carrito_new = array_values($carrito);
			$session->set('carshopping', $carrito_new);
			$session->save();
			$this->addFlash('success', 'Se elimino un curso del carrito de compras');
		}else{
			$this->addFlash('error', 'No se encontro curso del carrito de compras');
		}

		return $this->redirectToRoute('app_student_carshopping');

	}

	public function paymentDemoAction(Request $request){
		$session = $request->getSession();
		$carrito = $session->get('carshopping') ? $session->get('carshopping') : array();

		$em = $this->getDoctrine()->getManager();

		$obj_sale = new CourseSale();
		$user = $em->getRepository('AppBundle:User')->find($this->getUser()->getId());
		$obj_sale->setStudent($user);
		$obj_sale->setAuthorization("OK!");
		$obj_sale->setRegistered(new \DateTime());

		$em->persist($obj_sale);
		$em->flush();

		$lista = $em->getRepository('AppBundle:Course')->findBy(['id'=>$carrito]);
		foreach ($lista as $course) {
			$obj_sale_detail = new CourseSaleDetails();
			$obj_sale_detail->setSale($obj_sale);
			$obj_sale_detail->setCourse($course);
			$obj_sale_detail->setStudent($user);
			$obj_sale_detail->setPrice($course->getPrice());
			$obj_sale_detail->setRegistered(new \DateTime());

			$em->persist($obj_sale_detail);
			$em->flush();
		}

		$session->remove('carshopping');
		$session->save();

		return $this->redirectToRoute('app_dashboard');

	}	

}