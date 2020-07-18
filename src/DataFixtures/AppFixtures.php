<?php

namespace App\DataFixtures;

use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
//use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectManager;
use MongoDB\BSON\Timestamp;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i < 10;$i++)
        {
            $post = new Post();
            $post->setTitle("Some title {$i}");
            $post->setBody("Some text {$i}");
            $post->setTime(new \DateTime());
            $manager->persist($post);
        }

        $manager->flush();
    }
}
