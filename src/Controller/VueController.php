<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VueController extends AbstractController
{
    /**
     * @Route("/vue", name="vue_index")
     */
    public function index(): Response
    {
        $words = ['sky', 'cloud', 'wood', 'rock', 'forest',
            'mountain', 'breeze', ];
        $person = [
            'firstName' => 'CtrlGuillaume',
            'lastName' => 'CtrlCavalié',
        ];

        return $this->render('vue/index.html.twig', [
            'controller_name' => 'VueController',
            'words' => $words,
            'person' => $person,
        ]);
    }
}
