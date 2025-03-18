<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Order;

use App\Repository\ProductRepository;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Bundle\SecurityBundle\Security;

final class MainController extends AbstractController{

    #[Route('/', name: 'app_homepage')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render('pages/home.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request,  UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = new User();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hasher le mot de passe
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );
            $user->setRoles(['ROLE_USER']);
            
            $entityManager->persist($user);
            $entityManager->flush();

            // Connexion automatique de l'utilisateur
            $security->login($user);

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/product/{id}', name: 'app_product')]
    public function product(ProductRepository $productRepository, $id): Response
    {
        $product = $productRepository->find($id);

        return $this->render('pages/product.html.twig', [
            'product' => $product,
        ]);
    }

    // ---------------------- PANIER ------------------------------

    #[Route('/cart', name: 'app_cart')]
    public function cart(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);

        return $this->render('pages/cart.html.twig', [
            'cart' => $cart,
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_add_to_cart')]
    public function addToCart(int $id, ProductRepository $productRepository, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);

        $product = $productRepository->find($id);
        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé.');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->getName(),
                'picture' => $product->getPicture(),
                'price' => $product->getPrice(),
                'quantity' => 1
            ];
        }

        $session->set('cart', $cart);

        return $this->redirectToRoute('app_cart');
    }
    
    #[Route('/cart/empty', name: 'app_empty_cart')]
    public function emptyCart(RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $session->remove('cart');

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/valider', name: 'app_validate_cart')]
    public function validateCart(RequestStack $requestStack, EntityManagerInterface $entityManager, Security $security): Response
    {
        $session = $requestStack->getSession();
        $cart = $session->get('cart', []);

        if (empty($cart)) {
            $this->addFlash('error', 'Votre panier est vide.');
            return $this->redirectToRoute('app_cart');
        }

        // calcul du prix total
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // création de la commande
        $order = new Order();
        $order->setUser($security->getUser());
        $order->setCreatedAt(new \DateTimeImmutable());
        $order->setTotalPrice($totalPrice);

        // sauvegarde de la commande
        $entityManager->persist($order);
        $entityManager->flush();

        $session->remove('cart');

        $this->addFlash('success', 'Votre commande a été validée avec succès !');

        return $this->redirectToRoute('app_account');
    }    
}
