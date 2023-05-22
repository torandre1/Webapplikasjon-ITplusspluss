<?php
include_once 'logginn_validering.php';
include_once 'links.php';
/*
@author: Cecille
 */

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css lenke -->
    <link rel="stylesheet" type="text/css" href="RegistrerLogginnStyle.css">
    <title>Logginnform</title>
</head>
 <body>
<!--Header-->
    <header>
        <h1 class="tittel">it++</h1>
        <p class="subtittel">Logg inn</p>
    </header>
<!-Logg inn form-->
    <form action="logginn.php" method="post" class="container">
        <!--input epost-->
        <div class="input-grupper">
            <label for="epost">E-postadresse</label>
            <input type="email" placeholder="Skriv inn e-postadresse" name="epost" required>
        </div>
        <!--input passord-->
        <div class="input-grupper">
            <label for="passord">Passord</label>
            <input type="password" class="passord-felt" placeholder="Skriv inn passord" name="passord" required>
        </div>
        <br>
       <!-- toggle passord visning -->
<div class="input-grupper">
        <label for="vispassord">Trykk for å vise passord</label>
        <input type="checkbox" onclick="passordFunksjon()"Vis passord>
        </div>
        <br>
        <!--Javascript funksjon til passord toggle visning-->
        <script>
        function passordFunksjon(){
            var felter = document.getElementsByClassName("passord-felt")
            console.log(felter)
            //hvis input type er passord, blir det omgjort til tekst, ellers ikke.
            if(felter[0].type==="password") {
                felter[0].type ="text"
                } else {
                    felter[0].type ="password"
                }
        }

        </script>


        </script>
        <!--felt beskjed-->
        <p style="color:gray"><strong>Alle felt må fylles*</strong></p>

        <br>
        <!--input submit knapp-->
        <div class="input-grupper">
            <input type="submit" name="submit" value="Logg inn">
        </div>
    </form>

<!--footer-->
    <div class="footer">
        Har du ikke en konto? <a href= "<?php echo $registrer_bruker ?>" >Klikk her!</a>
    </div>
 </body>
</html>¨


<!--
label/input oppsettet ide https://www.w3schools.com/howto/howto_css_login_form.asp
passord toggle visning https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_toggle_password

 -->