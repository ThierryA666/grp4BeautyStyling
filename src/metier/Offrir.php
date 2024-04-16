<?php
declare(strict_types=1);

namespace beautyStyling\metier;

use beautyStyling\metier\Prestation;
use beautyStyling\metier\Salon;

class Offrir{
  private ?Prestation   $idPresta;
  private ?Salon        $id_salon;
  private ?float        $prix_prest_salon;

  public function __construct($idPresta, $id_salon, $prix_prest_salon) {
    $this->idPresta         = $idPresta;
    $this->id_salon         = $id_salon; 
    $this->prix_prest_salon = (float) $prix_prest_salon;
  }

  

  public function __toString()  {
    return '[Salon: '.$this->id_salon.' , Prestation: '.$this->idPresta. ', Prix Salon; '. $this->prix_prest_salon. ']';
  }
  
  

  public function getPrix_prest_salon(): float {
    return $this->prix_prest_salon;
}


public function setPrix_prest_salon(float $prix_prest_salon): self {
  $this->prix_prest_salon = $prix_prest_salon;
  return $this;
}

    public function getIdPresta() :Prestation
    {
        return $this->idPresta;
    }

    public function setIdPresta(Prestation $idPresta)
    {
        $this->idPresta = $idPresta;

        return $this;
    }

    public function getId_salon() :Salon
    {
        return $this->id_salon;
    }

    public function setId_salon(Salon $id_salon)
    {
        $this->id_salon = $id_salon;

        return $this;
    }
}