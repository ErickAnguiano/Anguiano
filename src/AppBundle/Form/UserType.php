<?php 

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//IMPORTACIONES DE TIPO DE INSERT O BOTONES EN HTML
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


//SIEMPRE DEBEN ESTAR EN NUESTROS FORMULARIOS

class UserType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder->add('name', TextType::class, array(
			'label' => 'Nombre(s)',
			'attr' => array(
				'autocomplete' => 'off',
				'placeholder' => 'Ingrese su nombre...',
				'class' => 'form-control'
			) 
		))

				->add('lastname', TextType::class, array(
			'label' => 'Primer Apellido',
			'attr' => array(
				'placeholder' => 'Ingrese su Apellido Paterno...',
				'class' => 'form-control'
			) 
		))

				->add('secondSurname', TextType::class, array(
			'label' => 'Segundo Apellido',
			'attr' => array(
				'placeholder' => 'Ingrese su Apellido Materno...',
				'class' => 'form-control'
			) 
		))

				->add('email', EmailType::class, array(
			'label' => 'Email',
			'attr' => array(
				'placeholder' => 'Ingrese su correo electrónico',
				'class' => 'form-control'
			) 
		))

				->add('password', PasswordType::class, array(
			'label' => 'Contraseña',
			'attr' => array(
				'placeholder' => 'Ingrese su contraseña...',
				'class' => 'form-control'
			) 
		))

				->add('password', PasswordType::class, array(
			'label' => 'Contraseña',
			'attr' => array(
				'placeholder' => 'Ingrese su contraseña...',
				'class' => 'form-control'
			) 
		))


				->add('role', ChoiceType::class, array(
					'label' => 'Rol',
					'attr' => array(
						'class' => 'form-control'
			),
					'choices' => array(
						'Estudiante' => 'ROLE_STUDENT',
						'Docente' => 'ROLE_TEACHER'
			),
					'expanded' => false
		))
				
				->add('submit', SubmitType::class, array(
                    'label' => 'Registrar',
                    'attr' => array (
                        'class' => 'btn btn-primary'
            )
        ))

		;
	}

	public function configureOptions(OptionsResolver $resolver){
		$resolver->setDefaults([
			'data_class' => 'AppBundle\Entity\User' //Indica a que entidad esta mapeado el //formulario 
		]);
	}

	public function getBlockPrefix(){
		//Sirve para ponerle nombre/id a los elementos del fromulario
		return 'appBundle_user'; 
		//estructura básica de formulario, nada mas hay que cambiar lo del return y ya 
	}


} 