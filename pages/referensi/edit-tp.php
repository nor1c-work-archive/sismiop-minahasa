<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['edit']) || isset($_POST['edit'])) {
  $KD_KANWIL = $_POST['KD_KANWIL'];
  $KD_KPPBB = $_POST['KD_KPPBB'];
  $KD_BANK_TUNGGAL = $_POST['KD_BANK_TUNGGAL'];
  $KD_BANK_PERSEPSI = $_POST['KD_BANK_PERSEPSI'];
  $KD_TP = $_POST['KD_TP'];
  $NM_TP = $_POST['NM_TP'];
  $ALAMAT_TP = $_POST['ALAMAT_TP'];
  $NO_REK_TP = $_POST['NO_REK_TP'];

  $updq = "update TEMPAT_PEMBAYARAN SET KD_KANWIL='$KD_KANWIL',
                                    KD_KPPBB='$KD_KPPBB',
                                    KD_BANK_TUNGGAL='$KD_BANK_TUNGGAL',
                                    KD_BANK_PERSEPSI='$KD_BANK_PERSEPSI',
                                    KD_TP='$KD_TP',
                                    NM_TP='$NM_TP',
                                    ALAMAT_TP='$ALAMAT_TP',
                                    NO_REK_TP='$NO_REK_TP'
                                    WHERE KD_KANWIL=$KD_KANWIL AND KD_KPPBB=$KD_KPPBB AND KD_BANK_TUNGGAL=$KD_BANK_TUNGGAL AND KD_BANK_PERSEPSI=$KD_BANK_PERSEPSI AND KD_TP=$KD_TP";
  if (mysqli_query($conn, $updq)) {
    $_SESSION['notif'] = "Data Berhasil Diubah";
    header("Location: tempatpembayaran.php");
  } else {
    $_SESSION['gagal'] = "Data Gagal Diubah";
    header("Location: tempatpembayaran.php");
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
                    <h1 class="page-header">Edit Referensi Kelurahan</h1>
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
                            Home &gt; Persiapan &gt; Referensi Kelurahan &gt; Edit Referensi Kelurahan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                <?php
                                  list($KD_KANWIL, $KD_KPPBB, $KD_BANK_TUNGGAL, $KD_BANK_PERSEPSI, $KD_TP) = explode(".", $_GET['editref']);

                                  $se = "select * from TEMPAT_PEMBAYARAN where KD_KANWIL = '".$KD_KANWIL."' and KD_KPPBB='".$KD_KPPBB."' and KD_BANK_TUNGGAL='".$KD_BANK_TUNGGAL."' and KD_BANK_PERSEPSI='".$KD_BANK_PERSEPSI."' and KD_TP='".$KD_TP."'";
                                  $sec = mysqli_query($conn, $se);
                                  while ($data = mysqli_fetch_assoc($sec)) { ?>
                                      <div class="table-responsive">
                                      <table class="table table-bordered">
                                      <tr>
                                        <td>
                                          Kode Kanwil
                                        </td>
                                        <td>
                                          <input type="text" name="KD_KANWIL" value="<?=$data['KD_KANWIL']?>" style="width:60%;" class="form-control" readonly="true" readonly="true">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode KPPBB
                                        </td>
                                        <td>
                                          <input type="text" name="KD_KPPBB" value="<?=$data['KD_KPPBB']?>" style="width:60%;" class="form-control" readonly="true" readonly="true">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode Bank Tunggal
                                        </td>
                                        <td>
                                          <input type="text" name="KD_BANK_TUNGGAL" value="<?=$data['KD_BANK_TUNGGAL']?>" style="width:60%;" class="form-control" readonly="true" readonly="true">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode Bank Persepsi
                                        </td>
                                        <td>
                                          <input type="text" name="KD_BANK_PERSEPSI" value="<?=$data['KD_BANK_PERSEPSI']?>" style="width:60%;" class="form-control" readonly="true" readonly="true">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode Tempat Pembayaran
                                        </td>
                                        <td>
                                          <input type="text" name="KD_TP" value="<?=$data['KD_TP']?>" style="width:60%;" class="form-control" readonly="true">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Nama Tempat Pembayaran
                                        </td>
                                        <td>
                                          <input type="text" name="NM_TP" value="<?=$data['NM_TP']?>" style="width:60%;" class="form-control">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Alamat Tempat Pembayaran
                                        </td>
                                        <td>
                                          <input type="text" name="ALAMAT_TP" value="<?=$data['ALAMAT_TP']?>" style="width:60%;" class="form-control">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Nomor Rekening Tempat Pembayaran
                                        </td>
                                        <td>
                                          <input type="text" name="NO_REK_TP" value="<?=$data['NO_REK_TP']?>" style="width:60%;" class="form-control">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>

                                        </td>
                                        <td>
                                          <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                                          <a href="tempatpembayaran.php" class="btn btn-default">Batal</a>
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
