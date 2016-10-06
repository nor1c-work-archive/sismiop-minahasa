<?php
error_reporting(0);
session_start();
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {

    if (isset($_POST['filter']) || isset($_GET['filter'])) {
        $KD_KECAMATAN = $_POST['kecamatan'];
        $KD_KELURAHAN = $_POST['kelurahan'];
        $KD_BLOK = $_POST['blok'];
    }

    if (isset($_POST['tambah'])) {
        $KD_KECAMATAN = $_POST['KD_KECAMATAN'];
        $KD_KELURAHAN = $_POST['KD_KELURAHAN'];
        $KD_BLOK      = $_POST['KD_BLOK'];
        $KD_ZNT       = $_POST['KD_ZNT'];

        $sql = "INSERT INTO DAT_PETA_ZNT SET KD_PROPINSI='71', KD_DATI2='03', KD_KECAMATAN='$KD_KECAMATAN', KD_KELURAHAN='$KD_KELURAHAN', KD_BLOK='$KD_BLOK', KD_ZNT='$KD_ZNT'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['notif'] = "Kode ZNT Berhasil Ditambahkan";
        } else {
          $_SESSION['gagal'] = "Kode ZNT Gagal Ditambahkan";
        }
    }

    if (isset($_POST['hapus'])) {
        $KD_KECAMATAN = $_POST['KD_KECAMATAN'];
        $KD_KELURAHAN = $_POST['KD_KELURAHAN'];
        $KD_BLOK      = $_POST['KD_BLOK'];
        $KD_ZNT       = $_POST['KD_ZNT'];

        $sql = "DELETE FROM DAT_PETA_ZNT WHERE KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."' and KD_BLOK='".$KD_BLOK."' and KD_ZNT='".$KD_ZNT."'";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['notif'] = "Kode ZNT Berhasil Dihapus";
        } else {
          $_SESSION['gagal'] = "Kode ZNT Gagal Dihapus";
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
    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>
    <div id="wrapper">
      <?php include("../header2.php") ?>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <?php include '../menu.php';?>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Pemetaan ZNT Pada Blok</h1>
                </div>
            </div>
            <div class="row">
            </div>
            <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Home &gt; Persiapan &gt; Pemetaan ZNT Pada Blok
                        </div>
                        <?php 
                        if (isset($_POST['filter']) || isset($_GET['filter']) || isset($_POST['tambah']) || isset($_GET['tambah']) || isset($_POST['hapus']) || isset($_GET['hapus'])) { ?>
                            <div class="panel-body">
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <table>
                                <tr>
                                    <td style="width:30%;padding-right:5px;">
                                        <select id="kecamatan" name="kecamatan" class="form-control">
                                        <?php $sql = "select * from ref_kecamatan where KD_KECAMATAN='".$KD_KECAMATAN."'";
                                        $sqlq = mysqli_query($conn, $sql);
                                        while ($sqlr = mysqli_fetch_assoc($sqlq)) { ?>
                                            <option selected disable hidden readonly value="<?=$sqlr['KD_KECAMATAN']?>"><?=$sqlr['KD_KECAMATAN']?> - <?=$sqlr['NM_KECAMATAN']?></option>
                                        <?php } ?>

                                        <?php $sql = "select * from ref_kecamatan";
                                        $sqlq = mysqli_query($conn, $sql);
                                        while ($sqlr = mysqli_fetch_assoc($sqlq)) { ?>
                                            <option value="<?=$sqlr['KD_KECAMATAN']?>"><?=$sqlr['KD_KECAMATAN']?> - <?=$sqlr['NM_KECAMATAN']?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                    <td style="width:30%;padding-right:5px;">
                                        <select id="kelurahan" name="kelurahan" class="form-control">
                                            <?php $sql = "select * from ref_kelurahan where KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."'";
                                            $sqlq = mysqli_query($conn, $sql);
                                            while ($sqlr = mysqli_fetch_assoc($sqlq)) { ?>
                                                <option selected hidden disabled readonly value="<?=$sqlr['KD_KELURAHAN']?>"><?=$sqlr['KD_KELURAHAN']?> - <?=$sqlr['NM_KELURAHAN']?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td style="width:30%;padding-right:5px;">
                                        <select id="blok" name="blok" class="form-control">
                                            <?php $sql = "select * from DAT_PETA_ZNT where KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."' and KD_BLOK='".$KD_BLOK."'";
                                            $sqlq = mysqli_query($conn, $sql);
                                            while ($sqlr = mysqli_fetch_assoc($sqlq)) { ?>
                                                <option selected hidden disabled readonly value="<?=$sqlr['KD_BLOK']?>"><?=$sqlr['KD_BLOK']?></option>
                                            <?php } ?>

                                            <?php $sql = "select DISTINCT(KD_BLOK) as KD_BLOK from DAT_PETA_ZNT where KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."'";
                                            $sqlq = mysqli_query($conn, $sql);
                                            while ($sqlr = mysqli_fetch_assoc($sqlq)) { ?>
                                                <option value="<?=$sqlr['KD_BLOK']?>"><?=$sqlr['KD_BLOK']?></option>
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
                                    <input type="hidden" name="KD_BLOK" value="<?=$KD_BLOK?>">
                                    <td><input type="text" name="KD_ZNT" placeholder="Kode ZNT" class="form-control"></td>
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
                                            <th>Kode ZNT</th>
                                            <th width="70">Modify</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $no = 1;
                                        $user = "SELECT * FROM DAT_PETA_ZNT where KD_KECAMATAN='".$KD_KECAMATAN."' and KD_KELURAHAN='".$KD_KELURAHAN."'";
                                        $userc = mysqli_query($conn, $user);
                                        while ($data = mysqli_fetch_assoc($userc)) {
                                        ?>
                                        <tr>
                                          <td><?=$no++?></td>
                                          <td><?=$data['KD_ZNT']?></td>
                                          <td>
                                            <!-- <a onclick="return confirm('Are you sure ?')" class="btn btn-primary" href="run-printsspd3r.php?print=<?=$data['KD_KECAMATAN'].''.$data['KD_KELURAHAN']?>">Print</a> -->
                                            <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                              <input type="hidden" name="KD_KECAMATAN" value="<?=$data['KD_KECAMATAN']?>">
                                              <input type="hidden" name="KD_KELURAHAN" value="<?=$data['KD_KELURAHAN']?>">
                                              <input type="hidden" name="KD_BLOK" value="<?=$data['KD_BLOK']?>">
                                              <input type="hidden" name="KD_ZNT" value="<?=$data['KD_ZNT']?>">
                                              <input onclick="return confirm('Anda Yakin ?')" class="btn btn-danger btn-sm" type="submit" name="hapus" value="Hapus">
                                            </form>
                                          </td>
                                        </tr>
                                        <?php }
                                      ?>
                                    </tbody>
                                   </table>
                            </div>
                          </div>
                        </div>
                        <?php } else { ?>
                        <div class="panel-body">
                        <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                            <table>
                                <tr>
                                    <td style="width:30%;padding-right:5px;">
                                        <select id="kecamatan" name="kecamatan" class="form-control">
                                            <option selected hidden readonly="true">PILIH KECAMATAN</option>
                                        <?php $sql = "select * from ref_kecamatan";
                                        $sqlq = mysqli_query($conn, $sql);
                                        while ($sqlr = mysqli_fetch_assoc($sqlq)) { ?>
                                            <option value="<?=$sqlr['KD_KECAMATAN']?>"><?=$sqlr['KD_KECAMATAN']?> - <?=$sqlr['NM_KECAMATAN']?></option>
                                        <?php } ?>
                                        </select>
                                    </td>
                                    <td style="width:30%;padding-right:5px;">
                                        <select id="kelurahan" name="kelurahan" class="form-control">
                                            <option selected hidden readonly="true">PILIH KELURAHAN</option>
                                        </select>
                                    </td>
                                    <td style="width:30%;padding-right:5px;">
                                        <select id="blok" name="blok" class="form-control">
                                            <option selected hidden readonly="true">PILIH KODE BLOK</option>
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
                                            <th>Kode ZNT</th>
                                            <th width="70">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $no = 1;
                                        $user = "SELECT * FROM DAT_PETA_ZNT";
                                        $userc = mysqli_query($conn, $user);
                                        while ($data = mysqli_fetch_assoc($userc)) {
                                        ?>
                                        <tr>
                                          <td><?=$no++?></td>
                                          <td><?=$data['KD_ZNT']?></td>
                                          <td>
                                            <center>
                                                <!-- <a onclick="return confirm('Are you sure ?')" class="btn btn-primary" href="run-printsspd3r.php?print=<?=$data['KD_KECAMATAN'].''.$data['KD_KELURAHAN']?>">Print</a> -->
                                                <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                                  <input type="hidden" name="KD_KECAMATAN" value="<?=$data['KD_KECAMATAN']?>">
                                                  <input type="hidden" name="KD_KELURAHAN" value="<?=$data['KD_KELURAHAN']?>">
                                                  <input type="hidden" name="KD_BLOK" value="<?=$data['KD_BLOK']?>">
                                                  <input onclick="return confirm('Anda Yakin ?')" class="btn btn-danger btn-sm" type="submit" name="hapusa" value="Hapus">
                                                </form>
                                            </center>
                                          </td>
                                        </tr>
                                        <?php }
                                      ?>
                                    </tbody>
                                   </table>
                            </div>
                          </div>
                        </div>
                        <?php } ?>
                    </div>
            </div>
            <div class="row">
            </div>
            <div class="row">
            </div>
        </div>
    </div>
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
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
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
    <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
</body>
</html>
<?php } else {
  echo "You don't have access to this page.";
} ?>
