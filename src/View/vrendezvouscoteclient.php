<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Linden+Hill&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Rendez-vous côte client</title>
    <style>
      .footer {
        position: fixed;
        bottom: 0;
        width: 100%;
      }

      body {
        margin-bottom: 80px;
      }
        a:hover{
          color:#FF5B76 !important;
        }
  
        #footerlink {
          text-decoration:none !important;
  
        }
  
        #footerlink:visited {
          color:black;
        }
  
        button:hover{
          background-color: #A0ECBA !important;
          color:#FF5B76 !important;
        }
        span{
          color: red;
        }
      </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg" style="background-color:#A0ECBA;"> <!-- On utilise le code de Takako pour le navbar-->
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html" style="font-family: 'DM Serif Display', serif; color: #FF5B76;">
                    <img src="..\..\assets\img\logo_beautystyling.jpg" alt="Logo_Beauty Styling" width="100"  class="d-inline-block align-text-center">
                    Beauty styling
                </a>  
              
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarNav">
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active ms-5" aria-current="page" href="calendrier.php">Prendre rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link ms-5" aria-current="page" href="historiquedesrendezvous.php">Historique des rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link ms-5" aria-current="page" href="#">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link link ms-5" href="#">Mon compte</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link link ms-5" href="#">Panier</a>
                        </li>
                  
                </ul>
              </div>
            </div>
        </nav>
    </header>
    <main>
        <form id="form" class="container align-items-center mt-5" action="rendezvouscoteclient.php" method="post">
            <div class="mb-3">
                <label for="date" class="form-label">Date du rendez-vous</label>
                <!-- Champ caché pour envoyer la date sélectionnée -->
                <input type="hidden" name="date" value="<?php echo isset($_GET['date']) ? htmlspecialchars($_GET['date']) : ''; ?>">
                <!-- Afficher la date sélectionnée -->
                <div><?php echo isset($_GET['date']) ? htmlspecialchars($_GET['date']) : ''; ?></div>
               
            </div>
            <div class="mb-3">
                <label for="heure" class="form-label">Heure du rendez-vous</label>
                <select id="heure" name="heure" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                    <option selected value="10:00 h">10:00 h</option>
                    <option value="10:30 h">10:30 h</option>
                    <option value="11:00 h">11:00 h</option>
                    <option value="11:30 h">11:30 h</option>
                    <option value="13:30 h">13:30 h</option>
                    <option value="14:00 h">14:00 h</option>
                    <option value="14:30 h">14:30 h</option>
                    <option value="15:00 h">15:00 h</option>
                </select> 
            </div>
            <div class="mb-3">
                <label for="salons" class="form-label">Salon</label>
                <input type="hidden" name="id_salon" id="id_salon" value="">

                <select id="salons" name="salon" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <?php
                    // Établir la connexion à la base de données
                    $servername = "localhost"; 
                    $username = "beauty"; 
                    $password = "codappwd"; 
                    $database = "BEAUTYSTYLING";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                        // Consulter les noms et les IDs des salons à partir de la base de données
                        $stmt = $conn->prepare("SELECT id_salon, nom_salon FROM salon");
                        $stmt->execute();
                        $salons = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        // Générer des options du SELECT
                        foreach ($salons as $salon) {
                            echo "<option value=\"" . $salon['id_salon'] . "\">" . $salon['nom_salon'] . "</option>";
                        }
                    } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="prestations" class="form-label">Prestations</label>
                <select id="prestations" name="prestation" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <?php
                    // Établir la connexion à la base de données
                    $servername = "localhost"; 
                    $username = "beauty"; 
                    $password = "codappwd"; 
                    $database = "BEAUTYSTYLING";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                      
                      // Consulter les noms des prestations à partir de la base de données
                      $stmt = $conn->prepare("SELECT id_presta, nom_presta FROM prestation");
                      $stmt->execute();
                      $prestations = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      
                      // Générer des options du SELECT
                      foreach ($prestations as $prestation) {
                          echo "<option value=\"" . $prestation['id_presta'] . "\">" . $prestation['nom_presta'] . "</option>";
                      }
                  } catch(PDOException $e) {
                      echo "Error: " . $e->getMessage();
                  }
                  ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom du rendez-vous</label>
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom du rendez-vous">
            </div> 
            <div class="form-floating">
                <textarea class="form-control" placeholder="Détails" name="details" id="detail" style="height: 100px"></textarea>
                <label for="details">Détails</label>
            </div>        
            <button type='submit' name="submit" value="Submit" id="button" style='background: green; border: none; cursor: pointer;'><i class="bi bi-check2" style="color: white;"></i></button>
            <button type='submit' style='background: red; border: none; cursor: pointer;'>
                <a href="calendrier.php" style="text-decoration: none; color: white;">
                 <i class='bi bi-x'></i>
                </a>
            </button>
        </form>
    </main>
      <div class="container-fluid  fixed-bottom">
        <footer class="footer">
          <div class="container-fluid py-3" style="background-color: #A0ECBA;">
              <div class="row justify-content-between align-items-center">
                  <div class="col-md-4">
                      <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                          <img src="..\..\assets\img\logo_beautystyling.jpg" width="80">
                      </a>
                      <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
                  </div>
                  <div class="col-md-4">
                      <a href="#" id="footerlink" class="text-reset" style="font-family: 'DM Serif Display', serif;">Nous contacter</a>
                  </div>
                  <div class="col-md-4">
                      <ul class="nav justify-content-end list-unstyled d-flex">
                          <li class="ms-3"><a class="text-body-secondary" href="#"><img src="..\..\assets\img\logo-white.png" class="bi" width="24" height="24"></a></li>
                          <li class="ms-3"><a class="text-body-secondary" href="#"><img src="..\..\assets\img\01GradientGlyph\Instagram_Glyph_Gradient.png"  class="bi" width="24" height="24"></a></li>
                          <li class="mx-3"><a class="text-body-secondary" href="#"><img src="..\..\assets\img\icons8-facebook.png"  class="bi" width="30" height="30"></a></li>
                      </ul>
                  </div>
              </div>
          </div>
        </footer> <!-- On utilise le code de Takako pour le footer-->
      </div>
      <!-- <script type="module" src="..\..\assets\javascript\form-rendez-vous-js\form-rendezvous.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>