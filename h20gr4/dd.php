<?php
@session_start(); //@ gjør at feilmelding ikke vises
if (!$_SESSION['epost']) {
    header("Location: index.php");
}
?>
<form class="C" method="POST">

 <input class="A" type="text" name="verdi" placeholder="Søk etter bedrift, adresse eller jobtittel"><br><br>
 <button  class="B"type="submit" name="sok"> sok</button>
       </form>
 <?php
$mysqli = new mysqli("itfag.usn.no", "h20APP2000gr4", "pw4", "h20APP2000grdb4");

if (isset($_POST['sok']) and !empty($_POST['verdi'])) {

    $verdi = ($_POST['verdi']);
    $query = "SELECT * FROM bedrift WHERE bedriftsnavn LIKE '%$verdi%' OR adresse LIKE '%$verdi%' OR beskrivelse LIKE
     '%$verdi%' OR tittel LIKE '%$verdi%'   ";

    $search_result = mysqli_query($mysqli, $query);
    $antallResultater = mysqli_num_rows($search_result);

    if ($antallResultater <= 0) {

        ?>
    <div class="C"><?php echo "Ingen treff"; ?></div>
   <?php

    } else {
        $number = 1;

        while ($row = mysqli_fetch_assoc($search_result)) {?>



   <a href="infob.php?idbedrift=<?php echo $row["idbedrift"]; ?>"><div class="D">
                    <p><b><?php echo $number, " - ", $row['bedriftsnavn']; ?> - </b></p>
                    <p><b> &ensp; Adresse :</b> <?php echo $row['adresse']; ?></p>
                    <p><b> &ensp;Stilling :</b> <?php echo $row['tittel']; ?></p>

                </div>

               <?php ++$number;?>

    </a>


<?php }

    }

} else if (isset($_POST['sok']) and empty($_POST['verdi'])) {
    ?>
    <div class="C"><?php echo "Du må skrive minst et ord"; ?></div>
   <?php
}

?>

<style >

   .A{
  padding: 10px;

  border: 1px solid grey;

  width: 40%;
font-size: 25px;
  background: #f1f1f1;
}

.B {
  float: left;
  width: 10%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 25px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}
.C {
    display: flex;
  justify-content: center;
  height:60px;
font-size: 35px;


}
.D {
    display: flex;
  justify-content: left;
  height:60px;
font-size: 35px;
 padding-bottom: 25px;





}
p{
 color: #483D8B;
}


</style>



