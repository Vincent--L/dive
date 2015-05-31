<?php

namespace dive\LogbookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DiveType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', 'date', array(
                'format' => 'dd MM yyyy',
                'years' => range(1920,date('Y')),
                'placeholder' => ''
            ))
            ->add('spot', 'entity', array(
                'class' => 'diveSpotBundle:Spot',
                'property' => 'name',
                'multiple' => false,
                'empty_value' => 'Select a spot'
            ))  
            ->add('duration', 'integer')
            ->add('depth', 'integer')
            ->add('description', 'textarea')
            ->add('categories', 'entity', array(
                'class' => 'diveLogbookBundle:Category',
                'property' => 'name',
                'multiple' => true,
                'expanded' => true,
                'label_attr' => array(
                    'class' => 'checkbox-inline'
                )
            ))
            ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'dive\LogbookBundle\Entity\Dive'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dive_logbookbundle_dive';
    }
}
