<?php
declare(strict_types=1);
namespace beautyStyling\tests;

use PHPUnit\Framework\TestCase;
use beautyStyling\dao\DaoBeauty;
use beautyStyling\controller\CntrlSalon;
use beautyStyling\metier\Salon;
use beautyStyling\webapp\MyException;
use DateTime;

class SalonTest extends TestCase{
    //DaoBeauty Method Tests: searchSalon()
    public function testSearchSalonWithNullKeyword(): void {
    $dao = new DaoBeauty();
    $result = $dao->searchSalon(null);
    $this->assertEquals([], $result);
    }

    public function testSearchSalonWithPhoneNumberKeyword(): void {
    $dao = new DaoBeauty();
    $result = $dao->searchSalon('0365847751'); // Example phone number
    $this->assertEquals([], $result);
    }

    public function testSearchSalonWithValidKeyword(): void {
    $dao = new DaoBeauty();
    $result = $dao->searchSalon('studio');
    $this->assertNotEmpty($result);
    }

    public function testSearchSalonWithInvalidKeyword(): void {
    $dao = new DaoBeauty();
    $result = $dao->searchSalon('invalidkeyword');
    $this->assertEquals([], $result);
    }
    
    public function testGetSalonByEmailWithExistingEmail(): void {
        $dao = new DaoBeauty();
        $salon = $dao->getSalonByEmail('agt@gmail.com');
        $this->assertInstanceOf(Salon::class, $salon);
       
    }

    public function testGetSalonByEmailWithNonExistingEmail(): void {
        $dao = new DaoBeauty();
        $salon = $dao->getSalonByEmail('nonexistent@example.com');
        $this->assertNull($salon);
    }

    //delete salon
    public function testDelSalonByIdWithFK():void{
        $dao = new DaoBeauty();
        $id_salon = 2;
        $salon = $dao->getSalonById($id_salon);
        $this->expectException(MyException::class);
        $dao->delSalonByID($salon);
    }

    public function testDelSalonByIdWithoutFK():void{
        $dao = new DaoBeauty();
        $id_salon = 46;
        $salon = $dao->getSalonById($id_salon);
        $this->expectNotToPerformAssertions();
        $dao->delSalonByID($salon);
    }

}