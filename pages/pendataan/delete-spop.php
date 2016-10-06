<?php

session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

$NO_FORMULIR = $_GET['refid'];
$q = mysqli_query($conn, "DELETE FROM SPOP where NO_FORMULIR='".$NO_FORMULIR."'");
if ($q) {
  $l = mysqli_query($conn, "DELETE FROM LSPOP where NO_FORMULIR='".$NO_FORMULIR."'");
  if ($l) {
  	echo '<script language="javascript">document.location.href="spop.php";</script>';
  } else {
  	echo "Terjadi kesalahan";
  }
} else {
  echo "Terjadi kesalahan";
}

?>
