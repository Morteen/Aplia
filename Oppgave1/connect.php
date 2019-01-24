                 
                 
                 
                
<?php
define("TJENER",  "localhost");
define("BRUKER",  "root");
define("PASSORD", ""); 
define("DB",      "aplia");
// Etablerer forbindelse til databasen

function kobleOpp() {
  $conn = mysqli_connect(TJENER, BRUKER, PASSORD, DB);
  if (!$conn) {
  die('Klarte ikke å koble til databasen: ' /*. mysql_error($dblink)*/);
  }
  mysqli_set_charset($conn, 'utf8');
  return $conn;

}

?>