<?php 

namespace beautyStyling\controller;

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Prestation;

const MAX_LENGTH = 6;
const MIN = 1;
const MAX = 12;
const MAX_PRICE = 99999;
const DFLT_DURATION = 1800;
const DFLT_PRICE = 10;
const DFLT_DURATION_HM = '01:00';
const DFLT_PRICE_EURO = '10,00';


class CntrlAdmin {
    private function getPrestation(DaoBeauty $daoBeauty,int $id, Prestation $dummy) {
      error_reporting(E_ALL);
      unset($_SESSION['msgUtilisateur']);
      $disabled = 'true';
      $afficher2 = '';
      $msgUtilisateur =  isset($_SESSION['msgUtilisateur']) ? ($_SESSION['msgUtilisateur']['msgShow'] ? $_SESSION['msgUtilisateur'] : null ) : ['success' => true, 'message' => 'Bienvenue à BeautyStyling!', 'style' => 'text-primary',  'msgShow' => false];
      $buttonLabel = 'Sauvegarder';
      $afficher = '';
      $buttonID = 'buttonSave';
      $min = MIN;
      $max = MAX;
      $maxPrice = MAX_PRICE;
      $maxLength = MAX_LENGTH;
      try { //all ok calling DB
        $prestation= $daoBeauty->getPrestationByID($id);
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
      require './view/admin/vadminPrestation.php';
    }
    private function savePrestation(DaoBeauty $daoBeauty, String $duration, String $descritpion, String $price, Prestation $dummy) {
      $disabled = 'true';
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
      require './view/admin/vadminPrestation.php';
    }
    public function deletePrestation() {
      $min = MIN;
      $max = MAX;
      $maxPrice = MAX_PRICE;
      $maxLength = MAX_LENGTH;
      $disabled = false;
      $buttonLabel = 'Créer';
      $afficher = 'd-none';
      $afficher2 = '';
      $afficher3 = 'd-none';
      $buttonID = 'buttonCreate';
      $dummy = new Prestation(0, '',  DFLT_DURATION, DFLT_PRICE, new \DateTime()); //$dummy object very useful to avoid display errors
      $prestation = $dummy; //set a default object for display
      $display = $prestation->getModifDate() ? '' : 'd-none';
      unset($_SESSION['msgUtilisateur']);
      try { //check for DB connection
        $daoBeauty = new DaoBeauty();
      } catch (\Exception $e) {
        require('./view/verror.php');
      }
      if (isset($_POST['keyPresta']) && isset($_SESSION['prestation'])  && intval($_POST['keyPresta']) === $_SESSION['prestation']->getIdPresta()){
        try { //Calling modal and if all ok calling DB
          $response = $daoBeauty->deletePrestation($_SESSION['prestation']);
          if ($response) { // check response and reset the form for creating prestation
            $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, Suppression de la prestation ' . $_SESSION['prestation']->getNomPresta() . ' effectuée avec succès!', 'style' => 'text-primary', 'msgShow' => true];
            unset($_SESSION['prestation']);
          } else {
            $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, la prestation sélectionnée n\'existe pas!', 'style' => 'text-danger', 'msgShow' => true];$msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, Suppression de la prestation ' . $_SESSION['prestation']->getNomPresta() . ' a échoué!', 'style' => 'text-primary', 'msgShow' => true];
          } 
        } catch (\Exception $e) {
          $prestation = $_SESSION['prestation'];
          $disabled = true;
          $afficher = '';
          $afficher2 = '';
          $afficher3 = 'd-none';
          $buttonLabel = 'Sauvegarder';
          $display = $prestation->getModifDate() ? '' : 'd-none';
          $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, Impossible de supprimer la prestation ' .$prestation->getNomPresta() . ' car elle est rattachée à d\'autres évènements!', 'style' => 'text-danger', 'msgShow' => true];
        }
      }
      require './view/admin/vadminPrestation.php';
    }
    public function createPrestation() {
      error_reporting(E_ALL);
      try { //check for DB connection
        $daoBeauty = new DaoBeauty();
      } catch (\Exception $e) {
        require('./view/verror.php');
      }
      $min = MIN;
      $max = MAX;
      $maxPrice = MAX_PRICE;
      $maxLength = MAX_LENGTH;
      $okPrice = true;
      $okDuration = true;
      $okName = true;
      $dummy = new Prestation(0, '',  DFLT_DURATION, DFLT_PRICE, new \DateTime()); //$dummy object very useful to avoid display errors
      $prestation = $dummy; //set a default object for display
      unset($_SESSION['msgUtilisateur']);
      $disabled = false;
      $afficher = '';
      $afficher2 = '';
      $afficher3 = 'd-none';
      $buttonLabel = 'Créer';
      $buttonID = 'buttonCreate';
      $display = $prestation->getModifDate() ? '' : 'd-none';
      $msgUtilisateur =  isset($_SESSION['msgUtilisateur']) ? ($_SESSION['msgUtilisateur']['msgShow'] ? $_SESSION['msgUtilisateur'] : null ) : ['success' => true, 'message' => 'Bienvenue à BeautyStyling!', 'style' => 'text-primary',  'msgShow' => false];
      if (isset($_POST['Créer']) && $_POST['Créer'] === 'Créer') { //Handle prestation Creation
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
            $prestation->setNomPresta(htmlspecialchars(trim($_POST['name'])));
            $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Info, la durée de la prestation doit être au format hh:mm', 'style' => 'text-danger', 'msgShow' => true];
          }
          $prestation->setDescPresta(htmlspecialchars(trim($_POST['description'])));
          //check for format 999.99 or 999,99
          $pattern = '^\d{1,3}(?:[,.]\d{2})?$^';
          if (preg_match($pattern, htmlspecialchars($_POST['price']))) {
            $okPrice = true;
            if ($_POST['price'] ) $prestation->setPrixIndPrestaEuro(htmlspecialchars(trim($_POST['price'])));
          } else {
            $okPrice = false;
            $prestation->setPrixIndPrestaEuro(DFLT_PRICE);
            $prestation->setNomPresta(htmlspecialchars(trim($_POST['name'])));
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
            $afficher = '';
            $disabled = false;
            $display = $prestation->getModifDate() ? '' : 'd-none';
          } else {
            //capture the prestation name if filled in
            //$prestation->setNomPresta(!empty($name) ? htmlspecialchars(trim($_POST['name'])) : '');
            $buttonID = 'buttonCreate';
            $buttonLabel = 'Créer';
            $afficher = '';
            $disabled = false;
            $display = $prestation->getModifDate() ? '' : 'd-none';
          }
        }
      } else {
        $afficher = '';
        $afficher2 = '';
        $afficher3 = 'd-none';
      }
      require './view/admin/vadminPrestation.php';
    }
    public function getPrestationsList() {
        error_reporting(E_ALL);
        try { //check DB connection
        $daoBeauty = new DaoBeauty();
        } catch (\Exception $e) {
          require './view/verror.php';
          exit;
        }

        //Not very useful, it's just to set the message on first entry
        $msgUtilisateur = [];
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
                    $msgUtilisateur = ['success' => true, 'message' => 'Bienvenue à BeautyStyling!', 'style' => 'text-primary',  'msgShow' => true];
                    $_SESSION['msgUtilisateur'] = $msgUtilisateur;
                }
            } catch (\Exception $e) {
            $msgUtilisateur = ['success' => false, 'message' => 'BeautyStyling Error, Impossible de supprimer la prestation ' .$prestation->getNomPresta() . ' car elle est rattachée à d\'autres évènements!', 'style' => 'text-danger', 'msgShow' => true];    
            $_SESSION['msgUtilisateur'] = $msgUtilisateur;
            }
        }
        require './view/admin/vadminListePrestations.php';
    }
    public function editPrestation () {
      error_reporting(E_ALL);        
      try { //check for DB connection
        $daoBeauty = new DaoBeauty();
      } catch (\Exception $e) {
        require('./view/verror.php');
        exit;
      }
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
      $afficher = '';
      $afficher2 = '';
      $afficher3 = '';
      $msgUtilisateur =  isset($_SESSION['msgUtilisateur']) ? ($_SESSION['msgUtilisateur']['msgShow'] ? $_SESSION['msgUtilisateur'] : null ) : ['success' => true, 'message' => 'Bienvenue à BeautyStyling!', 'style' => 'text-primary',  'msgShow' => false];
      
      if (isset($_POST['key']) && substr(htmlspecialchars(trim($_POST['key'])),0,11) === 'modifPresta') {  //called from adminListePrestations.php with the ID of the prestation
        $buttonLabel = 'Sauvegarder';
        $afficher = '';
        $buttonID = 'buttonSave';
        $id = intval(substr(htmlspecialchars(trim($_POST['key'])),11));
        $this->getPrestation($daoBeauty, $id, $dummy);
      } elseif (isset($_POST['Sauvegarder']) && $_POST['Sauvegarder'] === 'Sauvegarder' && isset($_SESSION['prestation'])) { //We have a prestation to modify if needed
        if (isset($_POST['duration']) && isset($_POST['description']) && isset($_POST['price']) && isset($_SESSION['prestation'])) {
          $this->savePrestation($daoBeauty, $_POST['duration'], $_POST['description'], $_POST['price'], $dummy);
        } elseif (isset($_POST['keyPresta']) && isset($_SESSION['prestation'])  && intval($_POST['keyPresta']) === $_SESSION['prestation']->getIdPresta()){
          $this->deletePrestation();
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
    require './view/admin/vadminPrestation.php';
  }
}

?>