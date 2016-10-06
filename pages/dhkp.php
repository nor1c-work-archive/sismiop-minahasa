<?php
session_start();//session starts here
include '../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{

    header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.
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
                    <h1 class="page-header">DHKP</h1>
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
                            Home &gt; Cetak Massal &gt; DHKP
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        	<div>
<?php
//Select Kecamatan
  $qKec="select KD_KECAMATAN, NM_KECAMATAN from REF_KECAMATAN";
    $sKec=oci_parse($c,$qKec);
            oci_execute($sKec);
?>
                            	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                Pilih Kecamatan:
                        		<select name="kec">
                                <option><?php if(isset($_POST['kec'])){echo $_POST['kec'];}?></option>
                                <?php
                                while(($rowKec = oci_fetch_array($sKec))){
									echo '<option value="'.$rowKec['NM_KECAMATAN'].'">'.$rowKec['NM_KECAMATAN']; echo'</option>';
                    								};?>
                                </select>
                        		<button type="submit" name="cari" value="cari" class="btn btn-success btn-sm">Cari</button>
                                </form>
<?php
if(isset($_POST['kec'])){
	//Select Kelurahan
	$kd_kec=$_POST['kec'];
    $qKel="select b.NM_KECAMATAN, a.KD_KELURAHAN, NM_KELURAHAN from REF_KELURAHAN a, REF_KECAMATAN b
           WHERE a.KD_KECAMATAN = b.KD_KECAMATAN
		   AND KD_KECAMATAN = '$kd_kec'";
    $sKel=oci_parse($c,$qKel);
            oci_execute($sKel);
			?>
								<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                                Pilih Kelurahan di Kecamatan <?=$kd_kec?>:
                        		<select name="kel">
                                <?php
                                while(($rowKel = oci_fetch_array($sKel))){
									echo '<option value="'.$rowKel['KD_KELURAHAN'].'">'.$rowKel['NM_KELURAHAN']; echo'</option>';
                    								};?>
                                </select>
                        		<button type="submit" name="cari" value="cari" class="btn btn-success btn-sm">Cari</button>
                                </form>
<?php
	};
?>
                            </div><br>
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

</body>

</html>
