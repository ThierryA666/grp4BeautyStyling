<<<<<<< HEAD
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de la suppression</title>
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
                    <a class="nav-link " href="salon_gestionnaire.php" style="font-family: 'DM Serif Display', serif;">Gestionnaire salon</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="salon_login.php" style="font-family: 'DM Serif Display', serif;">Se coonecter (Compte salon)</a>
                  </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
      <div>
        <P class="fs-3 text-center" >- Confirmation de la suppression du compte -</P>
      </div>
      <div>
        <P class="fs-3 text-center" >Je confirme la suppression du compte suivant: <?=$salon->getNom_salon()?> </P>
      </div>
      <div>
        <p class="fs-5 text-center text-danger"><?=$message?></p>
      </div>
      <div class="container mt-5">
        <form id="myForm" method="POST" action="salon_delete.php" class="row g-3 s-2 m-n" enctype="multipart/form-data" style="background-color: #A0ECBA;">
        <input type="hidden" name="id_salon" value="<?=$salon->getId_salon()?>">
          <div class="col-md-3">
            <label for="inputName" class="form-label">Nom</label>
            <input type="name" class="form-control" id="modifName" name="nom" value="<?=$salon->getNom_res()?>" disabled>
          </div>

          <div class="col-md-3">
            <label for="inputFirstName" class="form-label">Prénom</label>
            <input type="name" class="form-control" id="modifFirstName" name="prenom" value="<?=$salon->getPrenom_res()?>"  disabled>
          </div>

          <div class="col-md-6">
            <label for="inputAddress" class="form-label">Aderesse</label>
            <input type="text" class="form-control" id="modifAddress1" name="ad1" value="<?=$salon->getAd1()?>" disabled>
          </div>

          <div class="col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input type="text" class="form-control" id="modifEmail" name="email" value="<?=$salon->getEmail_salon()?>"  disabled >
          </div>

          <div class="col-md-6">
            <label for="inputAddress2" class="form-label">Address 2</label>
            <input type="text" class="form-control" id="modifAddress2" name="ad2" value="<?=$salon->getAd2()?>" placeholder="" disabled>
          </div>

          <div class="col-md-6">
            <label for="inpuTel" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="modifTel" name="tel"  value="<?='0'.$salon->getTel_salon()?>" disabled>
          </div>
         
          <div class="col-md-2">
            <label for="inputZip" class="form-label">Code postal</label>
            <input type="text" class="form-control" id="modifZip" name="zip" value="<?=$salon->getCp_salon()?>" placeholder="" disabled>
          </div>

          <div class="col-md-3">
            <label for="inputCity" class="form-label">Ville</label>
            <input type="text" class="form-control" id="modifCity" name="ville" value="<?=$salon->getNom_ville()?>" placeholder="" disabled>
          </div>

          <div class="col-md-6">
            <label for="salonName" class="form-label">Nom de salon</label>
            <input type="text" class="form-control" id="modifSalon" name="nom_salon" value="<?=$salon->getNom_salon()?>" readonly>
          </div>

          <div class="col-md-6">
            <label for="inputURL" class="form-label">URL ou Page Facebook / Instagram de salon </label>
            <input type="text" class="form-control" id="modifURL" name="url" value="<?=$salon->getUrl_salon()?>" disabled>
          </div>

          <div class="col-md-3">
            <label for="photoUL" class="form-label">Photo de profil</label>
            <input type="file" class="form-control" name="photo" id="modifPhoto" disabled>
          </div>
          
          <div id="registeredPhoto" class="col-md-3">
            <img src="/assets/img/photos-salon/<?=$salon->getPhoto_salon()?>" width="250">
          </div>

          <div class="col-md-3">
            <label for="password" class="form-label">Mot de passe (8 caractères minimum)</label>
            <input type="password" class="form-control" name="pw" id="modifPW"  minlength="8" maxlength="12" value="<?=$salon->getPw_salon()?>" disabled>
            <label for="checkbox" class="form-label">Afficher le mot de passe </label>
            <input type="checkbox" id="chk">
          </div>
        
          <div class="col-12 mb-6 d-flex justify-content-md-end">
            <button type="submit" class="btn text-white mx-5 mb-3 fs-4" style="background-color: #FF5B76;" id="btnDel" name="btnDel" >Supprimer</button>

          </div>

          </div>

        </form>
      </div>   
    </main>


  </div>
  <!-- <script type ="module" src="/assets/js/salon_profile.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
