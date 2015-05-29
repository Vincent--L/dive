<?php

namespace dive\LogbookBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationDiverFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('birthday',   'date', array(
                'format' => 'dd MM yyyy',
                'years' => range(1920,2015),
                'placeholder' => ''
            ))
            ->add('country',    'country', array(
                'placeholder' => ''
            ))
            ->add('address')
            ->add('register', 'submit')
        ;
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'dive_diver_registration';
    }
}