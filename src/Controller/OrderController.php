<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Order;
use App\Entity\OrderDescription;
use App\Entity\Plate;
use App\Repository\OrderDescriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    #[Route(path: "/api/order/plate", name: "api_order_plate", methods: ["POST"])]
    public function PostOrderPlate(Request $request, EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true);
       
        if (isset($data['id'])) { 
            $plateId = $data['id'];

            
            
            $orderDesc = new OrderDescription(); 
            $orderDesc->setCreatedAt(new \DateTimeImmutable()); 
    
        
            $plate = $entityManager->getRepository(Plate::class)->find($plateId);
    
            if (!$plate) {
                return new JsonResponse(['message' => 'Plat non trouvé'], 404);
            }
    
        
            $orderDesc->addPlate($plate);
    
            $entityManager->persist($orderDesc); 
            $entityManager->flush(); 
    
            return new JsonResponse(['message' => 'Plat ajouté avec succès à la commande'], 201);
        }
        return new JsonResponse(['message' => 'Champ "plateId" manquant dans la requête'], 400);
    }

    #[Route(path: "/api/order/menu", name: "api_order_menu", methods: ["POST"])]
    public function PostOrderMenu(Request $request, EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true);
       
        if (isset($data['id'])) {
            $menuId = $data['id'];
    
            
            $orderDesc = new OrderDescription(); 
            $orderDesc->setCreatedAt(new \DateTimeImmutable()); 
    
        
            $menu = $entityManager->getRepository(Menu::class)->find($menuId);
    
            if (!$menu) {
                return new JsonResponse(['message' => 'Menu non trouvé'], 404);
            }
    
            $orderDesc->addMenu($menu);
    
            $entityManager->persist($orderDesc); 
            $entityManager->flush(); 
    
            return new JsonResponse(['message' => 'Plat ajouté avec succès à la commande'], 201);
        }
        return new JsonResponse(['message' => 'Champ "menuId" manquant dans la requête'], 400);
    }
    #[Route('/api/orderdescription', name: 'app_order_description', methods:['GET'])]
    public function GetTable(OrderDescriptionRepository $orderDescriptionRepository)
    {
        return $this->json($orderDescriptionRepository->findAll());
    }

    #[Route(path: "/api/order/create", name: "api_order_create", methods: ["POST"])]
    public function createOrder(Request $request, EntityManagerInterface $entityManager)
    {
        $data = json_decode($request->getContent(), true);
    
        // Vérifiez les données reçues pour vous assurer que tout est correct
        if (isset($data['orderDescriptions']) && is_array($data['orderDescriptions'])) {
            $order = new Order(); // Créez une nouvelle commande
    
            foreach ($data['orderDescriptions'] as $descriptionId) {
                // Récupérez la description de commande à partir de son identifiant
                $orderDesc = $entityManager->getRepository(OrderDescription::class)->find($descriptionId);
    
                if (!$orderDesc) {
                    return new JsonResponse(['message' => 'Description de commande non trouvée'], 404);
                }
    
                // Associez la description de commande à la commande principale
                $order->addOrderDescription($orderDesc);
            }
    
            // Enregistrez la commande avec ses descriptions associées
            $entityManager->persist($order);
            $entityManager->flush();
    
            return new JsonResponse(['message' => 'Commande créée avec succès'], 201);
        }
    
        return new JsonResponse(['message' => 'Données de commande manquantes ou invalides'], 400);
    }
    
}