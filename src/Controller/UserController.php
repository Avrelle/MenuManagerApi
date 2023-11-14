<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Security;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{
    #[Route(path: "/api/login", name:"api_login", methods:["POST"])]
    public function loginApi(Request $request, JWTTokenManagerInterface $JWTManager, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher) 
    {
       $user = json_decode($request->getContent(), true);
       $findUser = $userRepository->findOneBy(["username" => $user["username"]]);

       if(!isset($findUser, $user['username'])){
        return new JsonResponse('erreur nom utilisateur invalide');
       }
       
       if(!$passwordHasher->isPasswordValid($findUser, $user['password'])){
        return new JsonResponse('erreur mot de passe invalide');
       };

       
       return new JsonResponse(['token' => $JWTManager->create($findUser)]);
    }

   
    

}