<<<<<<< HEAD
<?php

namespace beautyStyling\tests;
use PDO;

require 'C:\\Users\\Maria\\Desktop\\Formation Afpa\\ECF\\vendor\\autoload.php';
use beautyStyling\dao\Database;
use beautyStyling\dao\Requettes;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;

$servername = "localhost"; 
$username = "beauty"; 
$password = "codappwd"; 
$database = "BEAUTYSTYLING";

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establecer el modo de error PDO en excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obtener todos los datos
    $sql = "SELECT id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon FROM reservation";
    $stmt = $conn->query($sql);

    // Verificar si hay resultados
    if ($stmt->rowCount() > 0) {
        // Mostrar datos de cada fila
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $row["id_rndv"] . " - Heure: " . $row["h_rndv"] . " - date: " . $row["d_rndv"] . " - nom: " . $row["nom_rndv"] . "<br>";
        }
    } else {
        echo "0 resultados";
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
=======
<?php

namespace beautyStyling\tests;
use PDO;

require 'C:\\Users\\Maria\\Desktop\\Formation Afpa\\ECF\\vendor\\autoload.php';
use beautyStyling\dao\Database;
use beautyStyling\dao\Requettes;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;

$servername = "localhost"; 
$username = "beauty"; 
$password = "codappwd"; 
$database = "BEAUTYSTYLING";

try {
    // Crear conexión PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establecer el modo de error PDO en excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para obtener todos los datos
    $sql = "SELECT id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon FROM reservation";
    $stmt = $conn->query($sql);

    // Verificar si hay resultados
    if ($stmt->rowCount() > 0) {
        // Mostrar datos de cada fila
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "ID: " . $row["id_rndv"] . " - Heure: " . $row["h_rndv"] . " - date: " . $row["d_rndv"] . " - nom: " . $row["nom_rndv"] . "<br>";
        }
    } else {
        echo "0 resultados";
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
?>