<?php
declare(strict_types=1);
namespace beautyStyling\dao;

use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\metier\Prestation;
use beautyStyling\metier\Spe;

//TODO : gestion des exceptions
class DaoBeauty {

    private \PDO $conn;

    public function __construct() {
        try {
            $this->conn = Database::getConnection();
        } catch (\Exception $e) {
            $conn = null;
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
                $spe = new Spe($row->id_salon, $row->nom_salon, $row->id_presta, $row->nom_presta, $row->id_employe, $row->nom_employe);
                array_push($spes,$spe);
            }
            $cursor->closeCursor();
        }
        catch (\PDOException $pdoe) {
            echo 'Erreur PDO : ' . $pdoe->getCode();
            echo '<br>';
            print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1062:
                    if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                    if (str_contains($pdoe->errorInfo[2],"nom_presta"))throw new \Exception();
                default:
                    throw $pdoe;
            } 
        } 
        catch (\Exception $e) {
            throw $e;
        }
        catch (\Error $error) {
            throw $error;
        } 
        return $spes;
    }

    public function getPrestations() : array {
        $prestations = array();
        $query      = Requetes::SELECT_PRESTA;
        try {
            $cursor  = $this->conn->query($query);
            // FETCH_OBJ pour obtenir la ligne sous forme d'un objet construit avec les cles correspondantes aux colonnes du select
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                $prestation = new Prestation($row->id_presta, $row->nom_presta, \DateTime::createFromFormat("h:i:s", $row->duree_presta), floatval($row->prix_ind_presta), \DateTime::createFromFormat("Y-m-d H:i:s", $row->creation_date), $row->modif_date ? \DateTime::createFromFormat("Y-m-d", $row->modif_date) : null, $row->desc_presta ? $row->desc_presta : null);
                array_push($prestations,$prestation);
            }
            $cursor->closeCursor();
        }
        catch (\PDOException $pdoe) {
            switch ($pdoe->errorInfo[1]) {
                case 1062:
                    if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                    if (str_contains($pdoe->errorInfo[2],"nom_presta"))throw new \Exception();
                default:
                    throw $pdoe;
            } 
        } 
        catch (\Exception $e) {
            throw $e;
        }
        catch (\Error $error) {
            throw $error;
        } 
        return $prestations;
    }

    public function deletePrestationByID(int $id) : ? bool {
        if (!isset($id)) {
            throw new DaoException('Cette prestation est inexistante',8002);
        } else {
            $query = Requetes::DELETE_PRESTA_BY_ID;
            try {
                $statement= $this->conn->prepare($query);
                $statement->execute(['idPresta' => $id]);
                $response = $statement->execute();
                return $response;
            }
            catch (\PDOException $pdoe) {
                echo 'Erreur PDO : ' . $pdoe->getCode();
                echo '<br>';
                print_r ($pdoe->errorInfo);
                switch ($pdoe->errorInfo[1]) {
                    case 1062:
                        if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                        if (str_contains($pdoe->errorInfo[2],"nom_presta"))throw new \Exception();
                    default:
                        throw $pdoe;
                } 
            } 
            catch (\Exception $e) {
                throw $e;
            }
            catch (\Error $error) {
                throw $error;
            } 
        }
    }

    public function deletePrestation(Prestation $prestation) : ? bool {
        if (!isset($prestation)) {
            throw new DaoException('Objet prestation est inexistante',8003);
            $prestation = null; 
        } else {
            $query = Requetes::DELETE_PRESTA_BY_ID;
            try {
                $statement= $this->conn->prepare($query);
                $statement->execute(['idPresta' => $prestation->getIdPresta()]);
                $response = $statement->execute();
                if ($response) {
                    return $response;
                } else {
                    throw new \PDOException('La prestation est inexistante', 8003);
                }
            }
            catch (\PDOException $pdoe) {
                switch ($pdoe-> getCode()) {
                    case 1062:
                        if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                        if (str_contains($pdoe->errorInfo[2],"nom_presta"))throw new \Exception();
                    case 8003:
                        throw new \Exception('La prestation est inexistante', 8003);
                    default:
                        throw $pdoe;
                } 
            } 
            catch (\Exception $e) {
                throw $e;
            }
            catch (\Error $error) {
                throw $error;
            } 
        }
    }

    public function getPrestationByID(int $id) : ? Prestation {
        if (!isset($id)) {
            throw new DaoException('Cette prestation est inexistante',8002);
            $prestation = null;
        } else {
            $query = Requetes::SELECT_PRESTA_BY_ID;
            try {
                $statement= $this->conn->prepare($query);
                $statement->execute(['idPresta' => $id]);
                // FETCH_OBJ pour obtenir la ligne sous forme d'un objet construit avec les cles correspondantes aux colonnes du select
                $row = $statement->fetch(\PDO::FETCH_OBJ);
                if ($row) {
                    $prestation = new Prestation($row->id_presta, $row->nom_presta, \DateTime::createFromFormat("h:i:s", $row->duree_presta), floatval($row->prix_ind_presta), \DateTime::createFromFormat("Y-m-d H:i:s", $row->creation_date), $row->modif_date ? \DateTime::createFromFormat("Y-m-d", $row->modif_date) : null, $row->desc_presta ? $row->desc_presta : null);
                    return $prestation;
                } else {
                    throw new \PDOException('Cette prestation est inexistante', 8002)  ;
                }  
            }
            catch (\PDOException $pdoe) {
                echo 'Erreur PDO : ' . $pdoe->getCode();
                echo '<br>';
                switch ($pdoe->getCode()) {
                    case 1062:
                        if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                        if (str_contains($pdoe->errorInfo[2],"nom_presta"))throw new \Exception();
                    case 8002:
                        throw new \Exception('Cette prestation est inexistante', 8002);
                    default:
                        throw $pdoe;
                } 
            } 
            catch (\Exception $e) {
                throw $e;
            }
            catch (\Error $error) {
                throw $error;
            } 
        }
    }

    public function createPrestation(Prestation $prestation) : bool {
        if (!isset($prestation)) throw new DaoException('Objet prestation est inexistante',8003);
        $query = Requetes::INSERT_PRESTA;
        try {
            $statement= $this->conn->prepare($query);
            $statement->bindValue(':nomPresta', $prestation->getNomPresta(), \PDO::PARAM_STR);
            $statement->bindValue(':descPresta', $prestation->getDescPresta(), \PDO::PARAM_STR);
            $statement->bindValue(':dureePresta', $prestation->getDureePresta()->format('h:i:s'), \PDO::PARAM_STR);
            $statement->bindValue(':modifDate', null);
            $statement->bindValue(':creationDate', $prestation->getCreationDate()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
            $statement->bindValue(':prixIndPresta', $prestation->getPrixIndPresta());
            $response = $statement->execute();
            return $response;
        }
        catch (\PDOException $pdoe) {
            echo 'Erreur PDO : ' . $pdoe->getCode();
            echo '<br>';
            print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1062:
                    if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                    if (str_contains($pdoe->errorInfo[2],"nom_presta"))throw new \Exception();
                default:
                    throw $pdoe;
            } 
        } 
        catch (\Exception $e) {
            throw $e;
        }
        catch (\Error $error) {
            throw $error;
        } 
    }
    public function updatePrestation(Prestation $prestation) : bool {
        if (!isset($prestation)) throw new DaoException('Cette prestation est inexistante',8003);
        $query = Requetes::UPDATE_PRESTA;
        try {
            $statement= $this->conn->prepare($query);
            $statement->bindValue(':nomPresta', $prestation->getNomPresta(), \PDO::PARAM_STR);
            $statement->bindValue(':descPresta', $prestation->getDescPresta(), \PDO::PARAM_STR);
            $statement->bindValue(':dureePresta', $prestation->getDureePresta()->format('Y-m-d h:i:s'), \PDO::PARAM_STR);
            $statement->bindValue(':modifDate', $prestation->getModifDate()->format('Y-m-d'), \PDO::PARAM_STR);
            $statement->bindValue(':prixIndPresta', $prestation->getPrixIndPresta());
            $statement->bindValue(':idPresta', $prestation->getIdPresta(), \PDO::PARAM_INT);
            $response = $statement->execute();
            return $response;
        }
        catch (\PDOException $pdoe) {
            echo 'Erreur PDO : ' . $pdoe->getCode();
            echo '<br>';
            print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1062:
                    if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                    if (str_contains($pdoe->errorInfo[2],"nom_presta"))throw new \Exception();
                default:
                    throw $pdoe;
            } 
        } 
        catch (\Exception $e) {
            throw $e;
        }
        catch (\Error $error) {
            throw $error;
        } 
    }
}
?>