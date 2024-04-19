<?php
declare(strict_types=1);
namespace beautyStyling\dao;

use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\metier\Salon;
use beautyStyling\metier\Villes;
use beautyStyling\metier\Prestation;
use beautyStyling\metier\Offrir;
use DateTime;

use beautyStyling\webapp\MyException;
use beautyStyling\webapp\MyExceptionCase;

class DaoBeauty {
    private \PDO $conn;

    public function __construct() {
        try {
            $this->conn = Database::getConnection();
        } catch (\Exception $e) {
            $conn = null;
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

    private function convertCode($code) : int { 
        $code = 8000;
        if (isset($code))   $code = (int)$code;
        return $code;
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
    
    
    

    
}