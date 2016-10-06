<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['deleteref']) || isset($_POST['deleteref'])) {
  list($KD_SEKSI, $NM_SEKSI, $NO_SRT_SEKSI, $KODE_SURAT_1, $KODE_SURAT_2) = explode(".", $_GET['deleteref']);

  $updq = "DELETE FROM REF_SEKSI
            WHERE KD_SEKSI='".$KD_SEKSI."' AND 
                  NM_SEKSI='".$NM_SEKSI."' AND
                  NO_SRT_SEKSI='".$NO_SRT_SEKSI."' AND
                  KODE_SURAT_1='".$KODE_SURAT_1."' AND
                  KODE_SURAT_2='".$KODE_SURAT_2."'";
  if (mysqli_query($conn, $updq)) {
    $_SESSION['notif'] = "Data Seksi Berhasil Dihapus";
    header("Location: seksi.php");
  } else {
    $_SESSION['gagal'] = "Data Seksi Gagal Dihapus";
    header("Location: seksi.php");
  }
} else {
  echo "Tidak ada Proses";
}

?>