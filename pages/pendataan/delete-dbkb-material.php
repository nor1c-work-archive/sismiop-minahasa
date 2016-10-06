<?php

session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

  list($KD_PROPINSI, $KD_DATI2, $THN_DBKB_MATERIAL, $KD_PEKERJAAN, $KD_KEGIATAN) = explode(".", $_GET['refid']);
  $l = mysqli_query($conn, "DELETE FROM DBKB_MATERIAL where KD_PROPINSI='".$KD_PROPINSI."' and KD_DATI2='".$KD_DATI2."' and THN_DBKB_MATERIAL='".$THN_DBKB_MATERIAL."' and KD_PEKERJAAN='".$KD_PEKERJAAN."' and KD_KEGIATAN='".$KD_KEGIATAN."'");
  if ($l) {
  	echo '<script language="javascript">document.location.href="dbkb-material.php";</script>';
  } else {
  	echo "Terjadi kesalahan silahkan coba lagi";
  }

?>
