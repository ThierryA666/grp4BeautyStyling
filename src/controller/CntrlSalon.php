<?php 

namespace beautyStyling\controller;

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Salon;

class CntrlSalon {
    public function getIndex() {
        require './view/salon/vbeautyStyling.php';
    }
    public function getSalonResCal() {
        $salonSelected = null;
        $prestaSelected = null;
        $display = 'd-none';
        $apptDate = null;
        $apptTime = null;
        $salonRdv = null;
        $prestaRdv = null;
        $prestations = [];
        $daoBeauty = new DaoBeauty();
        $salons = $daoBeauty->getSalon();
        if (isset($_POST['salons']) && $_POST['salons'] !== 'salon0') {
            $idSalon = intval(substr(htmlspecialchars(trim($_POST['salons'])),5));
            $salon = new Salon($idSalon,'','','','','','','','','','','', new \DateTime(),'');
            $salonSelected = $salon;
            $prestations = $daoBeauty->getPrestaBySalon($salon);
            if (isset($_POST['prestations']) && $_POST['prestations'] !== 'presta0') {
                $idPresta = intval(substr(htmlspecialchars(trim($_POST['prestations'])),6));
                $prestaSelected = $daoBeauty->getPrestationByID($idPresta);
            }
        }
        if ((isset($_POST['confirm']) && $_POST['confirm'] === 'confirm') && (isset($_POST['salonRdv']) && isset($_POST['prestationRdv']) && isset($_POST['apptTime']) && isset($_POST['apptDate']))) {
            $apptDate = htmlspecialchars(trim($_POST['apptDate']));
            $apptTime = htmlspecialchars(trim($_POST['apptTime']));
            $salonRdv = $daoBeauty->getSalonByID(intval(htmlspecialchars(trim($_POST['salonRdv']))));
            $prestaRdv = $daoBeauty->getPrestationByID(intval(htmlspecialchars(trim($_POST['prestationRdv']))));
            $display = '';
        }
        require './view/salon/vsalonResCal.php';
    }
}
?>