<?php
declare(strict_types=1);
namespace beautyStyling\dao;

use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\metier\Salon;
use beautyStyling\metier\Prestation;
use beautyStyling\metier\Offrir;
use beautyStyling\metier\Spe;
use beautyStyling\metier\Etat;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Client;
use beautyStyling\metier\Employe;
use beautyStyling\metier\LigneDetails;
use LDAP\Result;

use beautyStyling\webapp\MyException;
use beautyStyling\webapp\MyExceptionCase;

class DaoBeauty {

    private \PDO $conn;

    public function __construct() {
        try {
            $this->conn = Database::getConnection();
        } catch (\PDOException $pdoe) {
            echo 'Erreur PDO : ' . $pdoe->getCode();
            echo '<br>';
            print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1062:
                    if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                    if (str_contains($pdoe->errorInfo[2],"nom_presta"))throw new \Exception();
                case 1226:
                    if (str_contains($pdoe->errorInfo[2],"max_queries_per_hour")) throw new \Exception();
                default:
                    throw $pdoe;
            } 
        } 
        catch (\Exception $e) {
            $conn = null;
            throw new \Exception('Connection failed!', 500);
        }

    }

    private function convertCode($code) : int { 
        $code = 8000;
        if (isset($code))   $code = (int)$code;
        return $code; 
    }


