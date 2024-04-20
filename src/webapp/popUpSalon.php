<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

require_once '../../vendor/autoload.php';

use beautyStyling\dao\DaoBeauty;

session_start();

try { //check for DB connection
    $daoBeauty = new DaoBeauty();
  } catch (\Exception $e) {
    header('Location:./error.php');
  }

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['salonID'])) {
        try {
            $salon = $daoBeauty->getSalonByID(intval(htmlspecialchars(trim($_GET['salonID']))));
        } catch (\Exception $e) {
            header('Location:./error.php');
        }
    }

}

include '../view/vpopUpSalon.php';
?>