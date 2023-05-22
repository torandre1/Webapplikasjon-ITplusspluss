<!--Header-->
<?php
include_once 'header.php';
include_once 'visProfil.php';
include_once 'connection.php';

/**
 * Visning av profilside
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
  <div class="box2">
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
                <h4><?php echo $fornavn . " " . $etternavn ?></h4>
                <p class="card-text text-secondary"><?php echo $jobbtittel ?></p>
                <p class="card-text text-secondary"><?php echo $poststed ?> </p>
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
                  <h4>Kontaktinfo</4>
                </div>
                <!--Rad 1-->
                <div class="row">
                  <!--Deler opp i to kolonner-->
                  <div class="col-sm-3">
                    <h6>Fornavn</h6>
                  </div>
                  <div class="col-sm-9 text-secondary"><?php echo $fornavn ?></div>
                </div>
                <hr>
                <!--Rad 2-->
                <div class="row">
                  <div class="col-sm-3">
                    <h6>Etternavn</h6>
                  </div>
                  <div class="col-sm-9 text-secondary"><?php echo $etternavn ?></div>
                </div>
                <hr>
                <!--Rad 3-->
                <div class="row">
                  <div class="col-sm-3">
                    <h6>Adresse</h6>
                  </div>
                  <div class="col-sm-9 text-secondary"><?php echo $adr . ", " . $postnr . " " . $poststed ?></div>
                </div>
                <hr>
                <!--Rad 4-->
                <div class="row">
                  <div class="col-sm-3">
                    <h6>Tlf</h6>
                  </div>
                  <div class="col-sm-9 text-secondary"><?php echo $tlf ?></div>
                </div>
                <hr>
                <!--Rad 5-->
                <div class="row">
                  <div class="col-sm-3">
                    <h6>E-post</h6>
                  </div>
                  <div class="col-sm-9 text-secondary"><a href="mailto:<?php echo $epost ?>"><?php echo $epost ?></a></div>
                </div>
                <hr>

              </div>
            </div>
          </div>
          <!--Card Kontaktinfo slutt-->


          <!--Card Nettverk-->
          <div class="col-md-4">
            <div class="card bg-light mt-3">
              <div class="card-body text-center">
                <div class="card-header mb-3">
                  <h4>Nettverk</h4>
                </div>
                <!--Rad 1-->
                <div class="row">
                  <div class="col-sm-3">
                    <h4><i class="fas fa-globe"></i></h4>
                  </div>
                  <div class="col-sm-9 text-secondary"><a href="<?php echo $nettside ?>">Min nettside</a></div>
                </div>
                <hr>
                <!--Rad 2-->
                <div class="row">
                  <div class="col-sm-3">
                    <h4><i class="fab fa-github-square"></i></h4>
                  </div>
                  <div class="col-sm-9 text-secondary"><a href="<?php echo $github ?>">Finn meg på GitHub</a></div>
                </div>
                <hr>
                <!--Rad 3-->
                <div class="row">
                  <div class="col-sm-3">
                    <h4><i class="fab fa-linkedin"></i></h4>
                  </div>
                  <div class="col-sm-9 text-secondary"><a href="<?php echo $linkedin ?>">Finn meg på LinkedIn</a></div>
                </div>
                <hr>
                <!--Rad 3-->
                <div class="row">
                  <div class="col-sm-3">
                    <h4><i class="fab fa-facebook-square"></i></h4>
                  </div>
                  <div class="col-sm-9 text-secondary"><a href="<?php echo $facebook ?>">Finn meg på Facebook</a></div>
                </div>
                <hr>

              </div>
            </div>
          </div>
          <!--Card Nettverk slutt-->



          <!--Card Kompetanse-->
          <div class="col-md-4">
            <div class="card bg-light mt-3">
              <div class="card-body text-center">
                <div class="card-header mb-3 text-center">
                  <h4>Kompetanse</h4>
                </div>
                <!--henter string fra visProfil.php og skriver ut-->
                <?php
echo $string;
?>
                <!--henter dokument i nytt vindu-->
                <input type="submit" class="btn btn-info" value="Last ned CV" name="lastNedCV" onclick="lastDokument(cvPath)">
              </div>
            </div>
          </div>
          <!--Card Kompetanse slutt-->





          <!--Card Om meg-->
          <div class="col-md-4">
            <div class="card bg-light mt-3">
              <div class="card-body">
                <div class="card-header text-center mb-3">
                  <h4>Om meg</h4>
                </div>
                <p class="fst-italic"><?php echo $ommeg ?>
                </p>
              </div>
            </div>
          </div>
          <!--Card Om meg slutt-->

        </div>
      </div>
    </div>
  </div>
</body>
</html>