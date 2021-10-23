<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Site::class;
    }

    //Création d'une fonction pour récupérer la liste des "Utilisateurs"
    //cette fonction sera utilisée pour afficher le choix des equipements pour un point de mesure
    public function listeUtilisateurs()
    {
        $tableauRetour = [];
        $utilisateurRepository= $this->getDoctrine()->getRepository(Utilisateur::class);
        $tableauListe = $utilisateurRepository->findAll();
        foreach($tableauListe as $unUtilisateur)
            $tableauRetour[$unUtilisateur->getLogname()] = $unUtilisateur;
        return $tableauRetour;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('sit_raison_sociale', 'Raison sociale'),
            TextField::new('sit_ville', 'Ville'),
            TextField::new('sit_c_postal', 'Cde postal'),
            TextField::new('sit_adresse', 'Adresse'),
            TextareaField::new('sit__information', 'Information'),
            //pour afficher la liste des utilisateurs dans l'édition
            // ChoiceField::new('utilisateurs', 'Utilisateur')
            // ->setChoices($this->listeUtilisateurs())
            // ->hideOnIndex(),
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
