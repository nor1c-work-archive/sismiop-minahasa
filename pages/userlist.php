<?php
session_start();//session starts here
include '../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
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
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
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
                            Home &gt; User Management &gt; User List
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div>
                            <?php if (isset($_SESSION['gagal'])) { ?>
                              <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Error!</strong> <?php echo $_SESSION['gagal']; unset($_SESSION['gagal']); ?>
                              </div>
                            <?php } ?>
                            <?php if (isset($_SESSION['notif'])) { ?>
                              <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>Success!</strong> <?php echo $_SESSION['notif']; unset($_SESSION['notif']); ?>
                              </div>
                            <?php } ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>User Login</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $no = 1;
                                        $user = "SELECT * FROM dat_login WHERE ROLE!='LOKET'";
                                        $userc = mysqli_query($conn, $user);
                                        while ($data = mysqli_fetch_assoc($userc)) {
                                        ?>
                                        <tr>
                                          <td><?=$no++?></td>
                                          <td><?=$data['NM_LOGIN']?></td>
                                          <td><?=$data['ROLE']?></td>
                                          <td>
                                            <?php 
                                            if ($data['ID']==$_SESSION['ID']) { ?>
                                              Akun sedang digunakan, <a href="myaccount.php">My Account</a>
                                            <?php } else { ?>
                                              <a href="useredit.php?userid=<?=$data['ID']?>">Edit</a>
                                              |
                                              <a href="deleteuser.php?userid=<?=$data['ID']?>">Delete</a>
                                              <?php 
                                              if ($data['STATUS']=="AKTIF") { ?>
                                              | <a href="usernonaktif.php?userid=<?=$data['ID']?>" style="color:red;">Nonaktifkan Akun</a>
                                              <?php } else { ?>
                                              | <a href="useraktif.php?userid=<?=$data['ID']?>" style="color:green">Aktifkan Akun</a>
                                              <?php } ?>
                                            <?php } ?>
                                          </td>
                                        </tr>
                                        <?php }
                                      ?>
                                    </tbody>
                                   </table>

                                   User Loket
                                   <table class="table table-striped table-bordered table-hover">
                                       <thead>
                                           <tr>
                                               <th>No</th>
                                               <th>User Login</th>
                                               <th>NIP</th>
                                               <th>Kode Kanwil</th>
                                               <th>Kode KPPBB</th>
                                               <th>Kode Bank Tunggal</th>
                                               <th>Kode Bank Persepsi</th>
                                               <th>Kode TP</th>
                                               <th>Role</th>
                                               <th>Action</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                         <?php
                                           $no = 1;
                                           $user = "SELECT * FROM dat_login WHERE ROLE='LOKET'";
                                           $userc = mysqli_query($conn, $user);
                                           while ($data = mysqli_fetch_assoc($userc)) {
                                           ?>
                                           <tr>
                                             <td><?=$no++?></td>
                                             <td><?=$data['NM_LOGIN']?></td>
                                             <td><?=$data['NIP']?></td>
                                             <td><?=$data['KD_KANWIL']?></td>
                                             <td><?=$data['KD_KPPBB']?></td>
                                             <td><?=$data['KD_BANK_TUNGGAL']?></td>
                                             <td><?=$data['KD_BANK_PERSEPSI']?></td>
                                             <td><?=$data['KD_TP']?></td>
                                             <td><?=$data['ROLE']?></td>
                                             <td>
                                               <a href="useredit.php?userid=<?=$data['ID']?>">Edit</a>
                                               |
                                               <a href="deleteuser.php?userid=<?=$data['ID']?>">Delete</a>
                                               <?php 
                                               if ($data['STATUS']=="AKTIF") { ?>
                                                | <a href="usernonaktif.php?userid=<?=$data['ID']?>" style="color:red;">Nonaktifkan Akun</a>
                                               <?php } else { ?>
                                                | <a href="useraktif.php?userid=<?=$data['ID']?>" style="color:green">Aktifkan Akun</a>
                                               <?php } ?>
                                             </td>
                                           </tr>
                                           <?php }
                                         ?>
                                       </tbody>
                                      </table>
                                <br>
                                <a class="btn btn-primary" href="tambah-user.php">Tambah User</a>
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
  echo "You don't have access to this page.";
} ?>