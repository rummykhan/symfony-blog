<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    /**
     * @Route("/users", name="users")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')
            ->findAll();

        $roles = $em->getRepository('AppBundle:User\Role')
            ->findAll();

        return $this->render("frontend/default/users/index.html.twig", [
            'users' => $users
        ]);
    }

    /**
     * @Route("/users/{email}/posts", name="user_posts")
     */
    public function postsAction(User $user)
    {
        return $this->render("frontend/default/post/index.html.twig", [
            'posts' => $user->getPosts()
        ]);
    }
}