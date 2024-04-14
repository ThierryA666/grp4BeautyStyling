<?php
declare(strict_types=1);
namespace beautyStyling\dao;

use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\metier\Salon;
use beautyStyling\metier\Villes;
use beautyStyling\metier\Prestation;
use beautyStyling\metier\Offrir;
use beautyStyling\metier\Spe;

//TODO : gestion des exceptions
class DaoBeauty {

    private \PDO $conn;

    public function __construct() {
        try {
            $this->conn = Database::getConnection();
        } catch (\Exception $e) {
            $conn = null;
            throw new \Exception('Connection failed!', 500);
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
                $prestation = new Prestation($row->id_presta, $row->nom_presta, intval($row->duree_presta), intval($row->prix_ind_presta), \DateTime::createFromFormat("Y-m-d H:i:s", $row->creation_date), $row->modif_date ? \DateTime::createFromFormat("Y-m-d", $row->modif_date) : null, $row->desc_presta ? $row->desc_presta : null);
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
                    $prestation = new Prestation($row->id_presta, $row->nom_presta, intval($row->duree_presta), intval($row->prix_ind_presta), \DateTime::createFromFormat("Y-m-d H:i:s", $row->creation_date), $row->modif_date ? \DateTime::createFromFormat("Y-m-d", $row->modif_date) : null, $row->desc_presta ? $row->desc_presta : null);
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
            $statement->bindValue(':dureePresta', $prestation->getDureePresta(), \PDO::PARAM_INT);
            $statement->bindValue(':modifDate', null, \PDO::PARAM_STR);
            $statement->bindValue(':creationDate', $prestation->getCreationDate()->format('Y-m-d H:i:s'), \PDO::PARAM_STR);
            $statement->bindValue(':prixIndPresta', $prestation->getPrixIndPresta(), \PDO::PARAM_INT);
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
            $statement->bindValue(':dureePresta', $prestation->getDureePresta(), \PDO::PARAM_INT);
            $statement->bindValue(':modifDate', $prestation->getModifDate()->format('Y-m-d'), \PDO::PARAM_STR);
            $statement->bindValue(':prixIndPresta', $prestation->getPrixIndPresta(),  \PDO::PARAM_INT);
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

    // lister tous les salons
    public function getSalon(): ? array {
        $salons = [];
        $query  = Requetes :: SELECT_SALON;
    try{   
        $cursor = $this->conn->query($query);
        while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
            // var_dump($row);
            $salon = new Salon($row->id_salon, $row->nom_res, $row->prenom_res, $row->ad_1, '', $row->nom_salon, $row->email_salon, $row->cp_salon, $row->tel_salon, '', $row->photo_salon, $row->pw_salon,  new \DateTime(), $row->nom_ville);
            array_push ($salons,$salon);
        }
    } 
    catch (\Exception $e) {
        throw new \Exception('Exception !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
    }
    catch (\Error $error) {
        throw new \Exception('Error !!! : ' .  $error->getMessage());
    }    
    return $salons;
    }
   
    // ajouter des  nouveau salons 

    public function addSalon(Salon $salon){
        $query = Requetes::INSERT_SALON;
        try {
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id_salon', $salon->getId_salon());
            $statement->bindValue(':nom_res', $salon->getNom_res());
            $statement->bindValue(':prenom_res', $salon->getPrenom_res());
            $statement->bindValue(':ad_1', $salon->getAd1());
            $statement->bindValue(':ad_2', $salon->getAd2());
            $statement->bindValue(':nom_salon', $salon->getNom_salon());
            $statement->bindValue(':email_salon', $salon->getEmail_salon());
            //codepostal:string
            $statement->bindValue(':cp_salon', (string)$salon->getCp_salon());
            //concatener '0' pour numero de tel
            $statement->bindValue(':tel_salon', '0' . $salon->getTel_salon());
            $statement->bindValue(':url_salon',$salon->getUrl_salon());
            $statement->bindValue(':photo_salon',$salon->getPhoto_salon());
            $statement->bindValue(':pw_salon',$salon->getPw_salon());
            //formater la date
            $dateString = $salon->getDate_cre()->format('Y-m-d');
            $statement->bindValue(':date_cre', $dateString);
            $statement->bindValue(':nom_ville',$salon->getNom_ville());
            // var_dump($statement);
            $statement->execute();
        }
        catch (\Exception $e) {
            throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
    }
    
    //rechercher salons par mots cles
    public function searchSalon(?string $keyWord): array {
        $salons = [];

        $query = Requetes::SELECT_SALON_BY_MOTSCLES;
        try{
            if ($keyWord !== null) {
                // verifier si c'est numero de tel
                if ($keyWord[0] === '0') {
                    // enleve '0'
                    $keyWord = substr($keyWord, 1);
                }
                $keyWord = '%' . $keyWord . '%';
                //verifier si c'est numeric -> convert int
                if (is_numeric($keyWord)) {
                    $keyWord = filter_var($keyWord, FILTER_SANITIZE_NUMBER_INT); 
                }
            }
            $cursor = $this->conn->prepare($query);
            $cursor ->bindValue(':motcle', $keyWord);
            $cursor->execute(); 
            while($row = $cursor->fetch(\PDO::FETCH_OBJ)){
                $tel_salon = strval($row->tel_salon);
                $salon = new Salon($row->id_salon, $row->nom_res, $row->prenom_res, '', '', $row->nom_salon, $row->email_salon, '', $tel_salon, '', '', '',  new \DateTime(), '');
                $salons[] = $salon;
            }
        }
        catch (\Exception $e) {
            throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        return $salons;
    }


    public function getSalonByID(int $id_salon): ?Salon {
        
        $query = Requetes::SELECT_SALON_BY_ID;
        try {
            $query  = $this->conn->prepare($query);
            $query->execute([':id_salon' => $id_salon]);
            $row = $query->fetch(\PDO::FETCH_OBJ);
            $tel_salon = strval($row->tel_salon); // 不要な場合は削除できます
            $cp_salon = strval($row->cp_salon);   // 不要な場合は削除できます
            $salon = new Salon($row->id_salon, $row->nom_res, $row->prenom_res, $row->ad_1, $row->ad_2, $row->nom_salon, $row->email_salon, $cp_salon, $tel_salon, $row->url_salon, $row->photo_salon, $row->pw_salon, new \DateTime(), $row->nom_ville); 
        } catch (\Exception $e) {
            throw new \Exception('Exception !!! : ' .  $e->getMessage(), $this->convertCode($e->getCode()));
        } catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        return $salon;
    }
    

    // public function updateSalonByID(Salon $salon){
    //     $query = Requetes::UPDATE_SALON_BY_ID;
    //     try{
    //         $statement = $this->conn->prepare($query);
    //         $statement->bindValue(':id_salon', $salon->getId_salon());
    //         $statement->bindValue(':nom_res', $salon->getNom_res());
    //         $statement->bindValue(':prenom_res', $salon->getPrenom_res());
    //         $statement->bindValue(':ad_1', $salon->getAd1());
    //         $statement->bindValue(':ad_2', $salon->getAd2());
    //         $statement->bindValue(':email_salon', $salon->getEmail_salon());
    //         //codepostal:string
    //         $statement->bindValue(':cp_salon', (string)$salon->getCp_salon());
    //         //concatener '0' pour numero de tel
    //         $statement->bindValue(':tel_salon', '0' . $salon->getTel_salon());
    //         $statement->bindValue(':url_salon',$salon->getUrl_salon());
    //         $statement->bindValue(':photo_salon',$salon->getPhoto_salon());
    //         $statement->bindValue(':pw_salon',$salon->getPw_salon());
    //         $statement->bindValue(':nom_salon', $salon->getNom_salon());
    //         $statement->bindValue(':nom_ville',$salon->getNom_ville());
    //         $statement->execute();
    
    //     }
    //     catch (\Exception $e) {
    //         throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
    //     }
    //     catch (\Error $error) {
    //         throw new \Exception('Error !!! : ' .  $error->getMessage());
    //     }
    // }

    public function updateSalonByID(Salon $salon){
        $query = Requetes::UPDATE_SALON_BY_ID;
        try{
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id_salon', $salon->getId_salon());
            $statement->bindValue(':nom_res', $salon->getNom_res());
            $statement->bindValue(':prenom_res', $salon->getPrenom_res());
            $statement->bindValue(':ad_1', $salon->getAd1());
            $statement->bindValue(':ad_2', $salon->getAd2());
            $statement->bindValue(':email_salon', $salon->getEmail_salon());
            //codepostal:string
            $statement->bindValue(':cp_salon', (string)$salon->getCp_salon());
            //concatener '0' pour numero de tel
            $statement->bindValue(':tel_salon', '0' . $salon->getTel_salon());
            $statement->bindValue(':url_salon',$salon->getUrl_salon());
            $statement->bindValue(':photo_salon',$salon->getPhoto_salon());
            $statement->bindValue(':pw_salon',$salon->getPw_salon());
            $statement->bindValue(':nom_salon', $salon->getNom_salon());
            $statement->bindValue(':nom_ville',$salon->getNom_ville());
            $statement->execute();
    
        }
        catch (\Exception $e) {
            throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
    }


    // public function delSalon(Salon $salon){
    //     $query = Requetes::DELETE_SALON;
    //     $statement = $this->conn->prepare($query);
    // }
    


}