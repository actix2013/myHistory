<?php


namespace App\Controller;


use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $logUser = $this->getUser() ? $this->getUser() : $userRepository->findAll()[0];


        return $this->render('home/index.html.twig',
            [
                "user" => $logUser,
                ]
        );
    }


}
