<!--Header-->
<?php
include_once 'header.php';
include_once 'visProfilBedrift.php';
include_once 'connection.php';

/**
 * Visning av profilside, Bedrift
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
</body>
</html>