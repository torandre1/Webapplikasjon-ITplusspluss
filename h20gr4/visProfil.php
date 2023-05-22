<?php
/**
 * Dette skriptet er ment til å oppdatere visningen av Profil-skriptet, profil.php
 * @author Mari
 */

include_once 'connection.php';
include_once 'funksjoner.php';

$conn = conn();
//henter data fra databasen
$sql = "SELECT *
FROM frilanser AS F INNER JOIN postnr AS P ON F.postnr_postnr = P.postnr
WHERE F.epost = '$_SESSION[epost]'";
$resultat = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($resultat)) {
    $fornavn = $row['fornavn'];
    $etternavn = $row['etternavn'];
    $adr = $row['adresse'];
    $postnr = $row['postnr'];
    $poststed = $row['poststed'];
    $tlf = $row['tlf'];
    $epost = $row['epost'];
    $nettside = $row['linknettside'];
    $github = $row['linkgithub'];
    $linkedin = $row['linklinkedin'];
    $facebook = $row['linkfacebook'];
    $ommeg = $row['ommeg'];
    $jobbtittel = $row['jobbtittel'];
    $profilbildeNavn = $row['profilbilde'];
    $cvNavn = $row['cv'];
    if (empty($profilbildeNavn)) {
        $profilbilde = "bilder/profil.png";
    } else {
        $katalogBilde = 'profilbilder/';
        $profilbilde = $katalogBilde . $profilbildeNavn;
    }

}

if (!$resultat) {
    die('Sql error!' . mysqli_error($conn));
} else {
    disconn($conn);
}
$resultat;

//ny spørring for å vise fagområde og prosent
$conn = conn();
$sql2 = "SELECT *
FROM fagomrade_has_frilanser AS K INNER JOIN fagomrade AS F ON K.fagomrade_kategorinr = F.kategorinr
WHERE K.frilanser_idfrilanser = $_SESSION[idfrilanser]";

$resultat2 = mysqli_query($conn, $sql2);
$string = "";
while ($row = mysqli_fetch_array($resultat2)) {
    $kategorinavn = $row['kategorinavn'];
    $prosent = $row['prosent'];
    //legger info om kompetanse i en variabel som brukes til å vise profilen i profil.php
    $string .= '<p class="mb-0">' . $kategorinavn . '
        <div class="progress mb-3">
        <div class="progress-bar" role="progressbar" style="width:' . $prosent . '%  "aria-valuenow="50" aria-valuemin="0"
        aria-valuemax="100"></div>
        </div>';
}

if (!$resultat2) {
    die('Sql error!' . mysqli_error($conn));
} else {
    disconn($conn);
}
$resultat;

$katalogCV = 'vedleggfrilanser/';
$cv = $katalogCV . $cvNavn;
if (isset($_POST['lastNedCV'])) {
    if (empty($cvNavn)) {
        echo "Ingen CV å vise";
    }
}

?>
<!--Konverterer php variabelen $cv til js-->
<script>
    var cvPath = "<?php echo $cv; ?>";
</script>

