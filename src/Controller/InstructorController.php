<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class InstructorController extends AbstractController
{
    /**
     *@Route("instructor", name="app_instructor_homepage")
     */
    public function homepageAction()
    {
        return $this->render("instructor/homepage.html.twig");
    }
}


