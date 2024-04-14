<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
        <link href="../../assets/css/ta-style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="../../assets/img/logo-beautystyling.jpg" rel="icon">
        <title>adminPrestationList</title> 
    </head> 
    <header class="container-fluid"><!--Admin Nav Bar--> 
        <nav class="navbar navbar-expand-lg bgnav" style="font-family: 'DM Serif Display', serif; color: #FF5B76;"> 
            <div class="container-fluid"> <a class="navbar-brand bsfont" href="../webapp/index.php"> 
                <img src="../../assets/img/logo-beautystyling.jpg" alt="Logo Beauty Styling" width="100" class="d-inline-block align-text-center"> Beauty styling </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span> </button> <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarNav"> 
                        <ul class="navbar-nav"> 
                            <li class="nav-item"> <a class="nav-link" aria-current="page" href="#" style="font-family: 'DM Serif Display', serif">Administration</a></li>
                            <li class="nav-item"> <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Clients</a></li>
                            <li class="nav-item"> <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Salons</a></li>
                            <li class="nav-item"> <a class="nav-link" id="nav1" href="#" style="font-family: 'DM Serif Display', serif;">Prestations</a></li>
                            <li class="nav-item"> <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Calendrier</a></li>
                            <li class="nav-item"> <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Se déconnecter</a></li>
                        </ul> 
                    </div> 
                </div> 
            </nav> 
        </header> 
    <body class="adminbg"> 
        <main> 
            <section id="listePresta"><!--Affichage des prestations-->
                <div class="container"> <h1 class="h4 text-dark text-center my-5">Liste des prestations</h1>
                    <div class="input container col-md-11 mx-auto rounded-2 p-3">
                        <div>
                            </p><h2 class="h5 <?=$msgUtilisateur['msgShow'] ? $msgUtilisateur['style'] : 'd-none'?>"><?=$msgUtilisateur['message']?></h2></p>
                        </div>
                        <form id="formCreate" name="createPrestation" method="post" action="./adminPrestation.php">
                            <button type="submit" id="buttonGoToCreate" class="bsbtn2 btn d-flex mx-auto rounded-2 p-2" value="createPrestation">Créer une prestation</button>
                        </form>
                        <div id="title" class="grid-container bandeau boldfonts align-items-center p-3 col-sm">
                            <div class="grid-item" ><span class="p-1">Intitulé</span></div>
                            <div class="grid-item" ><span class="p-1">Description</span></div>
                            <div class="grid-item" ><span class="p-1">Création date</span></div>
                            <div class="grid-item" ><span class="p-1">Modif date</span></div>
                            <div class="grid-item"><span class="p-1"></span></div>
                            <div class="grid-item"><span class="p-1"></span></div>
                        </div>
                        <?php foreach ($prestaList as $key => $prestation) {?>
                        <form id="actionPresta" name="actionPresta" action="./adminPrestation.php" method="post"></form>
                        <div id="det<?=$key?>" class="grid-container bg-light border border-primary justify-content-between align-items-center border p-3 col-sm rounded-2">
                            <div class="grid-item" ><span class="p-1"><?=$prestation->getNomPresta()?></span></div>
                            <div class="grid-item" ><span class="p-1"><?=$prestation->getDescPresta()?></span></div>
                            <div class="grid-item" ><span class="p-1"><?=$prestation->getCreationDate()->format('d-m-Y')?></span></div>
                            <div class="grid-item" ><span class="p-1"><?=$prestation->getModifDate() ? $prestation->getModifDate()->format('d-m-Y') : ''?></span></div>
                            <div class="grid-item">
                                <form id="actionPresta<?=$key?>" name="actionPresta" action="./adminPrestation.php" method="post">
                                    <button type="submit" id="modif<?=$key?>" class="bsIconButtonPencil"><i id="mod<?=$key?>" class="bi-pencil m-2 p-3"></i></button>
                                    <input type="hidden" name="key" value="modifPresta<?=$prestation->getIdPresta()?>">
                                </form>
                            </div>
                            <div class="grid-item">
                                <form id="formSupp<?=$key?>" name="formSupp" action="./adminListePrestations.php" method="post">
                                    <button type="submit" id="supp<?=$key?>" name="suppPresta" value="<?=$key?>" class="bsIconButtonTrash" data-toggle="modal" data-target="#dialogConfirm" ><i id="supp<?=$key?>" class="bi-trash m-2 p-3" data-prestation="<?=$prestation->getNomPresta()?>" data-id=<?=$key?>></i></button>
                                    <input type="hidden" name="key" value="<?=$key?>">
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="dialogConfirm" tabindex="-1" role="dialog" aria-labelledby="dialogConfirm" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img src="../../assets/img/logo-beautystyling.jpg" alt="Logo Beauty Styling" width="100" class="d-inline-block align-text-center">
                            <h1 class="h5 modal-title">Beauty styling</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button id="actionModal" type="button" class="bsbtn2 btn" data-dismiss="modal" formmethod="post" formaction=""./adminListePrestations.php">Confirmer</button>
                        <button type="button" class="bsbtn1 btn" data-dismiss="modal">Annuler</button>
                    </div>
                </div>
            </div>
        </main>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script type="module" src="../../assets/js/ta-adminPrestationsPHP.js"></script>
    </body>
</html>