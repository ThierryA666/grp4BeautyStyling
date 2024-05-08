<?php 

namespace beautyStyling\controller;

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Salon;
use DateTime;

class CntrlSalon {
    private function parseFrenchDate(String $dateString) {
        // French day and month names
        $dayNames = [
            'Lundi' => 'Monday',
            'Mardi' => 'Tuesday',
            'Mercredi' => 'Wednesday',
            'Jeudi' => 'Thursday',
            'Vendredi' => 'Friday',
            'Samedi' => 'Saturday',
            'Dimanche' => 'Sunday'
        ];
        $monthNames = [
            'Janvier' => 'January',
            'Février' => 'February',
            'Mars' => 'March',
            'Avril' => 'April',
            'Mai' => 'May',
            'Juin' => 'June',
            'Juillet' => 'July',
            'Août' => 'August',
            'Septembre' => 'September',
            'Octobre' => 'October',
            'Novembre' => 'November',
            'Décembre' => 'December'
        ];
        // Split the French date string into day, month, and year components
        $dateParts = explode(' ', $dateString);
        $day = $dateParts[1]; // Day (15)
        $month = $dateParts[2]; // Month (Mars)
        $year = $dateParts[3]; // Year (2024)
        // Convert French day and month names to English
        $englishDay = substr($dateParts[0], 1, strlen($dateParts[0]) - 1);
        $englishMonth = $monthNames[$month];
        // Create a DateTime object using the parsed components
        $date = \DateTime::createFromFormat('j F Y', $day . ' ' . $englishMonth . ' ' . $year);
        return $date;
    }
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
        $rndvs = [];
        $daoBeauty = new DaoBeauty();
        $salons = $daoBeauty->getSalon();
        if (isset($_POST['salons']) && $_POST['salons'] !== 'salon0') {
            $idSalon = intval(substr(htmlspecialchars(trim($_POST['salons'])),5));
            $salon = $daoBeauty->getSalonByID($idSalon);
            $salonSelected = $salon;
            $prestations = $daoBeauty->getPrestaBySalon($salon);
            if (isset($_POST['prestations']) && $_POST['prestations'] !== 'presta0') {
                $idPresta = intval(substr(htmlspecialchars(trim($_POST['prestations'])),6));
                $prestaSelected = $daoBeauty->getPrestationByID($idPresta);
            }
        }
        if ((isset($_POST['listRdv']) && $_POST['listRdv'] === 'listRdv') && (isset($_POST['salonRdv']) && !empty($_POST['salonRdv']) && isset($_POST['apptTime']) && isset($_POST['apptDate']))) {
            $apptDate = htmlspecialchars(trim($_POST['apptDate']));
            $apptTime = htmlspecialchars(trim($_POST['apptTime']));
            $salonRdv = $daoBeauty->getSalonByID(intval(htmlspecialchars(trim($_POST['salonRdv']))));
            //$prestaRdv = $daoBeauty->getPrestationByID(intval(htmlspecialchars(trim($_POST['prestationRdv']))));
            $display = '';
            $rndvs = $daoBeauty->getReservationByDateAndSalon($this->parseFrenchDate($apptDate) , $salonRdv);
        }
        require './view/salon/vsalonResCal.php';
    }
}
?>