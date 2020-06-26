<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CourseSectionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
            'label' => 'Sección',
                    'attr' => array(
                        'class' => 'form-control'
                    )
        ))

            ->add('description', TextareaType::class, array(
            'label' => 'Descripción',
                    'attr' => array(
                        'class' => 'form-control'
                    )
        ))

            ->add('submit', SubmitType::class, array(
                    'label' => 'Registrar',
                    'attr' => array (
                        'class' => 'btn btn-primary'
                    )
        ))

        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\CourseSection'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_coursesection';
    }


}
