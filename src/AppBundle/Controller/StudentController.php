<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class StudentController extends Controller
{
	
	public function myCoursesAction(Request $request){

		$studentID = $this->getUser()->getId();
		$em = $this->getDoctrine()->getManager();

		$list_mycourses = $em->getRepository('AppBundle:CourseSaleDetails')->findBy(
			[
				'student'=> $studentID
			
			]);

		return $this->render('student/mycourses.html.twig',[
			'list_mycourses' => $list_mycourses
		]);
	}

	
}