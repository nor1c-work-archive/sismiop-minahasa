<?php
    session_start();//session starts here
	include '../../bin/dbconn.php';
   	
    $sel_prov="select * from ref_kelurahan where KD_KECAMATAN='".$_POST['kecamatan']."'";
    $q=mysqli_query($conn, $sel_prov);
    while($data_prov=mysqli_fetch_array($q)) {
   
    ?>
        <option value="<?php echo $data_prov['KD_KELURAHAN'] ?>"><?=$data_prov['KD_KELURAHAN']?> - <?php echo $data_prov['NM_KELURAHAN'] ?></option><br>
   
    <?php
    }
    ?>