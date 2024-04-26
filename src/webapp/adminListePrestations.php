<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Prestation;

error_reporting(E_ALL);

session_start();

try { //check DB connection
  $daoBeauty = new DaoBeauty();
} catch (\Exception $e) {
  header('Location:./error.php');
}

//Not very useful, it's just to set the message on first entry
if (isset($_SERVER['HTTP_REFERER']) &&  $_SERVER['HTTP_REFERER'] !== 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI']) unset($_SESSION['msgUtilisateur']);
$msgUtilisateur =  isset($_SESSION['msgUtilisateur']) ? ($_SESSION['msgUtilisateur']['msgShow'] ? $_SESSION['msgUtilisateur'] : $msgUtilisateur ) : ['success' => true, 'message' => 'Bienvenue à BeautyStyling!', 'style' => 'text-primary',  'msgShow' => true];
$dummy = [$prestation = new Prestation(0, '',  3600, 100, new \DateTime())];

try { //calling DB
    $prestaList = $daoBeauty->getPrestations();
    if (!empty($prestaList)) {
      $tabIndex = array_keys($prestaList);
      unset($_SESSION['msgUtilisateur']);
    } else {
      $prestaList = $dummy;
      $msgUtilisateur =  ['success' => false, 'message' => 'BeautyStyling Error, il n\'y pas de prestations dans le système BeautyStyling!', 'style' => 'text-danger', 'msgShow' => true];
      $_SESSION['msgUtilisateur'] = $msgUtilisateur;
      session_destroy($_SESSION);
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
  if (isset($_POST['goBackList']) && $_POST['goBackList'] === 'goBackList') { //coming from somewhere else
    $afficher2 = '';
    $msgUtilisateur = ['success' => true, 'message' => 'Bienvenue à BeautyStyling!', 'style' => 'text-primary',  'msgShow' => false];
  } else {
    try { //here handling the deletion of a prestation process, it calls a modal for confirmation of delete
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
      $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, Impossible de supprimer la prestation ' .$prestation->getNomPresta() . ' car elle est rattachée à d\'autres évènements!', 'style' => 'text-danger', 'msgShow' => true];    
      $_SESSION['msgUtilisateur'] = $msgUtilisateur;
    }
  }
}

include '../view/admin/vadminListePrestations.php';
?>