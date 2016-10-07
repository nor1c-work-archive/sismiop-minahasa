<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['edit']) || isset($_POST['edit'])) {
  $KD_PROPINSI = $_POST['KD_PROPINSI'];
  $KD_DATI2 = $_POST['KD_DATI2'];
  $THN_DBKB_STANDARD = $_POST['THN_DBKB_STANDARD'];
  $KD_JPB = $_POST['KD_JPB'];
  $TIPE_BNG = $_POST['TIPE_BNG'];
  $KD_BNG_LANTAI = $_POST['KD_BNG_LANTAI'];
  $NILAI_DBKB_STANDARD = $_POST['NILAI_DBKB_STANDARD'];

  $updq = "update DBKB_STANDARD SET NILAI_DBKB_STANDARD='$NILAI_DBKB_STANDARD' WHERE KD_PROPINSI='$KD_PROPINSI' and KD_DATI2='$KD_DATI2' THN_DBKB_STANDARD='$THN_DBKB_STANDARD' and KD_JPB='$KD_JPB' and TIPE_BNG='$TIPE_BNG' and KD_BNG_LANTAI='$KD_BNG_LANTAI'";
  if (mysqli_query($conn, $updq) or die(mysqli_error($conn))) {
    $_SESSION['notif'] = "Data DBKB Standard Berhasil Diupdate";
    header("Location: dbkb-standar.php");
  } else {
    $_SESSION['gagal'] = "Data DBKB Standard Gagal Diupdate";
    header("Location: dbkb-standar.php");
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
                    <h1 class="page-header">Edit Referensi Kondisi Bangunan</h1>
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
                            Home &gt; Referensi &gt; Referensi Kondisi Bangunan &gt; Edit Referensi Kondisi Bangunan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                <?php
                                  list($KD_PROPINSI, $KD_DATI2, $THN_DBKB_STANDARD, $KD_JPB, $TIPE_BNG, $KD_BNG_LANTAI) = explode(".", $_GET['refid']);

                                  $se = "select * from DBKB_STANDARD where KD_PROPINSI = '".$KD_PROPINSI."' and KD_DATI2='".$KD_DATI2."' and THN_DBKB_STANDARD='".$THN_DBKB_STANDARD."' and KD_JPB='$KD_JPB' and TIPE_BNG='$TIPE_BNG' and KD_BNG_LANTAI='$KD_BNG_LANTAI'";
                                  $sec = mysqli_query($conn, $se);
                                  while ($data = mysqli_fetch_assoc($sec)) { ?>
                                      <div class="table-responsive">
                                      <table class="table table-bordered">
                                      <tr>
                                        <td>
                                          Kode Propinsi
                                        </td>
                                        <td>
                                          <input type="text" name="KD_PROPINSI" value="<?=$data['KD_PROPINSI']?>" style="width:40%;" class="form-control" readonly="true">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode Dati II
                                        </td>
                                        <td>
                                          <input type="text" name="KD_DATI2" value="<?=$data['KD_DATI2']?>" size="40" style="width:40%;" class="form-control" readonly>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Tahun DBKB Standar
                                        </td>
                                        <td>
                                          <input type="text" name="THN_DBKB_STANDARD" value="<?=$data['THN_DBKB_STANDARD']?>" size="40" style="width:40%;" class="form-control" readonly>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Jenis Bangunan
                                        </td>
                                        <td>
                                            <?php $sql = "select * from JPB_JPT where KD_JPB_JPT='".$KD_JPB."'"; $sqla = mysqli_query($conn, $sql); while ($dat_pek = mysqli_fetch_assoc($sqla)) { ?>
                                              <input type="text" name="KD_JPB" value="<?=$dat_pek['KD_JPB_JPT']?>" class="form-control" readonly>
                                            <?php } ?>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kegiatan
                                        </td>
                                        <td>
                                            <?php $sql = "select * from TIPE_BANGUNAN where TIPE_BNG='".$TIPE_BNG."'"; $sqla = mysqli_query($conn, $sql); while ($dat_pek = mysqli_fetch_assoc($sqla)) { ?>
                                              <input type="text" name="TIPE_BNG" value="<?=$dat_pek['TIPE_BNG']?>" class="form-control" readonly>
                                            <?php } ?>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode Bangunan Lantai
                                        </td>
                                        <td>
                                          <input type="text" name="KD_BNG_LANTAI" value="<?=$data['KD_BNG_LANTAI']?>" size="40" class="form-control" readonly>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Nilai DBKB Standar
                                        </td>
                                        <td>
                                          <input type="text" name="NILAI_DBKB_STANDARD" value="<?=$data['NILAI_DBKB_STANDARD']?>" size="40" class="form-control">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>

                                        </td>
                                        <td>
                                          <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                                          <a href="dbkb-standar.php" class="btn btn-default">Batal</a>
                                        </td>
                                      </tr>
                                    </table>
                                  </div>
                                  <?php }
                                ?>
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
        $(document).ready(function() {
            $("#pekerjaan").change(function(){
            var KD_PEKERJAAN = $("#pekerjaan").val();
            $("#imgLoad").show("");
            $.ajax({
                type: "POST",
                dataType: "html",
                url: "pekerjaan_kegiatan.php",
                data: "pekerjaan="+KD_PEKERJAAN,
                success: function(msg){
                    $("#kegiatan").html(msg);
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
