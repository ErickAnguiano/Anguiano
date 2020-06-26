<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SubcategoryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('name', TextType::class, array( 
            'label' => 'Subcategoria',
            'attr' => array(
                'autocomplete' => 'off',
                'placeholder' => 'Ingese el nombre de la subcategoria...',
                'class' => 'form-control'
            ) 
        ))

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
            'data_class' => 'AppBundle\Entity\Subcategory'
        ));
    }


    public function getBlockPrefix()
    {
        return 'appbundle_subcategory';
    }


}
