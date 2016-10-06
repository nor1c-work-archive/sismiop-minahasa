<?php
session_start();//session starts here
require_once '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
    header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.
}

// 1. Get $hal from url
IF (ISSET($_GET['hal'])) {
   $hal = $_GET['hal'];
} ELSE {
   $hal = 1;
}


//2. count total number of rows
if (isset($_POST['cari']) || isset($_GET['cari'])) {
  if(isset($_POST['paging']) || isset($_GET['paging'])) {
    	if($_GET['kelurahan']=="all_kel") {
    		$TGL_AWAL = $_GET['tgl_awal'];
    		$TGL_AKHIR = $_GET['tgl_akhir'];
    		$KECAMATAN = "all";
    	} else if($_GET['kelurahan']!="all_kel") {
    		$TGL_AWAL = $_GET['tgl_awal'];
    		$TGL_AKHIR = $_GET['tgl_akhir'];
    		$KECAMATAN = $_GET['kecamatan'];
        $KELURAHAN = $_GET['kelurahan'];
    	}
    } else {
  	$TGL_AWAL = $_POST['tgl_awal'];
  	$TGL_AKHIR = $_POST['tgl_akhir'];
  	$KECAMATAN = $_POST['kecamatan'];
    $KELURAHAN = $_POST['kelurahan'];
    }

  if ($KELURAHAN=="all_kel") {
    $q = "SELECT SQL_NO_CACHE count(*) from PEMBAYARAN_SPPT WHERE
        TGL_PEMBAYARAN_SPPT >= '".$TGL_AWAL."' AND
        TGL_PEMBAYARAN_SPPT <= '".$TGL_AKHIR."'
    ";

    $j = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) as JML, SUM(DENDA_SPPT) as TOTAL_DENDA from PEMBAYARAN_SPPT WHERE
        TGL_PEMBAYARAN_SPPT >= '".$TGL_AWAL."' AND
        TGL_PEMBAYARAN_SPPT <= '".$TGL_AKHIR."'
    ";
  } else {
    $q = "SELECT SQL_NO_CACHE count(*) from PEMBAYARAN_SPPT WHERE
        KD_KELURAHAN = '".$KELURAHAN."' AND
        KD_KECAMATAN = '".$KECAMATAN."' AND
        TGL_PEMBAYARAN_SPPT >= '".$TGL_AWAL."' AND
        TGL_PEMBAYARAN_SPPT <= '".$TGL_AKHIR."'
    ";

    $j = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) as JML, SUM(DENDA_SPPT) as TOTAL_DENDA from PEMBAYARAN_SPPT WHERE
        KD_KELURAHAN = '".$KELURAHAN."' AND
        KD_KECAMATAN = '".$KECAMATAN."' AND
        TGL_PEMBAYARAN_SPPT >= '".$TGL_AWAL."' AND
        TGL_PEMBAYARAN_SPPT <= '".$TGL_AKHIR."'
    ";
  }
} else {
  $q = "SELECT SQL_NO_CACHE count(*) from PEMBAYARAN_SPPT";

  $j = "SELECT SQL_NO_CACHE SUM(JML_SPPT_YG_DIBAYAR) as JML, SUM(DENDA_SPPT) as TOTAL_DENDA from PEMBAYARAN_SPPT";
}
$qa = mysqli_query($conn, $q) or die (mysqli_error($conn));
$ja = mysqli_query($conn, $j) or die (mysqli_error($conn));

$total = mysqli_fetch_assoc($ja);

$numrows = $qa->fetch_row();
$numrow = $numrows[0];

// 3. Calculate number of $lastpage
// This code uses the values in $rows_per_page and $numrows in order to identify the number of the last page.

