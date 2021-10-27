<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class BlogController extends AbstractController
{

    #[Route('/blog', name: 'blog')]
  public function index( ArticleRepository $repo ): Response
  {
      $articles=$repo->findAll();

      return $this->render('blog/index.html.twig', [
          'controller_name' => 'Les articles',
          'articles'=>$articles
      ]);
  }
     #[Route('/', name:'home')]
  public function home ()
  {
      return $this->render('blog/home.html.twig',[
          'title'=>'Bienvenue sur mon blog!',
      ]);
  }

    #[Route('/blog/new', name:'blog_create')]
    public function create( Request $request, EntityManagerInterface $manager):Response
    {
        $article=new Article();

        $form=$this->createFormBuilder($article)

            ->add('title')
            ->add('category', EntityType::class,[
                'class'=>Category::class,
                'choice_label'=>'title'
            ])
            ->add('content')
            ->add('image')

            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid())

            $manager->persist ($article);
            $manager->flush();


        return $this->render('blog/create.html.twig',[
            'formArticle'=> $form->createView(),
                'editMode'=> $article->getId() !==null
            ]);

    }

    #[Route('/blog/{id}', name:'blog_show')]
    public function show(Article $article)
    {
        return $this->render('blog/show.html.twig',[
        'article'=>$article ]);
    }


}
