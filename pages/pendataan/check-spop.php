<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {

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

    <!-- Bootstrap Core CSS -->
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

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom Theme JavaScript -->
    <!-- // <script src="../../dist/js/sb-admin-2.js"></script> -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <style>
        td {
            padding:5px;
        }
    </style>

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
                    <h1 class="page-header">Check SPOP</h1>
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
                            <i class="glyphicon glyphicon-home"></i> Home &gt; Pendataan Objek Pajak &gt; SPOP &gt; Check SPOP
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                          <form action="approve.php" method="post">
                          <input type="hidden" name="NO_FORMULIR" value="<?=$NO_FORMULIR?>">
                            <div class="panel panel-default">
                            <div class="panel-heading"><center>SPOP</center></div>
                            <div class="panel-body">
                              <table>
                                <?php $sql = "select a.*, b.KD_JNS_BNG, b.LUAS_BNG from SPOP a 
                                LEFT JOIN LSPOP b
                                on(a.KD_KECAMATAN=b.KD_KECAMATAN and a.KD_KELURAHAN=b.KD_KELURAHAN and a.KD_BLOK=b.KD_BLOK and a.NO_URUT=b.NO_URUT and a.KD_JNS_OP=b.KD_JNS_OP and a.NO_FORMULIR=b.NO_FORMULIR)
                                where a.NO_FORMULIR='".$NO_FORMULIR."'";
                                $sqla = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                $data = mysqli_fetch_assoc($sqla); ?>
                                <tr>
                                  <td width="300">NO FORMULIR</td>
                                  <td>:</td>
                                  <td><?=$data['NO_FORMULIR']?></td>
                                </tr>
                                <tr>
                                  <td width="300">NOP</td>
                                  <td>:</td>
                                  <td><?=$data['KD_PROPINSI'].'-'.$data['KD_DATI2'].'-'.$data['KD_KECAMATAN'].'-'.$data['KD_KELURAHAN'].'-'.$data['KD_BLOK'].'-'.$data['NO_URUT'].'-'.$data['KD_JNS_OP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">NOP BERSAMA</td>
                                  <td>:</td>
                                  <td>
                                  <?php
                                    if ($data['KD_PROPINSI_BERSAMA']!="" || $data['KD_DATI2_BERSAMA']!="" || $data['KD_KECAMATAN_BERSAMA']!="" || $data['KD_KELURAHAN_BERSAMA']!="" || $data['KD_BLOK_BERSAMA']!="" || $data['NO_URUT_BERSAMA']!="" || $data['KD_JNS_OP_BERSAMA']!="") {
                                        echo $data['KD_PROPINSI_BERSAMA'].'-'.$data['KD_DATI2_BERSAMA'].'-'.$data['KD_KECAMATAN_BERSAMA'].'-'.$data['KD_KELURAHAN_BERSAMA'].'-'.$data['KD_BLOK_BERSAMA'].'-'.$data['NO_URUT_BERSAMA'].'-'.$data['KD_JNS_OP_BERSAMA'];
                                    } else {
                                        echo "-";
                                    }
                                  ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="300">NOP ASAL</td>
                                  <td>:</td>
                                  <td>
                                  <?php
                                    if ($data['KD_PROPINSI_ASAL']!="" || $data['KD_DATI2_ASAL']!="" || $data['KD_KECAMATAN_ASAL']!="" || $data['KD_KELURAHAN_ASAL']!="" || $data['KD_BLOK_ASAL']!="" || $data['NO_URUT_ASAL']!="" || $data['KD_JNS_OP_ASAL']!="") {
                                        echo $data['KD_PROPINSI_ASAL'].'-'.$data['KD_DATI2_ASAL'].'-'.$data['KD_KECAMATAN_ASAL'].'-'.$data['KD_KELURAHAN_ASAL'].'-'.$data['KD_BLOK_ASAL'].'-'.$data['NO_URUT_ASAL'].'-'.$data['KD_JNS_OP_ASAL'];
                                    } else {
                                        echo "-";
                                    }
                                  ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="300">NAMA WAJIB PAJAK</td>
                                  <td>:</td>
                                  <td><?=$data['NM_WP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">KTP WAJIB PAJAK</td>
                                  <td>:</td>
                                  <td><?=$data['KTP_WP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">RT / RW WP</td>
                                  <td>:</td>
                                  <td><?=$data['RT_WP']?> / <?=$data['RW_WP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">JALAN WP</td>
                                  <td>:</td>
                                  <td><?=$data['JALAN_WP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">KOTA WP</td>
                                  <td>:</td>
                                  <td><?=$data['KOTA_WP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">TELP WP</td>
                                  <td>:</td>
                                  <td><?=$data['TELP_WP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">STATUS WP</td>
                                  <td>:</td>
                                  <td>
                                    <?php if ($data['KD_STATUS_WP']=="1") {
                                      echo "PEMILIK";
                                    } else {
                                      echo "BUKAN PEMILIK";
                                    } ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="300">STATUS PEKERJAAN</td>
                                  <td>:</td>
                                  <td><?php
                                  $sql = "SELECT * FROM REF_PEKERJAAN_WP WHERE KD_PEKERJAAN='".$data['STATUS_PEKERJAAN_WP']."'";
                                  $sqla = mysqli_query($conn, $sql);
                                  $datapek = mysqli_fetch_assoc($sqla);
                                  echo $datapek['KD_PEKERJAAN'] .' - '. $datapek['PEKERJAAN'];
                                  ?></td>
                                </tr>
                                <tr>
                                  <td width="300">NPWP</td>
                                  <td>:</td>
                                  <td><?=$data['NPWP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">BLOK/KAV/NO WP</td>
                                  <td>:</td>
                                  <td><?=$data['BLOK_KAV_NO_WP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">KELURAHAN WP</td>
                                  <td>:</td>
                                  <td><?=$data['KELURAHAN_WP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">KODE POS WP</td>
                                  <td>:</td>
                                  <td><?=$data['KD_POS_WP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">NOMOR PERSIL</td>
                                  <td>:</td>
                                  <td><?=$data['NO_PERSIL']?></td>
                                </tr>
                                <tr>
                                  <td width="300">BLOK/KAV/NO OP</td>
                                  <td>:</td>
                                  <td><?=$data['BLOK_KAV_NO_OP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">RT / RW OP</td>
                                  <td>:</td>
                                  <td><?=$data['RT_OP'].' / '.$data['RW_OP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">JALAN OBJEK PAJAK</td>
                                  <td>:</td>
                                  <td><?=$data['JALAN_OP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">STATUS CABANG</td>
                                  <td>:</td>
                                  <td><?php
                                  if ($data['KD_STATUS_CABANG']=="1") {
                                    echo "CABANG";
                                  } else {
                                    echo "BUKAN CABANG";
                                  }
                                  ?></td>
                                </tr>
                                <tr>
                                  <td width="300">TOTAL LUAS BUMI</td>
                                  <td>:</td>
                                  <td><?=$data['TOTAL_LUAS_BUMI']?></td>
                                </tr>
                                <tr>
                                  <td width="300">TOTAL LUAS BANGUNAN</td>
                                  <td>:</td>
                                  <td>
                                    <?php
                                    if ($data['LUAS_BNG']=='') {
                                      echo "-";
                                    } else {
                                      echo $data['LUAS_BNG'];
                                    }
                                    ?>
                                  </td>
                                </tr>
                                <tr>
                                  <td width="300">KODE ZNT</td>
                                  <td>:</td>
                                  <td><?=$data['KD_ZNT']?></td>
                                </tr>
                                <tr>
                                  <td width="300">JENIS TANAH</td>
                                  <td>:</td>
                                  <td><?php
                                  if ($data['JNS_TANAH']=="1") {
                                    echo "TANAH";
                                  } else {
                                    echo "TANAH+BANGUNAN";
                                  }
                                  ?></td>
                                </tr>
                                <tr>
                                  <td width="300">TANGGAL PENDATAAN</td>
                                  <td>:</td>
                                  <td><?=$data['TGL_PENDATAAN']?></td>
                                </tr>
                                <tr>
                                  <td width="300">NIP PENDATA</td>
                                  <td>:</td>
                                  <td><?=$data['NIP_PENDATA']?></td>
                                </tr>
                                <tr>
                                  <td width="300">TANGGAL PEREKAMAN</td>
                                  <td>:</td>
                                  <td><?=$data['TGL_REKAM_OP']?></td>
                                </tr>
                                <tr>
                                  <td width="300">NIP PEREKAM</td>
                                  <td>:</td>
                                  <td><?=$data['NIP_PEREKAM']?></td>
                                </tr>
                                <tr>
                                  <td width="300">JENIS TRANSAKSI</td>
                                  <td>:</td>
                                  <td><?php
                                  if ($data['KD_JNS_TRANSAKSI']=="1") {
                                    echo "PENDATAAN OBJEK PAJAK";
                                  }
                                  ?></td>
                                </tr>
                              </table>
                              </div>
                            </div>

                            <?php
                            $sql = "select JNS_TANAH from SPOP where NO_FORMULIR='".$NO_FORMULIR."'";
                            $sqla = mysqli_query($conn, $sql);
                            while ($cekspop = mysqli_fetch_assoc($sqla)) {
                            if ($cekspop['JNS_TANAH']=="2") { ?>
                              <div class="panel panel-default">
                              <div class="panel-heading"><center>LSPOP</center></div>
                              <div class="panel-body">
                                <table>
                                  <?php $sql = "select * from LSPOP where NO_FORMULIR='".$NO_FORMULIR."'";
                                  $sqla = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                                  $data = mysqli_fetch_assoc($sqla); ?>
                                  <tr>
                                    <td width="300">NOMOR BANGUNAN</td>
                                    <td>:</td>
                                    <td><?=$data['NO_BNG']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">KODE JENIS BANGUNAN</td>
                                    <td>:</td>
                                    <td><?=$data['KD_JNS_BNG']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">LUAS BNG</td>
                                    <td>:</td>
                                    <td><?=$data['LUAS_BNG']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">JUMLAH LANTAI</td>
                                    <td>:</td>
                                    <td><?=$data['JML_LANTAI']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">TAHUN DIBANGUN</td>
                                    <td>:</td>
                                    <td><?=$data['THN_DIBANGUN']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">TAHUN RENOVASI</td>
                                    <td>:</td>
                                    <td><?=$data['THN_RENOVASI']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">KONDISI BANGUNAN</td>
                                    <td>:</td>
                                    <td>
                                      <?php
                                      $sql = "select * from REF_KONDISI_BNG where KD_KONDISI_BNG='".$data['KD_KONDISI_BNG']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($kondisi = mysqli_fetch_assoc($sqla)) {
                                        echo $kondisi['KONDISI_BNG'];
                                      }
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">JENIS KONSTRUKSI</td>
                                    <td>:</td>
                                    <td>
                                      <?php
                                      $sql = "select * from REF_JNS_KONSTRUKSI where KD_JNS_KONSTRUKSI='".$data['KD_JNS_KONSTRUKSI']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($kons = mysqli_fetch_assoc($sqla)) {
                                        echo $kons['NM_JNS_KONSTRUKSI'];
                                      }
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">JENIS ATAP</td>
                                    <td>:</td>
                                    <td>
                                      <?php
                                      $sql = "select * from REF_JNS_ATAP where KD_JNS_ATAP='".$data['KD_JNS_ATAP']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($kons = mysqli_fetch_assoc($sqla)) {
                                        echo $kons['NM_JNS_ATAP'];
                                      }
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">JENIS DINDING</td>
                                    <td>:</td>
                                    <td>
                                      <?php
                                      $sql = "select * from REF_JNS_DINDING where KD_JNS_DINDING='".$data['KD_JNS_DINDING']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($kons = mysqli_fetch_assoc($sqla)) {
                                        echo $kons['NM_JNS_DINDING'];
                                      }
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">JENIS LANTAI</td>
                                    <td>:</td>
                                    <td>
                                      <?php
                                      $sql = "select * from REF_JNS_LANTAI where KD_JNS_LANTAI='".$data['KD_JNS_LANTAI']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($kons = mysqli_fetch_assoc($sqla)) {
                                        echo $kons['NM_JNS_LANTAI'];
                                      }
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">JENIS LANGIT</td>
                                    <td>:</td>
                                    <td>
                                      <?php
                                      $sql = "select * from REF_JNS_LANGIT where KD_JNS_LANGIT='".$data['KD_JNS_LANGIT']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($kons = mysqli_fetch_assoc($sqla)) {
                                        echo $kons['NM_JNS_LANGIT'];
                                      }
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">DAYA LISTRIK</td>
                                    <td>:</td>
                                    <td><?=$data['DAYA_LISTRIK']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">JUMLAH SPLIT AC</td>
                                    <td>:</td>
                                    <td><?=$data['JML_SPLIT_AC']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">JUMLAH WINDOW AC</td>
                                    <td>:</td>
                                    <td><?=$data['JML_WINDOW_AC']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">LUAS KOLAM</td>
                                    <td>:</td>
                                    <td><?=$data['LUAS_KOLAM']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">FINISHING KOLAM</td>
                                    <td>:</td>
                                    <td>
                                      <?php
                                      $sql = "select * from REF_FINISHING_KOLAM where KD_FINISHING_KOLAM='".$data['KD_FINISHING_KOLAM']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($kons = mysqli_fetch_assoc($sqla)) {
                                        echo $kons['NM_FINISHING_KOLAM'];
                                      }
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">BETON PLUS</td>
                                    <td>:</td>
                                    <td><?=$data['BETON_PLUS']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">ASPAL PLUS</td>
                                    <td>:</td>
                                    <td><?=$data['ASPAL_PLUS']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">TANAH PLUS</td>
                                    <td>:</td>
                                    <td><?=$data['TANAH_PLUS']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">BETON MINUS</td>
                                    <td>:</td>
                                    <td><?=$data['BETON_MINUS']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">ASPAL MINUS</td>
                                    <td>:</td>
                                    <td><?=$data['ASPAL_MINUS']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">TANAH MINUS</td>
                                    <td>:</td>
                                    <td><?=$data['TANAH_MINUS']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">PANJANG PAGAR</td>
                                    <td>:</td>
                                    <td><?=$data['PANJANG_PAGAR']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">KODE BAHAN PAGAR</td>
                                    <td>:</td>
                                    <td>
                                      <?php
                                      $sql = "select * from REF_JNS_BAHAN_PAGAR where KD_JNS_BAHAN='".$data['KD_BAHAN_PAGAR']."'";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($kons = mysqli_fetch_assoc($sqla)) {
                                        echo $kons['NM_JNS_BAHAN'];
                                      }
                                      ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">JUMLAH PABX</td>
                                    <td>:</td>
                                    <td><?=$data['JML_PABX']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">KODE AC CENTRAL</td>
                                    <td>:</td>
                                    <td>
                                      <?php if ($data['KD_AC_CENTRAL']=="0") {
                                        echo "0 - Tidak ada AC Central";
                                      } else {
                                        echo "1 - AC Central";
                                      } ?>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">RINGAN</td>
                                    <td>:</td>
                                    <td><?=$data['RINGAN']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">BERAT</td>
                                    <td>:</td>
                                    <td><?=$data['BERAT']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">SEDANG</td>
                                    <td>:</td>
                                    <td><?=$data['SEDANG']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">DENGAN PENUTUP LANTAI</td>
                                    <td>:</td>
                                    <td><?=$data['DENGAN_PENUTUP_LANTAI']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">JUMLAH PENUMPANG</td>
                                    <td>:</td>
                                    <td><?=$data['JML_PENUMPANG']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">JUMLAH KAPSUL</td>
                                    <td>:</td>
                                    <td><?=$data['JML_KAPSUL']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">JUMLAH BARANG</td>
                                    <td>:</td>
                                    <td><?=$data['JML_BARANG']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">JUMLAH TANGGA BERJALAN LEBIH KECIL</td>
                                    <td>:</td>
                                    <td><?=$data['JML_TANGGA_BERJALAN_LEBIH_KECIL']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">JUMLAH TANGGA BERJALAN LEBIH BESAR</td>
                                    <td>:</td>
                                    <td><?=$data['JML_TANGGA_BERJALAN_LEBIH_BESAR']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">KODE STATUS HYDRANT</td>
                                    <td>:</td>
                                    <td>
                                      <?php if ($data['KD_STATUS_HYDRANT']=="1") {
                                        echo "1 - Ada Hydrant";
                                      } else {
                                        echo "0 - Tidak Ada Hydrant";
                                      } ?>  
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">KODE STATUS SPRINKLER</td>
                                    <td>:</td>
                                    <td>
                                      <?php if ($data['KD_STATUS_SPRINKLER']=="0") {
                                        echo "0 - Tidak Ada Sprinkler";
                                      } else {
                                        echo "1 - Ada Sprinkler";
                                      } ?>   
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">KODE STATUS FIRE ALARM</td>
                                    <td>:</td>
                                    <td>
                                      <?php if ($data['KD_STATUS_FIRE_ALARM']=="0") {
                                        echo "0 - Tidak Fire Alarm";
                                      } else {
                                        echo "1 - Fire Alarm";
                                      } ?>  
                                    </td>
                                  </tr>
                                  <tr>
                                    <td width="300">KEDALAMAN SUMUR ARTETIS</td>
                                    <td>:</td>
                                    <td><?=$data['KEDALAMAN_SUMUR_ARTETIS']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">KODE KELAS BARANG</td>
                                    <td>:</td>
                                    <td><?=$data['KD_KLS_BNG']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">LUAS KAMAR AC CENTRAL</td>
                                    <td>:</td>
                                    <td><?=$data['LUAS_KAMAR_AC_CENTRAL']?></td>
                                  </tr>
                                  <tr>
                                    <td width="300">LUAS RUANG LAIN AC CENTRAL</td>
                                    <td>:</td>
                                    <td><?=$data['LUAS_RUANG_LAIN_AC_CENTRAL']?></td>
                                  </tr>
                                <tr>
                                  <td width="300">TANGGAL PENDATAAN</td>
                                  <td>:</td>
                                  <td><?=$data['TGL_PENDATAAN']?></td>
                                </tr>
                                <tr>
                                  <td width="300">NIP PENDATA</td>
                                  <td>:</td>
                                  <td><?=$data['NIP_PENDATA']?></td>
                                </tr>
                                <tr>
                                  <td width="300">TANGGAL PEREKAMAN</td>
                                  <td>:</td>
                                  <td><?=$data['TGL_PEREKAMAN']?></td>
                                </tr>
                                <tr>
                                  <td width="300">NIP PEREKAM</td>
                                  <td>:</td>
                                  <td><?=$data['NIP_PEREKAM']?></td>
                                </tr>
                                <tr>
                                  <td width="300">TANGGAL KUNJUNGAN KEMBALi</td>
                                  <td>:</td>
                                  <td><?=$data['TGL_KUNJUNGAN']?></td>
                                </tr>
                                </table>
                                </div>
                              </div>
                            <?php } } ?>
                        <div style="float:right;">
                          <input type="submit" value="Approve" name="approve" class="btn btn-success">
                          <a href="spop.php" class="btn btn-default">Batal</a>
                        </div>
                        </form>
                        <!-- /.panel-body -->
                    </div>
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

    <script>
        $(document).ready(function() {
            $("#kecamatan").change(function(){
            var KD_KECAMATAN = $("#kecamatan").val();
            $("#imgLoad").show("");
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "cari_kel.php",
                data: "kecamatan="+KD_KECAMATAN,
                success: function(msg){
                    if(msg == ''){
                        alert('Tidak ada data Kelurahan');
                    }
                    else{
                        $("#kelurahan").html(msg);                                                     
                    }
                    $("#imgLoad").hide();
                }
            });    
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#kecamatan").change(function(){
            var KD_KECAMATAN = $("#kecamatan").val();
                $("#kelurahan").change(function(){
                var KD_KELURAHAN = $("#kelurahan").val();
                $("#imgLoad").show("");
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: "cari_ZNT.php",
                        data: "kecamatan="+KD_KECAMATAN, "kelurahan="+KD_KELURAHAN,
                        success: function(msg){
                            if(msg == ''){
                                alert('Tidak ada data ZNT');
                            } else {
                                $("#kelurahan").html(msg);                                                     
                            }
                                $("#imgLoad").hide();
                            }
                    });
                });    
            });
        });
    </script>
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable( {
          "pagingType": "full_numbers",
          responsive: true
        } );
      } );
    </script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
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

    <!-- <script type="text/javascript">
    var container = document.getElementsByClassName("nops")[0];
    container.onkeyup = function(e) {
      var target = e.srcElement;
      var maxLength = parseInt(target.attributes["maxlength"].value, 10);
      var myLength = target.value.length;
      if (myLength >= maxLength) {
          var next = target;
          while (next = next.nextElementSibling) {
              if (next == null)
                  break;
              if (next.tagName.toLowerCase() == "input") {
                  next.focus();
                  break;
              }
          }
      }
    }
    </script> -->
</body>

</html>

<?php } else {
    echo "Tidak ada proses";
} } else {
  echo "You don't have access to this page.";
} ?>
