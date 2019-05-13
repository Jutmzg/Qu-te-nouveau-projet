<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-05-13
 * Time: 11:14
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog", name="blog_")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/show/{slug}",
     *     requirements={"slug"="[a-z0-9-]*"},
     *     defaults={"slug"="Article Sans Titre"},
     *     name="show")
     */
    public function show($slug)
    {
        return $this->render('blog/show.html.twig', ['slug' =>
            ucwords(str_replace('-', ' ', $slug))]);
    }
}
