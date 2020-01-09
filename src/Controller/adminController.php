<?php


namespace App\Controller;


use App\Repository\LessonRepository;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class adminController extends AbstractController
{
    /**
     *@Route("/admin", name="app_admin_homepage")
     */
    public function homepageAction()
    {
        return $this->render("admin/homepage.html.twig");
    }

    /**
     * @Route("admin/trainingen", name="app_admin_trainingen")
     */
    public function traingingAction(TrainingRepository $trainingRepository, LessonRepository $lessonRepository)
    {
        return $this->render("admin/trainingen.html.twig",[
            'trainingen' => $trainingRepository->findAll(),


            ]);
    }



}