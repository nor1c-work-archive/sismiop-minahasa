<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['edit']) || isset($_POST['edit'])) {
  $KD_PROPINSI                = $_POST['KD_PROPINSI'];
  $KD_DATI2                = $_POST['KD_DATI2'];
  $KD_KECAMATAN                = $_POST['KD_KECAMATAN'];
  $KD_KELURAHAN                = $_POST['KD_KELURAHAN'];
  $KD_BLOK                = $_POST['KD_BLOK'];
  $NO_URUT                = $_POST['NO_URUT'];
  $KD_JNS_OP                = $_POST['KD_JNS_OP'];
  $NM_WP_SPPT                 = $_POST['NM_WP_SPPT'];
  $NPWP_SPPT                  = $_POST['NPWP_SPPT'];
  $KD_KLS_TANAH               = $_POST['KD_KLS_TANAH'];
  $KD_KLS_BNG                 = $_POST['KD_KLS_BNG'];
  $TGL_JATUH_TEMPO_SPPT       = $_POST['TGL_JATUH_TEMPO_SPPT'];
  $LUAS_BUMI_SPPT             = $_POST['LUAS_BUMI_SPPT'];
  $LUAS_BNG_SPPT              = $_POST['LUAS_BNG_SPPT'];
  $NJOP_BUMI_SPPT             = $_POST['NJOP_BUMI_SPPT'];
  $NJOP_BNG_SPPT              = $_POST['NJOP_BNG_SPPT'];
  $NJOP_SPPT                  = $_POST['NJOP_SPPT'];
  $NJOPTKP_SPPT               = $_POST['NJOPTKP_SPPT'];
  $NJKP_SPPT                  = $_POST['NJKP_SPPT'];
  $PBB_TERHUTANG_SPPT         = $_POST['PBB_TERHUTANG_SPPT'];
  $PBB_YG_HARUS_DIBAYAR_SPPT  = $_POST['PBB_YG_HARUS_DIBAYAR_SPPT'];


  $updq = "update ALL_SPPT SET NM_WP_SPPT='$NM_WP_SPPT', NPWP_SPPT='$NPWP_SPPT', KD_KLS_TANAH='$KD_KLS_TANAH', KD_KLS_BNG='$KD_KLS_BNG', TGL_JATUH_TEMPO_SPPT='$TGL_JATUH_TEMPO_SPPT', LUAS_BUMI_SPPT='$LUAS_BUMI_SPPT', LUAS_BNG_SPPT='LUAS_BNG_SPPT', NJOP_BUMI_SPPT='$NJOP_BUMI_SPPT', NJOP_BNG_SPPT='$NJOP_BNG_SPPT', NJOP_SPPT='$NJOP_SPPT', NJOPTKP_SPPT='$NJOPTKP_SPPT', NJKP_SPPT='$NJKP_SPPT', PBB_TERHUTANG_SPPT='$PBB_TERHUTANG_SPPT', PBB_YG_HARUS_DIBAYAR_SPPT='$PBB_YG_HARUS_DIBAYAR_SPPT' WHERE KD_PROPINSI='$KD_PROPINSI' and KD_DATI2='$KD_DATI2' and KD_KECAMATAN='$KD_KECAMATAN' and KD_KELURAHAN='$KD_KELURAHAN' and KD_BLOK='$KD_BLOK' and NO_URUT='$NO_URUT' and KD_JNS_OP='$KD_JNS_OP' and THN_PAJAK_SPPT='".date('Y', time())."'";
  if (mysqli_query($conn, $updq)) {
    $_SESSION['notif'] = "Data SPPT Berhasil Diupdate";
    header("Location: sppt.php");
  } else {
    $_SESSION['notif'] = "Data SPPT Gagal Diupdate";
    header("Location: sppt.php");
  }
}

// 1. Get $hal from url
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
    <link href="../../dist/datepicker/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
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

</head>

