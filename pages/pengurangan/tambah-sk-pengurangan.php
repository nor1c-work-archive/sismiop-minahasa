<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
  if (isset($_POST['simpan']) || isset($_GET['simpan'])) {
    $KD_KANWIL              = $_POST['KD_KANWIL'];
    $KD_KPPBB               = $_POST['KD_KPPBB'];
    $THN_PELAYANAN          = $_POST['THN_PELAYANAN'];
    $BUNDEL_PELAYANAN       = $_POST['BUNDEL_PELAYANAN'];
    $NO_URUT_PELAYANAN      = $_POST['NO_URUT_PELAYANAN'];
    $KD_PROPINSI_PEMOHON    = $_POST['KD_PROPINSI_PEMOHON'];
    $KD_DATI2_PEMOHON       = $_POST['KD_DATI2_PEMOHON'];
    $KD_KECAMATAN_PEMOHON   = $_POST['KD_KECAMATAN_PEMOHON'];
    $KD_KELURAHAN_PEMOHON   = $_POST['KD_KELURAHAN_PEMOHON'];
    $KD_BLOK_PEMOHON        = $_POST['KD_BLOK_PEMOHON'];
    $NO_URUT_PEMOHON        = $_POST['NO_URUT_PEMOHON'];
    $KD_JNS_OP_PEMOHON      = $_POST['KD_JNS_OP_PEMOHON'];
    $THN_PENG_PERMANEN_AWAL = $_POST['THN_PENG_PERMANEN_AWAL'];
    $THN_PENG_PERMANEN_AKHIR= $_POST['THN_PENG_PERMANEN_AKHIR'];
    $JNS_SK                 = $_POST['JNS_SK'];
    $NO_SK                  = $_POST['NO_SK'];
    $STATUS_SK_PENG_PERMANEN= $_POST['STATUS_SK_PENG_PERMANEN'];
    $PCT_PENGURANGAN_PERMANEN= $_POST['PCT_PENGURANGAN_PERMANEN'];
    
    $insert3 = "INSERT INTO PENGURANGAN_PERMANEN SET KD_KANWIL='$KD_KANWIL', KD_KPPBB='$KD_KPPBB', THN_PELAYANAN='$THN_PELAYANAN', BUNDEL_PELAYANAN='$BUNDEL_PELAYANAN', NO_URUT_PELAYANAN='$NO_URUT_PELAYANAN', KD_PROPINSI_PEMOHON='$KD_PROPINSI_PEMOHON', KD_DATI2_PEMOHON='$KD_DATI2_PEMOHON', KD_KECAMATAN_PEMOHON='$KD_KECAMATAN_PEMOHON', KD_KELURAHAN_PEMOHON='$KD_KELURAHAN_PEMOHON', KD_BLOK_PEMOHON='$KD_BLOK_PEMOHON', NO_URUT_PEMOHON='$NO_URUT_PEMOHON', KD_JNS_OP_PEMOHON='$KD_JNS_OP_PEMOHON', THN_PENG_PERMANEN_AWAL='$THN_PENG_PERMANEN_AWAL', THN_PENG_PERMANEN_AKHIR='$THN_PENG_PERMANEN_AKHIR', JNS_SK='$JNS_SK', NO_SK='$NO_SK', STATUS_SK_PENG_PERMANEN='$STATUS_SK_PENG_PERMANEN', PCT_PENGURANGAN_PERMANEN='$PCT_PENGURANGAN_PERMANEN'";
      if(mysqli_query($conn, $insert3)) {
          $_SESSION['notif'] = "Data SK Pengurangan Permanen Berhasil Ditambah";
          header("Location: sk-pengurangan.php");
      } else {
          $_SESSION['gagal'] = "Data SK Pengurangan Permanen Gagal Ditambah";
          header("Location: sk-pengurangan.php");
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
                    <h1 class="page-header">Tambah SK</h1>
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
                            <i class="glyphicon glyphicon-home"></i> Home &gt; Pengurangan &gt; SK Pengurangan Permanen &gt; Tambah Permohonan
                        </div>
                          <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="panel-body">
                              <table>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Kode Kanwil</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="KD_KANWIL" placeholder="Kode Kanwil" style="width:25%;" maxLength="4" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Kode KPPBB</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="KD_KPPBB" placeholder="Kode KPPBB" style="width:25%;" maxLength="4" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Tahun Pelayanan</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="THN_PELAYANAN" placeholder="Tahun Pelayanan" style="width:25%;" maxLength="4" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Bundel Pelayanan</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="BUNDEL_PELAYANAN" placeholder="Bundel Pelayanan" style="width:25%;" maxLength="4" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Nomor Urut Pelayanan</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="NO_URUT_PELAYANAN" placeholder="Nomor Urut" style="width:25%;" maxLength="4" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="120">NOP Pemohon</td>
                                  <td style="padding-top:10px;">
                                    <input type="text" id="KD_PROPINSI" name="KD_PROPINSI_PEMOHON" class="form-control" value="71" readonly="true" style="display:inline-block;width:9%;">
                                    <input type="text" id="KD_DATI2" name="KD_DATI2_PEMOHON" class="form-control" value="03" readonly style="display:inline-block;width:9%;">
                                    <input type="text" id="KD_KECAMATAN" name="KD_KECAMATAN_PEMOHON" value="" class="form-control" style="display:inline-block;width:9%;">
                                    <input type="text" id="KD_KELURAHAN" name="KD_KELURAHAN_PEMOHON" value="" class="form-control" style="display:inline-block;width:9%;">
                                    <input type="text" id="KD_BLOK" name="KD_BLOK_PEMOHON" value="" class="form-control" style="display:inline-block;width:9%;">
                                    <input type="text" id="NO_URUT" name="NO_URUT_PEMOHON" maxlength="4" class="form-control" style="display:inline-block;width:9%;">
                                    <input type="text" id="KD_JNS_OP" name="KD_JNS_OP_PEMOHON" maxlength="1" class="form-control" style="display:inline-block;width:9%;">

                                    <!--<a href="#" id="checkbtn" class="btn btn-success">Check</a>
                                    <span id="check"></span>-->
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Tahun Pengurangan Awal</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="THN_PENG_PERMANEN_AWAL" placeholder="Tahun Awal" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Tahun Pengurangan Akhir</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="THN_PENG_PERMANEN_AKHIR" placeholder="Tahun Akhir" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Jenis SK</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <!--<input type="text" name="JNS_SK" placeholder="Jenis SK" class="form-control">-->
                                    <select class="form-control" name="JNS_SK">
                                      <option selected disabled readonly>PILIH JENIS SK</option>
                                      <?php 
                                      $sql = "select * from REF_JNS_SK";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($skj = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$skj['KD_SK']?>"><?=$skj['KD_SK'].' - '.$skj['NM_SK']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Nomor SK</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="NO_SK" placeholder="Nomor SK" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Status SK</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="STATUS_SK_PENG_PERMANEN" placeholder="Status SK" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Persentase SK</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="PCT_PENGURANGAN_PERMANEN" placeholder="Persentase" style="width:20%;display:inline-block" class="form-control"> %
                                  </td>
                                </tr>
                              </table>


                          <table style="float:right;">
                            <tr>
                              <td>
                                <input type="submit" name="simpan" value="Tambah" class="btn btn-primary" >
                                <a href="sk-pengurangan.php" class="btn btn-default" >Batal</a>
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

<?php } else {
  header("Location: ../../index.php");
} ?>
