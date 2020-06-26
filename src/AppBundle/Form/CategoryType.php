<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

//IMPORTACIONES DE TIPO DE INSERT O BOTONES EN HTML
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options){
        $builder->add('name', TextType::class, array(
            'label' => 'Categoria',
            'attr' => array(
                'autocomplete' => 'off',
                'placeholder' => 'Ingese el nombre de la categoria...',
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

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Category'
        ));
    }

    public function getBlockPrefix() {
        return 'appbundle_category';
    }


}
