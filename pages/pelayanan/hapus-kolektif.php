<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
  if (isset($_POST['refid']) || isset($_GET['refid'])) {
    list($ID, $KD_KANWIL, $KD_KPPBB, $THN_PELAYANAN, $BUNDEL_PELAYANAN, $NO_URUT_PELAYANAN) = explode(".", $_GET['refid']);

    $delete = "DELETE FROM PST_PERMOHONAN_KOLEKTIF where ID='".$ID."'";
    if (mysqli_query($conn, $delete)) {
      $_SESSION['notif'] = "Data Kolektif Berhasi Dihapus";
      header("Location: kolektif.php?refid=$KD_KANWIL.$KD_KPPBB.$THN_PELAYANAN.$BUNDEL_PELAYANAN.$NO_URUT_PELAYANAN");
    } else {
      $_SESSION['gagal'] = "Data Kolektif Gagal Dihapus";
      header("Location: kolektif.php?refid=$KD_KANWIL.$KD_KPPBB.$THN_PELAYANAN.$BUNDEL_PELAYANAN.'.'.$NO_URUT_PELAYANAN");
    }
  } else {
    echo "Tidak ada proses";
  }
 } else {
   if ($_SESSION['ROLE']=="PEMBATALAN") {
     header("Location: ../pembatalan/index.php");
   } else {
     header("Location: ../../index.php");
   }
} ?>
