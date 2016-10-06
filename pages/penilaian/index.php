<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
// 1. Get $hal from url
  if (isset($_GET['nilai']) || isset($_POST['nilai'])) {
    $KD_KECAMATAN = $_POST['kecamatan'];
    $KD_KELURAHAN = $_POST['kelurahan'];
    $TAHUN = $_POST['tahun'];
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

    <!-- Custom Theme JavaScript -->
    <script src="../../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

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
                    <h1 class="page-header">Penilaian Masal</h1>
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
                            Home &gt; Referensi &gt; Penilaian &gt; Penilaian Masal
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div>
                            <div class="table-responsive">
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
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                    <table>
                                    
                                        <tr>
                                          <td width="400" style="padding-bottom:10px;">Kecamatan</td>
                                          <td style="padding-bottom:10px;">
                                            <select class="form-control" id="kecamatan" name="kecamatan">
                                            <option selected hidden readonly disabled>PILIH KECAMATAN</option>
                                            <?php
                                              $sql = "select * from ref_kecamatan order by KD_KECAMATAN";
                                              $c = mysqli_query($conn, $sql);
                                              while($data = mysqli_fetch_assoc($c)) { ?>
                                                <option value="<?=$data['KD_KECAMATAN']?>"><?=$data['KD_KECAMATAN']?> - <?=$data['NM_KECAMATAN']?></option>
                                              <?php } ?>
                                              </select>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="padding-bottom:10px;" width="400">Kelurahan</td>
                                          <td style="padding-bottom:10px;">
                                            <select class="form-control" id="kelurahan" name="kelurahan">
                                              <option selected hidden readonly disabled>PILIH KELURAHAN</option>
                                            </select>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="padding-bottom:10px;" width="400">Tahun</td>
                                          <td style="padding-bottom:10px;" id="tahun" name="tahun">
                                            <select class="form-control" id="tahun" name="tahun">
                                              <option selected hidden readonly disabled>PILIH TAHUN</option>
                                              <?php for ($i=1994; $i <= 2016; $i++) { ?>
                                                <option><?=$i?></option> 
                                              <?php } ?>
                                            </select>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td width="400">
                                            
                                          </td>
                                          <td>
                                            <label style="font-weight:100">
                                              <input type="checkbox"> Penilaian Masal
                                            </label>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="padding-bottom:10px;" width="400">
                                            
                                          </td>
                                          <td style="padding-bottom:10px;">
                                            <label style="font-weight:100">
                                              <input type="checkbox"> Penetapan NJOPTKP Masal
                                            </label>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="padding-bottom:20px;" width="400">
                                            
                                          </td>
                                          <td style="padding-bottom:20px;">
                                          
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="padding-bottom:10px;" width="400">
                                            
                                          </td>
                                          <td style="padding-bottom:10px;">
                                            <input type="submit" name="nilai" value="Proses" class="btn btn-primary">
                                            <input type="reset" value="Reset" class="btn btn-default">
                                          </td>
                                        </tr>
                                   </table>
                                  </form>
                                <?php
                                  if (isset($_POST['nilai']) || isset($_POST['nilai'])) { ?>
                                  <br>
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0" >
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NOP</th>
                                            <th>Nama Wajib Pajak</th>
                                            <th></th>
                                            <th width="100">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                        $no = 1;
                                        $user = "SELECT * FROM ALL_SPPT WHERE
                                            KD_KECAMATAN = '".$KD_KECAMATAN."' AND
                                            KD_KELURAHAN = '".$KD_KELURAHAN."' AND
                                            THN_PAJAK_SPPT = '".$TAHUN."'";
                                        $userc = mysqli_query($conn, $user);
                                        while ($data = mysqli_fetch_assoc($userc)) {
                                        ?>
                                        <tr>
                                          <td><?=$no++?></td>
                                          <td><?=$data['KD_PROPINSI'].'-'.$data['KD_DATI2'].'-'.$data['KD_KECAMATAN'].'-'.$data['KD_KELURAHAN'].'-'.$data['KD_BLOK'].'-'.$data['NO_URUT'].'-'.$data['KD_JNS_OP']?></td>
                                          <td><?=$data['NM_WP_SPPT']?></td>
                                          <td><?=$data['NJOP_BUMI_SPPT']?></td>
                                          <td>
                                            <center>
                                            <a class="btn btn-success" href="edit-dati.php?refid=">Detail</a>
                                            </center>
                                          </td>
                                        </tr>
                                        <?php }
                                      ?>
                                    </tbody>
                                   </table>
                                  <?php } ?>
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
</body>

</html>

<?php } else {
  echo "You don't have access to this page.";
} ?>
