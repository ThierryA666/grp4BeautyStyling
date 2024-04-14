<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Linden+Hill&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link href="../../assets/css/ta-style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="../../assets/img/logo-beautystyling.jpg" rel="icon">
    <title>adminPrestation</title>
</head>
<header class="container-fluid"><!--Admin Nav Bar-->
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
                <a class="nav-link" aria-current="page" href="#" style="font-family: 'DM Serif Display', serif">Administration</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Clients</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Salons</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="nav1" href="./adminListePrestations.php" style="font-family: 'DM Serif Display', serif;">Prestations</a>
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
<body>
  <main>
    <div class="container-fluid sticky-md-bottom" > 
        <h1 class="h4 text-dark text-center my-5">Gestion prestation</h1>
        <div class="input col-md-10 mx-auto rounded-4" id="input">
            <!--TODO formulaire-->
            <div class="col-md-8 mx-auto">
              <form id="formPresta" class="p-3" name="createPrestation" method="post" action="./adminPrestation.php">
              <div>    
                <div>
                    <label for="input1" class="col-form-label col-form-label-sm">Nom* :</label>
                    <input type="text" size="48" class="form-control form-control-sm rounded-2" maxlength="128" id="input1" name="name" placeholder="le nom de la prestation" <?=$disabled ? 'disabled' : ''?> value="<?=$prestation->getNomPresta()?>"></input>
                </div>
                <div>
                  <label for="input2" class="col-form-label col-form-label-sm">Durée en heure* :</label>
                  <input type="number" size="5" class="form-control form-control-sm rounded-2" maxlength="5" min="<?=$min?>" max="<?=$max?>" id="input2" name="duration" placeholder="la durée de la prestation" value="<?=$prestation->getDureePresta() ? intval($prestation->getDureePresta()->format('h')) : 1?>"></input>
                </div>
                <div>
                  <label for="input3" class="col-form-label col-form-label-sm">Description :</label>
                  <input type="text" size="64" class="form-control form-control-sm rounded-2" maxlength="256" id="input3" name="description" placeholder="description de la prestation" value="<?=$prestation->getDescPresta() ? $prestation->getDescPresta() : ''?>"></input>
                </div>
                <div>
                  <label for="input4" class="col-form-label col-form-label-sm">Prix* (indicatif) en €:</label>
                  <input type="number" size="5" class="form-control form-control-sm rounded-2 p-2" maxlength="<?=$maxLength?>" min="<?=$min?>" id="input4" name="price" value="<?=$prestation->getPrixIndPresta() ? $prestation->getPrixIndPresta() : ''?>"></input>
                </div>
                <div>
                  <label for="input5" class="col-form-label col-form-label-sm">Date de création</label>
                  <input type="Date" class="form-control form-control-sm rounded-2 p-2" id="input5" name="creationDate" disabled value="<?=$prestation->getCreationDate() ? $prestation->getCreationDate()->format('Y-m-d') : ''?>"></input>
                </div>
                <div class="<?=$display?>">
                  <label for="input6" class="col-form-label col-form-label-sm ">Date de modification</label>
                  <input type="Date" class="form-control form-control-sm rounded-2 p-2" id="input6" name="modifDate" <?=$disabled ? 'disabled' : ''?> value="<?=$prestation->getModifDate() ? $prestation->getModifDate()->format('Y-m-d') : '' ?>"></input>
                </div>
                <div class="row d-flex  justify-content-end">
                  <div class="col">
                    <button type="submit" id="<?=$buttonID?>" name="<?=$buttonLabel?>" class="bsbtn2 btn d-flex m-5 mx-auto justify-content-end"  value="<?=$buttonLabel?>"><?=$buttonLabel?></button>
                  </div>
                  <div class="col <?=$afficher?>">
                    <button type="submit" id="buttonSupp" name="Supprimer" class="bsbtn2 btn d-flex m-5 mx-auto" value="Supprimer">Supprimer</button>
                  </div>
                  <div class="col <?=$afficher2?>">
                    <button type="submit" id="buttonSupp" name="goBackList" formethod="post" formaction="./adminListePrestations.php" class="bsbtn2 btn d-flex m-5 mx-auto" value="goBackList">Retour à la liste</button>
                  </div>
              </div>
              </form>
              <div>
                </p><h2 class="h5 <?=$msgUtilisateur['msgShow'] ? $msgUtilisateur['style'] : 'd-none'?>"><?=$msgUtilisateur['message']?></h2></p>
              </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dialogConfirm" tabindex="-1" role="dialog" aria-labelledby="dialogConfirmLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <img src="../../assets/img/logo-beautystyling.jpg" alt="Logo Beauty Styling" width="100" class="d-inline-block align-text-center">
            <h1 class="h5 modal-title" id="exampleModalLabel">Beauty styling</h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
          </div>
          <div class="modal-footer">
            <button id="actionModal" type="button" class="bsbtn2 btn" data-dismiss="modal">Confirmer</button>
            <button type="button" class="bsbtn1 btn" data-dismiss="modal">Annuler</button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script> -->
  <script type="module" src="../../assets/js/ta-adminPrestationsPHP.js"></script>
</body>
</html>
