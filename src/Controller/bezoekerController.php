<?php


namespace App\Controller;


use App\Entity\Training;
use App\Repository\LessonRepository;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class bezoekerController extends AbstractController
{
    /**
     * @Route("/homepage", name="app_bezoeker_homepage")
     */
    public function homepageAction()
    {

        return $this->render("bezoeker/homepage.html.twig");
    }

    /**
     * @Route("/contact", name="app_bezoeker_contact")
     */
    public function contactAction()
    {
        return $this->render("bezoeker/contact.html.twig");
    }

    /**
     * @Route("/gedragsregels", name="app_bezoeker_regels")
     */
    public function regelsAction()
    {
        return $this->render("bezoeker/gedragsRegels.html.twig");
    }

    /**
     * @Route("/training-aanbod", name="app_bezoeker_training_aanbod")
     */
    public function trainingAanbodAction(TrainingRepository $trainingRepository){

        return $this->render("bezoeker/trainingAanbod.html.twig",[
            'trainingen' => $trainingRepository->findAll()
        ]);
    }
}
