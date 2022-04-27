<?php

namespace App\DataFixtures;

use App\Entity\Church;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChurchFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $church = new Church();
        $church->setName('Igreja Salvador');
        $church->setWebsite('igrejasalvador.com.br');
        $church->setAddress('Rua Numero Um, 1, Cidade 1, ES');
        $manager->persist($church);

        $church2 = new Church();
        $church2->setName('Igreja Manaim');
        $church2->setWebsite('igrejamanaim.com.br');
        $church2->setAddress('Rua Numero dois, 2, Cidade 2, ES');
        $manager->persist($church2);

        $manager->flush();


        $this->addReference('church_1', $church);
        $this->addReference('church_2', $church2);


    }
}
