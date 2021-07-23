<?php

namespace App\Controller\Admin;

use App\Entity\Equipement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EquipementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equipement::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('equ_nom', 'Nom'),
            TextField::new('equ_marque', 'Marque'),
            TextField::new('equ_modele', 'Modèle'),
            TextField::new('equ_serie', 'N° série'),
            TextareaField::new('equ_description', 'Description'),
            TextField::new('equ_photo_1', 'Photo (nom)'),
            BooleanField::new('equ_archive', 'Archive')
        ];
    }
    
}
