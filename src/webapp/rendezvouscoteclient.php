<<<<<<< HEAD
<?php

namespace beautyStyling\webapp;
use PDO;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\dao\DaoException;
use beautyStyling\dao\Database;
use beautyStyling\dao\Requettes;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;
use beautyStyling\metier\Client;
// use beautyStyling\metier\LigneDetails;
use beautyStyling\view\vrendezvouscoteclient;

include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\View\vrendezvouscoteclient.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\DaoCalendrier.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\Requettes.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\Database.php';
// include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\LigneDetails.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Reservation.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Etat.php';
// include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Client.php';

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
        // Vérifier si les champs obligatoires sont définis et non vides
        if(empty($_POST['nom'])) {
            echo '<span style="color: red;">Le nom du rendez-vous est obligatoire</span>';
        } else if (empty($_POST['date'])) {
            echo '<span style="color: red;">La date est obligatoire, cliquez sur le bouton X pour revenir au calendrier</span>';
        } else if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ\s,]+$/", $_POST['nom'])) { // \s représente les espaces vides
            echo '<span style="color: red;">Le nom du rendez-vous doit contenir uniquement des lettres</span>';
        } else if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ\s,]+$/", $_POST['details'])) {
            echo '<span style="color: red;">Les détails doivent contenir uniquement des lettres</span>';
        } else {
            // Récupérer l'ID de la prestation sélectionnée à partir du formulaire
            $id_prestation = isset($_POST['prestation']) ? $_POST['prestation'] : null;

            // Vérifier si l'ID de la prestation est vide ou null
            if (empty($id_prestation)) {
                echo '<span style="color: red;">Veuillez sélectionner une prestation</span>';
            } else {
            
            // Vérifiez si le champ 'salon' est défini dans $_POST
            if (isset($_POST['salon'])) {
                try {
                    // Connexion à la base de données
                    $conn = Database::getConnection();
                    
                    // Requête SQL pour obtenir l'id_salon correspondant au nom_salon
                    $stmt_salon = $conn->prepare(Requettes::SELECT_SALON_BY_ID);
                    $stmt_salon->bindParam(':id_salon', $_POST['salon']);
                    $stmt_salon->execute();
                    $result_salon = $stmt_salon->fetch(PDO::FETCH_ASSOC);
                    
                    // Vérifiez si la requête a renvoyé un résultat
                    if ($result_salon) {
                        // Récupérez l'id_salon correspondant
                        $id_salon = $result_salon['id_salon'];
                        
                        // pour ajouter la réservation à la base de données
                        $daoCalendrier = new DaoCalendrier($conn);
                        $id_reservation = $daoCalendrier->addReservation(
                            $_POST['date'],
                            $_POST['heure'],
                            $_POST['nom'],
                            $_POST['details'],
                            $id_salon
                        );
                        
                        // Obtenez l'ID de la réservation insérée
                        $id_reservation = $conn->lastInsertId();
                        
                        // Récupérer le dernier numéro de ligne
                        $last_num_ligne = $daoCalendrier->getLastLineNumber($id_reservation);

                        // Incrémenter le dernier numéro de ligne (ou initialiser à 0 si aucun rendez-vous n'existe encore)
                        $num_ligne = ($last_num_ligne !== null) ? $last_num_ligne + 1 : 1;

                        // Récupérer l'ID de la prestation sélectionnée à partir du formulaire
                        $id_prestation = isset($_POST['prestation']) ? $_POST['prestation'] : null;

                        // Vérifier si l'ID de la prestation est vide ou null
                        if (empty($id_prestation)) {
                            echo '<span style="color: red;">Veuillez sélectionner une prestation</span>';
                        } else {
                            // Insérer la nouvelle ligne de détail avec le numéro de ligne incrémenté et l'ID de la prestation
                            $daoCalendrier->insertLigneDetail($id_reservation, $num_ligne, $id_prestation);

                            echo "Rendez-vous ajouté correctement";
                        }
                    } else {
                        // Le nom du salon sélectionné n'a pas été trouvé dans la base de données
                        echo "Le salon sélectionné n'a pas été trouvé dans la base de données.";
                    }
                } catch(PDOException $e) {
                    // Gérez les erreurs de connexion à la base de données
                    echo "Erreur lors de la connexion à la base de données: " . $e->getMessage();
                }
            } else {
                // Le champ 'salon' n'est pas défini dans $_POST
                echo "Le champ 'salon' n'est pas défini dans le formulaire.";
            }
        }
        }
    } else {
        // Message si le bouton soumis n'est pas valide
        echo "Vous avez cliqué sur le mauvais bouton";
    }

    } else {
    // Si le formulaire n'a pas été soumis, aucun code supplémentaire n'est exécuté.
    // on peut laisser cette section vide ou afficher le formulaire ici si on le souhaite
}

=======
<?php

