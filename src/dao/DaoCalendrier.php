<?php
declare(strict_types=1);
namespace beautyStyling\dao;

use beautyStyling\dao\Database;
use beautyStyling\dao\Requettes;
use beautyStyling\dao\DaoException;
use PDO;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Client;
use beautyStyling\metier\Etat;
use beautyStyling\metier\LigneDetails;
use beautyStyling\metier\Employe;
use beautyStyling\metier\Prestation;
use beautyStyling\metier\Salon;
use beautyStyling\metier\Offrir;

// include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\Requettes.php';
//include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Prestation.php';
//include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\DaoException.php';
// include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\Database.php';
//include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Client.php';
//include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Salon.php';
//include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\LigneDetails.php';
//include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Employe.php';

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


    public function getRendezVous() : ? array {
        $rendezVous = array();
        $query      = Requettes::SELECT_RESERVATION;
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
    public function getReservationById(int $id_rndv) : ?Reservation {
        // Vérifier si un ID valide a été fourni
        if (!isset($id_rndv)) {
            throw new DaoException('Ce rendez-vous est inexistant', 8003);
        }
    
        $rndv = null;
        $etat = null;
        $queryStr = requettes::SELECT_RESERVATION_BY_ID;
    
        try {
            // Préparer la requête
            $query = $this->conn->prepare($queryStr);
    
            // Exécuter la requête avec l'ID en tant que paramètre
            $query->execute(['id_rndv' => $id_rndv]);
    
            // Récupérer la ligne de résultats
            $row = $query->fetch(\PDO::FETCH_OBJ);
    
            // Vérifier si des résultats ont été trouvés
            if ($row) {
                // Convertir le champ h_rndv en objet DateTime
                $h_rndv = \DateTime::createFromFormat('H:i:s', $row->h_rndv);
                $d_rndv = new \DateTime($row->d_rndv);
    
                // Vérifier si la conversion a réussi
                if ($h_rndv === false || $d_rndv === false) {
                    throw new \Exception('Erreur lors de la conversion de h_rndv ou d_rndv en DateTime');
                }
    
                // Créer un objet Etat avec les données de la ligne
                // Note: Vérifiez si la propriété existe dans $row avant de l'utiliser
                // Note: Assurez-vous que les propriétés existent dans $row
                $etat = isset($row->id_etat) && isset($row->libel_etat) ? new Etat($row->id_etat, $row->libel_etat) : null;
    
                // Créer un objet Client avec les données de la ligne
                $client = new Client($row->id_client);
                $salonId = $row->id_salon;
                $salon = $this->getSalonByID($salonId); 
    
                // Créer un objet Reservation avec les données de la ligne
                $rndv = new Reservation(
                    $row->id_rndv,
                    $h_rndv,
                    $d_rndv,
                    $row->nom_rndv,
                    $row->detail_rndv,
                    $etat, // Transmettre l'objet Etat au lieu de l'id_etat
                    $client,
                    $salon
                );
            }
        } catch (\Exception $e) {
            // Capturer et relancer toute exception survenue lors de l'exécution de la requête
            throw new \Exception('Exception !!! : ' .  $e->getMessage(), $this->convertCode($e->getCode()));
        } catch (\Error $error) {
            // Capturer et relancer toute erreur survenue lors de l'exécution de la requête
            throw new \Exception('Erreur !!! : ' .  $error->getMessage());
        }
    
        // Renvoyer l'objet Reservation récupéré ou null s'il n'y a aucun résultat trouvé
        return $rndv;
    }
    // public function save($conn) {
    //     try {
    //         // Préparation de la requête d'insertion pour la table RESERVATION
    //         $stmt = $conn->prepare("INSERT INTO RESERVATION (h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon) VALUES (:h_rndv, :d_rndv, :nom_rndv, :detail_rndv, :id_etat, :id_client, :id_salon)");
        
    //         // Liaison des paramètres
    //         $stmt->bindParam(':d_rndv', $this->date);
    //         $stmt->bindParam(':h_rndv', $this->heure);
    //         $stmt->bindParam(':nom_rndv', $this->nom);
    //         $stmt->bindParam(':detail_rndv', $this->details);
        
    //         // Définition des valeurs par défaut pour id_etat et id_client
    //         $id_etat = 1;
    //         $id_client = 1;
    //         $stmt->bindParam(':id_etat', $id_etat);
    //         $stmt->bindParam(':id_client', $id_client);
        
    //         // Récupération de l'ID du salon
    //         $id_salon = $this->getIdSalon($conn);
        
    //         // Exécution de l'insertion
    //         $stmt->execute();
        
    //         // Obtention de l'ID de la réservation
    //         $this->id_rndv = $conn->lastInsertId();
        
    //         // Insertion dans la table ligne_detail
    //         $this->insertLigneDetail($conn);
        
    //         echo "Rendez-vous ajouté correctement";
    //     } catch(\Exception $e) {
    //         echo "Erreur lors de la connexion à la base de données: " . $e->getMessage();
    //     }
    // }
      
    function addReservation($date, $heure, $nom, $details, $id_salon) {
        try {
            // Connexion à la base de données
            $conn = Database::getConnection();
    
            // Préparer l'insertion des données dans la table RESERVATION
            $stmt_reservation = $conn->prepare(Requettes::INSERT_RESERVATION);
            $stmt_reservation->bindParam(':d_rndv', $date);
            $stmt_reservation->bindParam(':h_rndv', $heure);
            $stmt_reservation->bindParam(':nom_rndv', $nom);
            $stmt_reservation->bindParam(':detail_rndv', $details);
            $id_etat = 1; // Valeur par défaut pour l'état
            $id_client = 1; // Valeur par défaut pour le client
            $stmt_reservation->bindParam(':id_etat', $id_etat);
            $stmt_reservation->bindParam(':id_client', $id_client);
            $stmt_reservation->bindParam(':id_salon', $id_salon);
    
            // Exécuter l'insertion dans la table RESERVATION
            $stmt_reservation->execute();
    
            // Obtenez l'ID de la réservation insérée
            $id_reservation = $conn->lastInsertId();
    
            // Retourner l'ID de la réservation insérée
            return $id_reservation;
        } catch(\PDOException $e) {
            // Gérer les erreurs de connexion à la base de données
            echo "Erreur lors de la connexion à la base de données: " . $e->getMessage();
            return false; // Retourner false en cas d'erreur
        }
    }
    public function updateReservation(Reservation $reservation) {
        if (!isset($reservation)) throw new DaoException('Cette reservation est inexistante',8003);
        $query = Requettes::UPDATE_DETAIL_RESERVATION;
        try {
            $statement= $this->conn->prepare($query);
            $statement->bindValue(':idRndv', $reservation->getId_rndv(), \PDO::PARAM_INT);
            $statement->bindValue(':detailRndv', $reservation->getDetail_rndv(), \PDO::PARAM_STR);
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
                    if (str_contains($pdoe->errorInfo[2],"id_rndv"))throw new \Exception();
                case 8002:
                        if (str_contains($pdoe->errorInfo[2],"PRIMARY")) throw new \Exception();
                        if (str_contains($pdoe->errorInfo[2],"id_rndv"))throw new \Exception();
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
            $query = requettes::DELETE_LIGNE_DETAILS;
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
       
    public function getLigneDetailsByRndv(int $id_rndv) : array {
        $reservationDetails = array();
        $query = requettes::SELECT_RESERVATION_DETAILS_BY_RNDV_ID;
        try {
            $cursor = $this->conn->prepare($query);
            $cursor->bindValue(':idRDV', $id_rndv, \PDO::PARAM_INT);
            $cursor->execute();
            while ($row = $cursor->fetch(\PDO::FETCH_OBJ)) {
                $prestation = $this->getPrestationByID($row->id_presta);
                $reservation = $this->getReservationById($row->id_rndv);
                $ligneDetails = new LigneDetails($reservation,$prestation,$row->num_ligne, new Employe(1,'Albator'), $row->qte);
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

    public function getLastLineNumber($id_reservation) {
        try {
            $stmt_last_num_ligne = $this->conn->prepare("SELECT MAX(num_ligne) AS last_num_ligne FROM ligne_detail WHERE id_rndv = :id_rndv");
            $stmt_last_num_ligne->bindParam(':id_rndv', $id_reservation);
            $stmt_last_num_ligne->execute();
            $last_num_ligne_row = $stmt_last_num_ligne->fetch(PDO::FETCH_ASSOC);
            return $last_num_ligne_row['last_num_ligne'];
        } catch(\PDOException $e) {
            throw new DaoException("Erreur lors de la récupération du dernier numéro de ligne: " . $e->getMessage());
        }
    }
    
    public function insertLigneDetail($id_reservation, $num_ligne, $id_prestation) {
        try {
            $stmt_ligne_detail = $this->conn->prepare(Requettes::INSERT_LIGNE_DETAILS);
            $stmt_ligne_detail->bindParam(':id_rndv', $id_reservation);
            $stmt_ligne_detail->bindParam(':num_ligne', $num_ligne);
            $stmt_ligne_detail->bindParam(':id_presta', $id_prestation);
            $stmt_ligne_detail->execute();
        } catch(\PDOException $e) {
            throw new DaoException("Erreur lors de l'insertion de la ligne de détail: " . $e->getMessage());
        }
    }
    

    public function getPrestationByID(int $id) : ? Prestation {
        if (!isset($id)) {
            throw new DaoException('Cette prestation est inexistante',8002);
            $prestation = null;
        } else {
            $query = requettes::SELECT_PRESTA_BY_ID;
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

    public function getSalonByID(int $id_salon): ?Salon {
        
        $query = requettes::SELECT_SALON_BY_ID;
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

    public function getPrestaBySalon(Salon $salon):array{
        if (!isset($salon)) throw new DaoException('Ce salon est inexistante',8002);
        $query      = Requettes::SELECT_PRESTA_BY_SALON;
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


    private function convertCode($code): int {
        if (isset($code) && is_numeric($code)) {
            return (int)$code;
        } else {
            return 8000; // Valeur par défaut si le code n'est pas numérique ou n'est pas défini
        }
    }
      
}
?>