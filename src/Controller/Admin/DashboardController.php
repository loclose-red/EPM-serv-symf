<?php

namespace App\Controller\Admin;

use App\Entity\Capteur;
use App\Entity\Equipement;
use App\Entity\Grandeur;
use App\Entity\Mesure;
use App\Entity\PtMesure;
use App\Entity\Site;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // return parent::index();
        return $this->render('admin/easyAdminDashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('EPM DashBoard');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Capteurs', 'fas fa-list', Capteur::class);
        yield MenuItem::linkToCrud('Equipements', 'fas fa-list', Equipement::class);
        yield MenuItem::linkToCrud('Grandeurs', 'fas fa-list', Grandeur::class);
        yield MenuItem::linkToCrud('Mesures', 'fas fa-list', Mesure::class);
        yield MenuItem::linkToCrud('Points de mesures', 'fas fa-list', PtMesure::class);
        yield MenuItem::linkToCrud('Sites', 'fas fa-list', Site::class);
        // yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-list', Utilisateur::class);
    }
}
