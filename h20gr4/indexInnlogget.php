<?php
@session_start(); //@ gjør at feilmelding ikke vises
if (!$_SESSION['epost']) { //sikrer at brukere som ikke har registrert seg kommer inn
    include "logginn.php";
} else {
    include_once 'header.php';
    include_once 'sok.php';
}
