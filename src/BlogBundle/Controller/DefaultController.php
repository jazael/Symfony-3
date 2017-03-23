<?php

namespace BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function alowStatic()
    {
        /*
        $em = $this->getDoctrine()->getEntityManager();
        $entry_repo = $em->getRepository("BlogBundle:Entry");
        $entries = $entry_repo->findAll();

        foreach ($entries as $entry){
            echo $entry->getTitle()."<br/>";
            echo $entry->getCategory()->getName()."<br/>";9
            echo $entry->getUser()->getName()."<br/>";

                $tags = $entry->getEntryTag();
                foreach ($tags as $tag){
                    echo $tag->getTag()->getName()."<hr/>";
                }

        }
        */
        /*
        $em = $this->getDoctrine()->getEntityManager();
        $category_repo = $em->getRepository("BlogBundle:Category");
        $categories = $category_repo->findAll();
        foreach ($categories as $category){
            echo $category->getName()."<br/>";
            $entries = $category->getEntry();
            foreach ($entries as $entry){
                echo $entry->getTitle()."<br/><hr/>";
            }
        }
        */
        /*
        $em = $this->getDoctrine()->getEntityManager();
        $tag_repo = $em->getRepository("BlogBundle:Tag");
        $tags = $tag_repo->findAll();
        foreach ($tags as $tag){
            echo $tag->getName()."<br/>";
            $entryTags = $tag->getEntryTag();
            foreach ($entryTags as $entryTag){
                echo $entryTag->getEntry()->getTitle()."<br/><hr/>";
            }
        }
        */
        //return $this->render('BlogBundle:Default:index.html.twig');
    }

    public function indexAction(){
        return $this->render('BlogBundle:Default:index.html.twig');
    }

    public function langAction(Request $request){
        return $this->redirectToRoute("blog_homepage");
    }

}
