<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-05-27
 * Time: 16:03
 */

namespace App\Controller;


use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
/**
 * @Route("/category", name="category_add")
 */
        public function add(Request $request):Response
        {
            $category = new Category();
            $form = $this->createForm(CategoryType::class, $category);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($category);
                $em->flush();

                return $this->redirectToRoute('blog_show_category_name', ['id' => $category->getId()]);

            }

            return $this->render('category/add.html.twig', [
                        'form' => $form->createView(),
                        'category' => $category
                    ]);
        }

}