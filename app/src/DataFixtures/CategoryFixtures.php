<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const CATEGORY_REFERENCES = [
        'Tecnología',
        'Programación',
        'Docker',
        'Symfony',
        'Tutoriales',
        'Noticias',
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORY_REFERENCES as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('category_' . $key, $category);
        }

        $manager->flush();
    }
}
