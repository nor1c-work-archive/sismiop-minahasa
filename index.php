<?php session_start();
include 'bin/dbconn.php';

if (isset($_SESSION['NM_LOGIN'])) {
  header("Location: pages/index.php"); } ?>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SISMIOP PBB | PEMKAB. MINAHASA</title>
    <link href="./bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="./bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4" style="margin-top:3%;">
            <center><img src="./pages/images/minahasa-logo-logonscreen.png" height="250px"></center>
            <br>
                <div class="login-panel panel panel-default" style="box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12);">
                    <div class="panel-heading">
                        <h3 class="panel-title"><center>SISTEM INFORMASI MANAJEMEN PAJAK BUMI DAN BANGUNAN<br>PEMKAB. MINAHASA</h3></center>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="index.php">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="NM_LOGIN" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="PASSWORD" type="password" value="">
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="LOGIN" name="login">
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
<?php
        $computer_name = gethostbyaddr($_SERVER['REMOTE_ADDR']); if(isset($_POST['login'])) {
        $_IP_SERVER = $_SERVER['SERVER_ADDR'];
        $_IP_ADDRESS = $_SERVER['REMOTE_ADDR'];
        if($_IP_ADDRESS == $_IP_SERVER)
        {
            ob_start(); // Turn on output buffering
            system('ipconfig /all'); //Execute external program to display output
            $mycom=ob_get_contents(); // Capture the output into a variable
            ob_clean(); // Clean (erase) the output buffer
            $findme = "Physical";
            $pmac = strpos($mycom, $findme); // Find the position of Physical text
            $mac=substr($mycom,($pmac+36),17); // Get Physical Address
            echo $mac;
        } else {
            $_PERINTAH = "arp -a $_IP_ADDRESS";
            ob_start();
            system($_PERINTAH);
            $_HASIL = ob_get_contents();
            ob_clean();
            $_PECAH = strstr($_HASIL, $_IP_ADDRESS);
            $_PECAH_STRING = explode($_IP_ADDRESS, str_replace(" ", "", $_PECAH));
            echo $mac = substr($_PECAH_STRING[1], 0, 17);
        }

        $NM_LOGIN=$_POST['NM_LOGIN'];
        $PASSWORD=md5($_POST['PASSWORD']);
        $check_user="select * from DAT_LOGIN WHERE
          NM_LOGIN='$NM_LOGIN' AND
          PASSWORD='$PASSWORD' AND
          STATUS='AKTIF'
          ";
        // MAC_ADDRESS='$mac' AND COMPUTER_NAME='$computer_name'
      	$s = mysqli_query($conn, $check_user) or die (mysqli_error($conn));

        if($row=mysqli_fetch_assoc($s)) {
            if ($row['ROLE']=="LOKET") {
              echo "<script>window.open('pages/pembayaran/index.php','_self')</script>";
            } else if ($row['ROLE']=="PEMBATALAN") {
              echo "<script>window.open('pages/pembatalan/index.php','_self')</script>";
            } else {
              echo "<script>window.open('pages/index.php','_self')</script>";
            }

            $_SESSION['ID']=$row['ID'];
            $_SESSION['NM_LOGIN']=$NM_LOGIN;
            $_SESSION['KD_KANWIL_BANK']=$row['KD_KANWIL'];
            $_SESSION['KD_KPPBB_BANK']=$row['KD_KPPBB'];
            $_SESSION['KD_BANK_TUNGGAL']=$row['KD_BANK_TUNGGAL'];
            $_SESSION['KD_BANK_PERSEPSI']=$row['KD_BANK_PERSEPSI'];
            $_SESSION['KD_TP']=$row['KD_TP'];
            $_SESSION['NIP']=$row['NIP'];
            $_SESSION['MAC_ADDRESS']=$row['MAC_ADDRESS'];
    		$_SESSION['ROLE']=$row['ROLE'];
        } else {
          echo "<script>alert('Username atau Password salah!')</script>";
        }
    }

?>
