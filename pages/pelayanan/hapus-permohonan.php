<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
  if (isset($_POST['refid']) || isset($_GET['refid'])) {
    list($KD_KANWIL, $KD_KPPBB, $THN_PELAYANAN, $BUNDEL_PELAYANAN, $NO_URUT_PELAYANAN) = explode(".", $_GET['refid']);

    $delete = "DELETE FROM PST_PERMOHONAN WHERE KD_KANWIL='".$KD_KANWIL."' AND KD_KPPBB='".$KD_KPPBB."' AND THN_PELAYANAN='".$THN_PELAYANAN."' AND BUNDEL_PELAYANAN='".$BUNDEL_PELAYANAN."' AND NO_URUT_PELAYANAN='".$NO_URUT_PELAYANAN."'";
    if (mysqli_query($conn, $delete)) {
      $delete2 = "DELETE FROM PST_DETAIL WHERE KD_KANWIL='".$KD_KANWIL."' AND KD_KPPBB='".$KD_KPPBB."' AND THN_PELAYANAN='".$THN_PELAYANAN."' AND BUNDEL_PELAYANAN='".$BUNDEL_PELAYANAN."' AND NO_URUT_PELAYANAN='".$NO_URUT_PELAYANAN."'";
      if (mysqli_query($conn, $delete2)) {
        $delete3 = "DELETE FROM PST_LAMPIRAN WHERE KD_KANWIL='".$KD_KANWIL."' AND KD_KPPBB='".$KD_KPPBB."' AND THN_PELAYANAN='".$THN_PELAYANAN."' AND BUNDEL_PELAYANAN='".$BUNDEL_PELAYANAN."' AND NO_URUT_PELAYANAN='".$NO_URUT_PELAYANAN."'";
        if(mysqli_query($conn, $delete3)) {
          $delete4 = "DELETE FROM PST_PERMOHONAN_KOLEKTIF WHERE KD_KANWIL='".$KD_KANWIL."' AND KD_KPPBB='".$KD_KPPBB."' AND THN_PELAYANAN='".$THN_PELAYANAN."' AND BUNDEL_PELAYANAN='".$BUNDEL_PELAYANAN."' AND NO_URUT_PELAYANAN='".$NO_URUT_PELAYANAN."'";
          if (mysqli_query($conn, $delete4)) {
              $_SESSION['notif'] = "Data Permohonan Berhasil Dihapus";
              header("Location: index.php");
            } else {
              $_SESSION['gagal'] = "Data Permohonan Gagal Dihapus";
              header("Location: index.php");
          }
        }
      } else {
        echo mysqli_error($conn);
      }
    } else {
        echo mysqli_error($conn);
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
