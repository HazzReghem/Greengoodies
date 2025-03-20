<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Order;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AccountController extends AbstractController{
    #[Route('/account', name: 'app_account')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $orders = $entityManager->getRepository(Order::class)->findBy(['User' => $user], ['createdAt' => 'DESC']);

        return $this->render('pages/account.html.twig', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }

    #[Route('/account/delete', name: 'app_account_delete')]
    public function deleteAccount(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        // Supprimer les commandes associées
        $orders = $entityManager->getRepository(Order::class)->findBy(['User' => $user]);
        foreach ($orders as $order) {
            $entityManager->remove($order);
        }

        $entityManager->remove($user);
        $entityManager->flush();

        $this->addFlash('success', 'Votre compte a été supprimé.');
        return $this->redirectToRoute('app_homepage');
    }

    #[Route('/account/toggle-api-access', name: 'app_toggle_api_access', methods: ['POST'])]
    public function toggleApiAccess(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté.");
        }

        // Inversion de l'état actuel
        $user->setApiAccess(!$user->isApiAccess());
        
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', $user->isApiAccess() ? 'Accès API activé.' : 'Accès API désactivé.');

        return $this->redirectToRoute('app_account');
    }
}
