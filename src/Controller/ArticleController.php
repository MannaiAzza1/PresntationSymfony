<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Image;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article", name="article")
     */
    public function index(ValidatorInterface $validator): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setDate("2021-04-23");
        $article->setTitre("Facebook Post");
        $article->setAuteur('Salma');
        $article->setContenu('Salut tout le monde');
        $image = new Image();
        $image->setUrl('http://uploads.siteduzero.com/icones/478001_479000/478657.png');
        $image->setAlt('Logo Symfony2');
        // On lie l'image à l'article
        $article->setImage($image);
        $commentaire1 = new Commentaire();
        $commentaire1->setAuteur('Azza');
        $commentaire1->setContenu('On veut les photos !');
        $commentaire1->setDate('01/09/2021');
        $commentaire2 = new Commentaire();
        $commentaire2->setAuteur('Salma');
        $commentaire2->setContenu('Les photos arrivent !');
        $commentaire2->setDate('05/09/2021');
        // On lie les commentaires à l'article
        $commentaire1->setArticle($article);
        $commentaire2->setArticle($article);


        $entityManager->persist($article);
        $entityManager->persist($image);
        $entityManager->persist($commentaire1);
        $entityManager->persist($commentaire2);

        
        $entityManager->flush();
        
        
        $errors=$validator->validate($article);
    
        
        
        
    if (count($errors) == 0) {
            return $this->render('article/validation.html.twig', [
                'article' => $article,
                'commentaire1'=> $commentaire1,
                'commentaire2'=> $commentaire2,
            ]);
        }

     return new Response("this article is invalid");
    
        
    }
}
