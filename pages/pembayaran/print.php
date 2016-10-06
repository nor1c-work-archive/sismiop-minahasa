<?php

session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
    header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.
}

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
    $insert_bayar = "INSERT INTO PEMBAYARAN_SPPT (KD_PROPINSI, KD_DATI2, KD_KECAMATAN, KD_KELURAHAN, KD_BLOK, NO_URUT, KD_JNS_OP,
                    THN_PAJAK_SPPT, PEMBAYARAN_SPPT_KE, KD_KANWIL_BANK, KD_KPPBB_BANK, KD_BANK_TUNGGAL, KD_BANK_PERSEPSI, KD_TP,
                  DENDA_SPPT, JML_SPPT_YG_DIBAYAR, TGL_PEMBAYARAN_SPPT, TGL_REKAM_BYR_SPPT, NIP_REKAM_BYR_SPPT) VALUES " . implode(',', $values);

    if (mysqli_query($conn, $insert_bayar) === TRUE) {
      ?>

        <!DOCTYPE html>
        <html>
          <head>
            <meta charset="utf-8">
            <title></title>
          </head>
          <style media="screen">
            html, body {
              letter-spacing: 9px;
            }
          </style>
            <body onload="window.print()">
            <div class="" style="">
            <?php

            $KDKANWIL = $_POST['KDKANWIL'];
            $KDKPPBB = $_POST['KDKPPBB'];
            $KDBANKTUNGGAL = $_POST['KDBANKTUNGGAL'];
            $KDBANKPERSEPSI = $_POST['KDBANKPERSEPSI'];
            $KDTP = $_POST['KDTP'];

            $tempat_pembayaran = "SELECT * FROM tempat_pembayaran WHERE
              KD_KANWIL = '".$_SESSION['KD_KANWIL_BANK']."' and
              KD_KPPBB = '".$_SESSION['KD_KPPBB_BANK']."' and
              KD_BANK_TUNGGAL = '".$_SESSION['KD_BANK_TUNGGAL']."' and
              KD_BANK_PERSEPSI = '".$_SESSION['KD_BANK_PERSEPSI']."' and
              KD_TP = '".$_SESSION['KD_TP']."'
            ";
            $tpp = mysqli_query($conn, $tempat_pembayaran) or die (mysqli_error($conn));
            $tp = mysqli_fetch_assoc($tpp);

            $kecamatan = "SELECT * FROM REF_KECAMATAN WHERE
              KD_PROPINSI = '".$_POST['KD_PROPINSI']."' and
              KD_DATI2 = '".$_POST['KD_DATI2']."' and
              KD_KECAMATAN = '".$_POST['KD_KECAMATAN']."'
            ";
            $kecc = mysqli_query($conn, $kecamatan);
            $kec = mysqli_fetch_assoc($kecc);

            $kelurahan = "SELECT * FROM REF_KELURAHAN WHERE
              KD_PROPINSI = '".$_POST['KD_PROPINSI']."' and
              KD_DATI2 ='".$_POST['KD_DATI2']."' and
              KD_KECAMATAN = '".$_POST['KD_KECAMATAN']."' and
              KD_KELURAHAN = '".$_POST['KD_KELURAHAN']."'
            ";
            $kell = mysqli_query($conn, $kelurahan);
            $kel = mysqli_fetch_assoc($kell);

            $values = array();
            for ($i=0; $i < count($_POST['bayar']['THN_PAJAK_SPPT']); $i++) {

              // SECTION 1
              $jth_tempo = date_create($_POST['bayar']['TGL_JATUH_TEMPO_SPPT'][$i]);
              $tgl_pembayaran = date_create($_POST['bayar']['TGL_PEMBAYARAN_SPPT'][$i])
              ?>
              <div class="" style="height:100%;margin-top:125px;font-size:17px;letter-spacing:1px;word-spacing:4px;line-height:25px;">
              <div style="margin-left:50px">
                <?php if ($i>0) { ?>
                  <div class="" style="margin-top:125px;">

                  </div>
                <?php } ?>
                <?=$tp['NM_TP']?>
              </div>
              <div style="margin-left:130px"><?=$_POST['bayar']['THN_PAJAK_SPPT'][$i]?></div>
              <div style="margin-left:50px;margin-top:10px"><?=$_POST['bayar']['NM_WP_SPPT'][$i]?></div>
              <div style="margin-left:110px;margin-top:10px"><?=$kec['NM_KECAMATAN']?></div>
              <div style="margin-left:110px"><?=$kel['NM_KELURAHAN']?></div>
              <div style="margin-left:50px;margin-top:10px"><?php echo $_POST['bayar']['KD_PROPINSI'][$i] .'-'.
                          $_POST['bayar']['KD_DATI2'][$i] .'-'.
                          $_POST['bayar']['KD_KECAMATAN'][$i] .'-'.
                          $_POST['bayar']['KD_KELURAHAN'][$i] .'-'.
                          $_POST['bayar']['KD_BLOK'][$i].'-'.
                          $_POST['bayar']['NO_URUT'][$i] .'-'.
                          $_POST['bayar']['KD_JNS_OP'][$i]?></div>
              <div style="margin-left:50px;margin-bot:10px"><?=number_format(round($_POST['bayar']['SEJUMLAH_RP'][$i]), '0','.','.')?></div>
              <div style="margin-left:50px;margin-top:15px"><?php echo date_format($jth_tempo, "d-m-Y"); ?></div>

              <div style="margin-top:30px"></div>
              <div style="position:absolute;line-height:23px;">
              <table>
              <tbody>
              <tr>
              <td>
              <?php

              for ($kolom_denda=1; $kolom_denda <= $_POST['bayar']['JUMLAH_BULAN_DENDA'][$i]; $kolom_denda++) { ?>

                <?php if ($kolom_denda <= 12) { ?>
                    <?php if ($_POST['bayar']['DENDA_SPPT_PER_BULAN'][$i] == 0) { ?>

                    <?php } else { ?>
                      <div style="margin-left:0px;margin-top:0px"><?=number_format(round($_POST['bayar']['JML_SPPT_YG_DIBAYAR'][$i] + ($_POST['bayar']['DENDA_SPPT_PER_BULAN'][$i] * $kolom_denda)), '0','.','.') ?></div>
                    <?php } ?>
                <?php } } ?>
              </td>

              <td>
              <?php

              for ($kolom_denda=1; $kolom_denda <= $_POST['bayar']['JUMLAH_BULAN_DENDA'][$i]; $kolom_denda++) { ?>
                <?php if ($kolom_denda > 12) { ?>
                  <?php if ($_POST['bayar']['DENDA_SPPT_PER_BULAN'][$i] == 0) { ?>

                  <?php } else { ?>
                    <div style="margin-left:250px;margin-top:0px"><?=number_format(round($_POST['bayar']['JML_SPPT_YG_DIBAYAR'][$i] + ($_POST['bayar']['DENDA_SPPT_PER_BULAN'][$i] * $kolom_denda)), '0','.','.') ?></div>
                  <?php } ?>
                <?php } } ?>
              </td>
              </tr>
              </tbody>
              </table>
              </div>

              <div style="margin-left:50px;margin-top:315px;"><?=date_format($tgl_pembayaran, "d-m-Y")?></div>
              <div style="margin-left:50px;margin-top:30px;"><?=number_format(round($_POST['bayar']['SEJUMLAH_RP'][$i]), '0','.','.')?></div>
              <br>
              <br>
              <br>
              <br>
              <div style="margin-left:50px;margin-top:53px;"><?=$tp['NM_TP']?></div>
              <div style="margin-left:130px"><?=$_POST['bayar']['THN_PAJAK_SPPT'][$i]?></div>
              <div style="margin-left:50px;margin-top:8px"><?=$_POST['bayar']['NM_WP_SPPT'][$i]?></div>
              <div style="margin-left:110px"><?=$kec['NM_KECAMATAN']?></div>
              <div style="margin-left:110px;margin-top:5px"><?=$kel['NM_KELURAHAN']?></div>
              <div style="margin-left:50px"><?php echo $_POST['bayar']['KD_PROPINSI'][$i] .'-'.
                          $_POST['bayar']['KD_DATI2'][$i] .'-'.
                          $_POST['bayar']['KD_KECAMATAN'][$i] .'-'.
                          $_POST['bayar']['KD_KELURAHAN'][$i] .'-'.
                          $_POST['bayar']['KD_BLOK'][$i].'-'.
                          $_POST['bayar']['NO_URUT'][$i] .'-'.
                          $_POST['bayar']['KD_JNS_OP'][$i]?></div>
              <div style="margin-left:50px;margin-top:5px"><?=number_format(round($_POST['bayar']['JML_SPPT_YG_DIBAYAR'][$i]),'0','.','.')?></div>
              <div style="margin-left:50px;line-height:24px;margin-top:8px"><?=date_format($tgl_pembayaran, "d-m-Y")?></div>
              <div style="margin-left:80px;line-height:20px"><?=number_format(round($_POST['bayar']['SEJUMLAH_RP'][$i]), '0','.','.')?></div>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <div style="margin-left:50px;margin-top:42px"><?php echo $_POST['bayar']['KD_PROPINSI'][$i] .'-'.
                          $_POST['bayar']['KD_DATI2'][$i] .'-'.
                          $_POST['bayar']['KD_KECAMATAN'][$i] .'-'.
                          $_POST['bayar']['KD_KELURAHAN'][$i] .'-'.
                          $_POST['bayar']['KD_BLOK'][$i].'-'.
                          $_POST['bayar']['NO_URUT'][$i] .'-'.
                          $_POST['bayar']['KD_JNS_OP'][$i]?></div>
              <div style="margin-left:50px;"><?=number_format(round($_POST['bayar']['JML_SPPT_YG_DIBAYAR'][$i]),'0','.','.')?></div>
              <div style="margin-left:50px;margin-top:5px"><?=date_format($tgl_pembayaran, "d-m-Y")?></div>
              <div style="margin-left:80px"><?=number_format(round($_POST['bayar']['SEJUMLAH_RP'][$i]), '0','.','.')?></div>
              <br>
              <br>
              <br>
              <br>
              <div style="margin-left:50px;margin-top:45px"><?=$tp['NM_TP']?></div>
              <div style="margin-left:130px"><?=$_POST['bayar']['THN_PAJAK_SPPT'][$i]?></div>
              <div style="margin-left:50px;margin-top:5px"><?=$_POST['bayar']['NM_WP_SPPT'][$i]?></div>
              <div style="margin-left:110px"><?=$kec['NM_KECAMATAN']?></div>
              <div style="margin-left:110px"><?=$kel['NM_KELURAHAN']?></div>
              <div style="margin-left:50px;margin-top:0px"><?php echo $_POST['bayar']['KD_PROPINSI'][$i] .'-'.
                          $_POST['bayar']['KD_DATI2'][$i] .'-'.
                          $_POST['bayar']['KD_KECAMATAN'][$i] .'-'.
                          $_POST['bayar']['KD_KELURAHAN'][$i] .'-'.
                          $_POST['bayar']['KD_BLOK'][$i].'-'.
                          $_POST['bayar']['NO_URUT'][$i] .'-'.
                          $_POST['bayar']['KD_JNS_OP'][$i]?></div>
              <div style="margin-left:50px;margin-top:7px"><?=number_format(round($_POST['bayar']['JML_SPPT_YG_DIBAYAR'][$i]),'0','.','.')?></div>
              <div style="margin-left:50px;margin-top:5px"><?=date_format($tgl_pembayaran, "d-m-Y")?></div>
              <div style="margin-left:80px"><?=number_format(round($_POST['bayar']['SEJUMLAH_RP'][$i]), '0','.','.')?></div>

              <!-- // GA KEPAKE -->

              </div>
              <?php
                }
              ?>
            <script type="text/javascript">setTimeout("window.close();", 1000);</script>
          </body>
        </html>


      <?php
      }
      else {
        echo "Transaksi Gagal";
      }
    }

  ?>
