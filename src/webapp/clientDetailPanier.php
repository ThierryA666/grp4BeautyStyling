<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Client;
use beautyStyling\metier\LigneDetails;
use beautyStyling\metier\Employe;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;
use beautyStyling\metier\Salon;

// use beautyStyling\metier\Etat;
// use beautyStyling\metier\Prestation;
// use beautyStyling\metier\Reservation;
// use beautyStyling\metier\Salon;

error_reporting(E_ALL);
session_start();

try { //check for DB connection
  $daoBeauty = new DaoBeauty();
} catch (\Exception $e) {
  header('Location:./error.php');
}
$totalPanier = 0;
$client = new Client(1, 'Thierry');
$reservationDetails = array();

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') { 
  if (isset($_POST['detail']) && substr(htmlspecialchars(trim($_POST['detail'])),0,6) === 'detail') {
    $key = intval(substr(htmlspecialchars(trim($_POST['detail'])),6));
  } elseif (isset($_POST['modifLigne']) && isset($_POST['qte']) && isset($_POST['idRndv']) && isset($_POST['numLigne']) && isset($_POST['idPresta'])) {
    $key = intval(htmlspecialchars(trim($_POST['idRndv'])));
    $presta = intval(htmlspecialchars(trim($_POST['idPresta'])));
    $qte = intval(htmlspecialchars(trim($_POST['qte'])));
    $numLigne = intval(htmlspecialchars(trim($_POST['numLigne'])));
    try {
      $reservationDetails = $daoBeauty->getReservationById($key);
      $ligneDetails = new LigneDetails($reservationDetails, $daoBeauty->getPrestationByID($presta), $numLigne, new Employe(1,''), $qte);
      $response = $daoBeauty->updateLigneDetails($ligneDetails);
      if (!$response) {
        header('Location:./error.php');
        exit;
      }
    } catch (\Exception $e) {
      header('Location:./error.php');
      exit;
    }
  } elseif (isset($_POST['suppReservation'])) {
    $key = intval(htmlspecialchars(trim($_POST['suppReservation'])));
    try {
      $reservationDetails = $daoBeauty->getLigneDetailsByRndv($key);
      $ligneDetails = $reservationDetails[0];
      $response = $daoBeauty->deleteLigneDetails($ligneDetails);
      if ($response) {
        $daoBeauty->deleteReservation(new Reservation($ligneDetails->getIdRDV()->getId_rndv(), new \DateTime(), new \DateTime(), '', '', new Etat (1, 'Encours'), new Client(1,('Maria')), new Salon(0, '','', '', '', '', '', '', '', '', '', '', new \DateTime(), '')));
        $key = 0;
        unset($reservationDetails);
        header('Location:./clientPaniers.php');
      }
    } catch (\Exception $e) {
      header('Location:./error.php');
      exit;
    }
 
  } else {
    header('Location:./clientPaniers.php');
    exit;
  }
  try {
    $offrirs = array();
    $totalPanier = 0;
    $reservationDetails = $daoBeauty->getLigneDetailsByRndv($key);
    foreach($reservationDetails as $key => $reservationDetail) {
      $offrir = $daoBeauty->getOffrir($reservationDetail->getIdRDV()->getId_salon(), $reservationDetail->getIdPresta());
      array_push($offrirs,$offrir);
      $totalPanier += $reservationDetail->getQte() * ($offrir ? ($offrir->getPrix_prest_salon() != 0 ? $offrir->getPrix_prest_salon() : $reservationDetail->getIdPresta()->getPrixIndPrestaEuro()) : $reservationDetail->getIdPresta()->getPrixIndPrestaEuro());
    }
  } catch (\Exception $e) {
    header('Location:./error.php');
    exit;   
  }
} else {
  header('Location:./clientPaniers.php');
  exit;
}

include '../view/vclientDetailPanier.php';
?>