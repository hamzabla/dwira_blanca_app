<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{
    #[Route('/', name: 'app_posts')]
    public function index(PostRepository $postRepository): Response
    {
        $post = $postRepository->findBy([],['createdAt'=>'DESC']);
        return $this->render('posts/index.html.twig', ['posts' => $post]);
    }

    #[Route('/posts/{id<[0-9]+>}', name: 'app_posts_details')]
    public function show(Post  $post): Response
    {
      return $this->render('posts/show.html.twig', compact('post'));
    }
}
