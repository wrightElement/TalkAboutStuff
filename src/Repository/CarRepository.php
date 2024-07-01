<?php

namespace App\Repository;

use App\Model\Car;
use App\Model\CarStatusEnum;
use Psr\Log\LoggerInterface;

class CarRepository
{
   public function __construct(private LoggerInterface $logger)
   {
   }

   public function findAll(): array
   {
      $this->logger->info('Car collection (REPOSITORY) retrieved');
      return [
         new Car(
            1,
            'BadBoy',
            'Extreme',
            'MrBad',
            CarStatusEnum::LEAD,
         ),
         new Car(
            2,
            'LittleFlower',
            'Soft',
            'Darling',
            CarStatusEnum::NEW,
            // 'images/car2.jpg',
         ),
         new Car(
            3,
            'Warrior',
            'Maximus',
            'HitMan',
            CarStatusEnum::REPAIR,
            // 'images/car3.jpg',
         ),
         new Car(
            4,
            'GreenWheel',
            'Strong',
            'OakMan',
            CarStatusEnum::INACTIVE,
            // 'images/car4.jpg',
         ),
      ];
   }

   public function find(int $id): ?Car
   {
      foreach ($this->findAll() as $car) {
         if ($car->getId() === $id) {
            return $car;
         }
      }
      return null;
   }
}
