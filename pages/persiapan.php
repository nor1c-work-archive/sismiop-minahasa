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
                    <h1 class="page-header">Persiapan</h1>
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
                            Home &gt; Pendataan &gt; Persiapan
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div></div>
                        	<div class="col-lg-3 col-md-6">
                        	  <div class="panel panel-green">
                        	    <div class="panel-heading">
                        	      <div class="row">
                        	        <div class="col-xs-3"> <i class="fa fa-tasks fa-5x"></i> </div>
                        	        <div class="col-xs-9 text-right">
                        	          <div class="huge">Pembuatan ZNT</div>
                        	          <div></div>
                      	          </div>
                      	        </div>
                      	      </div>
                        	    <a href="#">
                        	      <div class="panel-footer"> <span class="pull-left">Pembuatan Tabel Blok</span> <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        	        <div class="clearfix"></div>
                      	        </div>
                      	      </a>
                              <a href="#">
                        	      <div class="panel-footer"> <span class="pull-left">Pembuatan Tabel Peta ZNT</span> <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        	        <div class="clearfix"></div>
                      	        </div>
                      	      </a>
                              <a href="#">
                        	      <div class="panel-footer"> <span class="pull-left">Pemetaan ZNT-Blok</span> <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        	        <div class="clearfix"></div>
                      	        </div>
                      	      </a>
                              <a href="#">
                        	      <div class="panel-footer"> <span class="pull-left">Perubahan NIR</span> <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        	        <div class="clearfix"></div>
                      	        </div>
                      	      </a>
                               </div>
                      	  </div>
                          <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-gears fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">Pembuatan DBKB</div>
                                    <div></div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">DBKB STANDARD</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">DBKB NON STANDARD</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>	
                        	<br>
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