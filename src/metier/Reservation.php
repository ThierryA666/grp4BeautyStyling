<?php

declare(strict_types=1);
namespace beautyStyling\metier;

use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\metier\Etat;

class Plat {
    private     int             $id_rndv;
    private     time            $h_rndv;
    private     date            $d_rndv;
    private     String          $nom_rndv;
    private     String          $detail_rndv;
    private ?   Etat            $id_etat;
    private ?   Client          $id_client;
    private ?   Salon           $id_salon;

    public function __construct(int $id_rndv, time $h_rndv, date $d_rndv, String $nom_rndv, String $detail_rndv, ? Etat $id_etat, ? Client $id_client, ? Salon $id_salon) {
        $this->id_rndv           = $id_rndv;
        $this->h_rndv      = $h_rndv;
        $this->d_rndv         = $d_rndv;     
        $this->nom_rndv  = $nom_rndv;
        $this->detail_rndv    = $detail_rndv;
        $this->id_etat    = $id_etat;
        $this->id_client    = $id_client;
        $this->id_salon    = $id_salon;
    }

    public function getId_rndv(): int {
        return $this->id_rndv;
    }
    public function setId_rndv(int $id_rndv) {
        $this->id_rndv = $id_rndv;
    }

    public function getH_rndv(): time {
        return $this->h_rndv;
    }
    public function setH_rndv(time $h_rndv) {
        $this->h_rndv = $h_rndv;
    }

    public function getD_rndv(): date {
        return $this->d_rndv;
    }
    public function setD_rndv(date $d_rndv) {
        $this->d_rndv = $d_rndv;
    }

    public function getNom_rndv(): String {
        return $this->nom_rndv;
    }
    public function setNom_rndv(String $nom_rndv) {
        $this->nom_rndv = $nom_rndv;
    }

    public function getDetail_rndv(): String {
        return $this->detail_rndv;
    }
    public function setDetail_rndv(String $detail_rndv) {
        $this->detail_rndv = $detail_rndv;
    }

    public function getId_etat(): Categorie {
        return $this->id_etat;
    }
    public function setId_etat(Categorie $id_etat) {
        $this->id_etat = $id_etat;
    }

    public function getId_client(): Client {
        return $this->id_client;
    }
    public function setId_client(Client $id_client) {
        $this->id_client = $id_client;
    }

    public function getId_salon(): Salon {
        return $this->id_salon;
    }
    public function setId_salon(Salon $id_salon) {
        $this->id_salon = $id_salon;
    }
        
    public function __toString() {
        return '[Reservation : '.$this->id_rndv .', '. $this->h_rndv .', '. $this->d_rndv .', '. $this->nom_rndv .', '. $this->detail_rndv .', '. $this->id_etat . $this->id_client .', '. $this->id_salon . ']';
    }
}

?>