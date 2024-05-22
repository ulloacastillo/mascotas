<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class PetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('chip', IntegerType::class)
            ->add('tipo', ChoiceType::class, [
                'choices' => [
                    "Perro" => 1,
                    "Gato"=> 2,
                    "Hurón" => 3,
                    "Tortuga" => 4
                ]
            ])
            ->add('nombre', TextType::class)
            ->add('sexo', ChoiceType::class, [
                'choices' => [
                    "Macho" => 1,
                    "Hembra"=> 2
                ]
            ])
            ->add('color', TextType::class)
            ->add('fecha_nacimiento', DateType::class)
            ->add('raza', TextType::class)
            ->add('estirilizada', CheckboxType::class, [
                'required' => false
            ])
            ->add('rut', TextType::class)
            ->add('rut', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Añadir Mascota'])
            ->getForm();

    }
}
