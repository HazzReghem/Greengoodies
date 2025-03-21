<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class ApiController extends AbstractController
{
    #[Route('/api/products', name: 'api_products', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function getProducts(ProductRepository $productRepository, UserInterface $user): JsonResponse
    {
        // Vérifier si l'accès API est activé
        if (!$user->isApiAccess()) {
            return new JsonResponse(['error' => 'Accès API non activé'], 403);
        }

        $products = $productRepository->findAll();
        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'price' => $product->getPrice(),
                'short description' => $product->getShortDescription(),
                'long description' => $product->getFullDescription(),
                'image' => $product->getPicture(),
            ];
        }

        return new JsonResponse($data, 200);
    }

    #[Route('/api/login', name: 'api_login', methods: ['POST'])]
    public function login(
        Request $request,
        UserRepository $userRepository,
        UserPasswordHasherInterface $passwordHasher,
        JWTTokenManagerInterface $JWTManager
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['email'], $data['password'])) {
            return new JsonResponse(['error' => 'Données invalides'], 400);
        }

        $user = $userRepository->findOneBy(['email' => $data['email']]);
        if (!$user) {
            return new JsonResponse(['error' => 'Utilisateur non trouvé'], 401);
        }

        if (!$user->isApiAccess()) {
            return new JsonResponse(['error' => 'Accès API non activé'], 403);
        }

        if (!$passwordHasher->isPasswordValid($user, $data['password'])) {
            return new JsonResponse(['error' => 'Mot de passe incorrect'], 401);
        }

        $token = $JWTManager->create($user);

        return new JsonResponse(['token' => $token], 200);
    }
}
