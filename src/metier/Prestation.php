<?php
declare(strict_types=1);

namespace beautyStyling\metier;

use DateTime;

class Prestation {
    
    private int         $idPresta;
    private String      $nomPresta;
    private \DateTime    $dureePresta;
    private ? String    $descPresta;
    private float       $prixIndPresta;
    private \DateTime    $creationDate;
    private ? \DateTime  $modifDate;


    public function __construct(int $idPresta, String $nomPresta, \DateTime $dureePresta, float $prixIndPresta, \DateTime $creationDate, ? \DateTime $modifDate = null, ? String $descPresta = null) {
        
        $this->idPresta         = $idPresta;
        $this->nomPresta        = $nomPresta;
        $this->descPresta       = $descPresta;
        $this->dureePresta      = $dureePresta ;
        $this->prixIndPresta    = $prixIndPresta;
        $this->creationDate     = $creationDate;
        $this->modifDate        = $modifDate;
    }

    public function __toString() {
        return '[Prestation : ID=>' . $this->idPresta .', Nom=>' . $this->nomPresta .', Prix=>' . $this->prixIndPresta .', DateCreation=>' . $this->creationDate->format('d-m-Y') . ']';

    }

    public function getIdPresta(): int {
        return $this->idPresta;
    }

    public function getNomPresta(): String {
        return $this->nomPresta;
    }

    public function setNomPresta(String $nomPresta): self {
        $this->nomPresta = $nomPresta;
        return $this;
    }

    public function getDureePresta(): DateTime {
        return $this->dureePresta;
    }

    public function setDureePresta(DateTime $dureePresta): self {
        $this->dureePresta = $dureePresta;
        return $this;
    }

    public function getDescPresta() {
        return $this->descPresta;
    }

    public function setDescPresta($descPresta): self {
        $this->descPresta = $descPresta;
        return $this;
    }

    public function getPrixIndPresta(): float {
        return $this->prixIndPresta;
    }

    public function setPrixIndPresta(float $prixIndPresta): self {
        $this->prixIndPresta = $prixIndPresta;
        return $this;
    }

    public function getCreationDate(): DateTime {
        return $this->creationDate;
    }

    public function getModifDate() {
        return $this->modifDate;
    }

    public function setModifDate($modifDate): self {
        $this->modifDate = $modifDate;
        return $this;
    }
}

?>