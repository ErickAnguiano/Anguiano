<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{


    

    public function dashboardAction(request $request)
    {

        $em=$this->getDoctrine()->getManager();

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->render('administration/dashboard.html.twig');
        } else if ($this->isGranted('ROLE_TEACHER')) {
            return $this->render('teacher/dashboard.html.twig');
        } else if ($this->isGranted('ROLE_STUDENT')) {
            $list = $em->getRepository('AppBundle:Course')->findAll();
            return $this->render('student/dashboard.html.twig', array(
                'list_courses' => $list
            ));
        } else {
            return $this->redirectToRoute('login');
        }
    }


    public function indexAction(Request $request)
    { 

        $em = $this->getDoctrine()->getManager();
        $list = $em->getRepository('AppBundle:Course')->findAll();

         return $this->render('default/index.html.twig', [
            'list_course' => $list
         ]);
    }

        public function loginAction(Request $request)
    {
        
        $authUtils = $this->get('security.authentication_utils');
        $error = $authUtils->getLastAuthenticationError();
        if ($error) {
            $this->addFlash('error', 'Usuario y/o contraseña incorrectos');
        }
        return $this->render('default/login.html.twig', [
            'error' => $error
        ]);


    }



    public function nameAction($name, Request $request){
        //echo "MI NOMBRE ES...".$name;
        //die();
        return $this->render('default/welcome.html.twig', [
            'nameCTRL' => $name,
            'cadena' => 'Hola mundo',
            'id' => 34
        ]);
    }


    public function sendMailAction(Request $request){
        //Creamos nuestro correo usando... Swift Mail

        $message = \Swift_Message::newInstance()
        ->setSubject('ASUNTO')
        ->setFrom('elcorreoqueocuparemosparaenviar')
        ->setTo('elcorreoquevamosaenviar')
        ->setBody($this->renderView('email:example.html.twig',array()), 'text/html');

        $this->get('mailer')->send($message);

        return $this->redirectToRoute('app_dashboard');

    }

}
