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
            ->add('equ_nom', null, ['label' => 'Nom'])
            ->add('equ_marque', null, ['label' => 'Marque'])
            ->add('equ_modele', null, ['label' => 'Modèle'])
            ->add('equ_serie', null, ['label' => 'N° Série'])
            ->add('equ_description', null, ['label' => 'Description'])
            // ->add('equ_photo_1')
            ->add('imageFile', VichImageType::class,[
                'required' => false,
                'allow_delete' => false,
                // 'delete_label' => '...',
                'download_uri' => false,
                // 'download_label' => '...',
                'asset_helper' => false,
            ])
            ->add('site', null, ['label' => 'Site'])
            ->add('equ_archive', null, ['label' => 'Archiver'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Equipement::class,
        ]);
    }
}