<body>

    <div id="wrapper">

      <?php include "../header2.php";?>
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
                    <h1 class="page-header">Edit Referensi Pekerjaan WP</h1>
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
                            Home &gt; Referensi &gt; Referensi Pekerjaan WP &gt; Edit Referensi Pekerjaan WP
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                <?php
                                  list($KD_PROPINSI, $KD_DATI2, $KD_KECAMATAN, $KD_KELURAHAN, $KD_BLOK, $NO_URUT, $KD_JNS_OP) = explode(".", $_GET['refid']);

                                  $se = "select * from ALL_SPPT where KD_PROPINSI='".$KD_PROPINSI."' and KD_DATI2='".$KD_DATI2."' and KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."' and KD_BLOK='".$KD_BLOK."' and NO_URUT='".$NO_URUT."' and KD_JNS_OP='".$KD_JNS_OP."' and THN_PAJAK_SPPT='".date('Y', time())."'";
                                  $sec = mysqli_query($conn, $se);
                                  while ($data = mysqli_fetch_assoc($sec)) { ?>
                                      <div class="table-responsive">
                                      <table class="table table-bordered">
                                      <input type="hidden" name="KD_PROPINSI" value="<?=$KD_PROPINSI;?>">
                                      <input type="hidden" name="KD_DATI2" value="<?=$KD_DATI2;?>">
                                      <input type="hidden" name="KD_KECAMATAN" value="<?=$KD_KECAMATAN;?>">
                                      <input type="hidden" name="KD_KELURAHAN" value="<?=$KD_KELURAHAN?>">
                                      <input type="hidden" name="KD_BLOK" value="<?=$KD_BLOK?>">
                                      <input type="hidden" name="NO_URUT" value="<?=$NO_URUT;?>">
                                      <input type="hidden" name="KD_JNS_OP" value="<?=$KD_JNS_OP;?>">
                                      <tr>
                                        <td>
                                          NOP
                                        </td>
                                        <td>
                                          <?=$data['KD_PROPINSI'].'-'.$data['KD_DATI2'].'-'.$data['KD_KECAMATAN'].'-'.$data['KD_KELURAHAN'].'-'.$data['KD_BLOK'].'-'.$data['NO_URUT'].'-'.$data['KD_JNS_OP']?>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Nama Wajib Pajak
                                        </td>
                                        <td>
                                          <input type="text" name="NM_WP_SPPT" class="form-control" value="<?=$data['NM_WP_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          NPWP
                                        </td>
                                        <td>
                                          <input type="text" name="NPWP_SPPT" class="form-control" value="<?=$data['NPWP_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode Kelas Tanah
                                        </td>
                                        <td>
                                          <input type="text" name="KD_KLS_TANAH" class="form-control" value="<?=$data['KD_KLS_TANAH']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode Kelas Bangunan
                                        </td>
                                        <td>
                                          <input type="text" name="KD_KLS_BNG" class="form-control" value="<?=$data['KD_KLS_BNG']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Tanggal Jatuh Tempo SPPT
                                        </td>
                                        <td>
                                          <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;">
                                          <input placeholder="Tanggal Jatuh Tempo SPPT" class="form-control" name="TGL_JATUH_TEMPO_SPPT" type="text" value="<?=$data['TGL_JATUH_TEMPO_SPPT']?>">
                                          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                          </div>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Luas Bumi SPPT
                                        </td>
                                        <td>
                                          <input type="text" name="LUAS_BUMI_SPPT" class="form-control" value="<?=$data['LUAS_BUMI_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Luas Bangunan SPPT
                                        </td>
                                        <td>
                                          <input type="text" name="LUAS_BNG_SPPT" class="form-control" value="<?=$data['LUAS_BNG_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          NJOP Bumi SPPT
                                        </td>
                                        <td>
                                          <input type="text" name="NJOP_BUMI_SPPT" class="form-control" value="<?=$data['NJOP_BUMI_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          NJOP Bangunan SPPT
                                        </td>
                                        <td>
                                          <input type="text" name="NJOP_BNG_SPPT" class="form-control" value="<?=$data['NJOP_BNG_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          NJOP SPPT
                                        </td>
                                        <td>
                                          <input type="text" name="NJOP_SPPT" class="form-control" value="<?=$data['NJOP_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          NJOPTKP SPPT
                                        </td>
                                        <td>
                                          <input type="text" name="NJOPTKP_SPPT" class="form-control" value="<?=$data['NJOPTKP_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          NJKP SPPT
                                        </td>
                                        <td>
                                          <input type="text" name="NJKP_SPPT" class="form-control" value="<?=$data['NJKP_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          PBB Terhutang SPPT
                                        </td>
                                        <td>
                                          <input type="text" name="PBB_TERHUTANG_SPPT" class="form-control" value="<?=$data['PBB_TERHUTANG_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          PBB Yang Harus Dibayar SPPT
                                        </td>
                                        <td>
                                          <input type="text" name="PBB_YG_HARUS_DIBAYAR_SPPT" class="form-control" value="<?=$data['PBB_YG_HARUS_DIBAYAR_SPPT']?>">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>

                                        </td>
                                        <td>
                                          <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                                          <a href="pekerjaan-wp.php" class="btn btn-default">Batal</a>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                  <?php } ?>
                                </form>
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
    <script type="text/javascript" src="../../dist/datepicker/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../dist/datepicker/bootstrap/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../../dist/datepicker/bootstrap/js/bootstrap-datetimepicker.id.js" charset="UTF-8"></script>
    <script type="text/javascript" src="./jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
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
