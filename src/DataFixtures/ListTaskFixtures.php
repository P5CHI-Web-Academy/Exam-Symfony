<?php


namespace App\DataFixtures;

use App\Entity\ListTask;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ListTaskFixtures extends Fixture implements OrderedFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            $listTask = new ListTask();
            $listTask->setTitle($faker->text(30));
            $listTask->setPriority($faker->numberBetween(1, 3));
            $listTask->setDone($faker->boolean);
            $manager->persist($listTask);
        }
        $manager->flush();
    }
    
    /**
     * @return int
     */
    public function getOrder(): int
    {
        return 2;
    }
}
