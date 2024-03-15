<?php

namespace App\Controller;

use App\Entity\Unpostedjob;
use App\Entity\PublishData;
use App\Repository\UnpostedjobRepository;
use App\Repository\PublishDataRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserIconApageController extends AbstractController
{
    private $UnpublishData;
    private $publishJob;
    private $em;
    public function __construct(UnpostedjobRepository $unpublishData, EntityManagerInterface $em, PublishDataRepository $publishJob)
    {
        $this->em=$em;
        $this->UnpublishData = $unpublishData;
        $this->publishJob = $publishJob;
    }

    /**
     * @Route("/auserPub/{mail}/{id}", name="auserPub")
     */
    public function aUserPub($mail,$id): Response
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

        return $this->redirectToRoute('viewActivePost',['mail'=>$mail]);
    }

    /**
     * @Route("/editActivePost/{id}/{mail}", name="editActivePost")
     */
    public function editActivePost($id,$mail): Response
    {
        return $this->render('view/editActivePost.html.twig',[
            'job'=>$this->UnpublishData->findOneBy(['id' => $id])
        ]);
    }

    /**
     * @Route("/updateActivejob/{id}", name="updateActivejob")
     */
    public function updateActivejob(Request $request, $id): Response
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
        return $this->render('view/editActivePost.html.twig',[
            'job'=>$this->UnpublishData->findOneBy(['id' => $id])
        ]);
    }

    /**
     * @Route("/alldelPubActiveData/{mail}", name="alldelPubActiveData")
     */
    public function alldelPubActiveData($mail): Response
    {
        $deljobs=$this->publishJob->findAll(['mail' => $mail]);
        foreach($deljobs as $deljob){
           $this->em->remove($deljob);
           $this->em->flush();
        }
        return $this->redirectToRoute('viewpublishPost',['mail'=>$mail]);
    }

    /**
     * @Route("/muldelActivePubData/{mail}", name="muldelActivePubData")
     */
    public function muldelActivePubData($mail): Response
    {
        if(isset($_POST['mul-del']))
        {
            $alldels=$_POST['multiple_delete'];
            // $extract=implode(',',$all_del);
        }
        // dd($alldels);
        foreach($alldels as $alldel){
            $deljob=$this->publishJob->findOneBy(['id' => $alldel]);
            $this->em->remove($deljob);
            $this->em->flush();
         }
         return $this->redirectToRoute('viewpublishPost',['mail'=>$mail]);
    }

    /**
     * @Route("/delActivePubData/{mail}/{id}", name="delActivePubData")
     */
    public function delActivePubData($mail,$id): Response
    {
        $deljob=$this->publishJob->findOneBy(['id' => $id]);
        $this->em->remove($deljob);
        $this->em->flush();

        return $this->redirectToRoute('viewpublishPost',['mail'=>$mail]);
    }


    /**
     * @Route("/auserUnpub/{mail}/{id}", name="auserUnpub")
     */
    public function auserUnpub($mail,$id): Response
    {
        // data stored in unpublish table
        $unpublish=$this->publishJob->findOneBy(['id' => $id]);
        $entityManager = $this->getDoctrine()->getManager();

        $unpubjob= new Unpostedjob();
        $unpubjob->setName($unpublish->getName());
        $unpubjob->setEmail($unpublish->getEmail());
        $unpubjob->setTitle($unpublish->getTitle());
        $unpubjob->setLocation($unpublish->getLocation());
        $unpubjob->setUrl($unpublish->getUrl());  
        
        $entityManager->persist($unpubjob);
        $entityManager->flush();

        // data delete from publish table
        $deljob=$this->publishJob->findOneBy(['id' => $id]);
        $this->em->remove($deljob);
        $this->em->flush();

        return $this->redirectToRoute('viewpublishPost',['mail'=>$mail]);
    }

    /**
     * @Route("/editActivePubPost/{id}/{mail}", name="editActivePubPost")
     */
    public function editActivePubPost($id,$mail): Response
    {
        return $this->render('view/editActivePubPost.html.twig',[
            'job'=>$this->publishJob->findOneBy(['id' => $id])
        ]);
    }

    /**
     * @Route("/updateActivePubjob/{id}", name="updateActivePubjob")
     */
    public function updateActivePubjob(Request $request, $id): Response
    {
        $email = $request->request->get('email');
        $location = $request->request->get('location');
        $title = $request->request->get('title');
        $name = $request->request->get('name');

        $entityManager = $this->getDoctrine()->getManager();
        $post = $entityManager->getRepository(PublishData::class)->find($id);

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
        return $this->render('view/editActivePubPost.html.twig',[
            'job'=>$this->publishJob->findOneBy(['id' => $id])
        ]);
    }





}
