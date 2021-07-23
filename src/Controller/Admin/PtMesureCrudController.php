<?php

namespace App\Controller\Admin;

use App\Entity\Equipement;
use App\Entity\Grandeur;
use App\Entity\PtMesure;
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
    public function listeEquipement()
    {
        $tableauRetour = [];
        $equRepository= $this->getDoctrine()->getRepository(Equipement::class);
        $tableauListe = $equRepository->findAll();
        foreach($tableauListe as $unEqu)
            $tableauRetour[$unEqu->getEquMarque(). " : " . $unEqu->getEquSerie()] = $unEqu;
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
            ->setChoices($this->listeEquipement())
            ->hideOnIndex(),
            TextField::new('grandeur', 'Unité')->onlyOnIndex(),
            //pour afficher la liste des grandeurs dans l'édition
            ChoiceField::new('grandeur', 'Unité')
            ->setChoices($this->listeGrandeurs())
            ->hideOnIndex(),
            BooleanField::new('pt_mes_archive', 'Archive')
        ];
    }
    
}
