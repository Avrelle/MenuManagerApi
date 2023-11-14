<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use App\Repository\PlateRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlateController extends AbstractController
{
    #[Route('/api/plate/categorie/{idCategorie}', name: 'api_plate', methods:['GET'] )]
    public function GetPlateByCategorie(PlateRepository $plateRepository, string $idCategorie)
    {
        return $this->json($plateRepository->findBy(['categorie' => $idCategorie]));
    }
   

    #[Route('/api/plate/menu', name: 'api_menu', methods:['GET'] )]
    public function GetMenus(MenuRepository $menuRepository)
    {
        return $this->json($menuRepository->findAll());
    }
}