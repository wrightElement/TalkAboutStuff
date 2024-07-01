<?php

namespace App\Controller;

use App\Repository\CarRepository;
use App\Repository\CategoryRepository;
use App\Repository\SpaceshipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
   #[Route('/', name: 'app_homepage')]
   public function homepage(CategoryRepository $repository): Response
   {
      $categories = $repository->findAll();
      return $this->render('main/main.html.twig', [
         'categories' => $categories,
      ]);
   }

   #[Route('/cars', name: 'app_cars')]
   public function cars(CarRepository $repository): Response
   {
      $things = $repository->findAll();
      // $carCount = count($cars);
      $myThing = $things[array_rand($things)];
      return $this->render('main/main.html.twig', [
         // 'numberOfCars' => $carCount,
         'myThing' => $myThing,
         'things' => $things,
      ]);
   }

   #[Route('/spaceships', name: 'app_spaceships')]
   public function spaceships(SpaceshipRepository $repository): Response
   {
      $things = $repository->getShips();
      // $carCount = count($cars);
      $myThing = $things[array_rand($things)];
      return $this->render('main/main.html.twig', [
         // 'numberOfCars' => $carCount,
         'myThing' => $myThing,
         'things' => $things,
      ]);
   }
}
