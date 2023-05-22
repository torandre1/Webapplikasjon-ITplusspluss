<?php
include_once 'connection.php'; //koble til databasen
include_once 'funksjoner.php';

/**
 * Dette skriptet er ment til å lagre brukerinput til databasen fra Opprett profil-skjemaet
 * @author Cecille - alt unntatt valg av frilanser/bedrift
 * @author Mari - lagt til valg av frilanser/bedrift
 */

function registrer()
{
    $conn = conn();

    if (isset($_POST['submit'])) {
        //Initierer variablene
        //unngå sql-injection for sikkerthet
        $epost = mysqli_real_escape_string($conn, $_POST['epost']);
        $passord = mysqli_real_escape_string($conn, $_POST['passord']);
        $bekreftpass = mysqli_real_escape_string($conn, $_POST['bekreftpass']);
        $profilValg = $_POST['profilValg'];

        //Error meldinger
        $epostfinnes = $epost . " Epost allerede finnes!";
        $frilanser = $epost . " Du er registrert som frilanser!";
        $bedrift = $epost . " Du er registrert som bedrift!";

        //encryptere passordet
        $encrypt = md5($passord);
        //postnr som er fremmednøkkel kan ikke være tom ved oppretting av bruker
        $defaultPostnr = 3801;

        //finner epost fra enten frilanser tabellen
        $query = "SELECT epost FROM frilanser where epost = '$epost' union select epost from bedrift where epost = '$epost'";
        $result = mysqli_query($conn, $query);

        //hvis email allerede fins
        if ($result->num_rows) {
            //popup alert
            echo '<script type="text/javascript">alert("' . $epostfinnes . '"  )</script>';
        } else if ($passord != $bekreftpass) { //Sjekker om passord og bekreftpass er ulike
            //popup alert
            echo '<script language="javascript">';
            echo 'alert("passord er ikke likt")';
            echo '</script>';
        } else {
            if ($profilValg == "frilanser") {
                //Query til å sette inn informasjon i  tabellen frilanser
                $sql = "INSERT INTO frilanser(epost, passord, fornavn, etternavn, adresse, tlf, jobbtittel, ommeg, profilbilde, cv,
            linknettside, linkgithub, linklinkedin, linkfacebook, postnr_Postnr)" .
                    "VALUES ( '$epost', '$encrypt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$defaultPostnr')";

                //Kjører query
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    //popup alert
                    echo '<script type="text/javascript">alert("' . $frilanser . '"  )</script>';
                    //Videresende til siden loggin.php om 1 sekund
                    header("refresh:1;url=logginn.php");

                } else {
                    //feilmelding: noe gikk galt med sql og kobler av
                    echo 'sql er ikke riktig';
                    disconn($conn);
                }
            } else if ($profilValg == "bedrift") {
                //Query til å sette inn informasjon i tabellen bedrift
                $sql = "INSERT INTO bedrift(epost, passord, org_nr, bedriftsnavn, adresse, tlf, profilbilde, nettsidelink, tittel, beskrivelse, vedlegg, postnr_Postnr)" .
                    "VALUES ( '$epost', '$encrypt', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$defaultPostnr')";

                //kjører query
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    //popup alert
                    echo '<script type="text/javascript">alert("' . $bedrift . '"  )</script>';
                    //Videresende til loggin.php om 1 sekund
                    header("refresh:1;url=logginn.php");

                } else {
                    //feilmelding og kobler av
                    echo 'sql er ikke riktig';
                    disconn($conn);
                }

            }
        }
        skrivTilLogg('registrer', "Ny bruker med epost $epost har registrert seg");
    }

}

registrer();

/*Kilde
tutorial registrer php: https://www.youtube.com/watch?v=gpM9hUKXLgk&list=LL&index=11
header refresh: https://www.sitepoint.com/community/t/can-i-use-the-header-after-echoing-a-statement/296203/3
alert: https://stackoverflow.com/questions/13837375/how-to-show-an-alert-box-in-php
 */
