<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionnaire salon</title>
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
                    <a class="nav-link" href="salon_profile.php" style="font-family: 'DM Serif Display', serif;">Infos salon</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Se deconnecter (Compte salon)</a>
                  </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
      <div class="mt-2">
        <h1 class="fs-3 text-center" style="font-family: 'DM Serif Display', serif">- Bonjour <?=$salon->getNom_salon()?> ! -</h1>
      </div>
      <div class="container mt-5 d-flex">
        <div class="col-md-8">
          <form class="container-fluid row border border-success-subtle" >
            <div class="container-fluid mt-2 " style="background-color: #A0ECBA;">
              <p class="text-md-center fs-3">Liste de prestation</p>
            </div>
            
            
        <?php 
        foreach($prestations as $prestation){ ?>
          <div class="d-flex">
          <div class="form-check col-md-6 d-flex">
            <input class="form-check-input fs-4" type="checkbox" value="<?=$prestation->getIdPresta()?>" id="flexCheckDefault">
            <label class="form-check-label fs-4" for="flexCheckDefault">
              <?=$prestation->getNomPresta()?>
            </label>
          </div>
          <div class="col-md-2"> 
            <input type="text" class="form-control" name="prixPresta" style="text-align:right" value="<?=$prestation->getPrixIndPresta()?>" >
          </div>
          <div class="col-md-2"> 
            <p>€ (T.T.C.)</p>
          </div>
          </div>
        <?php
        }?>
        
         
            
            <!-- <div class="form-check col-md-8">
              <input class="form-check-input" type="radio" name="flexRadioDefault prestation2" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                Default radio
              </label>
            </div>
            <div class="col-md-2"> 
              <input type="text" class="form-control" id="tarif" placeholder="55">
            </div>
            <div class="col-md-2"> 
              <p> € (T.T.C.) </p>
            </div>

            <div class="form-check col-md-8">
              <input class="form-check-input" type="radio" name="flexRadioDefault prestation3" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                Default radio
              </label>
            </div>
            <div class="col-md-2"> 
              <input type="text" class="form-control" id="tarif" placeholder="55">
            </div>
            <div class="col-md-2"> 
              <p> € (T.T.C.) </p>
            </div>

            <div class="form-check col-md-8">
              <input class="form-check-input" type="radio" name="flexRadioDefault prestation4" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                Default radio
              </label>
            </div>
            <div class="col-md-2"> 
              <input type="text" class="form-control" id="tarif" placeholder="55">
            </div>
            <div class="col-md-2"> 
              <p> € (T.T.C.) </p>
            </div>

            <div class="form-check col-md-8">
              <input class="form-check-input" type="radio" name="flexRadioDefault prestation5" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                Default radio
              </label>
            </div>
            <div class="col-md-2"> 
              <input type="text" class="form-control" id="tarif" placeholder="55">
            </div>
            <div class="col-md-2"> 
              <p> € (T.T.C.) </p>
            </div>

            <div class="form-check col-md-8">
              <input class="form-check-input" type="radio" name="flexRadioDefault prestation6" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                Default radio
              </label>
            </div>
            <div class="col-md-2"> 
              <input type="text" class="form-control" id="tarif" placeholder="55">
            </div>
            <div class="col-md-2"> 
              <p> € (T.T.C.) </p>
            </div>
            
            <div class="form-check col-md-8">
              <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
              <label class="form-check-label" for="flexRadioDefault1">
                Default radio
              </label>
            </div>
            <div class="col-md-2"> 
              <input type="text" class="form-control" id="tarif" placeholder="55">
            </div>
            <div class="col-md-2"> 
              <p> € (T.T.C.) </p>
            </div> -->

            <div class="col-12 my-3 d-flex justify-content-end">
              <button type="submit" class="btn text-white mx-5" style="background-color: #FF5B76;" name="savePresta">Enregistrer</button>
            </div> 
           
          </form>    
        </div>
        <div class="col-md-4 d-flex align-items-center">
          <div class="col-md-12 d-flex justify-content-end">
            <a href="salon_application.html"><button id="insSalon" type="submit" class="btn fs-3" style="background-color: #FF5B76; color: white;">Voir le calendrier <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
              </svg></button></a>  
        </div>       
        </div>
      </div>
    </main>

<!-- footer -->
<div class="container-fluid sticky-md-bottom" id="footerDiv">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" style="background-color: #A0ECBA;">
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
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>