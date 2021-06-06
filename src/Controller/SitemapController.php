<?php

namespace App\Controller;

use App\Repository\BlogpostRepository;
use App\Repository\CategorieRepository;
use App\Repository\PeintureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SitemapController extends AbstractController
{
    /**
     * @Route("/sitemap.xml", name="sitemap", defaults={"_format"="xml"})
     */
    public function index(
        Request $request,
        PeintureRepository $peintureRepository,
        BlogpostRepository $blogpostRepository,
        CategorieRepository $categorieRepository
    ): Response {
        $hostname = $request -> getSchemeAndHttpHost();

        $urls= [];  // creation d'un tableau d'urls qui récupère toute les pages du site

        $urls[] = ['loc' => $this->generateUrl('home')];  // loc = balise <loc> du fichier sitemap
        $urls[] = ['loc' => $this->generateUrl('realisations')];
        $urls[] = ['loc' => $this->generateUrl('actualites')];
        $urls[] = ['loc' => $this->generateUrl('portfolio')];
        $urls[] = ['loc' => $this->generateUrl('a_propos')];
        $urls[] = ['loc' => $this->generateUrl('contact')];
        
        // besoin des repository des peintures pour importer les urls des peintures
        foreach ($peintureRepository->findAll() as $peinture){
            $urls[] = [
                'loc'       => $this->generateUrl('realisations_details', ['slug' => $peinture->getSlug()]),  // on ouvre un tableau pour passer le slug
                'lastmod'   => $peinture->getCreatedAt()->format('Y-m-d')  // lastmod = balise xml et formatage de la date
            ];
        }

        // besoin des repository des blogpost pour importer les urls des actualités
        foreach ($blogpostRepository->findAll() as $blogpost){
            $urls[] = [
                'loc'       => $this->generateUrl('actualites_detail', ['slug' => $blogpost->getSlug()]),  // on ouvre un tableau pour passer le slug
                'lastmod'   => $blogpost->getCreatedAt()->format('Y-m-d')  // lastmod = balise xml et formatage de la date
            ];
        }

        // besoin des repository des catégories pour importer les urls des categories
        foreach ($categorieRepository->findAll() as $categorie){
            $urls[] = [
                'loc'       => $this->generateUrl('portfolio_categorie', ['slug' => $categorie->getSlug()])  // on ouvre un tableau pour passer le slug
            ];
        }

        // preparation de la response
        $response = new Response(
            $this -> renderView('sitemap/index.html.twig', [
                'urls'      => $urls,
                'hostname'  => $hostname,
            ]),
            200  // c'est le status par defaut de Response
        );

        // puis, modification de l'entête
        $response -> headers -> set('Content-type', 'text/xml');

        // et enfin
        return $response;
    }
}
