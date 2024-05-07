<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Linden+Hill&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../../assets/css/ta-style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../../assets/img/logo-beautystyling.jpg" rel="icon">
    <title>clientDetailPanier</title>
</head>
<body class="bodybg" style="background: url('../../assets/img/photos-salon/<?=$reservationDetail->getIdRDV()->getId_salon()->getPhoto_salon()?>') no-repeat center fixed;background-size: cover;">
    <header class="container-fluid"><!--Client Nav Bar Takako + group-->
        <nav class="navbar navbar-expand-lg bgnav">
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
      <section><!--Dialogue panier sauvegarde/supprimer-->
        <div class="container mx-auto grow">
          <div class="my-3 col-md-11 mx-auto">
            <form id="actionPanier" name="actionPanier" method="post" class="d-inline" action="../webapp/clientDetailPanier.php">
              <div class="d-inline-flex">
                <div>
                  <h1 id="titleDetailPanier" class="h4 text-dark text-center d-inline mx-auto">Détail de ma réservation <?=$reservationDetail->getIdRDV()->getNom_rndv()?>, chez <a href="#"><?=$reservationDetail->getIdRDV()->getId_salon()->getNom_salon()?></a></h1>
                </div>
                <div>
                  <button id="suppReservation" name="suppReservation" value="<?=$reservationDetail->getIdRDV()->getId_rndv()?>" class="d-inline-flex bsbtn2 btn mx-5 rounded-2"><i class="bi bi-trash-fill"></i>&nbsp;Supprimer la réservation</button>
                </div>
                <div>
                  <button id="backToListe" type="submit" formmethod="post" formaction="../webapp/clientPaniers.php" class="d-inline-flex bsbtn2 btn mx-5 rounded-2"><i class="bi bi-view-list"></i>&nbsp;Retour à la liste</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
      <section><!--Detail du panier-->
        <div class="container-fluid input col-md-11 mx-auto rounded-2 p-3" id="input">
          <div class="p-2 col-md-11 bgbs mx-auto rounded-2">
          <?php foreach ($reservationDetails as $key => $reservationDetail) {?>
            <form id="formDetailPanier<?=$reservationDetail->getIdRDV()->getId_rndv()?>" class="p-3" name="detailPanier" method="post" action="#">
              <div id="det" class="grid-container justify-content-between p-3 col-sm border bg-light border-primary rounded-2 m-1">
                <div class="grid-item col-form-label col-form-label-sm">
                  Prestation:<br><span name="prestation" class="p-1 fw-bold"><?=$reservationDetail->getIdPresta()->getNomPresta()?></span>
                </div>
                <div class="grid-item col-form-label col-form-label-sm">
                  Prix:<br><span name="prix" class="p-1"><?=$reservationDetail->getIdPresta()->getPrixIndPrestaEuro()?>€</span>
                </div>
                <div class="grid-item col-form-label col-form-label-sm">
                  Quantité:</label>
                    <input type="number" size="2" name="qte" value="<?=$reservationDetail->getQte()?>" min="1" class="rounded-2 text-center">
                </div>
                <div class="grid-item col-form-label col-form-label-sm">
                  Date-heure:</label><br><span name="rdv" class="p-1"><?=$reservationDetail->getIdRDV()->getD_rndv()->format('d-m-Y') . ' ' . $reservationDetail->getIdRDV()->getH_rndv()->format('H:i:s')?></span>
                </div>
                <div class="grid-item col-form-label col-form-label-sm">
                  Option:</label><br><span name="option" class="p-1 text-primary"><?=$reservationDetail->getIdEmploye()->getNomEmploye()?></span>
                </div>
                <div class="grid-item col-form-label col-form-label-sm">
                  Total:</label><br><span name="total" class="p-1"><?=$reservationDetail->getQte() * $reservationDetail->getIdPresta()->getPrixIndPrestaEuro()?>€</span>
                </div>
                <div class="grid-item col-form-label col-form-label-sm">
                  Modifier la ligne</label><br>
                    <button name="modifLigne" class="bsIconButtonPencil " type="submit" value="<?=$reservationDetail->getnumligne()?>"><i id="p17" class="bi bi-pencil p-1 col-sm slide-up"></i></button>
                    <input type="hidden" name="idRndv" value="<?=$reservationDetail->getIdRDV()->getId_rndv()?>">
                    <input type="hidden" name="idPresta" value="<?=$reservationDetail->getIdPresta()->getIdPresta()?>">
                    <input type="hidden" name="numLigne" value="<?=$reservationDetail->getnumligne()?>">
                </div>
                <div class="grid-item col-form-label col-form-label-sm">
                  Supprimer la ligne</label><br><i class="bi-trash p-1 col-sm"></i>
                </div>
              </div>
            </form>
              <?php }?>
              <div class="boldfonts d-flex justify-content-end text-decoration-underline">
                <p class="text-start">Total du panier: <?=$totalPanier?>€</p>
              </div>
              <div class="d-flex justify-content-between col-md-12">
                <form>
                  <button type="submit" id="buttonAdd" class="bsbtn1 btn mx-auto rounded-2"><i class="bi bi-bag-plus"></i>&nbsp;Ajouter une ligne</button>
                </form>  
                <form>
                  <button type="submit" id="buttonCal" formmethod="get" formaction="../webapp/calendrier.php" class="bsbtn1 btn mx-auto rounded-2"><i class="bi bi-scissors"></i>&nbsp;Réservation</button>
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
  <script type="module" src="../../assets/js/ta-clientPaniersPHP.js"></script>
</body>
</html>