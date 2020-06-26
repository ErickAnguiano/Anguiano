<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use AppBundle\Form\CourseType;

class CourseController extends Controller 
{

	public function courseAction(Request $request)
	{
	

		$em = $this->getDoctrine()->getManager();
		$obj_course = new \AppBundle\Entity\Course();
		$form = $this->createForm(\AppBundle\Form\CourseType::class, $obj_course);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()){
			$user = $em->getRepository('AppBundle:User')->find($this->getUser());
			$obj_course->setOwner($user);
			$obj_course->setRegistered(new \DateTime());

			$path = $this->getParameter('upload_directory');
			$fileImage = $form->get('image')->getData();
			
				if ($fileImage) {

						$newNameFile = uniqid().'.'.$fileImage->guessExtension();
							try {
							$fileImage->move($path , $newNameFile);
							} catch (FileException $e) {
						}

						$obj_course->setImage($newNameFile);
						$em->persist($obj_course);
						$em->flush($obj_course);

					$this->addFlash('success', 'Se ha registrado correctamente');
				}

			return $this->redirectToRoute('app_teacher_course');
		}

		$list = $em->getRepository('AppBundle:Course')->findBy(['owner'=> $this->getUser()]);

		return $this->render('teacher/course.html.twig', [
			'formCourse' => $form->createView(),
			'list_courses' => $list
		]);

	}

	public function deleteAction(Request $request, $id){
			$em = $this->getDoctrine()->getManager();
			$course = $em->getRepository('AppBundle:Course')->findOneBy(
			['id'=>$id, 'owner'=>$this->getUser()]
			);

			if ($course) {
				$em->remove($course);
				$em->flush();
				$this->addFlash('success','Se ha eliminado correctamente');
			}else{

				$this->addFlash('warning', 'El curso no existe');

			}

			return $this->redirectToRoute('app_teacher_course');
	}

	public function editAction(Request $request, $id){
		$em = $this->getDoctrine()->getManager();

		$course = $em->getRepository('AppBundle:Course')->find($id);
		$img_temp = $course->getImage();
		$course->setImage(null);

		$form = $this->createForm(CourseType::class, $course);

		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()){

			$path = $this->getParameter('upload_directory');
			$fileImage = $form->get('image')->getData();
			
				if ($fileImage) {

						$newNameFile = uniqid().'.'.$fileImage->guessExtension();
							try {
							$fileImage->move($path , $newNameFile);
							} catch (FileException $e) {
							$course->setImage($img_temp);
						}

						$course->setImage($newNameFile);
						$em->persist($course);
						$em->flush($course);

					$this->addFlash('success', 'Se ha actualizado correctamente');
				} else {

						$course->setImage($img_temp);
						$em->persist($course);
						$em->flush($course);

					$this->addFlash('success', 'Se ha actualizado correctamente');

				}

			return $this->redirectToRoute('app_teacher_course');
		}

		$list = $em->getRepository('AppBundle:Course')->findBy(['owner'=> $this->getUser()]);

		$course->setImage($img_temp);

		return $this->render('teacher/course.html.twig', [
			'formCourse' => $form->createView(),
			'list_courses' => $list
		]);
	}


	public function detailsAction(Request $request, $id){
		$em = $this->getDoctrine()->getManager();
		$course = $em->getRepository('AppBundle:Course')->find($id);

		return $this->render('teacher/details_course.html.twig',[
			'course' => $course
		]);

	}

}

		//if ($form->isSubmitted() && $form->isValid()){
		//	$em->persist($obj_lang);
		//	$em->flush();
		//	$this->addFlash('success', 'Se ha registrado correctamente');
		//	return $this->redirectToRoute('app_admin_lang');
		//}

	
