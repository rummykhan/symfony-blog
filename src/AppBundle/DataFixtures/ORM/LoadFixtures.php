<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User\Role;
use DateTime;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Post;
use Faker\Generator;
use Nelmio\Alice\Fixtures;
use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;

class LoadFixtures implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $this->addRoles($manager);

        Fixtures::load(
            __DIR__ . '/fixtures.yml',
            $manager,
            [
                'providers' => [$this]
            ]
        );

        $this->addRolesToUsers($manager);
    }

    private function addRoles(ObjectManager $manager)
    {
        $roles = [
            'USER', 'ADMIN'
        ];

        foreach ($roles as $role_name) {
            $role = new Role();
            $role->setName($role_name);
            $role->setCreatedAt(new DateTime());
            $manager->persist($role);
            $manager->flush();
        }
    }

    private function addRolesToUsers(ObjectManager $manager)
    {
        $role = $manager->getRepository('AppBundle:User\Role')
            ->findOneBy(['name' => 'USER']);

        $users = $manager->getRepository('AppBundle:User')
            ->findAll();

        foreach ($users as $user) {
            $user->addRoles($role);
            $manager->persist($user);
            $manager->flush();
        }
    }

    public function password()
    {
        $provider = new MessageDigestPasswordEncoder();
        return $provider->encodePassword(123, md5('rummykhan'));
    }

    public function user()
    {
        $user_ids = range(1, 10);

        $key = rand(1, 10);

        return $user_ids[$key];
    }

    public function salt()
    {
        return md5('rummykhan');
    }

    public function roleName()
    {
        return 'ROLE_USER';
    }
}