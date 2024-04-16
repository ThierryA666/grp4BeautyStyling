<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Client;

error_reporting(E_ALL);
session_start();



$client = new Client(1, 'Thierry');
try { //check for DB connection
  $daoBeauty = new DaoBeauty();
} catch (\Exception $e) {
  header('Location:./error.php');
}

$clientSalons = array();
$rndvs = array();
$reservations = $daoBeauty->getRendezVous();
foreach($reservations as $key => $item) {
    if ($item->getId_client()->getIdClient() === $client->getIdClient()) {
        array_push($rndvs, $item);
        array_push($clientSalons, $item->getId_salon());
    }
}

function removeDuplicate($clientSalons) {
  $result = [];
  $i = 0;
  foreach($clientSalons as $key => $salon) {
    if(!in_array($salon, $result)) {
      $result[$i] = $salon;
      if (isset($result[$i])) {
        if ($result[$i]->getNom_salon() !== $salon->getNom_salon()) {
          $i++;
        }
      } else {
        $i--;
      }
    }
  }
  sort($result);
  return $result;
};

$clientSalons = removeDuplicate($clientSalons);


include '../view/vclientPaniers.php';
?>