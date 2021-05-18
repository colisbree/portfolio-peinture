<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(
        PeintureRepository $peintureRepository,
        BlogpostRepository $blogpostRepository
    ): Response {
        return $this->render('home/index.html.twig', [
            'peintures' => $peintureRepository->lasTree(), //on envoie automatiquement les 3 dernières peintures dans fichier realisations.html.twig
            'blogposts' => $blogpostRepository->lasTree(), //on envoie automatiquement les 3 derniers posts dans fichier blopost.html.twig
        ]);
    }
}
