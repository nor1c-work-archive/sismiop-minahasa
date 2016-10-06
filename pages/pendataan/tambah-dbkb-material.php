<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {

  if (isset($_POST['simpan'])) {
    $KD_PROPINSI = $_POST['KD_PROPINSI'];
    $KD_DATI2 = $_POST['KD_DATI2'];
    $THN_DBKB_MATERIAL = $_POST['THN_DBKB_MATERIAL'];
    $KD_PEKERJAAN = $_POST['KD_PEKERJAAN'];
    $KD_KEGIATAN = $_POST['KD_KEGIATAN'];
    $NILAI_DBKB_MATERIAL = $_POST['NILAI_DBKB_MATERIAL'];

    $insert = "INSERT INTO DBKB_MATERIAL SET KD_PROPINSI='$KD_PROPINSI', KD_DATI2='$KD_DATI2', THN_DBKB_MATERIAL='$THN_DBKB_MATERIAL', KD_PEKERJAAN='$KD_PEKERJAAN', KD_KEGIATAN='$KD_KEGIATAN', NILAI_DBKB_MATERIAL='$NILAI_DBKB_MATERIAL'";
    if (mysqli_query($conn, $insert) or die (mysqli_error($conn))) {
      $_SESSION['notif'] = "Data DBKB Material Berhasil Disimpan";
      header("Location: dbkb-material.php");
    } else {
      $_SESSION['gagal'] = "Data DBKB Material Gagal Disimpan";
      header("Location: dbkb-material.php");
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
                    <h1 class="page-header">DBKB Material</h1>
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
                            Home &gt; Referensi &gt; DBKB Material &gt; Tambah DBKB Material
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div>
                            <div class="table-responsive">
                              <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                    <table class="table table-bordered">
                                        <tr>
                                          <td style="width:30%;">Kode Propinsi</td>
                                          <td style="width:50%;">
                                            <input type="text" placeholder="Kode Propinsi" name="KD_PROPINSI" size="50" class="form-control" readonly value="71">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Kode Dati II</td>
                                          <td style="width:50%;">
                                            <input type="text" placeholder="Kode Dati II" name="KD_DATI2" size="50" class="form-control" readonly value="03">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Tahun DBKB Material</td>
                                          <td style="width:50%;">
                                            <input type="text" placeholder="Tahun DBKB Material" name="THN_DBKB_MATERIAL" value="" size="50" class="form-control" required>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Kode Pekerjaan</td>
                                          <td style="width:50%;">
                                            <input type="text" placeholder="Kode Pekerjaan" name="KD_PEKERJAAN" value="" size="50" class="form-control" required>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Kode Kegiatan</td>
                                          <td style="width:50%;">
                                            <input type="text" placeholder="Kode Kegiatan" name="KD_KEGIATAN" value="" size="50" class="form-control" required>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Nilai DBKB</td>
                                          <td style="width:50%;">
                                            <input type="text" placeholder="Nilai DBKB" name="NILAI_DBKB_MATERIAL" value="" size="50" class="form-control" required>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>
                                          </td>
                                          <td>
                                            <input type="submit" class="btn btn-primary" name="simpan" value="Simpan">
                                            <a onclick="history.go(-1);" class="btn btn-default">Batal</a>
                                          </td>
                                        </tr>
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
  echo "You don't have access to this page.";
} ?>
