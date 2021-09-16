<?php

namespace App\Controller\Admin;

use App\Entity\Capteur;
use App\Entity\Equipement;
use App\Entity\Grandeur;
use App\Entity\PtMesure;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PtMesureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PtMesure::class;
    }

    //Création d'une fonction pour récupérer la liste des "grandeurs"
    //cette fonction sera utilisée pour afficher le choix des grandeur pour un point de mesure
    public function listeGrandeurs()
    {
        $tableauRetour = [];
        $grandeurRepository= $this->getDoctrine()->getRepository(Grandeur::class);
        $tableauListe = $grandeurRepository->findAll();
        foreach($tableauListe as $uneGrandeur)
            $tableauRetour[$uneGrandeur->getGraUnite()] = $uneGrandeur;
        return $tableauRetour;
    }

    //Création d'une fonction pour récupérer la liste des "equipements"
    //cette fonction sera utilisée pour afficher le choix des equipements pour un point de mesure
    public function listeEquipements()
    {
        $tableauRetour = [];
        $equRepository= $this->getDoctrine()->getRepository(Equipement::class);
        $tableauListe = $equRepository->findAll();
        foreach($tableauListe as $unEqu)
            $tableauRetour[$unEqu->getEquMarque(). " : " . $unEqu->getEquSerie()] = $unEqu;
        return $tableauRetour;
    }

    //Création d'une fonction pour récupérer la liste des "equipements"
    //cette fonction sera utilisée pour afficher le choix des equipements pour un point de mesure
    public function listeCapteurs()
    {
        $tableauRetour = [];
        $capteurRepository= $this->getDoctrine()->getRepository(Capteur::class);
        $tableauListe = $capteurRepository->findAll();
        foreach($tableauListe as $unCapteur)
            $tableauRetour[$unCapteur->getCapMarque(). " : " . $unCapteur->getCapSerie()] = $unCapteur;
        return $tableauRetour;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('pt_mes_nom', 'Nom'),
            TextField::new('pt_mes_position', 'Position'),
            TextField::new('equipement', 'Equipement')->onlyOnIndex(),
            //pour afficher la liste des sites dans l'édition
            ChoiceField::new('equipement', 'Equipement')
            ->setChoices($this->listeEquipements())
            ->hideOnIndex(),
            TextField::new('grandeur', 'Unité')->onlyOnIndex(),
            //pour afficher la liste des grandeurs dans l'édition
            ChoiceField::new('grandeur', 'Unité')
            ->setChoices($this->listeGrandeurs())
            ->hideOnIndex(),
            TextField::new('capteur', 'Capteur')->onlyOnIndex(),
            //pour afficher la liste des capteurs dans l'édition
            ChoiceField::new('capteur', 'Capteur')
            ->setChoices($this->listeCapteurs())
            ->hideOnIndex(),
            BooleanField::new('pt_mes_archive', 'Archive')
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setDefaultSort(['pt_mes_archive' => 'ASC']);
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::DELETE)
        ;
    }
    
}
