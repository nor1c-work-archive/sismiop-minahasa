<?php

session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

$id = $_GET['refid'];
$q = mysqli_query($conn, "DELETE FROM TIPE_BANGUNAN where TIPE_BNG='".$id."'");
if ($q) {
  echo '<script language="javascript">document.location.href="ref-tipebangunan.php";</script>';
} else {
  echo "Gagal Menghapus Data Tipe Bangunan";
}

?>
