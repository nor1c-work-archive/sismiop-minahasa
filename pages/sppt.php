<?php  
session_start();//session starts here  
include '../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])  
{  
  
    header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.  
}  

if(!isset($_GET['NOP'])){
	echo "Error, data tidak tersedia";
	exit();
	} else {
		$KD_PROPINSI=$_POST['KD_PROPINSI'];
		$KD_DATI2=$_POST['KD_DATI2'];
		$KD_KECAMATAN=$_POST['KD_KECAMATAN'];
		$KD_KELURAHAN=$_POST['KD_KELURAHAN'];
		$KD_BLOK=$_POST['KD_BLOK'];
		$NO_URUT=$_POST['NO_URUT'];
		$KD_JNS_OP=$_POST['KD_JNS_OP'];
		
		$NOP=$KD_PROPINSI.'-'.$KD_DATI2.'-'.$KD_KECAMATAN.'-'.$KD_KELURAHAN.'-'.$KD_BLOK.'-'.$NO_URUT.'-'.$KD_JNS_OP;
	}//end if(!isset($_GET['NOP']))

$qOP="
select	a.JALAN_OP, a.KD_KECAMATAN, a.KD_KELURAHAN, a.RT_OP, a.RW_OP, a.KD_PROPINSI, a.KD_DATI2, a.KD_BLOK, a.NO_URUT, a.KD_JNS_OP,
		b.NM_KECAMATAN, c.NM_KELURAHAN 
 from DAT_OBJEK_PAJAK a, REF_KECAMATAN b, REF_KELURAHAN c
 where a.KD_PROPINSI=b.KD_PROPINSI
 and a.KD_DATI2=b.KD_DATI2
 and a.KD_KECAMATAN=b.KD_KECAMATAN 
 and a.KD_PROPINSI=c.KD_PROPINSI
 and a.KD_DATI2=c.KD_DATI2
 and a.KD_KECAMATAN=c.KD_KECAMATAN 
 and a.KD_PROPINSI='".$KD_PROPINSI."'
 and a.KD_DATI2='".$KD_DATI2."'
 and a.KD_KECAMATAN='".$KD_KECAMATAN."'
 and a.KD_KELURAHAN='".$KD_KELURAHAN."'
 and a.KD_BLOK='".$KD_BLOK."'
 and a.NO_URUT='".$NO_URUT."'
 and a.KD_JNS_OP='".$KD_JNS_OP."'
 and b.KD_KECAMATAN='".$KD_KECAMATAN."'
 and c.KD_KELURAHAN='".$KD_KELURAHAN."'
";
$s = oci_parse($c, $qOP);
	oci_execute($s);
$datOP=oci_fetch_array($s);


$qDetailSPPT="
select JLN_WP_SPPT, a.THN_PAJAK_SPPT, NM_WP_SPPT, JLN_WP_SPPT, LUAS_BUMI_SPPT, LUAS_BNG_SPPT, PBB_YG_HARUS_DIBAYAR_SPPT, 
TGL_JATUH_TEMPO_SPPT, JML_SPPT_YG_DIBAYAR, TGL_PEMBAYARAN_SPPT
 from SPPT a, PEMBAYARAN_SPPT b
 where a.KD_PROPINSI=b.KD_PROPINSI
 and a.KD_DATI2=b.KD_DATI2
 and a.KD_KECAMATAN=b.KD_KECAMATAN
 and a.KD_KELURAHAN=b.KD_KELURAHAN
 and a.KD_BLOK=b.KD_BLOK
 and a.NO_URUT=b.NO_URUT
 and a.KD_JNS_OP=b.KD_JNS_OP
 and a.THN_PAJAK_SPPT=b.THN_PAJAK_SPPT
 and a.KD_PROPINSI='".$KD_PROPINSI."'
 and a.KD_DATI2='".$KD_DATI2."'
 and a.KD_KECAMATAN='".$KD_KECAMATAN."'
 and a.KD_KELURAHAN='".$KD_KELURAHAN."'
 and a.KD_BLOK='".$KD_BLOK."'
 and a.NO_URUT='".$NO_URUT."'
 and a.KD_JNS_OP='".$KD_JNS_OP."'
 order by a.THN_PAJAK_SPPT";
$sDet = oci_parse($c, $qDetailSPPT);
	oci_execute($sDet);
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
       <!-- </nav> -->
        <div id="">
            <div class="row"><!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row"><!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
               
                    <div class="panel panel-default">
                        <div class="panel-heading"></div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<div>
                            	
                          </div><br>
                            <div class="dataTable_wrapper">
                                <table width="104%" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>NOP
                                            <?=$NOP?></th>
                                            <th>Alamat Objek Pajak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?=$datOP['JALAN_OP']?>
                                           <br>
                                              <?=$datOP['RT_OP']?>
                                              /
                                              <?=$datOP['RW_OP']?><br>
                                              <?=$datOP['NM_KECAMATAN']?><br>
                                              <?=$datOP['NM_KELURAHAN']?><br>Minahasa
                                           </td>
                                            <td><?php while (($datSPPT = oci_fetch_array($sDet))) { ?><?=$datSPPT['NM_WP_SPPT']?><br>
                                            <?=$datSPPT['JLN_WP_SPPT']?>                                              <br></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                          <div class="dataTable_wrapper">
                              <table width="104%" class="table table-striped table-bordered table-hover">
                                <thead>
                                  <tr>
                                    <th width="5%">Tahun</th>
                                    <th width="11%">Nama WP</th>
                                    <th width="19%">Alamat WP</th>
                                    <th width="12%">Luas Bumi/Bangunan</th>
                                    <th width="15%">PBB Harus Dibayar</th>
                                    <th width="15%">Tgl Jatuh Tempo</th>
                                    <th width="14%">Tgl Pembayaran</th>
                                    <th width="14%">Jml Dibayar</th>
                                  </tr>
                                </thead>
                                
                                <tbody>
                                  <tr>
                                    <td><?=$datSPPT['THN_PAJAK_SPPT']?></td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><?=$datSPPT['LUAS_BUMI_SPPT']?>/<?=$datSPPT['LUAS_BNG_SPPT']?></td>
                                    <td><?=$datSPPT['PBB_YG_HARUS_DIBAYAR_SPPT']?></td>
                                    <td><?=$datSPPT['TGL_JATUH_TEMPO_SPPT']?></td>
                                    <td><?=$datSPPT['TGL_PEMBAYARAN_SPPT']?></td>
                                    <td><?=$datSPPT['JML_SPPT_YG_DIBAYAR']?></td>
                                  </tr>
                                 </tbody> <?php } //end of while (($row = oci_fetch_array($sDet))) ?>
                              </table>
                          </div>
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
