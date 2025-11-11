<?php


  // indiquez les identifiants de votre base de données
  //define("HOSTNAME", "pgsql");
  //define("DATABASE", "projet_antonin_guillot");   
  //define("LOGIN", "antonin.guillot"); 
  //define("PORT", "5432");      
  //define("PASSWORD", "AnT\$SaCnF642");   // ATTENTION 
?> 

<?php
  // indiquez les identifiants de votre base de données
  define("HOSTNAME", "localhost");
  define("DATABASE", "testdb");   
  define("LOGIN", "testuser"); 
  define("PORT", "5432");      
  define("PASSWORD", "testpass");   // ATTENTION 
?>

<?php

$conn_string = "host=".HOSTNAME." port=".PORT." dbname=".DATABASE." user=".LOGIN." password=".PASSWORD;
$conn = pg_connect($conn_string);

if (!$conn) {
  echo "An error occurred.\n";
  exit;
} else {
}

?>