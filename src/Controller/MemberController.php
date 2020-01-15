<?php


namespace App\Controller;


use App\Entity\Person;
use App\Form\UserAccountFormType;
use App\Repository\LessonRepository;
use App\Repository\PersonRepository;
use App\Repository\TrainingRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function gegevensAction(PersonRepository $personRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Person::class)->find($this->getUser()->getId());

        return $this->render("member/gegevens.html.twig",[
            'person' => $personRepository->find($user)
        ]);
    }

    /**
     * @Route("member/gegevens/edit/{password}", name="app_member_gegevens_aanpassen")
     */
    public function gegevensEditAction(Request $request, $password , UserPasswordEncoderInterface $passwordEncoder)
    {

        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Person::class)->find($this->getUser()->getId());

        if ($password == "true")
        {
            $form = $this->createFormBuilder()
                ->add('password', PasswordType::class, array(
                    'mapped' => false,
                    'label' => 'Huidig wachtwoord'
                ))
                ->add('plainPassword', PasswordType::class , array(
                    'mapped' => false,
                    'label' => 'Nieuw wachtwoord'
                ))
//                ->add()
//                ->add()
//                ->add()
                ->getForm();


            } else {
            $form = $this->createForm(UserAccountFormType::class, $user);
        }
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($passwordEncoder->isPasswordValid($this->getUser(), $form->get('password')->getData()))
            {
                if ($password == "true")
                {
                    $user->setPassword($passwordEncoder->encodePassword(
                        $user,
                        $form['plainPassword']->getData()
                    ));
                } else {
                    $user = $form->getData();
                }

                $em->persist($user);
                $em->flush();
                $this->addFlash("success", "Aanpassing is gelukt!");
                return $this->redirectToRoute('app_member_gegevens');

            }
            else {
                $this->addFlash("danger", "Wachtwoord is incorrect");
            }
        }
        return $this->render('member/gegevensAanpassen.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("member/les-overzicht", name="app_member_lessen")
     */
    public function lessenAction(TrainingRepository $trainingRepository, LessonRepository $lessonRepository)
    {
        return $this->render("member/lessen.html.twig",[
            'trainingen' => $trainingRepository->findAll(),
            'lessons' => $lessonRepository->findAll()
        ]);
    }

    /**
     * @Route("member/lessen/aanmelden", name="app_member_les_aanmelden")
     */
    public function lesAanmeldingAction(TrainingRepository $trainingRepository, LessonRepository $lessonRepository)
    {

    }
}