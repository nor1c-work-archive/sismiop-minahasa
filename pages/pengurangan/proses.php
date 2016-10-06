<?php
    session_start();//session starts here
	include '../../bin/dbconn.php';
   	
    $sel_prov="select count(*) as JUMLAH from dat_objek_pajak where KD_KECAMATAN='".$_POST['kecamatan']."' and KD_KELURAHAN='".$_POST['kelurahan']."' and KD_BLOK='".$_POST['blok']."' and NO_URUT='".$_POST['no_urut']."' and KD_JNS_OP='".$_POST['jenis_op']."' LIMIT 1";
    $q=mysqli_query($conn, $sel_prov);
    $data = mysqli_fetch_assoc($q);
	if ($data['JUMLAH'] > 0) {
		echo 0;
	} else {
		echo 1;
	}
?>