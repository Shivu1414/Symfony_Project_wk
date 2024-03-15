<?php

namespace App\Controller;

use App\Entity\Unpostedjob;
use App\Entity\PublishData;
use App\Repository\UnpostedjobRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class UnpostedJobController extends AbstractController
{
    private $UnpublishData;
    private $em;
    public $session;
    public function __construct(UnpostedjobRepository $unpublishData, EntityManagerInterface $em, SessionInterface $session)
    {
        $this->session=$session;
        $this->em=$em;
        $this->UnpublishData = $unpublishData;
    }

    /**
     * @Route("/blog/{mail}", name="blog")
     */
    public function createBlog($mail): Response
    {
        return $this->render('view/createjob.html.twig',[
            'profile'=>$mail
        ]);
    }








// pagination of the unpublish data


     /**
     * @Route("/jobdata/{mail}/{page}",defaults={"page":"1"}, name="jobdata")
     */
    public function createdJob($mail, $page): Response
    {
        if($this->session->get('Id')==""){
            return $this->redirectToRoute('logout');
        }
        else{
        // $jobs=$this->UnpublishData->findAll(['email' => $mail]);
        $jobs=$this->UnpublishData->findAllPaginated($page,$mail);

        return $this->render('view/createdJobData.html.twig',[
            'jobs'=>$jobs,
            'mail'=>$mail
        ]);
        }

    }






    /**
     * @Route("/blogdata", name="blogdata")
     */
    public function blogData(Request $request): Response
    {
        $email = $request->request->get('email');
        $name = $request->request->get('name');
        $title = $request->request->get('title');
        $location = $request->request->get('location');

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
        $entityManager = $this->getDoctrine()->getManager();

        $job = new Unpostedjob();
        $job->setEmail($email);
        $job->setName($name);
        $job->setTitle($title);
        $job->setLocation($location);
        $job->setUrl($file_path);

        $entityManager->persist($job);
        $entityManager->flush();

        return $this->render('view/createjob.html.twig',[
            'profile'=>$email
        ]);
    }


    /**
     * @Route("/publishdata/{id}/{mail}", name="publishdata")
     */
    public function publishData($id,$mail): Response
    {
        // data stored in publish table
        $publish=$this->UnpublishData->findOneBy(['id' => $id]);
        $entityManager = $this->getDoctrine()->getManager();

        $pubjob= new PublishData();
        $pubjob->setName($publish->getName());
        $pubjob->setEmail($publish->getEmail());
        $pubjob->setTitle($publish->getTitle());
        $pubjob->setLocation($publish->getLocation());
        $pubjob->setUrl($publish->getUrl());  
        
        $entityManager->persist($pubjob);
        $entityManager->flush();

        // data delete from unpublish table
        $deljob=$this->UnpublishData->findOneBy(['id' => $id]);
        $this->em->remove($deljob);
        $this->em->flush();

        return $this->redirectToRoute('jobdata',['mail'=>$mail]);
        // return $this->render('view/createdJobData.html.twig',[
        //     'jobs'=>$this->UnpublishData->findAll(['email' => $mail]),
        //     'mail'=> $mail
        // ]);
    }


    /**
     * @Route("/delunpublish/{mail}/{id}", name="delunpublish")
     */
    public function delUnpublishJob($mail,$id): Response
    {
        $deljob=$this->UnpublishData->findOneBy(['id' => $id]);
        $this->em->remove($deljob);
        $this->em->flush();
        
        return $this->redirectToRoute('jobdata',['mail'=>$mail]);
    }


    /**
     * @Route("/alldelunpub/{mail}", name="alldelunpub")
     */
    public function allDelUnpublish($mail): Response
    {
        $deljobs=$this->UnpublishData->findAll(['mail' => $mail]);
        foreach($deljobs as $deljob){
           $this->em->remove($deljob);
           $this->em->flush();
        }
        return $this->redirectToRoute('jobdata',['mail'=>$mail]);

        // return $this->render('view/createdJobData.html.twig',[
        //     'jobs'=>$this->UnpublishData->findAll(['email' => $mail]),
        //     'mail'=> $mail
        // ]);
    }



    /**
     * @Route("/editjob/{id}/{mail}", name="editjob")
     */
    public function editJob($id,$mail): Response
    {
        return $this->render('view/editJob.html.twig',[
            'job'=>$this->UnpublishData->findOneBy(['id' => $id])
        ]);
    }
    

    /**
     * @Route("/updatejob/{id}", name="updatejob")
     */
    public function updateJob(Request $request, $id): Response
    {
        $email = $request->request->get('email');
        $location = $request->request->get('location');
        $title = $request->request->get('title');
        $name = $request->request->get('name');
        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(Unpostedjob::class)->find($id);

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
        if($file_name==""){
            $file_path=$post->getUrl();
        }
        // dd($email." ".$location." ".$title." ".$name." ".$file_path);
        // dd($file_path);
        $post->setEmail($email);
        $post->setName($name);
        $post->setTitle($title);
        $post->setLocation($location);
        $post->setUrl($file_path);

        $entityManager->flush();
        return $this->render('view/editJob.html.twig',[
            'job'=>$this->UnpublishData->findOneBy(['id' => $id])
        ]);

    }



    /**
     * @Route("/multidel/{mail}", name="multidel")
     */
    public function multiDel($mail): Response
    {
        if(isset($_POST['mul_delete']))
        {
            $alldels=$_POST['multiple_delete'];
            // $extract=implode(',',$all_del);
        }
        foreach($alldels as $alldel){
            $deljob=$this->UnpublishData->findOneBy(['id' => $alldel]);
            $this->em->remove($deljob);
            $this->em->flush();
         }
 
         return $this->redirectToRoute('jobdata',['mail'=>$mail]);
        //  return $this->render('view/createdJobData.html.twig',[
        //      'jobs'=>$this->UnpublishData->findAll(['email' => $mail]),
        //      'mail'=> $mail
        //  ]);
 
    }


    /**
     * @Route("/viewActivePost/{mail}/{page}", defaults={"page":"1"}, name="viewActivePost")
     */
    public function viewActivePost($mail,$page): Response
    {
        $jobs=$this->UnpublishData->findAllPaginated($page,$mail);

        return $this->render('view/userposts.html.twig',[
            'jobs'=>$jobs,
            'mail'=>$mail
        ]);
    }


    /**
     * @Route("/delActiveData/{mail}/{id}", name="delActiveData")
     */
    public function delactivedata($mail,$id): Response
    {
        $deljob=$this->UnpublishData->findOneBy(['id' => $id]);
        $this->em->remove($deljob);
        $this->em->flush();

        return $this->redirectToRoute('viewActivePost',['mail'=>$mail]);
    }


    /**
     * @Route("/alldelActiveData/{mail}", name="alldelActiveData")
     */
    public function allDelActiveData($mail): Response
    {
        $deljobs=$this->UnpublishData->findAll(['mail' => $mail]);
        foreach($deljobs as $deljob){
           $this->em->remove($deljob);
           $this->em->flush();
        }
        return $this->redirectToRoute('viewActivePost',['mail'=>$mail]);
    }

    /**
     * @Route("/muldelActiveData/{mail}", name="muldelActiveData")
     */
    public function muldelActiveData($mail): Response
    {
        if(isset($_POST['mul-del']))
        {
            $alldels=$_POST['multiple_delete'];
            // $extract=implode(',',$all_del);
        }
        foreach($alldels as $alldel){
            $deljob=$this->UnpublishData->findOneBy(['id' => $alldel]);
            $this->em->remove($deljob);
            $this->em->flush();
         }
         return $this->redirectToRoute('viewActivePost',['mail'=>$mail]); 
    }








}
