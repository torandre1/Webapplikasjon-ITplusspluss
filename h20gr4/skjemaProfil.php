<?php
/**
 * Viser skjemaet "Opprett profil" til bruker
 * @author Mari
 */

//lagrer skjemadata i cookies 14 dager frem i tid. Må sette disse før HTML elementene begynner.
if (isset($_POST['lagre'])) {
    setcookie("fornavn", $_POST['fornavn'], time() + 3600 * 24 * 14);
    setcookie("etternavn", $_POST['etternavn'], time() + 3600 * 24 * 14);
    setcookie("adr", $_POST['adr'], time() + 3600 * 24 * 14);
    setcookie("tlf", $_POST['tlf'], time() + 3600 * 24 * 14);
    setcookie("jobbtittel", $_POST['jobbtittel'], time() + 3600 * 24 * 14);
    setcookie("linkNettside", $_POST['linkNettside'], time() + 3600 * 24 * 14);
    setcookie("linkGitHub", $_POST['linkGitHub'], time() + 3600 * 24 * 14);
    setcookie("linkLinkedIn", $_POST['linkLinkedIn'], time() + 3600 * 24 * 14);
    setcookie("linkFacebook", $_POST['linkFacebook'], time() + 3600 * 24 * 14);
    setcookie("ommeg", $_POST['ommeg'], time() + 3600 * 24 * 14);
}

include_once 'header.php';
include_once 'insert_profil.php';
include_once 'visProfil.php';

?>
<!--script til å behandle postnummer/poststed hentet fra: https://freak.no/forum/showthread.php?t=125625-->
<script type="text/javascript">
$(function() {
	$('#postnr').change(function() {
		if ( $(this).val() != "" ) {
			$.ajax({
				url  : 'insert_profil.php',
				type : 'POST',
				data : 'postnr='+ $(this).val(),

				success : function(response) {
					$('#poststed').val(response);
				}
			});
		}
	});
});

//script til å unngå å måtte trykke på "Last opp" knapp for filer i skjemaet(alt blir sendt i en lagreknapp til slutt)
$(document).ready(function(){
   $('#bildefil').on('change',function(){
      $('#frilanser').submit();
   });
});
</script>

<?php
settSprak();
?>


<!--Rediger profil siden begynner-->

