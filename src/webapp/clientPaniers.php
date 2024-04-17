<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Client;

error_reporting(E_ALL);
session_start();


try { //check for DB connection
  $daoBeauty = new DaoBeauty();
} catch (\Exception $e) {
  header('Location:./error.php');
}

$client = new Client(1, 'Thierry');
$clientSalons = array();
$rndvs = array();

try{ //Retrieve  les réservation du client
  $reservations = $daoBeauty->getRendezVous();
  foreach($reservations as $key => $item) {
    if ($item->getId_client()->getIdClient() === $client->getIdClient()) {
        array_push($rndvs, $item);
        array_push($clientSalons, $item->getId_salon());
    }
  }
} catch (\Exception $e) {
  header('Location:./error.php');
  exit;
}

$clientSalons = array_unique($clientSalons,SORT_STRING); //create liste of unique salon from the search dropdown
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['salons']) && isset($_POST['search']) && $_POST['salons'] !== 'showAll'  && $_POST['dateAfter'] === '' && $_POST['dateBefore'] === '') {
    $key = intval(htmlspecialchars(trim(substr($_POST['salons'],5))));
    $salon = $clientSalons[$key];
    try {
      $rndvs = [];
      $reservations = $daoBeauty->getReservationsBySalon($salon);
      foreach($reservations as $key => $item) {
        if ($item->getId_client()->getIdClient() === $client->getIdClient()) {
            array_push($rndvs, $item);
        }
      }
    } catch (\Exception $e) {
      header('Location:./error.php');
      exit;
    }
  } elseif (isset($_POST['search']) && $_POST['salons'] === 'showAll' && $_POST['dateAfter'] === '' && $_POST['dateBefore'] === '') {
    echo ('I am there!');
    $rndvs = [];
    foreach($reservations as $key => $item) {
      if ($item->getId_client()->getIdClient() === $client->getIdClient()) {
          array_push($rndvs, $item);
      }
    }
  } elseif (isset($_POST['search']) && $_POST['salons'] !== 'showAll' && ($_POST['dateAfter'] !== '' || $_POST['dateBefore'] !== '')) {
    echo ('I am here!');
    $key = intval(htmlspecialchars(trim(substr($_POST['salons'],5))));
    $salon = $clientSalons[$key];
    try {
      $rndvs = [];
      $reservations = $daoBeauty->getReservationsBySalon($salon);
      foreach($reservations as $key => $item) {
        if ($item->getId_client()->getIdClient() === $client->getIdClient()) {
            array_push($rndvs, $item);
        }
      }
    } catch (\Exception $e) {
      header('Location:./error.php');
      exit;
    }
    $dateBefore = htmlspecialchars(trim($_POST['dateBefore']));
    $dateAfter = htmlspecialchars(trim($_POST['dateAfter']));
    $rndvDates = array();
    foreach ($rndvs as $key => $reservation) {
      $dateRDV = $reservation->getD_rndv()->format('Y-m-d');
      if ($dateAfter && $dateBefore) {
        if ($dateRDV >= $dateAfter && $dateRDV <= $dateBefore) array_push($rndvDates, $reservation);
      } elseif ($dateAfter) {
        if ($dateRDV >= $dateAfter) array_push($rndvDates, $reservation);
      } elseif ($dateBefore) {
        if ($dateRDV <= $dateBefore) array_push($rndvDates, $reservation);
      } 
      $rndvs = $rndvDates;
    }
  } elseif (isset($_POST['search']) && $_POST['salons'] === 'showAll' && $_POST['dateAfter'] === '' && $_POST['dateBefore'] === '') {
    echo ('I am there!');
    $rndvs = [];
    foreach($reservations as $key => $item) {
      if ($item->getId_client()->getIdClient() === $client->getIdClient()) {
          array_push($rndvs, $item);
      }
    }
  } else {
  // echo ('I am nowhere!');
  //No processing to be done
  }
}

include '../view/vclientPaniers.php';
?>