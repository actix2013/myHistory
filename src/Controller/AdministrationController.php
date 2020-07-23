<?php


namespace App\Controller;


use App\Repository\TaskRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrationController extends AbstractController
{


    /**
     * @Route("/admin/skills", name="admin_skills", methods={"GET"})
     */
    public function adminSkills(): Response
    {

        return $this->render('admin/admin.html.twig',["show"=>"skills"]);

    }
}
