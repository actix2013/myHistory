<?php

namespace App\Controller;

use App\Entity\History;
use App\Repository\HistoryRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HistoryController extends AbstractController
{
    /**
     * @var HistoryRepository
     */
    private $historyRepository;

    /**
     * HistoryController constructor.
     *
     * @param HistoryRepository $historyRepository
     */
    public function __construct(HistoryRepository $historyRepository)
    {
        $this->historyRepository = $historyRepository;
    }

    /**
     * @Route("/history", name="history")
     */
    public function index(): string
    {
        return $this->render('history/index.html.twig', [
            'controller_name' => 'HistoryController',
        ]);
    }

    /**
     * @Route("/api/history", name="history")
     *
     * @param Request             $request
     * @param SerializerInterface $serializer
     */
    public function postHistory(Request $request, SerializerInterface $serializer): Response
    {
        /**
         * @var History $lastHistory
         */

        $lastHistory = $this->historyRepository->findOneBy([], ['id' => 'desc']);
        $now = new DateTime('now');
        $diffLastTimeStamp = $now->getTimestamp() - $lastHistory->getTimestamp();
        if ($diffLastTimeStamp < 5) {
            return new Response('Not autorized server is buzy, wait '.(5 - $diffLastTimeStamp).' seconds before retry');
        }

        $data = $request->query->get('history');
        return dd($request);
        /**
         * @var History $history
         */
        $history = $serializer->deserialize($data, History::class, 'json');
        return dd($history);
        $history->setHost($request->getHost());

        $this->getDoctrine()->getManager()->persist($history);
        $this->getDoctrine()->getManager()->flush();

        return dd($history);
    }
}