<!--Bakgrunn-->
  <div class="wrap">
    <div class="container">
    <!--Viser valg av språk-->
    <form method="GET" class="navbar-form navbar-rigth" action="" id="sprak">
    <div class="form-group">
      <select name="sprak" class="form-control" onchange="velgSprak()">
        <option value="no" <?php if (isset($_SESSION['sprak']) && $_SESSION['sprak'] == 'no') {echo "selected";}?>>Norsk</option>
        <option value="en" <?php if (isset($_SESSION['sprak']) && $_SESSION['sprak'] == 'en') {echo "selected";}?>>Engelsk</option>
      </select>
    </div>
  </form>

      <form method="POST" name="frilanser" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        <!--Card Profil-->
        <div class="row">
          <div class="col-md-4">
            <div class="card bg-light mt-3">
              <div class="card-body text-center">
                <div class="card-header mb-3">
                  <!--Legger all synlig skrift i konstanter pga språk-->
                  <h4><?php echo _PROFIL; ?></h4>
                </div>
                <img src="<?php echo $profilbilde ?>" alt="Profil" width="150">
                <h4><?php echo $fornavn . " " . $etternavn ?></h4>
                <p class="card-text text-secondary"><?php echo $jobbtittel ?></p>
                <p class="card-text text-secondary"><?php echo $poststed ?></p>
                <label for="bildefil"><h6><?php echo _BYTTPROFILBILDE; ?>:</h6></label>
                <div class="input-group">
                <input type="file" class="form-control" aria-label="Upload" name="bildefil" size="40" id="bildefil" value="<?php if (isset($_COOKIE['bildefil'])) {echo $_COOKIE['bildefil'];} else {echo "";}?>" accept="image/gif, image/jpeg, image/png"/>
                </div>
              </div>
            </div>
          </div>
          <!--Card Profil slutt-->

          <!--Card Kontaktinfo-->
          <div class="col-md-8">
            <div class="card bg-light mt-3">
              <div class="card-body">
                <div class="card-header text-center mb-3">
                  <h4><?php echo _OPPRETTPROFIL; ?></h4>
                </div>

                <!--Rad 1 - Fornavn, Etternavn-->
                <div class="row">
                  <div class="form-group col-sm-6 mb-3">
                    <label for="fornavn"><h6><?php echo _FORNAVN; ?>:</h6></label>
                    <input type="text" class="form-control" id="fornavn" value="<?php if (isset($_COOKIE['fornavn'])) {echo $_COOKIE['fornavn'];} else {echo "";}?>" placeholder="<?php echo _FORNAVN; ?>"
                     name="fornavn" required>
                  </div>
                  <div class="col-sm-6 mb-3">
                     <label for="etternavn"><h6><?php echo _ETTERNAVN; ?>:</h6></label>
                     <input type="text" class="form-control" id="etternavn" value="<?php if (isset($_COOKIE['etternavn'])) {echo $_COOKIE['etternavn'];} else {echo "";}?>" placeholder="<?php echo _ETTERNAVN; ?>"
                     name="etternavn" required>
                  </div>
                </div><!--Slutt Rad 1-->

                <!--Rad 2 Adresse, Postnr, Poststed-->
                <div class="row">
                  <div class="form-group col-sm-6">
                    <label for="adr"><h6><?php echo _ADRESSE; ?>:</h6></label>
                    <input type="text" class="form-control" id="adr" value="<?php if (isset($_COOKIE['adr'])) {echo $_COOKIE['adr'];} else {echo "";}?>" placeholder="<?php echo _ADRESSE; ?>"
                     name="adr" required>
                  </div>
                  <!--Her skal Sted dukke opp automatisk når man velger postnummer-->
                  <div class="col-sm-3">
                    <label for="postnr"><h6><?php echo _POSTNR; ?>:</h6></label>
                    <input type="text" class="form-control" size="4" id="postnr" placeholder="<?php echo _POSTNR; ?>"
                     name="postnr" required>
                  </div>
                  <div class="col-sm-3">
                     <label for="postnr"><h6><?php echo _POSTSTED; ?>:</h6></label>
                     <input type="text" class="form-control" id="poststed" placeholder="<?php echo _POSTSTED; ?>"
                     name="poststed" readonly="readonly"/>
                  </div>
                </div><!--Slutt Rad 2-->

                <!--Rad 3 - Tlf, Jobbtittel-->
                <div class="row">
                  <div class="form-group mt-3 col-sm-6">
                    <label for="tlf"><h6><?php echo _TLF; ?>:</h6></label>
                    <input type="text" class="form-control" id="tlf" value="<?php if (isset($_COOKIE['tlf'])) {echo $_COOKIE['tlf'];} else {echo "";}?>" placeholder="<?php echo _TLF; ?>"
                     name="tlf" required>
                  </div>
                  <div class="form-group mt-3 col-sm-6">
                    <label for="jobbtittel"><h6><?php echo _JOBBTITTEL; ?>:</h6></label>
                    <input type="text" class="form-control" id="jobbtittel" value="<?php if (isset($_COOKIE['jobbtittel'])) {echo $_COOKIE['jobbtittel'];} else {echo "";}?>" placeholder="<?php echo _JOBBTITTEL; ?>"
                     name="jobbtittel" required>
                  </div>
                </div><!--Slutt Rad 3-->

                <!--Rad 4 - Kompetanse-->
                <div class="row">
                  <div class="col-sm-6 mt-3">
                    <h6><?php echo _KUNNSKAP; ?>:</h6>
                  </div>
                </div><!--Slutt Rad 4-->

                <!--Rad 5-->
                <!--Kategorier i kompetanse etterfulgt av radiobuttons-->
                <div class="row">
                  <div class="form-group col-sm-6">
                    <ul class="list-group">
                    <li class="list-group-item">
                        <h7><?php echo _BACKEND; ?></h7>
                    </li>
                    <li class="list-group-item">
                        <h7><?php echo _FRONTEND; ?></h7>
                    </li>
                    <li class="list-group-item">
                        <h7><?php echo _SYSTEMARKITEKTUR; ?></h7>
                    </li>
                    <li class="list-group-item">
                        <h7><?php echo _TESTING; ?></h7>
                    </li>
                    <li class="list-group-item">
                        <h7><?php echo _DATABASEDESIGN; ?></h7>
                    </li>
                    <li class="list-group-item">
                        <h7><?php echo _UXDESIGN; ?></h7>
                    </li>
                    <li class="list-group-item">
                        <h7><?php echo _DATASIKKERHET; ?></h7>
                    </li>
                    <li class="list-group-item">
                        <h7><?php echo _NETTVERK; ?></h7>
                    </li>
                    <li class="list-group-item">
                        <h7><?php echo _PROSJEKTLEDELSE; ?></h7>
                    </li>

                      <?php
//echo $stringCheckbox;
?>
                    </ul>
                  </div><!--Slutt form-group col-sm-6 -->
                  <!--Prosentvis rangering av kompetanse. Kun denne ene siden som bruker et slikt oppsett,
                  <---derfor er det ikke laget funksjon for dette -->
                  <div class="form-group col-sm-6">
                    <ul class="list-group">
                      <?php
