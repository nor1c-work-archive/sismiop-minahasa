<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR" || $_SESSION['ROLE']=="PEMBATALAN") { ?>

<?php

// 1. Get $hal from url
IF (ISSET($_GET['hal'])) {
   $hal = $_GET['hal'];
} ELSE {
   $hal = 1;
}

//2. count total number of rows
if (isset($_POST['cari']) || isset($_GET['cari'])) {
  if (isset($_GET['opt'])) {
    $opt = $_GET['opt'];
  } else {
    $opt = $_POST['opt'];
  }

  if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
  } else {
    $keyword = strtoupper($_POST['keyword']);
  }

  switch ($opt) {
    case 'nop':
        if (isset($_POST['KD_PROPINSI']) AND isset($_POST['KD_DATI2']) AND isset($_POST['KD_KECAMATAN']) AND isset($_POST['KD_KELURAHAN']) AND isset($_POST['KD_BLOK']) AND isset($_POST['NO_URUT']) AND isset($_POST['KD_JNS_OP'])) {
          $KD_PROPINSI = strtoupper($_POST['KD_PROPINSI']);
          $KD_DATI2 = strtoupper($_POST['KD_DATI2']);
          $KD_KECAMATAN = strtoupper($_POST['KD_KECAMATAN']);
          $KD_KELURAHAN = strtoupper($_POST['KD_KELURAHAN']);
          $KD_BLOK = strtoupper($_POST['KD_BLOK']);
          $NO_URUT = strtoupper($_POST['NO_URUT']);
          $KD_JNS_OP = strtoupper($_POST['KD_JNS_OP']);

          if ($KD_PROPINSI == "" || $KD_DATI2 == "" || $KD_KECAMATAN == "" || $KD_KELURAHAN == "" || $KD_BLOK == "" || $NO_URUT == "" || $KD_JNS_OP == "") {
            echo "Tidak boleh ada yang kosong";
          } else {
            $q = "SELECT count(*) from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
                WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
                a.KD_PROPINSI LIKE '%".$KD_PROPINSI."%' AND
                a.KD_DATI2 LIKE '%".$KD_DATI2."%' AND
                a.KD_KECAMATAN LIKE '%".$KD_KECAMATAN."%' AND
                a.KD_KELURAHAN LIKE '%".$KD_KELURAHAN."%' AND
                a.KD_BLOK LIKE '%".$KD_BLOK."%' AND
                a.NO_URUT LIKE '%".$NO_URUT."%' AND
                a.KD_JNS_OP LIKE '%".$KD_JNS_OP."%'
            ";
          }
        }
      break;
    case 'nmwp':
        $q = "SELECT count(*) from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
            WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
            b.NM_WP LIKE '%".$keyword."%'
        ";
      break;
    case 'jlnop':
    echo $opt;
        $q = "SELECT count(*) from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
          WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
          a.JALAN_OP LIKE '%".$keyword."%'
        ";
      break;
    default:
      break;
  }
} else {
  $q = "SELECT count(*) FROM DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
  WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID";
}

$qa = mysqli_query($conn, $q) or die (mysqli_error($conn));

$numrows = $qa->fetch_row();
$numrow = $numrows[0];

