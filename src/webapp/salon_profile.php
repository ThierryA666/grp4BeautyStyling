<<<<<<< HEAD
<?php
declare(strict_types=1);
namespace beautyStyling\webapp;
require_once '../../vendor/autoload.php';
use beautyStyling\metier\Salon;
use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\DaoException;

$message = ' ';
echo 'coucou';
var_dump($_GET);


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
    $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
    if ($id_salon === null) {
        $message = "Ce salon est inexistant.";
        } else {
            $dao = new DaoBeauty();
            $salon = $dao->getSalonByID($id_salon);
            }
    }
    

include '../view/vsalon_profile.php';


=======
<?php
declare(strict_types=1);
namespace beautyStyling\webapp;
require_once '../../vendor/autoload.php';
use beautyStyling\metier\Salon;
use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\DaoException;

$message = ' ';
echo 'coucou';
var_dump($_GET);


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
    $id_salon = isset($_GET['id_salon']) ? intval($_GET['id_salon']) : null;
    if ($id_salon === null) {
        $message = "Ce salon est inexistant.";
        } else {
            $dao = new DaoBeauty();
            $salon = $dao->getSalonByID($id_salon);
            }
    }
    

include '../view/vsalon_profile.php';


>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
