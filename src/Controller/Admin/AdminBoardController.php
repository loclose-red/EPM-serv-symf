<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminBoardController extends AbstractController
{
    /**
     * @Route("/adminboard", name="admin_board")
     */
    public function index(): Response
    {
        return $this->render('admin/adminboard.html.twig', [
            'controller_name' => 'AdminBoardController',
        ]);
    }
}
