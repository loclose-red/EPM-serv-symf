<?php

namespace App\Form;

use App\Entity\Equipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('equ_marque')
            ->add('equ_modele')
            ->add('equ_serie')
            ->add('equ_nom')
            ->add('equ_description')
            ->add('equ_photo_1')
            ->add('equ_archive')
            ->add('site')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipement::class,
        ]);
    }
}
