<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Prestation;

error_reporting(E_ALL);
session_start();

try { //check for DB connection
  $daoBeauty = new DaoBeauty();
} catch (\Exception $e) {
  header('Location:./error.php');
}

const MAX_LENGTH = 6;
const MIN = 1;
const MAX = 12;
const MAX_PRICE = 99999;
const DFLT_DURATION = 3600;
const DFLT_PRICE = 100;
const DFLT_DURATION_HM = '01:00';
const DFLT_PRICE_EURO = '1,00';
$min = MIN;
$max = MAX;
$maxPrice = MAX_PRICE;
$maxLength = MAX_LENGTH;
$okPrice = true;
$okDuration = true;
$okName = true;
$dummy = new Prestation(0, '',  DFLT_DURATION, DFLT_PRICE, new \DateTime()); //$dummy object very useful to avoid display errors

unset($_SESSION['msgUtilisateur']);
$disabled = 'true';
$afficher2 = '';
$msgUtilisateur =  isset($_SESSION['msgUtilisateur']) ? ($_SESSION['msgUtilisateur']['msgShow'] ? $_SESSION['msgUtilisateur'] : null ) : ['success' => true, 'message' => 'Bienvenue à BeautyStyling!', 'style' => 'text-primary',  'msgShow' => false];

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') { //the user has clicked on something, also when called by adminListePrestations.php
  if (isset($_POST['key']) && substr(htmlspecialchars(trim($_POST['key'])),0,11) === 'modifPresta') {  //called from adminListePrestations.php with the ID of the prestation
    $buttonLabel = 'Sauvegarder';
    $afficher = '';
    $buttonID = 'buttonSave';
    $id = intval(substr(htmlspecialchars(trim($_POST['key'])),11));
    try { //all ok calling DB
      $prestation= $daoBeauty->getPrestationByID(intval(substr(htmlspecialchars(trim($_POST['key'])),11)));
      if ($prestation) {
        $display = $prestation->getModifDate() ? '' : 'd-none';
        //we instantiate a session variable to store the prestation
        $_SESSION['prestation'] = $prestation;
      } else {
        $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la prestation demandée n\'existe pas!', 'style' => 'text-danger', 'msgShow' => true];
        $prestation = $dummy;
        $buttonID = 'buttonCreate';
        $buttonLabel = 'Créer';
        $afficher = 'd-none';
        $disabled = false;
        $display = $prestation->getModifDate() ? '' : 'd-none';
      }
    } catch (\Exception $e) {
      $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la prestation demandée n\'existe pas!', 'style' => 'text-danger', 'msgShow' => true];
      $prestation = $dummy;
      $buttonID = 'buttonCreate';
      $buttonLabel = 'Créer';
      $afficher = 'd-none';
      $disabled = false;
      $display = $prestation->getModifDate() ? '' : 'd-none';
    }
  } elseif (isset($_POST['Sauvegarder']) && $_POST['Sauvegarder'] === 'Sauvegarder' && isset($_SESSION['prestation'])) { //We have a prestation to modify if needed
    if (isset($_POST['duration']) && isset($_POST['description']) && isset($_POST['price']) && isset($_SESSION['prestation'])) {
      //check for format hh:mm
      $pattern = '/^(\d{1,2}):(\d{2})$/';
      if (preg_match($pattern, htmlspecialchars($_POST['duration']))) {
        $okDuration = true;
        $_SESSION['prestation']->setDureePrestaHM(htmlspecialchars($_POST['duration']));
      } else {
        $okDuration = false;
        $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Info, la durée de la prestation doit être au format hh:mm', 'style' => 'text-danger', 'msgShow' => true];
        $prestation = $_SESSION['prestation'];
      }
      //check for format 999.99 or 999,99
      $pattern = '^\d{1,3}(?:[,.]\d{2})?$^';
      if (preg_match($pattern, htmlspecialchars($_POST['price']))) {
        $okPrice = true;
        $_SESSION['prestation']->setPrixIndPrestaEuro(htmlspecialchars($_POST['price']));
      } else {
        $okPrice = false;
        $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Info, la prix de la prestation doit être au format 999,99', 'style' => 'text-danger', 'msgShow' => true];
        $prestation = $_SESSION['prestation'];
      }
      if ($okPrice && $okDuration) {
        $_SESSION['prestation']->setModifDate(new \DateTime);
        $_SESSION['prestation']->setDescPresta(htmlspecialchars(trim($_POST['description'])));
        $display = $_SESSION['prestation']->getModifDate() ? '' : 'd-none';
        try { //All ok calling DB
          $response = $daoBeauty->updatePrestation($_SESSION['prestation']);
          if ($response) {
            $prestation = $_SESSION['prestation'];
            $buttonID = 'buttonSave';
            $buttonLabel = 'Sauvegarder';
            $afficher = '';
            $display = $prestation->getModifDate() ? '' : 'd-none';
            $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Info, la prestation ' . $prestation->getNomPresta() . ' a été mise à jour!', 'style' => 'text-primary', 'msgShow' => true];
            $_SESSION['prestation'] = $prestation;
          }
        } catch (\Exception $e) {
          $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la prestation demandée n\'existe pas!', 'style' => 'text-danger', 'msgShow' => true];
          $prestation = $dummy;
          $buttonID = 'buttonCreate';
          $buttonLabel = 'Créer';
          $afficher = 'd-none';
          $disabled = false;
          $display = $prestation->getModifDate() ? '' : 'd-none';
        }
      } else {
        $_POST['price']  = $okPrice ? $_SESSION['prestation']->getPrixIndPrestaEuro() : DFLT_PRICE;
        $_POST['duration']  = $okDuration ? $_SESSION['prestation']->getDureePrestaHM() : DFLT_DURATION;
        $buttonID = 'buttonSave';
        $buttonLabel = 'Sauvegarder';
        $afficher = '';
        $display = $_SESSION['prestation']->getModifDate() ? '' : 'd-none';
      }
    }
  } else if (isset($_POST['Supprimer']) && $_POST['Supprimer'] === 'Supprimer' && isset($_SESSION['prestation'])) { //here is the prestation delete
    try { //Calling modal and if all ok calling DB
      $response = $daoBeauty->deletePrestation($_SESSION['prestation']);
      if ($response) { // check response and reset the form for creating prestation
        $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, Suppression de la prestation ' . $_SESSION['prestation']->getNomPresta() . ' effectuée avec succès!', 'style' => 'text-primary', 'msgShow' => true];
        unset($_SESSION['prestation']);
        $prestation = $dummy;
        $buttonID = 'buttonCreate';
        $buttonLabel = 'Créer';
        $afficher = 'd-none';
        $disabled = false;
        $display = $prestation->getModifDate() ? '' : 'd-none';
      } else {
        $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, Suppression de la prestation ' . $prestation->getNomPresta() . ' a échoué!', 'style' => 'text-primary', 'msgShow' => true];
      } 
    } catch (\Exception $e) {
       $prestation = $_SESSION['prestation'];
       $buttonLabel = 'Sauvegarder';
       $display = $prestation->getModifDate() ? '' : 'd-none';
       $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la suppression de la prestation ' . $prestation->getNomPresta() . ' a échoué', 'style' => 'text-danger', 'msgShow' => true];
    } 
  } elseif (isset($_POST['Créer']) && $_POST['Créer'] === 'Créer') { //Handle prestation Creation
    $prestation = $dummy; //set a default object for display
    if (isset($_POST['name']) && isset($_POST['duration']) && isset($_POST['description']) && isset($_POST['price'])) {
      //The form is complete checking values to set
      if (!empty(htmlspecialchars(trim($_POST['name'])))) {
        $prestation->setNomPresta(htmlspecialchars(trim($_POST['name'])));
        $okName = true;
      } else {
        $okName = false;
        $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Info, le nom de la prestation doit être renseigné', 'style' => 'text-danger', 'msgShow' => true];
      }
      //check for format hh:mm
      $pattern = '/^(\d{1,2}):(\d{2})?$/';
      if (preg_match($pattern, htmlspecialchars($_POST['duration']))) {
        $prestation->setDureePrestaHM(htmlspecialchars($_POST['duration']));
        $okDuration = true;
      } else {
        $okDuration = false;
        $prestation->setDureePresta(DFLT_DURATION);
        $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Info, la durée de la prestation doit être au format hh:mm', 'style' => 'text-danger', 'msgShow' => true];
      }
      $prestation->setDescPresta(htmlspecialchars(trim($_POST['description'])));
      //check for format 999.99 or 999,99
      $pattern = '^\d{1,3}(?:[,.]\d{2})?$^';
      if (preg_match($pattern, htmlspecialchars($_POST['price']))) {
        $okPrice = true;
        if ($_POST['price'] )
        $prestation->setPrixIndPrestaEuro(htmlspecialchars(trim($_POST['price'])));
      } else {
        $okPrice = false;
        $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Info, la prix de la prestation doit être au format 999,99', 'style' => 'text-danger', 'msgShow' => true];
      }
      if ($okDuration && $okPrice && $okName) {
        try { //All ok calling DB
          $response = $daoBeauty->createPrestation($prestation);
          if ($response) {
            $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, création de la prestation ' . $prestation->getNomPresta() . ' effectuée avec succès!', 'style' => 'text-primary', 'msgShow' => true];
            unset($_SESSION['prestation']);
            $prestation = $dummy;
          }
        } catch (\Exception $e) {
          $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, création de la prestation ' . $prestation->getNomPresta() . ' a échoué car elle existe déjà!', 'style' => 'text-danger', 'msgShow' => true];
        }
        //The rest is for display  purposes
        $buttonID = 'buttonCreate';
        $buttonLabel = 'Créer';
        $afficher = 'd-none';
        $disabled = false;
        $display = $prestation->getModifDate() ? '' : 'd-none';
      } else {
        //capture the prestation name if filled in
        $prestation->setNomPresta(!empty($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '');
        $buttonID = 'buttonCreate';
        $buttonLabel = 'Créer';
        $afficher = 'd-none';
        $disabled = false;
        $display = $prestation->getModifDate() ? '' : 'd-none';
      }
    }
  }  else if (isset($_POST['keyPresta']) && isset($_SESSION['prestation']) && intval($_POST['keyPresta']) === $_SESSION['prestation']->getIdPresta()){
    try { //Calling modal and if all ok calling DB for deletion
      $response = $daoBeauty->deletePrestation($_SESSION['prestation']);
      if ($response) { // check response and reset the form for creating prestation
        $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, Suppression de la prestation ' . $_SESSION['prestation']->getNomPresta() . ' effectuée avec succès!', 'style' => 'text-primary', 'msgShow' => true];
        unset($_SESSION['prestation']);
        $prestation = $dummy;
        $buttonID = 'buttonCreate';
        $buttonLabel = 'Créer';
        $afficher = 'd-none';
        $disabled = false;
        $display = $prestation->getModifDate() ? '' : 'd-none';
      } else {
        $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, Suppression de la prestation ' . $prestation->getNomPresta() . ' a échoué!', 'style' => 'text-primary', 'msgShow' => true];
      } 
    } catch (\Exception $e) {
       $prestation = $_SESSION['prestation'];
       $buttonLabel = 'Sauvegarder';
       $display = $prestation->getModifDate() ? '' : 'd-none';
       $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, Impossible de supprimer la prestation ' .$prestation->getNomPresta() . ' car elle est rattachée à d\'autres évènements!', 'style' => 'text-danger', 'msgShow' => true];
    } 
  } else { //We are here because none of the above, no data was posted
    unset( $_SESSION['prestation']);
    $prestation = $dummy;
    $buttonID = 'buttonCreate';
    $buttonLabel = 'Créer';
    $afficher = 'd-none';
    $disabled = false;
    $display = $prestation->getModifDate() ? '' : 'd-none';
  }
} else { //we get here if $_POST wasn't invoked
  $prestation = $dummy;
  $buttonID = 'buttonCreate';
  $buttonLabel = 'Créer';
  $afficher = 'd-none';
  $disabled = false;
  $display = $prestation->getModifDate() ? '' : 'd-none';
}

include '../view/vadminPrestation.php';
?>