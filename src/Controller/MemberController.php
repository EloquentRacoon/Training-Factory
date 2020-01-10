<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("member", name="app_member_homepage")
     */
    public function homepageAction(){
        Return $this->render("member/homepage.html.twig");
    }

}