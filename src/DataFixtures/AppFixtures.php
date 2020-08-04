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
                    [
                        "projet" => "projet 1",
                        "title" => "Golden-Retro",
                        "github" => "https://api.github.com/repos/actix2013/lyon-0320-golden-retro",
                    ],
                    [
                        "projet" => "projet 2",
                        "title" => "SetMind",
                        "github" => "https://api.github.com/repos/actix2013/lyon-php-2003-project2-setmind",
                    ],// exp two
                    [
                        "projet" => "projet 3",
                        "title" => "TrouveTonBoard",
                        "github" => "https://api.github.com/repos/WildCodeSchool/lyon-php-2003-project3-trouvetonboard",
                    ],
                    [
                        "projet" => "projet 4",
                        "title" => "MyHistory",
                        "github" => "https://api.github.com/repos/actix2013/myHistory",
                    ],// exp 3
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
        $user->setPassword($this->passwordEncoder->encodePassword($user, "password"));
        $user->setFirstName("Guillaume");
        $user->setLastName("Cavalié");
        $user->setAge(38);
        $user->setActive(true);
        $user->setAddressCity("Lyon");
        $user->setNbChild(1);
        $user->setMobile("0663180810");
        $user->setEmail("guillaume@moncv.fr");
        $user->setProfil('
                        Après un début de carrière dans l’IT coté infrastructure, j’ai fait le choix de me reconvertir vers du développement d’application web.</br>
                        En   formation au sein de la Wild Code School, je fais évoluer mes compétences vers un nouveau domaine technique riche et passionnant.</br>
                        De Powershell, je passe à PHP. </br>
                        De Kaseya, je passe à GIT.  </br>
                        De vMware, je passe à Docker.  </br>
                        De l’approche ITIL, je passe à l’Agilité …. </br>
        ');
        $this->addReference("gca", $user);
        // creation des missions de type expériences, task  et association des skills
        $numTask = 0;
        $numMission = 0;
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
            for ($i = 5; $i < count($details); $i++) {
                $task = new Task();
                $val = $details[$i];
                var_dump("_____________________");
                var_dump($details[$i]);
                if(is_array($val)) {
                    $task->setName($val["projet"]);
                    $task->setLinkGithub($val["github"]);
                } else {
                    $task->setName($val);
                    $task->setLinkGithub("");
                }
                $task->setLinkWebsite("");
                $task->addSkill($this->getReference("skillNb_" . rand(0, $skillNb - 1)));
                $task->addSkill($this->getReference("skillNb_" . rand(0, $skillNb - 1)));
                $task->addSkill($this->getReference("skillNb_" . rand(0, $skillNb - 1)));
                $manager->persist($task);
                $this->addReference("task_$numTask", $task);
                $mission->addTask($this->getReference("task_$numTask"));
                $numTask++;
            }
            $manager->persist($mission);
            $this->addReference("mission_$numMission", $mission);
            $user->addMission($this->getReference("mission_$numMission"));
            $numMission++;
        }
        $manager->persist($user);
        $manager->flush();
    }

}
