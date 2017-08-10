<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Post;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    /**
     * @return Post[]
     */
    public function findAllPublished()
    {
        return $this->createQueryBuilder('posts')
            ->andWhere('posts.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('posts.createdAt', 'DESC')
            ->getQuery()
            ->execute();
    }
}