<?php

namespace App\DataFixtures;

use App\Entity\Major;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MajorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i<=5; $i++) {
            $major = new Major;
            $major->setMajorid("COM151");
            $major->setMajorname("Computing");
            $major->setTrainingtime(4);
            $major->setTrainingsystem("University");
            $manager->persist($major);
        }

        $manager->flush();

    }
}
