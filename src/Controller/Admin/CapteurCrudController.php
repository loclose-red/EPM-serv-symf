<?php

namespace App\Controller\Admin;

use App\Entity\Capteur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CapteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Capteur::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
