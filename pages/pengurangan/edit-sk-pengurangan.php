<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {

  if (isset($_POST['edit']) || isset($_GET['edit'])) {
      $KD_PROPINSI_PEMOHON = $_POST['KD_PROPINSI_PEMOHON'];
      $KD_DATI2_PEMOHON = $_POST['KD_DATI2_PEMOHON'];
      $KD_KECAMATAN_PEMOHON = $_POST['KD_KECAMATAN_PEMOHON'];
      $KD_KELURAHAN_PEMOHON = $_POST['KD_KELURAHAN_PEMOHON'];
      $KD_BLOK_PEMOHON = $_POST['KD_BLOK_PEMOHON'];
      $NO_URUT_PEMOHON = $_POST['NO_URUT_PEMOHON'];
      $KD_JNS_OP_PEMOHON = $_POST['KD_JNS_OP_PEMOHON'];
      $KD_KANWIL = $_POST['KD_KANWIL'];
      $KD_KPPBB = $_POST['KD_KPPBB'];
      $THN_PELAYANAN = $_POST['THN_PELAYANAN'];
      $BUNDEL_PELAYANAN = $_POST['BUNDEL_PELAYANAN'];
      $NO_URUT_PELAYANAN = $_POST['NO_URUT_PELAYANAN'];
      $THN_PENG_PERMANEN_AWAL = $_POST['THN_PENG_PERMANEN_AWAL'];
      $THN_PENG_PERMANEN_AKHIR = $_POST['THN_PENG_PERMANEN_AKHIR'];
      $JNS_SK = $_POST['JNS_SK'];
      $NO_SK = $_POST['NO_SK'];
      $STATUS_SK_PENG_PERMANEN = $_POST['STATUS_SK_PENG_PERMANEN'];
      $PCT_PENGURANGAN_PERMANEN = $_POST['PCT_PENGURANGAN_PERMANEN'];

      $updq = "UPDATE PENGURANGAN_PERMANEN SET THN_PENG_PERMANEN_AWAL='$THN_PENG_PERMANEN_AWAL', THN_PENG_PERMANEN_AKHIR='$THN_PENG_PERMANEN_AKHIR', JNS_SK='$JNS_SK', NO_SK='$NO_SK', STATUS_SK_PENG_PERMANEN='$STATUS_SK_PENG_PERMANEN', PCT_PENGURANGAN_PERMANEN='$PCT_PENGURANGAN_PERMANEN' where KD_KANWIL='$KD_KANWIL' and KD_KPPBB='$KD_KPPBB' and THN_PELAYANAN='$THN_PELAYANAN' and BUNDEL_PELAYANAN='$BUNDEL_PELAYANAN' and NO_URUT_PELAYANAN='$NO_URUT_PELAYANAN' and KD_PROPINSI_PEMOHON='$KD_PROPINSI_PEMOHON' and KD_DATI2_PEMOHON='$KD_DATI2_PEMOHON' and KD_KECAMATAN_PEMOHON='$KD_KECAMATAN_PEMOHON' and KD_KELURAHAN_PEMOHON='$KD_KELURAHAN_PEMOHON' and KD_BLOK_PEMOHON='$KD_BLOK_PEMOHON' and NO_URUT_PEMOHON='$NO_URUT_PEMOHON' and KD_JNS_OP_PEMOHON='$KD_JNS_OP_PEMOHON'";
      if (mysqli_query($conn, $updq)) {
        $_SESSION['notif']  = "Data SK Berhasil Diupdate";
        header("Location: sk-pengurangan.php");
      } else {
        $_SESSION['gagal']  = "Data SK Gagal Diupdate";
        header("Location: sk-pengurangan.php");
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
                    <h1 class="page-header">Kelas Tanah</h1>
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
                            Home &gt; Persiapan &gt; Kelas Tanah &gt; Edit Kelas Tanah
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div>
                            <div class="table-responsive">
                              <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                    <table class="table table-bordered">
                                      <?php
                                        list($KD_KANWIL, $KD_KPPBB, $THN_PELAYANAN, $BUNDEL_PELAYANAN, $NO_URUT_PELAYANAN) = explode(".", $_GET['refid']);
                                        $user = "SELECT * FROM PENGURANGAN_PERMANEN where KD_KANWIL='".$KD_KANWIL."' and KD_KPPBB='".$KD_KPPBB."' and THN_PELAYANAN='".$THN_PELAYANAN."' and BUNDEL_PELAYANAN='".$BUNDEL_PELAYANAN."' and NO_URUT_PELAYANAN='".$NO_URUT_PELAYANAN."'";
                                        $userc = mysqli_query($conn, $user) or die (mysqli_error($conn));
                                        while ($data = mysqli_fetch_assoc($userc)) {
                                        ?>
                                        <input type="hidden" name="KD_PROPINSI_PEMOHON" value="<?=$data['KD_PROPINSI_PEMOHON'];?>">
                                        <input type="hidden" name="KD_DATI2_PEMOHON" value="<?=$data['KD_DATI2_PEMOHON'];?>">
                                        <input type="hidden" name="KD_KECAMATAN_PEMOHON" value="<?=$data['KD_KECAMATAN_PEMOHON'];?>">
                                        <input type="hidden" name="KD_KELURAHAN_PEMOHON" value="<?=$data['KD_KELURAHAN_PEMOHON']?>">
                                        <input type="hidden" name="KD_BLOK_PEMOHON" value="<?=$data['KD_BLOK_PEMOHON']?>">
                                        <input type="hidden" name="NO_URUT_PEMOHON" value="<?=$data['NO_URUT_PEMOHON'];?>">
                                        <input type="hidden" name="KD_JNS_OP_PEMOHON" value="<?=$data['KD_JNS_OP_PEMOHON'];?>">

                                        <tr>
                                          <td style="width:30%;">NOP Pemohon</td>
                                          <td style="width:50%;">
                                            <?=$data['KD_PROPINSI_PEMOHON'].'-'.$data['KD_DATI2_PEMOHON'].'-'.$data['KD_KECAMATAN_PEMOHON'].'-'.$data['KD_KELURAHAN_PEMOHON'].'-'.$data['KD_BLOK_PEMOHON'].'-'.$data['NO_URUT_PEMOHON'].'-'.$data['KD_JNS_OP_PEMOHON']?>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Kode Kanwil</td>
                                          <td style="width:50%;">
                                            <input type="text" readonly class="form-control" value="<?=$data['KD_KANWIL']?>" name="KD_KANWIL">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Kode KPPBB</td>
                                          <td style="width:50%;">
                                            <input type="text" readonly class="form-control" value="<?=$data['KD_KPPBB']?>" name="KD_KPPBB">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Tahun Pelayanan</td>
                                          <td style="width:50%;">
                                            <input type="text" readonly class="form-control" value="<?=$data['THN_PELAYANAN']?>" name="THN_PELAYANAN">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Bundel Pelayanan</td>
                                          <td style="width:50%;">
                                            <input type="text" readonly class="form-control" value="<?=$data['BUNDEL_PELAYANAN']?>" name="BUNDEL_PELAYANAN">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Nomor Urut Pelayanan</td>
                                          <td style="width:50%;">
                                            <input type="text" name="NO_URUT_PELAYANAN" value="<?=$data['NO_URUT_PELAYANAN']?>" class="form-control">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Tahun Pengurangan Permanen Awal</td>
                                          <td style="width:50%;">
                                            <input type="text" name="THN_PENG_PERMANEN_AWAL" value="<?=$data['THN_PENG_PERMANEN_AWAL']?>" class="form-control">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Tahun Pengurangan Permanen Akhir</td>
                                          <td style="width:50%;">
                                            <input type="text" name="THN_PENG_PERMANEN_AKHIR" value="<?=$data['THN_PENG_PERMANEN_AKHIR']?>" class="form-control">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Jenis SK</td>
                                          <td style="width:50%;">
                                            <select name="JNS_SK" class="form-control">
                                              <?php
                                              $sql = "select * from REF_JNS_SK where KD_SK='".$data['JNS_SK']."'";
                                              $sqla = mysqli_query($conn, $sql);
                                              while ($skj = mysqli_fetch_assoc($sqla)) { ?>
                                                <option value="<?=$skj['KD_SK']?>"><?=$skj['KD_SK'] .' - '. $skj['NM_SK']?></option>
                                              <?php } ?>
                                            </select>
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Nomor SK</td>
                                          <td style="width:50%;">
                                            <input type="text" name="NO_SK" value="<?=$data['NO_SK']?>" class="form-control">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Status SK</td>
                                          <td style="width:50%;">
                                            <input type="text" name="STATUS_SK_PENG_PERMANEN" value="<?=$data['STATUS_SK_PENG_PERMANEN']?>" class="form-control">
                                          </td>
                                        </tr>

                                        <tr>
                                          <td style="width:30%;">Persentase SK</td>
                                          <td>
                                            <input style="width:300px;display:inline-block;" type="text" name="PCT_PENGURANGAN_PERMANEN" value="<?=$data['PCT_PENGURANGAN_PERMANEN']?>" class="form-control"> %
                                          </td>
                                        </tr>


                                        <tr>
                                          <td>

                                          </td>
                                          <td>
                                            <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
                                            <a href="#" class="btn btn-default">Batal</a>
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
  echo "You don't have access to this page.";
} ?>
