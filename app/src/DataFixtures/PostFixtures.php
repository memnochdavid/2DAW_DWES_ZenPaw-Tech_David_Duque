<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $posts = [
            [
                'title' => 'Mi primer post en Symfony 8',
                'slug' => 'mi-primer-post',
                'autor' => 'david',
                'summary' => 'Hoy empiezo mi aventura con el framework PHP más potente.',
                'content' => "Symfony es genial porque nos da herramientas como el MakerBundle.\n\nEn este blog aprenderemos mucho sobre Docker y Twig.",
                'categories' => [3, 4]
            ],
            [
                'title' => '¿Por qué usar Docker?',
                'slug' => 'ventajas-docker',
                'autor' => 'david',
                'summary' => 'Docker nos permite tener entornos idénticos en cualquier PC.',
                'content' => "Olvídate de 'en mi máquina funciona'.\n\nCon Docker Compose, levantamos la base de datos y el servidor en segundos.",
                'categories' => [0, 2]
            ],
            [
                'title' => 'Twig: El motor de plantillas',
                'slug' => 'twig-tutorial',
                'autor' => 'pepe',
                'summary' => 'Aprende a separar la lógica de negocio de la visualización.',
                'content' => "Twig es elegante, rápido y seguro.\n\nPermite herencia de plantillas, lo que nos ahorra mucho código repetido.",
                'categories' => [1, 4]
            ]
        ];

        foreach ($posts as $data) {
            $post = new Post();
            $post->setTitle($data['title']);
            $post->setSlug($data['slug']);
            $post->setAutor($data['autor']);
            $post->setSummary($data['summary']);
            $post->setContent($data['content']);
            $post->setPublishedAt(new \DateTimeImmutable());

            foreach ($data['categories'] as $categoryIndex) {
                $post->addCategory($this->getReference('category_' . $categoryIndex, Category::class));
            }

            $manager->persist($post);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
