<?php
/**
 * Created by PhpStorm.
 * User: miguel
 * Date: 19/03/2017
 * Time: 20:02
 */

namespace BlogBundle\Controller;


use BlogBundle\Entity\Category;
use BlogBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class CategoryController extends Controller
{
    private $sesion;
    public function __construct()
    {
        $this->sesion = new Session();
    }

    public function indexAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $category_repo = $em->getRepository("BlogBundle:Category");
        $categories = $category_repo->findAll();
        return $this->render("BlogBundle:Category:index.html.twig", array(
            "categories" => $categories
        ));
    }

    public function addAction(Request $request){
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $category = new Category();
                $category->setName($form->get("name")->getData());
                $category->setDescription($form->get("description")->getData());
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($category);
                $flush = $em->flush();
                if ($flush == null){
                    $status = "La categoria se ha creado correctamente";
                }else{
                    $status = "Error al crear la categoria";
                }
            }else {
                $status = "La categoria no se ha creado correctamente";
            }
            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("blog_index_category");
        }
        return $this->render("BlogBundle:Category:add.html.twig", array(
            "form" => $form->createView()
        ));
    }

    public function deleteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $category_repo = $em->getRepository("BlogBundle:Category");
        $category = $category_repo->find($id);
        if(count($category->getEntry()) == 0){
            $em->remove($category);
            $em->flush();
        }
        return $this->redirectToRoute("blog_index_category");
    }

    public function editAction(Request $request,$id){
        $em = $this->getDoctrine()->getEntityManager();
        $category_repo = $em->getRepository("BlogBundle:Category");
        $category = $category_repo->find($id);

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {

                $category->setName($form->get("name")->getData());
                $category->setDescription($form->get("description")->getData());

                $em->persist($category);
                $flush = $em->flush();
                if ($flush == null){
                    $status = "La categoria se ha editado correctamente";
                }else{
                    $status = "Error al editado la categoria";
                }
            }else {
                $status = "La categoria no se ha editado correctamente";
            }

            $this->sesion->getFlashBag()->add("status", $status);
            return $this->redirectToRoute("blog_index_category");
        }


        return $this->render("BlogBundle:Category:edit.html.twig", array(
            "form" => $form->createView()
        ));
    }

    public function categoryAction($id, $page){
        $em = $this->getDoctrine()->getEntityManager();
        $category_repo = $em->getRepository("BlogBundle:Category");
        $category = $category_repo->find($id);

        $entry_repo = $em->getRepository("BlogBundle:Entry");
        $entries = $entry_repo->getCategoryEntries($category, 5, $page);

        $totalItems = count($entries);
        $pageCount = ceil($totalItems/5);

        return $this->render("BlogBundle:Category:category.html.twig", array(
            "category" => $category,
            "categories" => $category_repo->findAll(),
            "entries" => $entries,
            "totalItems" => $totalItems,
            "pagesCount" => $pageCount,
            "page" => $page,
            "page_m" => $page
        ));
    }

}