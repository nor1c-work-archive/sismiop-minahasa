<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['edit']) || isset($_POST['edit'])) {
  $KD_JABATAN             = $_POST['KD_JABATAN'];
  $NM_JABATAN             = $_POST['NM_JABATAN'];
  $SINGKATAN_JABATAN      = $_POST['SINGKATAN_JABATAN'];

  $updq = "UPDATE REF_JABATAN SET NM_JABATAN='$NM_JABATAN', SINGKATAN_JABATAN='$SINGKATAN_JABATAN' WHERE KD_JABATAN='$KD_JABATAN'";
  if (mysqli_query($conn, $updq)) {
    $_SESSION['notif'] = "Data jabatan Berhasil Diupdate";
    header("Location: jabatan.php");
  } else {
    $_SESSION['gagal'] = "Data jabatan Gagal Diupdate";
    header("Location: jabatan.php");
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
        } else if ($("#jlnop").is(":selected")) {
          $("#nops").hide();
          $("#nmwps").hide();
          $("#jlnops").show();
        } else {
          $("#nops").hide();
          $("#nmwps").hide();
          $("#jlnops").hide();
        }
      }).trigger('change');
      });
    </script>
    <script type="text/javascript">
      $(function() {
      $("#graph_select2").change(function() {
        if ($("#nop2").is(":selected")) {
          $("#nops2").show();
          $("#nmwps2").hide();
          $("#jlnops2").hide();
        } else if ($("#nmwp2").is(":selected")) {
          $("#nops2").hide();
          $("#nmwps2").show();
          $("#jlnops2").hide();
        } else if ($("#jlnop2").is(":selected")) {
          $("#nops2").hide();
          $("#nmwps2").hide();
          $("#jlnops2").show();
        } else {
          $("#nops2").hide();
          $("#nmwps2").hide();
          $("#jlnops2").hide();
        }
      }).trigger('change');
      });
    </script>

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
                    <h1 class="page-header">Edit Data Seksi</h1>
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
                            Home &gt; Referensi &gt; Kepegawaian &gt; Seksi &gt; Edit Data Seksi
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                <?php
                                  list($KD_JABATAN, $NM_JABATAN, $SINGKATAN_JABATAN) = explode(".", $_GET['refid']);

                                  $se = "select * from REF_JABATAN where KD_JABATAN = '".$KD_JABATAN."' and NM_JABATAN='".$NM_JABATAN."' AND SINGKATAN_JABATAN='".$SINGKATAN_JABATAN."'";
                                  $sec = mysqli_query($conn, $se);
                                  while ($data = mysqli_fetch_assoc($sec)) { ?>
                                      <div class="table-responsive">
                                      <table class="table table-bordered">
                                      <tr>
                                        <td>
                                          Kode Jabatan
                                        </td>
                                        <td>
                                          <input type="text" name="KD_JABATAN" value="<?=$data['KD_JABATAN']?>" style="width:40%;" class="form-control" readonly="true">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Nama Jabatan
                                        </td>
                                        <td>
                                          <input type="text" name="NM_JABATAN" value="<?=$data['NM_JABATAN']?>"  class="form-control">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Singkatan Jabatan
                                        </td>
                                        <td>
                                          <input type="text" name="SINGKATAN_JABATAN" value="<?=$data['SINGKATAN_JABATAN']?>" class="form-control">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>

                                        </td>
                                        <td>
                                          <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                                          <a href="jabatan.php" class="btn btn-default">Batal</a>
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
