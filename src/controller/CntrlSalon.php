<?php 

namespace beautyStyling\controller;
use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\DaoException;
use beautyStyling\metier\Salon;
use DateTime;
use beautyStyling\webapp\MyException;
use beautyStyling\metier\Offrir;


class CntrlSalon {

    
    public function getIndex() {
        $salons=[];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // var_dump($_SERVER);
            $dao = new DaoBeauty();
            $prestations = $dao->getPrestations();
                try{
                    if(isset($_POST['search'])){
                        // var_dump($_POST);
                        // var_dump(isset($_POST['nameInput']));
                        $keyWord = isset($_POST['nameInput']) && $_POST['nameInput'] !== '' ? $_POST['nameInput'] : '';
                        // var_dump($keyWord);
                        $id_prest = isset($_POST['prestation']) ? $_POST['prestation'] : '';
                                            
                        $results = [];
                        //recherche par nom 
                        if (!empty($keyWord)&& empty($id_prest)) {
                            $results_by_name = $dao->getSalonByName($keyWord);
                            // affiche($results_by_name);
                            $results=[];
                            foreach ($results_by_name as $name_result) {
                                $results[]=$name_result;
                            }
                            $salons=$results;
                            // var_dump($salons);
                        } elseif (empty($keyWord) && !empty($id_prest)){
                            $prestation = $dao->getPrestationByID($id_prest) ;
                            // echo $prestation;
                            $results_by_prest = $dao->getSalonByPresta($prestation);
                            // affiche($results_by_prest);
                            $results=[];
                            foreach ($results_by_prest as $prest_result) {
                                $results[]=$prest_result;
                            }
                            $salons=$results;
                        } elseif (!empty($keyWord) && !empty($id_prest)) {
                        
                            $results_by_name = $dao->getSalonByName($keyWord);
                            $prestation = $dao->getPrestationByID($id_prest) ;
                            $results_by_prest = $dao->getSalonByPresta($prestation);
                            $results=[];
                            foreach ($results_by_name as $name_result){
                                foreach ($results_by_prest as $prest_result) {
                                    if ($name_result->getId_salon() === $prest_result->getId_salon()) {
                                        $results[] = $name_result;
                                        break;
                                    }
                                }
                            }
                            $salons=$results;
                        } else {
                        $results = $dao->getSalon(); 
                        $salons = $results;
                        }
                    }
                        
            } catch (DaoException $e) {
                $message = $e->getCode() . ' - ' . $e->getMessage();
            } catch (\Exception $e) {
                $message = $e->getCode() . ' - ' . $e->getMessage();
            } catch (\Error $e) {
                $message = $e->getMessage();
            }       
        } else {
            // Lors du premier chargement de la page 
            try{
            $dao = new DaoBeauty();
            $prestations=[];
            $prestations = $dao->getPrestations();
            // var_dump($prestations);
                 } catch (DaoException $e) {
                    $message = $e->getCode() . ' - ' . $e->getMessage();
                } catch (\Exception $e) {
                    $message = $e->getCode() . ' - ' . $e->getMessage();
                } catch (\Error $e) {
                    $message = $e->getMessage();
                }       
            }

