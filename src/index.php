<?php
namespace beautyStyling;
require_once '../vendor/autoload.php';
use beautyStyling\controller\CntrlAdmin;
use beautyStyling\controller\CntrlClient;
use beautyStyling\controller\CntrlSalon;
use beautyStyling\dao\DaoException;

$chemin = './param.ini';

if (file_exists($chemin)) {
    $param = parse_ini_file($chemin, true);
    extract($param['APPWEB']);
} 
else throw new DaoException('Unable to retrieve App parameters!');

define('APP_ROOT', $app_root_phpserver);
define('PUBLIC_ROOT', $public_root_phpserver);

$uri = $_SERVER['REQUEST_URI'];
$route = explode('?', $uri)[0];
// var_dump($_POST);
// var_dump($_GET);
// var_dump($route);
// var_dump($_SESSION);
    
$method = strtolower($_SERVER['REQUEST_METHOD']);

$cntrlAdmin = new CntrlAdmin();
$cntrlClient= new CntrlClient();
$cntrlSalon= new CntrlSalon();

if ($method === 'get') {
    match($route) {
        APP_ROOT                            =>  $cntrlSalon->getIndex(),
        APP_ROOT.'/'                        =>  $cntrlSalon->getIndex(),
        APP_ROOT.'/popupsalon'              =>  $cntrlClient->getPopUpSalon(),
        APP_ROOT.'/prestations'             =>  $cntrlAdmin->getPrestationsList(),
        APP_ROOT.'/paniers'                 =>  $cntrlClient->getPaniers(),
        APP_ROOT.'/salon/top'               =>  $cntrlSalon->getSalonTop(),
        APP_ROOT.'/salon/application'       =>  $cntrlSalon->getSalonApp(),
        APP_ROOT.'/salon/login'             =>  $cntrlSalon->getSalonLogin(),
        APP_ROOT.'/salon/gestionnaire'      =>  $cntrlSalon->getSalonGestion(),
        APP_ROOT.'/salon/profile'           =>  $cntrlSalon->getSalonProfile(),
        APP_ROOT.'/salons'                  =>  $cntrlAdmin->getAdminSalons(),
        APP_ROOT.'/salons/delete'           =>  $cntrlAdmin->delSalons(),
        APP_ROOT.'/salon/logincntrl'        =>  $cntrlSalon->getSalonLoginCntrl(),
        APP_ROOT.'/salon/logout'            =>  $cntrlSalon->removeSession(),
        default                             =>  $cntrlSalon->getIndex(),
    };
} elseif ($method === 'post') {
    match($route) {
        APP_ROOT.'/prestations'             =>  $cntrlAdmin->getPrestationsList(),
        APP_ROOT.'/prestations/suppression' =>  $cntrlAdmin->getPrestationsList(),
        APP_ROOT.'/prestation/ajout'        =>  $cntrlAdmin->getPrestation(),
        APP_ROOT.'/prestation/edition'      =>  $cntrlAdmin->getPrestation(),
        APP_ROOT.'/prestation/suppression'  =>  $cntrlAdmin->getPrestation(),
        APP_ROOT.'/paniers'                 =>  $cntrlClient->getPaniers(),
        APP_ROOT.'/panierDetail'            =>  $cntrlClient->getPanierDetail(),
        APP_ROOT.'/panierDetail/suppression'=>  $cntrlClient->deletePanier(),
        APP_ROOT.'/panier/suppression'      =>  $cntrlClient->deletePanier(),
        APP_ROOT.'/salon/application'       =>  $cntrlSalon->getSalonApp(),
        APP_ROOT.'/salon/gestionnaire'      =>  $cntrlSalon->getSalonGestion(),
        APP_ROOT.'/salon/profile'           =>  $cntrlSalon->getSalonProfile(),
        APP_ROOT.'/salons'                  =>  $cntrlAdmin->getAdminSalons(),
        APP_ROOT.'/salons/delete'           =>  $cntrlAdmin->delSalons(),
        APP_ROOT.'/salon/logincntrl'        =>  $cntrlSalon->getSalonLoginCntrl(),
        APP_ROOT.'/'                        =>  $cntrlSalon->getIndex(),
        default                             =>  $cntrlSalon->getIndex(),
    };
} else {
    $cntrlSalon->getIndex();
}