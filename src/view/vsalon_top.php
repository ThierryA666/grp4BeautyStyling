<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top pour salons </title>
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Linden+Hill&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  
</head>
<body>
    <header class="container-fluid">
        <nav class="navbar navbar-expand-md" style="background-color:#A0ECBA;">
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
                    <a class="nav-link disabled" href="salon_top.php" style="font-family: 'DM Serif Display', serif;">Inscrire mon salon</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="salon_login.php" style="font-family: 'DM Serif Display', serif;">Se connecter (Compte salon)</a>
                  </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
        <di class="container-fluid row mx-auto">
            <div class="col-md-8 mx-auto d-block">
                <div class="mt-5">
                    <h1 class="fs-2" style="font-family: 'DM Serif Display', serif; color:#FF5B76">La meilleure solution 
                        pour développer votre salon ! </h1> 
                </div>
                <div class="container px-4 py-5" id="icon-grid">
                    <h2 class="pb-2 border-bottom fs-4" style="font-family: roboto;">Les outils dont vous avez besoin</h2>
                    
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 g-4 py-5">
                          
                        <div class="col d-flex align-items-start">
                          <div>
                            <h2 class="fw-bold mb-0 fs-5 text-body-emphasis">  <i class="fa-regular fa-calendar-check"></i> Réservation en ligne</h2>
                            <p>Paragraph of text beneath the heading to explain the heading.</p>
                          </div>
                        </div>

                        <div class="col d-flex align-items-start">
                          <div>
                            <h3 class="fw-bold mb-0 fs-5 text-body-emphasis">  <i class="fa-solid fa-calendar-days"></i> Calendrier en ligne</h3>
                            <p>Paragraph of text beneath the heading to explain the heading.</p>
                          </div>
                        </div>
                        <div class="col d-flex align-items-start">
                          <div>
                            <h3 class="fw-bold mb-0 fs-5 text-body-emphasis">  <i class="fa-solid fa-mobile-screen"></i> SMS de rappel de RDV</h3>
                            <p>Paragraph of text beneath the heading to explain the heading.</p>
                          </div>
                        </div>
                          
                    </div>
                </div>
                
                <div class="col-12 d-flex justify-content-center">
                    <a href="vsalon_application.php"><button id="insSalon" type="submit" class="btn btn-lg fs-2" style="background-color: #FF5B76; color: white;">Inscrire mon salon <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                      </svg></button></a>  
                </div>        
            </div>
            <div class="col-md-4 mx-auto d-flex align-items-center" id="illustTopSalon2">
                <img class="img-fluid" src="/assets/img/illustSalon.png"> 
            </div>
            <div id="illustTopSalon" class="mt-4 col-md-12 d-flex mx-auto justify-content-around">
              <img src="/assets/img/salonillust2.png" height="150">
              <img class="align-items-center" src="/assets/img/onlinebooking.jpg" height="150">
              <img src="/assets/img/haircolor.png" height="150">             
            </div>

          

        </div>    
    </main>

<!-- footer -->
<div class="container-fluid sticky-md-bottom" id="footerDiv">
    <footer class="d-md-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" style="background-color: #A0ECBA;">
      <div class="col-md-4 d-flex align-items-center">
        <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
          <img src="/assets/img/logo_beautystyling.jpg" width="80">
          <!-- <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg> -->
        </a>
        <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
      </div>
      <div class="col-md-4 d-flex align-items-center">
        <a href="#" id="footerlink" class="text-reset" style="font-family: 'DM Serif Display', serif;">Nous contacter</a>  
      </div>
      <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
        <li class="ms-3"><a class="text-body-secondary" href="#"><img src="/assets/img/logo-white.png" class="bi" width="24" height="24"></a></li>
        <li class="ms-3"><a class="text-body-secondary" href="#"><img src="/assets/img/Instagram_Glyph_Gradient.png"  class="bi" width="24" height="24"></a></li>
        <li class="mx-3"><a class="text-body-secondary" href="#"><img src="/assets/img/icons8-facebook.png"  class="bi" width="30" height="30"></a></li>
      </ul>
    </footer>
  </div>
 
  <script src="https://kit.fontawesome.com/76614da91c.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>