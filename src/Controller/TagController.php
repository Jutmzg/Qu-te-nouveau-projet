<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tag", name="tag_")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(TagRepository $tagRepository)
    {
        return $this->render('tag/index.html.twig', [
            'tags' => $tagRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{name}", name="show", methods={"GET"})
     */
    public function show(Tag $tag)
    {
        return $this->render('tag/show.html.twig', [
            'tag' => $tag,
        ]);
    }
}
