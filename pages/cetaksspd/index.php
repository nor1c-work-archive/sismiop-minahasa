<?php
session_start();//session starts here
include '../../bin/dbconn.php';

// if(!$_SESSION['NM_LOGIN'])
// {
//    header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
// }

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
  $q = "SELECT count(*) FROM REF_KECAMATAN";
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

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="../../dist/js/sb-admin-2.js"></script>
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
    </script> -->

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
                    <h1 class="page-header">Pembatalan SPPT per Obyek Pajak</h1>
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
                            Home &gt; Pembatalan SPPT &gt; Pencarian Obyek Pajak
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div>
                            <?php if (!isset($_GET['opt'])) { ?>
                              <select id="graph_select2" name="awd">
                                  <option id="nop2">NOP</option>
                                  <option id="nmwp2">Nama WP</option>
                                  <option id="jlnop2">Jalan OP</option>
                              </select>

                              <!-- NOP -->
                              <span id="nops2">
                              <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                  <input type="hidden" name="opt" value="nop">
                                  <input type="hidden" name="keyword" value="nop">

                                  <input type="text" name="KD_PROPINSI" placeholder="Kode Propinsi" maxlength="2" size="10px" required>
                                  <input type="text" name="KD_DATI2" placeholder="Kode Dati2" maxlength="2" size="10px" required>
                                  <input type="text" name="KD_KECAMATAN" placeholder="Kode Kecamatan" maxlength="3" size="10px" required>
                                  <input type="text" name="KD_KELURAHAN" placeholder="Kode Kelurahan" maxlength="3" size="10px" required>
                                  <input type="text" name="KD_BLOK" placeholder="Kode Blok" maxlength="3" size="10px" required>
                                  <input type="text" name="NO_URUT" placeholder="No Urut" maxlength="4" size="10px" required>
                                  <input type="text" name="KD_JNS_OP" placeholder="Kode Jenis Objek Pajak" maxlength="1" size="10px" required>
                                  <input type="submit" name="cari" value="Cari">
                              </form>
                              </span>

                              <!-- NAMA WP -->
                              <span id="nmwps2">
                              <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                  <input type="hidden" name="opt" value="nmwp">

                                  <input type="text" name="keyword" value="" placeholder="Nama Wajib Pajak" required>
                                  <input type="submit" name="cari" value="Cari">
                              </form>
                              </span>

                              <span id="jlnops2">
                                <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                    <input type="hidden" name="opt" value="jlnop">

                                    <input type="text" name="keyword" value="" placeholder="Jalan Objek Pajak" required>
                                    <input type="submit" name="cari" value="Cari">
                                </form>
                              </span>
                            <?php } else { ?>
                              <select id="graph_select" name="opt">
                                  <option id="nop">NOP</option>
                                  <option id="nmwp">Nama WP</option>
                                  <option id="jlnop">Jalan OP</option>
                              </select>

                              <!-- NOP -->
                              <span id="nops">
                              <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                  <input type="hidden" name="opt" value="nop">
                                  <input type="hidden" name="keyword" value="nop">

                                  <input type="text" name="KD_PROPINSI" placeholder="Kode Propinsi" maxlength="2" required>
                                  <input type="text" name="KD_DATI2" placeholder="Kode Dati2" maxlength="2" required>
                                  <input type="text" name="KD_KECAMATAN" placeholder="Kode Kecamatan" maxlength="3" required>
                                  <input type="text" name="KD_KELURAHAN" placeholder="Kode Kelurahan" maxlength="2" required>
                                  <input type="text" name="KD_BLOK" placeholder="Kode Blok" maxlength="2" required>
                                  <input type="text" name="NO_URUT" placeholder="No Urut" maxlength="2" required>
                                  <input type="text" name="KD_JNS_OP" placeholder="Kode Jenis Objek Pajak" maxlength="1" required>
                                  <input type="submit" name="cari" value="Cari">
                              </form>
                              </span>

                              <!-- NAMA WP -->
                              <span id="nmwps">
                              <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                  <input type="hidden" name="opt" value="nmwp">

                                  <input type="text" name="keyword" value="" placeholder="Nama Wajib Pajak" required>
                                  <input type="submit" name="cari" value="Cari">
                              </form>
                              </span>

                              <span id="jlnops">
                                <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                    <input type="hidden" name="opt" value="jlnop">

                                    <input type="text" name="keyword" value="" placeholder="Jalan Objek Pajak" required>
                                    <input type="submit" name="cari" value="Cari">
                                </form>
                              </span>
                            <?php
                            }
                            ?>
                          </div>


                            <br>
                            <div class="table-responsive">Hasil Pencarian: <?=$numrow?> data
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Propinsi</th>
                                            <th>Kode Dati 2</th>
                                            <th>Kode Kecamatan</th>
                                            <th>Nama Kecamatan</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
    <?php

    if (isset($_GET['cari']) || isset($_POST['cari'])) {

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
                        a.KD_JNS_OP LIKE '%".$KD_JNS_OP."%' LIMIT $limitmin, $limitmax
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
        } else {
      $q = "SELECT * FROM REF_KECAMATAN LIMIT $limitmin, $limitmax";
    }


    $s = mysqli_query($conn, $q) or die (mysqli_error($conn));

    $i=0;
    while (($row = mysqli_fetch_assoc($s))) {

    // Use the uppercase column names for the associative array indices
    $i=$i+1;

    ?>
    <tbody>
        <tr>
            <td><?=$i;?></td>
            <td><?=$row['KD_PROPINSI']?></td>
            <td><?=$row['KD_DATI2']?></td>
            <td><?=$row['KD_KECAMATAN']?></td>
            <td><?=$row['NM_KECAMATAN']?></td>
            <td>
            <form target="_blank" method="post" action="pembatalan.php?NOP=<?=$row['KD_PROPINSI'].$row['KD_DATI2'].$row['KD_KECAMATAN']?>">
            <input type="hidden" name="KD_PROPINSI" value="<?=$row['KD_PROPINSI']?>">
            <input type="hidden" name="KD_DATI2" value="<?=$row['KD_DATI2']?>">
            <input type="hidden" name="KD_KECAMATAN" value="<?=$row['KD_KECAMATAN']?>">
            <button type="submit" class="btn btn-success btn-sm">Detail</button>
            </form></td>
        </tr>
         <?php }//end of while (($row = oci_fetch_array($stid, OCI_BOTH)) != false)?>
       </tbody>
   </table>
<br>
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
