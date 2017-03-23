<?php
/**
 * Created by PhpStorm.
 * User: miguel
 * Date: 19/03/2017
 * Time: 20:02
 */

namespace BlogBundle\Controller;


use BlogBundle\Entity\Entry;
use BlogBundle\Form\EntryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class EntryController extends Controller
{
    private $sesion;
    public function __construct()
    {
        $this->sesion = new Session();
    }

    public function indexAction(Request $request,$page){
        $em = $this->getDoctrine()->getEntityManager();
        $entry_repo = $em->getRepository("BlogBundle:Entry");
        $category_repo = $em->getRepository("BlogBundle:Category");
        $pageSize = 5;
        $entries = $entry_repo->getPaginateEntries($pageSize, $page);
        $totalItems = count($entries);
        $pageCount = ceil($totalItems/$pageSize);

        $categories = $category_repo->findAll();
        return $this->render("BlogBundle:Entry:index.html.twig", array(
            "entries" => $entries,
            "categories" => $categories,
            "pagesCount" => $pageCount,
            "page" => $page,
            "page_m" => $page
        ));
    }

    public function addAction(Request $request){
        $entry = new Entry();
        $form = $this->createForm(EntryType::class, $entry);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $category_repo = $em->getRepository("BlogBundle:Category");
                $entry_repo = $em->getRepository("BlogBundle:Entry");

                $entry = new Entry();
                $entry->setTitle($form->get("title")->getData());
                $entry->setContent($form->get("content")->getData());
                $entry->setStatus($form->get("status")->getData());

                $file = $form["image"]->getData();
                if(empty($file) && $file!=null){
                    $ext = $file->guessExtension();
                    $file_name = time().".".$ext;
                    $file->move("uploads", $file_name);
                    $entry->setImage($file_name);
                } else {
                    $entry->setImage(null);
                }

                $category = $category_repo->find($form->get("category")->getData());
                $entry->setCategory($category);
                $user = $this->getUser();
                $entry->setUser($user);

                $em->persist($entry);
                $flush = $em->flush();

                $entry_repo->saveEntryTags(
                    $form->get("tags")->getData(),
                    $form->get("title")->getData(),
                    $category,
                    $user
                );

                if ($flush == null){
                    $status = "La entrada se ha creado correctamente";
                }else{
                    $status = "Error al crear la entrada";
                }
            }else {
                $status = "La entrada no se ha creado correctamente";
            }
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("blog_homepage");
        }
        return $this->render("BlogBundle:Entry:add.html.twig", array(
            "form" => $form->createView()
        ));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $entry_repo = $em->getRepository("BlogBundle:Entry");
        $entry_tag_repo = $em->getRepository("BlogBundle:EntryTag");

        $entry = $entry_repo->find($id);

        $entry_tags = $entry_tag_repo->findBy(array("entry" => $entry));
        foreach ($entry_tags as $et){
            if (is_object($et)){
                $em->remove($et);
                $em->flush();
            }
        }

        $em->remove($entry);
        $em->flush();

        return $this->redirectToRoute("blog_homepage");
    }

    public function editAction(Request $request,$id){
        $em = $this->getDoctrine()->getEntityManager();
        $entry_repo = $em->getRepository("BlogBundle:Entry");
        $category_repo = $em->getRepository("BlogBundle:Category");
        $entry = $entry_repo->find($id);
        $entry_image = $entry->getImage();
        $tags = "";
        foreach ($entry->getEntryTag() as $entryTag){
            $tags .= $entryTag->getTag()->getName().",";
        }

        $form = $this->createForm(EntryType::class, $entry);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $entry->setTitle($form->get("title")->getData());
                $entry->setContent($form->get("content")->getData());
                $entry->setStatus($form->get("status")->getData());

                $file = $form["image"]->getData();
                if(empty($file) && $file!=null) {
                    $ext = $file->guessExtension();
                    $file_name = time() . "." . $ext;
                    $file->move("uploads", $file_name);
                    $entry->setImage($file_name);
                } else {
                    $entry->setImage($entry_image);
                }

                $category = $category_repo->find($form->get("category")->getData());
                $entry->setCategory($category);
                $user = $this->getUser();
                $entry->setUser($user);

                $em->persist($entry);
                $flush = $em->flush();

                $entry_tag_repo = $em->getRepository("BlogBundle:EntryTag");
                $entry_tags = $entry_tag_repo->findBy(array("entry" => $entry));
                foreach ($entry_tags as $et){
                    if (is_object($et)){
                        $em->remove($et);
                        $em->flush();
                    }
                }

                $entry_repo->saveEntryTags(
                    $form->get("tags")->getData(),
                    $form->get("title")->getData(),
                    $category,
                    $user
                );

                if ($flush == null){
                    $status = "La entrada se ha actualizado correctamente";
                }else{
                    $status = "Error al actualizar la entrada";
                }

            }else {
                $status = "La entrada no se ha actualizado correctamente";
            }

            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("blog_homepage");
        }


        return $this->render("BlogBundle:Entry:edit.html.twig", array(
            "form" => $form->createView(),
            "entry" => $entry,
            "tags" => $tags
        ));
    }
}