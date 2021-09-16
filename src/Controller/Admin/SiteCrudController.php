<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Site::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('sit_raison_sociale', 'Raison sociale'),
            TextField::new('sit_ville', 'Ville'),
            TextField::new('sit_c_postal', 'Cde postal'),
            TextField::new('sit_adresse', 'Adresse'),
            TextareaField::new('sit__information', 'Information'),
            BooleanField::new('sit_archive', 'Archive')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setDefaultSort(['sit_archive' => 'ASC']);
    }
    
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
        ;
    }
    
}
