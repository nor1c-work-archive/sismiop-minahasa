    <?php
    session_start();//session starts here
    include '../../bin/dbconn.php';
    $KD_KECAMATAN = $_POST['kecamatan'];
    $KD_KELURAHAN = $_POST['kelurahan'];
    $TAHUN        = $_POST['tahun'];

    $totals = "select SUM(PBB_YG_HARUS_DIBAYAR_SPPT) as JUMLAH from ALL_SPPT where KD_KECAMATAN='".$KD_KECAMATAN."' and 
    KD_KELURAHAN='".$KD_KELURAHAN."' and THN_PAJAK_SPPT='".$TAHUN."';
    ";
    $totalq = mysqli_query($conn, $totals) or die(mysqli_error($conn));
    $dattotal = mysqli_fetch_assoc($totalq);
   
    ?>
    
    <?=number_format($dattotal['JUMLAH'],'0','.','.')?>
