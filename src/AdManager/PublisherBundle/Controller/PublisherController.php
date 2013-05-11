<?php

namespace AdManager\PublisherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PublisherController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AdManagerPublisherBundle:Publisher:index.html.twig', array('name' => $name));
    }
}
