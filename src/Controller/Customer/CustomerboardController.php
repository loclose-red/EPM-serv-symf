<?php

namespace App\Controller\Customer;

use App\Entity\Capteur;
use App\Entity\Equipement;
use App\Entity\Site;
use App\Repository\EquipementRepository;
use App\Repository\MesureRepository;
use App\Repository\PtMesureRepository;
use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;

class CustomerboardController extends AbstractController
{
    /**
     * @Route("/customerboard", name="customer_board")
     */
    public function index(PtMesureRepository $ptMesureRepository, SiteRepository $siteRepository, EquipementRepository $equipementRepository, MesureRepository $mesureRepository, Request $request): Response
    {
        $session = new Session();
        $siteId = ""; //valeur par défaut pour dev à modifier absolument
        $faireReqEquipements = false;
        $faireReqDetailEqui = false;
        $siteSelect = new Site;
        $equipements = [];
        $DetailEquipement = new Equipement;

        // $siteId = $siteRepository->findOneBy(["user" => $actualUser])
        // $session->set('sessionSiteID', $siteId);

        /////////////////////////////////////////////
        //    Gestion render des équipements
        //////////////////////////////////////////
        if ($session->get('sessionSiteID')) {
            $faireReqEquipements = true;
            $siteId = $session->get('sessionSiteID');
        }


        if ($faireReqEquipements) {
            $siteSelect = $siteRepository->findOneBy(["id" => $siteId]);
            $equipements = $equipementRepository->findBy(["site" => $siteId]);
            // $utilisateurs = $siteSelect->getUtilisateurs();
        }

        /////////////////////////////////////////////
        //    Gestion render du détail d'un équipement
        //////////////////////////////////////////
        if ($request->get('postEquId')) {
            $faireReqDetailEqui = true;
            $equipementId = $request->get('postEquId');
            $session->set('sessionEquID', $equipementId);
        } elseif ($session->get('sessionEquID')) {
            $faireReqDetailEqui = true;
            $equipementId = $session->get('sessionEquID');
        }

        $lesPtMesAvecCapteurEtMesures = [];
        $elementPourGraphiquesChartJs = [];
        if ($faireReqDetailEqui) {
            $DetailEquipement = $equipementRepository->findOneBy(["id" => $equipementId]);
            $lesPtMes = $ptMesureRepository->findBy(["equipement" => $equipementId]);

            //ici on fabrique un tableau "$lesPtMesAvecCapteurEtMesures"
            //chaque élément de ce tableau est un tableau "$unPtMesAvecUnCapt"
            //un tableau $unPtMesAvecUnCapt" est constitué [{$unPtMes},{$unCapteur},[mes_val_1,...],[date,...]]


            //on fabrique aussi un tableau qui sera utilisé par chart_JS



            foreach ($lesPtMes as $unPtMes) {
                $unCapteur = new Capteur;
                // $lesMesures = [];
                $unPtMesAvecUnCaptEtMesures = [];
                $unCapteur = $unPtMes->getCapteur();
                $lesMesures = $mesureRepository->findBy(["ptmesure" => $unPtMes]);
                $unPtMesAvecUnCaptEtMesures[] = $unPtMes;
                $unPtMesAvecUnCaptEtMesures[] = $unCapteur;
                //Traitements pour fabriquer des tableaux qui seront ulilisés par chart_JS
                //Talbeau des Valeurs_1 et des dates associées
                $lesValeurs_1 = [];
                $lesDates = [];
                foreach($lesMesures as $uneMesure){
                    $lesValeurs_1[]=$uneMesure->getMesValeur1();
                    $lesDates[]=date_format($uneMesure->getMesDate(),"Y/m/d H:i:s");
                }
                // dd($lesDates);
                $unPtMesAvecUnCaptEtMesures[] = $lesValeurs_1;
                $unPtMesAvecUnCaptEtMesures[] = $lesDates;


                $lesPtMesAvecCapteurEtMesures[] = $unPtMesAvecUnCaptEtMesures;
            }
            // dd($lesPtMesAvecCapteur);
            // dd($lesPtMesAvecCapteurEtMesures);
        }

        
        // dd($this->getUser()->getRoles()[0]);




        return $this->render('customer/customerboard.html.twig', [
            'siteSelect' => $siteSelect,
            'equipements' => $equipements,
            'DetailEquipement' => $DetailEquipement,
            'lesPtMesAvecCapteurEtMesures' => $lesPtMesAvecCapteurEtMesures,
            'controller_name' => 'CustomerboardController',
            'role' => $this->getUser()->getRoles()[0]
        ]);
    }
}
