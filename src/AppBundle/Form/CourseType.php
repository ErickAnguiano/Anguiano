<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CourseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('title', TextType::class, array(
            'label' => 'Título del curso'
        ))

        ->add('subtitle', TextType::class)

        ->add('description', TextareaType::class, array(
            'label' => 'Descripción',
                    'attr' => array(
                        'class' => 'form-control'
                    )
        ))

        ->add('image', FileType::class, array(
            'label' => 'Cargar foto',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
            'required' => false,
        ))

        ->add('price', NumberType::class)
  

        ->add('category', EntityType::class, array(
                    'label' => 'Categoria',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'expanded' => false,
                    'multiple' => false,
                    'class' => 'AppBundle:Category',
                    'choice_label' => 'name'

        ))

        ->add('lang', EntityType::class, array(
                    'label' => 'Idioma',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'expanded' => false,
                    'multiple' => false,
                    'class' => 'AppBundle:Lang',
                    'choice_label' => 'lang'

        ))

        ->add('subcategory', EntityType::class, array(
                    'label' => 'Subcategoria',
                    'attr' => array(
                        'class' => 'form-control'
                    ),
                    'expanded' => false,
                    'multiple' => false,
                    'class' => 'AppBundle:Subcategory',
                    'choice_label' => 'name'
        ))

        ->add('submit', SubmitType::class, array(
                    'label' => 'Registrar',
                    'attr' => array (
                        'class' => 'btn btn-primary'
            )
        ))

        ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Course'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_course';
    }


}
