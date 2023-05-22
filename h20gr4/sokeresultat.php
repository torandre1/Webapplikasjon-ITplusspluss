<?php
include_once 'header.php';
include_once 'connection.php';
include_once 'funksjoner.php';
include_once 'visProfil.php';
include_once 'insert_profil.php';
$conn = conn();
/*
 * Søkefunksjon
 * Skrevet av Tor André
 */
?>
<div class="searchbar">
  <form action="" method="post">
    <input name="search" class="form-control me-2 sok-bar" type="search" placeholder="Søk via navn, tlf, yrke eller fagområder.." aria-label="Search" >
    <button name="submit" class="btn btn-primary sok-knapp" type="submit">Søk</button>
    <a href="annonse.php"><button class="btn btn-primary sok-knapp" type="button">Slett søk</button></a>
  </form>
</div>



<?php
$conn = conn();
if (isset($_POST['submit'])) {
    $search = $_POST['search'];
    $query1 = "SELECT * FROM frilanser WHERE fornavn LIKE '%$search%' OR etternavn LIKE '%$search%' OR epost LIKE '%$search%' tlf LIKE '%$search%';";
    //$query2 = "SELECT * FROM bedrift WHERE "
    $query3 = "SELECT DISTINCT idfrilanser, fornavn, etternavn, jobbtittel, profilbilde, postnr_Postnr FROM frilanser INNER JOIN(fagomrade_has_frilanser INNER JOIN fagomrade ON fagomrade_kategorinr = kategorinr) ON frilanser_idfrilanser = idfrilanser
    WHERE aktiv = 1 AND fornavn LIKE '%$search%' OR kategorinavn LIKE '%$search%' OR etternavn LIKE '%$search%' OR epost LIKE '%$search%' OR tlf LIKE '%$search%';";
    $search_query = mysqli_query($conn, $query3);

    if (!$search_query) {
        die("SPØRRING FEIL" . mysqli_error($conn));
    }
    $count = mysqli_num_rows($search_query);
    if ($count == 0) {
        echo "<h1>INGEN TREFF</h1>";
    } else {
        echo "<h1>FANT $count TREFF</h1>";
/*
 * - Visning av "manityrprofiler"
 * - Skrevet av Mari
 */
        $sql = "SELECT * FROM frilanser AS F INNER JOIN postnr AS P ON F.postnr_postnr = P.postnr
        WHERE F.aktiv = 1";
        //   $resultat = mysqli_query($conn, $sql);
        //  $rad = mysqli_num_rows($resultat);
        while ($row = mysqli_fetch_array($search_query)) { /*Byttet ut $resultat med $search_query for at den skal vise profiler basert på søkeord - Tor */
            $idfrilanser = $row['idfrilanser'];
            $fornavn = $row['fornavn'];
            $etternavn = $row['etternavn'];
            $poststed = $row['poststed'];
            $jobbtittel = $row['jobbtittel'];
            $profilbildeNavn = $row['profilbilde'];
            if (empty($profilbildeNavn)) {
                $profilbilde = "bilder/profil.png";
            } else {
                $profilbilde = $katalogBilde . $profilbildeNavn;
            }
            ?>
<!--Card Profil-->
<div class="col-md-4 wrap2">
            <div class="card bg-light mt-3">
              <div class="card-body text-center">
                <div class="card-header mb-3">
                  <h4>Profil</h4>
                </div>
                <a href="profilAnnonseFrilanser.php?idfrilanser=<?php echo $idfrilanser; ?>">
                <img src="<?php echo $profilbilde ?>" alt="Profil" width="150"></a>
                <h4><?php echo $fornavn . " " . $etternavn ?></h4>
                <p class="card-text text-secondary"><?php echo $jobbtittel ?></p>
                <p class="card-text text-secondary"><?php echo $poststed ?> </p>
              </div>
            </div>
          </div>
          <!--Card Profil slutt-->
<?php
$conn = conn();
        }
        if (!$resultat) {
            die('Sql error!' . mysqli_error($conn));
        } else {
            disconn($conn);
        }
        $resultat;
    }
}
?>


</body>
</html>