<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Post;
use Faker\Generator;
use Nelmio\Alice\Fixtures;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        Fixtures::load(
            __DIR__ . '/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );
    }

    public function password()
    {
        return md5(123);
    }

    public function user()
    {
        $user_ids = range(1, 10);

        $key = rand(1, 10);

        return $user_ids[$key];
    }
}