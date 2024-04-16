<?php
namespace beautyStyling\webapp;
require_once '..\..\vendor\autoload.php';
use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\DaoException;
// var_dump($_GET);

$id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
    if ($id_salon === null) {
        $message = "Ce salon est inexistant.";
        } else {
            $dao = new DaoBeauty();
            $salon = $dao->getSalonByID($id_salon);
            // echo $salon;
            $prestations=[];
        try {
            $prestations = $dao->getPrestations();    
            foreach ($prestations as $prestation) {
                // echo($prestation);
                // echo ('<br>');
            }
        } catch (\Exception $e) {
            echo("Exception!! " . $e->getMessage() . ' ' . $e->getCode());
        } catch (\Error $e) {
            echo("Error!! " . $e->getMessage() . ' ' .  $e->getCode());
        }              
}


 










include '../view/vsalon_gestionnaire.php';