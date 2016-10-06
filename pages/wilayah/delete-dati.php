<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['deleteref']) || isset($_POST['deleteref'])) {
  list($KD_PROPINSI, $KD_DATI2, $NM_DATI2) = explode(".", $_GET['deleteref']);

  $updq = "DELETE FROM REF_DATI2 
            WHERE KD_PROPINSI='".$KD_PROPINSI."' AND 
                  KD_DATI2='".$KD_DATI2."' AND
                  NM_DATI2='".$NM_DATI2."'";
  if (mysqli_query($conn, $updq)) {
    $_SESSION['notif'] = "Kota/Kabupaten Berhasil Dihapus";
    header("Location: ref-dati2.php");
  } else {
    $_SESSION['gagal'] = "Kota/Kabupaten Gagal Dihapus";
    header("Location: ref-dati2.php");
  }
} else {
  echo "Tidak ada Proses";
}

?>