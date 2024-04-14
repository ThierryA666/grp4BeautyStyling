<?php
namespace beautyStyling\view;
use beautyStyling\webapp\gestion_comptes_prestataires;
use beautyStyling\metier\Salon;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion comptes prestataires </title>
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
                <a class="navbar-brand" href="vindex.php" style="font-family: 'DM Serif Display', serif; color: #FF5B76;">
                    <img src="/assets/img/logo_beautystyling.jpg" alt="Logo_Beauty Styling" width="100"  class="d-inline-block align-text-center">
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
                    <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Prestataires</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Prestations</a>
                  </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
      <div class="mt-2 text-md-center">
        <P class="fs-3" style="font-family: 'DM Serif Display', serif"> Gestion de comptes prestataires </P>
      </div>
      <div class="container row mt-5 d-flex mx-auto">
        <div class="col-md-12 d-flex justify-content-center mx-auto">
          <form method="POST" action="gestion-comptes-prestataires.php" name="searchForm"  class="container-fluid row border border-success-subtle" >

            <div class="container-fluid mt-2 " style="background-color: #A0ECBA;">
              <p class="text-md-center fs-3">Liste des comptes prestataires</p>
            </div>

            <div class="col-md-12 d-flex">
              <div class="col-md-3 my-3 d-flex">
                <a href ="salon_application.php" type="button" class="btn text-white mx-5" style="background-color: #FF5B76;">Ajouter un compte</a>
              </div> 
              <div class="col-md-9 my-3 d-flex">
                
                  <input type="text" class="form-control" id="inputKeyword" name="keyWord" placeholder="Entrez nom de salon ou numéro de téléphone">
                  <button id="btnSearchSalonAccount" type="submit" class="btn text-white mx-5" style="background-color: #FF5B76;"> Rechecher </button>
             
              </div> 
            
            </div>

            <div class="col-md-12 d-flex">
              <table class="table caption-top">
                <caption>Liste de comptes prestataires</caption>
                <thead>
                  <tr>
                    <th scope="col"><input class="form-check-input" type="checkbox" value="selectAll" disabled></th>
                    <th scope="col">Nom de salon </th>
                    <th scope="col">Nom de responsable</th>
                    <th scope="col">Téléphone</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody id="listSalonAccount">
                  <?php
                  foreach ($salons as $salon ){ ?>
                  <tr>
                    <th scope="row"><input class="form-check-input" type="checkbox" value="select"></th>
                    <td id="nameSalon"><?=$salon->getNom_salon()?></td>
                    <td id="nameRep"><?=$salon->getNom_res()?><?=" ".$salon->getPrenom_res()?></td>
                    <td id="telSalon"><?="0".$salon->getTel_salon()?></td>
                    <td id="emailSalon"><?=$salon->getEmail_salon()?></td>
                    <td><a href="salon_profile.php?id_salon=<?=$salon->getId_salon()?> "><i class="bi bi-pencil" style="color:blue;"></i></a> / <i class="bi bi-x" style="color:red;"></i></td>
                  </tr>
                  <?php
                  } ?>
                  
                  
                </tbody>
              </table>
            </div>

            <div class="col-12 my-3 d-flex justify-content-end">
              <button  type="submit" class="btn text-white mx-5" style="background-color: #FF5B76;">Enregistrer</button>
            </div> 
           
          </form>    
        </div>
      </div>
    </main>

  <script type ="module" src="/assets/js/gestion_comptes_prestataires.js"></script>
  <script src="https://kit.fontawesome.com/76614da91c.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>