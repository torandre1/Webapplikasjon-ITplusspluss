<!--Header-->
<?php
include_once 'header.php';
include_once 'connection.php';

/**
 * Visning av profilside i annonser, Bedrift
 * @author Mari
 */
?>

<!--Skript til å åpne dokument i nytt vindu-->
<script type="text/javascript">

  function lastDokument(dokument) {
    window.open(dokument);
    return true;
  }
</script>

<?php

$conn = conn();

//henter data fra tabell bedrift i databasen
$sql = "SELECT *
        FROM bedrift AS B INNER JOIN postnr AS P ON B.postnr_Postnr = P.postnr
        WHERE B.idbedrift = '$_GET[idbedrift]'";
$resultat = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_array($resultat)) {
    //$idbedrift = $row['idbedrift'];
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

?>


  <!--Bakgrunn-->
    <div class="wrap">

      <!--Starter med container, deler opp alle seksjoner i en rad, etterfulgt av kolonner.
      Setter profil, nettverk, kompetanse og om meg til lengde lik halvparten av Kontaktinfo-kolonnen-->

      <div class="container">
        <div class="row">

          <!--Card Profil-->
          <div class="col-md-4">
            <div class="card bg-light mt-3">
              <div class="card-body text-center">
                <div class="card-header mb-3">
                  <h4>Profil</h4>
                </div>
                <img src="<?php echo $profilbilde ?>" alt="Profil" width="150">
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


          <!--Card Kontaktinfo-->
          <!--lengden blir dobbelt så lang som Profil og Nettverk-->
          <div class="col-md-8">
            <div class="card bg-light mt-3">
              <div class="card-body">
                <div class="card-header text-center mb-3">
                  <h4>Annonse</h4>
                </div>
                  <div class="text-center"><h4><?php echo $tittel ?></h4></div>
                  <?php echo $beskrivelse ?>
                  <br>
                  <!--henter dokument i nytt vindu-->
                  <input type="submit" class="btn btn-info mt-3" value="Last ned vedlegg" name="lastNedVedlegg" onclick="lastDokument(docPath)">



              </div>
            </div>
          </div>
          <!--Card Annonse slutt-->

        </div>
      </div>
    </div>


<?php

if (!$resultat) {
    die('Sql error!' . mysqli_error($conn));
} else {
    disconn($conn);
}
$resultat;

//viser vedlegg
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

</body>
</html>
