<?php
header('Content-type: application/json; charset=UTF-8');

include "../bin/dbconn.php";

$a97 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=1997";
$r97 = mysqli_query($conn, $a97);
$re97 = mysqli_fetch_assoc($r97);

$a98= "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=1998";
$r98 = mysqli_query($conn, $a98);
$re98 = mysqli_fetch_assoc($r98);

$a99 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=1999";
$r99 = mysqli_query($conn, $a99);
$re99 = mysqli_fetch_assoc($r99);

$a00 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2000";
$r00 = mysqli_query($conn, $a00);
$re00 = mysqli_fetch_assoc($r00);

$a01 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2001";
$r01 = mysqli_query($conn, $a01);
$re01 = mysqli_fetch_assoc($r01);

$a01 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2001";
$r01 = mysqli_query($conn, $a01);
$re01 = mysqli_fetch_assoc($r01);

$a02 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2002";
$r02 = mysqli_query($conn, $a02);
$re02 = mysqli_fetch_assoc($r02);

$a03 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2003";
$r03 = mysqli_query($conn, $a03);
$re03 = mysqli_fetch_assoc($r03);

$a04 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2004";
$r04 = mysqli_query($conn, $a04);
$re04 = mysqli_fetch_assoc($r04);

$a05 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2005";
$r05 = mysqli_query($conn, $a05);
$re05 = mysqli_fetch_assoc($r05);

$a06 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2006";
$r06 = mysqli_query($conn, $a06);
$re06 = mysqli_fetch_assoc($r06);

$a07 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2007";
$r07 = mysqli_query($conn, $a07);
$re07 = mysqli_fetch_assoc($r07);

$a08 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2008";
$r08 = mysqli_query($conn, $a08);
$re08 = mysqli_fetch_assoc($r08);

$a09 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2009";
$r09 = mysqli_query($conn, $a09);
$re09 = mysqli_fetch_assoc($r09);

$a10 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2010";
$r10 = mysqli_query($conn, $a10);
$re10 = mysqli_fetch_assoc($r10);

$a11 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2011";
$r11 = mysqli_query($conn, $a11);
$re11 = mysqli_fetch_assoc($r11);

$a12 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2012";
$r12 = mysqli_query($conn, $a12);
$re12 = mysqli_fetch_assoc($r12);

$a13 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2013";
$r13 = mysqli_query($conn, $a13);
$re13 = mysqli_fetch_assoc($r13);

$a14 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2014";
$r14 = mysqli_query($conn, $a14);
$re14 = mysqli_fetch_assoc($r14);

$a15 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2015";
$r15 = mysqli_query($conn, $a15);
$re15 = mysqli_fetch_assoc($r15);

$a16 = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) AS JML, THN_PAJAK_SPPT FROM pembayaran_sppt WHERE THN_PAJAK_SPPT=2016";
$r16 = mysqli_query($conn, $a16);
$re16 = mysqli_fetch_assoc($r16);

//create an array
$emparray = array();
    array_push(
      $emparray,
      // array('a' => $re97['THN_PAJAK_SPPT'],'x' => $re97['JML']),
      // array('a' => $re98['THN_PAJAK_SPPT'],'x' => $re98['JML']),
      // array('a' => $re99['THN_PAJAK_SPPT'],'x' => $re99['JML']),
      // array('a' => $re00['THN_PAJAK_SPPT'],'x' => $re00['JML']),
      array('a' => $re01['THN_PAJAK_SPPT'],'x' => $re01['JML']),
      array('a' => $re02['THN_PAJAK_SPPT'],'x' => $re02['JML']),
      array('a' => $re03['THN_PAJAK_SPPT'],'x' => $re03['JML']),
      array('a' => $re04['THN_PAJAK_SPPT'],'x' => $re04['JML']),
      array('a' => $re05['THN_PAJAK_SPPT'],'x' => $re05['JML']),
      array('a' => $re06['THN_PAJAK_SPPT'],'x' => $re06['JML']),
      array('a' => $re07['THN_PAJAK_SPPT'],'x' => $re07['JML']),
      array('a' => $re08['THN_PAJAK_SPPT'],'x' => $re08['JML']),
      array('a' => $re09['THN_PAJAK_SPPT'],'x' => $re09['JML']),
      array('a' => $re10['THN_PAJAK_SPPT'],'x' => $re10['JML']),
      array('a' => $re11['THN_PAJAK_SPPT'],'x' => $re11['JML']),
      array('a' => $re12['THN_PAJAK_SPPT'],'x' => $re12['JML']),
      array('a' => $re13['THN_PAJAK_SPPT'],'x' => $re13['JML']),
      // array('a' => $re14['THN_PAJAK_SPPT'],'x' => $re14['JML']),
      // array('a' => $re15['THN_PAJAK_SPPT'],'x' => $re15['JML']),
      array('a' => $re16['THN_PAJAK_SPPT'],'x' => $re16['JML'])
    );
echo json_encode($emparray);

?>
