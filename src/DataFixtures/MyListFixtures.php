<?php

namespace App\DataFixtures;
use App\Entity\MyList;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;


class MyListFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void{
        $firstName = new MyList();
        $firstName->setName('Some completed task');

        $secondName = new MyList();
        $secondName->setName('Some not completed task');

        $thirdName = new MyList();
        $thirdName->setName('Lorem ipsum dolor');

        $fourthName = new MyList();
        $fourthName->setName('Adipiscing elit');

        $fifthName = new MyList();
        $fifthName->setName('Ut enim ad minim');

        $sixthName = new MyList();
        $sixthName->setName('Duis aute irure');

        $manager->persist($firstName);
        $manager->persist($secondName);
        $manager->persist($thirdName);
        $manager->persist($fourthName);
        $manager->persist($fifthName);
        $manager->persist($sixthName);

        $manager->flush();

        $this->addReference('first-name', $firstName);
        $this->addReference('second-name', $secondName);
        $this->addReference('third-name', $thirdName);
        $this->addReference('fourth-name', $fourthName);
        $this->addReference('fifth-name', $fifthName);
        $this->addReference('sixth-name', $sixthName);

    }

    /**
     * @return int
     */
    public function getOrder() : int
    {
        return 1;
    }

}
