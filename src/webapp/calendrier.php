<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Linden+Hill&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\..\assets\css\style-calendrier.css">
    
    <title>Calendrier Client</title>
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
                            <a class="nav-link ms-5" aria-current="page" href="calendrier.php">Prendre rendez-vous</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active link ms-5" aria-current="page" href="historiquedesrendezvous.php">Rendez-vous à venir</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link link ms-5" aria-current="page" href="#">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link link ms-5" href="#">Mon compte</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link link ms-5" href="../webapp/clientPaniers.php">Panier</a>
                        </li>
                  
                </ul>
              </div>
            </div>
        </nav>
  </header>

  <main>
    <?php
      function generateCalendar($month, $year) {
          $monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
          $currentDate = new DateTime("$year-$month-01");
          $currentDay = (int)$currentDate->format('j');
          $startDay = (int)$currentDate->format('N') - 1; // Jour de la semaine (1 = lundi, ..., 7 = dimanche)
          $totalDays = (int)$currentDate->format('t');

          echo '<div class="calendar">';
          echo '<div class="calendar__info">';
          echo '<a href="?month=' . (($month == 1) ? 12 : $month - 1) . '&year=' . (($month == 1) ? $year - 1 : $year) . '" class="calendar__prev">&#9664;</a>';
          echo '<div class="calendar__month">' . $monthNames[$month - 1] . '</div>';
          echo '<div class="calendar__year">' . $year . '</div>';
          echo '<a href="?month=' . (($month == 12) ? 1 : $month + 1) . '&year=' . (($month == 12) ? $year + 1 : $year) . '" class="calendar__next">&#9654;</a>';
          echo '</div>';
          echo '<div class="calendar__week">';
          echo '<div class="calendar__day calendar__item">Lu</div>';
          echo '<div class="calendar__day calendar__item">Ma</div>';
          echo '<div class="calendar__day calendar__item">Me</div>';
          echo '<div class="calendar__day calendar__item">Je</div>';
          echo '<div class="calendar__day calendar__item">Ve</div>';
          echo '<div class="calendar__day calendar__item">Sa</div>';
          echo '<div class="calendar__day calendar__item">Di</div>';
          echo '</div>';
          echo '<div class="calendar__dates">';
          for ($i = 0; $i < $startDay; $i++) {
              echo '<div class="calendar__date calendar__item calendar__last-days"></div>';
          }
          for ($i = 1; $i <= $totalDays; $i++) {
              $date = new DateTime("$year-$month-$i");
              $currentDateTime = new DateTime();
              if ($date >= $currentDateTime && $date->format('N') != 6 && $date->format('N') != 7) {
                  // Autoriser uniquement les jours futurs sauf le samedi et le dimanche
                  echo '<a href="..\webapp\rendezvouscoteclient.php?date=' . $year . '-' . $month . '-' . $i . '" class="calendar__date calendar__item">' . $i . '</a>';
              } else {
                  // N'autorisez pas les rendez-vous pour les jours passés ou les samedis et dimanches
                  echo '<div class="calendar__date calendar__item calendar__disabled">' . $i . '</div>';
              }
          }
          echo '</div>';
          echo '</div>';
      }

      $currentMonth = isset($_GET['month']) ? (int)$_GET['month'] : (int)date('n');
      $currentYear = isset($_GET['year']) ? (int)$_GET['year'] : (int)date('Y');

      generateCalendar($currentMonth, $currentYear);
  ?>

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

  <!-- <script src="..\javascript\calendrier.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>