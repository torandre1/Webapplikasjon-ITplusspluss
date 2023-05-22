<!--Header-->
<?php
//lagrer skjemadata i cookies 14 dager frem i tid. Må sette disse før HTML elementene begynner.
if (isset($_POST['submit'])) {
    setcookie("from", $_POST['from'], time() + 3600 * 24 * 14);
    setcookie("avsender", $_POST['avsender'], time() + 3600 * 24 * 14);
}

include_once 'header.php';
include_once 'supportepost.php';

?>
<!--Kontaktskjema-->
<form class="form" role="form" action="kontaktoss.php" method="post">
    <div class="contact">
        <div class="text-black">
            <div class="row">
                <div class="col-md-4">
                    <div class="contact-info">
                        <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"><br><br>
                        <h2>Kontaktskjema</h2><br><br>
                        <h4 class="contact-text">Send oss en hendvendelse!</h4><br>
                        <h4>+47 99 88 77 66</h4>
                        <h4>itpluss@service.no</h4><br>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="contact-form bold">
                    <!--Navn-->
                        <div class="form-group"><br>
                            <label class="control-label col-sm-2 mb-3" for="from">Navn:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control" id="from" placeholder="Skriv ditt inn navn.." name="from" value="<?php if (isset($_COOKIE['from'])) {echo $_COOKIE['from'];} else {echo "";}?>">
                            </div>
                        </div>
                    <!--E-post-->
                        <div class="form-group">
                            <label class="control-label col-sm-2 mb-3" for="email">E-post:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="email" class="form-control" id="avsender" for="avsender" placeholder="Skriv din inn e-postadresse" name="avsender" value="<?php if (isset($_COOKIE['avsender'])) {echo $_COOKIE['avsender'];} else {echo "";}?>">
                            </div>
                        </div>
                    <!--Emne-->
                        <div class="form-group">
                            <label class="control-label col-sm-2 mb-3" for="subject">Emne:</label>
                            <div class="col-sm-10 mb-3">
                                <input type="text" class="form-control" id="subject" for="subject" placeholder="Legg til emne.." name="subject">
                            </div>
                        </div>
                    <!--Melding-->
                        <div class="form-group">
                            <label type="text" for="message" class="control-label col-sm-2 mb-3">Din melding:</label>
                            <div class="col-sm-10 mb-3">
                                <textarea name="message" class="form-control" rows="5" id="message" placeholder="Skriv til oss.."></textarea>
                            </div>
                        </div>
                    <!--Send-->
                        <div class="form-group">
                            <input type="submit" name="submit" value="Send" class="btn btn-info"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</form>
</body>
</html>
