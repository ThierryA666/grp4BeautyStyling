<<<<<<< HEAD
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Linden+Hill&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Rendez-vous à venir</title>
    <style>
        h1{
          font-size: 1.6em;
          margin-left: 25px;
          margin-top: 20px;
        }
        a:hover{
          color:#FF5B76 !important;
        }
  
        #footerlink {
          text-decoration:none !important;
  
        }
  
        #footerlink:visited {
          color:black;
        }
  
        button:hover{
          background-color: #A0ECBA !important;
          color:#FF5B76 !important;
        }

        li {
          cursor: pointer;
        }
      </style>
</head>
<body>
    <header>
          <nav class="navbar navbar-expand-lg" style="background-color:#A0ECBA;"> <!-- On utilise le code de Takako pour le navbar-->
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html" style="font-family: 'DM Serif Display', serif; color: #FF5B76;">
                    <img src="..\..\assets\img\logo_beautystyling.jpg" alt="Logo_Beauty Styling" width="100"  class="d-inline-block align-text-center">
                    Beauty styling
                </a>  
              
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarNav">
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link ms-5" aria-current="page" href="../webapp/calendrier.php">Prendre rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active link ms-5" aria-current="page" href="#">Rendez-vous à venir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link ms-5" aria-current="page" href="#">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link link ms-5" href="#">Mon compte</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link link ms-5" href="../webapp//clientPaniers.php">Panier</a>
                        </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
      <h1>Rendez-vous à venir</h1> <br>
      <div id="rendez-vous" class="row menu-container">
        <!-- <div class="container align-items-center mt-5">
            <ul class="list-group">
                <li class="list-group-item">Rendez-vous 1</li>
                <li class="list-group-item">Rendez-vous 2</li>
                <li class="list-group-item">Rendez-vous 3</li>
                <li class="list-group-item">Rendez-vous 4</li>
                <li class="list-group-item">Rendez-vous 5</li>
            </ul>
        </div> -->
      </div>
       
      <!-- <div class="container">
        <div class="row">
            <div class="col-1 mt-3">
                <button type="button" id="button" class="btn btn-success"><i class="bi bi-pencil" style="color:white;"></i></button>
            </div>
            <div class="col-1 mt-3">
                <button type="button" id="button2" class="btn btn-danger"><i class="bi bi-x" style="color:white;"></i></button>
            </div>
        </div>
    </div> -->
    </main>
      <div class="container-fluid  fixed-bottom">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" style="background-color: #A0ECBA;">
          <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
              <img src="..\..\assets\img\logo_beautystyling.jpg" width="80">
              <!-- <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg> -->
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
          </div>
          <div class="col-md-4 d-flex align-items-center">
            <a href="#" id="footerlink" class="text-reset" style="font-family: 'DM Serif Display', serif;">Nous contacter</a>  
          </div>
          <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="..\..\assets\img\logo-white.png" class="bi" width="24" height="24"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="..\..\assets\img\01GradientGlyph\Instagram_Glyph_Gradient.png"  class="bi" width="24" height="24"></a></li>
            <li class="mx-3"><a class="text-body-secondary" href="#"><img src="..\..\assets\img\icons8-facebook.png"  class="bi" width="30" height="30"></a></li>
          </ul>
        </footer> <!-- On utilise le code de Takako pour le footer-->
      </div>
    <!-- <script type="module" src="..\..\assets\javascript\rendez-vousclient-js\script-rendez-vous.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
=======
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Linden+Hill&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Rendez-vous à venir</title>
    <style>
        h1{
          font-size: 1.6em;
          margin-left: 25px;
          margin-top: 20px;
        }
        a:hover{
          color:#FF5B76 !important;
        }
  
        #footerlink {
          text-decoration:none !important;
  
        }
  
        #footerlink:visited {
          color:black;
        }
  
        button:hover{
          background-color: #A0ECBA !important;
          color:#FF5B76 !important;
        }

        li {
          cursor: pointer;
        }
      </style>
</head>
<body>
    <header>
          <nav class="navbar navbar-expand-lg" style="background-color:#A0ECBA;"> <!-- On utilise le code de Takako pour le navbar-->
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html" style="font-family: 'DM Serif Display', serif; color: #FF5B76;">
                    <img src="..\..\assets\img\logo_beautystyling.jpg" alt="Logo_Beauty Styling" width="100"  class="d-inline-block align-text-center">
                    Beauty styling
                </a>  
              
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarNav">
                <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link ms-5" aria-current="page" href="../webapp/calendrier.php">Prendre rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active link ms-5" aria-current="page" href="#">Rendez-vous à venir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link ms-5" aria-current="page" href="#">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link link ms-5" href="#">Mon compte</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link link ms-5" href="../webapp//clientPaniers.php">Panier</a>
                        </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>
    <main>
      <h1>Rendez-vous à venir</h1> <br>
      <div id="rendez-vous" class="row menu-container">
        <!-- <div class="container align-items-center mt-5">
            <ul class="list-group">
                <li class="list-group-item">Rendez-vous 1</li>
                <li class="list-group-item">Rendez-vous 2</li>
                <li class="list-group-item">Rendez-vous 3</li>
                <li class="list-group-item">Rendez-vous 4</li>
                <li class="list-group-item">Rendez-vous 5</li>
            </ul>
        </div> -->
      </div>
       
      <!-- <div class="container">
        <div class="row">
            <div class="col-1 mt-3">
                <button type="button" id="button" class="btn btn-success"><i class="bi bi-pencil" style="color:white;"></i></button>
            </div>
            <div class="col-1 mt-3">
                <button type="button" id="button2" class="btn btn-danger"><i class="bi bi-x" style="color:white;"></i></button>
            </div>
        </div>
    </div> -->
    </main>
      <div class="container-fluid  fixed-bottom">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top" style="background-color: #A0ECBA;">
          <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
              <img src="..\..\assets\img\logo_beautystyling.jpg" width="80">
              <!-- <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg> -->
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">&copy; 2023 Company, Inc</span>
          </div>
          <div class="col-md-4 d-flex align-items-center">
            <a href="#" id="footerlink" class="text-reset" style="font-family: 'DM Serif Display', serif;">Nous contacter</a>  
          </div>
          <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="..\..\assets\img\logo-white.png" class="bi" width="24" height="24"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="#"><img src="..\..\assets\img\01GradientGlyph\Instagram_Glyph_Gradient.png"  class="bi" width="24" height="24"></a></li>
            <li class="mx-3"><a class="text-body-secondary" href="#"><img src="..\..\assets\img\icons8-facebook.png"  class="bi" width="30" height="30"></a></li>
          </ul>
        </footer> <!-- On utilise le code de Takako pour le footer-->
      </div>
    <!-- <script type="module" src="..\..\assets\javascript\rendez-vousclient-js\script-rendez-vous.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
>>>>>>> b3737144e9af770f87c5acb1ac273df8b56038c9
</html>