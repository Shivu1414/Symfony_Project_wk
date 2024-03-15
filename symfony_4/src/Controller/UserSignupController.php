<?php

namespace App\Controller;

use App\Entity\Usersignup;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UsersignupRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserSignupController extends AbstractController
{
    private $profileData;
    private $em;
    public function __construct(UsersignupRepository $profileData, EntityManagerInterface $em){
        $this->profileData = $profileData;
        $this->em=$em;
    }


    /**
     * @Route("/signdata", name="signdata")
     */
    public function createSign(Request $request): Response
    {
        $email = $request->request->get('email');
        $pass = $request->request->get('pass1');
        $fname = $request->request->get('name');
        $lname = $request->request->get('lname');
        $phone = $request->request->get('phone');
        $gender = $request->request->get('gender');
        $about = $request->request->get('about');
        $address = $request->request->get('address');
        $country = $request->request->get('country');
        $state = $request->request->get('state');
        $city = $request->request->get('city');
        $pincode = $request->request->get('pincode');
         
        if(isset($_FILES['fileToUpload'])){
            $file_name=$_FILES['fileToUpload']['name'];
            $file_size=$_FILES['fileToUpload']['size'];
            $file_tmp=$_FILES['fileToUpload']['tmp_name'];
            $file_type=$_FILES['fileToUpload']['type'];
            $file_path="/download/".$file_name;

            $uploadDir = $_SERVER['DOCUMENT_ROOT']."/download/";
            $uploadFile = $uploadDir.basename($file_name);
            move_uploaded_file($file_tmp,$uploadFile);
        }
        // dd($country);
        // dd($ctr);
        // dd($state);
        // dd($city);

        $user = $this->getDoctrine()
        ->getRepository(Usersignup::class)
        ->findOneBy(['email' => $email]);
        if($user=="")
        {
            $entityManager = $this->getDoctrine()->getManager();

            $product = new Usersignup();
            $product->setEmail($email);
            $product->setPassword($pass);
            $product->setFirstname($fname);
            $product->setLastname($lname);
            $product->setPhone($phone);
            $product->setGender($gender);
            $product->setAbout($about);
            $product->setAddress($address);
            $product->setCountry($country);
            $product->setState($state);        
            $product->setCity($city);
            $product->setPincode($pincode);
            $product->setUrl($file_path);
    
            $entityManager->persist($product);
    
            $entityManager->flush();
            // return $this->redirectToRoute('login');   
            return $this->render('view/login.html.twig',[
                'error'=>"User Signup Done Successdully"
            ]);

        }
        else
        {
            return $this->render('view/login.html.twig',[
                'error'=>"User Already Exist"
            ]);
        }
    }





    /**
     * @Route("/EditProfileData/{id}", name="EditProfileData")
     */
    public function editProfileData(Request $request, $id): Response
    {
        $email = $request->request->get('email');
        $fname = $request->request->get('fname');
        $lname = $request->request->get('lname');
        $phone = $request->request->get('phone');
        $gender = $request->request->get('gender');
        $about = $request->request->get('about');
        $address = $request->request->get('address');
        $country = $request->request->get('country');
        $state = $request->request->get('state');
        $city = $request->request->get('city');
        $pincode = $request->request->get('pincode');

        $entityManager = $this->getDoctrine()->getManager();
        $person = $entityManager->getRepository(Usersignup::class)->find($id);

        if(isset($_FILES['fileToUpload'])){
            $file_name=$_FILES['fileToUpload']['name'];
            $file_size=$_FILES['fileToUpload']['size'];
            $file_tmp=$_FILES['fileToUpload']['tmp_name'];
            $file_type=$_FILES['fileToUpload']['type'];
            $file_path="/download/".$file_name;

            $uploadDir = $_SERVER['DOCUMENT_ROOT']."/download/";
            $uploadFile = $uploadDir.basename($file_name);
            move_uploaded_file($file_tmp,$uploadFile);
        }

        // dd($email." ".$fname." ".$lname." ".$phone." ".$gender." ".$about." ".$address." ".$country." ".$state." ".$city." ".$pincode." ".$file_path);
        if($file_name==""){
            $file_path=$person->getUrl();
        }
        // dd($file_path);
        $person->setEmail($email);
        $person->setFirstname($fname);
        $person->setLastname($lname);
        $person->setPhone($phone);
        $person->setGender($gender);
        $person->setAbout($about);
        $person->setAddress($address);
        $person->setCountry($country);
        $person->setState($state);        
        $person->setCity($city);
        $person->setPincode($pincode);
        $person->setUrl($file_path);

        // $entityManager->persist($edit);

        $entityManager->flush();
        return $this->render('view/userProfile.html.twig',[
            'profile'=>$this->profileData->findOneBy(['email' => $email])
        ]);

    }


}
