<?php

namespace App\Controller;

use App\Repository\TableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TableController extends AbstractController
{
    #[Route('/api/table', name: 'app_table', methods:['GET'])]
    public function GetTable(TableRepository $tableRepository)
    {
        return $this->json($tableRepository->findAll());
    }
}