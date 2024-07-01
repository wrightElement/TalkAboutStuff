<?php

namespace App\Repository;

use App\Model\Category;
use App\Model\ThingCategoryEnum;
use Psr\Log\LoggerInterface;

class CategoryRepository
{
   public function __construct(private LoggerInterface $logger)
   {
   }

   public function findAll(): array
   {
      $this->logger->info('Category collection (REPOSITORY) retrieved');
      return [
         new Category(
            1,
            ThingCategoryEnum::AUTOS,
         ),
         new Category(
            2,
            ThingCategoryEnum::SHIPS,
         ),
         new Category(
            3,
            ThingCategoryEnum::PLANES,
         ),
         new Category(
            4,
            ThingCategoryEnum::SPACESHIPS,
         ),
      ];
   }

   public function find(int $id): ?Category
   {
      foreach ($this->findAll() as $category) {
         if ($category->getId() === $id) {
            return $category;
         }
      }
      return null;
   }
}
