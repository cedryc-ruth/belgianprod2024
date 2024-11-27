<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use \DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ActorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dataset = [
            [
                'firstname' => 'Leonardo',
                'lastname' => 'Di Caprio',
                'birthday' => '1974-11-11',
                'gender' => 'h',
            ],
            [
                'firstname' => 'Elliot',
                'lastname' => 'Page',
                'birthday' => '1987-02-21',
                'gender' => null,
            ],
            [
                'firstname' => 'Julia',
                'lastname' => 'roberts',
                'birthday' => '1967-10-28',
                'gender' => 'f',
            ],
        ];

        foreach($dataset as $data) {
            $actor = new Actor();
            $actor->setFirstname($data['firstname']);
            $actor->setLastname($data['lastname']);
            $actor->setBirthday(DateTime::createFromFormat('Y-m-d',$data['birthday']));
            $actor->setGender($data['gender']);

            $manager->persist($actor);
        }

        $manager->flush();
    }
}
