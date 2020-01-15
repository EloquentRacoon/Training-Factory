<?php


namespace App\Controller;


use App\Entity\Training;
use App\Form\UserRegistrationFormType;
use App\Repository\LessonRepository;
use App\Repository\TrainingRepository;
use App\Security\LoginFormAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


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

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/accessDenied", name="app_access_denied")
     */
    public function accessDenied()
    {
        return $this->render('security/accessDenied.html.twig');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        $this->addFlash('success','Logged out!');
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/aanmelden", name="app_aanmelden")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $formAuthenticator)
    {
        $form = $this->createForm(UserRegistrationFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $user = $form->getData();
            $user->setRoles(array("ROLE_MEMBER"));
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form['plainPassword']->getData()
            ));
            $em->persist($user);
            $em->flush();
            $this->addFlash('success','Account aangemaakt');

            return $this->redirectToRoute('app_bezoeker_homepage');
        }

        return $this->render('bezoeker/aanmelden.html.twig', [
            'registrationForm' => $form->createView(),
        ]);

    }

}