/*******************************************************************************************************************************************************/
// Prestation queries
/*******************************************************************************************************************************************************/
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
                $response = $statement->execute(['idPresta' => $id]);
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
                $response = $statement->execute(['idPresta' => $prestation->getIdPresta()]);
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
    public function getPrestationByName(String $nomPresta) : ? Prestation {
        if (!isset($nomPresta)) {
            throw new DaoException('Cette prestation est inexistante',8002);
            $prestation = null;
        } else {
            $query = Requetes::SELECT_PRESTA_BY_NAME;
            try {
                $statement= $this->conn->prepare($query);
                $statement->execute(['nomPresta' => $nomPresta]);
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

/*******************************************************************************************************************************************************/
// Salon queries
/*******************************************************************************************************************************************************/
    // lister tous les salons
    public function getSalon(): ? array {
        $salons = [];
        $query  = Requetes :: SELECT_SALON;
    try{   
        $cursor = $this->conn->query($query);
        while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
            // var_dump($row);
            $cp_salon = strval($row->cp_salon);
            $tel_salon = strval($row->tel_salon);
            $salon = new Salon($row->id_salon, $row->nom_res, $row->prenom_res, $row->ad_1, '', $row->nom_salon, $row->email_salon, $cp_salon, $tel_salon, '', $row->photo_salon, $row->pw_salon,  new \DateTime(), $row->nom_ville);
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
        catch (\PDOException $pdoe) {
            // echo 'Erreur PDO : ' . $pdoe->getCode();
            // echo '<br>';
            // print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1062:
                    if (str_contains($pdoe->errorInfo[2],"email_salon"))throw new MyException(MyExceptionCase::EMAIL_DOUBLON);
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

    public function getSalonByName(?string $keyWord): array {
        $salons = [];

        $query = Requetes::SELECT_SALON_BY_NAME;
        try{
            if ($keyWord !== null) {
                $keyWord = '%' . $keyWord . '%';
            }
            
            $cursor = $this->conn->prepare($query);
            $cursor ->bindValue(':motcle', $keyWord);
            $cursor->execute(); 
            while($row = $cursor->fetch(\PDO::FETCH_OBJ)){
                $tel_salon = strval($row->tel_salon);
                $cp_salon  = strval($row->cp_salon);
                
                $salon = new Salon($row->id_salon, '', '', $row->ad_1, $row->ad_2, $row->nom_salon, '', $cp_salon, $tel_salon, $row->url_salon, $row->photo_salon, '',  new \DateTime(), $row->nom_ville);
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
            $tel_salon = strval($row->tel_salon); 
            $cp_salon = strval($row->cp_salon);   
            $salon = new Salon($row->id_salon, $row->nom_res, $row->prenom_res, $row->ad_1, $row->ad_2, $row->nom_salon, $row->email_salon, $cp_salon, $tel_salon, $row->url_salon, $row->photo_salon, $row->pw_salon, new \DateTime(), $row->nom_ville); 
        
        }catch (\Exception $e) {
            throw new \Exception('Exception !!! : ' .  $e->getMessage(), $this->convertCode($e->getCode()));
        } catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        return $salon;
    }
    
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


    public function delSalonByID(Salon $salon){
        $query = Requetes::DELETE_SALON_BY_ID;
        try {
            $query  = $this->conn->prepare($query);
            $query->bindValue(':id_salon', $salon->getId_salon(), \PDO::PARAM_INT);
            $query->execute();
        } catch (\PDOException $pdoe) {
            // echo 'Erreur PDO : ' . $pdoe->getCode();
            // echo '<br>';
            // print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1451:
                    if (str_contains($pdoe->errorInfo[2],"FOREIGN KEY")) throw new MyException(MyExceptionCase::SALON_USE);
                default:
                    throw $pdoe;
            }
        } catch (\Exception $e) {
            throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        } catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        } 
    }
    
    public function getSalonByEmail(string $email_salon):?Salon{
        $query = Requetes::SELECT_SALON_BY_EMAIL;
        try {
            $query  = $this->conn->prepare($query);
            $query->execute([':email_salon' => $email_salon]);
            $row = $query->fetch(\PDO::FETCH_OBJ);
            if (!$row) {
                return null;
            }
            $tel_salon = strval($row->tel_salon); 
            $cp_salon = strval($row->cp_salon); 
            $salon = new Salon($row->id_salon, $row->nom_res, $row->prenom_res, $row->ad_1, $row->ad_2, $row->nom_salon, $row->email_salon, $cp_salon, $tel_salon, $row->url_salon, $row->photo_salon, $row->pw_salon, new \DateTime(), $row->nom_ville); 
            
        } catch (\PDOException $pdoe) {
            echo 'Erreur PDO : ' . $pdoe->getCode();
            echo '<br>';
            print_r ($pdoe->errorInfo);
            throw $pdoe;
            // switch ($pdoe->errorInfo[1]) {
            //     case 1451:
            //         if (str_contains($pdoe->errorInfo[2],"FOREIGN KEY")) throw new MyException(MyExceptionCase::SALON_USE);
            //     default:
            //         throw $pdoe;
            // }
        } catch (\Exception $e) {
            throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        } catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        } 
        return $salon;
    }

    public function getPrestaBySalon(Salon $salon):array{
        if (!isset($salon)) throw new DaoException('Ce salon est inexistante',8002);
        $query      = Requetes::SELECT_PRESTA_BY_SALON;
        try {
            $cursor  = $this->conn->prepare($query);
            $cursor->bindValue(':id_salon', $salon->getId_salon());
            $cursor->execute();
            $offrirs=[];
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                // var_dump($row);
                $offrir = new Offrir(new Prestation($row->id_presta, $row->nom_presta,0,0, new \DateTime,new \DateTime, ''), $salon, (float) $row->prix_prest_salon);  
                array_push($offrirs, $offrir);
            }      
   
        }
        catch (\Exception $e) {
            throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error  !!! : ' .  $error->getMessage());
        }
        return $offrirs;
    }

    public function updateOffrirByID(Offrir $offrir){
        $query = Requetes :: UPDATE_OFFRIR_BY_ID;
        try{
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id_salon', $offrir->getId_salon()->getId_salon());
            $statement->bindValue(':id_presta', $offrir->getIdPresta()->getIdPresta());
            $statement->bindValue(':prix_prest_salon', $offrir->getPrix_prest_salon());
            $result = $statement->execute();
            return $result;
        } catch (\Exception $e) {
            throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        } catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        
    }

    public function addOffrir(Offrir $offrir){
        $query = Requetes::INSERT_OFFRIR;
        try{
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id_salon', $offrir->getId_salon()->getId_salon());
            $statement->bindValue(':id_presta', $offrir->getIdPresta()->getIdPresta());
            $statement->bindValue(':prix_prest_salon', $offrir->getPrix_prest_salon());
            $result = $statement->execute();
            return $result;
        } catch (\Exception $e) {
            throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        } catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        
    }

    public function countOffrir(Offrir $offrir){
           try{
                $query = Requetes::SELECT_COUNT_OFFRIR;
                $statement = $this->conn->prepare($query);
                $statement->bindValue(':id_salon', $offrir->getId_salon()->getId_salon());
                $statement->bindValue(':id_presta', $offrir->getIdPresta()->getIdPresta());
                $statement->execute();

                $count = $statement->fetchColumn();
                
    
            } catch (\Exception $e) {
                throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
            } catch (\Error $error) {
                throw new \Exception('Error !!! : ' .  $error->getMessage());
            }
            return $count;
    }
    
    public function delOffrirBySalon(Salon $salon){
        $query = Requetes :: DELETE_OFFRIR_BY_SALON;
        try{
            $statement = $this->conn->prepare($query);
            $statement->bindValue(':id_salon', $salon->getId_salon());
            $statement->execute();

        } catch (\Exception $e) {
            throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        } catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
    }

    public function getSalonByPresta(Prestation $prestation):array{
        if (!isset($prestation)) throw new DaoException('Ce prestation est inexistante',8008);
        $query      = Requetes::SELECT_SALON_BY_PRESTA;
        try {
            $cursor  = $this->conn->prepare($query);
            $cursor->bindValue(':id_presta', $prestation->getIdPresta());
            $cursor->execute();
            $salons=[];
            while($row = $cursor->fetch(\PDO::FETCH_OBJ)){
                // var_dump($row);
                $tel_salon = strval($row->tel_salon);
                $cp_salon  = strval($row->cp_salon);
                
                $salon = new Salon($row->id_salon, '', '', $row->ad_1, $row->ad_2, $row->nom_salon, '', $cp_salon, $tel_salon, $row->url_salon, $row->photo_salon, '',  new \DateTime(), $row->nom_ville);
                $salons[] = $salon;
            }      
   
        }
        catch (\Exception $e) {
            throw new \Exception('Exception  !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error  !!! : ' .  $error->getMessage());
        }
        return $salons;
    } 
    
    
    
    public function getReservationsBySalon(Salon $salon) : array {
        if (!isset($salon)) throw new DaoException('Objet salon est inexistant',8003);
        $reservations = array();
        $query = Requetes::SELECT_RESERVATION_BY_SALON;
        try {
            $cursor = $this->conn->prepare($query);
            $cursor->bindValue(':idsalon', $salon->getId_salon(), \PDO::PARAM_INT);
            $cursor->execute();
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                $reservation = new Reservation($row->id_rndv,\DateTime::createFromFormat('H:i:s',$row->h_rndv),\DateTime::createFromFormat('Y-m-d',$row->d_rndv), isset($row->nom_rndv) ? $row->nom_rndv : '', isset($row->detail_rndv) ? $row->detail_rndv : '', new Etat($row->id_etat, 'En cours'), new Client($row->id_client, 'Thierry'), $salon);
                array_push($reservations, $reservation);
            }
            $cursor->closeCursor();
        } catch (\PDOException $pdoe) {
            echo 'Erreur PDO : ' . $pdoe->getCode();
            echo '<br>';
            print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1062:
                    if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                    if (str_contains($pdoe->errorInfo[2],"id_rndv"))throw new \Exception();
                default:
                    throw $pdoe;
            } 
        } catch (\Exception $e) {
            throw $e;
        } catch (\Error $error) {
            throw $error;
        } 
        return $reservations;
    }
/*******************************************************************************************************************************************************/
// Reservation queries
/*******************************************************************************************************************************************************/


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
                $salon = $this->getSalonByID($row->id_salon);
                $rndv = new Reservation($row->id_rndv,  \DateTime::createFromFormat('H:i:s',$row->h_rndv), \DateTime::createFromFormat('Y-m-d', $row->d_rndv), $row->nom_rndv, $row->detail_rndv ? $row->detail_rndv : '', new Etat($row->id_etat, 'En cours'), new Client($row->id_client, 'Takako'),$salon);
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
                $etat = new Etat($row->id_etat, $row->libel_etat);
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
    public function getEtats() : ? array {
        $etats = array();
        $query      = Requetes::SELECT_ETAT;
        try {
            $cursor  = $this->conn->query($query);
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                $etat = new Etat($row->id_etat, $row->libel_etat);
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
    public function deleteReservation(Reservation $reservation) : ? bool {
        if (!isset($reservation)) {throw new DaoException('Cet reservation est inexistante',8002);}
        $query      = Requetes::DELETE_RESERVATION_BY_ID;
        try {
            $statement  = $this->conn->prepare($query);
            $statement->bindValue(':id_rndv', $reservation->getId_rndv(), \PDO::PARAM_INT);
            $response = $statement->execute();
            if ($response) {
                return $response;
            } else {
                throw new \PDOException('La reservation est inexistante', 8003);
            }
        }
        catch (\PDOException $pdoe) {
            // echo 'Erreur PDO : ' . $pdoe->getCode();
            // echo '<br>';
            // print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1451:
                    if (str_contains($pdoe->errorInfo[2],"FOREIGN KEY")) throw new \Exception();
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
    public function getEmploye(Employe $employe) : ? Employe {
        if (!isset($employe)) {
            throw new DaoException('Cet employe est inexistant',8002);
            $employe = null;
        } else {
            $query = Requetes::SELECT_EMPLOYE;
            try {
                $statement= $this->conn->prepare($query);
                $statement->bindValue(':idEmploye', $employe->getIdEmploye());
                // FETCH_OBJ pour obtenir la ligne sous forme d'un objet construit avec les cles correspondantes aux colonnes du select
                $statement->execute();
                $row = $statement->fetch(\PDO::FETCH_OBJ);
                if ($row) {
                    $employe = new Employe($row->id_employe, $row->nom_employe, $this->getSalonByID($row->id_salon));
                } else {
                    throw new \PDOException('Cet employe est inexistant', 8002)  ;
                }  
            }
            catch (\PDOException $pdoe) {
                echo 'Erreur PDO : ' . $pdoe->getCode();
                echo '<br>';
                switch ($pdoe->getCode()) {
                    case 1062:
                        if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                        if (str_contains($pdoe->errorInfo[2],"id_employe"))throw new \Exception();
                        if (str_contains($pdoe->errorInfo[2],"id_salon"))throw new \Exception();
                    case 8002:
                        throw new \Exception('Cet employe est inexistant', 8002);
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
        return $employe;
    }
    public function getClient(Client $client) : ? Client {
        if (!isset($client)) {
            throw new DaoException('Ce client est inexistant',8002);
            $client = null;
        } else {
            $query = Requetes::SELECT_CLIENT;
            try {
                $statement= $this->conn->prepare($query);
                $statement->bindValue(':idClient', $client->getIdClient());
                // FETCH_OBJ pour obtenir la ligne sous forme d'un objet construit avec les cles correspondantes aux colonnes du select
                $statement->execute();
                $row = $statement->fetch(\PDO::FETCH_OBJ);
                if ($row) {
                    $client = new Client($row->id_client, $row->nom_client);
                } else {
                    throw new \PDOException('Ce client est inexistant', 8002)  ;
                }  
            }
            catch (\PDOException $pdoe) {
                echo 'Erreur PDO : ' . $pdoe->getCode();
                echo '<br>';
                switch ($pdoe->getCode()) {
                    case 1062:
                        if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                        if (str_contains($pdoe->errorInfo[2],"id_client"))throw new \Exception();
                    case 8002:
                        throw new \Exception('Ce client est inexistant', 8002);
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
        return $client;
    }    
    public function getLigneDetailsByRndv(int $id_rndv) : array {
        if (!isset($id_rndv)) throw new DaoException('Cette reservation est inexistante',8003);
        $reservationDetails = array();
        $query = Requetes::SELECT_RESERVATION_DETAILS_BY_RNDV_ID;
        try {
            $cursor = $this->conn->prepare($query);
            $cursor->bindValue(':idRDV', $id_rndv, \PDO::PARAM_INT);
            $cursor->execute();
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                $prestation = $this->getPrestationByID($row->id_presta);
                $reservation = $this->getReservationById($row->id_rndv);
                $ligneDetails = new LigneDetails($reservation,$prestation,$row->num_ligne, $this->getEmploye(new  Employe($row->id_employe,'')), $row->qte);
                array_push($reservationDetails, $ligneDetails);
            }
            $cursor->closeCursor();
        } catch (\PDOException $pdoe) {
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
        return $reservationDetails;
    }
    public function getReservationById(int $id) : ?Reservation {
        if (!isset($id)) throw new DaoException('Ce reservation est inexistant',8003);
        $rndv       = null;
        $etat  = null;
        $query      =Requetes::SELECT_RESERVATION_BY_ID;
        try {
            $query  = $this->conn->prepare($query);
            $query->execute(['id'=>$id]);
            $row = $query->fetch(\PDO::FETCH_OBJ);
            // si pas de resultat alors $row = false : var_dump($row);
            if($row) {
                $salon = $this->getSalonByID($row->id_salon);
                $etat = new Etat($row->id_etat, 'En cours');
                $rndv = new Reservation($row->id_rndv, \DateTime::createFromFormat("H:i:s",$row->h_rndv), \DateTime::createFromFormat("Y-m-d", $row->d_rndv), $row->nom_rndv, $row->detail_rndv ? $row->detail_rndv : '', $etat, new Client($row->id_client, ''), $salon);
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
    public function updateLigneDetails(LigneDetails $ligneDetail) {
        if (!isset($ligneDetail)) throw new DaoException('Cette ligneDetail est inexistante',8003);
        $query = Requetes::UPDATE_QTY_LIGNE_DETAILS;
        try {
            $statement= $this->conn->prepare($query);
            $statement->bindValue(':idrndv', $ligneDetail->getIdRDV()->getId_rndv(), \PDO::PARAM_INT);
            $statement->bindValue(':idpresta', $ligneDetail->getIdPresta()->getIdPresta(), \PDO::PARAM_INT);
            $statement->bindValue(':numLigne', $ligneDetail->getNumLigne(), \PDO::PARAM_INT);
            $statement->bindValue(':qte', $ligneDetail->getQte(), \PDO::PARAM_INT);
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
                    if (str_contains($pdoe->errorInfo[2],"id_rndv, id_presta"))throw new \Exception();
                case 8002:
                        if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                        if (str_contains($pdoe->errorInfo[2],"id_rndv, id_presta"))throw new \Exception();
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
    public function deleteLigneDetails(LigneDetails $ligneDetails) : ? bool {
        if (!isset($ligneDetails)) {
            throw new DaoException('Objet LigneDetails est inexistant',8003);
            $ligneDetails = null; 
        } else {
            $query = requetes::DELETE_LIGNE_DETAILS;
            try {
                $statement= $this->conn->prepare($query);
                $statement->bindValue(':idRndv', $ligneDetails->getIdRDV()->getId_rndv());
                $response = $statement->execute();
                if ($response) {
                    return $response;
                } else {
                    throw new \PDOException('La ligne detail est inexistante', 8003);
                }
            }
            catch (\PDOException $pdoe) {
                switch ($pdoe-> getCode()) {
                    case 1062:
                        if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                        if (str_contains($pdoe->errorInfo[2],"ligne_detail"))throw new \Exception();
                    case 8003:
                        throw new \Exception('La ligne detail est inexistante', 8003);
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
    public function getOffrir(Salon $salon, Prestation $prestation) : ? OFFRIR {
        if (!isset($salon) || !isset($prestation)) throw new DaoException('Ce salon ou cette prestation est inexistant(e)',8003);
        $query = Requetes::SELECT_OFFRIR_BY_PRESTA_SALON;
        try {
            $statement= $this->conn->prepare($query);
            $statement->bindValue(':idPresta', $prestation->getIdPresta(), \PDO::PARAM_INT);
            $statement->bindValue(':idSalon', $salon->getId_salon(), \PDO::PARAM_INT);
            $statement->execute();
            $row = $statement->fetch(\PDO::FETCH_OBJ);
            if ($row) {
                $offrir = new Offrir($prestation, $salon, floatval($row->prix_prest_salon));
                return $offrir;
            } else {
                return null;
            }
        }
        catch (\PDOException $pdoe) {
            echo 'Erreur PDO : ' . $pdoe->getCode();
            echo '<br>';
            print_r ($pdoe->errorInfo);
            switch ($pdoe->errorInfo[1]) {
                case 1062:
                    if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                    if (str_contains($pdoe->errorInfo[2],"id_salon, id_presta"))throw new \Exception();
                case 8002:
                        if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                        if (str_contains($pdoe->errorInfo[2],"id_salon, id_presta"))throw new \Exception();
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
    public function getReservationByDateAndSalon(\DateTime $date, Salon $salon) : array {
        if (!isset($salon)) throw new DaoException('Ce salon est inexistant',8003);
        if (!isset($date)) throw new DaoException('Date non spécifiée',8003);
        $rndvs       = [];
        $date = $date->format('Y-m-d');
        $query = Requetes::SELECT_RESERVATION_BY_DATE_AND_SALON;
        try {
            $cursor= $this->conn->prepare($query);
            $cursor->bindValue(':drndv', $date, \PDO::PARAM_STR);
            $cursor->bindValue(':idSalon', $salon->getId_salon(), \PDO::PARAM_INT);
            $cursor->execute();
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                if ($row) {
                    $rndv = new Reservation($row->id_rndv, \DateTime::createFromFormat('H:i:s',$row->h_rndv), \DateTime::createFromFormat('Y-m-d',$row->d_rndv), $row->nom_rndv, $row->detail_rndv, new Etat($row->id_etat, 'En cours'), $this->getClient(new Client($row->id_client, '')), $salon);
                    array_push($rndvs, $rndv);
                }
            }
        }
        catch (\Exception $e) {
            throw new \Exception('Exception !!! : ' .  $e->getMessage() , $this->convertCode($e->getCode()));
        }
        catch (\Error $error) {
            throw new \Exception('Error !!! : ' .  $error->getMessage());
        }
        return $rndvs;
    }
}
?>