<?php

session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

list($KD_KECAMATANid, $KD_KELURAHANid) = explode(".", $_GET['refid']);
$q = mysqli_query($conn, "DELETE FROM REF_KELURAHAN where KD_KECAMATAN='".$KD_KECAMATANid."' and KD_KELURAHAN='".$KD_KELURAHANid."'");
if ($q) {
  echo '<script language="javascript">document.location.href="refkelurahan.php";</script>';
} else {
  echo "Gagal Menghapus Kelurahan";
}

?>
