<?php

declare(strict_types=1);
namespace beautyStyling\metier;

class Client {
    private int     $idClient;
    private String  $nomClient;

    public function __construct($idClient, $nomClient) {
        $this->idClient       = $idClient;
        $this->nomClient       = $nomClient;
    }
    
    public function __toString() {
        return '[Client : ID=>' . $this->idClient .', Nom=>' . $this->nomClient . ']';
    }
    
    /**
     * Get the value of idClient
     *
     * @return int
     */
    public function getIdClient(): int {
        return $this->idClient;
    }

    /**
     * Get the value of nomClient
     *
     * @return String
     */
    public function getNomClient(): String {
        return $this->nomClient;
    }

    /**
     * Set the value of nomClient
     *
     * @param String $nomClient
     *
     * @return self
     */
    public function setNomClient(String $nomClient): self {
        $this->nomClient = $nomClient;
        return $this;
    }
}
?>
