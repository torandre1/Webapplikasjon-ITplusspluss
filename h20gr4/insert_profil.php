<?php
include_once 'connection.php';
include_once 'funksjoner.php';

/**
 * Dette skriptet er ment til å lagre brukerinput til databasen fra Opprett profil-skjemaet
 * @author Mari
 */

//lager tom tabell der feilmeldingene skal settes inn
$feilmelding = array();

//viser Kompetanse og Prosent med while-loop i skjemaProfil.php og henter det som trengs fra databasen
$conn = conn();
$sql1 = "SELECT *
FROM fagomrade";
$resultat1 = mysqli_query($conn, $sql1);
$kompetanseLengde = mysqli_num_rows($resultat1);
$stringCheckbox = "";
$stringRadio = "";
while ($row = mysqli_fetch_array($resultat1)) {
    $kategoriNr = $row['kategorinr'];
    $kategorinavn = $row['kategorinavn'];
    //henter kategorinavn og bruker navnene i skjemaProfil.php(går ut pga språk)
    $stringCheckbox .= '<li class="list-group-item">
                         <h7>' . $kategorinavn . '</h7>
                         </li>';
    //lister opp prosentvalgene
    $stringRadio .= '<li class="list-group-item">
                      <input type="radio" name="' . "n" . $kategoriNr . '" value="20">
                      <label for="20">20%</label>
                      <input type="radio" name="' . "n" . $kategoriNr . '" value="40">
                      <label for="40">40%</label>
                      <input type="radio" name="' . "n" . $kategoriNr . '" value="60">
                      <label for="60">60%</label>
                      <input type="radio" name="' . "n" . $kategoriNr . '" value="80">
                      <label for="80">80%</label>
                      <input type="radio" name="' . "n" . $kategoriNr . '" value="100">
                      <label for="100">100%</label>
                      </li>';

}
disconn($conn);

//postnr og poststed. poststed vises idet postnr blir skrevet inn
if (isset($_POST['postnr'])) {
    $conn = conn();
    $postnr = $_POST['postnr'];
    $sql2 = "SELECT poststed FROM postnr WHERE postnr = $postnr";
    $resultat2 = mysqli_query($conn, $sql2);
    $rad = mysqli_fetch_assoc($resultat2);
    $poststed = $rad['poststed'];

    if ($rad > 0) {
        echo $poststed . "                                    ";
    } else {
        echo "Ukjent poststed";
        disconn($conn);
    }

}

//setter inn skjemadata i databasen(må endres etter khaled sin loginfunksjon)
if (isset($_POST['lagre'])) {
    //profilbilde-variabler til funksjon settInnDokument
    $filBilde = 'bildefil';
    $katalogBilde = 'profilbilder/';
    settInnDokument($filBilde, $katalogBilde);
    //cv-variabler til funksjon settInnDokument
    $filCV = 'cv';
    $katalogCV = 'vedleggfrilanser/';
    settInnDokument($filCV, $katalogCV);

    $conn = conn();
    //skjemavariabler, input fra bruker
    $fornavn = test_input($_POST['fornavn']);
    $etternavn = test_input($_POST['etternavn']);
    $adr = test_input($_POST['adr']);
    $tlf = test_input($_POST['tlf']);
    if (!is_numeric($tlf) || strlen($tlf) != 8) {
        $feilmelding[2] = "Tlf må være kun tall av lengde 8";
    }
    $jobbtittel = test_input($_POST['jobbtittel']);
    $ommeg = test_input($_POST['ommeg']);
    $profilbilde = $_FILES['bildefil']['name'];
    $cv = $_FILES['cv']['name'];
    $linkNettside = validerURL(test_input($_POST['linkNettside']));
    $linkGitHub = validerURL(test_input($_POST['linkGitHub']));
    $linkLinkedIn = validerURL(test_input($_POST['linkLinkedIn']));
    $linkFacebook = validerURL(test_input($_POST['linkFacebook']));
    $aktiv = $_POST['aktiv'];

    //legger inn verdier i tabellen frilanser
    $sql3 = "UPDATE frilanser
            SET fornavn = '$fornavn',
                etternavn = '$etternavn',
                adresse = '$adr',
                tlf = '$tlf',
                jobbtittel = '$jobbtittel',
                ommeg = '$ommeg',
                profilbilde = '$profilbilde',
                cv = '$cv',
                linknettside = '$linkNettside',
                linkgithub = '$linkGitHub',
                linklinkedin = '$linkLinkedIn',
                linkfacebook = '$linkFacebook',
                aktiv = '$aktiv',
                postnr_Postnr = '$postnr'
            WHERE epost = '$_SESSION[epost]'";

    $resultat3 = mysqli_query($conn, $sql3);
    //tar vare på insert-id, slik at det går an å finne den igjen
    //$id = mysqli_insert_id($conn);

    if (!$resultat3) {
        die('Sql error!' . mysqli_error($conn));

    } else {
        disconn($conn);
    }
    $resultat3;

    settKompetanse();

} //lagre
