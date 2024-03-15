<?php

namespace App\Controller;

use App\Entity\AdminSignup;
use App\Entity\Usersignup;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UsersignupRepository;
use App\Repository\PublishDataRepository;
use App\Repository\UnpostedjobRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LogController extends AbstractController
{
    private $profileData;
    private $publishJob;
    private $userjob;
    private $em;
    private $session;
    public function __construct(UsersignupRepository $profileData,UnpostedjobRepository $userjob, EntityManagerInterface $em, PublishDataRepository $publishJob, SessionInterface $session){
        $this->profileData = $profileData;
        $this->publishJob = $publishJob;
        $this->em=$em;
        $this->userjob=$userjob;
        $this->session=$session;
    }

    /**
     * @Route("/logdata", name="logdata")
     */
    public function createLogin(Request $request): Response
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');
        $check = $request->request->get('checkbox');

        if($check=="Admin"){
            $admin = $this->getDoctrine()
            ->getRepository(AdminSignup::class)
            ->findOneBy(['email' => $email]);
            if($admin){
                if($admin->getPassword()==$password)
                {
                    return $this->redirectToRoute('adminProfile');
                }
                else
                {
                    return $this->render('view/login.html.twig',[
                        'error'=>"*Incorrect Admin Password"
                    ]);
                }
            }
            else{
                // throw $this->createNotFoundException('No Admin found for this mail '.$email);
                return $this->render('view/login.html.twig',[
                    'error'=>"*Admin not Exist"
                ]);
            }
        }
        else
        {
            $this->session->set('Id',$email);
            // dd($this->session->get('Id'));

            $user = $this->getDoctrine()   // we can use this user as well for rendering the database data into twig file check and try once 
            ->getRepository(Usersignup::class)
            ->findOneBy(['email' => $email]);

            if($user){
                if($user->getPassword()==$password){             
                    $this->mail=$email;
                    return $this->render('view/userProfile.html.twig',[
                        'profile'=>$this->profileData->findOneBy(['email' => $email])
                    ]);
                }
                else{
                    return $this->render('view/login.html.twig',[
                        'error'=>"*Incorrect User Password"
                    ]);
                    }
            }
            else{
                // $session->set('value','login');
                // throw $this->createNotFoundException('No User found for this mail '.$email);
                // dd("Error");
                return $this->render('view/login.html.twig',[
                    'error'=>"*User not Exist"
                ]);
            }
        }      
    }


    /**
     * @Route("/profile_edit/{mail}", name="profile_edit")
     */
    public function profileEdit($mail): Response
    {
        return $this->render('view/profileEdit.html.twig', [
            'profile'=>$this->profileData->findOneBy(['email' => $mail])
        ]);
    }


    /**
     * @Route("/alldeladmin", name="alldeladmin")
     */
    public function allDelAdmin(): Response
    {
        $deljobs=$this->profileData->findAll();
        foreach($deljobs as $deljob){
           $this->em->remove($deljob);
           $this->em->flush();
        }

        $admin=$this->profileData->findAll();
        return $this->render('view/adminProfile.html.twig',[
            'admins'=>$admin
        ]);
    }


    /**
     * @Route("/multidelUser", name="multidelUser")
     */
    public function multiDelUser(): Response
    {
        if(isset($_POST['mul_delete']))
        {
            $alldels=$_POST['multiple_delete'];
            // $extract=implode(',',$all_del);
        }
        // dd($alldels);
        foreach($alldels as $alldel){
            $deljob=$this->profileData->findOneBy(['id' => $alldel]);
            $this->em->remove($deljob);
            $this->em->flush();
         }
        return $this->redirectToRoute('adminProfile');
    }

    

    /**
     * @Route("/activepost/{mail}", name="activepost")
     */
    public function checkActivePost(Request $request, $mail): Response
    {
        $check = $request->request->get('checkbox');
        if($check=="Active"){
            return $this->redirectToRoute('viewActivePost',['mail'=>$mail]);
        } 
        else{
            return $this->redirectToRoute('adminProfile');
        }
    }

    /**
     * @Route("/activePublishPost/{mail}", name="activePublishPost")
     */
    public function activePublishPost(Request $request, $mail): Response
    {
        $check = $request->request->get('checkbox');
        // dd($check);
        if($check=="Active"){
            return $this->redirectToRoute('viewpublishPost',['mail'=>$mail]);
        } 
        else{
            return $this->redirectToRoute('adminProfile');
        }
    }


    /**
     * @Route("/adminProfile/{page}", defaults={"page":"1"}, name="adminProfile")
     */
    public function adminprofile($page): Response
    {
        $userProfiles=$this->profileData->findAllPaginated($page);
            $Users=$this->profileData->findAll();
            $userPostCounts=[];
            $userPubPosts=[];
            foreach($Users as $User){
                $postCount=$this->userjob->count(['email'=>$User->getEmail()]);
                $userPostCounts[$User->getId()]=$postCount;
            }
            foreach($Users as $User){
                $postCount=$this->publishJob->count(['email'=>$User->getEmail()]);
                $userPubPosts[$User->getId()]=$postCount;
            }

            return $this->render('view/adminProfile.html.twig',[
                'admins'=>$userProfiles,
                'userPostCounts'=>$userPostCounts,
                'userPubPosts'=>$userPubPosts
            ]);
    }

    /**
     * @Route("/userprofile/{mail}", name="userprofile")
     */
    public function userprofile($mail): Response
    {
        return $this->render('view/userProfile.html.twig',[
            'profile'=>$this->profileData->findOneBy(['email' => $mail])
        ]);
    }


    /**
     * @Route("/logout", name="logout")
     */
    public function logout(): Response
    {
        $this->session->set('Id',"");
        // dd($this->session->get('Id'));
        return $this->render('view/login.html.twig', [
            'error' => 'User Logout'
        ]);
    }

}

?>

