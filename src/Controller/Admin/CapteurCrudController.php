<?php

namespace App\Controller\Admin;

use App\Entity\Capteur;
use App\Entity\Grandeur;
use App\Entity\Site;
use App\Form\UtilisateurType;
use App\Repository\GrandeurRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CapteurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Capteur::class;
    }

    //Création d'une fonction pour récupérer la liste des "grandeurs"
    //cette fonction sera utilisée pour afficher la liste des choix de grandeur pour un catpeur
    public function listeGrandeurs()
    {
        $tableauRetour = [];
        $grandeurRepository= $this->getDoctrine()->getRepository(Grandeur::class);
        $tableauListe = $grandeurRepository->findAll();
        foreach($tableauListe as $uneGrandeur)
            $tableauRetour[$uneGrandeur->getGraUnite()] = $uneGrandeur;
        return $tableauRetour;
    }

    //Création d'une fonction pour récupérer la liste des "sites"
    //cette fonction sera utilisée pour afficher la liste des choix de site pour un equipement
    public function listeSites()
    {
        $tableauRetour = [];
        $siteRepository= $this->getDoctrine()->getRepository(Site::class);
        $tableauListe = $siteRepository->findAll();
        foreach($tableauListe as $unSite)
            $tableauRetour[$unSite->getSitRaisonSociale()] = $unSite;
        return $tableauRetour;
    }

    

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('cap_marque', 'Marque'),
            TextField::new('cap_modele', 'Modèle'),
            TextField::new('cap_serie', 'N° série'),
            TextField::new('cap_macadress', 'Adresse mac (BT)'),
            //pour afficher la grandeur dans l'index
            TextField::new('grandeur', 'Unité')->onlyOnIndex(),
            //pour afficher la liste des grandeurs dans l'édition
            ChoiceField::new('grandeur', 'Unité')
            ->setChoices($this->listeGrandeurs())
            ->hideOnIndex(),
            TextareaField::new('cap_information', 'Information'),
            BooleanField::new('cap_archive', 'Archive'),


            //on n'affiche pas cette option dans un premier temps
            //car peut porter à confusion
            
            //pour afficher le site dans l'index
            // TextField::new('site', 'Site')->onlyOnIndex(),

            //pour afficher la liste des sites dans l'édition
            // ChoiceField::new('site', 'Site')
            // ->setChoices($this->listeSites())
            // ->hideOnIndex(),
                    
                                
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setDefaultSort(['cap_archive' => 'ASC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
        ;
    }
    
}
