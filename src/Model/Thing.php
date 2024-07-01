<?php

namespace App\Model;

// string(911) "{"count":572,"next":"https://ll.thespacedevs.com/2.2.0/spacecraft/?format=json&limit=1&offset=1","previous":null,"results":[{"id":452,"url":"https://ll.thespacedevs.com/2.2.0/spacecraft/452/?format=json","name":"Crew Dragon","serial_number":"TBD","is_placeholder":true,"in_space":false,"time_in_space":"P0D","time_docked":"P0D","flights_count":0,"mission_ends_count":0,"status":{"id":1,"name":"Active"},"description":"The specific spacecraft for this launch is currently unknown.","spacecraft_config":{"id":6,"url":"https://ll.thespacedevs.com/2.2.0/config/spacecraft/6/?format=json","name":"Crew Dragon 2","type":{"id":2,"name":"Capsule"},"agency":{"id":121,"url":"https://ll.thespacedevs.com/2.2.0/agencies/121/?format=json","name":"SpaceX","type":"Commercial"},"in_use":true,"image_url":"https://spacelaunchnow-prod-east.nyc3.digitaloceanspaces.com/media/images/spacex_dm-2_cre_image_20200504065311.jpeg"}}]}"



// {"count":572,
//       "next":"https://ll.thespacedevs.com/2.2.0/spacecraft/?format=json&limit=1&offset=1",
//       "previous":null,
//*       "results":[
//          {
//             "id":452,
//*             "url":"https://ll.thespacedevs.com/2.2.0/spacecraft/452/?format=json",
//*             "name":"Crew Dragon",
//             "serial_number":"TBD",
//             "is_placeholder":true,
//             "in_space":false,
//             "time_in_space":"P0D",
//             "time_docked":"P0D",
//             "flights_count":0,
//             "mission_ends_count":0,
//             "status":{
//                "id":1,
//*                "name":"Active"},
//*             "description":"The specific spacecraft for this launch is currently unknown.",
//             "spacecraft_config":{
//                "id":6,
//                "url":"https://ll.thespacedevs.com/2.2.0/config/spacecraft/6/?format=json",
//                "name":"Crew Dragon 2",
//                "type":{
//                   "id":2,
//                   "name":"Capsule"},
//                "agency":{
//                   "id":121,
//                   "url":"https://ll.thespacedevs.com/2.2.0/agencies/121/?format=json",
//*                   "name":"SpaceX",
//                   "type":"Commercial"},
//                "in_use":true,
//*                "image_url":"https://spacelaunchnow-prod-east.nyc3.digitaloceanspaces.com/media/images/spacex_dm-2_cre_image_20200504065311.jpeg"}}]}

class Thing
{
   public function __construct(
      private int $id,
      private string $source, // URL or db connection etc?
      private string $name,
      private string $description,
      private ThingCategoryEnum $category,
      private ThingStatusEnum $status,
      private string $owner,
      // private string $driver,
      private string $image,
   ) {
   }
   public function getId(): int
   {
      return $this->id;
   }
   public function getSource(): int
   {
      return $this->source;
   }
   public function getName(): string
   {
      return $this->name;
   }
   public function getDescription(): string
   {
      return $this->description;
   }
   public function getCategory(): ThingCategoryEnum
   {
      return $this->category;
   }
   public function getOwner(): string
   {
      return $this->owner;
   }
   public function getStatus(): ThingStatusEnum
   {
      return $this->status;
   }
   public function getImage(): string
   {
      // return 'images/car' . $this->id . '.jpg';
      return $this->image;
   }
   public function getStatusString(): string
   {
      return $this->status->value;
   }
   public function getStatusImageFilename(): string
   {
      return match ($this->status) {
         ThingStatusEnum::ACTIVE => 'images/status-active.jpg',
         ThingStatusEnum::INACTIVE => 'images/status-inactive.jpg',
         ThingStatusEnum::NEW => 'images/status-new.jpg',
         ThingStatusEnum::RETIRED => 'images/status-repair.jpg',
         ThingStatusEnum::LOST => 'images/status-repair.jpg',
      };
   }
}
