<?php

namespace beautyStyling\webapp;
use PDO;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\dao\Database;
use beautyStyling\dao\Requettes;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;
use beautyStyling\view\vhistoriquedesrendezvous;

include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\View\vhistoriquedesrendezvous.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\DaoCalendrier.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\Database.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Etat.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Reservation.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\Requettes.php';

try {
    // Connexion à la base de données
    $conn = Database::getConnection();

    // Vérifier si une demande POST a été envoyée pour supprimer un rendez-vous
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_rndv'])) {
        $idRendezVous = $_POST['eliminar_rndv'];

        // Supprimer les informations du rendez-vous dans la table ligne_detail
        $daoBeauty = new DaoCalendrier(new Database());
        // Obtenir les détails de la ligne correspondants à l'ID du rendez-vous
        $ligneDetailsArray = $daoBeauty->getLigneDetailsByRndv($idRendezVous);
        // Vérifier si les détails de la ligne ont été trouvés
        if (!empty($ligneDetailsArray)) {
            // Obtenir le premier élément du tableau, en supposant qu'il n'y ait qu'un seul élément.
            $ligneDetails = $ligneDetailsArray[0];
            // Si les détails ont été trouvés, appeler la fonction deleteLigneDetails() avec les détails de la ligne
            $response = $daoBeauty->deleteLigneDetails($ligneDetails);
            if ($response) {
                // Si la suppression dans la table ligne_detail réussit, procéder à la suppression du rendez-vous dans la table reservation
                $stmt = $conn->prepare("DELETE FROM reservation WHERE id_rndv = :id_rndv");
                $stmt->bindParam(':id_rndv', $idRendezVous);
                $stmt->execute();
            } else {
                // Si une erreur se produit lors de la suppression dans la table ligne_detail, afficher un message d'erreur
                echo "Erreur lors de la suppression des informations dans la table ligne_detail";
            }
        } else {
            // Si les détails de la ligne ne sont pas trouvés, afficher un message d'erreur
            echo "Détails de la ligne non trouvés pour l'ID du rendez-vous";
        }

    }

    // Vérifier si une demande POST a été envoyée pour supprimer un rendez-vous
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_rndv'])) {
        $idRendezVous = $_POST['eliminar_rndv'];

        // Supprimer le rendez-vous de la base de données
        $stmt = $conn->prepare("DELETE FROM reservation WHERE id_rndv = :id_rndv");
        $stmt->bindParam(':id_rndv', $idRendezVous);
        $stmt->execute();

        echo "Le rendez-vous a été supprimé correctement";
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

        echo "Les détails ont été actualisé correctement";
    }

    // Requête SQL pour obtenir tous les rendez-vous avec les informations de l'état correspondant
    $sql = "SELECT r.id_rndv, r.h_rndv, r.d_rndv, r.nom_rndv, r.detail_rndv, e.id_etat, e.libel_etat, r.id_client, r.id_salon 
        FROM reservation r 
        JOIN etat e ON r.id_etat = e.id_etat";
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
    echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["libel_etat"] . "</td>"; // Mostrar el estado del evento
    echo "<td style='padding: 8px; border: 1px solid #dddddd;'>" . $row["id_salon"] . "</td>";
    echo "<td style='padding: 8px; border: 1px solid #dddddd;'><button style='background: green; border: none; cursor: pointer;' onclick='editarDetalle(" . $row["id_rndv"] . ")'><i class='bi bi-pencil' style='color:white;'></i></button></td>";
    echo "<td style='padding: 8px; border: 1px solid #dddddd;'><form method='post'><input type='hidden' name='eliminar_rndv' value='" . $row["id_rndv"] . "'><button type='submit' style='background: red; border: none; cursor: pointer;'><i class='bi bi-x' style='color:white;'></i></button></form></td>";
    echo "</tr>";
    }
    echo "</table>";
    } else {
    echo "Vous n'avez aucun rendez-vous à venir. Vous pouvez prendre un rendez-vous";
    }

} catch (PDOException $e) {
    echo "Erreur de Connexion: " . $e->getMessage();
}
?>

<script>
    function editarDetalle(idRendezVous) {
        var nuevoDetalle = prompt("Saisie le nouveau message : ");
        if (nuevoDetalle !== null && nuevoDetalle !== "") {
            // Valider que nuevoDetalle contienne uniquement des lettres, des espaces et des caractères spéciaux
            var caracteresPermis = /^[A-Za-z\s,]+$/;
            if (!caracteresPermis.test(nuevoDetalle)) {
                alert("Veuillez saisir uniquement des lettres");
                return; // Sortir de la fonction si le texte contient autre chose que des lettres, des espaces et des caractères spéciaux
            }
            
            // Si nuevoDetalle contient uniquement des lettres, des espaces et des caractères spéciaux, effectuer la requête fetch
            fetch('', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_rndv=' + idRendezVous + '&nuevo_detalle=' + encodeURIComponent(nuevoDetalle),
            })
            .then(response => response.text())
            .then(data => {
                alert("Détail correctement mis à jour"); // Afficher un message de réussite
                location.reload(); // Recharger la page après la mise à jour
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>