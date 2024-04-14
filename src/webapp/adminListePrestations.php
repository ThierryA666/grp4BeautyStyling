<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Prestation;

error_reporting(E_ALL);

session_start();

if (isset($_SERVER['HTTP_REFERER']) &&  $_SERVER['HTTP_REFERER'] !== 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']) unset($_SESSION['msgUtilisateur']);
$msgUtilisateur =  isset($_SESSION['msgUtilisateur']) ? ($_SESSION['msgUtilisateur']['msgShow'] ? $_SESSION['msgUtilisateur'] : null ) : ['success' => true, 'message' => 'Bienvenue à BeautyStyling!', 'style' => 'text-primary',  'msgShow' => true];
$dummy = [$prestation = new Prestation(0, '',  new \DateTime( '00:00:00'), 1, new \DateTime())];
//var_dump($_POST);
try {
  $daoBeauty = new DaoBeauty();
} catch (\Exception $e) {
  header('Location:./error.php');
}

try {
    $prestaList = $daoBeauty->getPrestations();
    if (!empty($prestaList)) {
      $tabIndex = array_keys($prestaList);
    } else {
      $prestaList = $dummy;
      $msgUtilisateur =  ['success' => false, 'message' => 'BeautyStyling Error, il n\'y pas de prestations dans le système BeautyStyling!', 'style' => 'text-danger', 'msgShow' => true];
      $_SESSION['msgUtilisateur'] = $msgUtilisateur;
    }   
} catch (\Exception $e) {
  $msgUtilisateur =  ['success' => false, 'message' => 'BeautyStyling Error, il n\'y pas de prestations dans le système BeautyStyling!', 'style' => 'text-danger', 'msgShow' => true];
  $_SESSION['msgUtilisateur'] = $msgUtilisateur;
  $prestaList = $dummy;
} catch (\Error $error) {
  $msgUtilisateur =  ['success' => false, 'message' => 'BeautyStyling Error, il n\'y pas de prestations dans le système BeautyStyling!', 'style' => 'text-danger', 'msgShow' => true];
  $_SESSION['msgUtilisateur'] = $msgUtilisateur;
  $prestaList = $dummy;
}

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST'){
  if (isset($_POST['goBackList']) && $_POST['goBackList'] === 'goBackList') {
    $afficher2 = '';
    ['success' => true, 'message' => 'Bienvenue à BeautyStyling!', 'style' => 'text-primary',  'msgShow' => false];
  } else {
    try {
      if (isset($_POST['key']) ) {
        if (in_array($_POST['key'], $tabIndex)) {
          $prestation = $prestaList[intval(htmlspecialchars(trim($_POST['key'])))];
          $response = $daoBeauty->deletePrestation($prestation);
          if ($response) {
            unset( $prestaList[intval(htmlspecialchars(trim($_POST['key'])))]);
            $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, la prestation ' . $prestation->getNomPresta() . ' a été supprimée!', 'style' => 'text-primary', 'msgShow' => true];
            $_SESSION['msgUtilisateur'] = $msgUtilisateur;
          } else {
            $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la prestation sélectionnée n\'existe pas!', 'style' => 'text-danger', 'msgShow' => true];
            $_SESSION['msgUtilisateur'] = $msgUtilisateur;
          }      
        } else { 
          $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la prestation sélectionnée n\'existe pas!', 'style' => 'text-danger', 'msgShow' => true];
          $_SESSION['msgUtilisateur'] = $msgUtilisateur;
        }
      } else {
        $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la prestation sélectionnée n\'existe pas!', 'style' => 'text-danger', 'msgShow' => true];
        $_SESSION['msgUtilisateur'] = $msgUtilisateur;
      }
    } catch (\Exception $e) {
      $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la prestation sélectionnée n\'existe pas!', 'style' => 'text-danger', 'msgShow' => true];    
      $_SESSION['msgUtilisateur'] = $msgUtilisateur;
    }
  }
}

include '../view/vadminListePrestations.php';
?>