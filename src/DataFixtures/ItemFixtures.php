<?php

namespace App\DataFixtures;

use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ItemFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('en_US');
        for ($i = 0; $i < 20; $i++) {
            $item = new Item();
            $item->setNote($faker->sentence);
            $item->setDone($faker->boolean);
            $item->setPriority($this->getReference('priority' . $faker->randomElement(['Low', 'Normal', 'High'])));

            $manager->persist($item);
        }

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            PriorityFixtures::class,
        ];
    }
}
