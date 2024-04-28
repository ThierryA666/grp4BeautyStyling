<header class="container-fluid"><!--Admin Nav Bar-->
    <nav class="navbar navbar-expand-lg bgnav" style="background-color:#A0ECBA;">
        <div class="container-fluid">
            <a class="navbar-brand bsfont" href="<?=APP_ROOT. '/'?>">
            <img src="<?=PUBLIC_ROOT.'assets/img/logo-beautystyling.jpg'?>" alt="Logo Beauty Styling" width="100"  class="d-inline-block align-text-center">Beauty styling</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?=APP_ROOT.'/'?>" style="font-family: 'DM Serif Display', serif">Accueil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../webapp/historiquedesrendezvous.php" style="font-family: 'DM Serif Display', serif;">Historique</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../webapp/calendrier.php" style="font-family: 'DM Serif Display', serif;">Calendrier</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?=APP_ROOT.'/paniers'?>" style="font-family: 'DM Serif Display', serif;">Mes paniers</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Se déconnecter</a>
                  </li>
                </ul>
            </div>
        </div>
    </nav>
</header>