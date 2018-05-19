<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Task;
use Faker;

class TaskFixtures extends Fixture
{
    const COUNT = 100;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= self::COUNT; $i++) {

            $task = new Task();
            $task
                ->setActive(true)
                ->setDone(false)
                ->setPriority($faker->randomElement(Task::PRIORITY_TYPES))
                ->setTask($faker->text);

            $manager->persist($task);
        }

        $manager->flush();
    }
}
