<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
    
  if (isset($_POST['simpan']) || isset($_GET['simpan'])) {
    $KD_PROPINSI                          = $_POST['KD_PROPINSI'];
    $KD_DATI2                             = $_POST['KD_DATI2'];
    $KD_KECAMATAN                         = $_POST['KD_KECAMATAN'];
    $KD_KELURAHAN                         = $_POST['KD_KELURAHAN'];
    $KD_BLOK                              = $_POST['KD_BLOK'];
    $NO_URUT                              = $_POST['NO_URUT'];
    $KD_JNS_OP                            = $_POST['KD_JNS_OP'];
    $NO_FORMULIR                          = $_POST['THN_FORMULIR'].$_POST['INPUT_FORMULIR_2'].$_POST['INPUT_FORMULIR_3'];
    $NO_BNG                               = $_POST['NO_BNG'];
    $KD_JNS_DINDING                       = $_POST['KD_JNS_DINDING'];
    $KD_JNS_BNG                           = $_POST['KD_JNS_BNG'];
    $LUAS_BNG                             = $_POST['LUAS_BNG'];
    $JML_LANTAI                           = $_POST['JML_LANTAI'];
    $THN_DIBANGUN                         = $_POST['THN_DIBANGUN'];
    $THN_RENOVASI                         = $_POST['THN_RENOVASI'];
    $KD_KONDISI_BNG                       = $_POST['KD_KONDISI_BNG'];
    $KD_JNS_KONSTRUKSI                    = $_POST['KD_JNS_KONSTRUKSI'];
    $KD_JNS_ATAP                          = $_POST['KD_JNS_ATAP'];
    $KD_JNS_LANTAI                        = $_POST['KD_JNS_LANTAI'];
    $KD_JNS_LANGIT                        = $_POST['KD_JNS_LANGIT'];
    $DAYA_LISTRIK                         = $_POST['DAYA_LISTRIK'];
    $JML_SPLIT_AC                         = $_POST['JML_SPLIT_AC'];
    $JML_WINDOW_AC                        = $_POST['JML_WINDOW_AC'];
    $LUAS_KOLAM                           = $_POST['LUAS_KOLAM'];
    $KD_FINISHING_KOLAM                   = $_POST['KD_FINISHING_KOLAM'];
    $BETON_PLUS                           = $_POST['BETON_PLUS'];
    $ASPAL_PLUS                           = $_POST['ASPAL_PLUS'];
    $TANAH_PLUS                           = $_POST['TANAH_PLUS'];
    $BETON_MINUS                          = $_POST['BETON_MINUS'];
    $ASPAL_MINUS                          = $_POST['ASPAL_MINUS'];
    $TANAH_MINUS                          = $_POST['TANAH_MINUS'];
    $PANJANG_PAGAR                        = $_POST['PANJANG_PAGAR'];
    $JML_PABX                             = $_POST['JML_PABX'];
    $KD_AC_CENTRAL                        = $_POST['KD_AC_CENTRAL'];
    $RINGAN                               = $_POST['RINGAN'];
    $BERAT                                = $_POST['BERAT'];
    $SEDANG                               = $_POST['SEDANG'];
    $KD_BAHAN_PAGAR                       = $_POST['KD_BAHAN_PAGAR'];
    $DENGAN_PENUTUP_LANTAI                = $_POST['DENGAN_PENUTUP_LANTAI'];
    $JML_PENUMPANG                        = $_POST['JML_PENUMPANG'];
    $JML_KAPSUL                           = $_POST['JML_KAPSUL'];
    $JML_BARANG                           = $_POST['JML_BARANG'];
    $JML_TANGGA_BERJALAN_LEBIH_KECIL      = $_POST['JML_TANGGA_BERJALAN_LEBIH_KECIL'];
    $JML_TANGGA_BERJALAN_LEBIH_BESAR      = $_POST['JML_TANGGA_BERJALAN_LEBIH_BESAR'];
    $KD_STATUS_HYDRANT                    = $_POST['KD_STATUS_HYDRANT'];
    $KD_STATUS_SPRINKLER                  = $_POST['KD_STATUS_SPRINKLER'];
    $KD_STATUS_FIRE_ALARM                 = $_POST['KD_STATUS_FIRE_ALARM'];
    $KEDALAMAN_SUMUR_ARTETIS              = $_POST['KEDALAMAN_SUMUR_ARTETIS'];
    $KD_KLS_BNG                           = $_POST['KD_KLS_BNG'];
    $LUAS_KAMAR_AC_CENTRAL                = $_POST['LUAS_KAMAR_AC_CENTRAL'];
    $LUAS_RUANG_LAIN_AC_CENTRAL           = $_POST['LUAS_RUANG_LAIN_AC_CENTRAL'];
    $TGL_PENDATAAN                        = date('Y-m-d', time());
    $NIP_PENDATA                          = $_SESSION['NIP'];
    $TGL_PEREKAMAN                        = date('Y-m-d', time());
    $NIP_PEREKAM                          = $_POST['NIP_PEREKAM'];
    $TGL_KUNJUNGAN                        = $_POST['TGL_KUNJUNGAN'];

    $insert = "INSERT INTO LSPOP SET KD_PROPINSI='$KD_PROPINSI', KD_DATI2='$KD_DATI2', KD_KECAMATAN='$KD_KECAMATAN', KD_KELURAHAN='$KD_KELURAHAN', KD_BLOK='$KD_BLOK', NO_URUT='$NO_URUT', KD_JNS_OP='$KD_JNS_OP', NO_FORMULIR='$NO_FORMULIR', NO_BNG='$NO_BNG', KD_JNS_BNG='$KD_JNS_BNG', LUAS_BNG='$LUAS_BNG', JML_LANTAI='$JML_LANTAI', THN_DIBANGUN='$THN_DIBANGUN', THN_RENOVASI='$THN_RENOVASI', KD_KONDISI_BNG='$KD_KONDISI_BNG', KD_JNS_KONSTRUKSI='$KD_JNS_KONSTRUKSI', KD_JNS_ATAP='$KD_JNS_ATAP', KD_JNS_DINDING='$KD_JNS_DINDING', KD_JNS_LANTAI='$KD_JNS_LANTAI', KD_JNS_LANGIT='$KD_JNS_LANGIT', DAYA_LISTRIK='$DAYA_LISTRIK', JML_SPLIT_AC='$JML_SPLIT_AC', JML_WINDOW_AC='$JML_WINDOW_AC', LUAS_KOLAM='$LUAS_KOLAM', KD_FINISHING_KOLAM='$KD_FINISHING_KOLAM', BETON_PLUS='$BETON_PLUS', ASPAL_PLUS='$ASPAL_PLUS', TANAH_PLUS='$TANAH_PLUS', BETON_MINUS='$BETON_MINUS', ASPAL_MINUS='$ASPAL_MINUS', TANAH_MINUS='$TANAH_MINUS', PANJANG_PAGAR='$PANJANG_PAGAR', KD_BAHAN_PAGAR='$KD_BAHAN_PAGAR', JML_PABX='$JML_PABX', KD_AC_CENTRAL='$KD_AC_CENTRAL', RINGAN='$RINGAN', BERAT='$BERAT', SEDANG='$SEDANG', DENGAN_PENUTUP_LANTAI='$DENGAN_PENUTUP_LANTAI', JML_PENUMPANG='$JML_PENUMPANG', JML_KAPSUL='$JML_KAPSUL', JML_BARANG='$JML_BARANG', JML_TANGGA_BERJALAN_LEBIH_KECIL='$JML_TANGGA_BERJALAN_LEBIH_KECIL', JML_TANGGA_BERJALAN_LEBIH_BESAR='$JML_TANGGA_BERJALAN_LEBIH_BESAR', KD_STATUS_HYDRANT='$KD_STATUS_HYDRANT', KD_STATUS_SPRINKLER='$KD_STATUS_SPRINKLER', KD_STATUS_FIRE_ALARM='$KD_STATUS_FIRE_ALARM', KEDALAMAN_SUMUR_ARTETIS='$KEDALAMAN_SUMUR_ARTETIS', KD_KLS_BNG='$KD_KLS_BNG', LUAS_KAMAR_AC_CENTRAL='$LUAS_KAMAR_AC_CENTRAL', LUAS_RUANG_LAIN_AC_CENTRAL='$LUAS_RUANG_LAIN_AC_CENTRAL', TGL_PENDATAAN='$TGL_PENDATAAN', NIP_PENDATA='$NIP_PENDATA', TGL_PEREKAMAN='$TGL_PEREKAMAN', NIP_PEREKAM='$NIP_PEREKAM', TGL_KUNJUNGAN='$TGL_KUNJUNGAN'";
  
    if (mysqli_query($conn, $insert) or die (mysqli_error($conn))) {
      $_SESSION['notif'] = "SPOP Berhasil Disimpan";
      header("Location: spop.php");
    } else {
      $_SESSION['gagal'] = "SPOP Gagal Disimpan";
      header("Location: spop.php");
    }
  } else {
    $KD_PROPINSI          = $_SESSION['KD_PROPINSI'];
    $KD_DATI2             = $_SESSION['KD_DATI2'];
    $KD_KECAMATAN         = $_SESSION['KD_KECAMATAN'];
    $KD_KELURAHAN         = $_SESSION['KD_KELURAHAN'];
    $KD_BLOK              = $_SESSION['KD_BLOK'];
    $NO_URUT              = $_SESSION['NO_URUT'];
    $KD_JNS_OP            = $_SESSION['KD_JNS_OP'];
    $THN_FORMULIR         = $_SESSION['THN_FORMULIR'];
    $INPUT_FORMULIR_2     = $_SESSION['INPUT_FORMULIR_2'];
    $INPUT_FORMULIR_3     = $_SESSION['INPUT_FORMULIR_3'];
  }


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISMIOP PBB | PEMKAB. MINAHASA</title>

    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <!-- <link href="../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../dist/datepicker/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
