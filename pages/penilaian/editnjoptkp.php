<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
  if (isset($_GET['refid']) || isset($_POST['refid'])) {
    $THN_AWAL = $_GET['refid'];
    if (isset($_POST['edit']) || isset($_GET['edit'])) {

      $THN_AWAL = $_POST['THN_AWAL'];
      $THN_AKHIR = $_POST['THN_AKHIR'];
      $NILAI_NJOPTKP = $_POST['NILAI_NJOPTKP'];

      $updq = "UPDATE NJOPTKP SET THN_AKHIR='$THN_AKHIR', NILAI_NJOPTKP='$NILAI_NJOPTKP' WHERE THN_AWAL='$THN_AWAL'";
      if (mysqli_query($conn, $updq)) {
        $_SESSION['notif'] = "NJOPTKP Berhasil Diupdate";
        header("Location: bukunjoptkptarif.php#2a");
      } else {
        $_SESSION['gagal'] = "NJOPTKP Gagal Diupdate";
        header("Location: bukunjoptkptarif.php#2a");
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
                    <h1 class="page-header">Edit Jalan Standar</h1>
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
                            Home &gt; Penilaian &gt; Buku/NJOPTKP/Tarif &gt; Update NJOPTKP
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div>
                            <div class="table-responsive">
                              <form class="" action="editnjoptkp.php?refid=<?=$THN_AWAL?>" method="post">
                                    <table class="table table-bordered">
                                      <?php
                                        $no = 1;

                                        $user = "SELECT * FROM NJOPTKP where THN_AWAL='".$THN_AWAL."'";
                                        $userc = mysqli_query($conn, $user);
                                        while ($data = mysqli_fetch_assoc($userc)) {
                                        ?>
                                        <tr>
                                          <td style="width:30%;">Kode Propinsi</td>
                                          <td style="width:50%;">
                                            <input type="text" name="KD_PROPINSI" value="<?=$data['KD_PROPINSI']?>" class="form-control" readonly>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Kode Dati II</td>
                                          <td style="width:50%;">
                                            <input type="text" name="KD_DATI2" value="<?=$data['KD_DATI2']?>" class="form-control" readonly>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Tahun Awal</td>
                                          <td style="width:50%;">
                                            <input type="text" name="THN_AWAL" value="<?=$data['THN_AWAL']?>" class="form-control" readonly>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Tahun Akhir</td>
                                          <td style="width:50%;">
                                            <input type="text" name="THN_AKHIR" value="<?=$data['THN_AKHIR']?>" class="form-control">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Nilai NJOPTKP</td>
                                          <td style="width:50%;">
                                            <input type="text" name="NILAI_NJOPTKP" value="<?=$data['NILAI_NJOPTKP']?>" class="form-control">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td>

                                          </td>
                                          <td>
                                            <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                                            <a href="bukunjoptkptarif.php" class="btn btn-default">Batal</a>
                                          </td>
                                        </tr>
                                        <?php }
                                      ?>
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
        if ($("#nop").is(":selected")) {
          $("#nops").show();
          $("#nmwps").hide();
          $("#jlnops").hide();
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
  echo "Tidak ada Proses";
} } else {
  echo "You don't have access to this page.";
} ?>
