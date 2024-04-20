<?php
declare(strict_types=1);

namespace
beautyStyling\metier;

class Prestation {
    
    private int         $idPresta;
    private String      $nomPresta;
    private int         $dureePresta;
    private ? String    $descPresta;
    private int         $prixIndPresta;
    private \DateTime   $creationDate;
    private ? \DateTime $modifDate;

    public function __construct(int $idPresta, String $nomPresta, int $dureePresta, int $prixIndPresta, \DateTime $creationDate, ? \DateTime $modifDate = null, ? String $descPresta = null) {
        
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

    public function getDureePresta(): int {
        return $this->dureePresta;
    }

    public function getDureePrestaHM(): String {
        // Calculate hours and minutes
        $hours = floor($this->dureePresta / 3600);
        $minutes = floor(($this->dureePresta % 3600) / 60);
        // Format the time string
        $timeString = sprintf("%02d:%02d", $hours, $minutes);
        return $timeString;
    }

    public function setDureePresta(int $dureePresta): self {
        $this->dureePresta = $dureePresta;
        return $this;
    }

    public function setDureePrestaHM(String $dureePresta): self {
        list($hours, $minutes) = explode(':', $dureePresta);
        $this->dureePresta = ($hours * 3600) + ($minutes * 60);
        return $this;
    }

    public function getDescPresta() {
        return $this->descPresta;
    }

    public function setDescPresta(String $descPresta): self {
        $this->descPresta = $descPresta;
        return $this;
    }

    public function getPrixIndPresta(): int {
        return $this->prixIndPresta;
    }

    public function getPrixIndPrestaEuro(): float {
        return $this->prixIndPresta/100;
    }

    public function setPrixIndPresta(int $prixIndPresta): self {
        $this->prixIndPresta = $prixIndPresta;
        return $this;
    }

    public function setPrixIndPrestaEuro(String $prixIndPresta): self {
        if (str_contains($prixIndPresta, ',') || str_contains($prixIndPresta, '.')) {
            list($int, $dec) = explode('.', str_replace(',', '.' , $prixIndPresta));
            $this->prixIndPresta = intval($int * 100) + (strlen($dec) === 1 ? intval($dec . '0') : intval($dec));
        } else { $this->prixIndPresta = intval($prixIndPresta) * 100;}
        return $this;
    }

    public function getCreationDate(): \DateTime {
        return $this->creationDate;
    }

    public function getModifDate() {
        return $this->modifDate;
    }

    public function setModifDate(\DateTime $modifDate): self {
        $this->modifDate = $modifDate;
        return $this;
    }
}

