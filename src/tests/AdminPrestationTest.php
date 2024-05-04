<?php
declare(strict_types=1);
namespace beautyStyling;
require_once('../vendor/autoload.php');

use beautyStyling\dao\DaoBeauty;
use PHPUnit\Framework\Attributes\BeforeClass;
use PHPUnit\Framework\Attributes as att;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
use beautyStyling\metier\Prestation;


class AdminPrestationTest extends TestCase {
    
    private ? Prestation $prestation;

    // 1 fois 
    #[BeforeClass]
    public static function debutClasse() : void {
        echo "[BeforeClass] ";
        try {
            $daoBeauty = new DaoBeauty();
        } catch (\Exception $e) {
            require './view/verror.php';
            exit;
        }	   
    }

}

?>