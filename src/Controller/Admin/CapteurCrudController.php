<?php

namespace App\Controller\Admin;

use App\Entity\Capteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CapteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Capteur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('cap_marque', 'Marque'),
            TextField::new('cap_modele', 'Modèle'),
            TextField::new('cap_modele', 'N° série'),
            TextField::new('grandeur', 'Unité')->onlyOnIndex(),
            TextareaField::new('cap_information', 'Information'),
            BooleanField::new('cap_archive', 'Archive')
        ];
    }
    
}
