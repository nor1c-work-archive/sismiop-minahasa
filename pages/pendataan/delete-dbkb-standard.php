<?php

session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

  list($KD_PROPINSI, $KD_DATI2, $THN_DBKB_STANDARD, $KD_JPB, $TIPE_BNG, $KD_BNG_LANTAI) = explode(".", $_GET['refid']);
  $l = mysqli_query($conn, "DELETE FROM DBKB_STANDARD where KD_PROPINSI='".$KD_PROPINSI."' and KD_DATI2='".$KD_DATI2."' and THN_DBKB_STANDARD='".$THN_DBKB_STANDARD."' and KD_JPB='$KD_JPB' and TIPE_BNG='$TIPE_BNG' and KD_BNG_LANTAI='$KD_BNG_LANTAI'");
  if ($l) {
  	echo '<script language="javascript">document.location.href="dbkb-standar.php";</script>';
  } else {
  	echo "Terjadi kesalahan silahkan coba lagi";
  }

?>
