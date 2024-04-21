<?php
namespace beautyStyling\webapp;

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Prestation;
use beautyStyling\dao\DaoException;

require_once '../../vendor/autoload.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // var_dump($_SERVER);
    $dao = new DaoBeauty();
    $prestations = $dao->getPrestations();
        try{
            if(isset($_POST['search'])){
                // var_dump($_POST);
                // var_dump(isset($_POST['nameInput']));
                $keyWord = isset($_POST['nameInput']) && $_POST['nameInput'] !== '' ? $_POST['nameInput'] : '';
                // var_dump($keyWord);
                $id_prest = isset($_POST['prestation']) ? $_POST['prestation'] : '';
                                       
                $results = [];
                //recherche par nom 
                if (!empty($keyWord)&& empty($id_prest)) {
                    $results_by_name = $dao->getSalonByName($keyWord);
                    // affiche($results_by_name);
                    $results=[];
                    foreach ($results_by_name as $name_result) {
                        $results[]=$name_result;
                    }
                    $salons=$results;
                    // var_dump($salons);
                } elseif (empty($keyWord) && !empty($id_prest)){
                    $prestation = $dao->getPrestationByID($id_prest) ;
                    // echo $prestation;
                    $results_by_prest = $dao->getSalonByPresta($prestation);
                    // affiche($results_by_prest);
                    $results=[];
                    foreach ($results_by_prest as $prest_result) {
                        $results[]=$prest_result;
                    }
                    $salons=$results;
                } elseif (!empty($keyWord) && !empty($id_prest)) {
                 
                    $results_by_name = $dao->getSalonByName($keyWord);
                    $prestation = $dao->getPrestationByID($id_prest) ;
                    $results_by_prest = $dao->getSalonByPresta($prestation);
                   $results=[];
                    foreach ($results_by_name as $name_result){
                        foreach ($results_by_prest as $prest_result) {
                            if ($name_result->getId_salon() === $prest_result->getId_salon()) {
                                $results[] = $name_result;
                                break;
                            }
                        }
                    }
                    $salons=$results;
                } else {
                   $results = $dao->getSalon(); 
                   $salons = $results;
                }
            }
                 
    } catch (DaoException $e) {
        $message = $e->getCode() . ' - ' . $e->getMessage();
    } catch (\Exception $e) {
        $message = $e->getCode() . ' - ' . $e->getMessage();
    } catch (\Error $e) {
        $message = $e->getMessage();
    }       
} else {
    // Lors du premier chargement de la page 
    $dao = new DaoBeauty();
    $prestations=[];
    //$salons = $dao->getSalon();
    $prestations = $dao->getPrestations();
    }




include '../view/vindex.php';