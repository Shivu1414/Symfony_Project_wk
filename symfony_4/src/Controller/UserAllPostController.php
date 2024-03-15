<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UnpostedjobRepository;
use App\Repository\PublishDataRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\PublishData;
use App\Entity\Unpostedjob;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class UserAllPostController extends AbstractController
{
    private $val;
    public $session;
    private $publishData;
    private $UnpublishData;
    private $em;
    public function __construct(UnpostedjobRepository $unpublishData, EntityManagerInterface $em, PublishDataRepository $publishData,  SessionInterface $session)
    {
        $this->session=$session;
        $this->publishData = $publishData;
        $this->em=$em;
        $this->UnpublishData = $unpublishData;
    }

    /**
     * @Route("/userallpost/{mail}/{val}/{page}/{pg}", defaults={"val":"1","page":"1","tag":0,"pg":1}, name="userallpost")
     */
    public function userAllPosts($mail,$val,$page,$tag,$pg): Response
    {
        // dd($this->session->get('Id'));
        if($this->session->get('Id')==""){
            return $this->redirectToRoute('logout');
        }
        else{
        // dd($val);
        // if($val==3){
        //     $jobs2=$this->publishData->finddata($mail);
        //     $jobs1=$this->UnpublishData->finddata($mail);  
        //     $type="Publish and Unpublish";  
        // }
        // dd($page);
        if($val==2){
            $jobs2="";
            $jobs1=$this->UnpublishData->findAllPaginated($page,$mail);
            // $jobs1=$this->UnpublishData->finddata($mail);   
            $type="Unpublish Post";
        }
        else if($val==1){
            // $jobs2=$this->publishData->finddata($mail);
            $jobs2=$this->publishData->AllPaginator($page,$mail);
            $jobs1="";  
            $type="Publish Post";    
        }
        $pg=$page;
        
        $posts="";
        // $posts=$this->publishData->findOneBy(['id' => 30]);
        // $jobs = (object) array_merge((array)$jobs1, (array)$jobs2);        
        return $this->render('view/userAllPosts.html.twig',[
            'publishJobs'=>$jobs2,
            'unpublishJobs'=>$jobs1,
            'type'=>$type,
            'temp'=>$val,
            'mail'=>$mail,
            'posts'=>$posts,
            'tag'=>$tag,
            'pg'=>$pg
        ]);
        }
        

    }

    /**
     * @Route("/userpostview/{mail}/{val}/{id}/{page}/{tag}/{pg}", defaults={"val":"1","page":"1","tag":0}, name="userpostview")
     */
    public function userpostView($mail,$val,$id,$page,$tag,$pg): Response
    {
        // $this->page=$page;
        // dd($tag);
        // dd($pg." ".$page);
        if($val==2){
            $jobs2="";
            $jobs1=$this->UnpublishData->findAllPaginated($page,$mail);
            $type="Unpublish Post"; 
            $posts=$this->UnpublishData->findOneBy(['id' => $id]);  
        }
        else if($val==1){
            $jobs2=$this->publishData->AllPaginator($page,$mail);
            $jobs1="";  
            $type="Publish Post"; 
            $posts=$this->publishData->findOneBy(['id' => $id]);   
        }
        // dd($pg);

        if($pg!=$page){
            $tag=0;
            $pg=$page;
        }
        return $this->render('view/userAllPosts.html.twig',[
            'publishJobs'=>$jobs2,
            'unpublishJobs'=>$jobs1,
            'type'=>$type,
            'temp'=>$val,
            'mail'=>$mail,
            'posts'=>$posts,
            'tag'=>$tag,
            'pg'=>$pg
        ]);
    }



    /**
     * @Route("/allPostsrch/{mail}/{val}", defaults={"val":"1","page":"1","tag":0}, name="allPostsrch")
     */
    public function allPostsrch(Request $request,$mail,$val,$page,$tag): Response
    {
        // $this->page=$page;
        // dd($pg);
        // dd($pg." ".$page);
        $str = $request->request->get('search');

        if($val==2){
            $jobs2="";
            $jobs1=$this->UnpublishData->findAllSearch($page,$mail,$str);
            $type="Unpublish Post"; 
        }
        else if($val==1){
            $jobs2=$this->publishData->findAllSearch($page,$mail,$str);
            $jobs1="";  
            $type="Publish Post"; 
        }
        $pg=$page;
        $posts="";
        return $this->render('view/userAllPosts.html.twig',[
            'publishJobs'=>$jobs2,
            'unpublishJobs'=>$jobs1,
            'type'=>$type,
            'temp'=>$val,
            'mail'=>$mail,
            'posts'=>$posts,
            'tag'=>$tag,
            'pg'=>$pg
        ]);
    }



    /**
     * @Route("/multidelAPosts/{mail}/{temp}", name="multidelAPosts")
     */
    public function multidelAPosts($mail,$temp): Response
    {
        if(isset($_POST['mul_delete']))
        {
            $alldels=$_POST['multiple_delete'];
            // $extract=implode(',',$all_del);
        }
        if($temp==1){
            foreach($alldels as $alldel){
                $deljob=$this->publishData->findOneBy(['id' => $alldel]);
                $this->em->remove($deljob);
                $this->em->flush();
             }
        }
        else if($temp==2){
            foreach($alldels as $alldel){
                $deljob=$this->UnpublishData->findOneBy(['id' => $alldel]);
                $this->em->remove($deljob);
                $this->em->flush();
             }
        }
        else if($temp==3){
            // dd($alldels);
            foreach($alldels as $alldel){
                // $deljob=$this->UnpublishData->findOneBy(['id' => $alldel]);
                // $this->em->remove($deljob);
                // $this->em->flush();
             }
        }
        return $this->redirectToRoute('userallpost',['mail'=>$mail]);
    }


    /**
     * @Route("/delunpubpost/{mail}/{id}", name="delunpubpost")
     */
    public function delunpubpost($mail,$id): Response
    {
        $deljob=$this->UnpublishData->findOneBy(['id' => $id]);
        $this->em->remove($deljob);
        $this->em->flush();
        
        return $this->redirectToRoute('userallpost',['mail'=>$mail]);
    }

    /**
     * @Route("/pubdata/{id}/{mail}", name="pubdata")
     */
    public function pubData($id,$mail): Response
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

        return $this->redirectToRoute('userallpost',['mail'=>$mail]);
    }

    /**
     * @Route("/editunpostjob/{id}/{mail}", name="editunpostjob")
     */
    public function editUnpostjob($id,$mail): Response
    {
        return $this->render('view/editJob.html.twig',[
            'job'=>$this->UnpublishData->findOneBy(['id' => $id])
        ]);
    }

    

















    /**
     * @Route("/delpubpost/{mail}/{id}", name="delpubpost")
     */
    public function delpubpost($mail,$id): Response
    {
        $deljob=$this->publishData->findOneBy(['id' => $id]);
        $this->em->remove($deljob);
        $this->em->flush();
        
        return $this->redirectToRoute('userallpost',['mail'=>$mail]);
    }

    /**
     * @Route("/unpubdata/{id}/{mail}", name="unpubdata")
     */
    public function unpubData($id,$mail): Response
    {
        // data stored in publish table
        $unpublish=$this->publishData->findOneBy(['id' => $id]);
        $entityManager = $this->getDoctrine()->getManager();

        $unpubjob= new Unpostedjob();
        $unpubjob->setName($unpublish->getName());
        $unpubjob->setEmail($unpublish->getEmail());
        $unpubjob->setTitle($unpublish->getTitle());
        $unpubjob->setLocation($unpublish->getLocation());
        $unpubjob->setUrl($unpublish->getUrl());  
        
        $entityManager->persist($unpubjob);
        $entityManager->flush();

        // data delete from unpublish table
        $deljob=$this->publishData->findOneBy(['id' => $id]);
        $this->em->remove($deljob);
        $this->em->flush();

        return $this->redirectToRoute('userallpost',['mail'=>$mail]);
    }

    /**
     * @Route("/editpostjob/{id}/{mail}", name="editpostjob")
     */
    public function editpostjob($id,$mail): Response
    {
        return $this->render('view/editpostJob.html.twig',[
            'job'=>$this->publishData->findOneBy(['id' => $id])
        ]);
    }



    


}
