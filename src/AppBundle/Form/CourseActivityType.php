<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CourseActivityType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
            'label' => 'Título del curso'
        ))

            ->add('description', TextareaType::class, array(
            'label' => 'Descripción',
                    'attr' => array(
                        'class' => 'form-control'
                    )
        ))

            ->add('video', FileType::class, array(
            'label' => 'Cargar video',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
            'required' => false,
        ))

            ->add('document', FileType::class, array(
            'label' => 'Cargar archivo',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
            'required' => false,
        ))

            ->add('section', EntityType::class, array(
                    'label' => 'Seccion',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'expanded' => false,
                    'multiple' => false,
                    'class' => 'AppBundle:CourseSection',
                    'choice_label' => 'title'

        ))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CourseActivity'
        ));
    }


    public function getBlockPrefix()
    {
        return 'appbundle_courseactivity';
    }


}
