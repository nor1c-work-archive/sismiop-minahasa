<?php  
session_start();//session starts here  
include '../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])  
{  
    header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.  
}  

// 1. Get $hal from url
IF (ISSET($_GET['hal'])) {
   $hal = $_GET['hal'];
} ELSE {
   $hal = 1;
} 

//2. count total number of rows
if(isset($_POST['cari'])||isset($_GET['cari'])){
	if(isset($_GET['opt'])){
		$opt=$_GET['opt'];
		}else{
			$opt=$_POST['opt'];
		}
	if(isset($_GET['keyword'])){
		$keyword=$_GET['keyword'];
		}else{
			$keyword=strtoupper($_POST['keyword']);
			}

	switch($opt){
		case 'NOP':
			$q="SELECT count(*) FROM DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
						WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID
						AND a.SUBJEK_PAJAK_ID = '".$keyword."'";
			break;
		case 'Nama WP':
			$q="SELECT count(*) FROM DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
						WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID
						AND b.NM_WP like '%".$keyword."%'";
			break;
		case 'Jalan OP':
			$q="SELECT count(*) FROM DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
						WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID
						AND a.JALAN_OP like '%".$keyword."%'";
			break;
		default:
			break;
		}//end of switch($opt)
} else {
		$q="select count(*) from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID";
	}//end of if(isset($_POST['cari']))
		$s = oci_parse($c, $q);
		oci_execute($s);
$numrows=oci_fetch_row($s);
$numrows=$numrows[0];
// 3. Calculate number of $lastpage
// This code uses the values in $rows_per_page and $numrows in order to identify the number of the last page.
$rows_per_page = 25;
$lastpage = CEIL($numrows/$rows_per_page);
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
                    <h1 class="page-header">Penerimaan PBB Per-Wilayah</h1>
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
                            Home &gt; Monitoring &gt; Penerimaan PBB Per-Wilayah
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div></div><br>
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