<?php
@session_start(); //@ gjør at feilmelding ikke vises
if (!$_SESSION['epost']) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Endre Passord</title>

<!--css fil-->
<link rel="stylesheet" href="Innstilling.css">

</head>
<body>

<!--header-->
<header>
    <h3 class="tittel">IT++</h3>
    <p class="subtittel">Endre passord</p>
    <br>
</header>

<!--endre passord formen -->
<div class="container">
<form method="post" action="endrepass_validering.php" id="form">

    <!--input: nåværende passord-->
Nåværende passord:<br>
<input type="password" class="passord-felt" name="passord"><span id="passord"  required></span>
<br>

    <!--input ny passord-->
Ny Passord:<br>
<input type="password" class="passord-felt"  name="nypassord"><span id="nypassord" required ></span>
<br>

    <!--input bekreft passord-->
Bekreft Passord:<br>
<input type="password" class="passord-felt"  name="bekreftpassord"><span id="bekreftpassord" required></span>
<br><br>
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
                felter[0].type = felter[1].type= felter[2].type ="text"
                } else {
                    felter[0].type = felter[1].type= felter[2].type ="password"
                }
        }

        </script>


    <!--input submit-->
<input type="submit" name="submit" value="Endre passord">
</form>
</div>
<br>
<br>

<!--footer-->
<div class="footer">
    <a href="indexInnlogget.php">Gå tilbake til hjemmesiden</a>
</div>
</body>
</html>


<!--Kilder
https://www.studentstutorial.com/php/password-change
hentet ideer på oppsettet i denne siden

https://www.w3schools.com/howto/tryit.asp?filename=tryhow_js_toggle_password
passord toggle visning

@author Cecille
!>
