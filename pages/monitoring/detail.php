<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
    header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.
}

if(!isset($_GET['NOP'])){
  echo "Error, data tidak tersedia";
  exit();
  } else {
    $KD_PROPINSI=$_POST['KD_PROPINSI'];
    $KD_DATI2=$_POST['KD_DATI2'];
    $KD_KECAMATAN=$_POST['KD_KECAMATAN'];
    $KD_KELURAHAN=$_POST['KD_KELURAHAN'];
    $KD_BLOK=$_POST['KD_BLOK'];
    $NO_URUT=$_POST['NO_URUT'];
    $KD_JNS_OP=$_POST['KD_JNS_OP'];

    $NOP=$KD_PROPINSI.'-'.$KD_DATI2.'-'.$KD_KECAMATAN.'-'.$KD_KELURAHAN.'-'.$KD_BLOK.'-'.$NO_URUT.'-'.$KD_JNS_OP;
  }//end if(!isset($_GET['NOP']))

$qOP="
select  a.JALAN_OP, a.KD_KECAMATAN, a.KD_KELURAHAN, a.RT_OP, a.RW_OP, a.KD_PROPINSI, a.KD_DATI2, a.KD_BLOK,
a.NO_URUT, a.KD_JNS_OP,
    b.NM_KECAMATAN, c.NM_KELURAHAN
 from DAT_OBJEK_PAJAK a, REF_KECAMATAN b, REF_KELURAHAN c
 where a.KD_PROPINSI=b.KD_PROPINSI
 and a.KD_DATI2=b.KD_DATI2
 and a.KD_KECAMATAN=b.KD_KECAMATAN
 and a.KD_PROPINSI=c.KD_PROPINSI
 and a.KD_DATI2=c.KD_DATI2
 and a.KD_KECAMATAN=c.KD_KECAMATAN
 and a.KD_PROPINSI='".$KD_PROPINSI."'
 and a.KD_DATI2='".$KD_DATI2."'
 and a.KD_KECAMATAN='".$KD_KECAMATAN."'
 and a.KD_KELURAHAN='".$KD_KELURAHAN."'
 and a.KD_BLOK='".$KD_BLOK."'
 and a.NO_URUT='".$NO_URUT."'
 and a.KD_JNS_OP='".$KD_JNS_OP."'
 and b.KD_KECAMATAN='".$KD_KECAMATAN."'
 and c.KD_KELURAHAN='".$KD_KELURAHAN."'
";
$s = mysqli_query($conn, $qOP);
$datOP=mysqli_fetch_assoc($s);

$qB="
select a.*, b.JML_SPPT_YG_DIBAYAR, b.TGL_PEMBAYARAN_SPPT
 from ALL_SPPT a left join PEMBAYARAN_SPPT b
 on(a.KD_PROPINSI=b.KD_PROPINSI
 and a.KD_DATI2=b.KD_DATI2
 and a.KD_KECAMATAN=b.KD_KECAMATAN
 and a.KD_KELURAHAN=b.KD_KELURAHAN
 and a.KD_BLOK=b.KD_BLOK
 and a.NO_URUT=b.NO_URUT
 and a.KD_JNS_OP=b.KD_JNS_OP
 and a.THN_PAJAK_SPPT=b.THN_PAJAK_SPPT)
 where
 a.KD_PROPINSI='".$KD_PROPINSI."'
 and a.KD_DATI2='".$KD_DATI2."'
 and a.KD_KECAMATAN='".$KD_KECAMATAN."'
 and a.KD_KELURAHAN='".$KD_KELURAHAN."'
 and a.KD_BLOK='".$KD_BLOK."'
 and a.NO_URUT='".$NO_URUT."'
 and a.KD_JNS_OP='".$KD_JNS_OP."'
 and b.JML_SPPT_YG_DIBAYAR!=0
 and b.THN_PAJAK_SPPT is not null
 order by a.THN_PAJAK_SPPT";

$sB = mysqli_query($conn, $qB);

$qDetailSPPT="
select a.*, b.JML_SPPT_YG_DIBAYAR, b.TGL_PEMBAYARAN_SPPT
 from ALL_SPPT a left join PEMBAYARAN_SPPT b
 on(a.KD_PROPINSI=b.KD_PROPINSI
 and a.KD_DATI2=b.KD_DATI2
 and a.KD_KECAMATAN=b.KD_KECAMATAN
 and a.KD_KELURAHAN=b.KD_KELURAHAN
 and a.KD_BLOK=b.KD_BLOK
 and a.NO_URUT=b.NO_URUT
 and a.KD_JNS_OP=b.KD_JNS_OP
 and a.THN_PAJAK_SPPT=b.THN_PAJAK_SPPT)
 where
 a.KD_PROPINSI='".$KD_PROPINSI."'
 and a.KD_DATI2='".$KD_DATI2."'
 and a.KD_KECAMATAN='".$KD_KECAMATAN."'
 and a.KD_KELURAHAN='".$KD_KELURAHAN."'
 and a.KD_BLOK='".$KD_BLOK."'
 and a.NO_URUT='".$NO_URUT."'
 and a.KD_JNS_OP='".$KD_JNS_OP."'
 and b.JML_SPPT_YG_DIBAYAR=0
 order by a.THN_PAJAK_SPPT";

