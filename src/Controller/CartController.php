<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\CartType;
use App\Manager\CartManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="app_cart", methods={"GET", "POST"})
     */
    public function index(Request $request, CartManager $cartManager): Response
    {
        $cart = $cartManager->getCurrentCart();
        $form = $this->createForm(CartType::class, $cart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart->setUpdated(new \DateTime('NOW'));
            $cartManager->save($cart);

            $this->addFlash('success', 'Cart updated!');
            return $this->redirectToRoute('app_cart');
        }

        return $this->render('cart/index.html.twig', [
            'cart' => $cart,
            'form' => $form->createView()
        ]);
    }
}
