<?php

namespace App\Controller;

use App\Repository\SkillRepository;
use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use App\Services\TimeCalculator;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    /**
     * @var \Symfony\Contracts\HttpClient\HttpClientInterface
     */
    private $client;

    /**
     * @var string
     */
    private $statusCode = '';

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param null|string $url
     *
     * @throws \Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface
     * @throws \Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface
     *
     * @return null|array
     */
    public function fetchGitHubInformation(?string $url): ?array
    {
        $url = $url ? $url : 'http://';
        $response = $this->client->request(
            'GET',
            $url
        );
        $response->getStatusCode();

        // $statusCode = 200
        $this->statusCode = $response->getHeaders()['content-type'][0];

        // $contentType = 'application/json'
        return $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]
    }

    /**
     * @Route("/", name="home_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository, TaskRepository $taskRepository, SkillRepository $skillRepository, TimeCalculator $timeCalculator): Response
    {
        /**
         * @var \App\Entity\User $logUser
         */
        $logUser = $this->getUser() ? $this->getUser() : $userRepository->findAll()[0];
        $result = [];
        $tasksWithGitHubRepo = $taskRepository->findTasksWithGitHubUrl('http');
        $tasksWithGitHubInfo = [];
        foreach ($tasksWithGitHubRepo as $taskGitHub) {
            $result = [
                'size' => rand(1500, 12500),
                'created_at' => '2020-05-29T05:53:28Z',
                'updated_at' => '2020-07-22T16:10:59Z',
                'contributors_url' => 'https://api.github.com/repos/WildCodeSchool/lyon-php-2003-project3-trouvetonboard/contributors',
                'html_url' => 'https://github.com/actix2013/32_Symfony_Wild-Series',
                'owner' => [
                    'login' => 'WildCodeSchool',
                    'avatar_url' => 'https://avatars3.githubusercontent.com/u/8874047?v=4',
                ],
            ];

            $contributors = [
                [
                    'login' => 'actix2013',
                    'avatar_url' => 'https://avatars1.githubusercontent.com/u/61451417?v=4',
                    'html_url' => 'https =>//github.com/actix2013',
                    'type' => 'User',
                    'site_admin' => false,
                    'contributions' => 229,
                ],
                [
                    'login' => 'Ben2669',
                    'avatar_url' => 'https://avatars3.githubusercontent.com/u/48026171?v=4',
                    'html_url' => 'https://github.com/Ben2669',
                    'type' => 'User',
                    'site_admin' => false,
                    'contributions' => 144,
                ],
            ];
            // desactivé si necesssaire pour ne pas saturé la limite de requetes github durant les tests ---------------
            //$result = $this->fetchGitHubInformation($taskGitHub->getLinkGithub());
            //$contributorUrl = $result ? $result['contributors_url'] : 'http://';
            //$contributors = $contributorUrl ? $this->fetchGitHubInformation($contributorUrl) : null;
            //----------------------------------------------------------------------------------------------------------
            $tasksWithGitHubInfo[] = [
                'response' => $result,
                'taskGitHub' => $taskGitHub,
                'contributors' => $contributors,
            ];
        }

        $softSkills = $skillRepository->findByCategory('SOFT');
        $langues = $skillRepository->findByCategory('lANGUES');
        $interets = $skillRepository->findByCategory('INTERET');

        // utilisation du  service pour le calcul et l'affectation de la duréee des missions
        $em = $this->getDoctrine()->getManager();

        $missions = $logUser->getMissions();
        foreach ($missions as $mission) {
            $startDate = $mission->getDateStart() ? $mission->getDateStart() : new DateTime('now');
            $endDate = $mission->getDateEnd() ? $mission->getDateStart() : new DateTime('now');
            $duration = $timeCalculator->calculateTime($startDate, $endDate);
            $mission->setDuration($duration);
            $em->persist($mission);
        }

        $em->flush();

        $linesArray =
            [
                [
                    'user' => 'alpha1825',
                    'textLine' => 'a aimé la competence html',
                ],
                [
                    'user' => 'beta486',
                    'textLine' => ' a aimer la compentence SCSS',
                ],
            ];

        $lines = json_encode($linesArray);

        return $this->render(
            'home/index.html.twig',
            [
                'user' => $logUser,
                'informations' => $result,
                'tasksWithGitHubInfo' => $tasksWithGitHubInfo,
                'softSkills' => $softSkills,
                'langues' => $langues,
                'interets' => $interets,
                'lines' => $lines,
            ]
        );
    }
}