$rows_per_page = 25;
$lastpage = CEIL($numrow/$rows_per_page);
// 4. Ensure that $pageno is within range
// This code checks that the value of $pageno is an integer between 1 and $lastpage.
$hal = (int)$hal;
if ($hal < 1) {
   $hal = 1;
} elseif ($hal > $lastpage) {
   $hal = $lastpage;
} // if
// 5. Construct LIMIT clause
// This code will construct the LIMIT clause for the sql SELECT statement.
$limitmin = ($hal-1)*$rows_per_page;
$limitmax = $limitmin+$rows_per_page;
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
    <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../dist/datepicker/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

      <?php include("../header2.php") ?>

            <!-- NAVBAR -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <?php include '../menu.php';?>
                        </li>
                    </ul>
                </div>
            </div>
            </nav>
            <!-- END OF NAVBAR -->

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Penerimaan PBB Per-Wilayah</h1>
                </div>
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Home &gt; Monitoring &gt; Penerimaan PBB Per-Wilayah
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                <div class="form-group">
                                  <label>Tanggal Awal</label>
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input placeholder="Tanggal Awal" class="form-control" name="tgl_awal" size="30" type="text" value="" required="">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <!-- <input type="hidden" id="dtp_input2" value="" /> -->
                                  <label>Tanggal Akhir</label>
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input placeholder="Tanggal Akhir" class="form-control" name="tgl_akhir" size="30" type="text" value="" required="">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <!-- <input type="hidden" id="dtp_input2" value="" /> -->
                                </div>
                                <div class="form-group">
                                  <label>Kecamatan</label>
                                  <select id="kecamatan" name="kecamatan" class="form-control" required="">
                                    <option disabled selected hidden>PILIH KECAMATAN</option>
                                    <?php $kec = "select SQL_NO_CACHE * from REF_KECAMATAN ORDER BY KD_KECAMATAN ASC";
                                    $kecq = mysqli_query($conn, $kec);
                                    while ($row = mysqli_fetch_assoc($kecq)) {
                                    ?>
                                      <option value="<?=$row['KD_KECAMATAN']?>"><?=$row['KD_KECAMATAN']?>. <?=$row['NM_KECAMATAN']?></option>
                                    <?php } ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Kelurahan</label>
                                  <select id="kelurahan" name="kelurahan" class="form-control" required="">
                                    <option disabled selected hidden>PILIH KELURAHAN</option>
                                  </select>
                                </div>

                                <input type="submit" class="btn btn-success" name="cari" value="Filter">
                                <button type="reset" class="btn btn-info">Reset</button>
                              </form>
                            </div>
                          </div>

                          <div class="col-lg-16">
                            <br>
                        <div class="table-responsive">


                            <?php

                              if (isset($_POST['cari']) || isset($_GET['cari'])) { ?>
                             <?php
                              if(isset($_POST['paging']) || isset($_GET['paging'])) {
                  								$TGL_AWAL = $_GET['tgl_awal'];
                  								$TGL_AKHIR = $_GET['tgl_akhir'];
                  								$KECAMATAN = $_GET['kecamatan'];
                                  $KELURAHAN = $_GET['kelurahan'];
                  							  } else {
                  								$TGL_AWAL = $_POST['tgl_awal'];
                  								$TGL_AKHIR = $_POST['tgl_akhir'];
                  								$KECAMATAN = $_POST['kecamatan'];
                                  $KELURAHAN = $_POST['kelurahan'];
                  							  }

                                  if ($numrow=="0") {
                                    echo "Hasil Pencarian Kosong";
                                  } else {
                                    if ($KELURAHAN=="all_kell") {
                                      $q = "SELECT SQL_NO_CACHE a.KD_PROPINSI, a.KD_DATI2, a.KD_KECAMATAN, a.KD_KELURAHAN, a.KD_BLOK, a.THN_PAJAK_SPPT, a.DENDA_SPPT, a.NO_URUT, a.KD_JNS_OP,a.JML_SPPT_YG_DIBAYAR, a.TGL_PEMBAYARAN_SPPT, b.NM_KELURAHAN, c.NM_WP_SPPT, c.RT_WP_SPPT, c.RW_WP_SPPT, d.RW_OP, d.RT_OP, d.JALAN_OP, e.NM_TP from pembayaran_sppt a 
                                        LEFT JOIN REF_KELURAHAN b on(a.KD_KECAMATAN=b.KD_KECAMATAN and a.KD_KELURAHAN=b.KD_KELURAHAN)
                                        LEFT JOIN ALL_SPPT c on(a.KD_KECAMATAN=c.KD_KECAMATAN and a.KD_KELURAHAN=c.KD_KELURAHAN and a.KD_BLOK=c.KD_BLOK and a.NO_URUT=c.NO_URUT and a.KD_JNS_OP=c.KD_JNS_OP)
                                        LEFT JOIN DAT_OBJEK_PAJAK d on(a.KD_KECAMATAN=d.KD_KECAMATAN and a.KD_KELURAHAN=d.KD_KELURAHAN and a.KD_BLOK=d.KD_BLOK and a.NO_URUT=d.NO_URUT and a.KD_JNS_OP=d.KD_JNS_OP)
                                        LEFT JOIN TEMPAT_PEMBAYARAN e on(a.KD_KANWIL_BANK=e.KD_KANWIL and a.KD_KPPBB_BANK=e.KD_KPPBB and a.KD_BANK_TUNGGAL=e.KD_BANK_TUNGGAL and a.KD_BANK_PERSEPSI=e.KD_BANK_PERSEPSI and a.KD_TP=e.KD_TP)
                                        WHERE a.TGL_PEMBAYARAN_SPPT >= '".$TGL_AWAL."' AND a.TGL_PEMBAYARAN_SPPT <= '".$TGL_AKHIR."' AND a.KD_KECAMATAN='".$KECAMATAN."' AND a.KD_KELURAHAN='".$KELURAHAN."'
                                        GROUP BY a.KD_KECAMATAN, a.KD_KELURAHAN, a.KD_BLOK, a.NO_URUT, a.KD_JNS_OP, a.THN_PAJAK_SPPT, a.PEMBAYARAN_SPPT_KE, a.KD_KANWIL_BANK, a.KD_KPPBB_BANK, a.KD_BANK_TUNGGAL, a.KD_BANK_PERSEPSI, a.KD_TP, a.DENDA_SPPT, a.JML_SPPT_YG_DIBAYAR, a.TGL_PEMBAYARAN_SPPT, a.JML_SPPT_YG_DIBAYAR
                                        LIMIT $limitmin, $limitmax
                                            ";
                                    } else if ($KELURAHAN!="all_kell") {
                                      $q = "SELECT SQL_NO_CACHE a.KD_PROPINSI, a.KD_DATI2, a.KD_KECAMATAN, a.KD_KELURAHAN, a.KD_BLOK, a.THN_PAJAK_SPPT, a.DENDA_SPPT, a.NO_URUT, a.KD_JNS_OP,a.JML_SPPT_YG_DIBAYAR, a.TGL_PEMBAYARAN_SPPT, b.NM_KELURAHAN, c.NM_WP_SPPT, c.RT_WP_SPPT, c.RW_WP_SPPT, d.RW_OP, d.RT_OP, d.JALAN_OP, e.NM_TP from pembayaran_sppt a 
                                        LEFT JOIN REF_KELURAHAN b on(a.KD_KECAMATAN=b.KD_KECAMATAN and a.KD_KELURAHAN=b.KD_KELURAHAN)
                                        LEFT JOIN ALL_SPPT c on(a.KD_KECAMATAN=c.KD_KECAMATAN and a.KD_KELURAHAN=c.KD_KELURAHAN and a.KD_BLOK=c.KD_BLOK and a.NO_URUT=c.NO_URUT and a.KD_JNS_OP=c.KD_JNS_OP)
                                        LEFT JOIN DAT_OBJEK_PAJAK d on(a.KD_KECAMATAN=d.KD_KECAMATAN and a.KD_KELURAHAN=d.KD_KELURAHAN and a.KD_BLOK=d.KD_BLOK and a.NO_URUT=d.NO_URUT and a.KD_JNS_OP=d.KD_JNS_OP)
                                        LEFT JOIN TEMPAT_PEMBAYARAN e on(a.KD_KANWIL_BANK=e.KD_KANWIL and a.KD_KPPBB_BANK=e.KD_KPPBB and a.KD_BANK_TUNGGAL=e.KD_BANK_TUNGGAL and a.KD_BANK_PERSEPSI=e.KD_BANK_PERSEPSI and a.KD_TP=e.KD_TP)
                                        WHERE a.KD_KECAMATAN= '".$KECAMATAN."' AND a.TGL_PEMBAYARAN_SPPT >= '".$TGL_AWAL."' AND a.TGL_PEMBAYARAN_SPPT <= '".$TGL_AKHIR."'
                                        GROUP BY a.KD_KECAMATAN, a.KD_KELURAHAN, a.KD_BLOK, a.NO_URUT, a.KD_JNS_OP, a.THN_PAJAK_SPPT, a.PEMBAYARAN_SPPT_KE, a.KD_KANWIL_BANK, a.KD_KPPBB_BANK, a.KD_BANK_TUNGGAL, a.KD_BANK_PERSEPSI, a.KD_TP, a.DENDA_SPPT, a.JML_SPPT_YG_DIBAYAR, a.TGL_PEMBAYARAN_SPPT, a.JML_SPPT_YG_DIBAYAR
                                        LIMIT $limitmin, $limitmax
                                            ";
                                    }
                                  }
                            } else {
                              $q = "SELECT SQL_NO_CACHE * from PEMBAYARAN_SPPT
                              LIMIT $limitmin, $limitmax;
                              ";
                            }

                            $s = mysqli_query($conn, $q) or die (mysqli_error($conn));
                            ?>
                            <?php if ($numrow=="0") {
                            } else { ?>
                            <?php if (isset($_POST['cari']) || isset($_GET['cari'])) { ?>
                                    Hasil Pencarian: <?=$numrow?> data<br>
                                    <div class="dataTable_wrapper">
                                        <table width="104%" class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Tanggal Awal</th>
                                                    <th>Tanggal Akhir</th>
                                                    <th>Kecamatan</th>
                                                    <th>Total Jumlah Denda</th>
                                                    <th>Total Jumlah Pembayaran</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><?=date_format(date_create($TGL_AWAL), 'd-m-Y')?></td>
                                                    <td><?=date_format(date_create($TGL_AKHIR), 'd-m-Y')?></td>
                                                    <td>
                                                      <?php $kec = "select SQL_NO_CACHE * from REF_KELURAHAN where KD_KECAMATAN='".$KECAMATAN."'";
                                                        $data = mysqli_fetch_assoc(mysqli_query($conn, $kec));
                                                        if ($KELURAHAN!="all_kell") {
                                                          echo $data['NM_KELURAHAN'];
                                                        } else {
                                                          echo "SEMUA KELURAHAN";
                                                        }
                                                      ?>
                                                    </td>
                                                    <td><?=number_format($total['TOTAL_DENDA'], '0','.','.')?></td>
                                                    <td><?=number_format($total['JML'], '0','.','.')?></td>
                                                    <td>
                                                      <a href="export.php?export=export&tgl_awal=<?=$TGL_AWAL?>&tgl_akhir=<?=$TGL_AKHIR?>&kecamatan=<?=$KECAMATAN?>&kelurahan=<?=$KELURAHAN?>" class="btn btn-primary">Export</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                  <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>NOP</th>
                                        <th>Jalan OP</th>
                                        <th>Kelurahan</th>
                                        <th>RT/RW</th>
                                        <th>Nama WP</th>
                                        <th>Tahun Pajak</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Denda</th>
                                        <th>Jumlah Yg Dibayar</th>
                                        <th>Nama Pendata</th>
                                      </tr>
                                    </thead>
                                  <?php } ?>
                          <?php
                            $i=0;
                            while (($row = mysqli_fetch_assoc($s))) {
                            $tgl_bayar = date_create($row['TGL_PEMBAYARAN_SPPT']);
                            // Use the uppercase column names for the associative array indices
                            $i=$i+1;

                          ?>


                              <?php if (isset($_POST['cari']) || isset($_GET['cari'])) { ?>
                                <tbody>
                                    <tr>
                                        <td><?=$i;?></td>
                                        <td><?=$row['KD_PROPINSI'].$row['KD_DATI2'].$row['KD_KECAMATAN'].$row['KD_KELURAHAN'].$row['KD_BLOK'].$row['NO_URUT'].$row['KD_JNS_OP']?></td>
                                        <td><?=$row['JALAN_OP']?></td>
                                        <td><?=$row['NM_KELURAHAN']?></td>
                                        <td><?=$row['RT_WP_SPPT'].'/'.$row['RW_WP_SPPT']?></td>
                                        <td><?=$row['NM_WP_SPPT']?></td>
                                        <td><?=$row['THN_PAJAK_SPPT']?></td>
                                        <td><?=date_format($tgl_bayar, "d-m-Y")?></td>
                                        <td><?=$row['DENDA_SPPT']?></td>
                                        <td><?=number_format($row['JML_SPPT_YG_DIBAYAR'], '0','.','.')?></td>
                                        <td><?=$row['NM_TP']?></td>
                                    </tr>
                                  </tbody>
                                <?php } ?>
                            <?php } ?>
                          </table>
                          <br>

                          <?php
                          // 7. Construct pagination hyperlinks
                          // Finally we must construct the hyperlinks which will allow the user to select
                          // other pages. We will start with the links for any previous pages.
							if(isset($_POST['cari']) || isset($_GET['cari'])) {

                            IF ($hal == 1) {
                               ECHO " FIRST PREV ";
                            } ELSE {
                              if(isset($_POST['cari'])||isset($_GET['cari'])){
                               ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=1&paging=paging&cari=cari&tgl_awal=".$TGL_AWAL."&tgl_akhir=".$TGL_AKHIR."&kecamatan=".$KECAMATAN."&kelurahan=".$KELURAHAN."'>FIRST</a> ";}
                                else{

								}
                               $prevpage = $hal-1;
                                if(isset($_POST['cari'])||isset($_GET['cari'])){
                               ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$prevpage&paging=paging&cari=cari&tgl_awal=".$TGL_AWAL."&tgl_akhir=".$TGL_AKHIR."&kecamatan=".$KECAMATAN."&kelurahan=".$KELURAHAN."'>PREV</a> ";}
                                else{

								}
                            } // if
                            // Next we inform the user of his current position in the sequence of available pages.
                            ECHO " ( Page $hal of $lastpage ) ";
                            // This code will provide the links for any following pages.
                            IF ($hal == $lastpage) {
                               ECHO " NEXT LAST ";
                            } ELSE {
                               $nextpage = $hal+1;
                               if(isset($_POST['cari'])||isset($_GET['cari'])){
                               ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$nextpage&paging=paging&cari=cari&tgl_awal=".$TGL_AWAL."&tgl_akhir=".$TGL_AKHIR."&kecamatan=".$KECAMATAN."&kelurahan=".$KELURAHAN."'>NEXT</a> ";
                               ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$lastpage&paging=paging&cari=cari&tgl_awal=".$TGL_AWAL."&tgl_akhir=".$TGL_AKHIR."&kecamatan=".$KECAMATAN."&kelurahan=".$KELURAHAN."'>LAST</a> ";}
                                else {
                                }
                            } // if
							}
                          ?>
                          <?php } ?>
                          </div>
                          </div>

                        </div>
                    </div>
                  </div>
                </div>

            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-6 --><!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
    <script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>

    <script type="text/javascript" src="../../dist/datepicker/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../dist/datepicker/bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../../dist/datepicker/bootstrap/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
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
                    $("#kelurahan").html(msg);
                }
            });    
            });
        });
    </script>
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

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>
