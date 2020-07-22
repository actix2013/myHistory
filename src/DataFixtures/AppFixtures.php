<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Skill;
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

        $experiences = [
            "Wild Code School" =>
                [
                    "En cours", // date end
                    "01/03/2020", // date start
                    "69", // departement
                    "experience",
                    "Projet 1 : HTML / CSS / PHP / CSV / Database", // exp one
                    "Projet 2 : BootStrap / PHP /JS / Database", // exp two
                    "Projet 3 : BootStrap / PHP / JS / SCSS / Symfony / Databas", // exp 3
                ],
            "Wild Code School" =>
                [
                    "Projet 1 : HTML / CSS / PHP / CSV / Database",
                    "Projet 2 : BootStrap / PHP /JS / Database",
                    "Projet 2 : BootStrap / PHP /JS / Database",
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
