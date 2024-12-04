<?php

namespace App\DataFixtures;

use App\Entity\Movie;
//use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $dataset = [
            [
                'title' => 'Inception',
                'description' => 'L\'histoire d\'un braquage dans un rêve.',
                'category' => 'action',
                'actors' => [
                    [
                        'firstname' => 'Leonardo',
                        'lastname' => 'Di Caprio'
                    ],
                    [
                        'firstname' => 'Elliot',
                        'lastname' => 'Page'
                    ],
                ],
            ],
            [
                'title' => 'Gladiator',
                'description' => 'L\'histoire d\'un héros dans l\'arène.',
                'category' => 'action',
                'actors' => [
                    [
                        'firstname' => 'Russel',
                        'lastname' => 'Crowe'
                    ],
                    [
                        'firstname' => 'Connie',
                        'lastname' => 'Nielsen'
                    ],
                ],
            ],
            [
                'title' => 'Erin Brockovitch',
                'description' => 'L\'histoire d\'une héroïne des temps modernes.',
                'category' => 'drame',
                'actors' => [
                    [
                        'firstname' => 'Julia',
                        'lastname' => 'Roberts'
                    ],
                ],
            ],
            [
                'title' => 'BXL',
                'description' => null,
                'category' => 'drame',
                'actors' => [],
            ],
        ];

        foreach($dataset as $data) {
            //Retrouver la catégorie du film
            //$category = $manager->getRepository(Category::class)->findOneByName($data['category']);
            $category = $this->getReference($data['category']);

            //Créer le film
            $movie = new Movie();
            $movie->setTitle($data['title']);
            $movie->setDescription($data['description']);
            $movie->setCategory($category);

            foreach($data['actors'] as $d) {
                $actor = $this->getReference($d['firstname'].'-'.$d['lastname']);

                $movie->addActor($actor);
            }

            $manager->persist($movie);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            ActorFixtures::class,
        ];
    }
}
