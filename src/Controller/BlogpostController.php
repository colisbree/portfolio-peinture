<?php

namespace App\Controller;

use App\Entity\Blogpost;
use App\Entity\Commentaire;
use App\Form\CommentaireType;
use App\Repository\BlogpostRepository;
use App\Repository\CommentaireRepository;
use App\Service\CommentaireService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogpostController extends AbstractController
{
    /**
     * @Route("/actualites", name="actualites")
     */
    public function actualites(
        BlogpostRepository $blogpostRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $blogpostRepository -> findBy([], ['id' => 'DESC']);
        $blogposts = $paginator -> paginate(
            $data,
            $request -> query -> getInt('page', 1),
            6
        );

        return $this->render('blogpost/actualites.html.twig', [
            'blogposts' => $blogposts,
        ]);
    }

    /**
     * @Route("/actualites/{slug}", name="actualites_detail")
     */
    public function detail(
        Blogpost $blogpost,
        Request $request,  
        CommentaireService $commentaireService,      // utilisation du service src/service/CommentaireService.php
        CommentaireRepository $commentaireRepository
    ): Response {
        $commentaires = $commentaireRepository->findCommentaires($blogpost);
        $commentaire = new Commentaire();                                   // creation du commentaire vide
        $form = $this -> createForm(CommentaireType::class, $commentaire);  // création du formulaire
        $form -> handleRequest($request);  
        
        if ($form->isSubmitted() && $form->isValid()){
            $commentaire = $form->getData();
            $commentaireService->persistCommentaire($commentaire, $blogpost, null); // null en dernier argument car il n'y a pas de peinture

            return $this -> redirectToRoute('actualites_detail', ['slug' => $blogpost->getslug()]);
        }

        return $this->render('blogpost/detail.html.twig', [
            'blogpost'     => $blogpost,
            'form'         => $form->CreateView(),  // puis création du fichier form/formulaire.html.twig
            'commentaires' => $commentaires,
        ]);
    }
}