// 3. Calculate number of $lastpage
// This code uses the values in $rows_per_page and $numrows in order to identify the number of the last page.
$rows_per_page = 25;
$lastpage = CEIL($numrow/$rows_per_page);
// 4. Ensure that $pageno is within range
// This code checks that the value of $pageno is an integer between 1 and $lastpage.
$hal = (int)$hal;
if ($hal < 1) {
   $hal = 1;
} elseif ($hal > $lastpage) {
   $hal = $lastpage;
} // if
// 5. Construct LIMIT clause
// This code will construct the LIMIT clause for the sql SELECT statement.
$limitmin = ($hal-1)*$rows_per_page;
$limitmax = $limitmin+$rows_per_page;
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
                    <h1 class="page-header">Pembatalan SSPD per Obyek Pajak</h1>
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
                            Home &gt; Pembatalan SSPD &gt; Pencarian Obyek Pajak
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <div>
                            <?php if (!isset($_GET['opt'])) { ?>
                              Cari Berdasarkan
                              <div class="form-group">
                                <select class="form-control" id="graph_select2" name="awd">
                                    <option id="nop2">NOP</option>
                                    <option id="nmwp2">Nama Wajib Pajak</option>
                                    <option id="jlnop2">Jalan Objek Pajak</option>
                                </select>
                              </div>

                              <!-- NOP -->
                              <span id="nops2">
                              <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                  <input type="hidden" name="opt" value="nop">
                                  <input type="hidden" name="keyword" value="nop">

                                  <input readonly="true" type="hidden" style="border-radius:5px;border:solid 1px #ccc;padding:6px;" name="KD_PROPINSI" value="71" placeholder="Kode Propinsi" maxlength="2" size="12px" required>
                                  71-
                                  <input readonly="true" type="hidden" style="border-radius:5px;border:solid 1px #ccc;padding:6px;" name="KD_DATI2" value="03" placeholder="Kode Dati2" maxlength="2" size="12px" required>
                                  03-
                                  <input type="text" style="border:solid 1px #ccc;padding:6px;" name="KD_KECAMATAN" placeholder="Kode Kecamatan" maxlength="3" size="12px" required> -
                                  <input type="text" style="border:solid 1px #ccc;padding:6px;" name="KD_KELURAHAN" placeholder="Kode Kelurahan" maxlength="3" size="12px" required> -
                                  <input type="text" style="border:solid 1px #ccc;padding:6px;" name="KD_BLOK" placeholder="Kode Blok" maxlength="3" size="12px" required> -
                                  <input type="text" style="border:solid 1px #ccc;padding:6px;" name="NO_URUT" placeholder="No Urut" maxlength="4" size="12px" required> -
                                  <input type="text" style="border:solid 1px #ccc;padding:6px;" name="KD_JNS_OP" placeholder="Kode Jenis Objek Pajak" maxlength="1" size="12px" required>
                                  <input class="btn btn-primary" type="submit" name="cari" value="Cari">
                              </form>
                              </span>

                              <!-- NAMA WP -->
                              <span id="nmwps2">
                              <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                  <input type="hidden" name="opt" value="nmwp">

                                  <table>
                                    <tr>
                                      <td><input class="form-control" type="text" name="keyword" value="" placeholder="Nama Wajib Pajak" required></td>
                                      <td>&nbsp; <input class="btn btn-primary" type="submit" name="cari" value="Cari"></td>
                                    </tr>
                                  </table>
                              </form>
                              </span>

                              <span id="jlnops2">
                                <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                    <input type="hidden" name="opt" value="jlnop">

                                    <table>
                                      <tr>
                                        <td><input class="form-control" type="text" name="keyword" value="" placeholder="Jalan Objek Pajak" required></td>
                                        <td>&nbsp; <input class="btn btn-primary" type="submit" name="cari" value="Cari"></td>
                                      </tr>
                                    </table>
                                </form>
                              </span>
                            <?php } ?>
                          </div>

                            <br>
                            <?php if ($numrow=="0") {
                              echo "Hasil Pencarian Kosong";
                            } else { ?>
                            <div class="table-responsive">Hasil Pencarian: <?=$numrow?> data
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NOP</th>
                                            <th>Jalan OP</th>
                                            <th>Kelurahan</th>
                                            <th>RT/RW</th>
                                            <th>Nama WP</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
    <?php
  }
    if (isset($_GET['cari']) || isset($_POST['cari'])) {
      if ($numrow=="0") {

      } else {
          switch ($opt) {
            case 'nop':
                if (isset($_POST['KD_PROPINSI']) AND isset($_POST['KD_DATI2']) AND isset($_POST['KD_KECAMATAN']) AND isset($_POST['KD_KELURAHAN']) AND isset($_POST['KD_BLOK']) AND isset($_POST['NO_URUT']) AND isset($_POST['KD_JNS_OP'])) {
                  $KD_PROPINSI = strtoupper($_POST['KD_PROPINSI']);
                  $KD_DATI2 = strtoupper($_POST['KD_DATI2']);
                  $KD_KECAMATAN = strtoupper($_POST['KD_KECAMATAN']);
                  $KD_KELURAHAN = strtoupper($_POST['KD_KELURAHAN']);
                  $KD_BLOK = strtoupper($_POST['KD_BLOK']);
                  $NO_URUT = strtoupper($_POST['NO_URUT']);
                  $KD_JNS_OP = strtoupper($_POST['KD_JNS_OP']);

                  if ($KD_PROPINSI == "" || $KD_DATI2 == "" || $KD_KECAMATAN == "" || $KD_KELURAHAN == "" || $KD_BLOK == "" || $NO_URUT == "" || $KD_JNS_OP == "") {
                    echo "Tidak boleh ada yang kosong";
                  } else {
                    $q = "SELECT a.KD_PROPINSI,a.KD_DATI2,a.KD_KECAMATAN,a.KD_KELURAHAN,a.KD_BLOK,a.NO_URUT,a.KD_JNS_OP
                    ,a.SUBJEK_PAJAK_ID, a.JALAN_OP, a.RT_OP, a.RW_OP, b.NM_WP
                        from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
                        WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
                        a.KD_PROPINSI LIKE '%".$KD_PROPINSI."%' AND
                        a.KD_DATI2 LIKE '%".$KD_DATI2."%' AND
                        a.KD_KECAMATAN LIKE '%".$KD_KECAMATAN."%' AND
                        a.KD_KELURAHAN LIKE '%".$KD_KELURAHAN."%' AND
                        a.KD_BLOK LIKE '%".$KD_BLOK."%' AND
                        a.NO_URUT LIKE '%".$NO_URUT."%' AND
                        a.KD_JNS_OP LIKE '%".$KD_JNS_OP."%'
                        LIMIT $limitmin, $limitmax
                    ";
                  }
                }
              break;
            case 'nmwp':
                $q = "SELECT a.KD_PROPINSI,a.KD_DATI2,a.KD_KECAMATAN,a.KD_KELURAHAN,a.KD_BLOK,a.NO_URUT,a.KD_JNS_OP
                  ,a.SUBJEK_PAJAK_ID, a.JALAN_OP, a.RT_OP, a.RW_OP, b.NM_WP from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
                    WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
                    b.NM_WP LIKE '%".$keyword."%' LIMIT $limitmin, $limitmax
                ";
              break;
            case 'jlnop':
            echo $opt;
                $q = "SELECT a.KD_PROPINSI,a.KD_DATI2,a.KD_KECAMATAN,a.KD_KELURAHAN,a.KD_BLOK,a.NO_URUT,a.KD_JNS_OP
                  ,a.SUBJEK_PAJAK_ID, a.JALAN_OP, a.RT_OP, a.RW_OP, b.NM_WP from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
                  WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
                  a.JALAN_OP LIKE '%".$keyword."%' LIMIT $limitmin, $limitmax
                ";
              break;
            default:
              break;
          }
        } } else {
      $q = "SELECT * FROM DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
      WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID LIMIT $limitmin, $limitmax";
    }


    $s = mysqli_query($conn, $q) or die (mysqli_error($conn));

    if ($numrow=="0") {

    } else {

    $i=0;
    while (($row = mysqli_fetch_assoc($s))) {

    // Use the uppercase column names for the associative array indices
    $i=$i+1;

    ?>
    <tbody>
        <tr>
            <td><?=$i;?></td>
            <td><?=$row['KD_PROPINSI'].$row['KD_DATI2'].$row['KD_KECAMATAN'].$row['KD_KELURAHAN'].$row['KD_BLOK'].$row['NO_URUT'].$row['KD_JNS_OP']?></td>
            <td><?=$row['JALAN_OP']?></td>
            <td><?=$row['KD_KELURAHAN']?></td>
            <td><?=$row['RT_OP'].'/'.$row['RW_OP']?></td>
            <td><?=$row['NM_WP']?></td>
            <td>
            <form target="_blank" method="post" action="pembatalan.php?NOP=<?=$row['KD_PROPINSI'].$row['KD_DATI2'].$row['KD_KECAMATAN'].$row['KD_KELURAHAN'].$row['KD_BLOK'].$row['NO_URUT'].$row['KD_JNS_OP']?>">
              <input type="hidden" name="KD_PROPINSI" value="<?=$row['KD_PROPINSI']?>">
              <input type="hidden" name="KD_DATI2" value="<?=$row['KD_DATI2']?>">
              <input type="hidden" name="KD_KECAMATAN" value="<?=$row['KD_KECAMATAN']?>">
              <input type="hidden" name="KD_KELURAHAN" value="<?=$row['KD_KELURAHAN']?>">
              <input type="hidden" name="KD_BLOK" value="<?=$row['KD_BLOK']?>">
              <input type="hidden" name="NO_URUT" value="<?=$row['NO_URUT']?>">
              <input type="hidden" name="KD_JNS_OP" value="<?=$row['KD_JNS_OP']?>">
              <button type="submit" class="btn btn-success btn-sm">Detail</button>
            </form></td>
        </tr>
         <?php }//end of while (($row = oci_fetch_array($stid, OCI_BOTH)) != false)?>
       </tbody>
   </table>
<?php
// 7. Construct pagination hyperlinks
// Finally we must construct the hyperlinks which will allow the user to select
// other pages. We will start with the links for any previous pages.
IF ($hal == 1) {
   ECHO " FIRST PREV ";
} ELSE {
	if(isset($_POST['cari'])||isset($_GET['cari'])){
   ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=1&cari=cari&opt=$opt&keyword=$keyword'>FIRST</a> ";}
   	else{ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=1'>FIRST</a> ";}
   $prevpage = $hal-1;
   	if(isset($_POST['cari'])||isset($_GET['cari'])){
   ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$prevpage&cari=cari&opt=$opt&keyword=$keyword'>PREV</a> ";}
   	else{ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$prevpage'>PREV</a> ";}
} // if
// Next we inform the user of his current position in the sequence of available pages.
ECHO " ( Page $hal of $lastpage ) ";
// This code will provide the links for any following pages.
IF ($hal == $lastpage) {
   ECHO " NEXT LAST ";
} ELSE {
   $nextpage = $hal+1;
   if(isset($_POST['cari'])||isset($_GET['cari'])){
   ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$nextpage&cari=cari&opt=$opt&keyword=$keyword'>NEXT</a> ";
   ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$lastpage&cari=cari&opt=$opt&keyword=$keyword'>LAST</a> ";}
   	else {
		ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$nextpage'>NEXT</a> ";
   		ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$lastpage'>LAST</a> ";
		}
} // if
}
?>
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
     header("Location: ../../index.php");
   } ?>