</head>

<body>

    <div id="wrapper">

      <?php include("../header2.php") ?>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <!--<div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
<?php include '../menu.php';?>

<!-- BATAS MENU -->

                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Form LSPOP</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="glyphicon glyphicon-home"></i> Home &gt; Pendataan Objek Pajak &gt; LSPOP &gt; Tambah LSPOP
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                          <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="panel panel-default">
                            <div class="panel-heading"><center>Formulir</center></div>
                            <div class="panel-body">
                              <table>
                                <tr>
                                  <td style="padding-top:10px;" width="130">Jenis Formulir</td>
                                  <td style="padding-top:10px;">
                                    <input type="text" value="LSPOP" readonly disabled class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="130">Jenis Transaksi</td>
                                  <td style="padding-top:10px;">
                                    <select name="KD_JNS_TRANSAKSI" class="form-control">
                                      <option value="1">Pendataan Objek Pajak</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="130">Nomor Formulir</td>
                                  <td style="padding-top:10px;">
                                    <input type="text" name="THN_FORMULIR" class="form-control" style="width:15%;display:inline-block" maxLength="4" value="<?=$THN_FORMULIR?>" readonly>
                                    <input type="text" name="INPUT_FORMULIR_2" class="form-control" style="width:15%;display:inline-block" value="<?=$INPUT_FORMULIR_2?>" readonly>
                                    <input type="text" name="INPUT_FORMULIR_3" class="form-control" style="width:15%;display:inline-block" value="<?=$INPUT_FORMULIR_3?>" readonly>
                                  </td>
                                </tr>
                              </table>
                              <br>
                              <table>
                                <tr>
                                  <td width="130">NOP</td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="KD_PROPINSI" name="KD_PROPINSI" class="form-control" value="71" readonly="true">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="KD_DATI2" name="KD_DATI2" class="form-control" value="03" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="KD_KECAMATAN" name="KD_KECAMATAN" value="<?=$KD_KECAMATAN?>" class="form-control" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="KD_KELURAHAN" name="KD_KELURAHAN" value="<?=$KD_KELURAHAN?>" class="form-control" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="KD_BLOK" name="KD_BLOK" value="<?=$KD_BLOK?>" class="form-control" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="NO_URUT" name="NO_URUT" maxlength="4" class="form-control" value="<?=$NO_URUT?>" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="KD_JNS_OP" name="KD_JNS_OP" maxlength="1" class="form-control" value="<?=$KD_JNS_OP?>" readonly>
                                  </td>
                                  <td>
                                    <span id="check"></span>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading"><center>Rincian Data Bangunan</center></div>
                            <div class="panel-body">
                              <table style="float:left;">
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Nomor Bangunan</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="NO_BNG" placeholder="Nomor Bangunan" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jenis Bangunan</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_BNG">
                                      <option selected disabled readonly>PILIH JENIS BANGUNAN</option>
                                      <?php
                                      $sql = "select * from JPB_JPT";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) {
                                      ?>
                                        <option value="<?=$data['KD_JPB_JPT']?>"><?=$data['KD_JPB_JPT'].' - '.$data['NM_JPB_JPT']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Luas Bangunan</td>
                                  <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                    <input type="text" name="LUAS_BNG" placeholder="Luas Bangunan" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jumlah Lantai</td>
                                  <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                    <input type="text" name="JML_LANTAI" placeholder="Jumlah Lantai" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Tahun Dibangun</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="THN_DIBANGUN" placeholder="Tahun Dibangun" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Tahun Renovasi</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="THN_RENOVASI" placeholder="Tahun Renovasi" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Kondisi Bangunan</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_KONDISI_BNG">
                                      <option selected disabled readonly>PILIH KONDISI BANGUNAN</option>
                                      <?php
                                      $sql = "select * from REF_KONDISI_BNG";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) {
                                      ?>
                                        <option value="<?=$data['KD_KONDISI_BNG']?>"><?=$data['KD_KONDISI_BNG'].' - '.$data['KONDISI_BNG']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                              </table>
                              <table style="float:right">
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Konstruksi</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_KONSTRUKSI">
                                      <option selected disabled readonly>PILIH JENIS KONSTRUKSI</option>
                                      <?php 
                                      $sql = "select * from REF_JNS_KONSTRUKSI"; 
                                      $sqla = mysqli_query($conn, $sql); 
                                      while ($konst = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$konst['KD_JNS_KONSTRUKSI']?>"><?=$konst['KD_JNS_KONSTRUKSI'].' - '.$konst['NM_JNS_KONSTRUKSI']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Atap</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_ATAP">
                                      <option selected disabled readonly>PILIH JENIS ATAP</option>
                                      <?php 
                                      $sql = "select * from REF_JNS_ATAP"; 
                                      $sqla = mysqli_query($conn, $sql); 
                                      while ($konst = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$konst['KD_JNS_ATAP']?>"><?=$konst['KD_JNS_ATAP'].' - '.$konst['NM_JNS_ATAP']?></option>
                                      <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Dinding</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_DINDING">
                                      <option selected disabled readonly>PILIH JENIS DINDING</option>
                                      <?php 
                                      $sql = "select * from REF_JNS_DINDING"; 
                                      $sqla = mysqli_query($conn, $sql); 
                                      while ($konst = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$konst['KD_JNS_DINDING']?>"><?=$konst['KD_JNS_DINDING'].' - '.$konst['NM_JNS_DINDING']?></option>
                                      <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Lantai</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_LANTAI">
                                      <option selected disabled readonly>PILIH JENIS LANTAI</option>
                                      <?php 
                                      $sql = "select * from REF_JNS_LANTAI"; 
                                      $sqla = mysqli_query($conn, $sql); 
                                      while ($konst = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$konst['KD_JNS_LANTAI']?>"><?=$konst['KD_JNS_LANTAI'].' - '.$konst['NM_JNS_LANTAI']?></option>
                                      <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Langit-langit</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_LANGIT">
                                      <option selected disabled readonly>PILIH JENIS LANGIT-LANGIT</option>
                                      <?php 
                                      $sql = "select * from REF_JNS_LANGIT"; 
                                      $sqla = mysqli_query($conn, $sql); 
                                      while ($konst = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$konst['KD_JNS_LANGIT']?>"><?=$konst['KD_JNS_LANGIT'].' - '.$konst['NM_JNS_LANGIT']?></option>
                                      <?php } ?>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading"><center>Fasilitas</center></div>
                            <div class="panel-body">
                              <table style="float:left;">
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Daya Listrik</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="DAYA_LISTRIK" placeholder="Daya Listrik" class="form-control" style="display:inline-block;width:50%"> Watt
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jumlah AC</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="JML_SPLIT_AC" placeholder="Split AC" class="form-control" style="display:inline-block;width:30%;"> Split &nbsp;&nbsp;&nbsp;
                                    <input type="text" name="JML_WINDOW_AC" placeholder="Window AC" class="form-control" style="display:inline-block;width:30%"> Window
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Luas Kolam Renang</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="LUAS_KOLAM" placeholder="Luas Kolam Renang" class="form-control" style="display:inline-block;width:70%"> M2
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Finishing Kolam</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_FINISHING_KOLAM">
                                      <option selected readonly disabled>PILIH FINISHING KOLAM</option>
                                      <?php $sql = "select * from REF_FINISHING_KOLAM"; $sqla = mysqli_query($conn, $sql) or die(mysqli_error($conn)); while ($kol = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$kol['KD_FINISHING_KOLAM']?>"><?=$kol['NM_FINISHING_KOLAM']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="200"><b>Jumlah Lapangan Tenis</b></td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">+Lampu</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <input type="text" name="BETON_PLUS" placeholder="Beton" class="form-control" style="display:inline-block;width:30%">
                                    <input type="text" name="ASPAL_PLUS" placeholder="Aspal" class="form-control" style="display:inline-block;width:30%">
                                    <input type="text" name="TANAH_PLUS" placeholder="Tanah Liat/Rumput" class="form-control" style="display:inline-block;width:30%">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">-Lampu</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <input type="text" name="BETON_MINUS" placeholder="Beton" class="form-control" style="display:inline-block;width:30%">
                                    <input type="text" name="ASPAL_MINUS" placeholder="Aspal" class="form-control" style="display:inline-block;width:30%">
                                    <input type="text" name="TANAH_MINUS" placeholder="Tanah Liat/Rumput" class="form-control" style="display:inline-block;width:30%">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Panjang Pagar</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <input type="text" name="PANJANG_PAGAR" placeholder="Panjang Pagar" class="form-control" style="display:inline-block;width:50%"> M
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Bahan Pagar</td>
                                  <td style="padding-bottom:10px;" placeholder="Jalan OP" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_BAHAN_PAGAR">
                                      <option selected readonly disabled>PILIH BAHAN PAGAR</option>
                                      <?php $sql = "select * from REF_JNS_BAHAN_PAGAR"; $sqla= mysqli_query($conn, $sql); while ($pgr = mysqli_fetch_assoc($sqla)) { ?>
                                          <option value="<?=$pgr['KD_JNS_BAHAN']?>"><?=$pgr['NM_JNS_BAHAN']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jumlah PABX</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <input type="text" name="JML_PABX" placeholder="Jumlah PABX" class="form-control" style="display:inline-block;width:50%">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">AC Central</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <label style="font-weight:100">
                                      <input type="hidden" value="1" name="KD_AC_CENTRAL">
                                      <input type="checkbox" value="0" name="KD_AC_CENTRAL" placeholder="Jumlah PABX"> Tidak ada AC Central
                                    </label>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Luas Perkerasan Halaman (M2)</td>
                                  <td style="padding-bottom:10px;" width="900" style="padding-right:10px;">
                                    <input type="text" name="RINGAN" placeholder="Ringan" class="form-control" style="display:inline-block;width:20%">
                                    <input type="text" name="BERAT" placeholder="Berat" class="form-control" style="display:inline-block;width:20%">
                                    <input type="text" name="SEDANG" placeholder="Sedang" class="form-control" style="display:inline-block;width:20%">
                                    <input type="text" name="DENGAN_PENUTUP_LANTAI" placeholder="Dengan Penutup Lantai" class="form-control" style="display:inline-block;width:20%">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jumlah Lift</td>
                                  <td style="padding-bottom:10px;" width="900" style="padding-right:10px;">
                                    <input type="text" name="JML_PENUMPANG" placeholder="Penumpang" class="form-control" style="display:inline-block;width:20%">
                                    <input type="text" name="JML_KAPSUL" placeholder="Kapsul" class="form-control" style="display:inline-block;width:20%">
                                    <input type="text" name="JML_BARANG" placeholder="Barang" class="form-control" style="display:inline-block;width:20%">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jumlah Tangga Berjalan</td>
                                  <td style="padding-bottom:10px;" width="900" style="padding-right:10px;">
                                    <input type="text" name="JML_TANGGA_BERJALAN_LEBIH_KECIL" placeholder="Lbr <- 0,80M" class="form-control" style="display:inline-block;width:20%">
                                    <input type="text" name="JML_TANGGA_BERJALAN_LEBIH_BESAR" placeholder="Lbr > 0,80M" class="form-control" style="display:inline-block;width:20%">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="200"><b>Pemadan Kebakaran</b></td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Hydrant</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <label style="font-weight:100">
                                      <input type="hidden" value="0" name="KD_STATUS_HYDRANT">
                                      <input type="checkbox" value="1" name="KD_STATUS_HYDRANT"> Ada Hydrant
                                    </label>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Sprinkler</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <label style="font-weight:100">
                                      <input type="hidden" value="1" name="KD_STATUS_SPRINKLER">
                                      <input type="checkbox" value="0" name="KD_STATUS_SPRINKLER"> Tidak Ada Sprinkler 
                                    </label>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Fire Alarm</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <label style="font-weight:100">
                                      <input type="hidden" value="1" name="KD_STATUS_FIRE_ALARM">
                                      <input type="checkbox" value="0" name="KD_STATUS_FIRE_ALARM"> Tidak Fire Alarm
                                    </label>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Kedalaman Sumur Artetis</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <input type="text" name="KEDALAMAN_SUMUR_ARTETIS" placeholder="Kedalaman Sumur Artetis" class="form-control" style="display:inline-block;width:50%"> M
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading"><center>Data Tambahan</center></div>
                            <div class="panel-body">
                              <table style="float:left;">
                                <tr>
                                  <td style="padding-bottom:10px;" width="300">Bangunan</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_KLS_BNG">
                                      <option selected readonly disabled>PILIH KELAS BANGUNAN</option>
                                      <?php
                                      $sql = "select * from KELAS_BANGUNAN_2016";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($bng = mysqli_fetch_assoc($sqla)) {
                                      ?>
                                        <option value="<?=$bng['KD_KLS_BNG']?>"><?=$bng['KD_KLS_BNG']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Luas Kamar dengan AC Central</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="LUAS_KAMAR_AC_CENTRAL" placeholder="Luas Kamar" class="form-control" style="">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Luas Ruang Lain dengan AC Central</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="LUAS_RUANG_LAIN_AC_CENTRAL" placeholder="Luas Ruang Lain" class="form-control" style="">
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading"><center>Identitas Pendata / Pejabat Yang Berwenang</center></div>
                            <div class="panel-body">
                              <table style="float:left;">
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Tanggal Pendataan</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;">
                                    <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=date('Y-m-d', time())?>">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Tanggal Kunjungan Kembali</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;">
                                    <input placeholder="Tanggal Kunjungan Kembali" class="form-control" name="TGL_KUNJUNGAN" type="text" value="">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                  </td>
                                </tr>
                                <!--<tr>
                                  <td style="padding-bottom:10px;" width="130">Tanggal Penelitian</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;">
                                    <input placeholder="Tanggal Penelitian" class="form-control" name="TGL_PENELITIAN" type="text" value="">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                  </td>
                                </tr>-->
                              </table>
                              <table style="float:right">
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">NIP Perekam</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="NIP_PEREKAM" placeholder="NIP Pendata" class="form-control" value="<?=$_SESSION['NIP']?>">
                                  </td>
                                </tr>
                                <!--<tr>
                                  <td style="padding-bottom:10px;" width="130">NIP Peneliti</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="NIP_PENELITI" class="form-control">
                                  </td>
                                </tr>-->
                              </table>
                            </div>
                          </div>

                          <table style="float:right;">
                            <tr>
                              <td>
                                <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" >
                                <a href="lspop.php" class="btn btn-default" >Batal</a>
                              </td>
                            </tr>
                          </table>
                          </form>

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->

            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
    <script type="text/javascript">
      $(function() {
      $("#graph_select2").change(function() {
        if ($("#nop2").is(":selected")) {
          $("#nops2").show();
          $("#nmwps2").hide();
          $("#jlnops2").hide();
          $("#formulirs2").hide();
        } else if ($("#nmwp2").is(":selected")) {
          $("#nops2").hide();
          $("#nmwps2").show();
          $("#jlnops2").hide();
          $("#formulirs2").hide();
        } else if ($("#jlnop2").is(":selected")) {
          $("#nops2").hide();
          $("#nmwps2").hide();
          $("#jlnops2").show();
          $("#formulirs2").hide();
        } else if ($("#formulir2").is(":selected")) {
          $("#nops2").hide();
          $("#nmwps2").hide();
          $("#jlnops2").hide();
          $("#formulirs2").show();
        } else {
          $("#nops2").hide();
          $("#nmwps2").hide();
          $("#jlnops2").hide();
          $("#formulirs2").hide();
        }
      }).trigger('change');
      });
    </script>
        <script>
            $(document).ready(function (){
 
                var checked = false;
 
                $('#checkbtn').click(function (){
 
                    var KD_KECAMATAN = $('input[name="KD_KECAMATAN"]').val();
                    var KD_KELURAHAN = $('input[name="KD_KELURAHAN"]').val();
                    var KD_BLOK = $('input[name="KD_BLOK"]').val();
                    var NO_URUT = $('input[name="NO_URUT"]').val();
                    var KD_JNS_OP = $('input[name="KD_JNS_OP"]').val();
                    $.post(
                        'proses.php',
                        { kecamatan : KD_KECAMATAN, kelurahan : KD_KELURAHAN, blok : KD_BLOK, no_urut : NO_URUT, jenis_op : KD_JNS_OP },
                        function (data)
                        {
                            if (data == 1) {
                              $('#check').html("<span style='color:green'>NOP Dapat Digunakan</span>");
                            } else {
                              $('#check').html("<span style='color:red'>NOP Sudah Digunakan</span>");
                            }
                        }
                    );
                    if(KD_KECAMATAN == '' || KD_KELURAHAN == '' || KD_BLOK == '' || NO_URUT == '' || KD_JNS_OP == '') {
                      $('#check').html("Silahkan Diisi Terlebih Dahulu");
                    }
                });
            });
        </script>
<script type="text/javascript" src="../../dist/datepicker/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../dist/datepicker/bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../../dist/datepicker/bootstrap/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            //language:  'fr',
            weekStart: 1,
            todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
            showMeridian: 1
        });
      $('.form_date').datetimepicker({
            language:  'fr',
            weekStart: 1,
            todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
        });
      $('.form_time').datetimepicker({
            language:  'fr',
            weekStart: 1,
            todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
        });
    </script>
</body>

</html>



<?php
} else {
   if ($_SESSION['ROLE']=="PEMBATALAN") {
     header("Location: ../pembatalan/index.php");
   } else {
     header("Location: ../../index.php");
   }
} 
      unset($_SESSION['KD_PROPINSI']);
      unset($_SESSION['KD_DATI2']);
      unset($_SESSION['KD_KECAMATAN']);
      unset($_SESSION['KD_KELURAHAN']);
      unset($_SESSION['KD_BLOK']);
      unset($_SESSION['NO_URUT']);
      unset($_SESSION['KD_JNS_OP']);
      unset($_SESSION['THN_FORMULIR']);
      unset($_SESSION['INPUT_FORMULIR_2']);
      unset($_SESSION['INPUT_FORMULIR_3']);
?>
