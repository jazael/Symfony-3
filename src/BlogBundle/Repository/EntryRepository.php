<?php
namespace BlogBundle\Repository;
use BlogBundle\Entity\Tag;
use BlogBundle\Entity\EntryTag;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * Created by PhpStorm.
 * User: miguel
 * Date: 21/03/2017
 * Time: 1:21
 */
class EntryRepository extends \Doctrine\ORM\EntityRepository
{
    public function saveEntryTags($tags = null,$title = null,$category = null,$user = null, $entry = null){
        $em = $this->getEntityManager();
        $tag_repo = $em->getRepository("BlogBundle:Tag");
        if($entry == null){
            $entry = $this->findOneBy(array(
                "title"=>$title,
                "category"=>$category,
                "user"=>$user
            ));
        } else {}

            $tags = explode(",", $tags);
            foreach ($tags as $tag){
                $find_obj_tag = $tag_repo->findOneBy(array("name" => $tag));
                if (count($find_obj_tag) == 0){
                    $tag_obj = new Tag();
                    $tag_obj->setName($tag);
                    $tag_obj->setDescription($tag);
                    $em->persist($tag_obj);
                    $em->flush();
                }

                $tag = $tag_repo->findOneBy(array("name" => $tag));
                $entryTag = new EntryTag();
                $entryTag->setEntry($entry);
                $entryTag->setTag($tag);
                $em->persist($entryTag);
            }

            $flush = $em->flush();

    }

    public function getPaginateEntries($pageSize = 5, $currentPage = 1){
        $em = $this->getEntityManager();
        $dql = "SELECT e FROM BlogBundle\Entity\Entry e ORDER BY e.id DESC";
        $execQuery = $em->createQuery($dql)
            ->setFirstResult($pageSize*($currentPage-1))
            ->setMaxResults($pageSize);

        $paginator = new Paginator($execQuery, $fetchJoinCollection = true);

        return $paginator;
    }

    public function getCategoryEntries($category, $pageSize = 5, $currentPage = 1){
        $em = $this->getEntityManager();
        $dql = "SELECT e FROM BlogBundle\Entity\Entry e WHERE e.category = :category ORDER BY e.id DESC";
        $execQuery = $em->createQuery($dql)
            ->setParameter("category", $category)
            ->setFirstResult($pageSize*($currentPage-1))
            ->setMaxResults($pageSize);
        $paginator = new Paginator($execQuery, $fetchJoinCollection = true);

        return $paginator;
    }

}