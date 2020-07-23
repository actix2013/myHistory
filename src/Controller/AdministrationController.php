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
     * @Route("/admin/skill", name="admin_skill", methods={"GET"})
     */
    public function adminSkill(): Response
    {

        return $this->render('admin/admin.html.twig',["show"=>"skills"]);

    }

    /**
     * @Route("/admin/category", name="admin_category", methods={"GET"})
     */
    public function adminCategory(): Response
    {

        return $this->render('admin/admin.html.twig', ["show" => "category"]);

    }



/**
 * @Route("/admin/task", name="admin_task", methods={"GET"})
 */
public
function adminTask(): Response
{

    return $this->render('admin/admin.html.twig', ["show" => "task"]);

}
}
