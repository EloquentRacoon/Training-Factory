<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class bezoekerController extends AbstractController
{
    /**
     * @Route("/homepage", name="bezoekerHomepage")
     */
    public function homepageAction(Request $request)
    {

        return $this->render("bezoeker/homepage.html.twig");
    }

    /**
     * @Route("/contact", name="bezoekerContact")
     */
    public function contactAction()
    {
        return $this->render("bezoeker/contact.html.twig");
    }

}