<?php

namespace App\Controller;

use App\Entity\PublishData;
use App\Repository\UnpostedjobRepository;
use App\Repository\PublishDataRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PublishedJobController extends AbstractController
{
    private $publishData;
    private $UnpublishData;
    private $em;

    public function __construct(PublishDataRepository $publishData, UnpostedjobRepository $unpublishData, EntityManagerInterface $em)
    {
        $this->publishData = $publishData;
        $this->UnpublishData = $unpublishData;
        $this->em=$em;
    }

    /**
     * @Route("/publish/{mail}/{page}", defaults={"page":"1"}, name="publish")
     */
    public function publishedJob($mail,$page): Response
    {
        $jobs=$this->publishData->findAllPaginated($page,$mail);

        return $this->render('view/publishedJob.html.twig',[
            'jobs'=>$jobs,
            'mail'=>$mail
        ]);
    }
    

    /**
     * @Route("/unpublish/{mail}", name="unpublish")
     */
    public function unpublishJob($mail): Response
    {
        return $this->redirectToRoute('jobdata',['mail'=>$mail]);
    }


    /**
     * @Route("/delpublish/{mail}/{id}", name="delpublish")
     */
    public function delPublishJob($mail,$id): Response
    {
        $deljob=$this->publishData->findOneBy(['id' => $id]);
        $this->em->remove($deljob);
        $this->em->flush();

        return $this->redirectToRoute('publish',['mail'=>$mail]);
    }


    /**
     * @Route("/search/{mail}", name="search")
     */
    public function Search(Request $request,$mail): Response
    {
        $str = $request->request->get('search');
        // dd($str);
        // $qb = $this->createQueryBuilder('u');
        // $qb->where('u.title like :title')
        //    ->setParameter('title','%$str%')
        //    ->getQuery()
        //    ->getResult();
        $searchjob=$this->publishData->searching($str,$mail);
        // dd($searchjob);
        // $searchjob=$this->publishData->findAll(['title' => $str]);
        return $this->render('view/search.html.twig',[
            'jobs'=>$searchjob,
            'mail'=>$mail
        ]);
    }


    /**
     * @Route("/updatepostjob/{id}", name="updatepostjob")
     */
    public function updatepostjob(Request $request, $id): Response
    {
        $email = $request->request->get('email');
        $location = $request->request->get('location');
        $title = $request->request->get('title');
        $name = $request->request->get('name');
        $file_name = $request->request->get('fileToUpload');
        $entityManager = $this->getDoctrine()->getManager();
        $post = $this->em->getRepository(PublishData::class)->find($id);

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
        // dd($post);
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

        $this->em->flush();
        return $this->redirectToRoute('editpostjob',[
            'id'=>$id,
            'mail'=>$email
        ]);

    }


    /**
     * @Route("/viewpublishPost/{mail}/{page}", defaults={"page":"1"}, name="viewpublishPost")
     */
    public function viewpublishPost($mail,$page): Response
    {
        $jobs=$this->publishData->AllPaginator($page,$mail);

        return $this->render('view/viewpublishPost.html.twig',[
            'jobs'=>$jobs,
            'mail'=>$mail
        ]);
    }
}
