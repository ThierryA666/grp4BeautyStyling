<?php

declare(strict_types=1);
namespace beautyStyling\metier;

class Employe {
    private int     $idEmploye;
    private String  $nomEmploye;

    public function __construct($idEmploye, $nomEmploye) {
        $this->idEmploye       = $idEmploye;
        $this->nomEmploye       = $nomEmploye;
    }

    public function __toString() {
        return '[Employe : ID=>' . $this->idEmploye .', Nom=>' . $this->nomEmploye . ']';
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
}

?>