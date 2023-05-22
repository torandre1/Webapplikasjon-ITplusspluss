<?php
/**
 * Viser en liste over klikkbare miniatyrprofiler, alle aktive profiler i databasen.
 * Klikket fører videre til fullstendig aktuell profil
 * @author Mari
 */

include_once 'header.php';
include_once 'connection.php';

//viser frilansere
$conn = conn();

$sql = "SELECT * FROM frilanser AS F INNER JOIN postnr AS P ON F.postnr_Postnr = P.postnr
        WHERE F.aktiv = 1";
$resultat = mysqli_query($conn, $sql);
$rad = mysqli_num_rows($resultat);

while ($row = mysqli_fetch_array($resultat)) {
    $idfrilanser = $row['idfrilanser'];
    $epost = $row['epost'];
    $fornavn = $row['fornavn'];
    $etternavn = $row['etternavn'];
    $poststed = $row['poststed'];
    $jobbtittel = $row['jobbtittel'];
    $profilbildeNavn = $row['profilbilde'];
    if (empty($profilbildeNavn)) {
        $profilbilde = "bilder/profil.png";
    } else {
        $katalogBilde = 'profilbilder/';
        $profilbilde = $katalogBilde . $profilbildeNavn;
    }

    ?>


<!--Card Profil Frilanser-->
<div class="col-md-4 wrap2">
            <div class="card bg-light mt-3">
              <div class="card-body text-center">
                <div class="card-header mb-3">
                  <h4>Profil</h4>
                </div>
                <!--Gjør bildet klikkbart og sender videre til å vise den aktuelle profilen i sin helhet-->
                <a href="profilAnnonseFrilanser.php?idfrilanser=<?php echo $idfrilanser; ?>">
                <img src="<?php echo $profilbilde ?>" alt="Profil" width="150"></a>
                <h4><?php echo $fornavn . " " . $etternavn ?></h4>
                <p class="card-text text-secondary"><?php echo $jobbtittel ?></p>
                <p class="card-text text-secondary"><?php echo $poststed ?> </p>
              </div>
            </div>
          </div>
          <!--Card Profil slutt-->

<?php
}

if (!$resultat) {
    die('Sql error!' . mysqli_error($conn));
} else {
    disconn($conn);
}
$resultat;

//viser bedrifter
$conn = conn();

$sql2 = "SELECT * FROM bedrift AS B INNER JOIN postnr AS P ON B.postnr_Postnr = P.postnr
        WHERE B.aktiv = 1";
$resultat2 = mysqli_query($conn, $sql2);
$rad = mysqli_num_rows($resultat2);

while ($row = mysqli_fetch_array($resultat2)) {
    $idbedrift = $row['idbedrift'];
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

    ?>


          <!--Card Profil Bedrift-->
          <div class="col-md-4 wrap2">
            <div class="card bg-light mt-3">
              <div class="card-body text-center">
                <div class="card-header mb-3">
                  <h4>Profil</h4>
                </div>
                <a href="profilAnnonseBedrift.php?idbedrift=<?php echo $idbedrift; ?>">
                <img src="<?php echo $profilbilde ?>" alt="Profil" width="150"></a>
                <h2><?php echo $tittel ?></h2>
                <h5><?php echo $bedriftsnavn ?></h5>
                <p class="card-text text-secondary"><?php echo $orgnr ?></p>
                <p class="card-text text-secondary"><?php echo $tlf ?></p>
                <p class="card-text text-secondary"><?php echo $poststed ?> </p>
                <p class="card-text text-secondary"><a href="mailto:<?php echo $epost ?>"><?php echo $epost ?></a></p>
                <p class="card-text text-secondary"><a href="<?php echo $nettside ?>"><?php echo $nettside ?></a></p>
              </div>
            </div>
          </div>
          <!--Card Profil slutt-->

<?php
}

if (!$resultat2) {
    die('Sql error!' . mysqli_error($conn));
} else {
    disconn($conn);
}
$resultat2;

?>


  </body>
</html>