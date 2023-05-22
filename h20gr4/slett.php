<?php
@session_start(); //@ gjør at feilmelding ikke vises
if (!$_SESSION['epost']) {
    header("Location: index.php");
}
/**
 * Sletting av bruker
 * @author Mari (oppsett kopiert fra Cecille, endrepass.php)
 */

include_once 'connection.php';
include_once 'funksjoner.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<title>Slett bruker</title>
<!--css fil-->
<link rel="stylesheet" href="Innstilling.css">
</head>
<body>

<header>
    <h3 class="title">it++</h3>
    <p class="subtittel">Slett bruker</p>
    <br>
</header>

<div class="container">
  <p>Du er innlogget som:</p>
      <?php echo "<h4>$_SESSION[epost]<h4>"; ?>
    <p>Vil du virkelig slette denne brukeren?</p>

<?php
if (isset($_SESSION['idbedrift'])) {
    ?>
<input type="submit" name="submit" value="Slett bruker" onclick="location.href='slett_bedrift.php?epost=<?php echo $_SESSION['epost'] ?>'">

	<?php
} else {
    ?>
<input type="submit" name="submit" value="Slett bruker" onclick="location.href='slett_frilanser.php?epost=<?php echo $_SESSION['epost'] ?>'">
<?php
}
?>

</div>
<br>
<br>

<div class="footer">
    <a href="index.php">Gå tilbake til hjemmesiden</a>
</div>

</body>
</html>