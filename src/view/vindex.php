<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Page - Beauty styling </title>
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
                    <a class="nav-link" aria-current="page" href="../webapp/index.php" style="font-family: 'DM Serif Display', serif">Accueil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../webapp/salon_top.php" style="font-family: 'DM Serif Display', serif;">Inscrire mon salon</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Se connecter</a>
                  </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
        <di class="container row mx-auto">
            <div class="col-md-6 mx-auto" id="illustTop">
                <img class="img-fluid" src="/assets/img/illustTop.png">
            </div>
            <div class="col-md-6 mx-auto">
                <h1 class="fs-1" style="font-family: 'DM Serif Display', serif; color:#FF5B76">Découvrez et réservez le salon qui vous correspond !</h1>    
                <form method="POST" action="index.php" name="searchForm" id="searchForm">
                    <div class="m-3">
                        <label for="nameInput"   class="form-label">Nom de salon</label>
                        <input name="nameInput" id="nameInput" type="text" class="form-control"  placeholder="Veuillez saisir une partie ou la totalité du nom du salon.">
                    </div>
                    <div class="m-3">
                        <label for="dateInput" class="form-label">Séléctionez une date</label>
                        <input id ="dateInput" type="date" class="form-control"  placeholder="date">
                    </div>
                    <div class="m-3">
                        <label for="prestation" class="form-label">Préstation</label>
                        <select name="prestation" class="form-control" id="prestation" placeholder="Prestation">
                            <option name ="all" value="">--Tous les prestations--</option>
                            <?php foreach ($prestations as $prestation){ ?>
                            <option name ="prest" value="<?=$prestation->getIdPresta()?>"><?=$prestation->getNomPresta()?></option>
                            <?php
                              }?>
                       
                        </select>
                    </div>
                    <div class="col-12 d-flex justify-content-end">
                        <button name="search" id="cestParti" type="submit" class="btn fs-3" style="background-color: #FF5B76; color: white;">C'EST PARTI !</button>      
                    </div>
                </form>
                <div id="searchResult" class="col-md-6 mx-auto m-3">
           
            <?php foreach ($salons as $salon) { ?>
                <div class="m-3">
                    <p class="fs-4"><?=$salon->getNom_salon()?></p>
                    <p class="fs-5"><?=$salon->getAd1()?> <?=$salon->getAd2()?> <?=$salon->getCp_salon()?> <?=$salon->getNom_ville()?></p>
                    <div class="d-flex">
                        <p class="mx-2"><?=$salon->getUrl_salon()?></p>
                        <p class="mx-2">TEL: 0<?=$salon->getTel_salon()?></p>
                        <img class="mx-2" width="100" src="/assets/img/photos-salon/<?=$salon->getPhoto_salon()?>">
                    </div>              
                </div> 
            <?php } ?>
        </div>
            
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

  <script type ="module" src="/assets/js/index.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>