echo $stringRadio;
?>
                    </ul>
                  </div>
                </div><!--Slutt Rad 5-->

                <!--Rad 6 - CV og andre dokumenter-->
                <div class="row">
                  <div class="form-group col mt-3">
                    <label for="cv"><h6><?php echo _CV; ?></h6></label>
                    <div class="input-group">
                    <input type="file" class="form-control" aria-label="Upload" size="40" name="cv" id="cv" value="<?php if (isset($_COOKIE['cv'])) {echo $_COOKIE['cv'];} else {echo "";}?>" accept="application/pdf"/>
                    </div>
                  </div>
                </div><!--Slutt Rad 6-->

                <!--Rad 7 - Nettside-->
                <div class="row">
                  <div class="form-group mt-3 col-sm-6">
                    <label for="nettside"><h6><?php echo _NETTSIDE; ?></h6></label>
                    <input type="text" class="form-control" id="nettside" value="<?php if (isset($_COOKIE['linkNettside'])) {echo $_COOKIE['linkNettside'];} else {echo "";}?>" placeholder="<?php echo _NETTSIDELINK; ?>"
                     name="linkNettside">
                  </div>
                  <!--GitHub-->
                  <div class="form-group mt-3 col-sm-6">
                    <label for="github"><h6><?php echo _GITHUB; ?></h6></label>
                    <input type="text" class="form-control" id="github" value="<?php if (isset($_COOKIE['linkGitHub'])) {echo $_COOKIE['linkGitHub'];} else {echo "";}?>" placeholder="<?php echo _GITHUBLINK; ?>"
                     name="linkGitHub">
                  </div>
                </div><!--Slutt Rad 7-->

                <!--Rad 8 - LinkedIn-->
                <div class="row">
                  <div class="form-group mt-3 col-sm-6">
                    <label for="linkedin"><h6><?php echo _LINKEDIN; ?></h6></label>
                    <input type="text" class="form-control" id="linkedin" value="<?php if (isset($_COOKIE['linkLinkedIn'])) {echo $_COOKIE['linkLinkedIn'];} else {echo "";}?>" placeholder="<?php echo _LINKEDINLINK; ?>"
                     name="linkLinkedIn">
                  </div>
                  <!--Facebook-->
                  <div class="form-group mt-3 col-sm-6">
                    <label for="facebook"><h6><?php echo _FACEBOOK; ?></h6></label>
                    <input type="text" class="form-control" id="facebook" value="<?php if (isset($_COOKIE['linkFacebook'])) {echo $_COOKIE['linkFacebook'];} else {echo "";}?>" placeholder="<?php echo _FACEBOOKLINK; ?>"
                     name="linkFacebook">
                  </div>
                </div><!--Slutt Rad 8-->

                <!--Rad 9 - Om meg-->
                <div class="row">
                  <div class="form-group col mt-3">
                    <label for="ommeg"><h6><?php echo _OMMEG; ?></h6></label>
                    <textarea class="form-control" rows="5" id="ommeg" value="<?php if (isset($_COOKIE['ommeg'])) {echo $_COOKIE['ommeg'];} else {echo "";}?>" placeholder="<?php echo _OMMEG; ?>"
                     name="ommeg"></textarea>
                  </div>
                </div><!--Slutt Rad 9-->

                <!--Rad 10 - Lagre knapp-->
                <div class="row">
                  <div class="form-group col mt-3">
                    <button type="submit" name="lagre" class="btn btn-info"><?php echo _LAGRE; ?></button>
                  </div>
                    <div class="form-group col mt-3">
                    <label for="aktiv"><?php echo _AKTIV; ?></label>
                    <input type="hidden" name="aktiv" value="0" />
                    <input type="checkbox" name="aktiv" value="1" checked>
                  </div>
                  <!--Går gjennom feilmeldingtabellen og skriver ut evt feilmeldinger,
                  dersom ingen feilmelding skrives en melding om vellykket lagring-->
                  <?php
if (isset($_SESSION['feilmelding'])) {
    for ($i = 0; $i <= count($feilmelding); $i++) {
        if (array_key_exists($i, $feilmelding)) {
            ?>
                      <div class="alert alert-danger mt-3 mb-0"><?php echo $feilmelding[$i]; ?></div>
                                      <?php
}
    }
    unset($_SESSION['feilmelding']);
} else if (isset($_SESSION['suksessMelding'])) {?>
                                      <div class="alert alert-success mt-3"><?php echo $_SESSION['suksessMelding']; ?></div>
                                      <?php
unset($_SESSION['suksessMelding']);
}
?>




                </div><!--Slutt Rad 10-->

              </div><!--Slutt card-body-->
            </div><!--Slutt card bg-light mt-3-->
          </div><!--Slutt col-md-8-->
          <!--Card Kontaktinfo slutt-->

        </div><!--Slutt row profil-->
      </form>

    </div>
  </div>

  <!--script til språkvelgeren-->
  <script type="text/javascript">
      function velgSprak() {
        document.getElementById("sprak").submit();
      }
  </script>

</body>
</html>

