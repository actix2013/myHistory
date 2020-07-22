<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Mission;
use App\Entity\Skill;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AppFixtures extends Fixture
{


    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

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
                    "2020-07-31", // date end
                    "2020-03-01", // date start
                    "69", // departement
                    "", // comment
                    "https://www.wildcodeschool.com/fr-FR", // linkEstablishment
                    "Projet 1", // exp one
                    "Projet 2", // exp two
                    "Projet 3", // exp 3
                ],
            "Evos-Infogerance" =>
                [
                    "2020-02-28", // date end
                    "2017-01-01", // date start
                    "69", // departement
                    "", // comment
                    "http://www.evos-infogerance.fr/", // linkEstablishment
                    "Systeme", // exp one
                    "Reseau", // exp two
                    "Infogerance", // exp two
                ],
        ];

        // vcreation des skills et categories
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
        // creation du  user
        $user = new User();
        $user->setPassword($this->passwordEncoder->encodePassword($user, "pwd"));
        $user->setFirstName("Guillaume");
        $user->setLastName("Cavalié");
        $user->setAge(38);
        $user->setActive(true);
        $user->setAddressCity("Lyon");
        $user->setNbChild(1);
        $user->setMobile("0663181008");
        $user->setEmail("gca@moncv.fr");
        $this->addReference("gca",$user);
        // creation des missions de type expériences, task  et association des skills
        $numTask = 0;
        $numMission = 0 ;
        foreach ($experiences as $aMission => $details) {
            $mission = new Mission();
            $mission->setType("experience");
            $mission->setTitle($aMission);
            $mission->setEstablishmentName($aMission);
            $mission->setDateStart(new \DateTime($details[1]));
            $mission->setDateEnd(new \DateTime($details[0]));
            $mission->setComment($details[3]);
            $mission->setEstablishmentDepartmentNb($details[2]);
            $mission->setLinkEstablishment($details[4]);
            for($i = 5;$i < count($details); $i++) {
                $task = new Task();
                $task->setName($details[$i]);
                $task->setLinkGithub("");
                $task->setLinkWebsite("");
                $task->addSkill($this->getReference("skillNb_" . rand(0,$skillNb-1)));
                $task->addSkill($this->getReference("skillNb_" . rand(0, $skillNb-1)));
                $task->addSkill($this->getReference("skillNb_" . rand(0, $skillNb-1)));
                $manager->persist($task);
                $this->addReference("task_$numTask", $task);
                $mission->addTask($this->getReference("task_$numTask"));
                $numTask++;
            }
            $manager->persist($mission);
            $this->addReference("mission_$numMission",$mission);
            $user->addMission($this->getReference("mission_$numMission"));
            $numMission++;
        }
        $manager->persist($user);
        $manager->flush();
    }
}
