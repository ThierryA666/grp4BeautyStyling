<?php
declare(strict_types=1);
namespace beautyStyling\dao;

use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;

//Gestion des exceptions
class DaoCalendrier {

    private \PDO $conn;

    public function __construct() {
        try {
            $this->conn = Database::getConnection();
        } catch (\Exception $e) {
            $conn = null;
        }
    }

    /**
     * Retourne la liste des rendez-vous de la BDD
     *
     * @return array : Tableau d'objets de type rendez-vous
     */
    public function getRendezVous() : ? array {
        $rendezVous = array();
        $query      = Requetes::SELECT_RESERVATION;
        try {
            $cursor  = $this->conn->query($query);
            // FETCH_OBJ pour obtenir la ligne sous forme d'un objet construit avec les cles correspondantes aux colonnes du select
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                $plat = new Reservation($row->id_rndv, $row->h_rndv, $row->d_rndv, $row->nom_rndv, $row->detail_rndv, $row->id_etat, $row->id_client, $row->id_salon, null);
                array_push($rendezVous,$rndv);
            }
        }
        catch (\Exception $e) {
            throw new \Exception('Exception !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        return $rendezVous;
    }

    public function getRendezVousWithId() : ? array {
        $rendezVous = array();
        $query      = Requetes::SELECT_RESERVATION_BY_ID;
        try {
            $cursor  = $this->conn->query($query);
            // FETCH_OBJ pour obtenir la ligne sous forme d'un objet construit avec les cles correspondantes aux colonnes du select
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                $categorie = new Etat($row->id_etat, $row->libel_etat);
                $rndv = new Reservation($row->id_rndv, $row->h_rndv, $row->d_rndv, $row->nom_rndv, $row->detail_rndv, $row->id_etat, $row->id_client, $row->id_salon, $etat);
                array_push($rendezVous,$rndv);
            }
        }
        catch (\Exception $e) {
            throw new \Exception('Exception !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        return $rendezVous;
    }

    // TODO : contrôles 
    // TODO : gestion des erreurs
    public function getRendezVousById(Etat $etat) : ? array{
        if (!isset($etat)) throw new DaoException('Cet état est inexistante',8002);
        $query      = Requetes::SELECT_PLAT_BY_CATEGORIE;
        try {
            $cursor  = $this->conn->prepare($query);
            $cursor->bindValue(1, $etat->getId());
            $cursor->execute();
            // autre syntaxe
            // $cursor->execute([$categorie->getId()]);
            $rendezVous=[];
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                $rndv = new Reservation($row->id_rndv, $row->h_rndv, $row->d_rndv, $row->nom_rndv, $row->detail_rndv, $row->id_etat, $row->id_client, $row->id_salon, $etat);
                array_push($rendezVous,$rndv);
            }
        }
        catch (\Exception $e) {
            throw new \Exception('Exception !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        return $rendezVous;
    }

        /**
     * Retourne la liste des plats de la BDD
     *
     * @return array : Tableau d'objets de type Plat
     */
    public function getEtats() : ? array {
        $etat = array();
        $query      = Requetes::SELECT_CATEGORIE;
        try {
            $cursor  = $this->conn->query($query);
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                $etats = new Etat($row->id_etat, $row->libel_etat);
                array_push($etats,$etat);
            }
        }
        catch (\Exception $e) {
            throw new \Exception('Exception !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        return $etats;
    }


    // TODO : contrôles 
    // TODO : gestion des erreurs
    public function getEtatById(int $id_etat) : ?Etat {
        if (!isset($id_etat)) throw new DaoException('Cet état est inexistante',8002);
        $etat = null;
        $query      = Requetes::SELECT_CATEGORIE_BY_ID;
        try {
            $query  = $this->conn->prepare($query);
            $query->execute(['id'=>$id_etat]);
            // $categorie = $query->fetchObject('Categorie');  // il faut que nom colonne sql = nom proprietes instance
            $row = $query->fetch(\PDO::FETCH_OBJ);
            $etat = new Etat($row->id_etat, $row->libel_etat);
        }
        catch (\Exception $e) {
            throw new \Exception('Exception !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        return $etat;
    }

        // TODO : contrôles 
    // TODO : gestion des erreurs
    public function getReservationById(int $id_rndv) : ?Reservation {
        if (!isset($id)) throw new DaoException('Ce reservation est inexistant',8003);
        $rndv       = null;
        $etat  = null;
        $query      =Requetes::SELECT_PLAT_BY_ID;
        try {
            $query  = $this->conn->prepare($query);
            $query->execute(['id'=>$id]);
            $row = $query->fetch(\PDO::FETCH_OBJ);
            // si pas de resultat alors $row = false : var_dump($row);
            if($row) {
                $etat = new Etat($row->id_etat, $row->libel_etat);
                $rndv = new Reservation($row->id_rndv, $row->h_rndv, $row->d_rndv, $row->nom_rndv, $row->detail_rndv, $row->id_etat, $row->id_client, $row->id_salon, $etat);
            }
        }
        catch (\Exception $e) {
            throw new \Exception('Exception !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        return $rndv;
    }

    public function addReservation(Reservation $rndv) : bool {
        if (!isset($rndv)) throw new DaoException('Ce rendez-vous est inexistant',8003);
        $query = Requetes::INSERT_RESERVATION;
        try {
            $query  = $this->conn->prepare($query);
            $query->bindValue(':id_rndv',            $rndv->getId_rndv(),             \PDO::PARAM_INT);
            $query->bindValue(':h_rndv',             $rndv->getH_rndv(),        \PDO::PARAM_STR);
            $query->bindValue(':d_rndv',             $rndv->getD_rndv(),           \PDO::PARAM_INT);
            $query->bindValue(':nom_rndv',           $rndv->getNom_rndv(),    \PDO::PARAM_STR);
            $query->bindValue(':detail_rndv',        $rndv->getDetail_rndv(),      \PDO::PARAM_STR);
            $query->bindValue(':id_etat',            $rndv->getEtat()->getId_etat(), \PDO::PARAM_INT);
            $query->bindValue(':id_client',          $rndv->getClient()->getId_client(), \PDO::PARAM_INT);
            $query->bindValue(':id_salon',           $rndv->getSalon()->getId_salon(), \PDO::PARAM_INT);
            $response = $query->execute();  // response = 1 (true) si OK
            return $response;
        }
        catch (\Exception $e) {
            throw new \Exception('Exception !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
    }

    // TODO : contrôles 
    public function addCategorie(Etat $etat) {
        $query      = Requetes::INSERT_CATEGORIE;
        try {
            $statement  = $this->conn->prepare($query);
            $statement->bindValue(1, $etat->getId_etat());
            $statement->bindValue(2, $etat->getLibel_etat());
            $statement->execute();
        }
        catch (\PDOException $pdoe) {
            // echo 'Erreur PDO : ' . $pdoe->getCode();
            // echo '<br>';
            // print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1062:
                    if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new DmException(MyExceptionCase::ID_DOUBLON);
                    if (str_contains($pdoe->errorInfo[2],"libelleC"))throw new DmException(MyExceptionCase::LIBELLE_DOUBLON);
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

    public function delReservation(int $id_rndv) {
        $query      = Requetes::DELETE_RESERVATION_BY_ID;
        try {
            $query  = $this->conn->prepare($query);
            $query->bindValue(':id_rndv', $id_rndv, \PDO::PARAM_INT);
            $query->execute();
        }
        catch (\PDOException $pdoe) {
            // echo 'Erreur PDO : ' . $pdoe->getCode();
            // echo '<br>';
            // print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1451:
                    if (str_contains($pdoe->errorInfo[2],"FOREIGN KEY")) throw new DmException(MyExceptionCase::CATEGORIE_USE);
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




    private function convertCode($code) : int { 
        $code = 8000;
        if (isset($code))   $code = (int)$code;
        return $code;
    }

    
}
?>