<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['deleteref']) || isset($_POST['deleteref'])) {
  list($KD_KANWIL, $KD_KPPBB, $KD_BANK_TUNGGAL, $KD_BANK_PERSEPSI, $KD_TP, $NM_TP, $ALAMAT_TP, $NO_REK_TP) = explode(".", $_GET['deleteref']);

  $updq = "DELETE FROM TEMPAT_PEMBAYARAN 
            WHERE KD_KANWIL='".$KD_KANWIL."' AND 
                  KD_KPPBB='".$KD_KPPBB."' AND 
                  KD_BANK_TUNGGAL='".$KD_BANK_TUNGGAL."' AND 
                  KD_BANK_PERSEPSI='".$KD_BANK_PERSEPSI."' AND 
                  KD_TP='".$KD_TP."' AND 
                  NM_TP='".$NM_TP."' AND 
                  ALAMAT_TP='".$ALAMAT_TP."' AND 
                  NO_REK_TP='".$NO_REK_TP."'";
  if (mysqli_query($conn, $updq)) {
    $_SESSION['notif'] = "Data Berhasil Dihapus";
    header("Location: tempatpembayaran.php");
  } else {
    $_SESSION['gagal'] = "Data Gagal Dihapus";
    header("Location: tempatpembayaran.php");
  }
} else {
  echo "ga ada";
}

?>