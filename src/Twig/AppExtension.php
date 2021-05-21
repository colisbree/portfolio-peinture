<?php
/* 
    Ce fichier est une "extension Twig"
    Fichier permettant de récupérer toutes les catégories 
    et de les mettre dans la navbar
*/

namespace App\Twig;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use App\Repository\CategorieRepository;

class AppExtension extends AbstractExtension
{
    private $CategorieRepository;

    public function __construct(CategorieRepository $CategorieRepository)
    {
        $this -> CategorieRepository = $CategorieRepository;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('categorieNavbar', [$this, 'categorie']),
        ];
    }

    public function categorie(): array
    {
        return $this -> CategorieRepository -> findAll();
    }
}
