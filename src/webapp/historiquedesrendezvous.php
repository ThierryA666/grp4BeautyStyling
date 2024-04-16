<<<<<<< HEAD
<?php

namespace beautyStyling\webapp;
use PDO;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;
use beautyStyling\view\vhistoriquedesrendezvous;

include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\View\vhistoriquedesrendezvous.php';

$servername = "localhost"; 
$username = "beauty"; 
$password = "codappwd"; 
$database = "BEAUTYSTYLING";

try {
    // Connexion à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si une demande POST a été envoyée pour supprimer un rendez-vous
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_rndv'])) {
        $idRendezVous = $_POST['eliminar_rndv'];

        // Supprimer le rendez-vous de la base de données
        $stmt = $conn->prepare("DELETE FROM reservation WHERE id_rndv = :id_rndv");
        $stmt->bindParam(':id_rndv', $idRendezVous);
        $stmt->execute();

        echo "Cita eliminada correctamente.";
    }

    // Vérifier si une requête POST a été envoyée pour mettre à jour les détails d'un rendez-vous
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_rndv']) && isset($_POST['nuevo_detalle'])) {
        $idRendezVous = $_POST['id_rndv'];
        $nuevoDetalle = $_POST['nuevo_detalle'];

        // Mise à jour des détails dans la base de données
        $stmt = $conn->prepare("UPDATE reservation SET detail_rndv = :nuevo_detalle WHERE id_rndv = :id_rndv");
        $stmt->bindParam(':nuevo_detalle', $nuevoDetalle);
        $stmt->bindParam(':id_rndv', $idRendezVous);
        $stmt->execute();

        echo "Detalle actualizado correctamente.";
    }

    // Requête SQL pour obtenir tous les rendez-vous
    $sql = "SELECT id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon FROM reservation";
    $stmt = $conn->query($sql);

    // Vérifier les résultats
    if ($stmt->rowCount() > 0) {
        // Afficher les données de chaque rendez-vous et les boutons pour supprimer et modifier les détails
        echo "<table style='width:100%; border-collapse: collapse;'>";
        echo "<tr><th style='padding: 8px; border: 1px solid #dddddd;'>Id</th><th style='padding: 8px; border: 1px solid #dddddd;'>Heure</th><th style='padding: 8px; border: 1px solid #dddddd;'>Date</th><th style='padding: 8px; border: 1px solid #dddddd;'>Nom</th><th style='padding: 8px; border: 1px solid #dddddd;'>Détails</th><th style='padding: 8px; border: 1px solid #dddddd;'>État</th><th style='padding: 8px; border: 1px solid #dddddd;'>Salon</th><th style='padding: 8px; border: 1px solid #dddddd;'>Modifier</th><th style='padding: 8px; border: 1px solid #dddddd;'>Supprimer</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["id_rndv"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["h_rndv"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["d_rndv"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["nom_rndv"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["detail_rndv"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["id_etat"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["id_salon"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'><button style='background: green; border: none; cursor: pointer;' onclick='editarDetalle(" . $row["id_rndv"] . ")'><i class='bi bi-pencil' style='color:white;'></i></button></td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'><form method='post'><input type='hidden' name='eliminar_rndv' value='" . $row["id_rndv"] . "'><button type='submit' style='background: red; border: none; cursor: pointer;'><i class='bi bi-x' style='color:white;'></i></button></form></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 résultats";
    }
} catch (PDOException $e) {
    echo "Erreur de Connexion: " . $e->getMessage();
}
?>

