<?php

session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}


list($KD_KANWIL, $KD_KPPBB, $THN_PELAYANAN, $BUNDEL_PELAYANAN, $NO_URUT_PELAYANAN) = explode(".", $_GET['refid']);
$q = mysqli_query($conn, "DELETE FROM PENGURANGAN_PERMANEN where KD_KANWIL='".$KD_KANWIL."' and KD_KPPBB='".$KD_KPPBB."' and THN_PELAYANAN='".$THN_PELAYANAN."' and BUNDEL_PELAYANAN='".$BUNDEL_PELAYANAN."' and NO_URUT_PELAYANAN='".$NO_URUT_PELAYANAN."'");
if ($q) {
  echo '<script language="javascript">document.location.href="sk-pengurangan.php";</script>';
} else {
  echo "Gagal Menghapus SK Pengurangan";
}

?>
