<?php
define("DB_SERVER", "itfag.usn.no");
define("DB_USER", "h20APP2000gr4");
define("DB_PASSWORD", "pw4");
define("DB_DATABASE", "h20APP2000grdb4");

// åpner connection til databse
function conn()
{
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
    // Ser etter feil i tilkoblingen
    if (!$conn) {
        die('Connection failed' . mysqli_error($conn));
    }
    mysqli_set_charset($conn, 'utf8');

    return $conn;
}

//lukker forbindelsen til databasen
function disconn($conn)
{
    mysqli_close($conn);
}

//Sjekker om bruker er logget inn.
function erInnlogget()
{
    if (isset($_SESSION['epost'])) {
        echo "Du er innlogget!";
        //      header("Location: logginn.php");
    } else {
        echo "Du er ikke innlogget";
    }
}
