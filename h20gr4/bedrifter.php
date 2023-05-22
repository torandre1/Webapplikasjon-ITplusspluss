<?php
@session_start(); //@ gjør at feilmelding ikke vises
if (!$_SESSION['epost']) {
    header("Location: index.php");
}
?>


<?php
include_once 'dd.php';
$mysqli = new mysqli("itfag.usn.no", "h20APP2000gr4", "pw4", "h20APP2000grdb4");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

$query = "SELECT idbedrift,bedriftsnavn, profilbilde,tittel,beskrivelse,adresse,tlf FROM bedrift WHERE aktiv =1 ";
$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {?>
	<?php $link = "https://itfag.usn.no/grupper/h20gr4/profilbilder/"?>

	<div class="header"><?php echo $row["bedriftsnavn"]; ?></div>

	<a href="infob.php?idbedrift=<?php echo $row["idbedrift"]; ?>"><div class="containe">
	<img  src=<?php echo $link . $row["profilbilde"]; ?>>
    <p class="pp"><b>Beskrivelse:  </b><?php echo $row["beskrivelse"]; ?></p>
    </div>
    </a>





<div class="containe">
	<div class="item"><b>Stilling:  </b>  <?php echo $row["tittel"]; ?></div>
	<div ><b>Adresse:  </b><?php echo $row["adresse"]; ?></div>
	<div ><b>Tlf:  </b><?php echo $row["tlf"]; ?></div>

</div>





<?php }

?>

<style>
	a{
		text-decoration: none;
	}
	img {
  width: 150px;
  height: 150px;
}


.pp {

  color: black;
  font-family: Georgia;
  font-size: 100%;

  padding-left: 30px;


}
div {

  color: black;
  font-family: arial;
  font-size: 100%;

  padding-left: 30px;


}
.containe {

border-top: 1px solid gray;
display: flex;


}

.item {

  flex-basis: 600px;
  height: 20px;
  margin: 5px;




      }
      .header {

  background-color: powderblue;
  color: black;
  font-family: verdana;
  font-size: 300%;
  font-weight: bold;
  padding-left: 10px;

}
</style>

