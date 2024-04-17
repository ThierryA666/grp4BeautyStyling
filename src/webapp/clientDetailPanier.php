<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Client;
use beautyStyling\metier\LigneDetails;
use beautyStyling\metier\Employe;
use beautyStyling\metier\Etat;
use beautyStyling\metier\Prestation;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Salon;


error_reporting(E_ALL);
session_start();

try { //check for DB connection
  $daoBeauty = new DaoBeauty();
} catch (\Exception $e) {
  header('Location:./error.php');
}
$totalPanier = 0;
$client = new Client(1, 'Thierry');
$employe = new Employe(5, 'Maria');
$reservationDetails = array();

//var_dump($_POST);
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') { 
  if (isset($_POST['detail']) && substr(htmlspecialchars(trim($_POST['detail'])),0,6) === 'detail') {
    $key = intval(substr(htmlspecialchars(trim($_POST['detail'])),6));
    // try {//en attendant que la partie reservation soit terminé
    //   if (empty($reservationDetails)) {
    //     // echo ('I am here!');
    //     $etat = new Etat(1,'En cours');
    //     $salon = new Salon(0,'','','','','','','','','','','', new \Datetime(),'');
    //     $reservation = new Reservation($key, new \DateTime(), new \DateTime(),'','',$etat, $client, $salon);
    //     $prestation = new Prestation(5,'',3600, 50, new \DateTime(),null, null);
    //     $ligneDetail = new LigneDetails($reservation,$prestation,1,$employe,1);
    //     $reponse = $daoBeauty->insertLigneDetail($ligneDetail);
    //     $reservationDetails = $daoBeauty->getLigneDetailsByRndv($key);
    //   }
    //   foreach($reservationDetails as $key => $reservationDetail) {
    //     $totalPanier += $reservationDetail->getIdPresta()->getPrixIndPrestaEuro() * $reservationDetail->getQte();
    //   }
    // } catch (\Exception $e) {
    //   echo '2-Oupppsss!!!';
    //   header('Location:./error.php');
    //   exit;
    // }
  } elseif (isset($_POST['modifLigne']) && isset($_POST['qte']) && isset($_POST['idRndv']) && isset($_POST['numLigne']) && isset($_POST['idPresta'])) {
    $key = intval(htmlspecialchars(trim($_POST['idRndv'])));
    $presta = intval(htmlspecialchars(trim($_POST['idPresta'])));
    $qte = intval(htmlspecialchars(trim($_POST['qte'])));
    $numLigne = intval(htmlspecialchars(trim($_POST['numLigne'])));
    try {
      $ligneDetails = new LigneDetails($daoBeauty->getReservationById($key), $daoBeauty->getPrestationByID($presta), $numLigne, $employe, $qte);
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
        $daoBeauty->delReservation($ligneDetails->getIdRDV()->getId_rndv());
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
    $reservationDetails = $daoBeauty->getLigneDetailsByRndv($key);
    foreach($reservationDetails as $key => $reservationDetail) {
      $totalPanier += $reservationDetail->getIdPresta()->getPrixIndPrestaEuro() * $reservationDetail->getQte();
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