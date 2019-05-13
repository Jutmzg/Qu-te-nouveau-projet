<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-05-13
 * Time: 11:14
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class BlogController extends AbstractController
{
    public function index()
    {
        return $this->render('blog/index.html.twig', [
            'owner' => 'Thomas'
        ]);
    }
}
