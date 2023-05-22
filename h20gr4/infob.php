<?php
  
  if(!isset($_GET['idbedrift'])) {
    header("Location:index.php");
  }
  $dbconnect = new mysqli("itfag.usn.no","h20APP2000gr4","pw4","h20APP2000grdb4");
  
  $stock_sql="SELECT * FROM bedrift WHERE idbedrift=".$_GET['idbedrift'];
  if($stock_query=mysqli_query($dbconnect, $stock_sql)) {
    $stock_rs=mysqli_fetch_assoc($stock_query);
  }
  if(mysqli_num_rows($stock_query)==0) {
    echo "tom stock";
  } else {
    ?>



<?php   $link ="https://itfag.usn.no/grupper/h20gr4/profilbilder/"?>
<?php   $linkv ="https://itfag.usn.no/grupper/h20gr4/vedleggbedrift/"?>
    <div class="header"><?php   echo $stock_rs["bedriftsnavn"];?></div>

  <div class="container">
  <img  src=<?php   echo $link.$stock_rs["profilbilde"];?>>
    <p><b>Om Frilanser:  </b><?php   echo $stock_rs["beskrivelse"];?></p> 
    </div>
    <div class="container1">
  <a href="https://itfag.usn.no/grupper/h20gr4/vedleggbedrift/"><div><?php   echo $stock_rs["vedlegg"];?></div></a>
  <div><?php   echo $stock_rs["nettsidelink"];?></div>
  <div><?php   echo $stock_rs["postnr_Postnr"];?></div>
  <div><?php   echo $stock_rs["org_nr"];?></div>
    </div>
    

  



<div class="container">
  <div class="item"><b>Stilling:  </b>  <?php   echo $stock_rs["tittel"];           ?></div>
  <div ><b>Adresse:  </b><?php   echo $stock_rs["adresse"];           ?></div>
  <div ><b>Tlf:  </b><?php   echo $stock_rs["tlf"];           ?></div>
  
</div>







    <?php do {
      ?>
      
    <?php
    } while ($stock_rs=mysqli_fetch_assoc($stock_query));
    ?>
  <?php
  }
  ?>


   
    



<style>
  a{
    text-decoration: none;
  }
  img {
  width: 150px;
  height: 150px;
}


p {
  
  color: black;
  font-family: Georgia;
  font-size: 150%;

  padding-left: 30px;
  
  
}
div {
  
  color: black;
  font-family: arial;
  font-size: 120%;

  padding-left: 30px;
  
  
}
.container {

border-top: 1px solid gray;
display: flex;

  
}

.container1 {

border-top: 1px solid gray;
display: flex;
padding-top: 15px;
padding-bottom: 10px;

  
}


.item {
  
  flex-basis: 200px;
  height: 10px;
  margin: 5px;
  



      }
      .header {
  
  background-color: powderblue;
  color: black;
  font-family: verdana;
  font-size: 300%;
  font-weight: bold;
  padding-left: 10px;
  
}
</style>
