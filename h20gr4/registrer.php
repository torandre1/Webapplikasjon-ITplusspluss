<?php
include_once 'insert_registrer.php';
include_once 'links.php';
/*
 *
 * @author Cecille
 *
 */
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--css fil lenke-->
    <link rel="stylesheet" type="text/css" href="RegistrerLogginnStyle.css">
    <title>Registrerform</title>
</head>

 <body>
<!-- header -->
    <header>
        <h1 class="tittel">it++</h1>
        <p class="subtittel">Opprett ny konto</p>
    </header>
<!--form -->
    <form action="registrer.php" method= "post" class="container registrer" id="form" enctype="multipart/form-data">
        <!--input epost-->
        <div class="input-grupper">
            <label for="epost">E-postadresse:</label>
            <input type="email" placeholder="Skriv inn e-postadresse" name="epost" required>
        </div>
        <!--input passord-->
        <div class="input-grupper">
            <label for="passord">Passord:</label>
            <!--pattern og title er validering til passord lengde og tegn -->
            <input type="password" class="passord-felt" placeholder="skriv inn passord" id="passord" name="passord" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            title="Må inneholde minst et nummer og en stor bokstav, og mer enn 8 tegn! " required>
        </div>
        <!--input bekreft passord-->
        <div class="input-grupper">
            <label for="passord">Bekreft passord:</label>
            <!--pattern og title er validering til passord lengde og tegn -->
            <input type="password" class="passord-felt" placeholder="Skriv inn passord på nytt" id="bekreftpass" name="bekreftpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
            title="Må inneholde minst et nummer og en stor bokstav, og mer enn 8 tegn! " required>
        </div>
        <!-- toggle passord visning -->
        <div class="input-grupper">
        <label for="vispassord">Trykk for å vise passord</label>
        <input type="checkbox" onclick="passordFunksjon()"Vis passord>
        </div>
        <!--Javascript funksjon til passord toggle visning-->
        <script>
        function passordFunksjon(){
            var felter = document.getElementsByClassName("passord-felt")
            console.log(felter)
            //hvis input type er passord, blir det omgjort til tekst, ellers ikke.
            if(felter[0].type==="password") {
                felter[0].type = felter[1].type ="text"
                } else {
                    felter[0].type = felter[1].type ="password"
                }
        }

        </script>

        <br>
        <!--radio knappene-->
        <label for="input-grupper">Velg din type profil:</label>
        <div class="input-grupper">
            <div class="col-md-6">
                <input type="radio" name="profilValg" <?php if (isset($profilValg) && $profilValg == "frilanser") {
    echo "checked";
}
?>value="frilanser">Frilanser
                <input type="radio" name="profilValg" <?php if (isset($profilValg) && $profilValg == "bedrift") {
    echo "checked";
}
?>value="bedrift">Bedrift
            </div>
        </div>
        <br>
        <!--submit knappen-->
        <div class="input-grupper">
        <p style="color:gray"><strong>Alle felt må fylles*</strong></p>
            <input type="submit" name="submit" value="Registrer">
        </div>
    </form>
<!--footer-->
    <p class="footer">Har du allerede en konto? <a href="<?php echo $logg_inn ?>">Logg inn</a></p>
 </body>
</html>




<!--label/input ide: https://www.w3schools.com/howto/howto_css_signup_form.asp
passord-validering-tegn https://www.w3schools.com/howto/howto_js_password_validation.asp
passord toggle visning: https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_toggle_password-->