<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['deleteref']) || isset($_POST['deleteref'])) {
  list($KD_JABATAN, $NM_JABATAN, $SINGKATAN_JABATAN) = explode(".", $_GET['deleteref']);

  $updq = "DELETE FROM REF_JABATAN
            WHERE KD_JABATAN='".$KD_JABATAN."' AND 
                  NM_JABATAN='".$NM_JABATAN."' AND
                  SINGKATAN_JABATAN='".$SINGKATAN_JABATAN."'";
  if (mysqli_query($conn, $updq)) {
    $_SESSION['notif'] = "Data Jabatan Berhasil Dihapus";
    header("Location: jabatan.php");
  } else {
    $_SESSION['gagal'] = "Data Jabatan Gagal Dihapus";
    header("Location: jabatan.php");
  }
} else {
  echo "Tidak ada Proses";
}

?>