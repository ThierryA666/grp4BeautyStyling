<?php
declare(strict_types=1);
namespace beautyStyling;
require_once('vendor/autoload.php');

use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\Database;
use PHPUnit\Framework\Attributes\BeforeClass;
use PHPUnit\Framework\Attributes as att;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
use beautyStyling\metier\Prestation;


class AdminPrestationTest extends TestCase {
    
    private ? Prestation $prestation;
    private ? Prestation $newPrestation;
    private ? bool       $response;

    // 1 fois 
    #[BeforeClass]
    public static function debutClasse() : void {
        $prestation = null;
        $newPrestation = null;
        echo "[BeforeClass] ";
    }

    #[att\Before]					
    public function debut() : void {
        $this->prestation = new Prestation(0,"testPrestation", 3600, 1500, new \Datetime(), null, null);
        echo "[Before] ";
    }

    #[att\After]								// apres chaque test 
    public function fin() : void {
        $daoBeauty = new DaoBeauty;
        $prestations = $daoBeauty->getPrestations();
        $this->newPrestation = $prestations[count($prestations) - 1];
        $daoBeauty->deletePrestation($this->newPrestation);
        echo "[After] ";		 
    }
    // testCreatePrestation
    #[att\Test]	
    #[TestDox('!!! TA !!!  test create prestation !!!')]
    public function testCreatePrestation() : void {

        echo " - Je suis testCreatePrestation - ";

        // WHEN on créé la prestation et on récupère l'objet dans $expected;
        $daoBeauty = new DaoBeauty;
        $this->response = $daoBeauty->createPrestation($this->prestation);
        $expected=$daoBeauty->getPrestationByName($this->prestation->getnomPresta());
        //$this->newPrestation = $daoBeauty->getPrestationByID($expected->getIdPresta());

        // THEN on compare le nom de la prestation;
        $this->assertEquals($expected->getNomPresta(),$this->prestation->getNomPresta());
    }
}

?>