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
    <!-- <link href="../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

</head>

<body>

    <div id="wrapper">

      <?php include("../header2.php"); ?>
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

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Home &gt; Pembayaran per Kelurahan &gt; Pilih Tahun
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
                                            <th>Pilih Tahun yang akan dibayarkan</th>
                                            <th>Total PBB yang Belum Terbayar</th>
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
                                            a.KD_KECAMATAN=b.KD_KECAMATAN and a.KD_KELURAHAN and b.KD_KELURAHAN and a.KD_BLOK=b.KD_BLOK and a.NO_URUT=b.NO_URUT and a.THN_PAJAK_SPPT=b.THN_PAJAK_SPPT,a.NM_WP_SPPT,a.PBB_YG_HARUS_DIBAYAR_SPPT,a.TGL_JATUH_TEMPO_SPPT
                                            ";
                                            $sqla2 = mysqli_query($conn, $sql2) or die (mysqli_error($conn));
                                            $data = mysqli_fetch_assoc($sqla2);

                                            $sql3 = "SELECT count(DISTINCT(a.NM_WP_SPPT)) as TOTAL FROM BATAL_SPPT a
                                            LEFT JOIN BATAL_SPPT b 
                                            on(a.KD_KECAMATAN=b.KD_KECAMATAN and a.KD_KELURAHAN and b.KD_KELURAHAN and a.KD_BLOK=b.KD_BLOK and a.NO_URUT=b.NO_URUT and a.THN_PAJAK_SPPT=b.THN_PAJAK_SPPT)
                                            WHERE a.KD_KECAMATAN='".$KD_KECAMATAN."' and a.KD_KELURAHAN='".$KD_KELURAHAN."'
                                            ";
                                            $sqla3 = mysqli_query($conn, $sql3) or die (mysqli_error($conn));
                                            $datates = mysqli_fetch_assoc($sqla3);
                                          ?>
                                            <input type="hidden" id="kecamatan" name="kecamatan" style="display:none;" value="<?=$KD_KECAMATAN?>">
                                            <input type="hidden" id="kelurahan" name="kelurahan" style="display:none;" value="<?=$KD_KELURAHAN?>">
                                            <td>
                                              <?php $sql = "select NM_KECAMATAN from REF_KECAMATAN where KD_KECAMATAN='".$KD_KECAMATAN."'";
                                              $s = mysqli_query($conn, $sql);
                                              $datkec = mysqli_fetch_assoc($s);
                                              echo $datkec['NM_KECAMATAN'] ?>
                                            </td>
                                            <td>
                                              <?php $sql = "select NM_KELURAHAN from REF_KELURAHAN where KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."'";
                                              $s = mysqli_query($conn, $sql);
                                              $datkec = mysqli_fetch_assoc($s);
                                              echo $datkec['NM_KELURAHAN'] ?>
                                            </td>
                                            <td><?=$datates['TOTAL']?></td>
                                            <td>
                                              <form class="" action="prosesbayar.php" method="post">
                                              <select id="tahun" name="tahun" class="form-control">
                                                <option selected hidden readonly disabled>PILIH TAHUN</option>
                                                <?php $sql = "select DISTINCT(THN_PAJAK_SPPT) as TAHUN from BATAL_SPPT where KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."' ORDER BY THN_PAJAK_SPPT ASC";
                                                $sqla = mysqli_query($conn, $sql);
                                                while ($sqlr = mysqli_fetch_assoc($sqla)) { ?>
                                                  <option id="<?=$sqlr['TAHUN']?>" value="<?=$sqlr['TAHUN']?>"><?=$sqlr['TAHUN']?></option>
                                                <?php } ?>
                                              </select>
                                            </td>
                                            <td><div id="total"></div></td>
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
                                        $user = "SELECT * FROM DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
                                            WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
                                            a.KD_KECAMATAN = '".$KD_KECAMATAN."' AND
                                            a.KD_KELURAHAN = '".$KD_KELURAHAN."'
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
            $("#tahun").change(function(){
            var TAHUN = $("#tahun").val();
            var KD_KECAMATAN = $("#kecamatan").val();
            var KD_KELURAHAN = $("#kelurahan").val();
                $("#imgLoad").show("");
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: "hitung_total.php",
                        data: {tahun:TAHUN, kecamatan:KD_KECAMATAN, kelurahan:KD_KELURAHAN},
                        success: function(msg){
                            if(msg == ''){
                                
                            } else {
                                $("#total").html(msg);                                                     
                            }
                                $("#imgLoad").hide();
                        }
                });
            });    
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
