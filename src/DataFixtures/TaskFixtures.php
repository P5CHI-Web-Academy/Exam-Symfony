<?php

namespace App\DataFixtures;
use Faker;
use App\Entity\Task;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TaskFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();
        $priorities = ['1', '2', '3'];
        for ($i = 0; $i < 25; $i++) {
            $task = new Task();
            $task->setPriority($faker->randomElement($priorities));
            $task->setDescription($faker->paragraph(1));
            $task->setDone(false);

            $manager->persist($task);
        }
        $manager->flush();
    }
}
