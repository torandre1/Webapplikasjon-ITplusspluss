<?php
@session_start(); //@ gjør at feilmelding ikke vises
if (!$_SESSION['epost']) {
    header("Location: index.php");
}
?>
<!--Søk-bar-->
<div class="searchbar">
  <h2>Velkommen til starten av din karriere</h2>
  <br>
  <h5>Søk i profiler på it++</h5>
  <form action="sokeresultat.php" method="post">
   <input name="search" class="form-control sok-bar" type="search" placeholder="Søk via navn, tlf, yrke eller fagområder.." aria-label="Search" >
    <button name="submit" class="btn btn-primary sok-knapp" type="submit">Søk</button>
  </form>
  <!--Kategorier-->
  <div class="kategorier">
    <a href="frilansere.php"><button class="btn btn-ligth knapp-kategori">Frilansere</button></a>
    <a href="bedrifter.php"><button class="btn btn-ligth knapp-kategori">Bedrifter</button></a>
  </div>
</div>
