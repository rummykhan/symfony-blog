<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 * @ORM\Table(name="posts")
 * @ORM\HasLifecycleCallbacks()
 */
class Post
{
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=500)
     */
    private $slug;

    /**
     * @ORM\Column(type="string")
     */
    private $excerpt;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getExcerpt()
    {
        return $this->excerpt;
    }

    /**
     * @param mixed $excerpt
     */
    public function setExcerpt($excerpt)
    {
        $this->excerpt = $excerpt;
    }

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $body;


    /**
     * @var string
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var string
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPublished;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        $this->setSlug(string($title)->slugify());
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    private function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }


    /**
     * @ORM\PrePersist()
     */
    public function onPersist()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PostUpdate()
     */
    public function onPostUpdate()
    {
        $this->updatedAt = new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt ? $this->updatedAt : null;
    }

    /**
     * @return mixed
     */
    public function getisPublished()
    {
        return $this->isPublished;
    }
}

