<?php
session_start();//session starts here
include '../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['edit']) || isset($_POST['edit'])) {
  $IDL = $_POST['id'];
  $USERNAME = $_POST['NM_LOGIN'];
  $PASSWORD = md5($_POST['PASSWORD']);
  $MAC_ADDRESS = $_POST['MAC_ADDRESS'];
  $COMPUTER_NAME = $_POST['COMPUTER_NAME'];
  $NIP = $_POST['NIP'];
  $KD_KANWIL = $_POST['KD_KANWIL'];
  $KD_KPPBB = $_POST['KD_KPPBB'];
  $KD_BANK_TUNGGAL = $_POST['KD_BANK_TUNGGAL'];
  $KD_BANK_PERSEPSI = $_POST['KD_BANK_PERSEPSI'];
  $KD_TP = $_POST['KD_TP'];
  $ROLE = $_POST['ROLE'];

  $updq = "update DAT_LOGIN SET NM_LOGIN='$USERNAME', PASSWORD='$PASSWORD', MAC_ADDRESS='$MAC_ADDRESS', COMPUTER_NAME='$COMPUTER_NAME', NIP='$NIP', KD_KANWIL='$KD_KANWIL', KD_KPPBB='$KD_KPPBB', KD_BANK_TUNGGAL='$KD_BANK_TUNGGAL', KD_BANK_PERSEPSI='$KD_BANK_PERSEPSI', KD_TP='$KD_TP', ROLE='$ROLE' WHERE ID='$IDL'";
  if (mysqli_query($conn, $updq)) {
    header("Location: userlist.php");
  } else {
    echo mysqli_error($conn);
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

    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <!-- <link href="../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>

<body>

    <div id="wrapper">

        <?php include 'header.php';?>
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
                            <?php include 'menu.php';?>
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
                    <h1 class="page-header">Daftar User</h1>
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
                            Home &gt; User Management &gt; Edit User
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                <?php
                                  $id = $_GET['userid'];

                                  $se = "select * from dat_login where ID = '".$id."'";
                                  $sec = mysqli_query($conn, $se);
                                  while ($data = mysqli_fetch_assoc($sec)) { ?>
                                      <div class="table-responsive">
                                      <table class="table table-bordered">
                                        <input type="hidden" name="id" value="<?=$id;?>">
                                      <tr>
                                        <td>
                                          Username
                                        </td>
                                        <td>
                                          <input type="text" name="NM_LOGIN" value="<?=$data['NM_LOGIN']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Password
                                        </td>
                                        <td>
                                          <input type="password" name="PASSWORD" value="" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          MAC ADDRESS
                                        </td>
                                        <td>
                                          <input type="text" name="MAC_ADDRESS" value="<?=$data['MAC_ADDRESS']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          COMPUTER NAME
                                        </td>
                                        <td>
                                          <input type="text" name="COMPUTER_NAME" value="<?=$data['COMPUTER_NAME']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          NIP
                                        </td>
                                        <td>
                                          <input type="text" name="NIP" value="<?=$data['NIP']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                        </td>
                                      </tr>

                                      <?php

                                      if ($data['ROLE']=="LOKET" || $data['ROLE']=="PEMBATALAN") {
                                        ?>
                                        <tr>
                                        <td>
                                          Kode Kanwil
                                        </td>
                                        <td>
                                          <input type="text" name="KD_KANWIL" value="<?=$data['KD_KANWIL']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode KPPBB Bank
                                        </td>
                                        <td>
                                          <input type="text" name="KD_KPPBB" value="<?=$data['KD_KPPBB']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode Bank Tunggal
                                        </td>
                                        <td>
                                          <input type="text" name="KD_BANK_TUNGGAL" value="<?=$data['KD_BANK_TUNGGAL']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode Bank Persepsi
                                        </td>
                                        <td>
                                          <input type="text" name="KD_BANK_PERSEPSI" value="<?=$data['KD_BANK_PERSEPSI']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>
                                          Kode Tempat Pembayaran
                                        </td>
                                        <td>
                                          <input type="text" name="KD_TP" value="<?=$data['KD_TP']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                        </td>
                                      </tr>

                                        <?php
                                      } else { ?>
                                          <input type="hidden" name="KD_KANWIL" value="<?=$data['KD_KANWIL']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                          <input type="hidden" name="KD_KPPBB" value="<?=$data['KD_KPPBB']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                          <input type="hidden" name="KD_BANK_TUNGGAL" value="<?=$data['KD_BANK_TUNGGAL']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                          <input type="hidden" name="KD_BANK_PERSEPSI" value="<?=$data['KD_BANK_PERSEPSI']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                          <input type="hidden" name="KD_TP" value="<?=$data['KD_TP']?>" size="40" style="padding:5px;border-radius:4px;border:solid 1px #ccc;">
                                      <?php } ?>

                                      <tr>
                                        <td>
                                          Role
                                        </td>
                                        <td>
                                          <select name="ROLE" class="form-control" style="width:60%;">
                                            <option hidden readonly="true" selected=""><?=$data['ROLE']?></option>
                                            <option value="ADMINISTRATOR">ADMINISTRATOR</option>
                                            <option value="LOKET">LOKET</option>
                                            <option value="PEMBATALAN">PEMBATALAN</option>
                                          </select>
                                        </td>
                                      </tr>

                                      <tr>
                                        <td>

                                        </td>
                                        <td>
                                          <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                                          <a href="userlist.php" class="btn btn-default">Batal</a>
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
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

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
