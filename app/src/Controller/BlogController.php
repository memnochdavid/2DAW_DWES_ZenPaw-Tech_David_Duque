<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_blog_index')]
    public function index(PostRepository $postRepository): Response
    {
        //ordenado descendente
        $posts = $postRepository->findBy([], ['publishedAt' => 'DESC']);

        return $this->render('blog/index.html.twig', [
            'posts' => $posts,
        ]);
    }

    #[Route('/post/new', name: 'app_blog_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if (!$post->getPublishedAt()) {
                $post->setPublishedAt(new \DateTimeImmutable());
            }

            $entityManager->persist($post);
            $entityManager->flush();

            return $this->redirectToRoute('app_blog_index');
        }

        return $this->render('blog/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/post/{slug}', name: 'app_blog_show')]
    public function show(
        #[MapEntity(mapping: ['slug' => 'slug'])] Post $post
    ): Response {
        return $this->render('blog/show.html.twig', [
            'post' => $post,
        ]);
    }

    #[Route('/acerca-de', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('blog/about.html.twig');
    }


}
