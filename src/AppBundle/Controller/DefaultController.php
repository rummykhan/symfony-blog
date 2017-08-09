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
        $greeting = "*Hey there! Welcome to my blog.*";

        $cache = $this->get('doctrine_cache.providers.markdown_cache');

        $key = md5($greeting);

        if ($cache->contains($key)) {
            $greeting = $cache->fetch($key);
        } else {
            $cache->save($key, $this->get('markdown.parser')->transform($greeting));
        }

        // replace this example code with whatever you need
        return $this->render('frontend/default/home/index.html.twig', [
            'greeting' => $greeting
        ]);
    }

    /**
     * @Route("/tmp/{name}", defaults={"name"= null})
     */
    public function testAction($name = null)
    {
        return new Response($name);
    }
}
