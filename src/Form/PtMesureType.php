<?php

namespace App\Form;

use App\Entity\PtMesure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PtMesureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pt_mes_nom')
            ->add('pt_mes_position')
            ->add('pt_mes_archive')
            ->add('grandeur')
            ->add('capteur')
            ->add('equipement')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PtMesure::class,
        ]);
    }
}
