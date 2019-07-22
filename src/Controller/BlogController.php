<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-05-13
 * Time: 11:14
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog", name="blog_")
 */
class BlogController extends AbstractController
{
    /**
     * Show all row from article's entity
     *
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(SessionInterface $session): Response
    {
        if (!$session->has('total')) {
            $session->set('total', 0);
        }

        $total = $session->get('total');

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        if (!$articles) {
            throw $this->createNotFoundException(
                'No article found in article\'s table.'
            );
        }

        return $this->render(
            'blog/index.html.twig', [
            'articles' => $articles,
        ]);
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/show/{slug}",
     *     requirements={"slug"="[a-z0-9-]*"},
     *     defaults={"slug"="Article Sans Titre"},
     *     name="show")
     * @return Response A response instance
     */
    public function show(string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article
             in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with ' . $slug . ' title, found in article\'s table.'
            );
        }

        return $this->render('blog/show.html.twig', [
            'slug' => $slug,
            'article' => $article,
        ]);
    }

    /**
     * Getting a article with a formatted slug for title
     *
     * @param object $category
     *
     * @Route("/category/{id}",
     *     name="show_category_name")
     * @return Response A response instance
     */
    public function showByCategory(Category $category): Response
    {

        /*$article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBy(
                ['category' => $category],
                ['id' => 'DESC'],
                3
            );*/

        $articles = $category->getArticles();


        return $this->render(
            'blog/category.html.twig',
            [
                'category' => $category,
                'articles' => $articles
            ]
        );
    }
}
