<?php


namespace App\Controller;


use App\Entity\Person;
use App\Form\UserRegistrationFormType;
use App\Repository\PersonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends AbstractController
{
    /**
     * @Route("member", name="app_member_homepage")
     */
    public function homepageAction()
    {
        Return $this->render("member/homepage.html.twig");
    }

    /**
     * @Route("member/gegevens", name="app_member_gegevens")
     */
    public function gegevensAction(Request $request, PersonRepository $personRepository)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Person::class)->find($this->getUser()->getId());
        $form = $this->createForm(UserRegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'user updated');

            return $this->redirectToRoute('app_member_gegevens');
        }
        return $this->render('member/gegevens.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

}