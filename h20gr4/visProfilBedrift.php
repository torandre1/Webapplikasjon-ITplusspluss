<?php
/**
 * Dette skriptet er ment til å oppdatere visningen av Profil-skriptet, profilBedrift.php
 * @author Mari
 */

include_once 'connection.php';
include_once 'funksjoner.php';

$conn = conn();

//henter data fra tabell bedrift i databasen
$sql = "SELECT *
FROM bedrift AS B INNER JOIN postnr AS P ON B.postnr_postnr = P.postnr
WHERE B.epost = '$_SESSION[epost]'";
$resultat = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($resultat)) {
    $orgnr = $row['org_nr'];
    $bedriftsnavn = $row['bedriftsnavn'];
    $adr = $row['adresse'];
    $tlf = $row['tlf'];
    $profilbildeNavn = $row['profilbilde'];
    $nettside = $row['nettsidelink'];
    $tittel = $row['tittel'];
    $beskrivelse = $row['beskrivelse'];
    $vedlegg = $row['vedlegg'];
    $postnr = $row['postnr'];
    $poststed = $row['poststed'];
    $epost = $row['epost'];
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

$katalogVedlegg = 'vedleggbedrift/';
$vedlegg = $katalogVedlegg . $vedlegg;
if (isset($_POST['lastNedVedlegg'])) {
    if (empty($vedlegg)) {
        echo "Ingen vedlegg å vise";
    }
}

?>
<!--Konverterer php variabelen $vedlegg til js-->
<script>
    var docPath = "<?php echo $vedlegg; ?>";
</script>