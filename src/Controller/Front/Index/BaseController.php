<?php

namespace App\Controller\Front\Index;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BaseController
 * @package App\Controller\Front\Index
 */
class BaseController extends AbstractController
{
    /**
     * @Route("/", name="index")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(){
         return $this->render('front/index/index.html.twig');
    }
}