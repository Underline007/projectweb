<?php

namespace App\DataFixtures;

use App\Entity\Subject;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        for($i=0;$i<=10;$i++){
            $subject = new Subject;
            $subject->setSid("PRO $i");
            $subject->setName("Progaming $i");
            $subject->setImage("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0jWcj0m4uCpUqpoVbFUz05m9Vj5qeTg_p4w&usqp=CAU");
            $manager->persist($subject);

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
