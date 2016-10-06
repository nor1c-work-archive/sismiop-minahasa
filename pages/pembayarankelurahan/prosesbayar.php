<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['bayar']) || isset($_POST['bayar'])) {
  $KD_KECAMATAN = $_POST['KD_KECAMATAN'];
  $KD_KELURAHAN = $_POST['KD_KELURAHAN'];
  $TAHUN = $_POST['tahun'];
?>
<!DOCTYPE html>
<html lang="en">
  <head></head>
  <!-- <body onload="window.print()"> -->
    <ul style="list-style-type:none;">
        <?php
          // $sql2 = "SELECT DISTINCT a.THN_PAJAK_SPPT, b.PBB_YG_HARUS_DIBAYAR_SPPT, b.KD_PROPINSI, b.NM_WP_SPPT, c.NM_TP, d.NM_KECAMATAN, e.NM_KELURAHAN from pembayaran_tes a
          //   LEFT JOIN batal_sppt b
          //   on(a.KD_KELURAHAN=b.KD_KELURAHAN and a.KD_KECAMATAN=b.KD_KECAMATAN and a.KD_BLOK=b.KD_BLOK and a.NO_URUT=b.NO_URUT)
          //   LEFT JOIN tempat_pembayaran c
          //   on(a.KD_KANWIL_BANK=c.KD_KANWIL and a.KD_KPPBB_BANK=c.KD_KPPBB and a.KD_BANK_TUNGGAL=c.KD_BANK_TUNGGAL and a.KD_BANK_PERSEPSI=c.KD_BANK_PERSEPSI and a.KD_TP=c.KD_TP)
          //   LEFT JOIN ref_kecamatan d
          //   on(a.KD_KECAMATAN=d.KD_KECAMATAN)
          //   LEFT JOIN ref_kelurahan e
          //   on(a.KD_KECAMATAN=e.KD_KECAMATAN and a.KD_KELURAHAN=e.KD_KELURAHAN)
          //     where
          //     a.KD_KECAMATAN='".$KD_KECAMATAN."' and
          //     a.KD_KELURAHAN='".$KD_KELURAHAN."'
          //   GROUP BY
          //   a.KD_PROPINSI, a.KD_DATI2, a.KD_KECAMATAN,  a.THN_PAJAK_SPPT, b.PBB_YG_HARUS_DIBAYAR_SPPT
          //   ";

          $sql2 = "select a.*, b.*, c.*, d.* from batal_sppt a
          left join ref_kecamatan b
          on(a.KD_KECAMATAN=b.KD_KECAMATAN)
          left join ref_kelurahan c
          on(a.KD_KECAMATAN=c.KD_KECAMATAN and a.KD_KELURAHAN=c.KD_KELURAHAN)
          left join tempat_pembayaran d
          on(a.KD_KANWIL_BANK=d.KD_KANWIL and a.KD_KPPBB_BANK=d.KD_KPPBB and a.KD_BANK_TUNGGAL=d.KD_BANK_TUNGGAL and a.KD_BANK_PERSEPSI=d.KD_BANK_PERSEPSI and a.KD_TP=d.KD_TP)
          where a.KD_KECAMATAN='".$KD_KECAMATAN."' and a.KD_KELURAHAN='".$KD_KELURAHAN."' and THN_PAJAK_SPPT='".$TAHUN."'
          and THN_PAJAK_SPPT NOT IN(SELECT THN_PAJAK_SPPT from pembayaran_tes)
          ";
          $sqla2 = mysqli_query($conn, $sql2) or die (mysqli_error($conn));
          $i=1;
          while ($data2 = mysqli_fetch_assoc($sqla2)) {
              $bulan2 = date('m', strtotime($data2['TGL_JATUH_TEMPO_SPPT']));

              $thn_sppt = $data2['THN_PAJAK_SPPT'];
              $sppt_tahun =  strtotime($data2['TGL_JATUH_TEMPO_SPPT']);

              $now = strtotime(date('Y-m-d', time()));
              $year_sppt = date('Y', $sppt_tahun);
              $year_now = date('Y', $now);

              $month_sppt = $bulan2;
              $month_now = date('mm', $now);

              if ($year_sppt == date('Y')) {
                $jumlah_bulan = date('m') - $bulan2;
              } else {
                $jumlah_bulan = ((date("Y") - $year_sppt) * 12) + 07 - $bulan2;
              }

              if ($jumlah_bulan < 1) {
                $jumlah_tunggakan_per_bulan = '0';
              } else if ($jumlah_bulan < 24) {
                $jumlah_tunggakan_per_bulan = ((2 * $data2['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100);
              } else if ($jumlah_bulan >= 24) {
                $jumlah_tunggakan_per_bulan = ((2 * $data2['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100);
              }

              if ($jumlah_bulan < 1) {
                $jumlah_tunggakan = '0';
              } else if ($jumlah_bulan < 24) {
                $jumlah_tunggakan = $jumlah_bulan * ((2 * $data2['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100);
              } else if ($jumlah_bulan >= 24) {
                $jumlah_tunggakan = 24 * ((2 * $data2['PBB_YG_HARUS_DIBAYAR_SPPT'])) / 100;
              }

              if ($jumlah_bulan < 1) {
                $jumlah_bulan_denda = '0';
              } else if ($jumlah_bulan >= 24) {
                $jumlah_bulan_denda = '24';
              } else {
                $jumlah_bulan_denda = $jumlah_bulan;
              }

              if ($jumlah_bulan < 1) {
                $jumlah_yg_harus_dibayar = $data2['PBB_YG_HARUS_DIBAYAR_SPPT'];
              } else if ($jumlah_bulan < 24) {
                $jumlah_yg_harus_dibayar = $data2['PBB_YG_HARUS_DIBAYAR_SPPT'] + ($jumlah_bulan * ((2 * $data2['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100));
              } else if ($jumlah_bulan >= 24) {
                $jumlah_yg_harus_dibayar = $data2['PBB_YG_HARUS_DIBAYAR_SPPT'] + (24 * ((2 * $data2['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100));
              }

              if ($jumlah_bulan < 1) {
                $denda = '0';
              } else if ($jumlah_bulan < 24) {
                $denda = round($jumlah_bulan * ((2 * $data2['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100));
              } else if ($jumlah_bulan >= 24) {
                $denda = round(24 * ((2 * $data2['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100));;
              }

              $jth_tempo = date_create($data2['TGL_JATUH_TEMPO_SPPT']);
              $tgl_sekarang = date('Y-m-d', time());
              $tgl_pembayaran = date_create($tgl_sekarang);

              $sql_ke = "select MAX(PEMBAYARAN_SPPT_KE) as PEMBAYARAN_TERAKHIR from PEMBAYARAN_SPPT where
              KD_PROPINSI='".$data2['KD_PROPINSI']."'
              and KD_DATI2='".$data2['KD_DATI2']."'
              and KD_KECAMATAN='".$data2['KD_KECAMATAN']."'
              and KD_KELURAHAN='".$data2['KD_KELURAHAN']."'
              and KD_BLOK='".$data2['KD_BLOK']."'
              and NO_URUT='".$data2['NO_URUT']."'
              and KD_JNS_OP='".$data2['KD_JNS_OP']."'
              ";

              $ke = mysqli_query($conn, $sql_ke) or die (mysqli_error($conn));
              $dke = mysqli_fetch_assoc($ke);
              $terakhir = $dke['PEMBAYARAN_TERAKHIR'];
              $pembayaran_ke = $terakhir+1;

              $insert = "INSERT INTO PEMBAYARAN_TES (KD_PROPINSI, KD_DATI2, KD_KECAMATAN, KD_KELURAHAN, KD_BLOK, NO_URUT, KD_JNS_OP,
                              THN_PAJAK_SPPT, PEMBAYARAN_SPPT_KE, KD_KANWIL_BANK, KD_KPPBB_BANK, KD_BANK_TUNGGAL, KD_BANK_PERSEPSI, KD_TP,
                            DENDA_SPPT, JML_SPPT_YG_DIBAYAR, TGL_PEMBAYARAN_SPPT, TGL_REKAM_BYR_SPPT, NIP_REKAM_BYR_SPPT)
                        VALUES ('$data2[KD_PROPINSI]','$data2[KD_DATI2]','$data2[KD_KECAMATAN]','$data2[KD_KELURAHAN]','$data2[KD_BLOK]','$data2[NO_URUT]','$data2[KD_JNS_OP]',
                        '$data2[THN_PAJAK_SPPT]','$pembayaran_ke','$data2[KD_KANWIL_BANK]','$data2[KD_KPPBB_BANK]','$data2[KD_BANK_TUNGGAL]','$data2[KD_BANK_PERSEPSI]','$data2[KD_TP]',
                      '$denda','$data2[PBB_YG_HARUS_DIBAYAR_SPPT]','$tgl_sekarang','$tgl_sekarang','$_SESSION[NIP]')";

              if (mysqli_query($conn, $insert) or die (mysqli_error($conn))) { ?>

                <li style="float:left;">
                  <div class="" style="width:11.08cm;top:0px;bottom:0px;margin: auto;height:100%;border:solid 1px #fff;margin-top:125px;font-size:17px;letter-spacing:1px;word-spacing:4px;line-height:25px;">
                  <div style="margin-left:50px">
                        <?php if ($i>3) { ?>
                          <div class="" style="margin-top:142px;">

                          </div>
                        <?php } ?>
                    <?=$data2['NM_TP']?>
                  </div>
                  <div style="margin-left:130px"><?=$data2['THN_PAJAK_SPPT']?></div>
                  <div style="margin-left:50px;margin-top:10px"><?=$data2['NM_WP_SPPT']?></div>
                  <div style="margin-left:110px;margin-top:10px"><?=$data2['NM_KECAMATAN']?></div>
                  <div style="margin-left:110px"><?=$data2['NM_KELURAHAN']?></div>
                  <div style="margin-left:50px;margin-top:10px"><?php echo $data2['KD_PROPINSI'] .'-'.
                              $data2['KD_DATI2'] .'-'.
                              $data2['KD_KECAMATAN'] .'-'.
                              $data2['KD_KELURAHAN'] .'-'.
                              $data2['KD_BLOK'].'-'.
                              $data2['NO_URUT'] .'-'.
                              $data2['KD_JNS_OP']?></div>
                  <div style="margin-left:50px;margin-bot:10px"><?=number_format(round($jumlah_yg_harus_dibayar), '0','.','.')?></div>
                  <div style="margin-left:50px;margin-top:15px"><?php echo date_format($jth_tempo, "d-m-Y"); ?></div>

                  <div style="margin-top:30px"></div>
                  <div style="position:absolute;line-height:23px;">
                  <table>
                  <tbody>
                  <tr>
                  <td>
                  <?php

                  if ($denda=="0") {

                    for ($kolom_denda=1; $kolom_denda <= $jumlah_bulan_denda; $kolom_denda++) { ?>

                      <?php if ($kolom_denda <= 12) { ?>
                          <?php if ($jumlah_tunggakan_per_bulan == 0) { ?>

                          <?php } else { ?>
                            <div style="margin-left:0px;margin-top:0px"></div>
                          <?php } ?>
                      <?php } } ?>
                    </td>

                    <td>
                    <?php

                    for ($kolom_denda=1; $kolom_denda <= $jumlah_bulan_denda; $kolom_denda++) { ?>
                      <?php if ($kolom_denda > 12) { ?>
                        <?php if ($jumlah_tunggakan_per_bulan == 0) { ?>

                        <?php } else { ?>
                          <div style="margin-left:250px;margin-top:0px"></div>
                        <?php } ?>
                      <?php } }

                  } else {

                    for ($kolom_denda=1; $kolom_denda <= $jumlah_bulan_denda; $kolom_denda++) { ?>

                      <?php if ($kolom_denda <= 12) { ?>
                          <?php if ($jumlah_tunggakan_per_bulan == 0) { ?>

                          <?php } else { ?>
                            <div style="margin-left:0px;margin-top:0px"><?=number_format(round($data2['PBB_YG_HARUS_DIBAYAR_SPPT'] + ($jumlah_tunggakan_per_bulan * $kolom_denda)), '0','.','.') ?></div>
                          <?php } ?>
                      <?php } } ?>
                    </td>

                    <td>
                    <?php

                    for ($kolom_denda=1; $kolom_denda <= $jumlah_bulan_denda; $kolom_denda++) { ?>
                      <?php if ($kolom_denda > 12) { ?>
                        <?php if ($jumlah_tunggakan_per_bulan == 0) { ?>

                        <?php } else { ?>
                          <div style="margin-left:250px;margin-top:0px"><?=number_format(round($data2['PBB_YG_HARUS_DIBAYAR_SPPT'] + ($jumlah_tunggakan_per_bulan * $kolom_denda)), '0','.','.') ?></div>
                        <?php } ?>
                      <?php } }

                  }
                  ?>
                  </td>
                  </tr>
                  </tbody>
                  </table>
                  </div>

                  <div style="margin-left:50px;margin-top:315px;"><?=date_format($tgl_pembayaran, "d-m-Y")?></div>
                  <div style="margin-left:50px;margin-top:30px"><?=number_format(round($jumlah_yg_harus_dibayar), '0','.','.')?></div>
                  <br>
                  <br>
                  <br>
                  <br>
                  <div style="margin-left:50px;margin-top:53px;"><?=$data2['NM_TP']?></div>
                  <div style="margin-left:130px"><?=$data2['THN_PAJAK_SPPT']?></div>
                  <div style="margin-left:50px;margin-top:8px"><?=$data2['NM_WP_SPPT']?></div>
                  <div style="margin-left:110px"><?=$data2['NM_KECAMATAN']?></div>
                  <div style="margin-left:110px;margin-top:5px"><?=$data2['NM_KELURAHAN']?></div>
                  <div style="margin-left:50px"><?php echo $data2['KD_PROPINSI'] .'-'.
                              $data2['KD_DATI2'] .'-'.
                              $data2['KD_KECAMATAN'] .'-'.
                              $data2['KD_KELURAHAN'] .'-'.
                              $data2['KD_BLOK'].'-'.
                              $data2['NO_URUT'] .'-'.
                              $data2['KD_JNS_OP']?></div>
                  <div style="margin-left:50px;margin-top:5px"><?=number_format(round($data2['PBB_YG_HARUS_DIBAYAR_SPPT']),'0','.','.')?></div>
                  <div style="margin-left:50px;line-height:24px;margin-top:8px"><?=date_format($tgl_pembayaran, "d-m-Y")?></div>
                  <div style="margin-left:50px;line-height:20px"><?=number_format(round($jumlah_yg_harus_dibayar), '0','.','.')?></div>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <br>
                  <div style="margin-left:50px;margin-top:42px"><?php echo $data2['KD_PROPINSI'] .'-'.
                              $data2['KD_DATI2'] .'-'.
                              $data2['KD_KECAMATAN'] .'-'.
                              $data2['KD_KELURAHAN'] .'-'.
                              $data2['KD_BLOK'].'-'.
                              $data2['NO_URUT'] .'-'.
                              $data2['KD_JNS_OP']?></div>
                  <div style="margin-left:50px;"><?=number_format(round($data2['PBB_YG_HARUS_DIBAYAR_SPPT']),'0','.','.')?></div>
                  <div style="margin-left:50px;margin-top:5px"><?=date_format($tgl_pembayaran, "d-m-Y")?></div>
                  <div style="margin-left:80px;"><?=number_format(round($jumlah_yg_harus_dibayar), '0','.','.')?></div>
                  <br>
                  <br>
                  <br>
                  <br>
                  <div style="margin-left:50px;margin-top:45px"><?=$data2['NM_TP']?></div>
                  <div style="margin-left:130px"><?=$data2['THN_PAJAK_SPPT']?></div>
                  <div style="margin-left:50px;margin-top:5px"><?=$data2['NM_WP_SPPT']?></div>
                  <div style="margin-left:110px"><?=$data2['NM_KECAMATAN']?></div>
                  <div style="margin-left:110px"><?=$data2['NM_KELURAHAN']?></div>
                  <div style="margin-left:50px;margin-top:0px"><?php echo $data2['KD_PROPINSI'] .'-'.
                              $data2['KD_DATI2'] .'-'.
                              $data2['KD_KECAMATAN'] .'-'.
                              $data2['KD_KELURAHAN'] .'-'.
                              $data2['KD_BLOK'].'-'.
                              $data2['NO_URUT'] .'-'.
                              $data2['KD_JNS_OP']?></div>
                  <div style="margin-left:50px;margin-top:7px"><?=number_format(round($data2['PBB_YG_HARUS_DIBAYAR_SPPT']),'0','.','.')?></div>
                  <div style="margin-left:50px;margin-top:5px"><?=date_format($tgl_pembayaran, "d-m-Y")?></div>
                  <div style="margin-left:80px;"><?=number_format(round($jumlah_yg_harus_dibayar), '0','.','.')?></div>
                  <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                  </div>
                </li>

            <?php } else {
              echo "Gagal Insert";
            }
            $i++;
          }
          ?>
        </ul>
  </body>
</html>

<?php } else {
  echo "Tidak ada proses";
} ?>
