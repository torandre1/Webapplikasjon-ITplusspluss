<?php
include_once 'connection.php';
include_once 'funksjoner.php';

/**
 * Dette skriptet er ment til å lagre brukerinput til databasen fra Opprett annonse-skjemaet
 * @author Mari
 */

//lager tom tabell der feilmeldingene skal settes inn
$feilmelding = array();

//Postnr og poststed. Poststed vises idet postnr blir skrevet inn
if (isset($_POST['postnr'])) {
    $conn = conn();
    $postnr = $_POST['postnr'];
    $sql = "SELECT poststed FROM postnr WHERE postnr = $postnr";
    $resultat = mysqli_query($conn, $sql);
    $rad = mysqli_fetch_assoc($resultat);
    $poststed = $rad['poststed'];

    if ($rad > 0) {
        echo $poststed . "                                    ";
    } else {
        echo "Ukjent poststed";
    }
    disconn($conn);
}

//setter inn skjemadata i databasen
if (isset($_POST['lagre'])) {
    //profilbilde-variabler til funksjon settInnDokument
    $filBilde = 'bildefil';
    $katalogBilde = 'profilbilder/';
    settInnDokument($filBilde, $katalogBilde);
    //vedlegg-variabler til funksjon settInnDokument
    $filVedlegg = 'vedlegg';
    $katalogVedlegg = 'vedleggbedrift/';
    settInnDokument($filVedlegg, $katalogVedlegg);

    $conn = conn();
    $orgnr = test_input($_POST['orgnr']);
    //sjekker at org.nr er tall og av lengde 9
    if (!is_numeric($orgnr) || strlen($orgnr) != 9) {
        $feilmelding[1] = "Organisasjonsnummer må være kun tall av lengde 9";
    }
    $orgnavn = test_input($_POST['orgnavn']);
    $adr = test_input($_POST['adr']);
    $tlf = test_input($_POST['tlf']);
    if (!is_numeric($tlf) || strlen($tlf) != 8) {
        $feilmelding[2] = "Tlf må være kun tall av lengde 8";
    }
    $nettside = test_input($_POST['nettside']);
    $nettside = validerURL($nettside);
    $tittel = test_input($_POST['tittel']);
    $profilbilde = $_FILES['bildefil']['name'];
    $vedlegg = $_FILES['vedlegg']['name'];
    $beskrivelse = test_input($_POST['beskrivelse']);
    $aktiv = $_POST['aktiv'];

    //ser etter feilmeldinger, dersom ingen, utfør spørring
    if (count($feilmelding) > 0) {
        $_SESSION['feilmelding'] = $feilmelding;
    } else {
        //legger inn verdier i tabellen bedrift
        $sql2 = "UPDATE bedrift
            SET org_nr = '$orgnr',
                bedriftsnavn = '$orgnavn',
                adresse = '$adr',
                tlf = '$tlf',
                profilbilde = '$profilbilde',
                nettsidelink = '$nettside',
                tittel = '$tittel',
                beskrivelse = '$beskrivelse',
                vedlegg = '$vedlegg',
                aktiv = '$aktiv',
                postnr_Postnr = '$postnr'
            WHERE epost = '$_SESSION[epost]'";

        $resultat2 = mysqli_query($conn, $sql2);
        //legger Vellyket lagring i egen sessionvariabel(trenger kun en av denne)
        $_SESSION['suksessMelding'] = "Vellykket lagring av skjema";
        //header("Location: skjemaProfilBedrift.php");

        if (!$resultat2) {
            die('Sql error!' . mysqli_error($conn));
            disconn($conn);
        } else {
            disconn($conn);
        }
    }
}
