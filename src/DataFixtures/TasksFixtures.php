<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TasksFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i <= 10; $i++) {
             $task = new Task();
             $task->setTask($faker->paragraph);
             $task->setPriority($faker->randomElement([1, 2, 3]));
             $task->setIsCompleted($faker->boolean(50));

             $manager->persist($task);
        }
        $manager->flush();
    }
}