namespace beautyStyling\webapp;
use PDO;
use beautyStyling\dao\DaoCalendrier;
use beautyStyling\dao\DaoException;
use beautyStyling\dao\Database;
use beautyStyling\dao\Requettes;
use beautyStyling\metier\Reservation;
use beautyStyling\metier\Etat;
use beautyStyling\metier\Client;
// use beautyStyling\metier\LigneDetails;
use beautyStyling\view\vrendezvouscoteclient;

include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\View\vrendezvouscoteclient.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\DaoCalendrier.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\Requettes.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\dao\Database.php';
// include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\LigneDetails.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Reservation.php';
include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Etat.php';
// include 'C:\Users\Maria\Desktop\Formation Afpa\ECF\src\metier\Client.php';

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
        // Vérifier si les champs obligatoires sont définis et non vides
        if(empty($_POST['nom'])) {
            echo '<span style="color: red;">Le nom du rendez-vous est obligatoire</span>';
        } else if (empty($_POST['date'])) {
            echo '<span style="color: red;">La date est obligatoire, cliquez sur le bouton X pour revenir au calendrier</span>';
        } else if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ\s,]+$/", $_POST['nom'])) { // \s représente les espaces vides
            echo '<span style="color: red;">Le nom du rendez-vous doit contenir uniquement des lettres</span>';
        } else if (!preg_match("/^[A-Za-zÀ-ÖØ-öø-ÿ\s,]+$/", $_POST['details'])) {
            echo '<span style="color: red;">Les détails doivent contenir uniquement des lettres</span>';
        } else {
            // Récupérer l'ID de la prestation sélectionnée à partir du formulaire
            $id_prestation = isset($_POST['prestation']) ? $_POST['prestation'] : null;

            // Vérifier si l'ID de la prestation est vide ou null
            if (empty($id_prestation)) {
                echo '<span style="color: red;">Veuillez sélectionner une prestation</span>';
            } else {
            
            // Vérifiez si le champ 'salon' est défini dans $_POST
            if (isset($_POST['salon'])) {
                try {
                    // Connexion à la base de données
                    $conn = Database::getConnection();
                    
                    // Requête SQL pour obtenir l'id_salon correspondant au nom_salon
                    $stmt_salon = $conn->prepare(Requettes::SELECT_SALON_BY_ID);
                    $stmt_salon->bindParam(':id_salon', $_POST['salon']);
                    $stmt_salon->execute();
                    $result_salon = $stmt_salon->fetch(PDO::FETCH_ASSOC);
                    
                    // Vérifiez si la requête a renvoyé un résultat
                    if ($result_salon) {
                        // Récupérez l'id_salon correspondant
                        $id_salon = $result_salon['id_salon'];
                        
                        // pour ajouter la réservation à la base de données
                        $daoCalendrier = new DaoCalendrier($conn);
                        $id_reservation = $daoCalendrier->addReservation(
                            $_POST['date'],
                            $_POST['heure'],
                            $_POST['nom'],
                            $_POST['details'],
                            $id_salon
                        );
                        
                        // Obtenez l'ID de la réservation insérée
                        $id_reservation = $conn->lastInsertId();
                        
                        // Récupérer le dernier numéro de ligne
                        $last_num_ligne = $daoCalendrier->getLastLineNumber($id_reservation);

                        // Incrémenter le dernier numéro de ligne (ou initialiser à 0 si aucun rendez-vous n'existe encore)
                        $num_ligne = ($last_num_ligne !== null) ? $last_num_ligne + 1 : 1;

                        // Récupérer l'ID de la prestation sélectionnée à partir du formulaire
                        $id_prestation = isset($_POST['prestation']) ? $_POST['prestation'] : null;

                        // Vérifier si l'ID de la prestation est vide ou null
                        if (empty($id_prestation)) {
                            echo '<span style="color: red;">Veuillez sélectionner une prestation</span>';
                        } else {
                            // Insérer la nouvelle ligne de détail avec le numéro de ligne incrémenté et l'ID de la prestation
                            $daoCalendrier->insertLigneDetail($id_reservation, $num_ligne, $id_prestation);

                            echo "Rendez-vous ajouté correctement";
                        }
                    } else {
                        // Le nom du salon sélectionné n'a pas été trouvé dans la base de données
                        echo "Le salon sélectionné n'a pas été trouvé dans la base de données.";
                    }
                } catch(PDOException $e) {
                    // Gérez les erreurs de connexion à la base de données
                    echo "Erreur lors de la connexion à la base de données: " . $e->getMessage();
                }
            } else {
                // Le champ 'salon' n'est pas défini dans $_POST
                echo "Le champ 'salon' n'est pas défini dans le formulaire.";
            }
        }
        }
    } else {
        // Message si le bouton soumis n'est pas valide
        echo "Vous avez cliqué sur le mauvais bouton";
    }

    } else {
    // Si le formulaire n'a pas été soumis, aucun code supplémentaire n'est exécuté.
    // on peut laisser cette section vide ou afficher le formulaire ici si on le souhaite
}

>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
?>