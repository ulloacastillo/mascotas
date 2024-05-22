<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;


class PetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chip', IntegerType::class)
            ->add('tipo', IntegerType::class)
            ->add('nombre', TextType::class)
            ->add('sexo', CheckboxType::class)
            ->add('color', TextType::class)
            ->add('fecha_nacimiento', DateType::class)
            ->add('raza', TextType::class)
            ->add('estirilizada', CheckboxType::class)
            ->add('rut', TextType::class)
            ->add('rut', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Añadir Mascota'])
            ->getForm();

    }
}
