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
        $siteSelect = new Site;
        $equipements = [];
        $DetailEquipement = new Equipement;

        /////////////////////////////////////////////
        //    Gestion render des équipements
        //////////////////////////////////////////
        if ($session->get('sessionSiteID')) {
            consoleLog('dans session');
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
            consoleLog('dans post detail equi: ' . $request->get('postEquId'));
            $faireReqDetailEqui = true;
            $equipementId = $request->get('postEquId');
            $session->set('sessionEquID', $equipementId);
        } elseif ($session->get('sessionEquID')) {
            $faireReqDetailEqui = true;
            $equipementId = $session->get('sessionEquID');
        }

        if ($faireReqDetailEqui) {
            $DetailEquipement = $equipementRepository->findOneBy(["id" => $equipementId]);
            $lesPtMes = $ptMesureRepository->findBy(["equipement" => $equipementId]);

            //ici on fabrique un tableau "$lesPtMesAvecCapteurEtMesures"
            //chaque élément de ce tableau est un tableau "$unPtMesAvecUnCapt"
            //un tableau $unPtMesAvecUnCapt" est constitué [{$unPtMes},{$unCapteur},[{des mesures}]]
            foreach ($lesPtMes as $unPtMes) {
                $unCapteur = new Capteur;
                // $lesMesures = [];
                $unPtMesAvecUnCaptEtMesures = [];
                $unCapteur = $unPtMes->getCapteur();
                $lesMesures = $mesureRepository->findBy(["ptmesure" => $unPtMes]);
                $unPtMesAvecUnCaptEtMesures[] = $unPtMes;
                $unPtMesAvecUnCaptEtMesures[] = $unCapteur;
                $unPtMesAvecUnCaptEtMesures[] = $lesMesures;
                $lesPtMesAvecCapteurEtMesures[] = $unPtMesAvecUnCaptEtMesures;
            }
            // dd($lesPtMesAvecCapteur);
        }






        return $this->render('customer/customerboard.html.twig', [
            'siteSelect' => $siteSelect,
            'equipements' => $equipements,
            'DetailEquipement' => $DetailEquipement,
            'lesPtMesAvecCapteurEtMesures' => $lesPtMesAvecCapteurEtMesures,
            'controller_name' => 'CustomerboardController',
        ]);
    }
}
