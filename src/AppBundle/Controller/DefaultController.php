<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $query = $em->getRepository('AppBundle:Post')
            ->getPublishedQuery();

        $paginator = $this->get('knp_paginator')->paginate(
            $query,
            $request->get('page', 1),
            10
        );

        //dump($paginator);exit;

        return $this->render('frontend/default/post/index.html.twig', [
            'paginator' => $paginator
        ]);
    }
}
