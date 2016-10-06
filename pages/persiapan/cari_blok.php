<?php
    session_start();//session starts here
    include '../../bin/dbconn.php';
        
    $sel_prov="select DISTINCT(KD_BLOK) as KD_BLOK from DAT_PETA_ZNT where KD_KECAMATAN='".$_POST['kecamatan']."' and KD_KELURAHAN='".$_POST['kelurahan']."'";
    $q=mysqli_query($conn, $sel_prov);
    while($data_prov=mysqli_fetch_array($q)) {
?>
        <option value="<?php echo $data_prov['KD_BLOK'] ?>"><?php echo $data_prov['KD_BLOK'] ?></option><br>
       
<?php } ?>