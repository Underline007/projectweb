<?php

namespace App\DataFixtures;

use App\Entity\Studentmanager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentmanagerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=10; $i++) {
            $sm = new Studentmanager;
            $sm->setName("Studentmanager $i");
            $sm->setBirthday(\DateTime::createFromFormat('Y/m/d','1995/07/15'));
            $sm->setGender("female");
            $sm->setAddress("Ha Noi");
            $sm->setImage("https://eduphil.vn/wp-content/uploads/2018/12/student-manager-truong-smeag.jpg");
            $manager->persist($sm);
        }

        $manager->flush();
    }
}
