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
                    <h1 class="page-header">Pencarian Data</h1>
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
                            Home &gt; Cetak Massal &gt; Pencarian Data
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div>
                            	<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                        		<select name="opt">
                                	                <option>NOP</option>
                                    	            <option>Nama WP</option>
                                        	        <option>Jalan OP</option>
                                </select>
                        		<input type="text" name="keyword" placeholder="Cari..."> <button type="submit" name="cari" value="cari" class="btn btn-success btn-sm">Cari</button> <button type="reset" class="btn btn-info btn-sm">Reset</button>
                                </form>
                            </div><br>
                            <div class="table-responsive">Hasil Pencarian: <?=$numrows?> data
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
if(isset($_POST['cari'])||isset($_GET['cari'])){
	/*if(isset($_SESSION['opt'])){
		$opt=$_SESSION['opt'];
		}else{
			$opt=$_POST['opt'];
		}
	if(isset($_SESSION['keyword'])){
		$keyword=$_SESSION['keyword'];
		}else{
			$keyword=strtoupper($_POST['keyword']);
			}
	*/
	switch($opt){
		case 'NOP':
			$view_op_query="SELECT outer.*
  						FROM (SELECT ROWNUM rn, inner.*
          					FROM (select a.KD_PROPINSI,a.KD_DATI2,a.KD_KECAMATAN,a.KD_KELURAHAN,a.KD_BLOK,a.NO_URUT,a.KD_JNS_OP
							,a.SUBJEK_PAJAK_ID, a.JALAN_OP, a.RT_OP, a.RW_OP, b.NM_WP 
		                from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
						WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID
						AND a.SUBJEK_PAJAK_ID = '".$keyword."') inner) outer
 						WHERE outer.rn >= ".$limitmin." AND outer.rn <= ".$limitmax;
			break;
		case 'Nama WP':
			$view_op_query="SELECT outer.*
  						FROM (SELECT ROWNUM rn, inner.*
          					FROM (select a.KD_PROPINSI,a.KD_DATI2,a.KD_KECAMATAN,a.KD_KELURAHAN,a.KD_BLOK,a.NO_URUT,a.KD_JNS_OP
							,a.SUBJEK_PAJAK_ID, a.JALAN_OP, a.RT_OP, a.RW_OP, b.NM_WP 
		                from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
						WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID
						AND b.NM_WP LIKE '%".$keyword."%') inner) outer
 						WHERE outer.rn >= ".$limitmin." AND outer.rn <= ".$limitmax;
			break;
		case 'Jalan OP':
			$view_op_query="SELECT outer.*
  						FROM (SELECT ROWNUM rn, inner.*
          					FROM (select a.KD_PROPINSI,a.KD_DATI2,a.KD_KECAMATAN,a.KD_KELURAHAN,a.KD_BLOK,a.NO_URUT,a.KD_JNS_OP
							,a.SUBJEK_PAJAK_ID, a.JALAN_OP, a.RT_OP, a.RW_OP, b.NM_WP 
		                from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
						WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID
						AND a.JALAN_OP LIKE '%".$keyword."%') inner) outer
 						WHERE outer.rn >= ".$limitmin." AND outer.rn <= ".$limitmax;
			break;
		}//end of switch($opt)
	} else {
        $view_op_query="SELECT outer.*
  						FROM (SELECT ROWNUM rn, inner.*
          					FROM (select a.KD_PROPINSI,a.KD_DATI2,a.KD_KECAMATAN,a.KD_KELURAHAN,a.KD_BLOK,a.NO_URUT,a.KD_JNS_OP
							,a.SUBJEK_PAJAK_ID, a.JALAN_OP, a.RT_OP, a.RW_OP, b.NM_WP 
		                from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
						WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID) inner) outer
 						WHERE outer.rn >= ".$limitmin." AND outer.rn <= ".$limitmax;//select query for viewing users limited by ROWNUM
	}//end if(isset($_POST['login']))
        $s = oci_parse($c, $view_op_query);
		oci_execute($s);
		$i=0;
		while (($row = oci_fetch_array($s))) {
 	   	// Use the uppercase column names for the associative array indices
    	$i=$i+1;
		?>
                                    <tbody>
                                        <tr>
                                            <td><?=$i;?></td>
                                            <td><?=$row['SUBJEK_PAJAK_ID']?></td>
                                            <td><?=$row['JALAN_OP']?></td>
                                            <td><?=$row['KD_KELURAHAN']?></td>
                                            <td><?=$row['RT_OP'].'/'.$row['RW_OP']?></td>
                                            <td><?=$row['NM_WP']?></td>
                                            <td><form target="_blank" method="post" action="sppt.php?NOP=<?=$row['SUBJEK_PAJAK_ID']?>">
                                            <input type="hidden" name="KD_PROPINSI" value="<?=$row['KD_PROPINSI']?>">
                                            <input type="hidden" name="KD_DATI2" value="<?=$row['KD_DATI2']?>">
                                            <input type="hidden" name="KD_KECAMATAN" value="<?=$row['KD_KECAMATAN']?>">
                                            <input type="hidden" name="KD_KELURAHAN" value="<?=$row['KD_KELURAHAN']?>">
                                            <input type="hidden" name="KD_BLOK" value="<?=$row['KD_BLOK']?>">
                                            <input type="hidden" name="NO_URUT" value="<?=$row['NO_URUT']?>">
                                            <input type="hidden" name="KD_JNS_OP" value="<?=$row['KD_JNS_OP']?>">
                                            <button type="submit" class="btn btn-success btn-sm">Detail</button></form></td>
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