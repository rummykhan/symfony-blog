<?php

namespace AppBundle\Controller;

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
        $templating = $this->container->get('templating');

        // replace this example code with whatever you need
        return $this->render('frontend/default/home/index.html.twig');
    }

    /**
     * @Route("/tmp/{name}", defaults={"name"= null})
     */
    public function testAction($name=null)
    {
        return new Response($name);
    }
}