        require './view/salon/vbeautyStyling.php';
   
    }

    public function getSalonTop(){
        require './view/salon/vsalon_top.php';
    }

    public function getSalonApp(){
        // echo 'application salon';
        $mesage="";
        if(isset($_POST) && !empty($_POST['nom'])){
            // var_dump($_POST);
            try{
                $id_salon    = 0;       
                $nom_res     = '';
                $prenom_res  = '';
                $ad1         = '';
                $ad2         = '';
                $email_salon = '';
                $tel_salon   = '';
                $cp_salon    = '';
                $nom_ville   = '';
                $nom_salon   = '';
                $url         = '';
                $photo_salon = '';
                $pw_salon    = '';
                $date_cre    = new DateTime();

                if(isset($_POST['nom'])) $nom_res = htmlspecialchars(trim($_POST['nom']));
                if(isset($_POST['prenom'])) $prenom_res = htmlspecialchars(trim($_POST['prenom']));
                if(isset($_POST['ad1'])) $ad1 = htmlspecialchars(($_POST['ad1']));
                if(isset($_POST['ad2'])) $ad2 = htmlspecialchars(($_POST['ad2']));
                if(isset($_POST['email'])) $email_salon = htmlspecialchars(($_POST['email']));
                // type char -> int
                if(isset($_POST['tel'])) $tel_salon = intval(($_POST['tel']));
                if(isset($_POST['zip'])) $cp_salon = ($_POST['zip']);
                if(isset($_POST['ville'])) $nom_ville = ($_POST['ville']);
                if(isset($_POST['salonName'])) $nom_salon = htmlspecialchars(trim(($_POST['salonName'])));
                if(isset($_POST['url'])) $url = ($_POST['url']);
                if(isset($_FILES['photo'])) $photo_salon = ($_FILES['photo']['name']);
                if(isset($_POST['pw'])) $pw_salon = ($_POST['pw']);

                $salon = new Salon ($id_salon,$nom_res,$prenom_res,$ad1,$ad2,$nom_salon,$email_salon,$cp_salon,$tel_salon, $url, $photo_salon, $pw_salon, $date_cre, $nom_ville);
                $dao = new DaoBeauty();
                $dao->addSalon($salon);
                
                $message = 'Votre salon est enregistré !!';
        
            } catch (MyException $e) {
                $message = $e->getCode() . ' - ' . $e->getMessage();
            } catch (\Exception $e) {
                $message = $e->getCode() . ' - ' . $e->getMessage();
            } catch (\Error $e) {
                $message = $e->getMessage();
            } 
        }else {
            $message = ' ';
        }

        require './view/salon/vsalon_application.php';
    }

    public function getSalonLogin(){
        require './view/salon/vsalon_login.php';
    }
    
    public function getSalonGestion(){
        $message="";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try{
                if(isset($_POST['savePresta'])){
                    // var_dump($_POST);
                    $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;

                    if($id_salon === null) {
                        // s'il n'y a pas d'id
                        $message = "ID du salon invalide.";
                    } else{
                        // si c'est ok, requpere le data de salon et renouveler
                        $dao = new DaoBeauty();
                        $salon = $dao->getSalonByID($id_salon);
                
                        // recupere des donnes et instantier Offrir
                        if (isset($_POST['chk']) && isset($_POST['prixPresta'])) {
                            $dao->delOffrirBySalon($salon);
                            $checkedPresta = $_POST['chk'];
                            $prixPrestaValues = $_POST['prixPresta'];
                            
                            foreach ($checkedPresta as $id_presta) {
                                    $prestation =$dao->getPrestationByID($id_presta);
                                    if (isset($prixPrestaValues[$id_presta])) {
                                        $id_presta = intval($id_presta);
                                        $prix_presta_salon = $prixPrestaValues[$id_presta];
                                        $offrir = new Offrir($prestation, $salon, $prix_presta_salon);

                                        // echo $offrir;
                                        //add ou update ou delete
                                    
                                        $count = $dao->countOffrir($offrir);
                                        //s'il y a objet offrir:update
                                        if($count >0){
                                            $dao->updateOffrirByID($offrir);
                                        //s'il n'y a pas objet offrir :insert  
                                        } else{
                                            $dao->addOffrir($offrir);
                                        }
                                    }
                            }
                            $salon = $dao->getSalonByID($id_salon);
                            // echo $salon;
                            $prestations=[];
                            $prestations = $dao->getPrestations();
                            foreach ($prestations as $prestation) {
                                // echo $prestation;
                                // echo '<br>';
                            }
                            $offrirs =[];
                            $offrirs = $dao->getPrestaBySalon($salon);
                            foreach ($offrirs as $offrir) {
                                // echo $offrir;
                                // echo '<br>';
                            }    
                            $message = "Les préstations ont été enregistrées avec succès.";
                        }else{
                            $message="Aucune prestation sélectionnée.";
                        }
                    }
                }
            } catch (DaoException $e) {
                $message = $e->getCode() . ' - ' . $e->getMessage();
            } catch (\Exception $e) {
                $message = $e->getCode() . ' - ' . $e->getMessage();
            } catch (\Error $e) {
                $message = $e->getMessage();
            }      
        } // Lors du premier chargement de la page 
        else{
            $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
            if ($id_salon === null) {
                $message = "Ce salon est inexistant.";
                } else {
                    try {
                    $dao = new DaoBeauty();
                    $salon = $dao->getSalonByID($id_salon);
                    // echo $salon;
                    $prestations=[];
                    $prestations = $dao->getPrestations();
                    foreach ($prestations as $prestation) {
                        // echo $prestation;
                        // echo '<br>';
                    }
                    $offrirs =[];
                    $offrirs = $dao->getPrestaBySalon($salon);
                    foreach ($offrirs as $offrir) {
                        // echo $offrir;
                        // echo '<br>';
                    }    
                    } catch (\Exception $e) {
                        echo("Exception!! " . $e->getMessage() . ' ' . $e->getCode());
                    } catch (\Error $e) {
                        echo("Error!! " . $e->getMessage() . ' ' .  $e->getCode());
                    }
                }   
            }               

        require './view/salon/vsalon_gestionnaire.php';
    }

    public function getSalonProfile(){
        $message = ' ';

        // Verifier s'il y a des donnes POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (isset($_POST['clickedButton'])) { 
                        $clickedButton = $_POST['clickedButton'];
                    if ($clickedButton === 'modif') {
                        // quand modifier est cliquee:
                        $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;
                        if($id_salon === null) {
                            // s'il n'y a pas d'id
                            $message = "ID du salon invalide.";
                        } else {
                            // si c'est ok, recupere le data de salon et les afficher
                            $dao = new DaoBeauty();
                            $salon = $dao->getSalonByID($id_salon);
                            
                            // echo 'btn modif clicked';
                        }

                    } elseif ($clickedButton === 'update') {
                        //quand enregistrer est cliquee:
                    // echo 'btn update clicked';
                    $id_salon = isset($_POST['id_salon']) ? intval($_POST['id_salon']) : null;

                    if($id_salon === null) {
                        // s'il n'y a pas d'id
                        $message = "ID du salon invalide.";
                    }else {
                        // si c'est ok, requpere le data de salon et renouveler
                            $dao = new DaoBeauty();
                            $salon = $dao->getSalonByID($id_salon);
                        
                        // recuperer les valeurs modifiees
                            $nom_res = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : '';
                            $prenom_res = isset($_POST['prenom']) ? htmlspecialchars(trim($_POST['prenom'])) : '';
                            $ad1 = isset($_POST['ad1']) ? htmlspecialchars(($_POST['ad1'])) : '';
                            $ad2 = isset($_POST['ad2']) ? htmlspecialchars(($_POST['ad2'])) : '';
                            $email_salon = isset($_POST['email']) ? htmlspecialchars(($_POST['email'])) : '';
                            //   type char -> int
                            $tel_salon = isset($_POST['tel']) ? ($_POST['tel']) : 0;
                            $cp_salon = isset($_POST['zip']) ? ($_POST['zip']) : '';
                            $nom_ville = isset($_POST['ville']) ? ($_POST['ville']) : '';
                            $nom_salon = isset($_POST['nom_salon']) ? htmlspecialchars(trim(($_POST['nom_salon']))) : '';
                            $url = isset($_POST['url']) ? ($_POST['url']) : '';
                            $photo_salon = isset($_FILES['photo']['name']) ? ($_FILES['photo']['name']) : '';
                            $pw_salon = isset($_POST['pw']) ? ($_POST['pw']) : '';
                                    
                            // instantier new objet
                            $updatedSalon = new Salon (
                            $id_salon,
                            $nom_res,
                            $prenom_res,
                            $ad1,
                            $ad2,
                            $nom_salon,
                            $email_salon,
                            $cp_salon,
                            $tel_salon,
                            $url,
                            $photo_salon,
                            $pw_salon,
                            $salon->getDate_cre(),
                            $nom_ville
                            );
                        
                        // ajouter dans le database
                        $dao->updateSalonByID($updatedSalon);
                        $salon = $updatedSalon;
                        $salon = $dao->getSalonByID($id_salon);
                        
                        $message = "Votre salon a été bien modifié";
                    }  
                    } 
                }
            }catch (DaoException $e) {
                $message = $e->getCode() . ' - ' . $e->getMessage();
            } catch (\Exception $e) {
                $message = $e->getCode() . ' - ' . $e->getMessage();
            } catch (\Error $e) {
                $message = $e->getMessage();
            }       
                                
        } else {
        // Lors du premier chargement de la page 
           try{
            $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
            if ($id_salon === null) {
                $message = "Ce salon est inexistant.";
                } else {
                    $dao = new DaoBeauty();
                    $salon = $dao->getSalonByID($id_salon);
                    }
            } catch (DaoException $e) {
                $message = $e->getCode() . ' - ' . $e->getMessage();
            } catch (\Exception $e) {
                $message = $e->getCode() . ' - ' . $e->getMessage();
            } catch (\Error $e) {
                $message = $e->getMessage();
            }       
               
        }
        require './view/salon/vsalon_profile.php';
    }
    public function getSalonLoginCntrl(){
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        try {
            if (session_status() != PHP_SESSION_ACTIVE) session_start();
            $email_salon= '';
            $pw ='';
            $salon='';
    
            if (isset($_POST['emailSalon'])) $email_salon = trim(htmlspecialchars($_POST['emailSalon']));
            if (isset($_POST['pwSalon']))  $pw = trim(htmlspecialchars($_POST['pwSalon']));
            // var_dump($_POST);
            $_SESSION['emailSalon'] = $email_salon;
            $_SESSION['pwSalon']  = $pw;
            // var_dump($_SESSION);
    
    
            $dao = new DaoBeauty();
            $salon = $dao->getSalonByEmail($email_salon);
            // var_dump($salon) ;
            // exit;
            if($salon === null || empty((array)$salon)){
                $message = "L'identifiant de l'utilisateur(email) n'a pas été trouvé.";
                
            } elseif($salon && $pw==$salon->getPw_salon()){
                $host = $_SERVER['SERVER_NAME'];
                $port = $_SERVER['SERVER_PORT'];
                $uri  = $_SERVER['REQUEST_URI'];
                $taburi = explode('/',$uri);
                // print_r($taburi);
                $path ='';
                for ($i=1; $i < count($taburi)-1; $i++) {
                    $path .= '/' . $taburi[$i];
                }
                // echo("<br>$path");
                $id_salon = $salon->getId_salon();
                $chaine = "Location: http://$host:$port$path/gestionnaire?id_salon=$id_salon";
                // echo("<br>$chaine");
                header($chaine);
                exit();  
            } else $message = 'ID utilisateur et PW non valides.';
            
        } catch (\Exception $e) {
            echo("Exception!! " . $e->getMessage() . ' ' . $e->getCode());
        } catch (\Error $e) {
            echo("Error!! " . $e->getMessage() . ' ' .  $e->getCode());
        }
        require './view/salon/vsalon_logincntrl.php';
    }
   
    public function removeSession(){
        echo "removesession";
        unset($_SESSION['emailSalon']);
        unset($_SESSION['pwSalon']);
        $host = $_SERVER['SERVER_NAME'];
                $port = $_SERVER['SERVER_PORT'];
                $uri  = $_SERVER['REQUEST_URI'];
                $taburi = explode('/',$uri);
                // print_r($taburi);
                $path ='';
                for ($i=1; $i < count($taburi)-1; $i++) {
                    $path .= '/' . $taburi[$i];
                }
                // echo("<br>$path");
                $chaine = "Location: http://$host:$port$path/login";
                // echo("<br>$chaine");
                header($chaine);
                exit();  
    }



}

?>

