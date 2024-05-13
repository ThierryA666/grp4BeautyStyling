<header>
        <nav class="navbar navbar-expand-lg" style="background-color:#A0ECBA;">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?=APP_ROOT?>" style="font-family: 'DM Serif Display', serif; color: #FF5B76;">
                    <img src="/assets/img/logo_beautystyling.jpg" alt="Logo_Beauty Styling" width="100"  class="d-inline-block align-text-center">
                    Beauty styling
                </a>  
              
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse d-md-flex justify-content-md-end" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?=APP_ROOT?>" style="font-family: 'DM Serif Display', serif">Accueil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?=APP_ROOT.'/salon/profile?id_salon='.$salon->getId_salon()?>" style="font-family: 'DM Serif Display', serif;">Infos salon</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?=APP_ROOT.'/salon/gestionnaire?id_salon='.$salon->getId_salon()?>" style="font-family: 'DM Serif Display', serif;">Gestionnaire de salon</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?=APP_ROOT.'/salon/logout'?>" style="font-family: 'DM Serif Display', serif;">Se deconnecter (Compte salon)</a>
                  </li>
                  
                </ul>
              </div>
            </div>
          </nav>
    </header>