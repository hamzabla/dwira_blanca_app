<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostsController extends AbstractController
{
    #[Route('/', name: 'app_posts',methods: 'GET')]
    public function index(PostRepository $postRepository): Response
    {
        $post = $postRepository->findBy([],['createdAt'=>'DESC']);
        return $this->render('posts/index.html.twig', ['posts' => $post]);
    }

    #[Route('/posts/create', name: 'app_posts_create', methods: 'GET|POST')]
    public function create(Request $request,EntityManagerInterface $em): Response
    {
      $post = new Post;
      $form= $this->createFormBuilder($post)
       ->add('title',TextType::class)
       ->add('mini_title',TextType::class)
       ->add('One_word_pov',ChoiceType::class,[
        'choices'  => [
          'Good' => 'Good',
          'Average' => 'Average',
          'Bad' => 'Bad',
        ],])
       ->add('mark',ChoiceType::class,[
         'choices' => [
           '10'=> '10',
           '5' =>'5',
           '1'=> '1',
         ]
       ,])
       ->add('location',TextType::class)
       ->add('review_article',TextareaType::class)
       ->getForm();

       $form->handleRequest($request);

       if($form->isSubmitted() && $form->isValid()){
          $em->persist($post);
          $em->flush();

          return $this->redirectToRoute('app_posts');

       }

      return $this->render('posts/create.html.twig',[
        'formPosts'=>$form->createView()]);
    }

    #[Route('/posts/{id<[0-9]+>}', name: 'app_posts_details', methods:'GET')]
    public function show(Post  $post): Response
    {
      return $this->render('posts/show.html.twig', compact('post'));
    }

    #[Route('/posts/{id<[0-9]+>}/edit}', name: 'app_posts_edit', methods:'GET|POST')]
    public function edit(Post $post,EntityManagerInterface $em,Request $request): Response
    {
      $form= $this->createFormBuilder($post)
      ->add('title',TextType::class)
      ->add('mini_title',TextType::class)
      ->add('One_word_pov',ChoiceType::class,[
       'choices'  => [
         'Good' => 'Good',
         'Average' => 'Average',
         'Bad' => 'Bad',
       ],])
      ->add('mark',ChoiceType::class,[
        'choices' => [
          '10'=> '10',
          '5' =>'5',
          '1'=> '1',
        ]
      ,])
      ->add('location',TextType::class)
      ->add('review_article',TextareaType::class)
      ->getForm();

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){
         $em->flush();
         return $this->redirectToRoute('app_posts');

      }

      return $this->render('posts/edit.html.twig', [
        'post' =>$post,
        'formEditPost' => $form->createView()
      ]);
    }
}
