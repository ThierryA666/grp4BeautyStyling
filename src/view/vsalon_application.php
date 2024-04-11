<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrire mon salon </title>
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
                <a class="navbar-brand" href="index.html" style="font-family: 'DM Serif Display', serif; color: #FF5B76;">
                    <img src="/assets/img/logo_beautystyling.jpg" alt="Logo_Beauty Styling" width="100"  class="d-inline-block align-text-center">
                    Beauty styling
                </a>  
              
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.html" style="font-family: 'DM Serif Display', serif">Accueil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link disabled" href="salon_top.html" style="font-family: 'DM Serif Display', serif;">Inscrire mon salon</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="salon_login.html" style="font-family: 'DM Serif Display', serif;">Se coonecter (Compte salon)</a>
                  </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
      <div class="">
        <P class="fs-3 text-center" style="font-family: 'DM Serif Display', serif">- Formulaire d’inscription -</P>
      </div>
      <div class="container mt-5">
        <form method="POST" action="salon_application.php" class="row g-3 s-2 m-n" enctype="multipart/form-data" style="background-color: #A0ECBA;" id="salonapp">
          <div class="col-md-3">
            <label for="inputName" class="form-label">Nom*</label>
            <p id="errNom" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="inputName" name="nom" placeholder="">
          </div>

          <div class="col-md-3">
            <label for="inputFirstName" class="form-label">Prénom*</label>
            <p id="errPrenom" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="inputFirstName" name="prenom" placeholder="">
          </div>

          <div class="col-md-6">
            <label for="inputAddress" class="form-label">Aderesse*</label>
            <p id="errAd" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="inputAddress" placeholder="Numéro, Voie" name="ad1">
          </div>

          <div class="col-md-6">
            <label for="inputEmail" class="form-label">E-mail*</label>
            <p id="errEmail" class="text-warning d-none">error message</p>
            <input type="email" class="form-control" id="inputEmail" placeholder="name@mail.com" name="email">
          </div>

          <div class="col-md-6">
            <label for="inputAddress2" class="form-label">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="" name="ad2">
          </div>
          
          <div class="col-md-2">
            <label for="inpuTCodeInt" class="form-label">Code international*</label>
            <input type="tel" class="form-control" id="inputCodeInt" minlength="1" maxlength="5" name="codeInt" placeholder="+33" value="+33">
          </div>

          <div class="col-md-4">
            <label for="inpuTel" class="form-label">Téléphone*</label>
            <p id="errTel" class="text-warning d-none">error message</p>
            <input type="tel" class="form-control" id="inputTel" minlength="10" maxlength="12" name="tel" placeholder="ex: 0123456789">
          </div>
         
          <div class="col-md-2">
            <label for="inputZip" class="form-label">Code postal*</label>
            <p id="errZip" class="text-warning d-none">error message</p>
            <input type="number" class="form-control" id="inputZip" minlength="5"  maxlength="5" name="zip" placeholder="00000">
          </div>

          <div class="col-md-3">
            <label for="inputCity" class="form-label">Ville*</label>
            <p id="errVille" class="text-warning d-none">error message</p>
            <select class="form-select" id="inputCity" aria-label="Floating label select example" name="ville">
              <!-- <option value="1">One</option>
              <option value="2">Two</option>
              <option value="3">Three</option>   -->
            </select>
          </div>

          <div class="col-md-6">
            <label for="salonName" class="form-label">Nom de salon*</label>
            <p id="errNomSalon" class="text-warning d-none">error message</p>
            <input type="text" class="form-control" id="inputSalon" name="salonName" placeholder="">
          </div>

          <div class="col-md-6">
            <label for="inputURL" class="form-label">URL ou Page Facebook / Instagram de salon (facultatif)</label>
            <input type="url" class="form-control" id="inputURL" value="http://www." name="url">
          </div>

          <div class="col-md-3">
            <label for="photoUL" class="form-label">Photo de profil (facultatif) </label>
            <input type="file" class="form-control" id="photoUL" name="photo">
          </div>

          <div class="col-md-4">
            <label for="inputPW" class="form-label">Mot de passe minimum 8 carctères*</label>
            <p id="errPW1" class="text-warning d-none">error message</p>
            <input type="password" class="form-control" id="inputPW1"  minlength="8"  maxlength="15" name="pw" placeholder="">
            <label for="checkbox" class="form-label">Afficher le mot de passe </label>
            
            <input type="checkbox" id="chk1">
          </div>

          <div class="col-md-4">
            <label for="inputPW" class="form-label"> Mot de passe (pour confirmer)</label>
            <p id="errPW2" class="text-warning d-none">error message</p>
            <input type="password" class="form-control" id="inputPW2" minlength="8" maxlength="15" name="pw2" >
            <label for="checkbox" class="form-label">Afficher le mot de passe </label>
            <input type="checkbox" id="chk2">
          </div>

          <div class="col-12 mb-3 d-flex justify-content-end">
            <button id="inscriptionBtn" type="submit" class="btn text-white mx-5 fs-4" style="background-color: #FF5B76;">Inscrire</button>
          </div>

          <!-- <div class="mt-5"><?=$message ?></div> -->

        </form>
      </div>   
    </main>

<!-- footer -->
<div class="container-fluid  sticky-md-bottom" id="footerDiv">
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
  <script type ="module" src="/assets/js/salon_application.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>