<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccountController extends AbstractController{
    #[Route('/account', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('pages/account.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
