<?php
/**
 * Utfører sletting av bruker i frilanser tabellen
 * Sletter først radene frilanseren er involvert i i
 * fagomrade_has_frilanser tabellen, deretter slettes brukeren
 * i tabell frilanser
 * @author Mari
 */

include_once 'connection.php';
include_once 'funksjoner.php';
session_start();

function slettFrilanser()
{
    $conn = conn();
    $epost = $_SESSION['epost'];
    $sql1 = "DELETE FROM fagomrade_has_frilanser
WHERE frilanser_idfrilanser = '$_SESSION[idfrilanser]'";
    $sql2 = "DELETE FROM frilanser
WHERE epost = '$epost'";
    mysqli_query($conn, $sql1);
    if (mysqli_query($conn, $sql2)) {
        echo '<script language="javascript">';
        echo 'alert("Bruker er slettet!")';
        echo '</script>';
        header("refresh:1;url=index.php");
    } else {
        echo '<script language="javascript">';
        echo 'alert("Bruker kunne ikke slettes!")';
        echo '</script>';
        header("refresh:1;url=index.php");
    }
    disconn($conn);
    session_destroy();
}

slettFrilanser();
skrivTilLogg('slettFrilanser', "Frilanser med epost $_SESSION[epost] ble slettet fra databasen");
