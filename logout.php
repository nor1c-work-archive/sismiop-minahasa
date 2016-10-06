<?php
session_start();

if(!isset($_SESSION['NM_LOGIN']))
{
 header("Location: ./index.php");
}
else if(isset($_SESSION['NM_LOGIN'])!="")
{
 header("Location: ./pages/index.php");
}

if(isset($_GET['logout']))
{
 session_destroy();
 unset($_SESSION['NM_LOGIN']);
 unset($_SESSION['ROLE']);
 unset($_SESSION['cari']);
 header("Location: ./index.php");
}
?>