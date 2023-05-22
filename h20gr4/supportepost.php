<?php 
/* Funksjon for å sende epost via kontaktskjema på kontaktoss.php
* @author Tor André Myhre
* Hentet fra: https://www.w3schools.com/php/func_mail_mail.asp
*/

if(isset($_POST['submit'])) {
    $to  = "233568@usn.no";
    $from = $_POST['from'];
    $subject = $_POST['subject'];
    $message = $_POST['tekstfelt'];
        $message = wordwrap($message, 70); /* Gir linjeskift per 70 tegn */
    $headers = "From: " . $avsender;

    if( mail($to ,$subject, $headers, $message) ) {
        echo '<script language="javascript">';
        echo 'alert("Din e-post er sendt til oss!")';
        echo '</script>';
    } else {
        echo '<script language="javascript">';
        echo 'alert("Din e-post ble ikke sendt, prøv igjen senere eller ring oss!")';
        echo '</script>';
    }
}
?>