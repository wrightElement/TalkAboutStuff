<?php

namespace App\Model;

class Category
{
   public function __construct(
      private int $id,
      private ThingCategoryEnum $category,
      // private string $image,
   ) {
   }
   public function getId(): int
   {
      return $this->id;
   }
   public function getCategory(): ThingCategoryEnum
   {
      return $this->category;
   }
   public function getCategoryString(): String
   {
      return $this->category->value;
   }
   public function getImage(): string
   {
      return 'images/category' . $this->category . '.jpg';
   }
}
