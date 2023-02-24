<?php

namespace App\DataFixtures;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $listAuthor = [];
        for($i=0; $i<10; $i++){
            $Author = new Author;
            $Author->setFirstName("Prénom ".$i);
            $Author->setLastName("Nom ".$i);
            $manager->persist($Author);
            $listAuthor[] = $Author;
        }
        for($i = 0;$i < 20;$i++){
            $livre = new Book;
            $livre->setTitle('Livre' .$i);
            $livre->setCoverText('Quatirème de couverture numéro : '. $i );
            $livre->setAuthor($listAuthor[array_rand($listAuthor)]);
            $manager->persist($livre);
        }
        $manager->flush();
    }
}
