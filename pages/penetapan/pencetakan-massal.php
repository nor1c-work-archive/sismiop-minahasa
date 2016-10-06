<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") { 
    if (isset($_GET['next']) || isset($_POST['next'])) {
        $KECAMATAN = $_POST['kecamatan'];
        $KELURAHAN = $_POST['kelurahan'];
        $TAHUN = $_POST['tahun'];

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
    <link href="../../dist/datepicker/bootstrap/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
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
                    <h1 class="page-header">Penetapan Massal DHKP</h1>
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
                            <i class="glyphicon glyphicon-home"></i> Home &gt; Penetapan &gt; Penetapan Massal DHKP
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                          <div class="panel">
                            <form action="penetapan-massal.php" method="post">
                              <table>
                                <?php
                                $sql1 = "select DISTINCT TGL_JATUH_TEMPO_SPPT, TGL_TERBIT_SPPT from all_sppt where KD_KECAMATAN='".$KECAMATAN."' and KD_KELURAHAN='".$KELURAHAN."' and THN_PAJAK_SPPT='".$TAHUN."' and PBB_YG_HARUS_DIBAYAR_SPPT <= (SELECT NILAI_MAX_BUKU FROM REF_BUKU WHERE KD_BUKU=1)";
                                $sqla1 = mysqli_query($conn, $sql1);
                                $buku1 = mysqli_fetch_assoc($sqla1);

                                $sql2 = "select DISTINCT TGL_JATUH_TEMPO_SPPT, TGL_TERBIT_SPPT from all_sppt where KD_KECAMATAN='".$KECAMATAN."' and KD_KELURAHAN='".$KELURAHAN."' and THN_PAJAK_SPPT='".$TAHUN."' and PBB_YG_HARUS_DIBAYAR_SPPT >= (SELECT NILAI_MIN_BUKU FROM REF_BUKU WHERE KD_BUKU=2) and PBB_YG_HARUS_DIBAYAR_SPPT <= (SELECT NILAI_MAX_BUKU FROM REF_BUKU WHERE KD_BUKU=2)";
                                $sqla2 = mysqli_query($conn, $sql2);
                                $buku2 = mysqli_fetch_assoc($sqla2);

                                $sql3 = "select DISTINCT TGL_JATUH_TEMPO_SPPT, TGL_TERBIT_SPPT from all_sppt where KD_KECAMATAN='".$KECAMATAN."' and KD_KELURAHAN='".$KELURAHAN."' and THN_PAJAK_SPPT='".$TAHUN."' and PBB_YG_HARUS_DIBAYAR_SPPT >= (SELECT NILAI_MIN_BUKU FROM REF_BUKU WHERE KD_BUKU=3) and PBB_YG_HARUS_DIBAYAR_SPPT <= (SELECT NILAI_MAX_BUKU FROM REF_BUKU WHERE KD_BUKU=3)";
                                $sqla3 = mysqli_query($conn, $sql3);
                                $buku3 = mysqli_fetch_assoc($sqla3);

                                $sql4 = "select DISTINCT TGL_JATUH_TEMPO_SPPT, TGL_TERBIT_SPPT from all_sppt where KD_KECAMATAN='".$KECAMATAN."' and KD_KELURAHAN='".$KELURAHAN."' and THN_PAJAK_SPPT='".$TAHUN."' and PBB_YG_HARUS_DIBAYAR_SPPT >= (SELECT NILAI_MIN_BUKU FROM REF_BUKU WHERE KD_BUKU=4) and PBB_YG_HARUS_DIBAYAR_SPPT <= (SELECT NILAI_MAX_BUKU FROM REF_BUKU WHERE KD_BUKU=4)";
                                $sqla4 = mysqli_query($conn, $sql4);
                                $buku4 = mysqli_fetch_assoc($sqla4);

                                $sql5 = "select DISTINCT TGL_JATUH_TEMPO_SPPT, TGL_TERBIT_SPPT from all_sppt where KD_KECAMATAN='".$KECAMATAN."' and KD_KELURAHAN='".$KELURAHAN."' and THN_PAJAK_SPPT='".$TAHUN."' and PBB_YG_HARUS_DIBAYAR_SPPT >= (SELECT NILAI_MIN_BUKU FROM REF_BUKU WHERE KD_BUKU=5)";
                                $sqla5 = mysqli_query($conn, $sql5);
                                $buku5 = mysqli_fetch_assoc($sqla5);
                                ?>
                                <tr>
                                        <td style="padding-bottom:10px;" width="130"></td>
                                        <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <label title="awd"><input type="checkbox" value="1"> Buku 1</label>
                                        </td>
                                        <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <label><input type="checkbox" value="1"> Buku 2</label>
                                        </td>
                                        <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <label><input type="checkbox" value="1"> Buku 3</label>
                                        </td>
                                        <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <label><input type="checkbox" value="1"> Buku 4</label>
                                        </td>
                                        <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <label><input type="checkbox" value="1"> Buku 5</label>
                                        </td>
                                </tr>
                                <tr>
                                        <td style="padding-bottom:10px;" width="130">Tanggal Jatuh Tempo</td>
                                        <?php if ($buku1['TGL_JATUH_TEMPO_SPPT']=="") { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" readonly disabled value="<?=$buku1['TGL_JATUH_TEMPO_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$buku1['TGL_JATUH_TEMPO_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } ?>
                                        <?php if ($buku2['TGL_JATUH_TEMPO_SPPT']=="") { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" readonly disabled value="<?=$buku2['TGL_JATUH_TEMPO_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$buku2['TGL_JATUH_TEMPO_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } ?>
                                        <?php if ($buku3['TGL_JATUH_TEMPO_SPPT']=="") { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" readonly disabled value="<?=$buku3['TGL_JATUH_TEMPO_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$buku3['TGL_JATUH_TEMPO_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } ?>
                                        <?php if ($buku4['TGL_JATUH_TEMPO_SPPT']=="") { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" readonly disabled value="<?=$buku4['TGL_JATUH_TEMPO_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$buku4['TGL_JATUH_TEMPO_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } ?>
                                        <?php if ($buku5['TGL_JATUH_TEMPO_SPPT']=="") { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" readonly disabled value="<?=$buku5['TGL_JATUH_TEMPO_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$buku5['TGL_JATUH_TEMPO_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } ?>
                                </tr>
                                <tr>
                                        <td style="padding-bottom:10px;" width="130">Tanggal Terbit</td>
                                        <?php if ($buku1['TGL_TERBIT_SPPT']=="") { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" readonly disabled value="<?=$buku1['TGL_TERBIT_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$buku1['TGL_TERBIT_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } ?>
                                        <?php if ($buku2['TGL_TERBIT_SPPT']=="") { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" readonly disabled value="<?=$buku2['TGL_TERBIT_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$buku2['TGL_TERBIT_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } ?>
                                        <?php if ($buku3['TGL_TERBIT_SPPT']=="") { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" readonly disabled value="<?=$buku3['TGL_TERBIT_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$buku3['TGL_TERBIT_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } ?>
                                        <?php if ($buku4['TGL_TERBIT_SPPT']=="") { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" readonly disabled value="<?=$buku4['TGL_TERBIT_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$buku4['TGL_TERBIT_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } ?>
                                        <?php if ($buku5['TGL_TERBIT_SPPT']=="") { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" readonly disabled value="<?=$buku5['TGL_TERBIT_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } else { ?>
                                            <td style="padding-bottom:10px;" width="150" style="padding-right:10px;">
                                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd" style="width:100%;padding-right:10px;">
                                            <input placeholder="Tanggal Pendataan" class="form-control" name="TGL_PENDATAAN" type="text" value="<?=$buku5['TGL_TERBIT_SPPT']?>">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                            </div>
                                        </td>
                                        <?php } ?>
                                </tr>
                            </table>
                          </div>

                          <table style="float:right;">
                            <tr>
                              <td>
                                <input type="submit" name="next" value="Next" class="btn btn-primary" >
                                <a href="penetapan.php" class="btn btn-default" >Batal</a>
                            </form>
                              </td>
                            </tr>
                          </table>

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
    <!-- jQuery -->
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

<script type="text/javascript" src="../../dist/datepicker/bootstrap/js/bootstrap.min.js"></script>
    <!-- /#wrapper -->
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
    <script>
        $(document).ready(function() {
            $("#kelurahan").change(function(){
                var KD_KECAMATAN = $("#kecamatan").val();
                var KD_KELURAHAN = $("#kelurahan").val();
                $("#imgLoad").show("");
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: "cari_blok.php",
                        data: {kecamatan:KD_KECAMATAN, kelurahan:KD_KELURAHAN},
                        success: function(msg){
                        if(msg == ''){
                            alert('Tidak ada kode blok pada kelurahan ini');
                        } else {
                            $("#blok").html(msg);                                                     
                        }
                            $("#imgLoad").hide();
                        }
                    });
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
   if ($_SESSION['ROLE']=="PEMBATALAN") {
     header("Location: ../pembatalan/index.php");
   } else {
     header("Location: ../../index.php");
   }
} ?>
