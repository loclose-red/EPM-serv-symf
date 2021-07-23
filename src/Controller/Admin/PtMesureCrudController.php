<?php

namespace App\Controller\Admin;

use App\Entity\PtMesure;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PtMesureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PtMesure::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('pt_mes_nom', 'Nom'),
            TextField::new('pt_mes_position', 'Position'),
            TextField::new('equipement', 'Equipement')->onlyOnIndex(),
            BooleanField::new('pt_mes_archive', 'Archive')
        ];
    }
    
}
