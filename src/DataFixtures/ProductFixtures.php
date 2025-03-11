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
        // $faker = Factory::create();

        // for ($i = 0; $i < 10; $i++) {
        //     $product = new Product();
        //     $product->setName($faker->word);
        //     $product->setPrice($faker->randomFloat(2, 5, 100));
        //     $product->setShortDescription($faker->sentence);
        //     $product->setFullDescription($faker->paragraph);
        //     $product->setPicture($faker->imageUrl(640, 480, 'items'));

        //     $manager->persist($product);
        // }

        $products = [
            [
                'name' => "Kit d'hygiène recyclable", 
                'price' => 24.99,
                'shortDescription' => "Pour une salle de bain éco-friendly",
                'fullDescription' => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum finibus sem non luctus mollis. Mauris congue maximus velit, nec facilisis libero dignissim at. Donec id lorem sed mi vulputate viverra. Aenean venenatis sem eget consectetur bibendum. Suspendisse tristique ultrices elit vitae sodales. Vivamus pretium metus quis ligula ullamcorper finibus. Sed quis nisl a tortor consectetur ullamcorper sit amet ut urna. Nam non laoreet purus, ultrices interdum libero. Praesent vel urna suscipit, mollis sapien eget, tempor dolor. Phasellus libero eros, laoreet vitae suscipit in, tincidunt non dolor. In interdum urna non dolor sodales, gravida facilisis sem vestibulum. Sed rutrum placerat nisi. Vestibulum porttitor malesuada mollis.

                Etiam vulputate finibus semper. In ultricies velit nisl, at faucibus ante placerat eget. Praesent vehicula dictum hendrerit. Morbi augue ex, sollicitudin commodo dui iaculis, ullamcorper molestie diam. Cras ullamcorper eros vel nulla tincidunt interdum. Nullam ultrices nisl ut eleifend sagittis. Donec consectetur egestas tempus. Mauris malesuada posuere augue vitae sagittis. Ut in varius nulla. ",
                'picture' => 'kit.webp'
            ], 
            [
                'name' => "Shot Tropical", 
                'price' => 4.50,
                'shortDescription' => "Fruits frais, pressés à froid",
                'fullDescription' => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum finibus sem non luctus mollis. Mauris congue maximus velit, nec facilisis libero dignissim at. Donec id lorem sed mi vulputate viverra. Aenean venenatis sem eget consectetur bibendum. Suspendisse tristique ultrices elit vitae sodales. Vivamus pretium metus quis ligula ullamcorper finibus. Sed quis nisl a tortor consectetur ullamcorper sit amet ut urna. Nam non laoreet purus, ultrices interdum libero. Praesent vel urna suscipit, mollis sapien eget, tempor dolor. Phasellus libero eros, laoreet vitae suscipit in, tincidunt non dolor. In interdum urna non dolor sodales, gravida facilisis sem vestibulum. Sed rutrum placerat nisi. Vestibulum porttitor malesuada mollis.

                Etiam vulputate finibus semper. In ultricies velit nisl, at faucibus ante placerat eget. Praesent vehicula dictum hendrerit. Morbi augue ex, sollicitudin commodo dui iaculis, ullamcorper molestie diam. Cras ullamcorper eros vel nulla tincidunt interdum. Nullam ultrices nisl ut eleifend sagittis. Donec consectetur egestas tempus. Mauris malesuada posuere augue vitae sagittis. Ut in varius nulla. ",
                'picture' => 'tropic.webp'
            ], 
            [
                'name' => "Gourde en bois", 
                'price' => 16.90,
                'shortDescription' => "50cl, bois d'olivier",
                'fullDescription' => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum finibus sem non luctus mollis. Mauris congue maximus velit, nec facilisis libero dignissim at. Donec id lorem sed mi vulputate viverra. Aenean venenatis sem eget consectetur bibendum. Suspendisse tristique ultrices elit vitae sodales. Vivamus pretium metus quis ligula ullamcorper finibus. Sed quis nisl a tortor consectetur ullamcorper sit amet ut urna. Nam non laoreet purus, ultrices interdum libero. Praesent vel urna suscipit, mollis sapien eget, tempor dolor. Phasellus libero eros, laoreet vitae suscipit in, tincidunt non dolor. In interdum urna non dolor sodales, gravida facilisis sem vestibulum. Sed rutrum placerat nisi. Vestibulum porttitor malesuada mollis.

                Etiam vulputate finibus semper. In ultricies velit nisl, at faucibus ante placerat eget. Praesent vehicula dictum hendrerit. Morbi augue ex, sollicitudin commodo dui iaculis, ullamcorper molestie diam. Cras ullamcorper eros vel nulla tincidunt interdum. Nullam ultrices nisl ut eleifend sagittis. Donec consectetur egestas tempus. Mauris malesuada posuere augue vitae sagittis. Ut in varius nulla. ",
                'picture' => 'gourde.webp'
            ], 
            [
                'name' => "Disques Démaquillants x3", 
                'price' => 19.90,
                'shortDescription' => "Solution efficace pour vous démaquiller en douceur ",
                'fullDescription' => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum finibus sem non luctus mollis. Mauris congue maximus velit, nec facilisis libero dignissim at. Donec id lorem sed mi vulputate viverra. Aenean venenatis sem eget consectetur bibendum. Suspendisse tristique ultrices elit vitae sodales. Vivamus pretium metus quis ligula ullamcorper finibus. Sed quis nisl a tortor consectetur ullamcorper sit amet ut urna. Nam non laoreet purus, ultrices interdum libero. Praesent vel urna suscipit, mollis sapien eget, tempor dolor. Phasellus libero eros, laoreet vitae suscipit in, tincidunt non dolor. In interdum urna non dolor sodales, gravida facilisis sem vestibulum. Sed rutrum placerat nisi. Vestibulum porttitor malesuada mollis.

                Etiam vulputate finibus semper. In ultricies velit nisl, at faucibus ante placerat eget. Praesent vehicula dictum hendrerit. Morbi augue ex, sollicitudin commodo dui iaculis, ullamcorper molestie diam. Cras ullamcorper eros vel nulla tincidunt interdum. Nullam ultrices nisl ut eleifend sagittis. Donec consectetur egestas tempus. Mauris malesuada posuere augue vitae sagittis. Ut in varius nulla. ",
                'picture' => 'disque.webp'
            ], 
            [
                'name' => "Bougie Lavande & Patchouli", 
                'price' => 32,
                'shortDescription' => "Cire naturelle",
                'fullDescription' => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum finibus sem non luctus mollis. Mauris congue maximus velit, nec facilisis libero dignissim at. Donec id lorem sed mi vulputate viverra. Aenean venenatis sem eget consectetur bibendum. Suspendisse tristique ultrices elit vitae sodales. Vivamus pretium metus quis ligula ullamcorper finibus. Sed quis nisl a tortor consectetur ullamcorper sit amet ut urna. Nam non laoreet purus, ultrices interdum libero. Praesent vel urna suscipit, mollis sapien eget, tempor dolor. Phasellus libero eros, laoreet vitae suscipit in, tincidunt non dolor. In interdum urna non dolor sodales, gravida facilisis sem vestibulum. Sed rutrum placerat nisi. Vestibulum porttitor malesuada mollis.

                Etiam vulputate finibus semper. In ultricies velit nisl, at faucibus ante placerat eget. Praesent vehicula dictum hendrerit. Morbi augue ex, sollicitudin commodo dui iaculis, ullamcorper molestie diam. Cras ullamcorper eros vel nulla tincidunt interdum. Nullam ultrices nisl ut eleifend sagittis. Donec consectetur egestas tempus. Mauris malesuada posuere augue vitae sagittis. Ut in varius nulla. ",
                'picture' => 'bougie.webp'
            ], 
            [
                'name' => "Brosse à dent", 
                'price' => 5.40,
                'shortDescription' => "Bois de hêtre rouge issu de forêts gérées durablement",
                'fullDescription' => " Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum finibus sem non luctus mollis. Mauris congue maximus velit, nec facilisis libero dignissim at. Donec id lorem sed mi vulputate viverra. Aenean venenatis sem eget consectetur bibendum. Suspendisse tristique ultrices elit vitae sodales. Vivamus pretium metus quis ligula ullamcorper finibus. Sed quis nisl a tortor consectetur ullamcorper sit amet ut urna. Nam non laoreet purus, ultrices interdum libero. Praesent vel urna suscipit, mollis sapien eget, tempor dolor. Phasellus libero eros, laoreet vitae suscipit in, tincidunt non dolor. In interdum urna non dolor sodales, gravida facilisis sem vestibulum. Sed rutrum placerat nisi. Vestibulum porttitor malesuada mollis.

                Etiam vulputate finibus semper. In ultricies velit nisl, at faucibus ante placerat eget. Praesent vehicula dictum hendrerit. Morbi augue ex, sollicitudin commodo dui iaculis, ullamcorper molestie diam. Cras ullamcorper eros vel nulla tincidunt interdum. Nullam ultrices nisl ut eleifend sagittis. Donec consectetur egestas tempus. Mauris malesuada posuere augue vitae sagittis. Ut in varius nulla. ",
                'picture' => 'brosse.webp'
            ]
        ];

        foreach ($products as $productData) {
            $product = new Product();
            $product->setName($productData['name']);
            $product->setPrice($productData['price']);
            $product->setShortDescription($productData['shortDescription']);
            $product->setFullDescription($productData['fullDescription']);
            $product->setPicture($productData['picture']);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
