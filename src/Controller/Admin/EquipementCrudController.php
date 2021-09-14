<?php

namespace App\Controller\Admin;

use App\Entity\Equipement;
use App\Entity\Site;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use Vich\UploaderBundle\Form\Type\VichImageType;

class EquipementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Equipement::class;
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
            TextField::new('equ_nom', 'Nom'),
            TextField::new('equ_marque', 'Marque'),
            TextField::new('equ_modele', 'Modèle'),
            TextField::new('equ_serie', 'N° série'),
            TextareaField::new('equ_description', 'Description'),
            
            TextField::new('imageFile')->setFormType(VichImageType::class),
            ImageField::new('equ_photo_1')->setBasePath('/uploads/photos')->onlyOnIndex(),
            //pour afficher le site dans l'index
            TextField::new('site', 'Site')->onlyOnIndex(),
            //pour afficher la liste des sites dans l'édition
            ChoiceField::new('site', 'Site')
            ->setChoices($this->listeSites())
            ->hideOnIndex(),
            // TextField::new('equ_photo_1', 'Photo (nom)'),
            BooleanField::new('equ_archive', 'Archive')
        ];
    }
    
}
