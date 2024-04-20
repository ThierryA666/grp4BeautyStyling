<?php
namespace beautyStyling\webapp;
require_once '../../vendor/autoload.php';
use beautyStyling\dao\DaoBeauty;
use beautyStyling\metier\Salon;
use beautyStyling\dao\DaoException;

$keyWord="";

if (isset($_POST['keyWord']) && !empty($_POST['keyWord'])) {
    $keyWord = htmlspecialchars(trim($_POST['keyWord']));
    $dao = new DaoBeauty();
    $salons = $dao->searchSalon($keyWord);
} else {
    // si c'est vide on affiche pas
    $salons = [];
}

if(isset($_GET['id_salon'])) {
    $id_salon = $_GET['id_salon'];
    $dao = new DaoBeauty();
    $salon = $dao->delSalonByID($id_salon);
}
// <tr>
// <th scope="row"><input class="form-check-input" type="checkbox" value="select"></th>
// <td id="nameSalon">Slaon A</td>
// <td id="nameRep">Durand Franck</td>
// <td id="telSalon">0600110011</td>
// <td id="emailSalon">name1@mail.com</td>
// <td> <i class="bi bi-pencil" style="color:blue;"></i> / <i class="bi bi-x" style="color:red;"></i></td>
// </tr>

include '../view/vgestion-comptes-prestataires.php';