$sDet = mysqli_query($conn, $qDetailSPPT);

  $qDetailSPPT2016="
  select a.*, b.JML_SPPT_YG_DIBAYAR, b.TGL_PEMBAYARAN_SPPT
   from ALL_SPPT a left join PEMBAYARAN_SPPT b
   on(a.KD_PROPINSI=b.KD_PROPINSI
   and a.KD_DATI2=b.KD_DATI2
   and a.KD_KECAMATAN=b.KD_KECAMATAN
   and a.KD_KELURAHAN=b.KD_KELURAHAN
   and a.KD_BLOK=b.KD_BLOK
   and a.NO_URUT=b.NO_URUT
   and a.KD_JNS_OP=b.KD_JNS_OP
   and a.THN_PAJAK_SPPT=b.THN_PAJAK_SPPT)
   where
   a.KD_PROPINSI='".$KD_PROPINSI."'
   and a.KD_DATI2='".$KD_DATI2."'
   and a.KD_KECAMATAN='".$KD_KECAMATAN."'
   and a.KD_KELURAHAN='".$KD_KELURAHAN."'
   and a.KD_BLOK='".$KD_BLOK."'
   and a.NO_URUT='".$NO_URUT."'
   and a.KD_JNS_OP='".$KD_JNS_OP."'
   and b.THN_PAJAK_SPPT is null
   order by a.THN_PAJAK_SPPT";

  $qd = mysqli_query($conn, $qDetailSPPT2016);
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style media="screen">
      iframe {
        display: none;
      }
    </style>
</head>

