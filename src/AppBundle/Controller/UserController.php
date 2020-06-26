<?php

namespace AppBundle\Controller;

//IMPORTACIÓN DE LA CLASE CONTROLLER DE SYMFONY
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Spipu\Html2Pdf\Html2Pdf;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller{
	//Metodos.... ACCIONES "Action"
	public function createUserAction(Request $request){
		
		//Crear el objeto doctrine
		$em = $this->getDoctrine()->getManager();
		//Crear un objeto de la Entidad "AppBundle:User"
		$obj_user = new User;

		$form = $this->createForm(\AppBundle\Form\UserType::class, $obj_user);

		$form->handleRequest($request); //Recupera lo que el usuario escriba en los input

		if ($form->isSubmitted() && $form->isValid()){
			//$obj_user->setRole("ROLE_USER");
			$obj_user->setStatus(1);

			//para traer la info del Encoder en el archivo Security.yml
			$factory = $this->get('security.encoder_factory');
			$encoder = $factory->getEncoder($obj_user);
			$password_encrypt = $encoder->encodePassword($obj_user->getPassword(), $obj_user->getSalt());
			$obj_user->setPassword($password_encrypt);

			$em->persist($obj_user);
			$em->flush();
			$this->addFlash('success', 'Se ha registrado correctamente');
			return $this->redirectToRoute('app_user_create');
		}

		return $this->render('default/register.html.twig', array(
			'formUser' => $form->createView()
		));
	}

	public function listUserAction(Request $request){

		$em = $this->getDoctrine()->getManager();

		$list = $em->getRepository('AppBundle:User')->findBy(['role'=>['ROLE_STUDENT','ROLE_TEACHER']]);

		return $this->render('administration/user.html.twig', array(
			'list' => $list
		));

	}

	public function reportUserAction(Request $request){
		$em = $this->getDoctrine()->getManager();
		$list = $em->getRepository('AppBundle:User')->findBy(['role'=>['ROLE_TEACHER','ROLE_STUDENT']]);

		$viewHTMLReport = $this->renderView('report/report_users.html.twig', array (
				'list' => $list
		));

		$html2pdf = new Html2Pdf('P', 'LETTER', 'es', 'true', 'UTF-8', array('10','10','10','10'));
		$html2pdf->pdf->setDisplayMode('real');
		$html2pdf->setDefaultFont('helvetica');
		$html2pdf->writeHTML($viewHTMLReport);

		$nameFile = "Usuarios.pdf";
		return new Response($html2pdf->Output(utf8_encode($nameFile),'D'), 200, array('Content-Type'=> 'application/pdf;charset=UTF-8')
		);
	}

}
