<?php

namespace App\Controller;

// use App\Constants\MyGlobals;
use App\Repository\CarRepository;
use App\Repository\CategoryRepository;
use App\Repository\SpaceshipRepository;
// use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// use function PHPSTORM_META\map;
// use function PHPUnit\Framework\assertIsObject;

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
      $infoArray = [];
      $requiredInfo = ['name', 'description', 'version', 'license', 'owner', 'authors', 'mode', 'type'];
      foreach ($requiredInfo as $key) {       //*TODO  properly convert deep objects!
         if (!array_key_exists($key, $decodedJson)) continue;
         if (!is_array($decodedJson[$key])) {
            $infoArray[$key] = $decodedJson[$key];
         } else {
            $tmp1 = (array) $decodedJson[$key];
            foreach ($tmp1 as $tmp2) {
               foreach ($tmp2 as $k => $v) {
                  $infoArray[$key . "_" . $k] = (string) $v;
               }
            }
         }
      };
      return $this->render('main/about.html.twig', ['app_info' => $infoArray]);
   }

   #[Route('/autos', name: 'Autos')]
   public function cars(CarRepository $repository): Response
   {
      $things = $repository->findAll();
      $myThing = $things[array_rand($things)];
      return $this->render('main/main.html.twig', [
         'myThing' => $myThing,
         'things' => $things,
      ]);
   }

   #[Route('/ships', name: 'Ships')]
   public function ships(CarRepository $repository): Response
   {
      $things = $repository->findAll();
      $myThing = $things[array_rand($things)];
      return $this->render('main/main.html.twig', [
         'myThing' => $myThing,
         'things' => $things,
      ]);
   }

   #[Route('/planes', name: 'Planes')]
   public function planes(CarRepository $repository): Response
   {
      $things = $repository->findAll();
      $myThing = $things[array_rand($things)];
      return $this->render('main/main.html.twig', [
         'myThing' => $myThing,
         'things' => $things,
      ]);
   }

   #[Route('/spaceships', name: 'Spaceships')]
   public function spaceships(SpaceshipRepository $repository): Response
   {
      $things = $repository->getShips();
      $myThing = $things[array_rand($things)];
      return $this->render('main/main.html.twig', [
         'myThing' => $myThing,
         'things' => $things,
      ]);
   }
}