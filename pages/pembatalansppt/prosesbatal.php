<?php session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
    header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.
}

$values = array();
for ($i=0; $i < count($_POST['bayar']['THN_PAJAK_SPPT']); $i++) {
$select_latest_pay = "SELECT MAX(PEMBATALAN_SPPT_KE) as PEMBATALAN_SPPT_KE FROM PEMBATALAN_SPPT
    WHERE KD_PROPINSI='".$_POST['bayar']['KD_PROPINSI'][$i]."' and
    KD_DATI2 = '".$_POST['bayar']['KD_DATI2'][$i]."' and
    KD_KECAMATAN = '".$_POST['bayar']['KD_KECAMATAN'][$i]."' and
    KD_KELURAHAN = '".$_POST['bayar']['KD_KELURAHAN'][$i]."' and
    KD_BLOK = '".$_POST['bayar']['KD_BLOK'][$i]."' and
    NO_URUT = '".$_POST['bayar']['NO_URUT'][$i]."' and
    KD_JNS_OP = '".$_POST['bayar']['KD_JNS_OP'][$i]."'
  ";
}

$sel = mysqli_query($conn, $select_latest_pay) or die (mysqli_error($conn));
$pbtl = mysqli_fetch_assoc($sel);
if ($pbtl['PEMBATALAN_SPPT_KE']==0 || !$pbtl['PEMBATALAN_SPPT_KE']) {
  $PBTL = "1";
} else {
  $PBTL = $pbtl['PEMBATALAN_SPPT_KE']+1;
}

if (isset($_POST['prosesbatal']) || isset($_GET['prosesbatal'])) {

    $values = array();
    for ($i=0; $i < count($_POST['bayar']['THN_PAJAK_SPPT']); $i++) {
      $values[] = '(
        "'.$_POST['bayar']['KD_PROPINSI'][$i].'",
        "'.$_POST['bayar']['KD_DATI2'][$i].'",
        "'.$_POST['bayar']['KD_KECAMATAN'][$i].'",
        "'.$_POST['bayar']['KD_KELURAHAN'][$i].'",
        "'.$_POST['bayar']['KD_BLOK'][$i].'",
        "'.$_POST['bayar']['NO_URUT'][$i].'",
        "'.$_POST['bayar']['KD_JNS_OP'][$i].'",
        "'.$_POST['bayar']['THN_PAJAK_SPPT'][$i].'",
        "'.$PBTL.'",
        "'.$_POST['KD_BATAL'].'",
        "'.$_POST['bayar']['KD_KANWIL_BANK'][$i].'",
        "'.$_POST['bayar']['KD_KPPBB_BANK'][$i].'",
        "'.$_POST['bayar']['KD_BANK_TUNGGAL'][$i].'",
        "'.$_POST['bayar']['KD_BANK_PERSEPSI'][$i].'",
        "'.$_POST['bayar']['KD_TP'][$i].'",
        "'.$_POST['bayar']['DENDA_SPPT'][$i].'",
        "'.$_POST['bayar']['JML_SPPT_YG_DIBAYAR'][$i].'",
        "'.$_POST['bayar']['TGL_PEMBAYARAN_SPPT'][$i].'",
        "'.date('Y-m-d', time()).'",
        "'.$_POST['bayar']['NIP_REKAM_BYR_SPPT'][$i].'"
      )';
    }

    $insert_bayar = "INSERT INTO PEMBATALAN_SPPT (KD_PROPINSI, KD_DATI2, KD_KECAMATAN, KD_KELURAHAN, KD_BLOK, NO_URUT, KD_JNS_OP,
                    THN_PAJAK_SPPT, PEMBATALAN_SPPT_KE, KD_BATAL, KD_KANWIL_BANK, KD_KPPBB_BANK, KD_BANK_TUNGGAL, KD_BANK_PERSEPSI, KD_TP,
                  DENDA_SPPT, JML_SPPT_YG_DIBATALKAN, TGL_PEMBATALAN_SPPT, TGL_REKAM_BTL_SPPT, NIP_REKAM_BTL_SPPT) VALUES " . implode(',', $values);

    if (mysqli_query($conn, $insert_bayar) === TRUE) {
      for ($i=0; $i < count($_POST['bayar']['THN_PAJAK_SPPT']); $i++) {
      $update = "UPDATE ALL_SPPT SET PBB_YG_HARUS_DIBAYAR_SPPT = '0' WHERE
                      KD_PROPINSI = '".$_POST['bayar']['KD_PROPINSI'][$i]."' and
                      KD_DATI2='".$_POST['bayar']['KD_DATI2'][$i]."' and
                      KD_KECAMATAN='".$_POST['bayar']['KD_KECAMATAN'][$i]."' and
                      KD_KELURAHAN='".$_POST['bayar']['KD_KELURAHAN'][$i]."' and
                      KD_BLOK='".$_POST['bayar']['KD_BLOK'][$i]."' and
                      NO_URUT='".$_POST['bayar']['NO_URUT'][$i]."' and
                      KD_JNS_OP='".$_POST['bayar']['KD_JNS_OP'][$i]."' and
                      THN_PAJAK_SPPT='".$_POST['bayar']['THN_PAJAK_SPPT'][$i]."'
                      ";

        if (mysqli_query($conn, $update) or die (mysqli_error($conn))) { ?>
          <script type="text/javascript">alert("SPPT berhasil dibatalkan")</script>
          <script type="text/javascript">setTimeout("window.close();", 1000);</script>
        <?php } else { ?>
          <script type="text/javascript">alert("ERROR! SPPT gagal dibatalkan")</script>
          <script type="text/javascript">setTimeout("window.close();", 1000);</script>
        <?php }
  }} else {
    echo "Gagal Update";
  }
} else {
  echo "Tidak ada transaksi";
}
  ?>
