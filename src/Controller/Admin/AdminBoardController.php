<?php

namespace App\Controller\Admin;

use App\Repository\EquipementRepository;
use App\Repository\SiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBoardController extends AbstractController
{
    /**
     * @Route("/adminboard", name="admin_board")
     */
    public function index(SiteRepository $siteRepository, Request $request, EquipementRepository $equipementRepository): Response
    {
        $equipements = [];
        $siteSelect = [];

        if ($request->get('select_site')) {
            $siteId = $request->get('select_site');
            $siteSelect = $siteRepository->findBy(["id" => $siteId]);
            $equipements = $equipementRepository->findBy(["site" => $siteSelect]);
            // dd($equipements);
        } else {
            $siteSelect = $siteRepository->findBy([]);
        }
        $allSites = $siteRepository->findAll();
        // dd($siteSelect);
        return $this->render('admin/adminboard.html.twig', [
            'sites' => $allSites,
            'siteSelect' => $siteSelect,
            'equipements' => $equipements,
        ]);
    }
}
