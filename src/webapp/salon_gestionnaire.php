<?php
namespace beautyStyling\webapp;
require_once '../../vendor/autoload.php';
use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\DaoException;
use beautyStyling\metier\Offrir;
// var_dump($_GET);
$message="";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try{
        if(isset($_POST['savePresta'])){
            // var_dump($_POST);
            $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;

            if($id_salon === null) {
                // s'il n'y a pas d'id
                $message = "ID du salon invalide.";
            } else{
                // si c'est ok, requpere le data de salon et renouveler
                $dao = new DaoBeauty();
                $salon = $dao->getSalonByID($id_salon);
        
                // recupere des donnes et instantier Offrir
                if (isset($_POST['chk']) && isset($_POST['prixPresta'])) {
                    $dao->delOffrirBySalon($salon);
                    $checkedPresta = $_POST['chk'];
                    $prixPrestaValues = $_POST['prixPresta'];
                    
                    foreach ($checkedPresta as $id_presta) {
                            $prestation =$dao->getPrestationByID($id_presta);
                            if (isset($prixPrestaValues[$id_presta])) {
                                $id_presta = intval($id_presta);
                                $prix_presta_salon = $prixPrestaValues[$id_presta];
                                $offrir = new Offrir($prestation, $salon, $prix_presta_salon);

                                // echo $offrir;
                                //add ou update ou delete
                               
                                $count = $dao->countOffrir($offrir);
                                 //s'il y a objet offrir:update
                                 if($count >0){
                                    $dao->updateOffrirByID($offrir);
                                 //s'il n'y a pas objet offrir :insert  
                                 } else{
                                    $dao->addOffrir($offrir);
                                }
                            }
                    }
                    $salon = $dao->getSalonByID($id_salon);
                    // echo $salon;
                    $prestations=[];
                    $prestations = $dao->getPrestations();
                    foreach ($prestations as $prestation) {
                        // echo $prestation;
                        // echo '<br>';
                    }
                    $offrirs =[];
                    $offrirs = $dao->getPrestaBySalon($salon);
                    foreach ($offrirs as $offrir) {
                        // echo $offrir;
                        // echo '<br>';
                    }    
                    $message = "Les préstations ont été enregistrées avec succès.";
                }else{
                    $message="Aucune prestation sélectionnée.";
                }
            }
        }
    } catch (DaoException $e) {
        $message = $e->getCode() . ' - ' . $e->getMessage();
    } catch (\Exception $e) {
        $message = $e->getCode() . ' - ' . $e->getMessage();
    } catch (\Error $e) {
        $message = $e->getMessage();
    }      
} // Lors du premier chargement de la page 
else{
    $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
    if ($id_salon === null) {
        $message = "Ce salon est inexistant.";
        } else {
            try {
            $dao = new DaoBeauty();
            $salon = $dao->getSalonByID($id_salon);
            // echo $salon;
            $prestations=[];
            $prestations = $dao->getPrestations();
            foreach ($prestations as $prestation) {
                // echo $prestation;
                // echo '<br>';
            }
            $offrirs =[];
            $offrirs = $dao->getPrestaBySalon($salon);
            foreach ($offrirs as $offrir) {
                // echo $offrir;
                // echo '<br>';
            }    
            } catch (\Exception $e) {
                echo("Exception!! " . $e->getMessage() . ' ' . $e->getCode());
            } catch (\Error $e) {
                echo("Error!! " . $e->getMessage() . ' ' .  $e->getCode());
            }
        }              


}










 










include '../view/vsalon_gestionnaire.php';