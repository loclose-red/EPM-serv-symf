<?php

namespace App\Controller\Admin;

use App\Entity\Grandeur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class GrandeurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Grandeur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            
            TextField::new('gra_nom', 'Nom'),
            TextField::new('gra_unite', 'Unité'),
            BooleanField::new('gra_archive', 'Archive')
            
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setDefaultSort(['gra_archive' => 'ASC']);
    }
    
}
