<?php

namespace App\Repository;

// use App\Model\Car;
// use App\Model\CarStatusEnum;

use Psr\Log\LoggerInterface;

// https://ll.thespacedevs.com/2.2.0/spacecraft/?format=json&limit=5

class SpaceshipRepository
{

   public function __construct(private LoggerInterface $logger)
   {
   }

   public function getShips(): array
   {
      $rest_api_url = 'https://ll.thespacedevs.com/2.2.0/spacecraft/?format=json&limit=3';
      // echo "<h1>" . $rest_api_url  . "</h1>";

      $curl = curl_init();
      curl_setopt_array($curl, array(
         CURLOPT_URL => $rest_api_url,
         // CURLOPT_CAPATH => '\etc\ssl\certs',
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
         ),
      ));
      // curl_setopt($curl, CURLOPT_URL, $rest_api_url);
      // curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
      $response = curl_exec($curl);
      curl_close($curl);

      // $client = new Client();
      // $request = new Request('GET', 'https://dummy.restapiexample.com/api/v1/employee/1');
      // $response = $client->send($request);
      // echo $response->getStatusCode(); // 200
      // echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'

      echo "<h1>Dump:</h1>";
      var_dump($response);

      echo "<h1>Response:</h1>";
      // $resp_body =  (string)$response->getBody();
      $resp_body = json_decode($response, true);
      foreach ($resp_body['results'] as $result) {
         // print_r($result);
         echo $result['name'];
         echo ' / ';
         echo $result['status']['name'];
         echo ' / ';
         echo $result['description'];
         echo ' / ';
         echo $result['spacecraft_config']['agency']['name'];
         echo '<img src="' . $result['spacecraft_config']['image_url'] . '" width=300>';
         echo '<br>';
      }

      exit();
   }

   public function findAll(): array
   {
      $curl = curl_init();

      curl_setopt_array($curl, array(
         CURLOPT_URL => "https://ll.thespacedevs.com/2.2.0/spacecraft/?limit=1",
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_TIMEOUT => 30,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => "GET",
         CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
         ),
      ));

      $response = curl_exec($curl);
      $err = curl_error($curl);

      curl_close($curl);
      $response = json_decode($response, true); //because of true, it's in an array      
      print_r($response);

      $this->logger->info('Ships collection (REPOSITORY) retrieved');

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
   public function find(int $id): ?Ship
   {
      foreach ($this->findAll() as $car) {
         if ($car->getId() === $id) {
            return $car;
         }
      }
      return null;
   }
}
