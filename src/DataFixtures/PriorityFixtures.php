<?php

namespace App\DataFixtures;

use App\Entity\Priority;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class PriorityFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $priorityLow = new Priority();
        $priorityLow->setName('low');
        $manager->persist($priorityLow);
        $this->addReference('priorityLow', $priorityLow);

        $priorityNormal = new Priority();
        $priorityNormal->setName('normal');
        $manager->persist($priorityNormal);
        $this->addReference('priorityNormal', $priorityNormal);

        $priorityHigh = new Priority();
        $priorityHigh->setName('high');
        $manager->persist($priorityHigh);
        $this->addReference('priorityHigh', $priorityHigh);

        $manager->flush();
    }
}
