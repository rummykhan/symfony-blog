<?php

namespace AppBundle\Repository;


use AppBundle\Entity\Post;
use AppBundle\Entity\User;
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

    public function getPublishedQuery(User $user = null)
    {
        $builder = $this->createQueryBuilder('posts');

        if ($user) {
            $builder->andWhere('posts.user = :user')
                ->setParameter('user', $user);
        }

        return $builder->andWhere('posts.isPublished = :isPublished')
            ->setParameter('isPublished', true)
            ->orderBy('posts.createdAt', 'DESC')
            ->getQuery();
    }
}