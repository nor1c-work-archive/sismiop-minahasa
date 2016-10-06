<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
// 1. Get $hal from url
    if (isset($_POST['filter']) || isset($_GEt['filter'])) {
        $KD_KECAMATAN = $_POST['kecamatan'];
        $KD_KELURAHAN = $_POST['kelurahan'];
    }

    if (isset($_POST['tambah'])) {
        $KD_KECAMATAN = $_POST['KD_KECAMATAN'];
        $KD_KELURAHAN = $_POST['KD_KELURAHAN'];
        $KD_ZNT      = $_POST['KD_ZNT'];

        $sql = "INSERT INTO DAT_ZNT SET KD_PROPINSI='71', KD_DATI2='03', KD_KECAMATAN='$KD_KECAMATAN', KD_KELURAHAN='$KD_KELURAHAN', KD_ZNT='$KD_ZNT'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['notif'] = "Kode ZNT Berhasil Ditambahkan";
        } else {
          $_SESSION['notif'] = "Kode ZNT Gagal Ditambahkan";
        }
    }

    if (isset($_POST['hapus'])) {
        $KD_KECAMATAN = $_POST['KD_KECAMATAN'];
        $KD_KELURAHAN = $_POST['KD_KELURAHAN'];
        $KD_ZNT      = $_POST['KD_ZNT'];

        $sql = "DELETE FROM DAT_ZNT WHERE KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."' and KD_ZNT='".$KD_ZNT."'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['notif'] = "Kode ZNT Berhasil Dihapus";
        } else {
          $_SESSION['notif'] = "Kode ZNT Gagal Dihapus";
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
    <!-- <link href="../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom Fonts -->
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"> -->

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom Theme JavaScript -->
    <!-- // <script src="../../dist/js/sb-admin-2.js"></script> -->

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


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
                    <h1 class="page-header">Tempat Pembayaran</h1>
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
                            Home &gt; Referensi &gt; Tempat Pembayaran
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
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
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Kanwil</th>
                                            <th>Kode KPPBB</th>
                                            <th>Kode Bank Tunggal</th>
                                            <th>Kode Bank Persepsi</th>
                                            <th>Kode Tempat Pembayaran</th>
                                            <th>Nama Tempat Pembayaran</th>
                                            <th>Alamat Tempat Pembayaran</th>
                                            <th>No. Rek Tempat Pembayaran</th>
                                            <th>Action</th>
                                            <!-- <th></th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $no = 1;
                                        $user = "SELECT * FROM TEMPAT_PEMBAYARAN";
                                        $userc = mysqli_query($conn, $user);
                                        while ($data = mysqli_fetch_assoc($userc)) {
                                        ?>
                                        <tr>
                                          <td><?=$no++?></td>
                                          <td><?=$data['KD_KANWIL']?></td>
                                          <td><?=$data['KD_KPPBB']?></td>
                                          <td><?=$data['KD_BANK_TUNGGAL']?></td>
                                          <td><?=$data['KD_BANK_PERSEPSI']?></td>
                                          <td><?=$data['KD_TP']?></td>
                                          <td><?=$data['NM_TP']?></td>
                                          <td><?=$data['ALAMAT_TP']?></td>
                                          <td><?=$data['NO_REK_TP']?></td>
                                          <td>
                                            <a href="edit-tp.php?editref=<?=$data['KD_KANWIL'].'.'.$data['KD_KPPBB'].'.'.$data['KD_BANK_TUNGGAL'].'.'.$data['KD_BANK_PERSEPSI'].'.'.$data['KD_TP']?>">Edit</a> | 
                                            <a onclick="return confirm('Anda yakin ?')" href="delete-tp.php?deleteref=<?=$data['KD_KANWIL'].'.'.$data['KD_KPPBB'].'.'.$data['KD_BANK_TUNGGAL'].'.'.$data['KD_BANK_PERSEPSI'].'.'.$data['KD_TP'].'.'.$data['NM_TP'].'.'.$data['ALAMAT_TP'].'.'.$data['NO_REK_TP']?>">Delete</a>
                                          </td>
                                          <!-- <td>
                                            <a href="edit-kelastanah.php?refid=<?=$data['KD_KLS_TANAH']?>">Edit</a>
                                          </td> -->
                                        </tr>
                                        <?php }
                                      ?>
                                    </tbody>
                                   </table>
                                <a href="tambah-tp.php" class="btn btn-primary">Tambah Tempat Pembayaran</a>
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
                    if(msg == ''){
                        alert('Tidak ada data Kelurahan');
                    }
                    else{
                        $("#kelurahan").html(msg);                                                     
                    }
                    $("#imgLoad").hide();
                }
            });    
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $("#kecamatan").change(function(){
            var KD_KECAMATAN = $("#kecamatan").val();
                $("#kelurahan").change(function(){
                var KD_KELURAHAN = $("#kelurahan").val();
                $("#imgLoad").show("");
                    $.ajax({
                        type: "POST",
                        dataType: "html",
                        url: "cari_ZNT.php",
                        data: "kecamatan="+KD_KECAMATAN, "kelurahan="+KD_KELURAHAN,
                        success: function(msg){
                            if(msg == ''){
                                alert('Tidak ada data ZNT');
                            } else {
                                $("#kelurahan").html(msg);                                                     
                            }
                                $("#imgLoad").hide();
                            }
                    });
                });    
            });
        });
    </script>
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable( {
          "pagingType": "full_numbers",
          responsive: true
        } );
      } );
    </script>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
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
