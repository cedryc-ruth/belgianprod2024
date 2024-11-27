<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class MovieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $dataset = [
            [
                'title' => 'Inception',
                'description' => 'L\'histoire d\'un braquage dans un rêve.',
                'category' => 'action',
            ],
            [
                'title' => 'Gladiator',
                'description' => 'L\'histoire d\'un héros dans l\'arène.',
                'category' => 'action',
            ],
            [
                'title' => 'Erin Brockovitch',
                'description' => 'L\'histoire d\'une héroïne des temps modernes.',
                'category' => 'drame',
            ],
            [
                'title' => 'BXL',
                'description' => null,
                'category' => 'drame',
            ],
        ];

        foreach($dataset as $data) {
            $movie = new Movie();
            $movie->setTitle($data['title']);
            $movie->setDescription($data['description']);
            $movie->setCategory($data['category']);

            $manager->persist($movie);
        }

        $manager->flush();
    }
}
