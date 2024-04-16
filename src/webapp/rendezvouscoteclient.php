<?php

namespace beautyStyling\webapp;
use PDO;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\dao\DaoException;
use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;
use beautyStyling\view\vrendezvouscoteclient;

include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\View\vrendezvouscoteclient.php';

$servername = "localhost"; 
$username = "beauty"; 
$password = "codappwd"; 
$database = "BEAUTYSTYLING";

function setDate($date) {
    // Diviser la date en année, mois et jour
    $dateComponents = explode('-', $date);
    $year = $dateComponents[0];
    $month = $dateComponents[1];
    $day = $dateComponents[2];

    // Générer le code HTML pour afficher la date dans le calendrier
    echo '<input type="hidden" name="date" value="' . $date . '">';
    echo '<div class="selected-date">';
    echo '<span class="year">' . $year . '</span>';
    echo '<span class="month">' . $month . '</span>';
    echo '<span class="day">' . $day . '</span>';
    echo '</div>';
}

// Vérifier si une date a été sélectionnée
if(isset($_GET['date'])) {
    $date = $_GET['date'];
} else {
    $date = ''; // Définir une valeur par défaut si la date n'est pas définie
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Vérifier si le bouton cliqué est le bouton de soumission
    if(isset($_POST['submit']) && $_POST['submit'] === 'Submit') {
        // Connexion à la base de données et traitement des données du formulaire
        try {
            // Conectar a la base de datos y procesar los datos del formulario
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Préparer l'insertion des données dans la table RESERVATION
            $stmt = $conn->prepare("INSERT INTO RESERVATION (h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon) VALUES (:h_rndv, :d_rndv, :nom_rndv, :detail_rndv, :id_etat, :id_client, :id_salon)");

            // Enlazar parámetros
            $stmt->bindParam(':d_rndv', $_POST['date']);
            $stmt->bindParam(':h_rndv', $_POST['heure']);
            $stmt->bindParam(':nom_rndv', $_POST['nom']);
            $stmt->bindParam(':detail_rndv', $_POST['details']);

            // Définir les valeurs par défaut pour id_etat et id_client
            $id_etat = 1;
            $id_client = 1;
            $stmt->bindParam(':id_etat', $id_etat);
            $stmt->bindParam(':id_client', $id_client);

            // Préparer la requête pour obtenir l'id_salon
            $stmt_select = $conn->prepare("SELECT id_salon FROM salon WHERE nom_salon = :nom_salon");
            $stmt_select->bindParam(':nom_salon', $_POST['salon']);
            $stmt_select->execute();
            $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
            $id_salon = $row['id_salon'];

            // Préparer l'insertion des données dans la table RESERVATION
            $stmt_insert = $conn->prepare("INSERT INTO RESERVATION (h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon) VALUES (:h_rndv, :d_rndv, :nom_rndv, :detail_rndv, :id_etat, :id_client, :id_salon)");
            $stmt_insert->bindParam(':d_rndv', $_POST['date']);
            $stmt_insert->bindParam(':h_rndv', $_POST['heure']);
            $stmt_insert->bindParam(':nom_rndv', $_POST['nom']);
            $stmt_insert->bindParam(':detail_rndv', $_POST['details']);
            $stmt_insert->bindParam(':id_etat', $id_etat);
            $stmt_insert->bindParam(':id_client', $id_client);
            $stmt_insert->bindParam(':id_salon', $id_salon);

            // Exécuter l'insertion
            $stmt_insert->execute();

            echo "Rendez-vous ajouté correctement";
        } catch(PDOException $e) {
            echo "Erreur lors de la connexion à la base de données: " . $e->getMessage();
        }
        // Fermer la connexion à la base de données
        $conn = null;
    } else {
        echo "Vous avez cliqué sur le mauvais bouton";
    }
} else {
    // Si le formulaire n'a pas été soumis, aucun code supplémentaire n'est exécuté.
    // on peut laisser cette section vide ou afficher le formulaire ici si on le souhaite
}

?>