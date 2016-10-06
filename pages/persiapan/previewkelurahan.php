<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
  if (isset($_GET['pilih']) || isset($_POST['pilih'])) {
    $KD_KECAMATAN = $_POST['KD_KECAMATAN'];
    $KD_KELURAHAN = $_POST['KD_KELURAHAN'];

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
    <link href="../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

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

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->

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
                    <h1 class="page-header">Pembayaran per Kelurahan</h1>
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
                            Home &gt; Pembayaran per Kelurahan &gt; Ref Kelurahan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div>
                            <div class="dataTable_wrapper">
                                <table width="104%" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kecamatan</th>
                                            <th>Kelurahan</th>
                                            <th>Jumlah NOP</th>
                                            <th>Total PBB yang Belum Terbayar</th>
                                            <th>Pilih Tahun yang akan dibayarkan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                          <?php
                                            $sql2 = "SELECT a.NM_WP_SPPT, a.PBB_YG_HARUS_DIBAYAR_SPPT, a.TGL_JATUH_TEMPO_SPPT, b.*, c.NM_TP, d.NM_KECAMATAN, e.NM_KELURAHAN FROM BATAL_SPPT a
                                            LEFT JOIN PEMBAYARAN_TES b
                                            on(a.KD_KECAMATAN=b.KD_KECAMATAN and a.KD_KELURAHAN and b.KD_KELURAHAN and a.KD_BLOK=b.KD_BLOK and a.NO_URUT=b.NO_URUT and a.THN_PAJAK_SPPT=b.THN_PAJAK_SPPT)
                                            LEFT JOIN tempat_pembayaran c
                                            on(a.KD_KANWIL_BANK=c.KD_KANWIL and a.KD_KPPBB_BANK=c.KD_KPPBB and a.KD_BANK_TUNGGAL=c.KD_BANK_TUNGGAL and a.KD_BANK_PERSEPSI=c.KD_BANK_PERSEPSI)
                                            LEFT JOIN ref_kecamatan d
                                            on(a.KD_KECAMATAN=d.KD_KECAMATAN)
                                            LEFT JOIN REF_KELURAHAN e
                                            on(a.KD_KECAMATAN=e.KD_KECAMATAN and a.KD_KELURAHAN=e.KD_KELURAHAN)
                                            WHERE a.KD_KECAMATAN='".$KD_KECAMATAN."' and a.KD_KELURAHAN='".$KD_KELURAHAN."'
                                            GROUP BY
                                            a.KD_KECAMATAN,a.KD_KELURAHAN,a.THN_PAJAK_SPPT,a.PBB_YG_HARUS_DIBAYAR_SPPT, a.TGL_JATUH_TEMPO_SPPT
                                            ";
                                            $sqla2 = mysqli_query($conn, $sql2) or die (mysqli_error($conn));
                                            $data = mysqli_fetch_assoc($sqla2);

                                            $totals = "select count(*) as TOTAL, SUM(a.PBB_YG_HARUS_DIBAYAR_SPPT) as TOTAL_PBB, b.* from BATAL_SPPT a
                                            LEFT JOIN PEMBAYARAN_TES b
                                            on(a.KD_PROPINSI=b.KD_PROPINSI
                                            and a.KD_DATI2=b.KD_DATI2
                                            and a.KD_KECAMATAN=b.KD_KECAMATAN
                                            and a.KD_KELURAHAN=b.KD_KELURAHAN
                                            and a.KD_BLOK=b.KD_BLOK
                                            and a.NO_URUT=b.NO_URUT
                                            and a.KD_JNS_OP=b.KD_JNS_OP
                                            and a.THN_PAJAK_SPPT=b.THN_PAJAK_SPPT)
                                            WHERE
														                a.KD_KECAMATAN='".$KD_KECAMATAN."' AND
                                            a.KD_KELURAHAN='".$KD_KELURAHAN."' AND
                                            b.KD_KECAMATAN is NULL AND
                                            b.KD_KELURAHAN is NULL AND
                                            b.KD_BLOK is NULL AND
                                            b.NO_URUT is NULL AND
                                            b.KD_KANWIL_BANK is NULL AND
                                            b.KD_KPPBB_BANK is NULL AND
                                            b.KD_BANK_TUNGGAL is NULL AND
                                            b.KD_BANK_PERSEPSI is NULL AND
                                            b.TGL_PEMBAYARAN_SPPT is NULL AND
                                            b.THN_PAJAK_SPPT is NULL
                                            ";
                                            $totalq = mysqli_query($conn, $totals);
                                            $dattotal = mysqli_fetch_assoc($totalq);
                                          ?>
                                            <td><?=$data['NM_KECAMATAN']?></td>
                                            <td><?=$data['NM_KELURAHAN']?></td>
                                            <td><?=$dattotal['TOTAL']?></td>
                                            <td>Rp. <?=number_format($dattotal['TOTAL_PBB'], '0','.','.')?></td>
                                            <td>
                                              <form class="" action="prosesbayar.php" method="post">
                                              <select id="graph_select2" name="tahun">
                                                <?php $sql = "select DISTINCT(THN_PAJAK_SPPT) as TAHUN from batal_sppt ORDER BY THN_PAJAK_SPPT ASC";
                                                $sqla = mysqli_query($conn, $sql);
                                                while ($sqlr = mysqli_fetch_assoc($sqla)) { ?>
                                                  <option id="<?=$sqlr['TAHUN']?>" value="<?=$sqlr['TAHUN']?>"><?=$sqlr['TAHUN']?></option>
                                                <?php } ?>
                                              </select>

                                              <!-- NOP -->
                                              <span id="2016a">
                                              <?php $sql16 = "select SUM(PBB_YG_HARUS_DIBAYAR_SPPT) as TOTAL from batal_sppt where THN_PAJAK_SPPT=2012";
                                              $r16 = mysqli_query($conn, $sql16) or die(mysqli_error($conn));
                                              $data16 = mysqli_fetch_assoc($r16);
                                              echo $data16['TOTAL'] ?>
                                              </span>

                                            </td>
                                            <td>
                                                <input type="hidden" name="KD_KECAMATAN" value="<?=$KD_KECAMATAN?>">
                                                <input type="hidden" name="KD_KELURAHAN" value="<?=$KD_KELURAHAN?>">
                                                <input type="submit" class="btn btn-primary" name="bayar" value="Bayar">
                                              </form>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NOP</th>
                                            <th>Jalan OP</th>
                                            <th>Kelurahan</th>
                                            <th>RT/RW</th>
                                            <th>Nama WP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $no = 1;
                                        $user = "SELECT a.KD_PROPINSI,a.KD_DATI2,a.KD_KECAMATAN,a.KD_KELURAHAN,a.KD_BLOK,a.NO_URUT,a.KD_JNS_OP
                                        ,a.SUBJEK_PAJAK_ID, a.JALAN_OP, a.RT_OP, a.RW_OP, b.NM_WP
                                            from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
                                            WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
                                            KD_KECAMATAN = '".$KD_KECAMATAN."' AND
                                            KD_KELURAHAN = '".$KD_KELURAHAN."'
                                            ";
                                        $userc = mysqli_query($conn, $user);
                                        while ($row = mysqli_fetch_assoc($userc)) {
                                        ?>
                                        <tr>
                                          <td><?=$no++?></td>
                                          <td><?=$row['KD_PROPINSI'].$row['KD_DATI2'].$row['KD_KECAMATAN'].$row['KD_KELURAHAN'].$row['KD_BLOK'].$row['NO_URUT'].$row['KD_JNS_OP']?></td>
                                          <td><?=$row['JALAN_OP']?></td>
                                          <td><?=$row['KD_KELURAHAN']?></td>
                                          <td><?=$row['RT_OP'].'/'.$row['RW_OP']?></td>
                                          <td><?=$row['NM_WP']?></td>
                                        </tr>
                                        <?php }
                                      ?>
                                    </tbody>
                                   </table>
                            </div>
                          </div>
                            <!-- /.table-responsive -->
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
      $("#graph_select").change(function() {
        if ($("#2012").is(":selected")) {
          $("#2016a").show();
        } else if ($("#nmwp").is(":selected")) {
          $("#nops").hide();
          $("#nmwps").show();
          $("#jlnops").hide();
        } else {
          $("#nops").hide();
          $("#nmwps").hide();
          $("#jlnops").show();
        }
      }).trigger('change');
      });
    </script>
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
