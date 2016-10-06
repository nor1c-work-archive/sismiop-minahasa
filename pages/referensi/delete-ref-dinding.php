<?php

session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

$id = $_GET['refid'];
$q = mysqli_query($conn, "DELETE FROM REF_JNS_DINDING where KD_JNS_DINDING='".$id."'");
if ($q) {
  echo '<script language="javascript">document.location.href="ref-dinding.php";</script>';
} else {
  echo "Gagal Menghapus Jenis Dinding";
}

?>
