<?php

namespace Kamran\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use Symfony\Component\HttpFoundation\Response;


abstract class RestController extends Controller
{


    /**
     * Returns the data of the request, unless it has been passed in JSON
     * @return array|null
     */
    protected function getRequestJson()
    {
        //$content = $this->getRequest()->getContent();
        $content = $this->get('request_stack')->getCurrentRequest()->getContent();
        return $content ? json_decode($content, TRUE) : NULL;
    }

    protected function responseJson ($result)
    {
        return new Response(json_encode($result));
    }

}//@


/*
 * instead of
 * $this->getRequest()
 * $this->get('request_stack')->getCurrentRequest()
 *
 * */