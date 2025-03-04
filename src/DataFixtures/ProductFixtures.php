<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Product;
use Faker\Factory;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $product = new Product();
            $product->setName($faker->word);
            $product->setPrice($faker->randomFloat(2, 5, 100));
            $product->setShortDescription($faker->sentence);
            $product->setFullDescription($faker->paragraph);
            $product->setPicture($faker->imageUrl(640, 480, 'items'));

            $manager->persist($product);
        }

        $manager->flush();
    }
}
