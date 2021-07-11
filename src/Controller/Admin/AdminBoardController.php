<?php

namespace App\Controller\Admin;

use App\Entity\Capteur;
use App\Entity\Equipement;
use App\Entity\PtMesure;
use App\Entity\Site;
use App\Repository\CapteurRepository;
use App\Repository\EquipementRepository;
use App\Repository\PtMesureRepository;
use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class AdminBoardController extends AbstractController
{
    /**
     * @Route("/adminboard", name="admin_board")
     */
    public function index(SiteRepository $siteRepository, Request $request, EquipementRepository $equipementRepository, PtMesureRepository $ptMesureRepository, CapteurRepository $capteurRepository): Response
    {
        $equipements = [];
        $lesPtMes = [];
        $siteSelect = new Site;
        $DetailEquipement = new Equipement;
        $utilisateurs = [];
        $lesPtMesAvecCapteur = [];
        $session = new Session();
        // $session->start(); // d'après la doc la session start n'est pas nécessaire
        $faireReqEquipements = false;
        $siteId = "";
        $faireReqDetailEqui = false;
        $equipementId = "";
        $nouvelleDemandeSite = false;

        /////////////////////////////////////////////
        //    Gestion render des équipements
        //////////////////////////////////////////
        if ($request->get('postSiteId')) {
            consoleLog('dans post');
            $nouvelleDemandeSite = true;
            $faireReqEquipements = true;
            $siteId = $request->get('postSiteId');
            $session->set('sessionSiteID', $siteId);
        } elseif ($session->get('sessionSiteID')) {
            consoleLog('dans session');
            $faireReqEquipements = true;
            $siteId = $session->get('sessionSiteID');
        }

        if ($faireReqEquipements) {
            $siteSelect = $siteRepository->findOneBy(["id" => $siteId]);
            $equipements = $equipementRepository->findBy(["site" => $siteId]);
            $utilisateurs = $siteSelect->getUtilisateurs();
        } else {
            $siteSelect = $siteRepository->findOneBy([]);
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
        if ($nouvelleDemandeSite == false) {  // pour éviter de garder le détail d'un equipement précédent quand on change de site
            if ($faireReqDetailEqui) {
                $DetailEquipement = $equipementRepository->findOneBy(["id" => $equipementId]);
                $lesPtMes = $ptMesureRepository->findBy(["equipement" => $equipementId]);

                //ici on fabrique un tableau "$lesPtMesAvecCapteur"
                //chaque élément de ce tableau est un tableau "$unPtMesAvecUnCapt"
                //un tableau $unPtMesAvecUnCapt" est constitué [{$unPtMes},{$unCapteur}]
                foreach ($lesPtMes as $unPtMes) {
                    $unCapteur = new Capteur;
                    $unPtMesAvecUnCapt = [];
                    $unCapteur = $unPtMes->getCapteur();
                    $unPtMesAvecUnCapt[] = $unPtMes;
                    $unPtMesAvecUnCapt[] = $unCapteur;
                    $lesPtMesAvecCapteur[] = $unPtMesAvecUnCapt;
                }
                // dd($lesPtMesAvecCapteur);
            }
        }


        // if ($request->get('postSiteId')) {
        //     consoleLog('dans if...');
        //     consoleLog($request->get('postSiteId'));
        //     $siteId = $request->get('postSiteId');
        //     $siteSelect = $siteRepository->findOneBy(["id" => $siteId]);
        //     $session->set('sessionSiteID', $siteSelect->getId());
        //     $equipements = $equipementRepository->findBy(["site" => $siteSelect]);

        //     $utilisateurs = $siteSelect->getUtilisateurs();
        // } else {
        //     $siteSelect = $siteRepository->findOneBy([]);
        // }

        $allSites = $siteRepository->findAll();


        return $this->render('admin/adminboard.html.twig', [
            'sites' => $allSites,
            'siteSelect' => $siteSelect,
            'equipements' => $equipements,
            'utilisateurs' => $utilisateurs,
            'DetailEquipement' => $DetailEquipement,
            'lesPtMes' => $lesPtMes,
            'lesPtMesAvecCapteur' => $lesPtMesAvecCapteur,
        ]);
    }
}
