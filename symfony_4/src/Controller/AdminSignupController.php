<?php

namespace App\Controller;

use App\Entity\AdminSignup;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminSignupController extends AbstractController
{
    /**
     * @Route("/admin_signdata", name="admin_signdata")
     */
    public function createSign(Request $request): Response
    {
        $email = $request->request->get('email');
        $pass = $request->request->get('pass1');
        $name = $request->request->get('name');

        $admin = $this->getDoctrine()
        ->getRepository(AdminSignup::class)
        ->findOneBy(['email' => $email]);
        if($admin=="")
        {
            $entityManager = $this->getDoctrine()->getManager();

            $product = new AdminSignup();
            $product->setEmail($email);
            $product->setPassword($pass);
            $product->setName($name);
    
            // tell Doctrine you want to (eventually) save the Product (no queries yet)
            $entityManager->persist($product);
    
            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();
            // return $this->redirectToRoute('login');  
            return $this->render('view/login.html.twig',[
                'error'=>"Admin Signup Done Successfully"
            ]);  
        }
        else
        {
            return $this->render('view/login.html.twig',[
                'error'=>"Admin Already Exist"
            ]);
        }
    }
}
