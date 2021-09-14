<?php

namespace App\Form;

use App\Entity\Equipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Vich\UploaderBundle\Form\Type\VichImageType;

class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('equ_nom')
            ->add('equ_marque')
            ->add('equ_modele')
            ->add('equ_serie')
            ->add('equ_description')
            // ->add('equ_photo_1')
            ->add('imageFile', VichImageType::class,[
                'required' => false,
                'allow_delete' => false,
                // 'delete_label' => '...',
                'download_uri' => false,
                // 'download_label' => '...',
                'asset_helper' => false,
            ])
            ->add('site')
            ->add('equ_archive')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipement::class,
        ]);
    }
}
