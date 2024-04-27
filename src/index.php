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
        APP_ROOT.'/prestations'             =>  $cntrlAdmin->getPrestationsList(),
        APP_ROOT.'/paniers'                 =>  $cntrlClient->getPaniers(),
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
        default                             =>  $cntrlSalon->getIndex(),
    };
} else {
    $cntrlSalon->getIndex();
}