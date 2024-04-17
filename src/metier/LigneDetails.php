<?php
declare(strict_types=1);

namespace beautyStyling\metier;

use beautyStyling\metier\Prestation;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Employe;


class LigneDetails {
    
    private Reservation     $idRDV;
    private Prestation      $idPresta;
    private int             $numLigne;
    private Employe         $idEmploye;
    private int             $qte;

    public function __construct(Reservation $idRDV, Prestation $idPresta, int $numLigne, Employe $idEmploye, int $qte) {
        
        $this->idRDV       = $idRDV;
        $this->idPresta    = $idPresta;
        $this->numLigne    = $numLigne;
        $this->idEmploye   = $idEmploye;
        $this->qte         = $qte ;
        
    }

    public function __toString() {
        return '[Reservation Details : ID=>' . $this->idRDV->getId_rndv() .  ']';
    }

    /**
     * Get the value of idRDV
     *
     * @return Reservation
     */
    public function getIdRDV(): Reservation {
        return $this->idRDV;
    }

    /**
     * Get the value of idPresta
     *
     * @return Prestation
     */
    public function getIdPresta(): Prestation {
        return $this->idPresta;
    }

    /**
     * Get the value of numLigne
     *
     * @return int
     */
    public function getNumLigne(): int {
        return $this->numLigne;
    }

    /**
     * Set the value of numLigne
     *
     * @param int $numLigne
     *
     * @return self
     */
    public function setNumLigne(int $numLigne): self {
        $this->numLigne = $numLigne;
        return $this;
    }

    /**
     * Get the value of idEmploye
     *
     * @return Employe
     */
    public function getIdEmploye(): Employe {
        return $this->idEmploye;
    }

    /**
     * Get the value of qte
     *
     * @return int
     */
    public function getQte(): int {
        return $this->qte;
    }

    /**
     * Set the value of qte
     *
     * @param int $qte
     *
     * @return self
     */
    public function setQte(int $qte): self {
        $this->qte = $qte;
        return $this;
    }
}
?>