<?php

declare(strict_types=1);
namespace beautyStyling\metier;

use beautyStyling\metier\Salon;

class Employe {
    private int         $idEmploye;
    private String      $nomEmploye;
    private ? Salon     $idSalon;

    public function __construct(int $idEmploye, String $nomEmploye, Salon $idSalon = null) {
        $this->idEmploye        = $idEmploye;
        $this->nomEmploye       = $nomEmploye;
        $this->idSalon          = $idSalon;
    }

    public function __toString() {
        return '[Employe : ID=>' . $this->idEmploye .', Nom=>' . $this->nomEmploye . ', Salon=>' . $this->idSalon->getNom_salon() . ']';
    }
    
    /**
     * Get the value of idEmploye
     *
     * @return int
     */
    public function getIdEmploye(): int {
        return $this->idEmploye;
    }

    /**
     * Set the value of nomEmploye
     *
     * @param String $nomEmploye
     *
     * @return self
     */
    public function setNomEmploye(String $nomEmploye): self {
        $this->nomEmploye = $nomEmploye;
        return $this;
    }

    /**
     * Get the value of nomEmploye
     *
     * @return String
     */
    public function getNomEmploye(): String {
        return $this->nomEmploye;
    }

    /**
     * Get the value of idSalon
     *
     * @return Salon
     */
    public function getIdSalon(): Salon {
        return $this->idSalon;
    }
}

?>