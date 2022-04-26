<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{
    #[Route('/', name: 'app_posts')]
    public function index(PostRepository $postRepository): Response
    {
        $post = $postRepository->findAll();
        return $this->render('posts/index.html.twig', ['posts' => $post]);
    }
}
