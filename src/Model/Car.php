<?php

namespace App\Model;

class Car
{
   public function __construct(
      private int $id,
      private string $name,
      private string $class,
      private string $driver,
      private CarStatusEnum $status,
      // private string $image,
   ) {
   }
   public function getId(): int
   {
      return $this->id;
   }
   public function getName(): string
   {
      return $this->name;
   }
   public function getClass(): string
   {
      return $this->class;
   }
   public function getDriver(): string
   {
      return $this->driver;
   }
   public function getStatus(): CarStatusEnum
   {
      return $this->status;
   }
   public function getImage(): string
   {
      return 'images/car' . $this->id . '.jpg';
   }
   public function getStatusString(): string
   {
      return $this->status->value;
   }
   public function getStatusImageFilename(): string
   {
      return match ($this->status) {
         CarStatusEnum::INACTIVE => 'images/status-inactive.jpg',
         CarStatusEnum::LEAD => 'images/status-lead.jpg',
         CarStatusEnum::NEW => 'images/status-new.jpg',
         CarStatusEnum::REPAIR => 'images/status-repair.jpg',
      };
   }
}
