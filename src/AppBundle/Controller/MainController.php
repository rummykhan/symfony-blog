<?php
/**
 * Created by PhpStorm.
 * User: rummykhan
 * Date: 8/9/17
 * Time: 8:08 PM
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MainController extends Controller
{
    public function dummyAction()
    {
        return new Response("Main Controller");
    }
}