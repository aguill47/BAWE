<?php

$conn_string = "host=".HOSTNAME." port=".PORT." dbname=".DATABASE." user=".LOGIN." password=".PASSWORD;
$conn = pg_connect($conn_string);

if (!$conn) {
  echo "An error occurred.\n";
  exit;
} else {
	echo "YIPEEEEEEEEEEEEE";
}

?>