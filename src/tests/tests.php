<?php
declare(strict_types=1);
namespace beautyStyling\tests;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Salon;
use beautyStyling\metier\Villes;
use beautyStyling\metier\Prestation;
use beautyStyling\metier\Offrir;
use DateTime;


//Insert test
// $salon = new Salon (0,'REISS','Takako','51 rte de Tence','','Salon Chambon', 'takako@abc.com','43400', '0123456789','www.abc.fr','photo.jpg','password', new DateTime, 'LE CHAMBON SUR LIGNON');
// $salon = $dao ->addSalon($salon);

// //Affiche test
$dao = new DaoBeauty();
$salons = $dao->getSalon();
affiche($salons);
echo '<hr>';

// //Serch test

// $keyWord = '0125547928';
// $dao = new DaoBeauty();
// $salons = $dao->searchSalon($keyWord);
// affiche($salons);










//get salon by id test


$id_salon = 2;
$dao = new DaoBeauty();
$salon = $dao->getSalonByID($id_salon);
echo $salon;


//update test

// $dao = new DaoBeauty();
// $id_salon = 3;

// $salon = $dao->getSalonByID($id_salon);
// var_dump($salon);
// // set value to be updated
// $prenom_res = 'Guy';
// $salon->setPrenom_res($prenom_res);

// $dao->updateSalonByID($salon);

// $updatedSalon = $dao->getSalonByID($id_salon);

// var_dump($updatedSalon);


//delete test
// $dao = new DaoBeauty();
// $id_salon = 3;
// $salon = $dao->getSalonByID($id_salon);
// // var_dump($salon);
// $dao->delSalonByID($salon);






// try {
//      $prestations = $dao->getPrestations();    
//      foreach ($prestations as $prestation) {
//         echo($prestation);
//         echo ('<br>');
//     }
// } catch (\Exception $e) {
//     echo("TA Test!! " . $e->getMessage() . ' ' . $e->getCode());
// } catch (\Error $e) {
//     echo("TA Test!! " . $e->getMessage() . ' ' .  $e->getCode());
// }

// $email_salon = 'agt@gmail.co';
// $dao = new DaoBeauty();
// $salon = $dao->getSalonByEmail($email_salon);
// echo $salon;


// $salon=$dao->getSalonByID(3);
// $offrirs = $dao->getPrestaBySalon($salon);
// affiche($offrirs);

// $prestation = $dao->getPrestationByID(1);
// $salons = $dao->getSalonByPresta($prestation);
// affiche($salons);


// //Serch test

// $keyWord = 'salon';
// $dao = new DaoBeauty();
// $salons = $dao->getSalonByName($keyWord);
// affiche($salons);

//getSalonByPresta

// $prestation=$dao->getPrestationByID(3);
// echo $prestation;
// $salons=$dao->getSalonByPresta($prestation);
// affiche($salons);



function affiche($salons) : void {
    foreach ($salons as $salon) {
        echo $salon;
        echo '<br>';
    }
} 

