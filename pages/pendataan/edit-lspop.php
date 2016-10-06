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

    $update = "UPDATE LSPOP SET NO_BNG='$NO_BNG', KD_JNS_BNG='$KD_JNS_BNG', LUAS_BNG='$LUAS_BNG', JML_LANTAI='$JML_LANTAI', THN_DIBANGUN='$THN_DIBANGUN', THN_RENOVASI='$THN_RENOVASI', KD_KONDISI_BNG='$KD_KONDISI_BNG', KD_JNS_KONSTRUKSI='$KD_JNS_KONSTRUKSI', KD_JNS_ATAP='$KD_JNS_ATAP', KD_JNS_DINDING='$KD_JNS_DINDING', KD_JNS_LANTAI='$KD_JNS_LANTAI', KD_JNS_LANGIT='$KD_JNS_LANGIT', DAYA_LISTRIK='$DAYA_LISTRIK', JML_SPLIT_AC='$JML_SPLIT_AC', JML_WINDOW_AC='$JML_WINDOW_AC', LUAS_KOLAM='$LUAS_KOLAM', KD_FINISHING_KOLAM='$KD_FINISHING_KOLAM', BETON_PLUS='$BETON_PLUS', ASPAL_PLUS='$ASPAL_PLUS', TANAH_PLUS='$TANAH_PLUS', BETON_MINUS='$BETON_MINUS', ASPAL_MINUS='$ASPAL_MINUS', TANAH_MINUS='$TANAH_MINUS', PANJANG_PAGAR='$PANJANG_PAGAR', KD_BAHAN_PAGAR='$KD_BAHAN_PAGAR', JML_PABX='$JML_PABX', KD_AC_CENTRAL='$KD_AC_CENTRAL', RINGAN='$RINGAN', BERAT='$BERAT', SEDANG='$SEDANG', DENGAN_PENUTUP_LANTAI='$DENGAN_PENUTUP_LANTAI', JML_PENUMPANG='$JML_PENUMPANG', JML_KAPSUL='$JML_KAPSUL', JML_BARANG='$JML_BARANG', JML_TANGGA_BERJALAN_LEBIH_KECIL='$JML_TANGGA_BERJALAN_LEBIH_KECIL', JML_TANGGA_BERJALAN_LEBIH_BESAR='$JML_TANGGA_BERJALAN_LEBIH_BESAR', KD_STATUS_HYDRANT='$KD_STATUS_HYDRANT', KD_STATUS_SPRINKLER='$KD_STATUS_SPRINKLER', KD_STATUS_FIRE_ALARM='$KD_STATUS_FIRE_ALARM', KEDALAMAN_SUMUR_ARTETIS='$KEDALAMAN_SUMUR_ARTETIS', KD_KLS_BNG='$KD_KLS_BNG', LUAS_KAMAR_AC_CENTRAL='$LUAS_KAMAR_AC_CENTRAL', LUAS_RUANG_LAIN_AC_CENTRAL='$LUAS_RUANG_LAIN_AC_CENTRAL', TGL_PENDATAAN='$TGL_PENDATAAN', NIP_PENDATA='$NIP_PENDATA', TGL_PEREKAMAN='$TGL_PEREKAMAN', NIP_PEREKAM='$NIP_PEREKAM', TGL_KUNJUNGAN='$TGL_KUNJUNGAN' WHERE KD_PROPINSI='$KD_PROPINSI' and KD_DATI2='$KD_DATI2' and KD_KECAMATAN='$KD_KECAMATAN' and KD_KELURAHAN='$KD_KELURAHAN' and KD_BLOK='$KD_BLOK' and NO_URUT='$NO_URUT' and KD_JNS_OP='$KD_JNS_OP' and NO_FORMULIR='$NO_FORMULIR'";
  
    if (mysqli_query($conn, $update) or die (mysqli_error($conn))) {
      $_SESSION['notif'] = "LSPOP Berhasil Diupdate";
      header("Location: spop.php");
    } else {
      $_SESSION['gagal'] = "LSPOP Gagal Diupdate";
      header("Location: spop.php");
    }
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
                          <?php $sql = "select * from LSPOP where NO_FORMULIR='".$_GET['refid']."'";
                          $sqla = mysqli_query($conn, $sql);
                          while ($lspop = mysqli_fetch_assoc($sqla)) { ?>
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
                                    <?php 
                                      $dynamicstring = $lspop['NO_FORMULIR'];
                                    ?>
                                    <input type="text" required id="THN_FORMULIR" name="THN_FORMULIR" class="form-control" style="width:15%;display:inline-block" value="<?=substr($dynamicstring, 0, -7)?>" maxLength="4" readonly>
                                    <input type="text" required id="INPUT_FORMULIR_2" name="INPUT_FORMULIR_2" class="form-control" style="width:15%;display:inline-block" value="<?=substr($dynamicstring, 4, -3)?>" readonly>
                                    <input type="text" required id="INPUT_FORMULIR_3" value="<?=substr($dynamicstring, -3);?>" name="INPUT_FORMULIR_3" class="form-control" style="width:15%;display:inline-block" readonly>
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
                                    <input type="text" id="KD_KECAMATAN" name="KD_KECAMATAN" value="<?=$lspop['KD_KECAMATAN']?>" class="form-control" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="KD_KELURAHAN" name="KD_KELURAHAN" value="<?=$lspop['KD_KELURAHAN']?>" class="form-control" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="KD_BLOK" name="KD_BLOK" value="<?=$lspop['KD_BLOK']?>" class="form-control" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="NO_URUT" name="NO_URUT" maxlength="4" class="form-control" readonly value="<?=$lspop['NO_URUT']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" id="KD_JNS_OP" name="KD_JNS_OP" maxlength="1" class="form-control" readonly value="<?=$lspop['KD_JNS_OP']?>">
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
                                    <input type="text" name="NO_BNG" placeholder="Nomor Bangunan" class="form-control" value="<?=$lspop['NO_BNG']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jenis Bangunan</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_BNG">
                                      <?php
                                      $sql = "select * from JPB_JPT where KD_JPB_JPT='".$lspop['KD_JNS_BNG']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) {
                                      ?>
                                        <option selected hidden readonly value="<?=$data['KD_JPB_JPT']?>"><?=$data['KD_JPB_JPT']?> - <?=$data['NM_JPB_JPT']?></option>
                                      <?php } ?>
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
                                    <input type="text" name="LUAS_BNG" placeholder="Luas Bangunan" class="form-control" value=<?=$lspop['LUAS_BNG']?>>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jumlah Lantai</td>
                                  <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                    <input type="text" name="JML_LANTAI" placeholder="Jumlah Lantai" class="form-control" value="<?=$lspop['JML_LANTAI']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Tahun Dibangun</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="THN_DIBANGUN" placeholder="Tahun Dibangun" class="form-control" value="<?=$lspop['THN_DIBANGUN']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Tahun Renovasi</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="THN_RENOVASI" placeholder="Tahun Renovasi" class="form-control" value="<?=$lspop['THN_RENOVASI']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Kondisi Bangunan</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_KONDISI_BNG">
                                      <?php
                                      $sql = "select * from REF_KONDISI_BNG where KD_KONDISI_BNG='".$lspop['KD_KONDISI_BNG']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) {
                                      ?>
                                      <option selected hidden readonly value="<?=$data['KD_KONDISI_BNG']?>"><?=$data['KD_KONDISI_BNG'].' - '.$data['KONDISI_BNG']?></option>
                                      <?php }
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
                                      <?php
                                      $sql = "select * from REF_JNS_KONSTRUKSI where KD_JNS_KONSTRUKSI='".$lspop['KD_JNS_KONSTRUKSI']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option selected hidden readonly value="<?=$data['KD_JNS_KONSTRUKSI']?>"><?=$data['KD_JNS_KONSTRUKSI'] .' - '. $data['NM_JNS_KONSTRUKSI']?></option>
                                      <?php } ?>
                                      <?php
                                      $sql = "select * from REF_JNS_KONSTRUKSI";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$data['KD_JNS_KONSTRUKSI']?>"><?=$data['KD_JNS_KONSTRUKSI'] .' - '. $data['NM_JNS_KONSTRUKSI']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Atap</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_ATAP">
                                      <?php
                                      $sql = "select * from REF_JNS_ATAP where KD_JNS_ATAP='".$lspop['KD_JNS_ATAP']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option selected hidden readonly value="<?=$data['KD_JNS_ATAP']?>"><?=$data['KD_JNS_ATAP'] .' - '. $data['NM_JNS_ATAP']?></option>
                                      <?php } ?>
                                      <?php
                                      $sql = "select * from REF_JNS_ATAP";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$data['KD_JNS_ATAP']?>"><?=$data['KD_JNS_ATAP'] .' - '. $data['NM_JNS_ATAP']?></option>
                                      <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Dinding</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_DINDING">
                                      <?php
                                      $sql = "select * from REF_JNS_DINDING where KD_JNS_DINDING='".$lspop['KD_JNS_DINDING']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option selected hidden readonly value="<?=$data['KD_JNS_DINDING']?>"><?=$data['KD_JNS_DINDING'] .' - '. $data['NM_JNS_DINDING']?></option>
                                      <?php } ?>
                                      <?php
                                      $sql = "select * from REF_JNS_DINDING";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$data['KD_JNS_DINDING']?>"><?=$data['KD_JNS_DINDING'] .' - '. $data['NM_JNS_DINDING']?></option>
                                      <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Lantai</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_LANTAI">
                                      <?php
                                      $sql = "select * from REF_JNS_LANTAI where KD_JNS_LANTAI='".$lspop['KD_JNS_LANTAI']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option selected hidden readonly value="<?=$data['KD_JNS_LANTAI']?>"><?=$data['KD_JNS_LANTAI'] .' - '. $data['NM_JNS_LANTAI']?></option>
                                      <?php } ?>
                                      <?php
                                      $sql = "select * from REF_JNS_LANTAI";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$data['KD_JNS_LANTAI']?>"><?=$data['KD_JNS_LANTAI'] .' - '. $data['NM_JNS_LANTAI']?></option>
                                      <?php } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Langit-langit</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_LANGIT">
                                      <?php
                                      $sql = "select * from REF_JNS_LANGIT where KD_JNS_LANGIT='".$lspop['KD_JNS_LANGIT']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option selected hidden readonly value="<?=$data['KD_JNS_LANGIT']?>"><?=$data['KD_JNS_LANGIT'] .' - '. $data['NM_JNS_LANGIT']?></option>
                                      <?php } ?>
                                      <?php
                                      $sql = "select * from REF_JNS_LANGIT";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$data['KD_JNS_LANGIT']?>"><?=$data['KD_JNS_LANGIT'] .' - '. $data['NM_JNS_LANGIT']?></option>
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
                                    <input type="text" name="DAYA_LISTRIK" placeholder="Daya Listrik" class="form-control" style="display:inline-block;width:50%" value="<?=$lspop['DAYA_LISTRIK']?>"> Watt
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jumlah AC</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="JML_SPLIT_AC" placeholder="Split AC" class="form-control" style="display:inline-block;width:30%;" value="<?=$lspop['JML_SPLIT_AC']?>"> Split &nbsp;&nbsp;&nbsp;
                                    <input type="text" name="JML_WINDOW_AC" placeholder="Window AC" class="form-control" style="display:inline-block;width:30%" value="<?=$lspop['JML_WINDOW_AC']?>"> Window
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Luas Kolam Renang</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="LUAS_KOLAM" placeholder="Luas Kolam Renang" class="form-control" style="display:inline-block;width:70%" value="<?=$lspop['LUAS_KOLAM']?>"> M2
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Finishing Kolam</td>
                                  <td style="padding-bottom:10px;" placeholder="Jalan OP" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_FINISHING_KOLAM">
                                      <?php
                                      $sql = "select * from REF_FINISHING_KOLAM where KD_FINISHING_KOLAM='".$lspop['KD_FINISHING_KOLAM']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option selected hidden readonly value="<?=$data['KD_FINISHING_KOLAM']?>"><?=$data['KD_FINISHING_KOLAM'] .' - '. $data['NM_FINISHING_KOLAM']?></option>
                                      <?php } ?>
                                      <?php
                                      $sql = "select * from REF_FINISHING_KOLAM";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$data['KD_FINISHING_KOLAM']?>"><?=$data['KD_FINISHING_KOLAM'] .' - '. $data['NM_FINISHING_KOLAM']?></option>
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
                                    <input type="text" name="BETON_PLUS" placeholder="Beton" class="form-control" style="display:inline-block;width:30%" value="<?=$lspop['BETON_PLUS']?>">
                                    <input type="text" name="ASPAL_PLUS" placeholder="Aspal" class="form-control" style="display:inline-block;width:30%" value="<?=$lspop['ASPAL_PLUS']?>">
                                    <input type="text" name="TANAH_PLUS" placeholder="Tanah Liat/Rumput" class="form-control" style="display:inline-block;width:30%" value="<?=$lspop['TANAH_PLUS']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">-Lampu</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <input type="text" name="BETON_MINUS" placeholder="Beton" class="form-control" style="display:inline-block;width:30%" value="<?=$lspop['BETON_MINUS']?>">
                                    <input type="text" name="ASPAL_MINUS" placeholder="Aspal" class="form-control" style="display:inline-block;width:30%" value="<?=$lspop['ASPAL_MINUS']?>">
                                    <input type="text" name="TANAH_MINUS" placeholder="Tanah Liat/Rumput" class="form-control" style="display:inline-block;width:30%" value="<?=$lspop['TANAH_MINUS']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Panjang Pagar</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <input type="text" name="PANJANG_PAGAR" placeholder="Panjang Pagar" class="form-control" style="display:inline-block;width:50%" value="<?=$lspop['PANJANG_PAGAR']?>"> M
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Bahan Pagar</td>
                                  <td style="padding-bottom:10px;" placeholder="Jalan OP" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_BAHAN_PAGAR">
                                      <?php
                                      $sql = "select * from REF_JNS_BAHAN_PAGAR where KD_JNS_BAHAN='".$lspop['KD_BAHAN_PAGAR']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option selected hidden readonly value="<?=$data['KD_JNS_BAHAN']?>"><?=$data['KD_JNS_BAHAN'] .' - '. $data['NM_JNS_BAHAN']?></option>
                                      <?php } ?>
                                      <?php
                                      $sql = "select * from REF_JNS_BAHAN_PAGAR";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$data['KD_JNS_BAHAN']?>"><?=$data['KD_JNS_BAHAN'] .' - '. $data['NM_JNS_BAHAN']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jumlah PABX</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <input type="text" name="JML_PABX" placeholder="Jumlah PABX" class="form-control" style="display:inline-block;width:50%" value="<?=$lspop['JML_PABX']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">AC Central</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <label style="font-weight:100">
                                      <input type="hidden" name="KD_AC_CENTRAL" value="1">
                                      <?php
                                      if ($lspop['KD_AC_CENTRAL']=="0") { ?>
                                        <input type="checkbox" checked name="KD_AC_CENTRAL" value="0"> Tidak ada AC Central
                                      <?php } else { ?>
                                        <input type="checkbox" name="KD_AC_CENTRAL" value="0"> Tidak ada AC Central
                                      <?php } ?>
                                    </label>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Luas Perkerasan Halaman (M2)</td>
                                  <td style="padding-bottom:10px;" width="900" style="padding-right:10px;">
                                    <input type="text" name="RINGAN" placeholder="Ringan" class="form-control" style="display:inline-block;width:20%" value="<?=$lspop['RINGAN']?>">
                                    <input type="text" name="BERAT" placeholder="Berat" class="form-control" style="display:inline-block;width:20%" value="<?=$lspop['BERAT']?>">
                                    <input type="text" name="SEDANG" placeholder="Sedang" class="form-control" style="display:inline-block;width:20%" value="<?=$lspop['SEDANG']?>">
                                    <input type="text" name="DENGAN_PENUTUP_LANTAI" placeholder="Dengan Penutup Lantai" class="form-control" style="display:inline-block;width:20%" value="<?=$lspop['DENGAN_PENUTUP_LANTAI']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jumlah Lift</td>
                                  <td style="padding-bottom:10px;" width="900" style="padding-right:10px;">
                                    <input type="text" name="JML_PENUMPANG" placeholder="Penumpang" class="form-control" style="display:inline-block;width:20%" value="<?=$lspop['JML_PENUMPANG']?>">
                                    <input type="text" name="JML_KAPSUL" placeholder="Kapsul" class="form-control" style="display:inline-block;width:20%" value="<?=$lspop['JML_KAPSUL']?>">
                                    <input type="text" name="JML_BARANG" placeholder="Barang" class="form-control" style="display:inline-block;width:20%" value="<?=$lspop['JML_BARANG']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jumlah Tangga Berjalan</td>
                                  <td style="padding-bottom:10px;" width="900" style="padding-right:10px;">
                                    <input type="text" name="JML_TANGGA_BERJALAN_LEBIH_KECIL" placeholder="Lbr <- 0,80M" class="form-control" style="display:inline-block;width:20%" value="<?=$lspop['JML_TANGGA_BERJALAN_LEBIH_KECIL']?>">
                                    <input type="text" name="JML_TANGGA_BERJALAN_LEBIH_BESAR" placeholder="Lbr > 0,80M" class="form-control" style="display:inline-block;width:20%" value="<?=$lspop['JML_TANGGA_BERJALAN_LEBIH_BESAR']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="200"><b>Pemadan Kebakaran</b></td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Hydrant</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <label style="font-weight:100">
                                      <input type="hidden" name="KD_STATUS_HYDRANT" value="0">
                                      <?php
                                      if ($lspop['KD_STATUS_HYDRANT']=="1") { ?>
                                        <input type="checkbox" checked name="KD_STATUS_HYDRANT" value="1"> Ada Hydrant
                                      <?php } else { ?>
                                        <input type="checkbox" name="KD_STATUS_HYDRANT" value="1"> Ada Hydrant
                                      <?php } ?>
                                    </label>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Sprinkler</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <label style="font-weight:100">
                                      <input type="hidden" name="KD_STATUS_SPRINKLER" value="1">
                                      <?php
                                      if ($lspop['KD_STATUS_SPRINKLER']=="0") { ?>
                                        <input type="checkbox" checked name="KD_STATUS_SPRINKLER" value="0"> Tidak ada Sprinkler
                                      <?php } else { ?>
                                        <input type="checkbox" name="KD_STATUS_SPRINKLER" value="0"> Tidak ada Sprinkler
                                      <?php } ?>
                                    </label>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Fire Alarm</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <label style="font-weight:100">
                                      <input type="hidden" name="KD_STATUS_FIRE_ALARM" value="1">
                                      <?php
                                      if ($lspop['KD_STATUS_FIRE_ALARM']=="0") { ?>
                                        <input type="checkbox" checked name="KD_STATUS_FIRE_ALARM" value="0"> Tidak Fire Alarm
                                      <?php } else { ?>
                                        <input type="checkbox" name="KD_STATUS_FIRE_ALARM" value="0"> Tidak Fire Alarm
                                      <?php } ?>
                                    </label>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Kedalaman Sumur Artetis</td>
                                  <td style="padding-bottom:10px;" width="600" style="padding-right:10px;">
                                    <input type="text" name="KEDALAMAN_SUMUR_ARTETIS" placeholder="Kedalaman Sumur Artetis" class="form-control" style="display:inline-block;width:50%" value="<?=$lspop['KEDALAMAN_SUMUR_ARTETIS']?>"> M
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
                                      <?php
                                      $sql = "select * from KELAS_BANGUNAN_2016 where KD_KLS_BNG='".$lspop['KD_KLS_BNG']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($bng = mysqli_fetch_assoc($sqla)) {
                                      ?>
                                        <option selected readonly hidden value="<?=$bng['KD_KLS_BNG']?>"><?=$bng['KD_KLS_BNG']?></option>
                                      <?php }
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
                                    <input type="text" name="LUAS_KAMAR_AC_CENTRAL" placeholder="Luas Kamar" class="form-control" style="" value="<?=$lspop['LUAS_KAMAR_AC_CENTRAL']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Luas Ruang Lain dengan AC Central</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="LUAS_RUANG_LAIN_AC_CENTRAL" placeholder="Luas Ruang Lain" class="form-control" style="" value="<?=$lspop['LUAS_RUANG_LAIN_AC_CENTRAL']?>">
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
                                    <input placeholder="Tanggal Kunjungan Kembali" class="form-control" name="TGL_KUNJUNGAN" type="text" value="<?=$lspop['TGL_KUNJUNGAN']?>">
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
                                <a href="spop.php" class="btn btn-default" >Batal</a>
                              </td>
                            </tr>
                          </table>
                          <?php } ?>
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
