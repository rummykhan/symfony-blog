<?php

namespace AppBundle\Controller;


use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/users", name="users")
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('AppBundle:User')
            ->loadUserWithOnlyUserRole();

        return $this->render("frontend/default/users/index.html.twig", [
            'users' => $users
        ]);
    }

    /**
     * @Route("/users/{email}/posts", name="user_posts")
     */
    public function postsAction(Request $request, User $user)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('AppBundle:Post')
            ->getPublishedQuery($user);

        $paginator = $this->get('knp_paginator')->paginate(
            $query,
            $request->get('page', 1),
            10
        );

        return $this->render("frontend/default/post/index.html.twig", [
            'paginator' => $paginator
        ]);
    }
}