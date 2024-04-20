<<<<<<< HEAD
<?php

declare(strict_types=1);
namespace beautyStyling\metier;

class Client {
    private int     $idClient;
   
    public function __construct($idClient) {
        $this->idClient       = $idClient;
    }
    
    public function __toString() {
        return '[Client : ID=>' . $this->idClient . ']';
    }
    
    /**
     * Get the value of idClient
     *
     * @return int
     */
    public function getIdClient(): int {
        return $this->idClient;
    }
}
?>
=======
<?php

declare(strict_types=1);
namespace beautyStyling\metier;

class Client {
    private int     $idClient;
   
    public function __construct($idClient) {
        $this->idClient       = $idClient;
    }
    
    public function __toString() {
        return '[Client : ID=>' . $this->idClient . ']';
    }
    
    /**
     * Get the value of idClient
     *
     * @return int
     */
    public function getIdClient(): int {
        return $this->idClient;
    }
}
?>
>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
