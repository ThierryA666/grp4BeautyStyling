<header class="container-fluid"><!--Admin Nav Bar-->
    <nav class="navbar navbar-expand-lg bgnav" style="background-color:#A0ECBA;">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?=APP_ROOT.'/'?>" style="font-family: 'DM Serif Display', serif; color: #FF5B76;">
                <img src="<?=PUBLIC_ROOT.'assets/img/logo_beautystyling.jpg'?>" alt="Logo_Beauty Styling" width="100"  class="d-inline-block align-text-center">
                Beauty styling
            </a>  
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="<?=APP_ROOT.'/'?>" style="font-family: 'DM Serif Display', serif">Accueil</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?=APP_ROOT.'/paniers'?>" style="font-family: 'DM Serif Display', serif;">Client</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="../webapp/salon_top.php" style="font-family: 'DM Serif Display', serif;">Inscrire mon salon</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?=APP_ROOT.'/prestations'?>" style="font-family: 'DM Serif Display', serif;">Administration</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#" style="font-family: 'DM Serif Display', serif;">Se connecter</a>
                </li>
                
            </ul>
            </div>
        </div>
    </nav>
</header>