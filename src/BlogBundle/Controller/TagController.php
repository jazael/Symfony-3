<?php
/**
 * Created by PhpStorm.
 * User: miguel
 * Date: 19/03/2017
 * Time: 20:02
 */

namespace BlogBundle\Controller;


use BlogBundle\Entity\Tag;
use BlogBundle\Form\TagType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TagController extends Controller
{
    private $sesion;
    public function __construct()
    {
        $this->sesion = new Session();
    }

    public function indexAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $tag_repo = $em->getRepository("BlogBundle:Tag");
        $tags = $tag_repo->findAll();
        return $this->render("BlogBundle:Tag:index.html.twig", array(
            "tags" => $tags
        ));
    }

    public function addAction(Request $request){
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $tag = new Tag();
                $tag->setName($form->get("name")->getData());
                $tag->setDescription($form->get("description")->getData());
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($tag);
                $flush = $em->flush();
                if ($flush == null){
                    $status = "La etiqueta se ha creado correctamente";
                }else{
                    $status = "Error al crear la etiqueta";
                }
            }else {
                $status = "La etiqueta no se ha creado correctamente";
            }
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("blog_index_tag");
        }
        return $this->render("BlogBundle:Tag:add.html.twig", array(
            "form" => $form->createView()
        ));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $tag_repo = $em->getRepository("BlogBundle:Tag");
        $tag = $tag_repo->find($id);
        if(count($tag->getEntryTag()) == 0){
            $em->remove($tag);
            $em->flush();
        }
        return $this->redirectToRoute("blog_index_tag");
    }

    public function editAction(Request $request,$id){
        $em = $this->getDoctrine()->getEntityManager();
        $tag_repo = $em->getRepository("BlogBundle:Tag");
        $tag = $tag_repo->find($id);

        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $tag->setName($form->get("name")->getData());
                $tag->setDescription($form->get("description")->getData());

                $em->persist($tag);
                $flush = $em->flush();
                if ($flush == null){
                    $status = "La etiqueta se ha editado correctamente";
                }else{
                    $status = "Error al editar la etiqueta";
                }
            }else {
                $status = "La etiqueta no se ha editado correctamente";
            }

            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("blog_index_tag");
        }


        return $this->render("BlogBundle:Tag:edit.html.twig", array(
            "form" => $form->createView()
        ));
    }
}