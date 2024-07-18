<?php

namespace App\Controller;

use App\Constants\MyGlobals;
use App\Repository\CarRepository;
use App\Repository\CategoryRepository;
use App\Repository\SpaceshipRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use function PHPSTORM_META\map;
use function PHPUnit\Framework\assertIsObject;

class MainController extends AbstractController
{
   #[Route('/', name: 'app_mainpage')]
   public function homepage(CategoryRepository $repository): Response
   {
      $categories = $repository->findAll();
      return $this->render('main/main.html.twig', [
         'categories' => $categories,
      ]);
   }

   #[Route('/about', name: 'app_aboutpage')]
   public function aboutpage(): Response
   {
      $rawJson = file_get_contents('../composer.json');
      $decodedJson = json_decode($rawJson, true);
      (array) $arrInfo = ['description', 'type', 'authors', 'license'];
      foreach ($arrInfo as $key) {            //*TODO   proper conversion from object!
         if (!is_array($decodedJson[$key])) {
            $infoArray[$key] = $decodedJson[$key];
         } else {
            $tmp1 = (array) $decodedJson[$key];
            foreach ($tmp1 as $tmp2) {
               foreach ($tmp2 as $k => $v) {
                  $infoArray["$key.$k"] = (string) $v;
               }
            }
         }
      };
      return $this->render('main/about.html.twig', ['app_info' => $infoArray]);
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