<?php

namespace AppBundle\Controller;

use AppBundle\Form\CreatePost;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Post;

class PostController extends Controller
{
    /**
     * @Route("/user/posts/create", name="user_create_post")
     */
    public function createAction(Request $request)
    {
        $form = $this->createForm(CreatePost::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $user = $this->getUser();

            $post = $form->getData();

            $user->addPosts($post);

            $em->persist($post);

            $em->flush();

            $this->addFlash('success', 'Post added successfully!');

            return $this->redirectToRoute('user_posts', ['email' => $user->getEmail()]);
        }

        return $this->render('frontend/default/post/create.html.twig', [
            'postCreateForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/posts/{id}/{slug}", name="post")
     */
    public function postAction(Post $post)
    {
        $em = $this->getDoctrine()->getManager();
        $post->setViewsCount($post->getViewsCount() + 1);
        $em->persist($post);
        $em->flush();

        return $this->render('frontend/default/post/post.html.twig', [
            'post' => $post
        ]);
    }
}