=======
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de la suppression</title>
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
                    <a class="nav-link " href="salon_gestionnaire.php" style="font-family: 'DM Serif Display', serif;">Gestionnaire salon</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="salon_login.php" style="font-family: 'DM Serif Display', serif;">Se coonecter (Compte salon)</a>
                  </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
      <div>
        <P class="fs-3 text-center" >- Confirmation de la suppression du compte -</P>
      </div>
      <div>
        <P class="fs-3 text-center" >Je confirme la suppression du compte suivant: <?=$salon->getNom_salon()?> </P>
      </div>
      <div>
        <p class="fs-5 text-center text-danger"><?=$message?></p>
      </div>
      <div class="container mt-5">
        <form id="myForm" method="POST" action="salon_delete.php" class="row g-3 s-2 m-n" enctype="multipart/form-data" style="background-color: #A0ECBA;">
        <input type="hidden" name="id_salon" value="<?=$salon->getId_salon()?>">
          <div class="col-md-3">
            <label for="inputName" class="form-label">Nom</label>
            <input type="name" class="form-control" id="modifName" name="nom" value="<?=$salon->getNom_res()?>" disabled>
          </div>

          <div class="col-md-3">
            <label for="inputFirstName" class="form-label">Prénom</label>
            <input type="name" class="form-control" id="modifFirstName" name="prenom" value="<?=$salon->getPrenom_res()?>"  disabled>
          </div>

          <div class="col-md-6">
            <label for="inputAddress" class="form-label">Aderesse</label>
            <input type="text" class="form-control" id="modifAddress1" name="ad1" value="<?=$salon->getAd1()?>" disabled>
          </div>

          <div class="col-md-6">
            <label for="email" class="form-label">E-mail</label>
            <input type="text" class="form-control" id="modifEmail" name="email" value="<?=$salon->getEmail_salon()?>"  disabled >
          </div>

          <div class="col-md-6">
            <label for="inputAddress2" class="form-label">Address 2</label>
            <input type="text" class="form-control" id="modifAddress2" name="ad2" value="<?=$salon->getAd2()?>" placeholder="" disabled>
          </div>

          <div class="col-md-6">
            <label for="inpuTel" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="modifTel" name="tel"  value="<?='0'.$salon->getTel_salon()?>" disabled>
          </div>
         
          <div class="col-md-2">
            <label for="inputZip" class="form-label">Code postal</label>
            <input type="text" class="form-control" id="modifZip" name="zip" value="<?=$salon->getCp_salon()?>" placeholder="" disabled>
          </div>

          <div class="col-md-3">
            <label for="inputCity" class="form-label">Ville</label>
            <input type="text" class="form-control" id="modifCity" name="ville" value="<?=$salon->getNom_ville()?>" placeholder="" disabled>
          </div>

          <div class="col-md-6">
            <label for="salonName" class="form-label">Nom de salon</label>
            <input type="text" class="form-control" id="modifSalon" name="nom_salon" value="<?=$salon->getNom_salon()?>" readonly>
          </div>

          <div class="col-md-6">
            <label for="inputURL" class="form-label">URL ou Page Facebook / Instagram de salon </label>
            <input type="text" class="form-control" id="modifURL" name="url" value="<?=$salon->getUrl_salon()?>" disabled>
          </div>

          <div class="col-md-3">
            <label for="photoUL" class="form-label">Photo de profil</label>
            <input type="file" class="form-control" name="photo" id="modifPhoto" disabled>
          </div>
          
          <div id="registeredPhoto" class="col-md-3">
            <img src="/assets/img/photos-salon/<?=$salon->getPhoto_salon()?>" width="250">
          </div>

          <div class="col-md-3">
            <label for="password" class="form-label">Mot de passe (8 caractères minimum)</label>
            <input type="password" class="form-control" name="pw" id="modifPW"  minlength="8" maxlength="12" value="<?=$salon->getPw_salon()?>" disabled>
            <label for="checkbox" class="form-label">Afficher le mot de passe </label>
            <input type="checkbox" id="chk">
          </div>
        
          <div class="col-12 mb-6 d-flex justify-content-md-end">
            <button type="submit" class="btn text-white mx-5 mb-3 fs-4" style="background-color: #FF5B76;" id="btnDel" name="btnDel" >Supprimer</button>

          </div>

          </div>

        </form>
      </div>   
    </main>


  </div>
  <!-- <script type ="module" src="/assets/js/salon_profile.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
</html>