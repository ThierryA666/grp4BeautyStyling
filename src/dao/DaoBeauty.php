<?php
declare(strict_types=1);
namespace beautyStyling\dao;

use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\metier\Spe;

//TODO : gestion des exceptions
class DaoBeauty {

    private \PDO $conn;

    public function __construct() {
        try {
            $this->conn = Database::getConnection();
        } catch (\Exception $e) {
            $this->conn = null;
        }
    }

    private function convertCode($code) : int { 
        $code = 8000;
        if (isset($code))   $code = (int)$code;
        return $code;
    }

    public function getSPE() : array {
        $spes = array();
        $query      = Requetes::SELECT_SPE;
        try {
            $cursor  = $this->conn->query($query);
            // FETCH_OBJ pour obtenir la ligne sous forme d'un objet construit avec les cles correspondantes aux colonnes du select
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                $spe = new Spe($row->idSalon, $row->nomSalon, $row->idPresta, $row->nomPresta, $row->idEmploye, $row->nomEmploye);
                array_push($spes,$spe);
            }
        }
        catch (\Exception $e) {
            throw new \Exception('Exception BEAUTY !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error BEAUTY !!! : ' .  $error->getMessage());
        }
        return $spes;
    }
}
?>