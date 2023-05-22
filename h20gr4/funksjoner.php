<?php

/**
 * Samling av funksjoner til bruk på nettsiden
 * @author Mari
 * @param $data - input data fra bruker
 * @param $url - input url fra bruker
 * @param $fil - navn på fil fra HTML-skjemaet, f.eks bildefil fra: input type="file" name="bildefil"
 * @param $kat - katalogen filen skal legges i
 * @param $submit - variabel for knappen "Last opp fil"
 * @param $id - brukerens id
 * @param $funksjon - funksjonen som skal skrives til fil
 * @param $melding - melding som beskriver handlingen som har blitt utført
 */

include_once "connection.php";

//funksjon for testing av inndata
function test_input($data)
{
    //sjekker først om input er satt,
    //htmlspecialchars-funksjonen konverterer til HTML-elementer
    if (isset($data)) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    } else {
        print "Feltet kan ikke være tomt";
    }
}

//Funksjon for å validere URL, sjekker om den er gyldig. Sjekker også om URL-stringen inneholder http, legger til hvis ikke.
//Valgte http:// og ikke https:// fordi mange sider fortsatt har http://
function validerURL($url)
{
    //sjekker om url er gyldig
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $url)) {
        $feilmelding[3] = "Ugyldig URL";
    }

    if (strpos($url, 'http') === false) {
        $url = 'http://' . $url;
    }
    return $url;
}

//sett inn dokumenter, modifisert fra leksjon 7 i APP2000
function settInnDokument($fil, $kat)
{
    if (isset($_POST['lagre'])) {
        $filnavn = $_FILES[$fil]['name'];
        if (empty($filnavn)) {
            $feilmelding[4] = "Filnavn er ikke valgt!";
        } else {
            $tmp = $_FILES[$fil]['tmp_name'];
            $filnavn = $kat . $_FILES[$fil]['name'];
            if ($filnavn || !$filnavn) {
                copy($tmp, $filnavn) or die('Kopiering feilet/filen eksisterer fra før!');
            }

        }

        $katRef = opendir($kat);
        $bilde = readdir($katRef);
        while ($bilde) {
            $bildefil = $kat . $bilde;
            $bilde = readdir($katRef);
        }

    }
    skrivTilLogg('settInnDokument', "Filen $fil ble lagt på server i katalogen $kat");

}

//funksjon for innsetting av flere filer
function settInnFlereDokumenter($submit, $fil, $kat)
{
    if (isset($_POST[$submit])) {
        //teller antall filer
        $antFiler = count($_FILES[$fil]['name']);

        for ($i = 0; $i < $antFiler; $i++) {
            $filnavn = $_FILES['file']['name'][$i];

            if (empty($filnavn)) {
                print('<p>Filnavn er ikke valgt!</p>');
            } else {
                //funker ikke på itfag
                move_uploaded_file($_FILES[$fil]['tmp_name'][$i], $kat . $filnavn);
            }
        }
    }
}

//sjekker om bruker finnes i frilanser-tabellen
function erFrilanser($id)
{
    $sql = "SELECT *
    FROM frilanser
    WHERE idfrilanser = '$id'";

    $conn = conn();
    $resultat = mysqli_query($conn, $sql);
    $rad = mysqli_num_rows($resultat);

    if ($rad > 0) {
        return true;
    }

    if (!$resultat) {
        die('Sql error!' . mysqli_error($conn));
    } else {
        disconn($conn);
    }

}

//sjekker om bruker finnes i bedrift-tabellen
function erBedrift($id)
{
    $sql = "SELECT *
    FROM bedrift
    WHERE idbedrift = '$id'";

    $conn = conn();
    $resultat = mysqli_query($conn, $sql);
    $rad = mysqli_num_rows($resultat);

    if ($rad > 0) {
        return true;
    }

    if (!$resultat) {
        die('Sql error!' . mysqli_error($conn));
    } else {
        disconn($conn);
    }

}

//henter inndata fra bruker(prosentverdi i kompetanse) og setter verdier, eller oppdaterer,
//i tabell fagomrade_has_frilanser i databasen
function settKompetanse()
{
    $conn = conn();
    //finner først lengden av tabellen fagomrade
    $sql = "SELECT *
            FROM fagomrade";
    $resultat = mysqli_query($conn, $sql);
    $kompetanseLengde = mysqli_num_rows($resultat);
    //for hver prosent som er valgt i skjemaet, sjekker om det allerede ligger verdier på kompetansen
    //som tilhører prosenten og oppdaterer, setter inn hvis ikke
    for ($i = 1; $i <= $kompetanseLengde; $i++) {
        if (isset($_POST['n' . $i])) {

            $sql1 = "SELECT *
            FROM fagomrade_has_frilanser AS K INNER JOIN fagomrade AS F ON K.fagomrade_kategorinr = F.kategorinr";

            $conn = conn();
            $resultat1 = mysqli_query($conn, $sql1);
            while ($row = mysqli_fetch_array($resultat1)) {
                $kategoriNr = $row['kategorinr'];
                $prosentDB = $row['prosent'];
                $prosent = test_input($_POST['n' . $i]);

                if ($i == $kategoriNr) {
                    $sql4 = "UPDATE fagomrade_has_frilanser
                    SET prosent = '$prosent'
                    WHERE fagomrade_kategorinr = '$i' AND frilanser_idfrilanser = $_SESSION[idfrilanser]";
                    $conn = conn();
                    $resultat4 = mysqli_query($conn, $sql4);
                } else {
                    $sql4 = "INSERT INTO fagomrade_has_frilanser(fagomrade_kategorinr, frilanser_idfrilanser, prosent) VALUES
                ('$i', '$_SESSION[idfrilanser]', '$prosent')";
                    $conn = conn();
                    $resultat4 = mysqli_query($conn, $sql4);
                }
            }
            skrivTilLogg('settKompetanse', "Bruker $_SESSION[idfrilanser] har satt inn eller oppdatert kategorinr $kategoriNr med $prosent prosent");
        }
    }
}

//setter språkvariabler
function settSprak()
{
    //sjekker først hvilket språk som er valgt og legger det i en sesjon
    if (isset($_GET['sprak']) && !empty($_GET['sprak'])) {
        $_SESSION['sprak'] = $_GET['sprak'];
        //hvis ikke det er det valgte språket, oppdater siden
        if (isset($_SESSION['sprak']) && $_SESSION['sprak'] != $_GET['sprak']) {
            echo '<script language="javascript">';
            location . reload();
            echo '</script>';
        }
    }
//dersom en språk-sesjon er satt, må include-filen inkluderes. (Norsk er standardspråk)
    if (isset($_SESSION['sprak'])) {
        include "includes/sprak/" . $_SESSION['sprak'] . ".php";
    } else {
        include "includes/sprak/no.php";
    }
}

// Skriver data om en forespørsel til en logg-tabell - hentet fra APP2000 Leksjon 8
function skrivTilLogg($funksjon, $melding)
{
    $loggfil = "logg.txt";
    $fh = fopen($loggfil, 'a')
    or die("Klarte ikke å skrive til loggfil.");

    date_default_timezone_set('UTC');
    $tid = date('d.m.Y H:i:s');

    fwrite($fh, $tid . ' Funksjon: ' . $funksjon . ' => ' . $melding . "\n");
    fclose($fh);
}

//arbeidsfunksjon
function dumpInnhold($var)
{
    echo "<pre>";
    echo print_r($var);
    echo "</pre>";
}
