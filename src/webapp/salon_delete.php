<<<<<<< HEAD
<?php
declare(strict_types=1);
namespace beautyStyling\webapp;
require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\DaoException;

$message = ' ';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['btnDel'])){
        // var_dump($_POST);
        try{
            $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;
      
                // si c'est ok, recupere le data de salon et les afficher
                $dao = new DaoBeauty();
                $salon = $dao->getSalonByID($id_salon);              
          

            if($salon) {
                $dao->delSalonByID($salon);
                $message = "Ce salon a été supprimé";
            }
        
        } catch (DaoException $e) {
            $message = $e->getCode() . ' - ' . $e->getMessage();
        } catch (\Exception $e) {
            $message = $e->getCode() . ' - ' . $e->getMessage();
        } catch (\Error $e) {
        $message = $e->getMessage();
        }       
    } 
} else {
        $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
    
        if ($id_salon === null) {
            $message = "Ce salon est inexistant.";
            } else {
                $dao = new DaoBeauty();
                $salon = $dao->getSalonByID($id_salon);
            }
    }

    

    

include '../view/vsalon_delete.php';
=======
<?php
declare(strict_types=1);
namespace beautyStyling\webapp;
require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\DaoException;

$message = ' ';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['btnDel'])){
        // var_dump($_POST);
        try{
            $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;
      
                // si c'est ok, recupere le data de salon et les afficher
                $dao = new DaoBeauty();
                $salon = $dao->getSalonByID($id_salon);              
          

            if($salon) {
                $dao->delSalonByID($salon);
                $message = "Ce salon a été supprimé";
            }
        
        } catch (DaoException $e) {
            $message = $e->getCode() . ' - ' . $e->getMessage();
        } catch (\Exception $e) {
            $message = $e->getCode() . ' - ' . $e->getMessage();
        } catch (\Error $e) {
        $message = $e->getMessage();
        }       
    } 
} else {
        $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
    
        if ($id_salon === null) {
            $message = "Ce salon est inexistant.";
            } else {
                $dao = new DaoBeauty();
                $salon = $dao->getSalonByID($id_salon);
            }
    }

    

    

include '../view/vsalon_delete.php';
>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
