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
            ->add('cap_marque',null,['label'=>'Marque'])
            ->add('cap_modele',null,['label'=>'Modèle'])
            ->add('cap_serie',null,['label'=>'N° Série'])
            ->add('cap_macadress',null,['label'=>'Adresse mac (BT)'])
            ->add('grandeur',null,['label'=>'Grandeur'])
            ->add('cap_information',null,['label'=>'Information'])
            ->add('site',null,['label'=>'Site'])
            ->add('cap_archive',null,['label'=>'Archiver'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Capteur::class,
        ]);
    }
}
