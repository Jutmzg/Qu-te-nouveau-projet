<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-05-13
 * Time: 11:41
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
/**
 * @Route("/", name="app_index")
 */
    public function index(){
        return $this->render('default.html.twig');
    }
}