<?php
    session_start();//session starts here
    include '../../bin/dbconn.php';

    $sel_prov="select * from PEKERJAAN_KEGIATAN where KD_PEKERJAAN='".$_POST['pekerjaan']."'";
    $q=mysqli_query($conn, $sel_prov);
    while($data_prov=mysqli_fetch_array($q)) {
?>
        <option value="<?php echo $data_prov['KD_KEGIATAN'] ?>"><?php echo $data_prov['KD_KEGIATAN'].' - '.$data_prov['NM_KEGIATAN']?></option><br>

<?php } ?>
