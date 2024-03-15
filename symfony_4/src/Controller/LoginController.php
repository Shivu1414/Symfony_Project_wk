<?php
namespace App\Controller;

use App\Entity\UserLogin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class LoginController extends AbstractController
{
    /**
     * @Route("/", name="login")
     */
    public function index(): Response
    {
        // $session->set('value','Incorrect password');
        // return $this->redirectToRoute('a_register');
        return $this->render('view/login.html.twig', [
            'error' => ''
        ]);
    }

    /**
     * @Route("/signup", name="signup")
     */
    public function register(): Response
    {
        return $this->render('view/uRegistration.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }

    /**
     * @Route("/Admin", name="admin")
     */
    public function aRegister(): Response
    {
        return $this->render('view/aRegistration.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }





}
