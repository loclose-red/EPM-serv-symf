<?php

namespace App\Controller\Admin;

use App\Entity\Mesure;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MesureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Mesure::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('mes_valeur_1', 'Valeur 1'),
            TextField::new('grandeur', 'Unité'),
            DateTimeField::new('mes_date', 'Date'),
            TextField::new('capteur', 'Capteur')->onlyOnIndex(),
            BooleanField::new('mes_archive', 'Archive')
        ];
    }
    
}
