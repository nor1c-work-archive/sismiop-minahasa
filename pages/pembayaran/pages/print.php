<?php

if (isset($_POST['simpan']) || isset($_GET['simpan'])) {

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
        "'.$_POST['bayar']['PEMBAYARAN_SPPT_KE'][$i].'",
        "'.$_POST['bayar']['KD_KANWIL_BANK'][$i].'",
        "'.$_POST['bayar']['KD_KPPBB_BANK'][$i].'",
        "'.$_POST['bayar']['KD_BANK_TUNGGAL'][$i].'",
        "'.$_POST['bayar']['KD_BANK_PERSEPSI'][$i].'",
        "'.$_POST['bayar']['KD_TP'][$i].'",
        "'.$_POST['bayar']['DENDA_SPPT'][$i].'",
        "'.$_POST['bayar']['JML_SPPT_YG_DIBAYAR'][$i].'",
        "'.$_POST['bayar']['TGL_PEMBAYARAN_SPPT'][$i].'",
        "'.$_POST['bayar']['TGL_REKAM_BYR_SPPT'][$i].'",
        "'.$_POST['bayar']['NIP_REKAM_BYR_SPPT'][$i].'"
      )';
    }
    $insert_bayar = "INSERT INTO PEMBAYARAN_TES (KD_PROPINSI, KD_DATI2, KD_KECAMATAN, KD_KELURAHAN, KD_BLOK, NO_URUT, KD_JNS_OP,
                    THN_PAJAK_SPPT, PEMBAYARAN_SPPT_KE, KD_KANWIL_BANK, KD_KPPBB_BANK, KD_BANK_TUNGGAL, KD_BANK_PERSEPSI, KD_TP,
                  DENDA_SPPT, JML_SPPT_YG_DIBAYAR, TGL_PEMBAYARAN_SPPT, TGL_REKAM_BYR_SPPT, NIP_REKAM_BYR_SPPT) VALUES " . implode(',', $values);

    if (mysqli_query($conn, $insert_bayar) === TRUE) {
      ?>

        <?php

        $values = array();
        for ($i=0; $i < count($_POST['bayar']['THN_PAJAK_SPPT']); $i++) {
          echo $_POST['bayar']['KD_PROPINSI'][$i];
          echo $_POST['bayar']['KD_DATI2'][$i];
          echo $_POST['bayar']['KD_KECAMATAN'][$i];
          echo $_POST['bayar']['KD_KELURAHAN'][$i];
          echo $_POST['bayar']['KD_BLOK'][$i];
          echo $_POST['bayar']['NO_URUT'][$i];
          echo $_POST['bayar']['KD_JNS_OP'][$i];
          echo $_POST['bayar']['THN_PAJAK_SPPT'][$i];
          echo $_POST['bayar']['PEMBAYARAN_SPPT_KE'][$i];
          echo $_POST['bayar']['KD_KANWIL_BANK'][$i];
          echo $_POST['bayar']['KD_KPPBB_BANK'][$i];
          echo $_POST['bayar']['KD_BANK_TUNGGAL'][$i];
          echo $_POST['bayar']['KD_BANK_PERSEPSI'][$i];
          echo $_POST['bayar']['KD_TP'][$i];
          echo $_POST['bayar']['DENDA_SPPT'][$i];
          echo $_POST['bayar']['JML_SPPT_YG_DIBAYAR'][$i];
          echo $_POST['bayar']['TGL_PEMBAYARAN_SPPT'][$i];
          echo $_POST['bayar']['TGL_REKAM_BYR_SPPT'][$i];
          echo $_POST['bayar']['NIP_REKAM_BYR_SPPT'][$i];
        }

        ?>


      <?php
    } else {
      echo "Transaksi Gagal";
    }
  }

  ?>
