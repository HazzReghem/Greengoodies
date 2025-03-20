<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ApiProductController extends AbstractController
{
    #[Route('/api/products', name: 'api_products', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(ProductRepository $productRepository): JsonResponse
    {
        $user = $this->getUser();
        if (!$user->isApiAccess()) {
            return new JsonResponse(['message' => 'Accès API non activé'], 403);
        }

        $products = $productRepository->findAll();
        return $this->json($products, 200, [], ['groups' => 'product:read']);
    }
}

