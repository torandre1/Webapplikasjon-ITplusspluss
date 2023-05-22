<?php
@session_start(); //@ gjør at feilmelding ikke vises
if (!$_SESSION['epost']) {
    header("Location: index.php");
}
include_once 'links.php';
include_once 'logginn_validering.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"
    integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"
    integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG"
    crossorigin="anonymous"></script>
  <script src="hjelpefunksjoner.js" defer></script>
  <!-- Font Awesome-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- Main design css-->
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="omoss.css">
  <title>IT++</title>
</head>
<body>

    <!--Navigasjonsbar-->
    <!--Utviklet og basert på bootstrap eksempel fra: https://getbootstrap.com/docs/5.0/components/navbar/#brand  -->
    <div class="container fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">  <!--wrapper design -->
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo $indexInnlogget ?>">it++</a>  <!--Logo/hjem-knapp -->
            <!--expand/collapse meny -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                Meny
                <span class="navbar-toggler-icon"></span> <!--icon til navbar-toggler-->
            </button>
             <!--Meny -->
             <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                     <li class="nav-item">
                         <a class="nav-link" href="<?php echo $annonse ?>">Profiler</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo $veil ?>">Hjelp</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo $omoss ?>">Om oss</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $kontaktoss ?>">Kontakt oss</a>
                    </li>
                 </ul>
             </div>
             <?php
if (isset($_SESSION['fornavn'])) {
    echo "Velkommen $_SESSION[fornavn]";
} else if (isset($_SESSION['bedriftsnavn'])) {
    echo "Velkommen $_SESSION[bedriftsnavn]";
}
?>
<br>
             <!--Profil og brukerinnstillinger-->
             <div class="dropdown ms-2">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                     <!--Sett inn profil-icon her-->
                     <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                      </svg>
                    </a>

                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <?php
if (isset($_SESSION['idfrilanser'])) {
    ?>
                    <li><a class="dropdown-item" href="<?php echo $vis_profil ?>">Se profil</a></li>
                    <li><a class="dropdown-item" href="<?php echo $rediger_profil ?>">Rediger profil</a></li>
<?php
} else if (isset($_SESSION['idbedrift'])) {
    ?>
                    <li><a class="dropdown-item" href="<?php echo $vis_profil_bedrift ?>">Se profil</a></li>
                    <li><a class="dropdown-item" href="<?php echo $rediger_profil_bedrift ?>">Rediger profil</a></li>
<?php
}
?>
                    <li class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="<?php echo $loggut ?>">Logg ut</a></li>
                </ul>
             </div>
             <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                     <!--Sett inn innstillinger-icon her-->
                     <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                        <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
                      </svg>
                    </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="<?php echo $endre_passord ?>">Endre passord</a></li>
                    <li><a class="dropdown-item" href="<?php echo $slett_bruker ?>">Slett bruker</a></li>
                </ul>
             </div>
        </div>
     </nav>
     </div>

