<!--@author Cecille -->
<?php
include_once "connection.php";
include_once "funksjoner.php";
session_start();

function endrePassord()
{
//kobler til databasen
    $conn = conn();

//Hvis det ikke kobler til databasen
    if (!$conn) {
        die("fikk ikke koblet til databasen") . mysqli_error($conn);
    }

    if (isset($_POST['submit'])) {

        //initierer variablene
        $passord = md5(mysqli_real_escape_string($conn, $_POST['passord']));
        $nypassord = mysqli_real_escape_string($conn, $_POST['nypassord']);
        $bekreftpassord = mysqli_real_escape_string($conn, $_POST['bekreftpassord']);

        //Sjekker om passord er ulike
        if ($nypassord != $bekreftpassord) {
            echo '<script language="javascript">';
            echo 'alert("Nypassord og bekreftpassord må være like!")';
            echo '</script>';
            header("refresh:1;url=endrepass.php");

        } else {

            //eposten som er brukt i sessionen
            $epost = $_SESSION['epost'];

            //Query til å finne hvilke tabell epost ligger
            $query = "SELECT epost, 'frilanser' as source FROM frilanser WHERE epost='$epost' and passord='$passord' UNION " .
                "SELECT epost, 'bedrift' as source FROM bedrift WHERE epost='$epost' and passord='$passord'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_object($result);

            //Hvis det ikke finner epost i query, finnes ikke eposten
            if (!$result) {
                echo "epost er ikke registrert";

            } else {

                //krypterer det nye passordet
                $nypassord_encrypted = md5($nypassord);

                //henter raden fra tabellen
                $table_name = $row->source;
                $query = "UPDATE " . $table_name . " SET passord = '$nypassord_encrypted' WHERE epost ='$epost' ";
                $output = mysqli_query($conn, $query);
                //echo $query;echo $table_name;
                print_r($output);
                skrivTilLogg('endrePassord', "Bruker med epost $epost har endret passord");
                //brukermelding passord er endret
                echo '<script language="javascript">';
                echo 'alert("Passord er endret!")';
                echo '</script>';
                header("refresh:1;url=endrepass.php");
            }

        }

    }
}
endrePassord();

?>

<!-- Kilder
https://www.studentstutorial.com/php/password-change
hentet ideer på oppsettet i denne siden
https://stackoverflow.com/questions/13837375/how-to-show-an-alert-box-in-php
poppup alert

-->