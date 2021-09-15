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
            ->add('pt_mes_nom',null,['label' => 'Nom'])
            ->add('pt_mes_position',null,['label' => 'Position'])
            ->add('grandeur',null,['label' => 'Grandeur'])
            ->add('capteur',null,['label' => 'Capteur'])
            ->add('equipement',null,['label' => 'Equipement'])
            ->add('pt_mes_archive',null,['label' => 'Archiver'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PtMesure::class,
        ]);
    }
}
