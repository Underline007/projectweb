<?php

namespace App\DataFixtures;

use App\Entity\Teacher;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TeacherFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0;$i<=10;$i++){
            $teacher = new Teacher;
            $teacher->setTid("GC $i");
            $teacher->setName("Teacher $i");
            $teacher->setBirthday(\DateTime::createFromFormat('Y/m/d','1985/2/13'));
            $teacher->setImage("https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ0jWcj0m4uCpUqpoVbFUz05m9Vj5qeTg_p4w&usqp=CAU");
            $manager->persist($teacher);

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
