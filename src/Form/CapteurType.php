<?php

namespace App\Form;

use App\Entity\Capteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CapteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cap_marque')
            ->add('cap_modele')
            ->add('cap_serie')
            ->add('cap_information')
            ->add('cap_archive')
            ->add('cap_macadress')
            ->add('grandeur')
            ->add('site')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Capteur::class,
        ]);
    }
}
