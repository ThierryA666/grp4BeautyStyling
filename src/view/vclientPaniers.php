<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Linden+Hill&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../../assets/css/ta-style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.css" integrity="sha512-9rQHiowu3AtR6xVE8Jz+lyV1r2/xXQVW0kI8+O9+PrfWSvoOHDF2SOUIUFAj0mwIAPf1ezTxRlpdngvsZeC4Rw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../../assets/img/logo-beautystyling.jpg" rel="icon">
    <title>clientPaniers</title>
</head>
<body class="bodybg">
    <header class="container-fluid"><!--Admin Nav Bar-->
        <nav class="navbar navbar-expand-lg bgnav" style="background-color:#A0ECBA;">
            <div class="container-fluid">
                <a class="navbar-brand bsfont" href="index.html">
                    <img src="../../assets/img/logo-beautystyling.jpg" alt="Logo Beauty Styling" width="100"  class="d-inline-block align-text-center">
                    Beauty styling
                </a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#" style="font-family: 'DM Serif Display', serif">Accueil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Historique</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../webapp/clientPaniers.php" style="font-family: 'DM Serif Display', serif;">Mes paniers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../webapp/calendrier.php" style="font-family: 'DM Serif Display', serif;">Calendrier</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Se déconnecter</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
      <section id="search"><!--Recherche par salons ou par dates-->
        <div class="container bgbs col-md-11 mx-auto">
          <div class="row my-1 justify-content-between d-block">
            <form id="formSearch" name="search" action="../webapp/clientPaniers.php">
              <div class="d-inline">
                <h1 class="h4 text-dark text-start mx-auto">Mes réservations</h1>
                <label for="salons" class="mx-1">Sélectionnez un salon et/ou 2 dates:</label>
                <select id="salons" name="salons" class="mx-1">
                  <option value="showAll">--**Montrez tous les salons**--</option>
                  <?php foreach ($clientSalons as $key => $salon) { ?>
                  <option id="salon<?=$key?>" value="salon<?=$key?>" <?=(isset($salonSelected) && $salonSelected === $salon) ? 'selected' : ''?>><?=$salon->getNom_salon()?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="d-inline">
                  <label for="dateAfter" class="mx-1">Après le :</label>
                  <input type="date" id="dateAfter" name="dateAfter" class="rounded-2">
                </div>
              <div class="d-inline">
                  <label for="dateBefore" class="mx-1">Avant le :</label>
                  <input type="date" id="dateBefore" name="dateBefore" min="1" max="5" class="mx-1 rounded-2">
              <div class="d-inline">
      				    <button id="search" name="search" value="search" class="btn bsbtn1 btn-outline-primary" type="submit" formmethod="post" formaction="../webapp/clientPaniers.php"><i class="bi bi-search"></i>&nbsp;&nbsp;Trouvez moi</button>
              </div>
            </form>
          </div>
        </section>
        <section id="clientPaniers"><!--On montre les paniers du clients-->
          <div class="input container col-md-11 mx-auto rounded-2 p-3" id="input">
            <div class="col-md-10 mx-auto rounded-2 bgbs">
              <form id="formPaniers" class=" mx-auto p-3" name="Panier" method="post" action="./clientPaniers.php">
                <div id="title" class="grid-container bandeau boldfonts align-items-center p-3 col-sm">
                  <div class="grid-item" ><span class="p-1">Nom:</span></div>
                  <div class="grid-item"><span class="p-1">Salon:</span></div>
                  <div class="grid-item"><span class="p-1">RDV le :</span></div>
                  <div class="grid-item"><span class="p-1">à :</span></div>
                  <div class="grid-item"><span class="p-1"></span></div>
                  <div class="grid-item"><span class="p-1"></span></div>
                </div>
                <?php foreach ($rndvs as $key => $rndv) { ?>
                <div id="detail<?=$key?>" class="grid-container bg-light border border-primary justify-content-between align-items-center border p-3 col-sm rounded-2">
                  <div class="grid-item"><span class="p-1 fw-bold" ><?=$rndv->getNom_rndv()?></span></div>
                  <div class="grid-item"><span class="p-1"><a href="#" id="popUpSalon" name="popUpSalon<?=$rndv->getId_salon()->getId_salon()?>" value="<?=$rndv->getId_salon()->getId_salon()?>"><?=$rndv->getId_salon()->getNom_salon()?></a></span></div>
                  <div class="grid-item"><span class="p-1"><?=$rndv->getD_rndv()->format('d-m-Y')?></span></div>
                  <div class="grid-item"><span class="p-1"><?=$rndv->getH_rndv()->format('H:i:s')?></span></div>
                  <div class="grid-item transition ease-in-out"><button id="btGoToDetail<?=$key?>" class="bsIconButtonPencil " type="submit" formmethod="post" formaction="../webapp/clientDetailPanier.php" name="detail" value="detail<?=$rndv->getId_rndv()?>"><i class="bi-pencil p-1"></i></button></div>
                  <div class="grid-item"><i class="bi-trash p-1"></i></div>
                </div>
                <?php } ?>
                <div class="align-item-center text-center p-3">  
                  <button id="goToReservation" class="btn bsbtn1 btn-outline-primary" type="submit" formmethod="post" formaction="../webapp/calendrier.php"><i class="bi bi-scissors"></i>&nbsp;&nbsp;Réservations</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>
    <!-- footer -->
    <div class="container-fluid sticky-md-bottom" > 
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top nav_bar bsfont">
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
            <img src="../../assets/img/logo-beautystyling.jpg" width="80">
            <!--<svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>-->
          </a>
          <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
        </div>
        <div class="col-md-4 d-flex align-items-center">
          <a href="#" id="footerlink" class="text-reset bsfont">Nous contacter</a>  
        </div>
        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
          <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../../assets/img/logo-white.png" class="bi" width="24" height="24"></a></li>
          <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../../assets/img/01GradientGlyph/Instagram_Glyph_Gradient.png"  class="bi" width="24" height="24"></a></li>
          <li class="mx-3"><a class="text-body-secondary" href="#"><img src="../../assets/img/icons/icons8-facebook.png"  class="bi" width="30" height="30"></a></li>
        </ul>
      </footer>
    </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script> -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
  <script type="module" src="../../assets/js/ta-clientPaniersPHP.js"></script>
</body>
</html>
