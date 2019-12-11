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
    public function newAction(Request $request)
    {

        return $this->render("bezoeker/bezoekerHomepage.html.twig");
    }

}