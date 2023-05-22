<?php
/**
 * Viser skjemaet "Opprett profil" til bruker
 * @author Mari
 */
//lagrer skjemadata i cookies 14 dager frem i tid. Må sette disse før HTML elementene begynner.
if (isset($_POST['lagre'])) {
    setcookie("orgnavn", $_POST['orgnavn'], time() + 3600 * 24 * 14);
    setcookie("orgnr", $_POST['orgnr'], time() + 3600 * 24 * 14);
    setcookie("adr", $_POST['adr'], time() + 3600 * 24 * 14);
    setcookie("tlf", $_POST['tlf'], time() + 3600 * 24 * 14);
    setcookie("nettside", $_POST['nettside'], time() + 3600 * 24 * 14);
    setcookie("tittel", $_POST['tittel'], time() + 3600 * 24 * 14);
    setcookie("beskrivelse", $_POST['beskrivelse'], time() + 3600 * 24 * 14);
    setcookie("bildefil", $_FILES['bildefil']['name'], time() + 3600 * 24 * 14);
    setcookie("vedlegg", $_FILES['vedlegg']['name'], time() + 3600 * 24 * 14);
}

include_once 'header.php';
include_once 'insert_profil_bedrift.php';
include_once 'visProfilBedrift.php';

?>

<!--script til å behandle postnummer/poststed hentet fra: https://freak.no/forum/showthread.php?t=125625-->
<script type="text/javascript">
$(function() {
	$('#postnr').change(function() {
		if ( $(this).val() != "" ) {
			$.ajax({
				url  : 'insert_profil_bedrift.php',
				type : 'POST',
				data : 'postnr='+ $(this).val(),

				success : function(response) {
					$('#poststed').val(response);
				}
			});
		}
	});
});

//script til å unngå å måtte trykke på "Last opp" knapp for filer i skjemaet
$(document).ready(function(){
   $('#bildefil').on('change',function(){
      $('#bedrift').submit();
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

      <!--PHP_SELF returnerer filen til scriptet som vi er på for øyeblikket. Bruker htmlspecialchars for å unngå injisering-->
      <form method="POST" name="bedrift" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
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
                <h4><?php echo $bedriftsnavn ?></h4>
                <p class="card-text text-secondary"><?php echo $orgnr ?></p>
                <p class="card-text text-secondary"><?php echo $adr ?></p>
                <label for="bildefil"><h6><?php echo _BYTTPROFILBILDE; ?>:</h6></label>
                <div class="input-group">
                <input type="file" class="form-control" aria-label="Upload" name="bildefil" size="40" id="bildefil" value="<?php if (isset($_COOKIE['bildefil'])) {echo $_COOKIE['bildefil'];} else {echo "";}?>" accept="image/gif, image/jpeg, image/png"/>
                </div>
              </div>
            </div>
          </div>
          <!--Card Profil slutt-->

          <!--Card Kontaktinfo/annonse-->
          <div class="col-md-8">
            <div class="card bg-light mt-3">
              <div class="card-body">
                <div class="card-header text-center mb-3">
                  <h4><?php echo _OPPRETTANNONSE; ?></h4>
                </div>

                <!--Rad 1 - Org navn, nr-->
                <div class="row">
                  <div class="form-group col-sm-6 mb-3">
                    <label for="orgnavn"><h6><?php echo _ORGNAVN; ?>:</h6></label>
                    <input type="text" class="form-control" id="orgnavn" value="<?php if (isset($_COOKIE['orgnavn'])) {echo $_COOKIE['orgnavn'];} else {echo "";}?>" placeholder="<?php echo _ORGNAVN; ?>"
                     name="orgnavn" required>
                  </div>
                  <div class="col-sm-6 mb-3">
                     <label for="orgnr"><h6><?php echo _ORGNR; ?>:</h6></label>
                     <input type="text" class="form-control" id="orgnr" value="<?php if (isset($_COOKIE['orgnr'])) {echo $_COOKIE['orgnr'];} else {echo "";}?>" placeholder="<?php echo _ORGNR; ?>"
                     name="orgnr" required>
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

                <!--Rad 3 - Tlf, Nettside-->
                <div class="row">
                  <div class="form-group mt-3 col-sm-6">
                    <label for="tlf"><h6><?php echo _TLF; ?>:</h6></label>
                    <input type="text" class="form-control" id="tlf" value="<?php if (isset($_COOKIE['tlf'])) {echo $_COOKIE['tlf'];} else {echo "";}?>" placeholder="<?php echo _TLF; ?>f"
                     name="tlf" required>
                  </div>
                  <div class="form-group mt-3 col-sm-6">
                    <label for="nettside"><h6><?php echo _NETTSIDE; ?></h6></label>
                    <input type="text" class="form-control" id="nettside" value="<?php if (isset($_COOKIE['nettside'])) {echo $_COOKIE['nettside'];} else {echo "";}?>" placeholder="<?php echo _NETTSIDELINK; ?>"
                     name="nettside">
                  </div>
                </div><!--Slutt Rad 3-->

                <!--Rad 4 - Tittel, Opplasting-->
                <div class="row">
                  <div class="form-group col mt-3">
                    <label for="tittel"><h6><?php echo _ANNONSETITTEL; ?>:</h6></label>
                    <input type="text" class="form-control" id="tittel" value="<?php if (isset($_COOKIE['tittel'])) {echo $_COOKIE['tittel'];} else {echo "";}?>" placeholder="<?php echo _ANNONSETITTELLINK; ?>"
                     name="tittel">
                  </div>
                  <div class="form-group col mt-3">
                    <label for="vedlegg"><h6><?php echo _VEDLEGG; ?>:</h6></label>
                    <div class="input-group">
                    <input type="file" class="form-control" aria-label="Upload" name="vedlegg" id="vedlegg" value="<?php if (isset($_COOKIE['vedlegg'])) {echo $_COOKIE['vedlegg'];} else {echo "";}?>" accept="application/pdf">
                    </div>
                  </div>
                </div><!--Slutt Rad 4-->

                <!--Rad 5 - Beskrivelse-->
                <div class="row">
                  <div class="form-group col mt-3">
                    <label for="beskrivelse"><h6><?php echo _BESKRIVELSE; ?>:</h6></label>
                    <textarea class="form-control" rows="20" id="beskrivelse" value="<?php if (isset($_COOKIE['beskrivelse'])) {echo $_COOKIE['beskrivelse'];} else {echo "";}?>" placeholder="<?php echo _BESKRIVELSELINK; ?>"
                     name="beskrivelse"></textarea>
                  </div>
                </div><!--Slutt Rad 5-->

                <!--Rad 6 - Lagre knapp, Aktiver annonse-->
                <div class="row">
                  <div class="form-group col mt-3">
                    <button type="submit" name="lagre" class="btn btn-info"><?php echo _LAGRE; ?></button>
                  </div>
                    <div class="form-group col mt-3">
                    <label for="aktiv"><?php echo _AKTIV; ?></label>
                    <input type="hidden" name="aktiv" value="0" />
                    <!--Forsikrer at checkbox alltid er krysset av som aktiv-->
                    <input type="checkbox" name="aktiv" value="1" checked/>
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


                </div><!--Slutt Rad 6-->

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