<script>
    function editarDetalle(idRendezVous) {
        var nuevoDetalle = prompt("Saisie la nouveau message : ");
        if (nuevoDetalle !== null && nuevoDetalle !== "") {
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_rndv=' + idRendezVous + '&nuevo_detalle=' + encodeURIComponent(nuevoDetalle),
            })
            .then(response => response.text())
            .then(data => {
                alert("Détail correctement mis à jour"); // on affiche un message de réussite
                location.reload(); // Recharger la page après la mise à jour
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>
=======
<?php

namespace beautyStyling\webapp;
use PDO;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\dao\Database;
use beautyStyling\dao\Requetes;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;

include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\View\vhistoriquedesrendezvous.php';

$servername = "localhost"; 
$username = "beauty"; 
$password = "codappwd"; 
$database = "BEAUTYSTYLING";

// try {
//     // Crear conexión PDO
//     $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
//     // Establecer el modo de error PDO en excepción
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//     // Consulta SQL para obtener todos los usuarios
//     $sql = "SELECT id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon FROM reservation";
//     $stmt = $conn->query($sql);

//     // Verificar si hay resultados
//     if ($stmt->rowCount() > 0) {
//         // Mostrar datos de cada fila
//         echo "<table>";
//         echo "<tr><th style='padding: 8px; border: 1px solid #dddddd;'>Id</th><th style='padding: 8px; border: 1px solid #dddddd;'>Heure</th><th style='padding: 8px; border: 1px solid #dddddd;'>Date</th><th style='padding: 8px; border: 1px solid #dddddd;'>Nom</th><th style='padding: 8px; border: 1px solid #dddddd;'>Détails</th><th style='padding: 8px; border: 1px solid #dddddd;'>État</th><th style='padding: 8px; border: 1px solid #dddddd;'>Salon</th><th style='padding: 8px; border: 1px solid #dddddd;'>Annuler</th></tr>";
//         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
//             echo "<tr>";
//             echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["id_rndv"] . "</td>";
//             echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["h_rndv"] . "</td>";
//             echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["d_rndv"] . "</td>";
//             echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["nom_rndv"] . "</td>";
//             echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["detail_rndv"] . "</td>";
//             echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["id_etat"] . "</td>";
//             echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["id_salon"] . "</td>";
//             echo "<td><form method='post' action='eliminar_cita.php'>";
//             echo "<input type='hidden' name='rndv_id' value='" . $row["id_rndv"] . "'>";
//             echo "<button type='submit' style='background: red; border: none; cursor: pointer;'><i class='bi bi-x' style='color:white;'></i></button>";
//             echo "</form></td>";
//             echo "</tr>";
//         }
//         echo "</table>";
//     } else {
//         echo "0 résultats";
//     }

//     // Cerrar la conexión PDO
//     $pdo = null;
// } catch (PDOException $e) {
//     echo "Erreur de connection: " . $e->getMessage();
// }

try {
    // Créer une connection PDO
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Définir le mode d'erreur PDO en cas d'exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérifier si un identifiant de rendez-vous a été envoyé pour suppression
    if(isset($_POST["rndv_id"])) {
        // Obtenir l'ID du rendez-vous envoyé
        $rndv_id = $_POST["rndv_id"];

        // Requête SQL pour supprimer un rendez-vous avec l'ID fourni
        $sql = "DELETE FROM reservation WHERE id_rndv = :rndv_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':rndv_id', $rndv_id, PDO::PARAM_INT);
        $stmt->execute();

        echo "Cita eliminada correctamente.";
    }

    // Requête SQL pour obtenir toutes les rendez-vous
    $sql = "SELECT id_rndv, h_rndv, d_rndv, nom_rndv, detail_rndv, id_etat, id_client, id_salon FROM reservation";
    $stmt = $conn->query($sql);

    // Vérifier les résultats (il y a de résultats ou non)
    if ($stmt->rowCount() > 0) {
        // Afficher les données pour chaque ligne
        echo "<table style='width:100%; border-collapse: collapse;'>";
        echo "<tr><th style='padding: 8px; border: 1px solid #dddddd;'>Id</th><th style='padding: 8px; border: 1px solid #dddddd;'>Heure</th><th style='padding: 8px; border: 1px solid #dddddd;'>Date</th><th style='padding: 8px; border: 1px solid #dddddd;'>Nom</th><th style='padding: 8px; border: 1px solid #dddddd;'>Détails</th><th style='padding: 8px; border: 1px solid #dddddd;'>État</th><th style='padding: 8px; border: 1px solid #dddddd;'>Salon</th><th style='padding: 8px; border: 1px solid #dddddd;'>Supprimer</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["id_rndv"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["h_rndv"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["d_rndv"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["nom_rndv"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["detail_rndv"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["id_etat"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["id_salon"] . "</td>";
            echo "<td style='padding: 8px; border: 1px solid #dddddd;'><form method='post'>";
            echo "<input type='hidden' name='rndv_id' value='" . $row["id_rndv"] . "'>";
            echo "<button type='submit' style='background: red; border: none; cursor: pointer;'><i class='bi bi-x' style='color:white;'></i></button>";
            echo "</form></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "0 résultats";
    }

    // Fermer la connection PDO
    $pdo = null;
} catch (PDOException $e) {
    echo "Erreur de connection: " . $e->getMessage();
}
?>
>>>>>>> a6980d88292d460c429dea4d66edcf90a6e13bb2
