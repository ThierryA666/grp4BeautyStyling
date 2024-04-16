<<<<<<< HEAD
<?php

declare(strict_types=1);
namespace beautyStyling\metier;

use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\metier\Reservation;


class Etat {
    private int     $id_etat;
    private String  $libel_etat;

    public function __construct($id_etat, $libel_etat) {
        $this->id_etat       = $id_etat;
        $this->libelle  = $libel_etat;
    }

    public function getId_etat(): int {
        return $this->id_etat;
    }
    public function setId(int $id_etat) {
        $this->id_etat = $id_etat;
    }
    public function getLibel_etat(): String {
        return $this->libel_etat;
    }
    public function setLibel_etat(String $libel_etat) {
        $this->libel_etat = $libel_etat;
    }
    public function __toString() {
        return '[Etat : '.$this->id_etat . ',' . $this->libel_etat .']';
    }
}

=======
<?php

declare(strict_types=1);
namespace beautyStyling\metier;

use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\metier\Reservation;


class Etat {
    private int     $id_etat;
    private String  $libel_etat;

    public function __construct($id_etat, $libel_etat) {
        $this->id_etat       = $id_etat;
        $this->libelle  = $libel_etat;
    }

    public function getId_etat(): int {
        return $this->id_etat;
    }
    public function setId(int $id_etat) {
        $this->id_etat = $id_etat;
    }
    public function getLibel_etat(): String {
        return $this->libel_etat;
    }
    public function setLibel_etat(String $libel_etat) {
        $this->libel_etat = $libel_etat;
    }
    public function __toString() {
        return '[Etat : '.$this->id_etat . ',' . $this->libel_etat .']';
    }
}

>>>>>>> a6980d88292d460c429dea4d66edcf90a6e13bb2
?>