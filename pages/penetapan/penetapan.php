<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") { ?>

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
                    <h1 class="page-header">Penetapan Massal</h1>
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
                            <i class="glyphicon glyphicon-home"></i> Home &gt; Penetapan &gt; Penetapan Massal
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                          <div class="panel">
                            <form action="penetapan-massal.php" method="post">
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
                                            <!-- KEL -->
                                        </select>
                                    </td>
                                    <td style="width:30%;padding-right:5px;">
                                        <select id="tahun" name="tahun" class="form-control">
                                            <option>PILIH TAHUN</option>
                                            <option value="2001">2001</option>
                                            <option value="2002">2002</option>
                                            <option value="2003">2003</option>
                                            <option value="2004">2004</option>
                                            <option value="2005">2005</option>
                                            <option value="2006">2006</option>
                                            <option value="2007">2007</option>
                                            <option value="2008">2008</option>
                                            <option value="2009">2009</option>
                                            <option value="2010">2010</option>
                                            <option value="2011">2011</option>
                                            <option value="2012">2012</option>
                                            <option value="2013">2013</option>
                                            <option value="2014">2014</option>
                                            <option value="2015">2015</option>
                                            <option value="2016">2016</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                          </div>

                          <table style="float:right;">
                            <tr>
                              <td>
                                <input type="submit" name="next" value="Next" class="btn btn-primary" >
                                <a href="spop.php" class="btn btn-default" >Batal</a>
                            </form>
                              </td>
                            </tr>
                          </table>

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
        <script>
            $(document).ready(function (){
 
                var checked = false;
 
                $('#checkbtn').click(function (){
 
                    var KD_KECAMATAN = $('input[name="KD_KECAMATAN"]').val();
                    var KD_KELURAHAN = $('input[name="KD_KELURAHAN"]').val();
                    var KD_BLOK = $('input[name="KD_BLOK"]').val();
                    var NO_URUT = $('input[name="NO_URUT"]').val();
                    var KD_JNS_OP = $('input[name="KD_JNS_OP"]').val();
                    $.post(
                        'proses.php',
                        { kecamatan : KD_KECAMATAN, kelurahan : KD_KELURAHAN, blok : KD_BLOK, no_urut : NO_URUT, jenis_op : KD_JNS_OP },
                        function (data)
                        {
                            if (data == 1) {
                              $('#check').html("<span style='color:green'>NOP Dapat Digunakan</span>");
                            } else {
                              $('#check').html("<span style='color:red'>NOP Sudah Digunakan</span>");
                            }
                        }
                    );
                    if(KD_KECAMATAN == '' || KD_KELURAHAN == '' || KD_BLOK == '' || NO_URUT == '' || KD_JNS_OP == '') {
                      $('#check').html("Silahkan Diisi Terlebih Dahulu");
                    }
                });
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
   if ($_SESSION['ROLE']=="PEMBATALAN") {
     header("Location: ../pembatalan/index.php");
   } else {
     header("Location: ../../index.php");
   }
} ?>
