<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i=1; $i <= 12; $i++) {
            $product = new Product();
            $product
                ->setCode(bin2hex(mt_rand()))
                ->setPrice(mt_rand(100, 1000))
                ->setName('Lorem ipsum dolor '.$i)
                ->setDescription('Lorem ipsum dolor sit amet consectetur adipisicing elit. Cumque, facere maiores, deserunt repellendus dolor nulla suscipit? Beatae error id repellat necessitatibus quod consectetur aperiam praesentium corrupti, rem hic, est soluta.')
            ;

            $manager->persist($product);
        }

        $manager->flush();
    }
}