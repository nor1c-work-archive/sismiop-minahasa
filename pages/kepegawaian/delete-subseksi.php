<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['deleteref']) || isset($_POST['deleteref'])) {
  list($KD_SEKSI, $KD_SUBSEKSI, $NM_SUBSEKSI) = explode(".", $_GET['deleteref']);

  $updq = "DELETE FROM REF_SUB_SEKSI
            WHERE KD_SEKSI='".$KD_SEKSI."' AND 
                  KD_SUBSEKSI='".$KD_SUBSEKSI."' AND
                  NM_SUBSEKSI='".$NM_SUBSEKSI."'";
  if (mysqli_query($conn, $updq)) {
    $_SESSION['notif'] = "Data Sub Seksi Berhasil Dihapus";
    header("Location: subseksi.php");
  } else {
    $_SESSION['gagal'] = "Data Sub Seksi Gagal Dihapus";
    header("Location: subseksi.php");
  }
} else {
  echo "Tidak ada Proses";
}

?>