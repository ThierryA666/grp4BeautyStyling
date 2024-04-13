<?php
declare(strict_types=1);

namespace beautyStyling\tests;

require_once '..\\..\\vendor\\autoload.php';

use beautyStyling\dao\DaoBeauty;

$dao = new DaoBeauty();

try {
     $prestations = $dao->getPrestations();    
     foreach ($prestations as $prestation) {
        echo($prestation);
        echo ('<br>');
    }
} catch (\Exception $e) {
    echo("TA Test!! " . $e->getMessage() . ' ' . $e->getCode());
} catch (\Error $e) {
    echo("TA Test!! " . $e->getMessage() . ' ' .  $e->getCode());
}

try {
    $spes = $dao->getSPE();
    foreach ($spes as $spe) {
        print_r($spe);
        echo ('<br>');
    }
} catch (\Exception $e) {
    echo("TA Test!! " . $e->getMessage() . ' ' . $e->getCode());
} catch (\Error $e) {
    echo("TA Test!! " . $e->getMessage() . ' ' .  $e->getCode());
}

?>