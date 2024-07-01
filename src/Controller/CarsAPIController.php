<?php

namespace App\Controller;

use App\Model\Car;
use App\Repository\CarRepository;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/cars')]

class CarsAPIController extends AbstractController
{
   #[Route('', methods: ['GET'])]
   public function getCollection(CarRepository $repository): Response
   {
      // dd($repository);
      $cars = $repository->findAll();
      return $this->json($cars);
   }

   #[Route('/{id<\d+>}', methods: ['GET'])] # <\d+> :RegEx digit of any length
   public function get(int $id, CarRepository $repository): Response
   {
      // dd($id);
      $car = $repository->find($id);
      if (!$car) {
         throw $this->createNotFoundException('No Car Found');
      }
      return $this->json($car);
   }
}
