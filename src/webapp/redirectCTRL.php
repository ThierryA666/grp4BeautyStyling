<<<<<<< HEAD
<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

error_reporting(E_ALL);

session_start();
//var_dump($_SESSION);

$data = json_decode(file_get_contents("php://input"), true);
$url = $_SERVER['HTTP_HOST'];
//var_dump($data);
if (isset($_SESSION['eventName'])) {
    switch ($_SESSION['eventName']) {
        case 'modifPresta' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminPrestation.php';
            break;
        case 'suppPresta' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminListePrestations.php';
            break;
        case 'createPresta' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminListePrestations.php';
            break;
        case 'deletePresta' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminPrestation.php';
            break;
        case 'buttonGoToCreate' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminPrestation.php';
            break;
        case 'goBackToList' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminListePrestations.php';
            break;
        default :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminListePrestations.php';
            break;
    }
}
header("Location: http://$url",true);
?>
=======
<?php
declare(strict_types=1);

namespace beautyStyling\webapp;

error_reporting(E_ALL);

session_start();
//var_dump($_SESSION);

$data = json_decode(file_get_contents("php://input"), true);
$url = $_SERVER['HTTP_HOST'];
//var_dump($data);
if (isset($_SESSION['eventName'])) {
    switch ($_SESSION['eventName']) {
        case 'modifPresta' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminPrestation.php';
            break;
        case 'suppPresta' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminListePrestations.php';
            break;
        case 'createPresta' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminListePrestations.php';
            break;
        case 'deletePresta' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminPrestation.php';
            break;
        case 'buttonGoToCreate' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminPrestation.php';
            break;
        case 'goBackToList' :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminListePrestations.php';
            break;
        default :
            $path = '/src/webapp/';
            $url = $url . $path . 'adminListePrestations.php';
            break;
    }
}
header("Location: http://$url",true);
?>
>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
