<?php
    session_start();//session starts here
	include '../../bin/dbconn.php';
   	$NOMULIR = $_POST['form1'].$_POST['form2'].$_POST['form3'];
    $sel_prov="select count(*) as JUMLAH from dat_objek_pajak where NO_FORMULIR_SPOP='".$NOMULIR."' LIMIT 1";
    $q=mysqli_query($conn, $sel_prov);
    $data = mysqli_fetch_assoc($q);
	if ($data['JUMLAH'] > 0) {
		echo 0;
	} else {
		echo 1;
	}
?>