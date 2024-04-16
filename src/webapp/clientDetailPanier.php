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

$reservationDetails = $daoBeauty->getReservationDetailsByRndv($client->getIdClient());

foreach($reservationDetails as $key => $reservationDetail) {
}

include '../view/vclientDetailPanier.php';
?>