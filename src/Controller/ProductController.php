<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Form\AddToCartType;
use App\Manager\CartManager;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/", name="app_products", methods={"GET"})
     */
    public function products(ProductRepository $productRepository): Response
    {
        return $this->render('product/products.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    /**
     * @Route("/products/show/{id}", name="app_product_show", methods={"GET", "POST"})
     */
    public function product(Product $product, Request $request, CartManager $cartManager): Response
    {
        $form = $this->createForm(AddToCartType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $item = $form->getData();
            $item->setProduct($product);

            $cart = $cartManager->getCurrentCart();
            $cart
                ->addItem($item)
                ->setUpdated(new \DateTime());

            $cartManager->save($cart);

            $this->addFlash('success', 'Cart updated!');
            return $this->redirectToRoute('app_cart');
        }

        return $this->render('product/product.html.twig', [
            'product' => $product,
            'form'    => $form->createView()
        ]);
    }
}
