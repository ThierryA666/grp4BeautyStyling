<<<<<<< HEAD
<?php

declare(strict_types=1);
namespace beautyStyling\metier;

class Etat {
    private int     $id_etat;
    private String  $libel_etat;

    public function __construct($id_etat, $libel_etat) {
        $this->id_etat      = $id_etat;
        $this->libel_etat   = $libel_etat;
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

class Etat {
    private int     $id_etat;
    private String  $libel_etat;

    public function __construct($id_etat, $libel_etat) {
        $this->id_etat      = $id_etat;
        $this->libel_etat   = $libel_etat;
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
>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
?>