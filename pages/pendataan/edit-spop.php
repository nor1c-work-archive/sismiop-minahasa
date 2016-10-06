<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {

  if (isset($_POST['simpan']) || isset($_GET['simpan'])) {
    $KD_PROPINSI          = $_POST['KD_PROPINSI'];
    $KD_DATI2             = $_POST['KD_DATI2'];
    $KD_KECAMATAN         = $_POST['KD_KECAMATAN'];
    $KD_KELURAHAN         = $_POST['KD_KELURAHAN'];
    $KD_BLOK              = $_POST['KD_BLOK'];
    $NO_URUT              = $_POST['NO_URUT'];
    $KD_JNS_OP            = $_POST['KD_JNS_OP'];
    $NO_FORMULIR          = $_POST['THN_FORMULIR'].$_POST['INPUT_FORMULIR_2'].$_POST['INPUT_FORMULIR_3'];
    $KTP_WP               = $_POST['KTP_WP'];
    $STATUS_PEKERJAAN_WP  = $_POST['STATUS_PEKERJAAN_WP'];
    $NPWP                 = $_POST['NPWP'];
    $JALAN_WP             = $_POST['JALAN_WP'];
    $RT_WP                = $_POST['RT_WP'];
    $RW_WP                = $_POST['RW_WP'];
    $KOTA_WP              = $_POST['KOTA_WP'];
    $KD_STATUS_WP         = $_POST['KD_STATUS_WP'];
    $NM_WP                = $_POST['NM_WP'];
    $TELP_WP              = $_POST['TELP_WP'];
    $BLOK_KAV_NO_WP       = $_POST['BLOK_KAV_NO_WP'];
    $KD_KELURAHAN_WP         = $_POST['KELURAHAN_WP'];
    $KD_POS_WP            = $_POST['KD_POS_WP'];
    $NO_PERSIL            = $_POST['NO_PERSIL'];
    $BLOK_KAV_NO_OP       = $_POST['BLOK_KAV_NO_OP'];
    $RT_OP                = $_POST['RT_OP'];
    $RW_OP                = $_POST['RW_OP'];
    $JALAN_OP             = $_POST['JALAN_OP'];
    $KD_STATUS_CABANG     = $_POST['KD_STATUS_CABANG'];
    $KD_KLS_TANAH         = $_POST['KD_KLS_TANAH'];
    $TOTAL_LUAS_BUMI      = $_POST['TOTAL_LUAS_BUMI'];
    $KD_ZNT               = $_POST['KD_ZNT'];
    $JNS_TANAH            = $_POST['JNS_TANAH'];
    $TGL_PENDATAAN        = $_POST['TGL_PENDATAAN'];
    $NIP_PENDATA          = $_POST['NIP_PENDATA'];
    $KD_JNS_TRANSAKSI     = $_POST['KD_JNS_TRANSAKSI'];
    $KD_PROPINSI_BERSAMA  = $_POST['KD_PROPINSI_BERSAMA'];
    $KD_DATI2_BERSAMA     = $_POST['KD_DATI2_BERSAMA'];
    $KD_KECAMATAN_BERSAMA = $_POST['KD_KECAMATAN_BERSAMA'];
    $KD_KELURAHAN_BERSAMA = $_POST['KD_KELURAHAN_BERSAMA'];
    $KD_BLOK_BERSAMA      = $_POST['KD_BLOK_BERSAMA'];
    $NO_URUT_BERSAMA      = $_POST['NO_URUT_BERSAMA'];
    $KD_JNS_OP_BERSAMA    = $_POST['KD_JNS_OP_BERSAMA'];
    $KD_PROPINSI_ASAL     = $_POST['KD_PROPINSI_ASAL'];
    $KD_DATI2_ASAL        = $_POST['KD_DATI2_ASAL'];
    $KD_KECAMATAN_ASAL    = $_POST['KD_KECAMATAN_ASAL'];
    $KD_KELURAHAN_ASAL    = $_POST['KD_KELURAHAN_ASAL'];
    $KD_BLOK_ASAL         = $_POST['KD_BLOK_ASAL'];
    $NO_URUT_ASAL         = $_POST['NO_URUT_ASAL'];
    $KD_JNS_OP_ASAL       = $_POST['KD_JNS_OP_ASAL'];
    $TGL_REKAM_OP         = date('Y-m-d', time());
    $NIP_PEREKAM          = $_SESSION['NIP'];

    $update = "UPDATE SPOP SET KTP_WP='$KTP_WP', STATUS_PEKERJAAN_WP='$STATUS_PEKERJAAN_WP', NPWP='$NPWP', JALAN_WP='$JALAN_WP', RT_WP='$RT_WP', RW_WP='$RW_WP', KOTA_WP='$KOTA_WP', KD_STATUS_WP='$KD_STATUS_WP', NM_WP='$NM_WP', TELP_WP='$TELP_WP', BLOK_KAV_NO_WP='$BLOK_KAV_NO_WP', KELURAHAN_WP='$KD_KELURAHAN_WP', KD_POS_WP='$KD_POS_WP', NO_PERSIL='$NO_PERSIL', BLOK_KAV_NO_OP='$BLOK_KAV_NO_OP', RT_OP='$RT_OP', RW_OP='$RW_OP', JALAN_OP='$JALAN_OP', KD_STATUS_CABANG='$KD_STATUS_CABANG', KD_KLS_TANAH='$KD_KLS_TANAH', TOTAL_LUAS_BUMI='$TOTAL_LUAS_BUMI', KD_ZNT='$KD_ZNT', JNS_TANAH='$JNS_TANAH', TGL_PENDATAAN='$TGL_PENDATAAN', NIP_PENDATA='$NIP_PENDATA', TGL_REKAM_OP='$TGL_REKAM_OP', NIP_PEREKAM='$NIP_PEREKAM', KD_JNS_TRANSAKSI='$KD_JNS_TRANSAKSI', KD_PROPINSI_BERSAMA='$KD_PROPINSI_BERSAMA', KD_DATI2_BERSAMA='$KD_DATI2_BERSAMA', KD_KECAMATAN_BERSAMA='$KD_KECAMATAN_BERSAMA', KD_KELURAHAN_BERSAMA='$KD_KELURAHAN_BERSAMA', KD_BLOK_BERSAMA='$KD_BLOK_BERSAMA', NO_URUT_BERSAMA='$NO_URUT_BERSAMA', KD_JNS_OP_BERSAMA='$KD_JNS_OP_BERSAMA', KD_PROPINSI_ASAL='$KD_PROPINSI_ASAL', KD_DATI2_ASAL='$KD_DATI2_ASAL', KD_KECAMATAN_ASAL='$KD_KECAMATAN_ASAL', KD_KELURAHAN_ASAL='$KD_KELURAHAN_ASAL', KD_BLOK_ASAL='$KD_BLOK_ASAL', NO_URUT_ASAL='$NO_URUT_ASAL', KD_JNS_OP_ASAL='$KD_JNS_OP_ASAL' WHERE KD_PROPINSI='$KD_PROPINSI' and KD_DATI2='$KD_DATI2' and KD_KECAMATAN='$KD_KECAMATAN' and KD_KELURAHAN='$KD_KELURAHAN' and KD_BLOK='$KD_BLOK' and NO_URUT='$NO_URUT' and KD_JNS_OP='$KD_JNS_OP' and NO_FORMULIR='$NO_FORMULIR'";
  
    if (mysqli_query($conn, $update)) {
      $_SESSION['notif'] = "SPOP Berhasil Disimpan";
      header("Location: spop.php");
    } else {
      $_SESSION['gagal'] = "SPOP Gagal Disimpan";
      header("Location: spop.php");
    }
  }

  if (isset($_GET['refid'])) {
    $NO_FORMULIR = $_GET['refid'];


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
                                <input type="text" required class="form-control" placeholder="Search...">
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
                    <h1 class="page-header">Edit SPOP</h1>
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
                            <i class="glyphicon glyphicon-home"></i> Home &gt; Pendataan Objek Pajak &gt; SPOP &gt; Edit SPOP
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                          <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                          <?php $sql = "select * from SPOP where NO_FORMULIR='".$NO_FORMULIR."'";
                            $sqla = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_assoc($sqla)) { ?>
                            <div class="panel panel-default">
                            <div class="panel-heading"><center>Formulir</center></div>
                            <div class="panel-body">
                              <table>
                                <tr>
                                  <td style="padding-top:10px;" width="130">Jenis Formulir</td>
                                  <td style="padding-top:10px;">
                                    <input type="text" required value="SPOP" readonly  class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="130">Jenis Transaksi</td>
                                  <td style="padding-top:10px;">
                                    <select required name="KD_JNS_TRANSAKSI" class="form-control">
                                      <option value="1">Pendataan Objek Pajak</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="130">Nomor Formulir</td>
                                  <td style="padding-top:10px;">
                                    <?php 
                                      $dynamicstring = $data['NO_FORMULIR'];
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
                                    <input type="text" required id="KD_PROPINSI" name="KD_PROPINSI" class="form-control" value="71" readonly="true">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" required id="KD_DATI2" name="KD_DATI2" class="form-control" value="03" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" required id="KD_KECAMATAN" name="KD_KECAMATAN" value="<?=$data['KD_KECAMATAN']?>" class="form-control" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" required id="KD_KELURAHAN" name="KD_KELURAHAN" value="<?=$data['KD_KELURAHAN']?>" class="form-control" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" required id="KD_BLOK" name="KD_BLOK" value="<?=$data['KD_BLOK']?>" class="form-control" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" required id="NO_URUT" name="NO_URUT" maxlength="4" class="form-control" value="<?=$data['NO_URUT']?>" readonly>
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" required id="KD_JNS_OP" name="KD_JNS_OP" maxlength="1" class="form-control" value="<?=$data['KD_JNS_OP']?>" readonly>
                                  </td>
                                </tr>
                              </table>
                              <br>
                              <table>
                                <tr>
                                  <td width="130">NOP Bersama</td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_PROPINSI_BERSAMA" class="form-control" value="<?=$data['KD_PROPINSI_BERSAMA']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_DATI2_BERSAMA" class="form-control" value="<?=$data['KD_DATI2_BERSAMA']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_KECAMATAN_BERSAMA" class="form-control" value="<?=$data['KD_KECAMATAN_BERSAMA']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_KELURAHAN_BERSAMA" class="form-control" value="<?=$data['KD_KELURAHAN_BERSAMA']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_BLOK_BERSAMA" class="form-control" value="<?=$data['KD_BLOK_BERSAMA']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="NO_URUT_BERSAMA" class="form-control" value="<?=$data['NO_URUT_BERSAMA']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_JNS_OP_BERSAMA" class="form-control" value="<?=$data['KD_JNS_OP_BERSAMA']?>">
                                  </td>
                                </tr>
                              </table>
                              <br>
                              <table>
                                <tr>
                                  <td width="130">NOP Asal</td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_PROPINSI_ASAL" class="form-control" value="<?=$data['KD_PROPINSI_ASAL']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_DATI2_ASAL" class="form-control" value="<?=$data['KD_DATI2_ASAL']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_KECAMATAN_ASAL" class="form-control" value="<?=$data['KD_KECAMATAN_ASAL']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_KELURAHAN_ASAL" class="form-control" value="<?=$data['KD_KELURAHAN_ASAL']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_BLOK_ASAL" class="form-control" value="<?=$data['KD_BLOK_ASAL']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="NO_URUT_ASAL" class="form-control" value="<?=$data['NO_URUT_ASAL']?>">
                                  </td>
                                  <td width="80" style="padding-right:10px;">
                                    <input type="text" name="KD_JNS_OP_ASAL" class="form-control" value="<?=$data['KD_JNS_OP_ASAL']?>">
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading"><center>Data Subjek Pajak</center></div>
                            <div class="panel-body">
                              <table style="float:left;">
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Nomor KTP</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="KTP_WP" placeholder="Nomor KTP" class="form-control" value="<?=$data['KTP_WP']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Pekerjaan</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select required class="form-control" name="STATUS_PEKERJAAN_WP">
                                      <?php
                                      $sql = "select * from REF_PEKERJAAN_WP where KD_PEKERJAAN='".$data['STATUS_PEKERJAAN_WP']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($pek = mysqli_fetch_assoc($sqla)) {
                                      ?>
                                        <option selected hidden readonly value="<?=$data['STATUS_PEKERJAAN_WP']?>"><?=$data['STATUS_PEKERJAAN_WP']?> - <?=$pek['PEKERJAAN']?></option>
                                      <?php } ?>
                                      <?php
                                      $sql = "select * from REF_PEKERJAAN_WP";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($pekk = mysqli_fetch_assoc($sqla)) {
                                      ?>
                                        <option value="<?=$pekk['KD_PEKERJAAN']?>"><?=$pekk['KD_PEKERJAAN'].' - '.$pekk['PEKERJAAN']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">NPWP</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="NPWP" placeholder="NPWP" class="form-control" value="<?=$data['NPWP']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jalan</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="JALAN_WP" placeholder="Jalan WP" class="form-control" value="<?=$data['JALAN_WP']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">RT/RW</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required style="width:20%;display:inline-block;" name="RT_WP" placeholder="RT" class="form-control" value="<?=$data['RT_WP']?>"> / 
                                    <input type="text" required style="width:20%;display:inline-block;" name="RW_WP" placeholder="RW" class="form-control" value="<?=$data['RW_WP']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Dati II</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="KOTA_WP" placeholder="Dati II" class="form-control" value="<?=$data['KOTA_WP']?>">
                                  </td>
                                </tr>
                              </table>
                              <table style="float:right">
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Status WP</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select required class="form-control" name="KD_STATUS_WP">
                                      <option selected readonly hidden value="<?=$data['KD_STATUS_WP']?>">
                                        <?php
                                          if ($data['KD_STATUS_WP']=="1") {
                                            echo "PEMILIK";
                                          } else {
                                            echo "BUKAN PEMILIK";
                                          }
                                        ?>
                                      </option>
                                      <option value="0">BUKAN PEMILIK</option>
                                      <option value="1">PEMILIK</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Nama</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="NM_WP" placeholder="Nama WP" class="form-control" value="<?=$data['NM_WP']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Telp.</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="TELP_WP" placeholder="Telepon" class="form-control" value="<?=$data['TELP_WP']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Blok/Kav/No.</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="BLOK_KAV_NO_WP" placeholder="Blok/Kav/No." class="form-control" value="<?=$data['BLOK_KAV_NO_WP']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Kelurahan</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <?php $sql = "select NM_KELURAHAN from REF_KELURAHAN where KD_KECAMATAN='".$data['KD_KECAMATAN']."' and KD_KELURAHAN='".$data['KD_KELURAHAN']."'";
                                    $sqla = mysqli_query($conn, $sql);
                                    $kell = mysqli_fetch_assoc($sqla); ?>
                                    <input type="text" required name="KELURAHAN_WP" value="<?=$kell['NM_KELURAHAN']?>" placeholder="Kelurahan" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Kode Pos</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="KD_POS_WP" placeholder="Kode Pos" class="form-control" value="<?=$data['KD_POS_WP']?>">
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading"><center>Data Letak Objek Pajak</center></div>
                            <div class="panel-body">
                              <table style="float:left;">
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Nomor Persil</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="NO_PERSIL" placeholder="No. Persil" class="form-control" value="<?=$data['NO_PERSIL']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Blok/Kav/No.</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="BLOK_KAV_NO_OP" placeholder="Blok/Kav/No." class="form-control" value="<?=$data['BLOK_KAV_NO_OP']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">RT/RW</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required style="width:20%;display:inline-block;" name="RT_OP" placeholder="RT" class="form-control" value="<?=$data['RT_OP']?>"> / 
                                    <input type="text" required style="width:20%;display:inline-block;" name="RW_OP" placeholder="RW" class="form-control" value="<?=$data['RW_OP']?>">
                                  </td>
                                </tr>
                              </table>
                              <table style="float:right">
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jalan</td>
                                  <td style="padding-bottom:10px;" placeholder="Jalan OP" width="300" style="padding-right:10px;">
                                    <select required class="form-control" name="JALAN_OP">
                                      <option selected readonly hidden value="<?=$data['JALAN_OP']?>"><?=$data['JALAN_OP']?></option>
                                      <?php $sql = "select * from JALAN_STANDARD ORDER BY NM_JLN_SEMENTARA";
                                      $sqla = mysqli_query($conn, $sql);
                                      while($jall = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$jall['NM_JLN_SEMENTARA']?>"><?=$jall['NM_JLN_SEMENTARA']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Cabang</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <label style="font-weight:100;">
                                    <input type="hidden" name="L_PERMOHONAN" value="0">
                                    <?php
                                      if ($data['KD_STATUS_CABANG']=="1") { ?>
                                        <input type="checkbox" checked name="KD_STATUS_CABANG" value="0"> Bukan
                                      <?php } else { ?>
                                        <input type="checkbox" name="KD_STATUS_CABANG" value="1"> Bukan
                                      <?php } ?>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading"><center>Data Bumi</center></div>
                            <div class="panel-body">
                              <table style="float:left;">
                              <tr>
                                  <td style="padding-bottom:10px;" width="130">Kode Kelas Tanah</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select required class="form-control" name="KD_KLS_TANAH">
                                      <option selected readonly hidden value="<?=$data['KD_KLS_TANAH']?>"><?=$data['KD_KLS_TANAH']?></option>
                                      <?php $sql = "select * from KELAS_TANAH_2016";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($tann = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$tann['KD_KLS_TANAH']?>"><?=$tann['KD_KLS_TANAH']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Luas Tanah</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="TOTAL_LUAS_BUMI" placeholder="Luas Tanah" class="form-control" value="<?=$data['TOTAL_LUAS_BUMI']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Kode ZNT</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select required class="form-control" name="KD_ZNT">
                                      <option selected readonly hidden value="<?=$data['KD_ZNT']?>"><?=$data['KD_ZNT']?></option>
                                      <?php $sql = "select * from DAT_PETA_ZNT where KD_KECAMATAN='".$data['KD_KECAMATAN']."' and KD_KELURAHAN='".$data['KD_KELURAHAN']."' and KD_BLOK='".$data['KD_BLOK']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($znt = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$znt['KD_ZNT']?>"><?=$znt['KD_ZNT']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-bottom:10px;" width="130">Jenis Tanah</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <select required class="form-control" name="JNS_TANAH">
                                      <option selected readonly hidden value="<?=$data['JNS_TANAH']?>">
                                        <?php  
                                        if ($data['JNS_TANAH']="1") {
                                          echo "TANAH";
                                        } else {
                                          echo "TANAH + BANGUNAN";
                                        }
                                        ?>
                                      </option>
                                      <option value="1">TANAH</option>
                                      <option value="2">TANAH + BANGUNAN</option>
                                    </select>
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
                                    <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$data['TGL_PENDATAAN']?>">
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
                                  <td style="padding-bottom:10px;" width="130">NIP Pendata</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="NIP_PENDATA" class="form-control" value="<?=$data['NIP_PENDATA']?>">
                                  </td>
                                </tr>
                                <!--<tr>
                                  <td style="padding-bottom:10px;" width="130">NIP Peneliti</td>
                                  <td style="padding-bottom:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" required name="NIP_PENELITI" class="form-control">
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
//     <script>
//         $(document).ready(function() {
//             $('#checkbtn').click(function (){
//                 var propinsi = $('#KD_PROPINSI').val();
//                 var dati2 = $('#KD_DATI2').val();
//                 var kecamatan = $('#KD_KECAMATAN').val();
//                 var kelurahan = $('#KD_KELURAHAN').val();
//                 var blok = $('#KD_BLOK').val();
//                 var no_urut = $('#NO_URUT').val();
//                 var jenis_op = $('#KD_JNS_OP').val();
//                     $.ajax({
//                         type: "POST",
//                         dataType: "html",
//                         url: "proses.php",
//                         data: {KD_PROPINSI : propinsi, KD_DATI2 : dati2, KD_KECAMATAN : kecamatan, KD_KELURAHAN : kelurahan, KD_BLOK : blok, NO_URUT : no_urut, KD_JNS_OP : jenis_op},
//                         success: function(msg){
//                         if(msg == ''){
//                             alert('Tidak ada kode blok pada kelurahan ini');
//                         } else {
//                             $("#check").html(msg);                                                     
//                         }
//                             $("#check").hide();
//                         }
//                     });
//             });
//         });
//     </script>
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

        <script>
            $(document).ready(function (){
 
                var checked = false;
 
                $('#checkbtnformulir').click(function (){
 
                    var FORMULIR1 = $('input[name="THN_FORMULIR"]').val();
                    var FORMULIR2 = $('input[name="INPUT_FORMULIR_2"]').val();
                    var FORMULIR3 = $('input[name="INPUT_FORMULIR_3"]').val();
                    $.post(
                        'proses-formulir.php',
                        { form1 : FORMULIR1, form2 : FORMULIR2, form3 : FORMULIR3 },
                        function (data)
                        {
                            if (data == 1) {
                              $('#checkformulir').html("<span style='color:green'>Nomor Formulir Tersedia</span>");
                            } else {
                              $('#checkformulir').html("<span style='color:red'>Nomor Formulir Tidak Tersedia</span>");
                            }
                        }
                    );
                    if(FORMULIR1 == '' || FORMULIR2 == '' || FORMULIR3 == '') {
                      $('#checkformulir').html("Silahkan Diisi Terlebih Dahulu");
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



<?php } else {
  echo "Tidak ada proses";
} } else {
   if ($_SESSION['ROLE']=="PEMBATALAN") {
     header("Location: ../pembatalan/index.php");
   } else {
     header("Location: ../../index.php");
   }
} ?>
