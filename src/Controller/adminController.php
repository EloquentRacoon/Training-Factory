<?php


namespace App\Controller;


use App\Entity\Training;
use App\Form\TrainingRegistrationFormType;
use App\Repository\LessonRepository;
use App\Repository\TrainingRepository;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class adminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin_homepage")
     */
    public function homepageAction()
    {
        return $this->render("admin/homepage.html.twig");
    }

    /**
     * @Route("admin/trainingen", name="app_admin_trainingen")
     */
    public function traingingAction(TrainingRepository $trainingRepository)
    {
        return $this->render("admin/trainingen.html.twig", [
            'trainingen' => $trainingRepository->findAll(),
        ]);
    }

    /**
     * @Route("admin/aanmaken", name="app_admin_training_aanmaken")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator)
    {
        $form = $this->createForm(TrainingRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $training = $form->getData();
            $em->persist($training);
            $em->flush();
            $this->addFlash('success', 'Training aangemaakt');

            return $this->redirectToRoute('app_admin_trainingen');
        }

        return $this->render('admin/trainingAanmaken.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/training-edit/{id}", name="app_admin_training_edit")
     */
    public function trainingEditAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $training = $em->getRepository(Training::class)->find($id);
        $form = $this->createForm(TrainingRegistrationFormType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();
            $em->persist($training);
            $em->flush();
            $this->addFlash('success', 'Training aangepast');

            return $this->redirectToRoute('app_admin_trainingen');
        }
        return $this->render('admin/trainingAanmaken.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/training-delete/{id}", name="app_admin_training_delete")
     */
    public function trainingDeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $training = $em->getRepository(Training::class)->find($id);
        $em->remove($training);
        $em->flush();
        $this->addFlash("success", "Training verwijderd");

        return $this->redirectToRoute('app_admin_trainingen');
    }
}






