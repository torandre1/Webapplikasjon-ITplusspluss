<?php

/**
 * Validering av logg inn
 * @author Mari
 */

include_once 'connection.php';
include_once 'funksjoner.php';
@session_start(); //@ gjør at feilmelding ikke vises

function loggInn()
{
    $conn = conn();
    if (isset($_POST['epost'])) {
        //unngå sql-injection for sikkerhet
        $epost = mysqli_real_escape_string($conn, $_POST['epost']);
    }
    if (isset($_POST['passord'])) {
        $passord = mysqli_real_escape_string($conn, $_POST['passord']);
        //krypterer passordet(fikk ikke til å bruke password_hash/verify_password på itfag sin server,
        //ellers ville vi ha brukt denne pga større sikkerhet)
        $passord = md5($passord);
    }

    if (isset($_POST['submit'])) {
        //spørring etter epost til frilanser tabell
        $sqlF = "SELECT * FROM frilanser
    WHERE epost = '$epost' ";
        $resultatF = mysqli_query($conn, $sqlF);
        $rowF = mysqli_num_rows($resultatF);
        $radF = mysqli_fetch_assoc($resultatF);

        //spørring etter epost til bedrift tabell
        $sqlB = "SELECT * FROM bedrift
    WHERE epost = '$epost'";
        $resultatB = mysqli_query($conn, $sqlB);
        $rowB = mysqli_num_rows($resultatB);
        $radB = mysqli_fetch_assoc($resultatB);

        //ser etter treff på epost først i tabell frilanser og sjekker om passord er likt som i databasen
        if ($rowF == 1 && $radF['passord'] == $passord) {
            //oppretter sesjonsvariabler
            $_SESSION['idfrilanser'] = $radF['idfrilanser'];
            $_SESSION['epost'] = $radF['epost'];
            $_SESSION['encrypted_passord'] = $radF['passord'];
            $_SESSION['fornavn'] = $radF['fornavn'];
            //oppretter sesjon for tidsbegrensning på innlogging(default er 30min inaktivitet)
            $_SESSION['timeout'] = time();
            //skriver til logg med epost fra frilanser
            skrivTilLogg('loggInn', "Bruker med epost $_SESSION[epost] har logget inn");
            echo '<script language="javascript">';
            echo 'alert("it++ bruker informasjonskapsler (cookies) kun til skjemaoppdateringer. Dersom du godtar dette, kan du fortsette å bruke nettsiden vår som vanlig")';
            echo '</script>';
            header("refresh:1;url=indexInnlogget.php");
            //gjør det samme i bedrift-tabellen
        } else if ($rowB == 1 && $radB['passord'] == $passord) {
            $_SESSION['idbedrift'] = $radB['idbedrift'];
            $_SESSION['epost'] = $radB['epost'];
            $_SESSION['passord'] = $radB['passord'];
            $_SESSION['bedriftsnavn'] = $radB['bedriftsnavn'];
            $_SESSION['timeout'] = time();
            //skriver til logg med epost fra bedrift
            skrivTilLogg('loggInn', "Bruker med epost $_SESSION[epost] har logget inn");
            echo '<script language="javascript">';
            echo 'alert("it++ bruker informasjonskapsler (cookies) kun til skjemaoppdateringer. Dersom du godtar dette, kan du fortsette å bruke nettsiden vår som vanlig")';
            echo '</script>';
            header("refresh:1;url=indexInnlogget.php");
        } else {

            echo "uglydig passord eller brukernavn";

            disconn($conn);
        }
    }

}

loggInn();
