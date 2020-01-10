<?php


namespace App\Controller;


use App\Entity\Lesson;
use App\Form\LessonRegistrationFormType;
use App\Repository\LessonRepository;
use App\Repository\TrainingRepository;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;


class InstructorController extends AbstractController
{
    /**
     *@Route("instructor", name="app_instructor_homepage")
     */
    public function homepageAction()
    {
        return $this->render("instructor/homepage.html.twig");
    }

    /**
     * @Route("instructor/beheer", name="app_instructor_beheer")
     */
    public function beheerAction(TrainingRepository $trainingRepository, LessonRepository $lessonRepository)
    {
        return $this->render("instructor/beheer.html.twig",[
            'trainingen' => $trainingRepository->findAll(),
            'lessons' => $lessonRepository->findAll()
        ]);
    }

    /**
     *@Route("instructor/toevoegen", name="app_instructor_les_toevoegen")
     */
    public function toevoegAction(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator)
    {
        $form = $this->createForm(LessonRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $training = $form->getData();
            $em->persist($training);
            $em->flush();
            $this->addFlash('success', 'training created');

            return $this->redirectToRoute('app_instructor_beheer');
        }
        return $this->render("instructor/lesson.html.twig",[
        'registrationForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/instructor/lesson-delete/{id}", name="app_instructor_lesson_delete")
     */
    public function lessonDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $training = $em->getRepository(Lesson::class)->find($id);
        $em->remove($training);
        $em->flush();
        $this->addFlash("success", "les verwijderd");

        return $this->redirectToRoute('app_instructor_beheer');
    }
}


