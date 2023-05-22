<?php
/**
 * Utfører sletting av bruker i bedrift tabellen
 * @author Mari
 */

include_once 'connection.php';
include_once 'funksjoner.php';
session_start();

function slettBedrift()
{
    $conn = conn();
    $epost = $_SESSION['epost'];
    $sql = "DELETE FROM bedrift
                 WHERE epost = '$epost'";
    if (mysqli_query($conn, $sql)) {
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

slettBedrift();
skrivTilLogg('slettBedrift', "Bedrift med epost $_SESSION[epost] ble slettet fra databasen");
