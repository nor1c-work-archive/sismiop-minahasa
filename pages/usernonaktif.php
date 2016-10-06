<?php
session_start();//session starts here
include '../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['userid']) || isset($_POST['userid'])) {
  $IDL = $_GET['userid'];

  $updq = "update DAT_LOGIN SET STATUS='TIDAK AKTIF' WHERE ID='$IDL'";
  if (mysqli_query($conn, $updq)) {
    header("Location: userlist.php");
  } else {
    mysql_error($conn);
  }
} else {
  echo "Tidak ada proses";
}
?>