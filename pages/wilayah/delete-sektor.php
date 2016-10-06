<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['deleteref']) || isset($_POST['deleteref'])) {
  list($KD_SEKTOR, $NM_SEKTOR) = explode(".", $_GET['deleteref']);

  $updq = "DELETE FROM REF_JNS_SEKTOR 
            WHERE KD_SEKTOR='".$KD_SEKTOR."' AND 
                  NM_SEKTOR='".$NM_SEKTOR."'";
  if (mysqli_query($conn, $updq)) {
    $_SESSION['notif'] = "Jenis Sektor Berhasil Dihapus";
    header("Location: ref-sektor.php");
  } else {
    $_SESSION['gagal'] = "Jenis Sektor Gagal Dihapus";
    header("Location: ref-sektor.php");
  }
} else {
  echo "Tidak ada Proses";
}

?>