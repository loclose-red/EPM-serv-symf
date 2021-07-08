<?php

namespace App\Controller\Customer;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomerboardController extends AbstractController
{
    /**
     * @Route("/customerboard", name="customer_board")
     */
    public function index(): Response
    {
        return $this->render('customer/customerboard.html.twig', [
            'controller_name' => 'CustomerboardController',
        ]);
    }
}
