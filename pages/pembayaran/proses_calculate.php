<?php 

$DISKON = $_POST['diskon'];
$JML 	= $_POST['jml'];

echo $JML - (($JML * $DISKON) / 100);

?>