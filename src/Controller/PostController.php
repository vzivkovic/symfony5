<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

/**
 * @Route("/post", name="post")
 */
class PostController extends AbstractController
{
    /**
     * @var PostRepository
     */
    private $postRepository;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     * @param EntityManagerInterface $entityManager
     * @param RouterInterface $router
     */
    public function __construct(
        PostRepository $postRepository,
        EntityManagerInterface $entityManager,
        RouterInterface $router
    ) {
        $this->postRepository = $postRepository;
        $this->entityManager = $entityManager;
        $this->router = $router;
    }

    /**
     * @Route("/", name="s")
     */
    public function index()
    {
        return $this->render(
            'post/index.html.twig',
            [
                'controller_name' => 'PostController',
                'posts'           => $this->postRepository->findAll(),
            ]
        );
    }

    /**
     * @Route("/new", name="new_post")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request)
    {
        $post = new Post();
        $post->setTime(new \DateTime());

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($post);
            $this->entityManager->flush();

            return new RedirectResponse(
                $this->router->generate('posts')
            );
        }

        return $this->render(
            'post/new.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }
}
