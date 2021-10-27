<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture

{
    public function load(ObjectManager $manager)
    {
        $faker= \Faker\Factory::create('fr_FR');

        // créer 3 catégories
        for ($i=1;$i<=3; $i++)
        {
           $category=new Category();
           $category->setTitle($faker->sentence())
                ->setDescription($faker->paragraph);

           $manager->persist($category);

           // créer entre 4 et 6 articles

        for ($j=1; $j<=mt_rand(4,6); $j++)
        {
            $article = new Article();


            $content= '<p>'.join($faker->paragraphs(5)).'</p>';


            $article->setTitle($faker->sentence)
                ->setContent($content)
                ->setImage($faker->imageUrl)
                ->setCategory($category);

            $manager->persist($article);

            //on donne des commentaires à l'article

            for ($k=1; $k<=mt_rand(4,10); $k++)
            {
                $comment = new Comment();
                $content= '<p>'.join($faker->paragraphs(2)).'</p>';

                $comment->setAuthor($faker->name)
                    ->setContent($content)
                    ->setArticle($article);

                $manager->persist($article);

            }

        }
        }
            $manager->flush();
    }
}
