<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Client;

error_reporting(E_ALL);
session_start();

  function searchReservationBydate(array $rndvs, String $dateBefore, String $dateAfter): array {
    $rndvDates = array();
    foreach ($rndvs as $reservation) {
      $dateRDV = $reservation->getD_rndv()->format('Y-m-d');
      if ($dateAfter && $dateBefore) {
        if ($dateRDV >= $dateAfter && $dateRDV <= $dateBefore) array_push($rndvDates, $reservation);
      } elseif ($dateAfter) {
        if ($dateRDV >= $dateAfter) array_push($rndvDates, $reservation);
      } elseif ($dateBefore) {
        if ($dateRDV <= $dateBefore) array_push($rndvDates, $reservation);
      }
    }
    return $rndvDates;
  }

  function getReservationsByClient(array $reservations, Client $client) : array {
    $rndvs = array();
    foreach($reservations as $item) {
      if ($item->getId_client()->getIdClient() === $client->getIdClient()) {
          array_push($rndvs, $item);
      }
    }
    return $rndvs;
  }

  function getUniqueSalonsListe(array $reservations, Client $client) : array {
    $clientSalons = array();
    foreach($reservations as $item) {
      if ($item->getId_client()->getIdClient() === $client->getIdClient()) {
          array_push($clientSalons, $item->getId_salon());
      }
    }
    return array_unique($clientSalons,SORT_STRING); //create liste of unique salon from the search dropdown
  }

try { //check for DB connection
  $daoBeauty = new DaoBeauty();
} catch (\Exception $e) {
  header('Location:./error.php');
}

$client = new Client(1, 'Thierry');
$clientSalons = array();
$rndvs = array();
$selected = false;

try{ //Retrieve  les réservations du client
  $reservations = $daoBeauty->getRendezVous();
  $rndvs = getReservationsByClient($reservations, $client);
  $clientSalons = getUniqueSalonsListe($reservations, $client);
} catch (\Exception $e) {
  header('Location:./error.php');
  exit;
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['salons']) && isset($_POST['search']) && $_POST['salons'] !== 'showAll'  && $_POST['dateAfter'] === '' && $_POST['dateBefore'] === '') {   
    try {
      $key = intval(htmlspecialchars(trim(substr($_POST['salons'],5))));
      $salonSelected = $clientSalons[$key];
      $selected = true;
      $rndvs = [];
      $reservations = $daoBeauty->getReservationsBySalon($salonSelected);
      $rndvs = getReservationsByClient($reservations, $client);
    } catch (\Exception $e) {
      header('Location:./error.php');
      exit;
    }
  } elseif (isset($_POST['search']) && $_POST['salons'] === 'showAll' && ($_POST['dateAfter'] !== '' || $_POST['dateBefore'] !== '')) {
    $rndvs = [];
    $rndvs = getReservationsByClient($reservations, $client);
    $dateBefore = htmlspecialchars(trim($_POST['dateBefore']));
    $dateAfter = htmlspecialchars(trim($_POST['dateAfter']));
    $rndvs = searchReservationBydate($rndvs, $dateBefore, $dateAfter);
  } elseif (isset($_POST['search']) && $_POST['salons'] !== 'showAll' && ($_POST['dateAfter'] !== '' || $_POST['dateBefore'] !== '')) {   
    try {
      $key = intval(htmlspecialchars(trim(substr($_POST['salons'],5))));
      $salonSelected = $clientSalons[$key];
      $selected = true;
      $rndvs = [];
      $reservations = $daoBeauty->getReservationsBySalon($salonSelected);
      $rndvs = getReservationsByClient($reservations, $client);
      $dateBefore = htmlspecialchars(trim($_POST['dateBefore']));
      $dateAfter = htmlspecialchars(trim($_POST['dateAfter']));
      $rndvs = searchReservationBydate($rndvs, $dateBefore, $dateAfter);
    } catch (\Exception $e) {
      header('Location:./error.php');
      exit;
    }
  } elseif (isset($_POST['search']) && $_POST['salons'] === 'showAll' && $_POST['dateAfter'] === '' && $_POST['dateBefore'] === '') {
    $rndvs = [];
    $rndvs = getReservationsByClient($reservations, $client);
  } else {
  // echo ('I am nowhere!');
  //No processing to be done
  }
}

include '../view/vclientPaniers.php';
?>