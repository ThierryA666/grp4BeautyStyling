<?php
namespace beautyStyling\webapp;
use beautyStyling\metier\Salon;
use beautyStyling\dao\DaoBeauty;
use beautyStyling\dao\DaoException;
use DateTime;
use beautyStyling\webapp\MyException;
use beautyStyling\webapp\MyExceptionCase;

require_once '../../vendor/autoload.php';

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






include '../view/vsalon_application.php';