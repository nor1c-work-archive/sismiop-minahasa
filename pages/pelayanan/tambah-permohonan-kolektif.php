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
    $TGL_SURAT_PERMOHONAN   = $_POST['TGL_SURAT_PERMOHONAN'];  
    $NAMA_PEMOHON           = $_POST['NAMA_PEMOHON'];
    $ALAMAT_PEMOHON         = $_POST['ALAMAT_PEMOHON'];
    $STATUS_KOLEKTIF        = $_POST['STATUS_KOLEKTIF'];
    $TGL_TERIMA_DOKUMEN_WP  = $_POST['TGL_TERIMA_DOKUMEN_WP'];
    $TGL_PERKIRAAN_SELESAI  = $_POST['TGL_PERKIRAAN_SELESAI'];
    $THN_PAJAK              = $_POST['THN_PAJAK'];
    $LETAK_OBJEK_PAJAK      = $_POST['LETAK_OBJEK_PAJAK'];
    $KD_JNS_PELAYANAN       = $_POST['KD_JNS_PELAYANAN'];
    $KD_JNS_PENGURANGAN     = $_POST['KD_JNS_PENGURANGAN'];
    $PERSENTASE             = $_POST['PERSENTASE'];
    $NAMA_PENERIMA          = $_SESSION['NM_LOGIN'];
    $NIP_PENERIMA           = $_SESSION['NIP'];
    
    $insert = "INSERT INTO PST_PERMOHONAN_KOLEKTIF SET KD_KANWIL='$KD_KANWIL', KD_KPPBB='$KD_KPPBB', THN_PELAYANAN='$THN_PELAYANAN', BUNDEL_PELAYANAN='$BUNDEL_PELAYANAN', NO_URUT_PELAYANAN='$NO_URUT_PELAYANAN', KD_PROPINSI_PEMOHON='$KD_PROPINSI_PEMOHON', KD_DATI2_PEMOHON='$KD_DATI2_PEMOHON', KD_KECAMATAN_PEMOHON='$KD_KECAMATAN_PEMOHON', KD_KELURAHAN_PEMOHON='$KD_KELURAHAN_PEMOHON', KD_BLOK_PEMOHON='$KD_BLOK_PEMOHON', NO_URUT_PEMOHON='$NO_URUT_PEMOHON', KD_JNS_OP_PEMOHON='$KD_JNS_OP_PEMOHON', TGL_SURAT_PERMOHONAN='$TGL_SURAT_PERMOHONAN', NAMA_PEMOHON='$NAMA_PEMOHON', ALAMAT_PEMOHON='$ALAMAT_PEMOHON', STATUS_KOLEKTIF='$STATUS_KOLEKTIF', TGL_TERIMA_DOKUMEN_WP='$TGL_TERIMA_DOKUMEN_WP', TGL_PERKIRAAN_SELESAI='$TGL_PERKIRAAN_SELESAI', THN_PAJAK='$THN_PAJAK', LETAK_OBJEK_PAJAK='$LETAK_OBJEK_PAJAK', KD_JNS_PELAYANAN='$KD_JNS_PELAYANAN', KD_JNS_PENGURANGAN='$KD_JNS_PENGURANGAN', PERSENTASE='$PERSENTASE', NAMA_PENERIMA='$NAMA_PENERIMA', NIP_PENERIMA='$NIP_PENERIMA'";
        if(mysqli_query($conn, $insert)) {
          $_SESSION['KD_KANWIL'] = $KD_KANWIL;
          $_SESSION['KD_KPPBB'] = $KD_KPPBB;
          $_SESSION['THN_PELAYANAN'] = $THN_PELAYANAN;
          $_SESSION['BUNDEL_PELAYANAN'] = $BUNDEL_PELAYANAN;
          $_SESSION['NO_URUT_PELAYANAN'] = $NO_URUT_PELAYANAN;
          header("Location: print-kolektif.php");
        } else {
          echo mysqli_error($conn);
        }
  } else {
    list($KD_KANWIL, $KD_KPPBB, $THN_PELAYANAN, $BUNDEL_PELAYANAN, $NO_URUT_PELAYANAN) = explode(".", $_GET['refid']);
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
                    <h1 class="page-header">Form Permohonan Kolektif</h1>
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
                            <i class="glyphicon glyphicon-home"></i> Home &gt; Pelayanan &gt; Permohonan Pelayanan &gt; Tambah Permohonan Kolektif
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                          <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <div class="panel panel-default">
                            <div class="panel-heading"><center>INPUT PERMOHONAN PST KOLEKTIF</center></div>
                            <div class="panel-body">
                            <?php 
                            $sql = "select * from PST_PERMOHONAN where KD_KANWIL='".$KD_KANWIL."' and KD_KPPBB='".$KD_KPPBB."' and THN_PELAYANAN='".$THN_PELAYANAN."' and BUNDEL_PELAYANAN='".$BUNDEL_PELAYANAN."' and NO_URUT_PELAYANAN='".$NO_URUT_PELAYANAN."'";
                            $sqla = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_assoc($sqla);
                             ?>
                              <table>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Nomor Pelayanan</td>
                                  <td style="padding-top:10px;">
                                    <input type="text" name="KD_KANWIL" value="<?=$data['KD_KANWIL']?>" class="form-control" style="width:15%;display:inline-block" maxLength="4">
                                    <input type="text" name="KD_KPPBB" value="<?=$data['KD_KPPBB']?>" class="form-control" style="width:15%;display:inline-block">
                                    <input type="text" name="THN_PELAYANAN" value="<?=$data['THN_PELAYANAN']?>" class="form-control" style="width:15%;display:inline-block">
                                    <input type="text" name="BUNDEL_PELAYANAN" value="<?=$data['BUNDEL_PELAYANAN']?>" class="form-control" style="width:15%;display:inline-block">
                                    <input type="text" name="NO_URUT_PELAYANAN" value="<?=$data['NO_URUT_PELAYANAN']?>" class="form-control" style="width:15%;display:inline-block">
                                  </td>
                                </tr>
                                <tr>
                                    <td style="padding-top:10px;" width="200">Nomor Surat Permohonan</td>
                                    <td style="padding-top:10px;">
                                      <input type="text" name="NO_SRT_PERMOHONAN" class="form-control" placeholder="Nomor Surat Permohonan">
                                    </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Tanggal Surat Permohonan</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:40%;">
                                    <input placeholder="Tanggal Surat Permohonan" class="form-control" name="TGL_SURAT_PERMOHONAN" type="text" value="">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Nama WP / Nama Pemohon</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" value="<?=$data['NAMA_PEMOHON']?>" placeholder="Nama WP / Nama Pemohon" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Alamat Pemohon</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" value="<?=$data['ALAMAT_PEMOHON']?>" name="ALAMAT_PEMOHON" placeholder="Alamat Pemohon" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Status Kolektif</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="STATUS_KOLEKTIF">
                                      <option selected readonly disabled>PILIH STATUS KOLEKTIF</option>
                                      <option value="1">KOLEKTIF</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Tanggal Penerimaan</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:40%;">
                                    <input placeholder="Tanggal Penerimaan" class="form-control" name="TGL_TERIMA_DOKUMEN_WP" type="text" value="<?=$data['TGL_TERIMA_DOKUMEN_WP']?>">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Tanggal Perkiraan Selesai</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:40%;">
                                    <input placeholder="Tanggal Perkiraan Selesai" class="form-control" name="TGL_PERKIRAAN_SELESAI" type="text" value="<?=$data['TGL_PERKIRAAN_SELESAI']?>">
                                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                    </div>
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>

                          <div class="panel panel-default">
                            <div class="panel-heading"><center>MENAMBAHKAN DATA WAJIB PAJAK</center></div>
                            <div class="panel-body">
                              <table>
                                <tr>
                                  <td style="padding-top:10px;" width="120">NOP</td>
                                  <td style="padding-top:10px;">
                                    <input type="text" id="KD_PROPINSI" name="KD_PROPINSI_PEMOHON" class="form-control" value="71" readonly="true" style="display:inline-block;width:9%;">
                                    <input type="text" name="KD_DATI2_PEMOHON" class="form-control" value="03" readonly style="display:inline-block;width:9%;">
                                    <input type="text" name="KD_KECAMATAN_PEMOHON" value="" class="form-control" style="display:inline-block;width:9%;">
                                    <input type="text" name="KD_KELURAHAN_PEMOHON" value="" class="form-control" style="display:inline-block;width:9%;">
                                    <input type="text" name="KD_BLOK_PEMOHON" value="" class="form-control" style="display:inline-block;width:9%;">
                                    <input type="text" name="NO_URUT_PEMOHON" maxlength="4" class="form-control" style="display:inline-block;width:9%;">
                                    <input type="text" name="KD_JNS_OP_PEMOHON" maxlength="1" class="form-control" style="display:inline-block;width:9%;">

                                    <a href="#" id="checkbtn" class="btn btn-success">Check</a>
                                    <span id="check"></span>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Nama Wajib Pajak / Nama Pemohon</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="NAMA_PEMOHON" placeholder="Nama Wajib Pajak / Nama Pemohon" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Letak Objek Pajak</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="LETAK_OBJEK_PAJAK" placeholder="Letak Objek Pajak" class="form-control">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Jenis Pelayanan</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_PELAYANAN">
                                      <option selected readonly disabled>PILIH JENIS PELAYANAN</option>
                                      <?php $sql = "select * from REF_JNS_PELAYANAN";
                                      $sqla = mysqli_query($conn, $sql);
                                      while ($data = mysqli_fetch_assoc($sqla)) { ?>
                                        <option value="<?=$data['KD_JNS_PELAYANAN']?>"><?=$data['NM_JENIS_PELAYANAN']?></option>
                                      <?php } ?>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Tahun Pajak</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" placeholder="Tahun Pajak" style="width:20%;" maxLength="4" class="form-control" name="THN_PAJAK" value="<?=$data['THN_PELAYANAN']?>">
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Jenis Pengurangan</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <select class="form-control" name="KD_JNS_PENGURANGAN">
                                      <option selected readonly disabled>PILIH JENIS PENGURANGAN</option>
                                      <option value="0">KOLEKTIF</option>
                                      <option value="1">NON KOLEKTIF</option>
                                    </select>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="padding-top:10px;" width="200">Persentase</td>
                                  <td style="padding-top:10px;" width="300" style="padding-right:10px;">
                                    <input type="text" name="PERSENTASE" placeholder="Persentase" style="width:20%;display:inline-block" class="form-control"> %
                                  </td>
                                </tr>
                              </table>
                            </div>
                          </div>


                          <table style="float:right;">
                            <tr>
                              <td>
                                <input type="submit" name="simpan" value="Tambah" class="btn btn-primary" >
                                <a href="index.php" class="btn btn-default" >Batal</a>
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



<?php } else {
   if ($_SESSION['ROLE']=="PEMBATALAN") {
     header("Location: ../pembatalan/index.php");
   } else {
     header("Location: ../../index.php");
   }
} ?>
