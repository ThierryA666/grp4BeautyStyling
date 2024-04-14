<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Prestation;

error_reporting(E_ALL);
session_start();

try {
  $daoBeauty = new DaoBeauty();
} catch (\Exception $e) {
  header('Location:./error.php');
}

const MAX_LENGTH = 5;
const MIN = 1;
const MAX = 12;
$min = MIN;
$max = MAX;
$maxLength = MAX_LENGTH;


unset($_SESSION['msgUtilisateur']);
$disabled = 'true';
$afficher2 = '';
$msgUtilisateur =  isset($_SESSION['msgUtilisateur']) ? ($_SESSION['msgUtilisateur']['msgShow'] ? $_SESSION['msgUtilisateur'] : null ) : ['success' => true, 'message' => 'Bienvenue à BeautyStyling!', 'style' => 'text-primary',  'msgShow' => false];

//var_dump($_SESSION);
//var_dump($_POST);
if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['key']) && substr(htmlspecialchars(trim($_POST['key'])),0,11) === 'modifPresta') {
    $buttonLabel = 'Sauvegarder';
    $afficher = '';
    $buttonID = 'buttonSave';
    $id = intval(substr($_POST['key'],11));
    try {
      $prestation= $daoBeauty->getPrestationByID(intval(substr(htmlspecialchars(trim($_POST['key'])),11)));
    } catch (\Exception $e) {
      $msgShow = true;
      $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la prestation demandée n\'existe pas!', 'style' => 'text-danger', 'msgShow' => true];
      $prestation = new Prestation(0, '',  new \DateTime( '01:00:00'), 1, new \DateTime());
      $buttonID = 'buttonCreate';
      $buttonLabel = 'Créer';
      $afficher = 'd-none';
      $disabled = false;
      $display = $prestation->getModifDate() ? '' : 'd-none';
    }
    $display = $prestation->getModifDate() ? '' : 'd-none';
    $_SESSION['prestation'] = $prestation;
  } elseif (isset($_POST['Sauvegarder']) && $_POST['Sauvegarder'] === 'Sauvegarder' && isset($_SESSION['prestation'])) {
    if (isset($_POST['duration']) && isset($_POST['description']) && isset($_POST['price']) && isset($_SESSION['prestation'])) {
      $duration = new \DateTime(date('Y-m-d') . ' ' . htmlspecialchars(trim($_POST['duration'])) . ':00:00');
      $modifDate = new \DateTime();
      $updatePrestation = new Prestation($_SESSION['prestation']->getIdPresta(), ($_SESSION['prestation']->getNomPresta()), $duration, floatval(htmlspecialchars(trim($_POST['price']))), $_SESSION['prestation']->getCreationDate(), $modifDate, htmlspecialchars(trim($_POST['description'])));
      $display = $modifDate ? '' : 'd-none';
      try {
        $response = $daoBeauty->updatePrestation($updatePrestation);
        if ($response) {
          $prestation = $updatePrestation;
          $buttonID = 'buttonSave';
          $buttonLabel = 'Sauvegarder';
          $afficher = '';
          $display = $prestation->getModifDate() ? '' : 'd-none';
          $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling, la prestation ' . $prestation->getNomPresta() . ' a été mise à jour!', 'style' => 'text-primary', 'msgShow' => true];
          $_SESSION['prestation'] = $prestation;
        }
      } catch (\Exception $e) {
        $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la prestation demandée n\'existe pas!', 'style' => 'text-danger', 'msgShow' => true];
        $prestation = new Prestation(0, '',  new \DateTime( '01:00:00'), 1, new \DateTime());
        $buttonID = 'buttonCreate';
        $buttonLabel = 'Créer';
        $afficher = 'd-none';
        $disabled = false;
        $display = $prestation->getModifDate() ? '' : 'd-none';
      }
    }
  } else if (isset($_POST['Supprimer']) && $_POST['Supprimer'] === 'Supprimer' && isset($_SESSION['prestation'])) {
    try {
      $response = $daoBeauty->deletePrestation($_SESSION['prestation']);
      if ($response) {
        $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, Suppression de la prestation ' . $_SESSION['prestation']->getNomPresta() . ' effectuée avec succès!', 'style' => 'text-primary', 'msgShow' => true];
        unset($_SESSION['prestation']);
        //unset($_POST);
        $prestation = new Prestation(0, '',  new \DateTime( '01:00:00'), 1, new \DateTime());
        $buttonID = 'buttonCreate';
        $buttonLabel = 'Créer';
        $afficher = 'd-none';
        $disabled = false;
        $display = $prestation->getModifDate() ? '' : 'd-none';
        //header('Location:./adminListePrestations.php');
      } else {
        $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, Suppression de la prestation ' . $prestation->getNomPresta() . ' a échoué!', 'style' => 'text-primary', 'msgShow' => true];
      } 
    } catch (\Exception $e) {
       $prestation = $_SESSION['prestation'];
       $buttonLabel = 'Sauvegarder';
       $display = $prestation->getModifDate() ? '' : 'd-none';
       $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la suppression de la prestation ' . $prestation->getNomPresta() . ' a échoué', 'style' => 'text-danger', 'msgShow' => true];
    } 
  } elseif (isset($_POST['Créer']) && $_POST['Créer'] === 'Créer') {
    if (isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['duration']) && !empty($_POST['duration']) && isset($_POST['description']) && isset($_POST['price']) && !empty($_POST['price'])) {
      $prestation = new Prestation(0, '',  new \DateTime( '01:00:00'), 1, new \DateTime());
      $prestation->setNomPresta(htmlspecialchars(trim($_POST['name'])));
      $prestation->setDureePresta(new \DateTime(date('Y-m-d') . ' ' . htmlspecialchars(trim($_POST['duration'])) . ':00:00'));
      $prestation->setDescPresta(htmlspecialchars(trim($_POST['description'])));
      $prestation->setPrixIndPresta(floatval(htmlspecialchars(trim($_POST['price']))));
      try {
        $response = $daoBeauty->createPrestation($prestation);
        if ($response) {
          $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, création de la prestation ' . $prestation->getNomPresta() . ' effectuée avec succès!', 'style' => 'text-primary', 'msgShow' => true];
          unset($_SESSION['prestation']);
          $prestation = new Prestation(0, '',  new \DateTime( '01:00:00'), 1, new \DateTime());
          $buttonID = 'buttonCreate';
          $buttonLabel = 'Créer';
          $afficher = 'd-none';
          $disabled = false;
          $display = $prestation->getModifDate() ? '' : 'd-none';
        }
      } catch (\Exception $e) {
          $buttonID = 'buttonCreate';
          $buttonLabel = 'Créer';
          $afficher = 'd-none';
          $disabled = false;
          $display = $prestation->getModifDate() ? '' : 'd-none';
          $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, création de la prestation ' . $prestation->getNomPresta() . ' a échoué car elle existe déjà!', 'style' => 'text-danger', 'msgShow' => true];
      }
    } else {
        $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Info, les champs marqués d\'un astérique sont obligatoires!', 'style' => 'text-secondary', 'msgShow' => true];
        $prestation = new Prestation(0, '',  new \DateTime( '01:00:00'), 1, new \DateTime());
        $prestation->setNomPresta(htmlspecialchars(trim($_POST['name'])));
        $prestation->setDureePresta(new \DateTime(date('Y-m-d') . ' ' . htmlspecialchars(trim($_POST['duration'])) . ':00:00'));
        $prestation->setDescPresta(htmlspecialchars(trim($_POST['description'])));
        $prestation->setPrixIndPresta(floatval(htmlspecialchars(trim($_POST['price']))));
        $buttonID = 'buttonCreate';
        $buttonLabel = 'Créer';
        $afficher = 'd-none';
        $disabled = false;
        $display = $prestation->getModifDate() ? '' : 'd-none';
    }
  } else {
    unset( $_SESSION['prestation']);
    $prestation = new Prestation(0, '',  new \DateTime( '01:00:00'), 1, new \DateTime());
    $buttonID = 'buttonCreate';
    $buttonLabel = 'Créer';
    $afficher = 'd-none';
    $disabled = false;
    $display = $prestation->getModifDate() ? '' : 'd-none';
  }
}


include '../view/vadminPrestation.php';
?>