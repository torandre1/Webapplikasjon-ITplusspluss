<?php
include_once 'links.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <!-- Bootstrap -->
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
   <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <!-- Main design css-->
  <link rel="stylesheet" href="style.css">
  <title>Velkommen til IT++</title>
</head>
<body>
  <div class="forside-background">
      <div class="forside">
        <h1>Velkommen til it++!</h1>
        <br>
        <p>Finn din nye arbeidsgiver som frilanser eller registrer din bedrift for å finne arbeidstakere!</p>
        <p>Logg inn eller registrer bruker for å få tilgang!</p>
    <div class="logginn-wrapper">
      <a href="<?php echo $logg_inn ?>"><button class="btn btn-success">Logg inn</button></a>
      <a href="<?php echo $registrer_bruker ?>"><button class="btn btn-primary ">Registrer bruker</button></a>
    </div>
  </div>
</div>

</body>
</html>

