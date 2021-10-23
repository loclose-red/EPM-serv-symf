<?php

namespace App\Form;

use App\Entity\Site;
use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sit_raison_sociale', null, ['label' => 'Raison sociale'])
            ->add('sit_ville', null, ['label' => 'Ville'])
            ->add('sit_c_postal', null, ['label' => 'Code postal'])
            ->add('sit_adresse', null, ['label' => 'Adresse'])
            ->add('sit_information', null, ['label' => 'Information'])
            // ->add('utilisateurs', null, ['label' => 'Utilisateur'])
            
            ->add('sit_archive', null, ['label' => 'Archiver'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Site::class,
        ]);
    }
}
