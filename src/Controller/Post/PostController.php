<?php

namespace App\Controller\Post;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index()
    {
        $posts = $this
                    ->getDoctrine()
                    ->getRepository(Post::class)
                    ->findAll();

        return $this->render('layouts/base.html.twig', ['posts' => $posts]);
    }

    /**
     * @Route("/post/show/{id}" name="post_show")
     *
     * @param Post $post
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function show(Post $post)
    {
        return $this->render('post/show.html.twig', ['post' => $post]);
    }


    /**
     * @Route("/post/create" name="post_create")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $request->files->get($request->get('image'));

            $this->em->persist($post);
            $this->em->flush();

            return $this->redirectToRoute('post_show');
        }

        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
            'post' => $post
        ]);
    }
}