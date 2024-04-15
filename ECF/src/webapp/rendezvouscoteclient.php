<?php

namespace beautyStyling\webapp;
use PDO;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\dao\DaoException;
use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;

include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\View\vrendezvouscoteclient.php';

$servername = "localhost"; 
$username = "beauty"; 
$password = "codappwd"; 
$database = "BEAUTYSTYLING";

// Créer une connection à l'aide de PDO
// try {
//     $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
//     // Définir le mode d'erreur PDO sur exceptions
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
//     // Préparer la requête pour insérer les données du formulaire dans la base de données
//     $stmt = $conn->prepare("INSERT INTO RESERVATION (h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon) VALUES (:h_rndv, :d_rndv, :nom_rndv, :detail_rndv, :id_etat, :id_client, :id_salon)");
    
//     // Bind de paramètres
//     $stmt->bindParam(':d_rndv', $_POST['date']);
//     $stmt->bindParam(':h_rndv', $_POST['heure']);
//     // $stmt->bindParam(':servicio', $_POST['prestations']);
//     $stmt->bindParam(':nom_rndv', $_POST['nom']);
//     $stmt->bindParam(':detail_rndv', $_POST['details']);
//     $stmt->bindParam(':id_salon', $_POST['salon']);
//     $stmt->bindParam(':id_etat', $_POST['salon']);
//     $stmt->bindParam(':id_client', $_POST['salon']);
    
//     // Exécuter la requête
//     $stmt->execute();
    
//     echo "Rendez-vous ajouté correctement";
// } catch(PDOException $e) {
//     echo "Erreur lors de l'ajout du rendez-vous: " . $e->getMessage();
// }

// // Fermer la connection
// $conn = null;

function setDate($date) {
    // Dividir la fecha en año, mes y día
    $dateComponents = explode('-', $date);
    $year = $dateComponents[0];
    $month = $dateComponents[1];
    $day = $dateComponents[2];

    // Generar el código HTML para mostrar la fecha en el calendario
    echo '<input type="hidden" name="date" value="' . $date . '">';
    echo '<div class="selected-date">';
    echo '<span class="year">' . $year . '</span>';
    echo '<span class="month">' . $month . '</span>';
    echo '<span class="day">' . $day . '</span>';
    echo '</div>';
}

// Verificar si se ha seleccionado una fecha
// Verificar si se ha seleccionado una fecha
if(isset($_GET['date'])) {
    $date = $_GET['date'];
} else {
    $date = ''; // Establecer un valor por defecto si la fecha no está definida
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Aquí va el código para manejar el envío del formulario
    try {
        // Conectar a la base de datos y procesar los datos del formulario
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la inserción de datos en la tabla RESERVATION
        $stmt = $conn->prepare("INSERT INTO RESERVATION (h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon) VALUES (:h_rndv, :d_rndv, :nom_rndv, :detail_rndv, :id_etat, :id_client, :id_salon)");

        // Enlazar parámetros
        $stmt->bindParam(':d_rndv', $_POST['date']);
        $stmt->bindParam(':h_rndv', $_POST['heure']);
        $stmt->bindParam(':nom_rndv', $_POST['nom']);
        $stmt->bindParam(':detail_rndv', $_POST['details']);

        // Establecer valores predeterminados para id_etat y id_client
        $id_etat = 1;
        $id_client = 1;
        $stmt->bindParam(':id_etat', $id_etat);
        $stmt->bindParam(':id_client', $id_client);

        // Preparar la consulta para obtener el id_salon
        $stmt_select = $conn->prepare("SELECT id_salon FROM salon WHERE nom_salon = :nom_salon");
        $stmt_select->bindParam(':nom_salon', $_POST['salon']);
        $stmt_select->execute();
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
        $id_salon = $row['id_salon'];

        // Preparar la inserción de datos en la tabla RESERVATION
        $stmt_insert = $conn->prepare("INSERT INTO RESERVATION (h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon) VALUES (:h_rndv, :d_rndv, :nom_rndv, :detail_rndv, :id_etat, :id_client, :id_salon)");
        $stmt_insert->bindParam(':d_rndv', $_POST['date']);
        $stmt_insert->bindParam(':h_rndv', $_POST['heure']);
        $stmt_insert->bindParam(':nom_rndv', $_POST['nom']);
        $stmt_insert->bindParam(':detail_rndv', $_POST['details']);
        $stmt_insert->bindParam(':id_etat', $id_etat);
        $stmt_insert->bindParam(':id_client', $id_client);
        $stmt_insert->bindParam(':id_salon', $id_salon);

        // Ejecutar la inserción
        $stmt_insert->execute();

        echo "Rendez-vous ajouté correctement";
    } catch(PDOException $e) {
        echo "Erreur lors de la connexion à la base de données: " . $e->getMessage();
    }
    // Cerrar la conexión a la base de datos
    $conn = null;
} else {
    // Si no se ha enviado el formulario, no se ejecuta ningún código adicional
    // Puedes dejar esta sección vacía o mostrar el formulario aquí si lo deseas
}

?>