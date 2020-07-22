<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $values = [
            "SOFT SKILLS" =>
            [
                "Motivé",
                "Persévérant",
                "Capacité d’adaptation",
                "Réaliste",
                "Sérieux",
            ],
            "CENTRE D'INTERETS" =>
            [
                "Informatique",
                "Lou rugby",
                "Lecture SF / Fantasy",
            ],
            "LANGUES" =>
            [
                "Francais",
                "Anglais Technique",
            ],

            "Languages" =>
                [
                    "HTML",
                    "CSS",
                    "JS",
                    "Java"
                ],
            "Shell" =>
                [
                    "Batch",
                    "Cmd",
                    "Powershell"
                ],
            "Frameworks" =>
                [
                    "Symfony",
                    "MVC",
                    "Bootstrap",
                    "Worflow Git",
                ],

            "Outils de collaboration " =>
                [
                    "Git/GitHub",
                    "Methode Agile/Scrum",

                ],

        ];

        $cat = 0;
        $skillNb = 0;
        foreach ($values as $key => $skills) {
            $category = new Category();
            $category->setName($key);
            $manager->persist($category);
            $this->addReference("category_" . $cat, $category);
            for ($a = 0; $a < count($skills); $a++) {
                    $skill = new Skill();
                    $skill->setName($skills[$a]);
                    $skill->setCategory($this->getReference("category_" . $cat));
                    $this->addReference("skill_" . $cat . "_" . $a, $skill);
                    $this->addReference("skillNb_$skillNb", $skill);
                    $skillNb++;
                    $manager->persist($skill);
            }
            $cat++;
        }
        $manager->flush();
    }
}
