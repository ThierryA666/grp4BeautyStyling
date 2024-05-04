<?php 

namespace beautyStyling\controller;

use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Client;
use beautyStyling\metier\LigneDetails;
use beautyStyling\metier\Employe;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;
use beautyStyling\metier\Salon;


class CntrlClient {
    private function searchReservationBydate(array $rndvs, String $dateBefore, String $dateAfter): array {
        $rndvDates = array();
        foreach ($rndvs as $reservation) {
        $dateRDV = $reservation->getD_rndv()->format('Y-m-d');
        if ($dateAfter && $dateBefore) {
            if ($dateRDV >= $dateAfter && $dateRDV <= $dateBefore) array_push($rndvDates, $reservation);
        } elseif ($dateAfter) {
            if ($dateRDV >= $dateAfter) array_push($rndvDates, $reservation);
        } elseif ($dateBefore) {
            if ($dateRDV <= $dateBefore) array_push($rndvDates, $reservation);
        }
        }
        return $rndvDates;
    }
    private function getReservationsByClient(array $reservations, Client $client) : array {
        $rndvs = array();
        foreach($reservations as $item) {
        if ($item->getId_client()->getIdClient() === $client->getIdClient()) {
            array_push($rndvs, $item);
        }
        }
        return $rndvs;
    }
    private function getUniqueSalonsListe(array $reservations, Client $client) : array {
        $clientSalons = array();
        foreach($reservations as $item) {
        if ($item->getId_client()->getIdClient() === $client->getIdClient()) {
            array_push($clientSalons, $item->getId_salon());
        }
        }
        return array_unique($clientSalons,SORT_STRING); //create liste of unique salon from the search dropdown
    }
    public function getPopUpSalon() {
        session_start();
        try { //check for DB connection
            $daoBeauty = new DaoBeauty();
        } catch (\Exception $e) {
            require './view/verror.php';
            exit;
        }
        if (isset($_GET['salonID'])) {
            try {
                $salon = $daoBeauty->getSalonByID(intval(htmlspecialchars(trim($_GET['salonID']))));
            } catch (\Exception $e) {
                require './view/verror.php';
                exit;
            }
        } else { require './view/error.php';}
        require './view/client/vpopUpSalon.php';
    }
    public function getPaniers() {
        error_reporting(E_ALL);
        session_start();
        try { //check for DB connection
        $daoBeauty = new DaoBeauty();
        } catch (\Exception $e) {
            require './view/verror.php';
            exit;
        }
        $client = new Client(1, 'Thierry');
        $clientSalons = array();
        $rndvs = array();
        $selected = false;
        try{ //Retrieve  les réservations du client
            $reservations = $daoBeauty->getRendezVous();
            $rndvs = $this->getReservationsByClient($reservations, $client);
            $clientSalons = $this->getUniqueSalonsListe($reservations, $client);
        } catch (\Exception $e) {
            require './view/verror.php';
            exit;
        }
        if (isset($_POST['salons']) && isset($_POST['search']) && $_POST['salons'] !== 'showAll'  && $_POST['dateAfter'] === '' && $_POST['dateBefore'] === '') {   
            try {
            $key = intval(htmlspecialchars(trim(substr($_POST['salons'],5))));
            $salonSelected = $clientSalons[$key];
            $selected = true;
            $rndvs = [];
            $reservations = $daoBeauty->getReservationsBySalon($salonSelected);
            $rndvs = $this->getReservationsByClient($reservations, $client);
            } catch (\Exception $e) {
                require './view/verror.php';
                exit;
            }
        } elseif (isset($_POST['search']) && $_POST['salons'] === 'showAll' && ($_POST['dateAfter'] !== '' || $_POST['dateBefore'] !== '')) {
            $rndvs = [];
            $rndvs = $this->getReservationsByClient($reservations, $client);
            $dateBefore = htmlspecialchars(trim($_POST['dateBefore']));
            $dateAfter = htmlspecialchars(trim($_POST['dateAfter']));
            $rndvs = $this->searchReservationBydate($rndvs, $dateBefore, $dateAfter);
        } elseif (isset($_POST['search']) && $_POST['salons'] !== 'showAll' && ($_POST['dateAfter'] !== '' || $_POST['dateBefore'] !== '')) {   
            try {
            $key = intval(htmlspecialchars(trim(substr($_POST['salons'],5))));
            $salonSelected = $clientSalons[$key];
            $selected = true;
            $rndvs = [];
            $reservations = $daoBeauty->getReservationsBySalon($salonSelected);
            $rndvs = $this->getReservationsByClient($reservations, $client);
            $dateBefore = htmlspecialchars(trim($_POST['dateBefore']));
            $dateAfter = htmlspecialchars(trim($_POST['dateAfter']));
            $rndvs = $this->searchReservationBydate($rndvs, $dateBefore, $dateAfter);
            } catch (\Exception $e) {
                require './view/verror.php';
                exit;
            }
        } elseif (isset($_POST['search']) && $_POST['salons'] === 'showAll' && $_POST['dateAfter'] === '' && $_POST['dateBefore'] === '') {
            $rndvs = [];
            $rndvs = $this->getReservationsByClient($reservations, $client);
        } else {
            $msgUtilisateur = [];
        }
        require './view/client/vclientPaniers.php';
    }
    public function deletePanier () {
        error_reporting(E_ALL);
        session_start();
        $response = false;
        $msgUtilisateur = [];
        $_SESSION['msgUtilisateur'] = $msgUtilisateur;
        if (isset($_POST['reservation'])) {
            $key = intval(htmlspecialchars(trim($_POST['reservation'])));
            try {
                $daoBeauty = new DaoBeauty();
                $reservationDetails = $daoBeauty->getLigneDetailsByRndv($key);
                $reservation = $daoBeauty->getReservationById($key);
                foreach ($reservationDetails as $key => $ligneDetails) {
                    $response = $daoBeauty->deleteLigneDetails($ligneDetails);
                }
                if ($response) {
                    $response = $daoBeauty->deleteReservation($reservation);
                    if ($response) {
                        $msgUtilisateur = ['success' => true, 'message' => 'BeautyStyling Info, la réservation ' . $reservation->getNom_rndv() . ' a été supprimée!', 'style' => 'text-primary', 'msgShow' => true];
                    }
                }
            } catch (\Exception $e) {
                require './view/verror.php';
                exit;
            }
        } else {
            require './view/verror.php';
            exit;
        }
        try{
            $daoBeauty = new DaoBeauty();
            $client = new Client(1, 'Thierry');
            $reservations = $daoBeauty->getRendezVous();
            $rndvs = $this->getReservationsByClient($reservations, $client);
            $clientSalons = $this->getUniqueSalonsListe($reservations, $client);
        } catch (\Exception $e) {
            require './view/verror.php';
            exit;
        }
        require './view/client/vclientPaniers.php';
    }
    public function getPanierDetail () {
        error_reporting(E_ALL);
        session_start();
        try { //check for DB connection
        $daoBeauty = new DaoBeauty();
        } catch (\Exception $e) {
            require './view/verror.php';
            exit;
        }
        $totalPanier = 0;
        $client = new Client(1, 'Thierry');
        $reservationDetails = array();
        $msgUtilisateur = [];
        if (isset($_POST['detail']) && substr(htmlspecialchars(trim($_POST['detail'])),0,6) === 'detail') {
            $key = intval(substr(htmlspecialchars(trim($_POST['detail'])),6));
        } elseif (isset($_POST['modifLigne']) && isset($_POST['qte']) && isset($_POST['idRndv']) && isset($_POST['numLigne']) && isset($_POST['idPresta'])) {
            $key = intval(htmlspecialchars(trim($_POST['idRndv'])));
            $presta = intval(htmlspecialchars(trim($_POST['idPresta'])));
            $qte = intval(htmlspecialchars(trim($_POST['qte'])));
            $numLigne = intval(htmlspecialchars(trim($_POST['numLigne'])));
            try {
            $reservationDetails = $daoBeauty->getReservationById($key);
            $ligneDetails = new LigneDetails($reservationDetails, $daoBeauty->getPrestationByID($presta), $numLigne, new Employe(1,''), $qte);
            $response = $daoBeauty->updateLigneDetails($ligneDetails);
            if (!$response) {
                require './view/verror.php';
                exit;
            }
            } catch (\Exception $e) {
                require './view/verror.php';
                exit;
            }
        } else {
            require './view/verror.php';
            exit;
        }
        try {
            $offrirs = array();
            $totalPanier = 0;
            $reservation = $daoBeauty->getReservationById($key);
            $reservationDetails = $daoBeauty->getLigneDetailsByRndv($key);
            foreach($reservationDetails as $key => $reservationDetail) {
                $offrir = $daoBeauty->getOffrir($reservationDetail->getIdRDV()->getId_salon(), $reservationDetail->getIdPresta());
                array_push($offrirs,$offrir);
                $totalPanier += $reservationDetail->getQte() * ($offrir ? ($offrir->getPrix_prest_salon() != 0 ? $offrir->getPrix_prest_salon() : $reservationDetail->getIdPresta()->getPrixIndPrestaEuro()) : $reservationDetail->getIdPresta()->getPrixIndPrestaEuro());
            }
        } catch (\Exception $e) {
            require './view/verror.php';
            exit;   
        } 
        include './view/client/vclientDetailPanier.php';
    }
}
?>