<body>
    <div id="wrapper">
      <?php echo'
      <!-- Navigation -->
              <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                          <span class="sr-only">Toggle navigation</span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="../pages/"><img src="../images/Logo-Minahasa.jpg" width="30px" style="float:left;margin-top:-5px;"> &nbsp;&nbsp;Sistem Informasi Manajemen Pajak Bumi dan Bangunan Minahasa</a>
                  </div>
                  <ul class="nav navbar-top-links navbar-right">
                  <li class="dropdown">
                          <a class="dropdown-toggle" data-toggle="dropdown" href="#"> Hello, '.$_SESSION['NM_LOGIN'].' as '.$_SESSION['ROLE'].'
                              <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                          </a>
                          <ul class="dropdown-menu dropdown-user">
                              <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                              </li>
                              <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                              </li>
                              <li class="divider"></li>
                              <li><a href="../../logout.php?logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                              </li>
                          </ul>
                          <!-- /.dropdown-user -->
                      </li>
                      <!-- /.dropdown -->
                  </ul>
        ';?>
            <!-- /.navbar-top-links -->
       <!-- </nav> -->

        <div id="">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Monitoring</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Home &gt; Monitoring &gt; Detail Obyek Pajak
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div>

                          </div><br>
                            <div class="dataTable_wrapper">
                                <table width="104%" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>NOP</th>
                                            <th>Alamat Objek Pajak</th>
                                            <th>Kecamatan</th>
                                            <th>Desa/Kelurahan</th>
                                            <th>RT/RW</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?=$NOP?></td>
                                            <td><?=$datOP['JALAN_OP']?></td>
                                            <td><?=$datOP['NM_KECAMATAN']?></td>
                                            <td><?=$datOP['NM_KELURAHAN']?></td>
                                            <td><?=$datOP['RT_OP']?>/<?=$datOP['RW_OP']?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                          <div class="dataTable_wrapper">
                              <table width="104%" class="table table-striped table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th width="5%">Tahun</th>
                                    <th width="11%">Nama WP</th>
                                    <th width="19%">Alamat WP</th>
                                    <th width="12%">Luas Bumi/Bangunan</th>
                                    <th width="15%">PBB Harus Dibayar</th>
                                    <th width="15%">Tgl Jatuh Tempo</th>
                                    <th width="14%">Tgl Pembayaran</th>
                                    <th width="14%">Jml Dibayar</th>
                                    <th width="14%">Status Pembayaran</th>
                                  </tr>
                                </thead>
                                <?php while (($datSPPTLunas = mysqli_fetch_assoc($sB))) {
                                  $thn_sppt = $datSPPTLunas['THN_PAJAK_SPPT'].'-01-01';
                                  $sppt_tahun =  strtotime($thn_sppt);

                                  $now = strtotime('2016-07-01');
                                  $year_sppt = date('Y', $sppt_tahun);
                                  $year_now = date('Y', $now);

                                  $month_sppt = date('m', $sppt_tahun);
                                  $month_now = date('m', $now);

                                  $jumlah_bulan = (($year_now - $year_sppt) * 12) + ($month_now - $month_sppt);
                                  $denda = $jumlah_bulan * 5000;

                                  $total = $datSPPTLunas['PBB_YG_HARUS_DIBAYAR_SPPT']+$denda;

                                ?>
                                <tbody>
                                  <tr>
                                    <td><?=$datSPPTLunas['THN_PAJAK_SPPT']?></td>
                                    <td><?=$datSPPTLunas['NM_WP_SPPT']?></td>
                                    <td><?=$datSPPTLunas['JLN_WP_SPPT']?></td>
                                    <td><?=$datSPPTLunas['LUAS_BUMI_SPPT']?>/<?=$datSPPTLunas['LUAS_BNG_SPPT']?></td>
                                    <td><?=$datSPPTLunas['PBB_YG_HARUS_DIBAYAR_SPPT']?></td>
                                    <td><?=$datSPPTLunas['TGL_JATUH_TEMPO_SPPT']?></td>
                                    <td><?=$datSPPTLunas['TGL_PEMBAYARAN_SPPT']?></td>
                                    <td><?=$datSPPTLunas['JML_SPPT_YG_DIBAYAR']?></td>
                                    <td><button type="button" class="btn btn-info btn-circle"><i class="fa fa-check"></td>
                                  </tr>
                                  <?php } ?>

                                <?php while (($datSPPT = mysqli_fetch_assoc($sDet))) {
                                  $thn_sppt = $datSPPT['THN_PAJAK_SPPT'].'-01-01';
                                  $sppt_tahun =  strtotime($thn_sppt);

                                  $now = strtotime('2016-07-01');
                                  $year_sppt = date('Y', $sppt_tahun);
                                  $year_now = date('Y', $now);

                                  $month_sppt = date('m', $sppt_tahun);
                                  $month_now = date('m', $now);

                                  $jumlah_bulan = (($year_now - $year_sppt) * 12) + ($month_now - $month_sppt);
                                  $denda = $jumlah_bulan * 5000;

                                  $total = $datSPPT['PBB_YG_HARUS_DIBAYAR_SPPT']+$denda;

                                ?>
                                <tbody>
                                  <tr>
                                    <td><?=$datSPPT['THN_PAJAK_SPPT']?></td>
                                    <td><?=$datSPPT['NM_WP_SPPT']?></td>
                                    <td><?=$datSPPT['JLN_WP_SPPT']?></td>
                                    <td><?=$datSPPT['LUAS_BUMI_SPPT']?>/<?=$datSPPT['LUAS_BNG_SPPT']?></td>
                                    <td><?=$datSPPT['PBB_YG_HARUS_DIBAYAR_SPPT']?></td>
                                    <td><?=$datSPPT['TGL_JATUH_TEMPO_SPPT']?></td>
                                    <td><?=$datSPPT['TGL_PEMBAYARAN_SPPT']?></td>
                                    <td><?=$datSPPT['JML_SPPT_YG_DIBAYAR']?></td>
                                  </tr>
                                  <?php } ?>

                                    <?php while (($datSPPT2016 = mysqli_fetch_assoc($qd))) {
                                      $thn_sppt = $datSPPT2016['THN_PAJAK_SPPT'].'-01-01';
                                      $sppt_tahun =  strtotime($thn_sppt);

                                      $now = strtotime('2016-07-01');
                                      $year_sppt = date('Y', $sppt_tahun);
                                      $year_now = date('Y', $now);

                                      $month_sppt = date('m', $sppt_tahun);
                                      $month_now = date('m', $now);

                                      $jumlah_bulan = (($year_now - $year_sppt) * 12) + ($month_now - $month_sppt);
                                      $denda = $jumlah_bulan * 5000;

                                      $total = $datSPPT2016['PBB_YG_HARUS_DIBAYAR_SPPT']+$denda;

                                    ?>
                                    <tbody>
                                      <tr>
                                        <td><?=$datSPPT2016['THN_PAJAK_SPPT']?></td>
                                        <td><?=$datSPPT2016['NM_WP_SPPT']?></td>
                                        <td><?=$datSPPT2016['JLN_WP_SPPT']?></td>
                                        <td><?=$datSPPT2016['LUAS_BUMI_SPPT']?>/<?=$datSPPT2016['LUAS_BNG_SPPT']?></td>
                                        <td><?=$datSPPT2016['PBB_YG_HARUS_DIBAYAR_SPPT']?></td>
                                        <td><?=$datSPPT2016['TGL_JATUH_TEMPO_SPPT']?></td>
                                        <td><?=$datSPPT2016['TGL_PEMBAYARAN_SPPT']?></td>
                                        <td><?=$datSPPT2016['JML_SPPT_YG_DIBAYAR']?></td>
                                    <td><button type="button" class="btn btn-danger btn-circle"><i class="fa fa-times"></td>
                                      </tr>
                                     </tbody> <?php } ?>

                                    </tbody>
                                 </table>
                              <br>
                              <div style="float:right">
                                <!-- <input type="submit" name="bayar" class="btn btn-info btn-sm" value="Bayar"> -->
                                <!-- <button name="bayar" value="bayar" type="submit" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                  Bayar
                                </button> -->
                              </div>



                            </div>
                          </div>
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
    <script type="text/javascript" src="../../bower_components/js/modal.js"></script>
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>
</html>
