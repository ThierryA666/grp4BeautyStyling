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
            $tel_salon = strval($row->tel_salon); 
            $cp_salon = strval($row->cp_salon);   
            $salon = new Salon($row->id_salon, $row->nom_res, $row->prenom_res, $row->ad_1, $row->ad_2, $row->nom_salon, $row->email_salon, $cp_salon, $tel_salon, $row->url_salon, $row->photo_salon, $row->pw_salon, new \DateTime(), $row->nom_ville); 
        } catch (\Exception $e) {
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
        }
        catch (\PDOException $pdoe) {
            throw $pdoe;
        } 
        catch (\Exception $e) {
            throw $e;
        }
        catch (\Error $error) {
            throw $error;
        } 
    }
    


}