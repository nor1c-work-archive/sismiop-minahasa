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
        $KD_BLOK      = $_POST['KD_BLOK'];

        $sql = "INSERT INTO DAT_PETA_BLOK SET KD_PROPINSI='71', KD_DATI2='03', KD_KECAMATAN='$KD_KECAMATAN', KD_KELURAHAN='$KD_KELURAHAN', KD_BLOK='$KD_BLOK', STATUS_PETA_BLOK='0'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['notif'] = "Kode Blok Berhasil Ditambahkan";
        } else {
          $_SESSION['notif'] = "Kode Blok Gagal Ditambahkan";
        }
    }

    if (isset($_POST['hapus'])) {
        $KD_KECAMATAN = $_POST['KD_KECAMATAN'];
        $KD_KELURAHAN = $_POST['KD_KELURAHAN'];
        $KD_BLOK      = $_POST['KD_BLOK'];

        $sql = "DELETE FROM DAT_PETA_BLOK WHERE KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."' and KD_BLOK='".$KD_BLOK."'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['notif'] = "Kode Blok Berhasil Dihapus";
        } else {
          $_SESSION['notif'] = "Kode Blok Gagal Dihapus";
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
                    <h1 class="page-header">Rekam Data NIR setiap ZNT</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Home &gt; Persiapan &gt; Rekam Data NIR setiap ZNT
                        </div>
                        <!-- /.panel-heading -->
                        <?php 
                        if (isset($_POST['filter']) || isset($_GET['filter']) || isset($_POST['tambah']) || isset($_GET['tambah']) || isset($_POST['hapus']) || isset($_GET['hapus'])) { ?>
                            <div class="panel-body">
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <table>
                                <tr>
                                    <td style="width:45%;padding-right:5px;">
                                        <select id="kecamatan" name="kecamatan" class="form-control">
                                        <?php $sql = "select * from ref_kecamatan";
                                        $sqlq = mysqli_query($conn, $sql);
                                        while ($sqlr = mysqli_fetch_assoc($sqlq)) { ?>
                                            <option value="<?=$sqlr['KD_KECAMATAN']?>"><?=$sqlr['KD_KECAMATAN']?> - <?=$sqlr['NM_KECAMATAN']?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                    <td style="width:45%;padding-right:5px;">
                                        <select id="kelurahan" name="kelurahan" class="form-control">
                                            <?php $sql = "select * from ref_kelurahan where KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."'";
                                            $sqlq = mysqli_query($conn, $sql);
                                            while ($data = mysqli_fetch_assoc($sqlq)) { ?>
                                                <option selected=""><?=$KD_KELURAHAN?> - <?=$data['NM_KELURAHAN']?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" name="filter" value="Filter" class="btn btn-primary">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br>
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <table>
                                <tr>
                                    <input type="hidden" name="KD_KECAMATAN" value="<?=$KD_KECAMATAN?>">
                                    <input type="hidden" name="KD_KELURAHAN" value="<?=$KD_KELURAHAN?>">
                                    <td><input type="text" name="KD_BLOK" placeholder="Kode Blok" class="form-control"></td>
                                    <td><input type="submit" name="tambah" value="Tambah" class="btn btn-primary"></td>
                                </tr>
                            </table>
                        </form>
                        <br>
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
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="40">No</th>
                                            <th>Tahun</th>
                                            <th>Nomor Dokumen</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $no = 1;
                                        $user = "SELECT * FROM DAT_NIR where KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."'";
                                        $userc = mysqli_query($conn, $user);
                                        while ($data = mysqli_fetch_assoc($userc)) {
                                        ?>
                                        <tr>
                                          <td><?=$no++?></td>
                                          <td><?=$data['THN_NIR_ZNT']?></td>
                                          <td><?=$data['NO_DOKUMEN']?></td>
                                          <td>
                                            <!-- <a onclick="return confirm('Are you sure ?')" class="btn btn-primary" href="run-printsspd3r.php?print=<?=$data['KD_KECAMATAN'].''.$data['KD_KELURAHAN']?>">Print</a> -->
                                            <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                              <input type="hidden" name="KD_KECAMATAN" value="<?=$data['KD_KECAMATAN']?>">
                                              <input type="hidden" name="KD_KELURAHAN" value="<?=$data['KD_KELURAHAN']?>">
                                              <input class="btn btn-primary" type="submit" name="hapus" value="Hapus">
                                            </form>
                                          </td>
                                        </tr>
                                        <?php }
                                      ?>
                                    </tbody>
                                   </table>
                            </div>
                          </div>
                            <!-- /.table-responsive -->
                        </div>
                        <?php } else { ?>
                        <div class="panel-body">
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <table>
                                <tr>
                                    <td style="width:45%;padding-right:5px;">
                                        <select id="kecamatan" name="kecamatan" class="form-control">
                                            <option selected hidden readonly="true">PILIH KECAMATAN</option>
                                        <?php $sql = "select * from ref_kecamatan";
                                        $sqlq = mysqli_query($conn, $sql);
                                        while ($sqlr = mysqli_fetch_assoc($sqlq)) { ?>
                                            <option value="<?=$sqlr['KD_KECAMATAN']?>"><?=$sqlr['KD_KECAMATAN']?> - <?=$sqlr['NM_KECAMATAN']?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                    <td style="width:45%;padding-right:5px;">
                                        <select id="kelurahan" name="kelurahan" class="form-control">
                                            <option selected hidden readonly="true">PILIH KELURAHAN</option>
                                            <!-- KEL -->
                                        </select>
                                    </td>
                                    <td>
                                        <input type="submit" name="filter" value="Filter" class="btn btn-primary">
                                    </td>
                                </tr>
                            </table>
                        </form>
                        <br>
                            <div>
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th width="40">No</th>
                                            <th>Kode Blok</th>
                                            <th>Status Peta</th>
                                            <th>Modify</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $no = 1;
                                        $user = "SELECT * FROM DAT_NIR";
                                        $userc = mysqli_query($conn, $user);
                                        while ($data = mysqli_fetch_assoc($userc)) {
                                        ?>
                                        <tr>
                                          <td><?=$no++?></td>
                                          <td><?=$data['THN_NIR_ZNT']?></td>
                                          <td><?=$data['NO_DOKUMEN']?></td>
                                          <td>
                                            <!-- <a onclick="return confirm('Are you sure ?')" class="btn btn-primary" href="run-printsspd3r.php?print=<?=$data['KD_KECAMATAN'].''.$data['KD_KELURAHAN']?>">Print</a> -->
                                            <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                              <input type="hidden" name="KD_KECAMATAN" value="<?=$data['KD_KECAMATAN']?>">
                                              <input type="hidden" name="KD_KELURAHAN" value="<?=$data['KD_KELURAHAN']?>">
                                              <input class="btn btn-primary" type="submit" name="hapusa" value="Hapus">
                                            </form>
                                          </td>
                                        </tr>
                                        <?php }
                                      ?>
                                    </tbody>
                                   </table>
                            </div>
                          </div>
                            <!-- /.table-responsive -->
                        </div>
                        <?php } ?>
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
                        url: "cari_blok.php",
                        data: "kecamatan="+KD_KECAMATAN, "kelurahan="+KD_KELURAHAN,
                        success: function(msg){
                            if(msg == ''){
                                alert('Tidak ada data Blok');
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
