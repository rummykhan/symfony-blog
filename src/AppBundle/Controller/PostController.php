<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;

class PostController extends Controller
{
    /**
     * @Route("/posts/create", name="create_post")
     */
    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('frontend/default/post/create.html.twig');
    }

    /**
     * @Route("/posts/{slug}", name="post")
     */
    public function postAction(Request $request, $slug)
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('frontend/default/post/post.html.twig');
    }

    /**
     * @Route("/posts", name="post_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('frontend/default/post/index.html.twig');
    }
}