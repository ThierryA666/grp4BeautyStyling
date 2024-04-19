<?php
namespace beautyStyling\webapp;
require_once '../../vendor/autoload.php';
use beautyStyling\dao\DaoBeauty;

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (session_status() != PHP_SESSION_ACTIVE) session_start();
$email_salon= '';
$pw ='';
$salon='';

if (isset($_POST['emailSalon'])) $email_salon = trim(htmlspecialchars($_POST['emailSalon']));
if (isset($_POST['pwSalon']))  $pw  = trim(htmlspecialchars($_POST['pwSalon']));
// var_dump($_POST);
$_SESSION['emailSalon'] = $email_salon;
$_SESSION['pwSalon']  = $pw;
// var_dump($_SESSION);


$dao = new DaoBeauty();
$salon = $dao->getSalonByEmail($email_salon);
// var_dump($salon) ;
// exit;
if($salon === null || empty((array)$salon)){
    $message = "L'identifiant de l'utilisateur(email) n'a pas été trouvé.";
} elseif($salon && $pw==$salon->getPw_salon()){
    $host = $_SERVER['SERVER_NAME'];
    $port = $_SERVER['SERVER_PORT'];
    $uri  = $_SERVER['REQUEST_URI'];
    $taburi = explode('/',$uri);
    // print_r($taburi);
    $path ='';
    for ($i=1; $i < count($taburi)-1; $i++) {
        $path .= '/' . $taburi[$i];
    }
    // echo("<br>$path");
    $id_salon = $salon->getId_salon();
    $chaine = "Location: http://$host:$port$path/salon_gestionnaire.php?id_salon=$id_salon";
    // echo("<br>$chaine");
    // header('Location: http://localhost:3000/4-php/ATD/exo/metisBases/question3-loginsuite.php');
    header($chaine);
    exit();  
} else $message = 'ID utilisateur et PW non valides.';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in pour prestataires - Beauty styling </title>
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Linden+Hill&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg" style="background-color:#A0ECBA;">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php" style="font-family: 'DM Serif Display', serif; color: #FF5B76;">
                    <img src="/assets/img/logo_beautystyling.jpg" alt="Logo_Beauty Styling" width="100"  class="d-inline-block align-text-center">
                    Beauty styling
                </a>  
              
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php" style="font-family: 'DM Serif Display', serif">Accueil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="salon_top.php" style="font-family: 'DM Serif Display', serif;">Inscrire mon salon</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="#" style="font-family: 'DM Serif Display', serif;">Se connecter (Compte salon)</a>
                  </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>

    <main>
      <div>
        <p class="fs-5 text-dangert text-center"><?=$message?></p>
        <p class="fs-5 text-center"><a href="salon_login.php">retour à la page log-in</a></p>
      </div>
    </main>

    <!-- footer -->
    <div class="container-fluid sticky-md-bottom" id="footerDiv">
        <footer class="d-md-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" style="background-color: #A0ECBA;">
          <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
              <img src="/assets/img/logo_beautystyling.jpg" width="80">
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
          </div>
          <div class="col-md-4 d-md-flex">
            <a href="#" id="footerlink" class="text-reset" style="font-family: 'DM Serif Display', serif;">Nous contacter</a>  
          </div>
          <ul class="nav col-md-4 justify-content-end list-unstyled d-md-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="/assets/img/logo-white.png" class="bi" width="24" height="24" alt="logo-x"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="/assets/img/Instagram_Glyph_Gradient.png"  class="bi" width="24" height="24" alt="logo-instagram"></a></li>
            <li class="mx-3"><a class="text-body-secondary" href="#"><img src="/assets/img/icons8-facebook.png"  class="bi" width="30" height="30" alt="logo-facebook"></a></li>
          </ul>
        </footer>
      </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
