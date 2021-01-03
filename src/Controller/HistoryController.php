<?php

namespace App\Controller;

use App\Entity\History;
use App\Repository\HistoryRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
     * @Route("/api/history", name="history_get",  methods={"GET"})
     *
     * //    @param Request $request
     * //    @param SerializerInterface $serializer
     */
    public function getHistory(/*Request $request, SerializerInterface $serializer*/): Response
    {

        /**
         * @var History $lastHistory
         */
        $lastHistory = $this->historyRepository->findOneBy([], ['id' => 'desc']);
        $response = new JsonResponse();
        $objJson = json_encode($lastHistory);
        $response->setData(['data' => $objJson]);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/history", name="history_post", methods={"POST"})
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
            return new Response('Not authorized server is busy, wait '.(5 - $diffLastTimeStamp).' seconds before retry');
        }

        $data = $request->getContent();
        if (null == $data) {
            return new Response('unable to read data');
        }
        $history = $serializer->deserialize($data, History::class, 'json');
        $history->setHost($request->getHost());
        $this->getDoctrine()->getManager()->persist($history);
        $this->getDoctrine()->getManager()->flush();

        $response = new Response();

        $response->setContent('<html><body><h1>request accepted and save ok</h1></body></html>');
        $response->setStatusCode(Response::HTTP_OK);

// sets a HTTP response header
        $response->headers->set('Content-Type', 'text/html');

// prints the HTTP headers followed by the content
        $response->send();
    }


}
