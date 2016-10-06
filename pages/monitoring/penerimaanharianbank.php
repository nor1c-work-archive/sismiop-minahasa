<?php
session_start();//session starts here
include '../../bin/dbconn.php';

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
  if(isset($_GET['paging'])) {
      $TGL = $_GET['tgl'];
      $kanwil = $_GET['kanwil'];
      $kppbb = $_GET['kppbb'];
      $bank_t = $_GET['bankt'];
      $bank_p = $_GET['bankp'];
      $tp = $_GET['tp'];
  } else {
    $TGL = $_POST['tgl'];
    $BANK = $_POST['bank'];

    // $explodebank = explode(".", $_POST['bank']);
    list($kanwil, $kppbb, $bank_t, $bank_p, $tp) = explode(".", $BANK);
  }
  
  $q = "SELECT count(*) from PEMBAYARAN_SPPT
        WHERE TGL_PEMBAYARAN_SPPT = '".$TGL."' and
        KD_KANWIL_BANK='".$kanwil."' and
        KD_KPPBB_BANK='".$kppbb."' and
        KD_BANK_TUNGGAL='".$bank_t."' and
        KD_BANK_PERSEPSI='".$bank_p."' and
        KD_TP='".$tp."';
  ";

  $j = "SELECT SUM(JML_SPPT_YG_DIBAYAR) as JML, SUM(DENDA_SPPT) as TOTAL_DENDA from PEMBAYARAN_SPPT
  WHERE TGL_PEMBAYARAN_SPPT = '".$TGL."' and
  KD_KANWIL_BANK='".$kanwil."' and
  KD_KPPBB_BANK='".$kppbb."' and
  KD_BANK_TUNGGAL='".$bank_t."' and
  KD_BANK_PERSEPSI='".$bank_p."' and
  KD_TP='".$tp."';
  ";
} else {
  $q = "SELECT count(*) from PEMBAYARAN_SPPT";

  $j = "SELECT SUM(JML_SPPT_YG_DIBAYAR) as JML, SUM(DENDA_SPPT) as TOTAL_DENDA from PEMBAYARAN_SPPT";
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
                    <h1 class="page-header">Penerimaan PBB Per-Bank</h1>
                </div>
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Home &gt; Monitoring &gt; Penerimaan PBB Per-Bank
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-lg-6">
                              <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                <div class="form-group">

                                    <!-- <input type="hidden" id="dtp_input2" value="" /> -->
                                  <label>Pilih Tanggal</label>
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                    <input placeholder="Tanggal" class="form-control" name="tgl" size="30" type="text" value="">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                    <!-- <input type="hidden" id="dtp_input2" value="" /> -->
                                </div>
                                <div class="form-group">
                                  <label>Tempat Pembayaran</label>
                                  <select name="bank" class="form-control">
                                    <option disabled selected hidden>TEMPAT PEMBAYARAN</option>
                                    <?php $kec = "select * from TEMPAT_PEMBAYARAN WHERE NM_TP!='SAMA DENGAN TAHUN LALU' ORDER BY NM_TP ASC";
                                    $kecq = mysqli_query($conn, $kec);
                                    while ($row = mysqli_fetch_assoc($kecq)) {
                                    ?>
                                      <option value="<?=$row['KD_KANWIL'].'.'.$row['KD_KPPBB'].'.'.$row['KD_BANK_TUNGGAL'].'.'.$row['KD_BANK_PERSEPSI'].'.'.$row['KD_TP']?>">
                                        <?=$row['KD_KANWIL'].'-'.$row['KD_KPPBB'].'-'.$row['KD_BANK_TUNGGAL'].'-'.$row['KD_BANK_PERSEPSI'].'-'.$row['KD_TP'].'. '.$row['NM_TP']?>
                                      </option>
                                    <?php } ?>
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

                              if (isset($_POST['cari']) || isset($_GET['cari'])) {
                                if (!isset($_GET['paging'])) {
                                  $TGL = $_POST['tgl'];
                                  $BANK = $_POST['bank'];

                                  list($kanwil, $kppbb, $bank_t, $bank_p, $tp) = explode(".", $BANK);
                                } else {
                                  $TGL = $_GET['tgl'];
                                  $kanwil = $_GET['kanwil'];
                                  $kppbb = $_GET['kppbb'];
                                  $bank_t = $_GET['bankt'];
                                  $bank_p = $_GET['bankp'];
                                  $tp = $_GET['tp'];
                                }

                                // $explodebank = explode(".", $_POST['bank']);
                                
                                ?>

                                <?php if (isset($_POST['cari']) || isset($_GET['cari'])) { ?>
                                  Hasil Pencarian: <?=$numrow?> data<br>
                                  <div class="dataTable_wrapper">
                                      <table width="104%" class="table table-striped table-bordered table-hover">
                                          <thead>
                                              <tr>
                                                  <th>Tanggal</th>
                                                  <th>Tempat Pembayaran</th>
                                                  <th>Total Jumlah Denda</th>
                                                  <th>Total Jumlah Pembayaran</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <tr>
                                                  <td><?=date_format(date_create($TGL), 'd-m-Y')?></td>
                                                  <td>
                                                    <?php $tpq = "select * from TEMPAT_PEMBAYARAN where KD_KANWIL='".$kanwil."' and KD_KPPBB='".$kppbb."' and
                                                    KD_BANK_TUNGGAL='".$bank_t."' and KD_BANK_PERSEPSI='".$bank_p."' and KD_TP='".$tp."'";
                                                      $data = mysqli_fetch_assoc(mysqli_query($conn, $tpq));
                                                      echo $data['NM_TP'];
                                                    ?>
                                                  </td>
                                                  <td><?=number_format($total['TOTAL_DENDA'], '0','.','.')?></td>
                                                  <td><?=number_format($total['JML'], '0','.','.')?></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                                  <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                      <tr>
                                        <th>No</th>
                                        <th>NOP</th>
                                        <th>Kelurahan</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Denda</th>
                                        <th>Jumlah Yg Dibayar</th>
                                        <!-- <th>&nbsp;</th> -->
                                      </tr>
                                    </thead>
                                <?php } ?>
                                <?php
                                if (!isset($_GET['paging'])) {
                                  $TGL = $_POST['tgl'];
                                  $BANK = $_POST['bank'];

                                  // $explodebank = explode(".", $_POST['bank']);
                                  list($kanwil, $kppbb, $bank_t, $bank_p, $tp) = explode(".", $BANK);
                                } else {
                                  $TGL = $_GET['tgl'];
                                  $kanwil = $_GET['kanwil'];
                                  $kppbb = $_GET['kppbb'];
                                  $bank_t = $_GET['bankt'];
                                  $bank_p = $_GET['bankp'];
                                  $tp = $_GET['tp'];
                                }


                                $q = "SELECT * from PEMBAYARAN_SPPT
                                      WHERE TGL_PEMBAYARAN_SPPT = '".$TGL."' and
                                      KD_KANWIL_BANK='".$kanwil."' and
                                      KD_KPPBB_BANK='".$kppbb."' and
                                      KD_BANK_TUNGGAL='".$bank_t."' and
                                      KD_BANK_PERSEPSI='".$bank_p."' and
                                      KD_TP='".$tp."'
                                      LIMIT $limitmin, $limitmax;
                                ";
                              } else {
                                $q = "SELECT * from PEMBAYARAN_SPPT LIMIT $limitmin, $limitmax;
                                ";
                              }

                              $s = mysqli_query($conn, $q) or die (mysqli_error($conn));

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
                                      <td><?=$row['KD_KELURAHAN']?></td>
                                      <td><?=date_format($tgl_bayar, "d-m-Y")?></td>
                                      <td><?=number_format($row['DENDA_SPPT'], '0','.','.')?></td>
                                      <td><?=number_format($row['JML_SPPT_YG_DIBAYAR'], '0','.','.')?></td>
                                      <!-- <td>
                                      <form target="_blank" method="post" action="pembayaran2.php?NOP=<?=$row['KD_PROPINSI'].$row['KD_DATI2'].$row['KD_KECAMATAN'].$row['KD_KELURAHAN'].$row['KD_BLOK'].$row['NO_URUT'].$row['KD_JNS_OP']?>">
                                        <input type="hidden" name="KD_PROPINSI" value="<?=$row['KD_PROPINSI']?>">
                                        <input type="hidden" name="KD_DATI2" value="<?=$row['KD_DATI2']?>">
                                        <input type="hidden" name="KD_KECAMATAN" value="<?=$row['KD_KECAMATAN']?>">
                                        <input type="hidden" name="KD_KELURAHAN" value="<?=$row['KD_KELURAHAN']?>">
                                        <input type="hidden" name="KD_BLOK" value="<?=$row['KD_BLOK']?>">
                                        <input type="hidden" name="NO_URUT" value="<?=$row['NO_URUT']?>">
                                        <input type="hidden" name="KD_JNS_OP" value="<?=$row['KD_JNS_OP']?>">
                                      </form></td> -->
                                  </tr>
                                  <?php } ?>
                              </tbody>
                            <?php } ?>
                          </table>
                          <br>

                          <?php
                          if (ISSET($_POST['cari']) || isset($_GET['cari'])) {
                            // 7. Construct pagination hyperlinks
                            // Finally we must construct the hyperlinks which will allow the user to select
                            // other pages. We will start with the links for any previous pages.
                            IF ($hal == 1) {
                               ECHO " FIRST PREV ";
                            } ELSE {
                              if(isset($_POST['cari'])||isset($_GET['cari'])){
                               ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=1&paging=paging&cari=cari&tgl=".$TGL."&kanwil=".$kanwil."&kppbb=".$kppbb."&bankt=".$bank_t."&bankp=".$bank_p."&tp=".$tp."'>FIRST</a> ";}
                                else{

                                }
                               $prevpage = $hal-1;
                                if(isset($_POST['cari'])||isset($_GET['cari'])){
                               ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$prevpage&paging=paging&cari=cari&tgl=".$TGL."&kanwil=".$kanwil."&kppbb=".$kppbb."&bankt=".$bank_t."&bankp=".$bank_p."&tp=".$tp."'>PREV</a> ";}
                                else{

                                }
                            } // if
                            // Next we inform the user of his current position in the sequence of available pages.
                            ECHO " ( Page $hal of $lastpage ) ";
                            // This code will provide the links for any following pages.
                            IF ($hal == $lastpage) {
                               ECHO " NEXT LAST ";
                            } ELSE {
                                if (!isset($_GET['paging'])) {
                                  list($kanwil, $kppbb, $bank_t, $bank_p, $tp) = explode(".", $BANK);
                                }

                               $nextpage = $hal+1;
                               if(isset($_POST['cari'])||isset($_GET['cari'])){
                               ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$nextpage&paging=paging&cari=cari&tgl=".$TGL."&kanwil=".$kanwil."&kppbb=".$kppbb."&bankt=".$bank_t."&bankp=".$bank_p."&tp=".$tp."'>NEXT</a> ";
                               ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$lastpage&paging=paging&cari=cari&tgl=".$TGL."&kanwil=".$kanwil."&kppbb=".$kppbb."&bankt=".$bank_t."&bankp=".$bank_p."&tp=".$tp."'>LAST</a> ";}
                                else {
                                }
                            } // if
                          }
                          ?>
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
