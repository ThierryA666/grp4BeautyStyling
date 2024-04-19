<?php
declare(strict_types=1);
namespace beautyStyling\metier;

class Spe {
    
    private int     $idSalon;
    private String  $nomSalon;
    private int     $idPresta;
    private String  $nomPresta;
    private int     $idEmploye;
    private String  $nomEmploye;


    public function __construct(int $idSalon, String $nomSalon, int $idPresta, String $nomPresta, int $idEmploye, String $nomEmploye) {
        $this->idSalon      = $idSalon;
        $this->nomSalon     = $nomSalon;
        $this->idPresta     = $idPresta;
        $this->nomPresta    = $nomPresta;
        $this->idEmploye    = $idEmploye;
        $this->nomEmploye   = $nomEmploye;
    }
}

?>