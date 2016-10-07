<?php

session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

list($KD_PEKERJAAN, $KD_KEGIATAN) = explode(".", $_GET['refid']);
$q = mysqli_query($conn, "DELETE FROM PEKERJAAN_KEGIATAN where KD_PEKERJAAN='".$KD_PEKERJAAN."' and KD_KEGIATAN='".$KD_KEGIATAN."'");
if ($q) {
  echo '<script language="javascript">document.location.href="ref-pekerjaankegiatan.php";</script>';
} else {
  echo "Gagal Menghapus Data Pekerjaan Kegiatan";
}

?>
