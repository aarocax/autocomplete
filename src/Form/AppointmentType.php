<?php

namespace App\Form;

use App\Entity\Appointment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\DataTransformer\EntityToIdTransformer;
use App\Form\CustomerSelectorType;

class AppointmentType extends AbstractType
{
    private $transformer;

    public function __construct(EntityToIdTransformer $transformer)
    {
        $this->transformer = $transformer;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('customerAlias')
            ->add('creationDate')
            ->add('appointmentDate')
            ->add('customer', CustomerSelectorType::class, [
                // validation message if the data transformer fails
                'invalid_message' => 'That is not a valid customer number',
            ])
        ;
        $builder->get('customer')
            ->addModelTransformer($this->transformer);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Appointment::class,
        ]);
    }
}
