<?php
declare(strict_types=1);
namespace beautyStyling\tests;

require 'C:\workspace\ECF\Takako_ECF_Git\vendor\autoload.php';

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Salon;
use beautyStyling\metier\Villes;
use beautyStyling\metier\Prestation;
use beautyStyling\metier\Offrir;
use DateTime;

$dao = new DaoBeauty();



$salon = new Salon (0,'REISS','Takako','51 rte de Tence','','Salon Chambon', 'takako@abc.com','43400', '0123456789','www.abc.fr','photo.jpg','password', new DateTime, 'LE CHAMBON SUR LIGNON');
$salon = $dao ->addSalon($salon);

// $salons = $dao->getSalon();
// affiche($salons);
// echo '<hr>';

function affiche($salons) : void {
    foreach ($salons as $salon) {
        echo $salon;
        echo '<br>';
    }
}