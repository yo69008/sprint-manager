<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AuthBundle\Controller\AbstractAuthController;

class DefaultController extends AbstractAuthController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
       
        return $this->render('@AppBundle/Resources/views/home.html.twig',
            [
                "global_access" => $this->hasGlobalAccess()
            ]
            );
    }
}
