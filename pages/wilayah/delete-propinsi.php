<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['deleteref']) || isset($_POST['deleteref'])) {
  list($KD_PROPINSI, $NM_PROPINSI) = explode(".", $_GET['deleteref']);

  $updq = "DELETE FROM REF_PROPINSI 
            WHERE KD_PROPINSI='".$KD_PROPINSI."' AND 
                  NM_PROPINSI='".$NM_PROPINSI."'";
  if (mysqli_query($conn, $updq)) {
    $_SESSION['notif'] = "Propinsi Berhasil Dihapus";
    header("Location: ref-propinsi.php");
  } else {
    $_SESSION['gagal'] = "Propinsi Gagal Dihapus";
    header("Location: ref-propinsi.php");
  }
} else {
  echo "Tidak ada Proses";
}

?>