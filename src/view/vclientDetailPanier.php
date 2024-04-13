<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Linden+Hill&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../assets/css/ta-style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <title>clientDetailPanier</title>
</head>
<body class="bodybg">
    <header class="container-fluid"><!--Client Nav Bar Takako + group-->
        <nav class="navbar navbar-expand-lg bgnav">
            <div class="container-fluid">
                <a class="navbar-brand bsfont" href="index.html">
                    <img src="../assets/img/logo-beautystyling.jpg" alt="Logo Beauty Styling" width="100"  class="d-inline-block align-text-center">
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
                    <a class="nav-link" href="./clientPaniers.html" style="font-family: 'DM Serif Display', serif;">Mes paniers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Calendrier</a>
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
        <div class="container mx-auto">
          <div class="my-3 col-md-11 mx-auto">
            <form id="actionPanier" name="actionPanier" method="get" class="d-inline" action="#"> 
              <h1 id="titleDetailPanier" class="h4 text-dark text-center d-inline mx-auto">Détail de mon panier chez <a href="#">Titeuf</a> modifié le 15/05/2022</h1>
              <button id="bt1" class="d-inline-flex bsbtn2 btn mx-5 rounded-2"><i class="bi bi-trash-fill"></i>&nbsp;Supprimer le panier</button>
            </form>
          </div>
        </div>
      </section>
      <section><!--Detail du panier-->
        <div class="container-fluid input col-md-11 mx-auto rounded-2 p-3" id="input">
          <div class="p-2 col-md-11 bgbs mx-auto rounded-2">
            <form id="formDetailPanier" class="p-3" name="detailPanier" method="get" action="#">
              <div id="det1" class="grid-container justify-content-between p-3 col-sm border bg-light border-primary rounded-2 m-1">
                <div class="grid-item col-form-label col-form-label-sm">
                  <label for="s11">Prestation:</label>
                  <select id="s11" list = "prestations" name="prestas" class="rounded-2"> 
                  <datalist id = "prestations">
                    <option value="">--prestation--</option>
                    <option value="prest1" selected>Coupe Homme</option>
                    <option value="prest2">Couleur</option>
                    <option value="prest3">Shampooing</option>
                    <option value="prest4">Mèches</option>
                  </datalist>
                  </select>
                </div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p12">Prix:</label><br><span id="p12" class="p-1">25€</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p13">Quantité:</label><input type="number" id="p13" size="2" value="2" min="1" class="rounded-2 text-center"></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p14">Date-heure:</label><br><span id="p14" class="p-1">15/02/2024-13h00</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p15">Option:</label><br><span id="p15" class="p-1">Maria</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p16">Total:</label><br><span id="p16" class="p-1">50€</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p17">Modifier la ligne</label><br><i id="p17" class="bi bi-pencil bipencil p-1 col-sm"></i></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p18">Supprimer la ligne</label><br><i id="18" class="bi bi-x bicross p-1 col-sm"></i></div>
              </div>
              <div id="det2" class="grid-container justify-content-between p-3 col-sm border bg-light border-primary rounded-2 m-1">
                <div class="grid-item col-form-label col-form-label-sm">
                  <label for="s21">Prestation:</label>
                  <select id="s21" list = "prestations" name="prestas" class="rounded-2"> 
                  <datalist id = "prestations">
                    <option value="">--prestation--</option>
                    <option value="prest1">Coupe Homme</option>
                    <option value="prest2" selected>Couleur</option>
                    <option value="prest3">Shampooing</option>
                    <option value="prest4">Mèches</option>
                  </datalist>
                  </select>
                </div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p22">Prix:</label><br><span id="p12" class="p-1">25€</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p23">Quantité:</label><input type="number" id="p13" size="2" value="1" min="1" class="rounded-2 text-center"></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p24">Date-heure:</label><br><span id="p14" class="p-1">15/02/2024-13h00</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p25">Option:</label><br><span id="p15" class="p-1">Takako</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p26">Total:</label><br><span id="p16" class="p-1">25€</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p27">Modifier la ligne</label><br><i id="p27" class="bi bi-pencil bipencil p-1 col-sm"></i></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p28">Supprimer la ligne</label><br><i id="28" class="bi bi-x bicross p-1 col-sm"></i></div>
              </div>
              <div id="det3" class="grid-container justify-content-between p-3 col-sm bg-light border border-primary rounded-2 m-1">
                <div class="grid-item col-form-label col-form-label-sm">
                  <label for="s31">Prestation:</label>
                  <select id="s31" list = "prestations" name="prestas" class="rounded-2"> 
                  <datalist id = "prestations">
                    <option value="">--prestation--</option>
                    <option value="prest1">Coupe Homme</option>
                    <option value="prest2">Couleur</option>
                    <option value="prest3" selected>Shampooing</option>
                    <option value="prest4">Mèches</option>
                  </datalist>
                  </select>
                </div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p32">Prix:</label><br><span id="p32" class="p-1">13€</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p33">Quantité:</label><input type="number" id="p33" size="2" value="1" min="1" class="rounded-2 text-center"></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p34">Date-heure:</label><br><span id="p34" class="p-1">15/02/2024-13h00</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p35">Option:</label><br><span id="p35" class="p-1">Thierry</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p36"></label>Total:</label><br><span id="p36" class="p-1">13€</span></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p37">Modifier la ligne</label><br><i id="p37" class="bi bi-pencil bipencil p-1 col-sm"></i></div>
                <div class="grid-item col-form-label col-form-label-sm"><label for="p38">Supprimer la ligne</label><br><i id="38" class="bi bi-x bicross p-1 col-sm"></i></div>
              </div>
              <div class="boldfonts d-flex justify-content-end text-decoration-underline">
                <p class="text-start">Total du panier: 88€</p>
              </div>
              <div class="d-flex justify-content-end">
                <button type="submit" id="bt2" class="bsbtn1 btn mx-auto rounded-2"><i class="bi bi-bag-plus"></i>&nbsp;Ajouter une ligne</button>
                <button type="submit" id="bt3" class="bsbtn1 btn mx-auto rounded-2"><i class="bi bi-scissors"></i>&nbsp;Réservation</button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>
    <!-- footer -->
    <div class="container-fluid sticky-md-bottom" > 
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top nav_bar bsfont">
          <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
              <img src="../assets/img/logo-beautystyling.jpg" width="80">
              <!--<svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>-->
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
          </div>
          <div class="col-md-4 d-flex align-items-center">
            <a href="#" id="footerlink" class="text-reset bsfont">Nous contacter</a>  
          </div>
          <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../assets/img/logo-white.png" alt="logo du reseau1" class="bi" width="24" height="24"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="../assets/img/01GradientGlyph/Instagram_Glyph_Gradient.png"  alt="logo du reseau2" class="bi" width="24" height="24"></a></li>
            <li class="mx-3"><a class="text-body-secondary" href="#"><img src="../assets/img/icons/icons8-facebook.png"  class="bi" width="30" height="30"></a></li>
          </ul>
        </footer>
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script type="module" defer src="../assets/js/ta-clientPaniers.js"></script>
</body>
</html>

