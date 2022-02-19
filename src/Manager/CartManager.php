<?php

declare(strict_types=1);

namespace App\Manager;

use App\Entity\Order;
use App\Factory\OrderFactory;
use App\Storage\CartSessionStorage;
use Doctrine\ORM\EntityManagerInterface;

class CartManager
{
    private $em;
    private $cartFactory;
    private $cartSessionStorage;

    /**
     * @param CartSessionStorage $cartStorage
     * @param OrderFactory $orderFactory
     * @param EntityManagerInterface $em
     */
    public function __construct(CartSessionStorage $cartStorage, OrderFactory $orderFactory, EntityManagerInterface $em) {
        $this->em                 = $em;
        $this->cartFactory        = $orderFactory;
        $this->cartSessionStorage = $cartStorage;
    }

    public function getCurrentCart(): Order
    {
        $cart = $this->cartSessionStorage->getCart();

        if (!$cart) {
            $cart = $this->cartFactory->create();
        }

        return $cart;
    }

    public function save(Order $cart): void
    {
        $this->em->persist($cart); # Persist in database
        $this->em->flush();
        $this->cartSessionStorage->setCart($cart); # Persist in session
    }
}
