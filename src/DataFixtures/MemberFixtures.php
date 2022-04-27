<?php

namespace App\DataFixtures;

use App\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MemberFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $member = new Member();
        $member->setName('João Silva');
        $member->setCPF('12345678901');
        $member->setBirthday(\DateTime::createFromFormat('Y-m-d H:i:s', '1990-12-15 00:00:00'));
        $member->setEmail('joaosilva@email.com');
        $member->setTelephone('(27)12345-6789');
        $member->setAddress('Rua Bem-Te-Vi, 300');
        $member->setCity('Vitória');
        $member->setState('ES');

        $member->setChurch($this->getReference('church_1'));

        $manager->persist($member);

        $member2 = new Member();
        $member2->setName('Pedro da Costa');
        $member2->setCPF('12345678902');
        $member2->setBirthday(\DateTime::createFromFormat('Y-m-d H:i:s', '1990-12-15 00:00:00'));
        $member2->setEmail('pedrocosta@email.com');
        $member2->setTelephone('(27)12345-4321');
        $member2->setAddress('Rua Canário, 55');
        $member2->setCity('Vitória');
        $member2->setState('ES');

        $member2->setChurch($this->getReference('church_2'));

        $manager->persist($member2);


        $manager->flush();
    }
}
