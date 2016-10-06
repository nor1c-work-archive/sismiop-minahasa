<?php

session_start();
include '../../bin/dbconn.php';

if (!$_SESSION['NM_LOGIN']) {
  header('Location: ../../index.php');
}

?>

<?php

if (isset($_POST['print']) || isset($_GET['print'])) {
  ?>

  <!DOCTYPE html>
  <html>
    <head>
      <meta charset="utf-8">
      <title></title>
    </head>
    <body onload="window.print()">
      tes print
    </body>
  </html>

  <?php
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="../../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
    <link href="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
    <link href="../../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
    <link href="../../dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>
function confirmation() {

	return confirm('Do you want to enter parts?');
}
</script>

  </head>
  <body>

    <div class="wrapper" style="padding:10px;">
      <div id="frame">
        <?php
        if (isset($_POST['bayar']) || isset($_GET['bayar']))  {
          $KD_PROPINSI = $_POST['KD_PROPINSI'];
          $KD_DATI2 = $_POST['KD_DATI2'];
          $KD_KECAMATAN = $_POST['KD_KECAMATAN'];
          $KD_KELURAHAN = $_POST['KD_KELURAHAN'];
          $KD_BLOK = $_POST['KD_BLOK'];
          $NO_URUT = $_POST['NO_URUT'];
          $KD_JNS_OP = $_POST['KD_JNS_OP'];
          $THN_PAJAK_SPPT = $_POST['THN_PAJAK_SPPT'];
          $PBB_T = $_POST['PBB_YG_HARUS_DIBAYAR_SPPT'];
          $NM_WP_SPPT = $_POST['NM_WP_SPPT'];

          ?>

          <form class="" action="print.php?simpan" method="post">


              <div class="dataTable_wrapper">
                  <table width="104%" class="table table-striped table-bordered table-hover">
                      <thead>
                        <td>Tahun</td>
                        <td>Denda</td>
                        <td>Jumlah SPPT</td>
                        <td>Total yang harus dibayar</td>
                      </thead>
          <?php

          $total=0;
          foreach ($_POST['select_bayar'] as $tahun) {

             $q = "select a.KD_PROPINSI, a.KD_DATI2, a.KD_KECAMATAN, a.KD_KELURAHAN, a.KD_BLOK, a.NO_URUT, a.KD_JNS_OP, a.PBB_YG_HARUS_DIBAYAR_SPPT, a.PBB_TERHUTANG_SPPT, a.THN_PAJAK_SPPT, a.TGL_JATUH_TEMPO_SPPT, a.KD_KANWIL_BANK, a.KD_KPPBB_BANK, a.KD_BANK_TUNGGAL, a.KD_BANK_PERSEPSI, a.KD_TP, b.THN_PENG_PERMANEN_AKHIR, b.THN_PENG_PERMANEN_AWAL, b.PCT_PENGURANGAN_PERMANEN
             from ALL_SPPT a 
             LEFT JOIN PENGURANGAN_PERMANEN b on (a.KD_PROPINSI=b.KD_PROPINSI_PEMOHON and a.KD_DATI2=b.KD_DATI2_PEMOHON and a.KD_KECAMATAN=b.KD_KECAMATAN_PEMOHON and a.KD_KELURAHAN=b.KD_KELURAHAN_PEMOHON and a.KD_BLOK=b.KD_BLOK_PEMOHON and a.NO_URUT=b.NO_URUT_PEMOHON and a.KD_JNS_OP=b.KD_JNS_OP_PEMOHON)
              where   
             a.KD_PROPINSI='".$KD_PROPINSI."'
             and a.KD_DATI2='".$KD_DATI2."'
             and a.KD_KECAMATAN='".$KD_KECAMATAN."'
             and a.KD_KELURAHAN='".$KD_KELURAHAN."'
             and a.KD_BLOK='".$KD_BLOK."'
             and a.NO_URUT='".$NO_URUT."'
             and a.KD_JNS_OP='".$KD_JNS_OP."'
             and b.KD_PROPINSI_PEMOHON='".$KD_PROPINSI."'
             and b.KD_DATI2_PEMOHON='".$KD_DATI2."'
             and b.KD_KECAMATAN_PEMOHON='".$KD_KECAMATAN."'
             and b.KD_KELURAHAN_PEMOHON='".$KD_KELURAHAN."'
             and b.KD_BLOK_PEMOHON='".$KD_BLOK."'
             and b.NO_URUT_PEMOHON='".$NO_URUT."'
             and b.KD_JNS_OP_PEMOHON='".$KD_JNS_OP."'
             and a.THN_PAJAK_SPPT='".$tahun."'
             GROUP BY a.KD_PROPINSI, a.KD_DATI2, a.KD_KECAMATAN, a.KD_KELURAHAN, a.KD_BLOK, a.NO_URUT, a.KD_JNS_OP, a.PBB_YG_HARUS_DIBAYAR_SPPT, a.PBB_TERHUTANG_SPPT, a.THN_PAJAK_SPPT, a.TGL_JATUH_TEMPO_SPPT, a.KD_KANWIL_BANK, a.KD_KPPBB_BANK, a.KD_BANK_TUNGGAL, a.KD_BANK_PERSEPSI, a.KD_TP, a.NM_WP_SPPT, a.JLN_WP_SPPT, a.RW_WP_SPPT, a.RT_WP_SPPT, a.KELURAHAN_WP_SPPT, a.KOTA_WP_SPPT
             order by a.THN_PAJAK_SPPT
             ";

             $s = mysqli_query($conn, $q) or die (mysqli_error($conn));

             $sql_ke = "select MAX(PEMBAYARAN_SPPT_KE) as PEMBAYARAN_TERAKHIR from PEMBAYARAN_SPPT where
             KD_PROPINSI='".$KD_PROPINSI."'
             and KD_DATI2='".$KD_DATI2."'
             and KD_KECAMATAN='".$KD_KECAMATAN."'
             and KD_KELURAHAN='".$KD_KELURAHAN."'
             and KD_BLOK='".$KD_BLOK."'
             and NO_URUT='".$NO_URUT."'
             and KD_JNS_OP='".$KD_JNS_OP."'
             ";

             $ke = mysqli_query($conn, $sql_ke) or die (mysqli_error($conn));
            ?>


            <?php
            while($itung = mysqli_fetch_assoc($s)) {

              $bulan2 = date('m', strtotime($itung['TGL_JATUH_TEMPO_SPPT']));

              $thn_sppt = $itung['THN_PAJAK_SPPT'];
              $sppt_tahun =  strtotime($itung['TGL_JATUH_TEMPO_SPPT']);

              $now = strtotime(date('Y-m-d', time()));
              $year_sppt = date('Y', $sppt_tahun);
              $year_now = date('Y', $now);

              $month_sppt = $bulan2;
              $month_now = date('mm', $now);
              $itungggg = (date('Ymd', time()) - date('Ymd', strtotime($itung['TGL_JATUH_TEMPO_SPPT'])));
              if ($itungggg > 0 && $itungggg < 30) {
                $jumlah_bulan = '1';
              } else if ($year_sppt == date('Y')) {
                $jumlah_bulan = date('m') - $bulan2;
              } else {
                $jumlah_bulan = ((date("Y") - $year_sppt) * 12) + 07 - $bulan2;
              } 

              // if (date('Y-m-d', strtotime($itung['TGL_JATUH_TEMPO_SPPT']) < date('Y-m-d', time()))) {
              //   $jumlah_bulan = '1';
              // } else {
              //   $jumlah_bulan = ((date("Y") - $year_sppt) * 12) + 07 - $bulan2;
              // } 

              if ($jumlah_bulan < 1) {
                $jumlah_tunggakan_per_bulan = '0';
              } else if ($jumlah_bulan < 24) {
                $jumlah_tunggakan_per_bulan = ((2 * $itung['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100);
              } else if ($jumlah_bulan >= 24) {
                $jumlah_tunggakan_per_bulan = ((2 * $itung['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100);
              } else if ($jumlah_bulan = 1) {
                $jumlah_tunggakan_per_bulan = ((2 * $itung['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100);
              }

              if ($jumlah_bulan < 1) {
                $jumlah_tunggakan = '0';
              } else if ($jumlah_bulan < 24) {
                $jumlah_tunggakan = $jumlah_bulan * ((2 * $itung['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100);
              } else if ($jumlah_bulan >= 24) {
                $jumlah_tunggakan = 24 * ((2 * $itung['PBB_YG_HARUS_DIBAYAR_SPPT'])) / 100;
              } else if ($jumlah_bulan = 1) {
                $jumlah_tunggakan = $jumlah_bulan * ((2 * $itung['PBB_YG_HARUS_DIBAYAR_SPPT']) / 100);
              }

              if ($jumlah_bulan < 1) {
                $jumlah_bulan_denda = '0';
              } else if ($jumlah_bulan >= 24) {
                $jumlah_bulan_denda = '24';
              } else {
                $jumlah_bulan_denda = $jumlah_bulan;
              }

              
                $is_diskon = $itung['THN_PAJAK_SPPT'] >= $itung['THN_PENG_PERMANEN_AWAL'] && $itung['THN_PAJAK_SPPT'] <= $itung['THN_PENG_PERMANEN_AKHIR'];

                if ($is_diskon) {
                  $pbb = $itung['PBB_YG_HARUS_DIBAYAR_SPPT'] - (($itung['PBB_YG_HARUS_DIBAYAR_SPPT'] * $itung['PCT_PENGURANGAN_PERMANEN']) / 100);
                } else {
                  $pbb = $itung['PBB_YG_HARUS_DIBAYAR_SPPT'];
                }

              if ($jumlah_bulan < 1) {
                $jumlah_yg_harus_dibayar = $jumlah_tunggakan + $pbb;
              } else if ($jumlah_bulan < 24) {
                $jumlah_yg_harus_dibayar = $jumlah_tunggakan + $pbb + ($jumlah_bulan * ((2 * $pbb) / 100));
              } else if ($jumlah_bulan >= 24) {
                $jumlah_yg_harus_dibayar = $jumlah_tunggakan + $pbb + (24 * ((2 * $pbb) / 100));
              } else if ($jumlah_bulan = 1) {
                $jumlah_yg_harus_dibayar = $jumlah_tunggakan + $pbb + ($jumlah_bulan * ((2 * $pbb) / 100));
              }

              

              // echo $jumlah_bulan;

              // echo $tahun . " SELECTED";
              // echo " ".$itung['PBB_YG_HARUS_DIBAYAR_SPPT'];
              // echo " ".$bulan2 . "<br>";
              // echo "Jumlah bulan nunggak ". $jumlah_bulan . "<br>";
              // echo "Jumlah tunggakan " . $jumlah_tunggakan . "<br>";
              // echo "Jumlah yg harus dibayar sudah sama tunggakan " . $jumlah_yg_harus_dibayar . "<br>";
              // echo "<br>";


              while ($bayar_ke = mysqli_fetch_assoc($ke)) {
                $angka = $bayar_ke['PEMBAYARAN_TERAKHIR'];
                $pembayaran_spptke = $angka+1;

                // echo "NOP : " . $itung['KD_PROPINSI'].'-'.$itung['KD_DATI2'].'-'.$itung['KD_KECAMATAN'].'-'.$itung['KD_KELURAHAN'].'-'.$itung['KD_BLOK'].'-'.$itung['NO_URUT'].'-'.$itung['KD_JNS_OP'] . "<br>";
                // echo "Tahun Pajak SPPT : " . $tahun . "<br>";
                // echo "Pembayaran SPPT ke : " . $pembayaran_spptke . " <br>";
                // echo "Kode kanwil bank : " . $itung['KD_KANWIL_BANK'] . "<br>";
                // echo "Kode KPPBB bank : " . $itung['KD_KPPBB_BANK'] . "<br>";
                // echo "Kode bank tunggal : " . $itung['KD_BANK_TUNGGAL'] . "<br>";
                // echo "Kode bank persepsi : " . $itung['KD_BANK_PERSEPSI'] . "<br>";
                // echo "Kode Tempat Pembayaran : " . $itung['KD_TP'] . "<br>";
                // echo "Denda SPPT : " . $jumlah_tunggakan . "<br>";
                // echo "Jumlah yg dibayar : " . $jumlah_yg_harus_dibayar . "<br>";
                // echo "Tanggal pembayaran : " . date('Y-m-d', time()) . "<br>";
                // echo "Tanggal rekam : " . date('Y-m-d', time()) . "<br>";
                // echo "NIP perekam : 06000000" . "<br><br>";
                //
                // echo "Tunggakan <br>";
                // echo "Lama nunggak : " . $jumlah_bulan . " bulan dari " . date('Y-m-d', strtotime($itung['TGL_JATUH_TEMPO_SPPT'])) . "<br>";
                // echo "Jumlah tunggakan : " . $jumlah_tunggakan . "<br>";
                // echo "Total yg harus dibayarkan : " . $jumlah_yg_harus_dibayar . "<br><br><br><br>";
              ?>


              <tbody>
                <td><?=$tahun;
                if ($is_diskon) {
                  echo "<span style='color:green;float:right;'><i><b>*diskon ".$itung['PCT_PENGURANGAN_PERMANEN']."%</b></i></span>";
                }
                ?></td>
                <td><?=number_format(round($jumlah_tunggakan), '0','.','.')?></td>
                <td><?=number_format(round($itung['PBB_YG_HARUS_DIBAYAR_SPPT']), '0','.','.')?></td>
                <td><?=number_format(round($jumlah_yg_harus_dibayar), '0','.','.')?></td>
              </tbody>

              <fieldset>
                <input type="hidden" name="KDKANWIL" value="<?=$itung['KD_KANWIL_BANK']?>">
                <input type="hidden" name="KDKPPBB" value="<?=$itung['KD_KPPBB_BANK']?>">
                <input type="hidden" name="KDBANKTUNGGAL" value="<?=$itung['KD_BANK_TUNGGAL']?>">
                <input type="hidden" name="KDBANKPERSEPSI" value="<?=$itung['KD_BANK_PERSEPSI']?>">
                <input type="hidden" name="KDTP" value="<?=$itung['KD_TP']?>">

                <input type="hidden" name="bayar[NM_WP_SPPT][]" value="<?=$NM_WP_SPPT?>">
                <input type="hidden" name="bayar[KD_PROPINSI][]" value="<?=$itung['KD_PROPINSI']?>">
                <input type="hidden" name="bayar[KD_DATI2][]" value="<?=$itung['KD_DATI2']?>">
                <input type="hidden" name="bayar[KD_KECAMATAN][]" value="<?=$itung['KD_KECAMATAN']?>">
                <input type="hidden" name="bayar[KD_KELURAHAN][]" value="<?=$itung['KD_KELURAHAN']?>">
                <input type="hidden" name="bayar[KD_BLOK][]" value="<?=$itung['KD_BLOK']?>">
                <input type="hidden" name="bayar[NO_URUT][]" value="<?=$itung['NO_URUT']?>">
                <input type="hidden" name="bayar[KD_JNS_OP][]" value="<?=$itung['KD_JNS_OP']?>">
                <input type="hidden" name="bayar[THN_PAJAK_SPPT][]" value="<?=$tahun?>">
                <input type="hidden" name="bayar[TGL_JATUH_TEMPO_SPPT][]" value="<?=$itung['TGL_JATUH_TEMPO_SPPT']?>">
                <input type="hidden" name="bayar[PEMBAYARAN_SPPT_KE][]" value="<?=$pembayaran_spptke?>">
                <input type="hidden" name="bayar[KD_KANWIL_BANK][]" value="<?=$_SESSION['KD_KANWIL_BANK']?>">
                <input type="hidden" name="bayar[KD_KPPBB_BANK][]" value="<?=$_SESSION['KD_KPPBB_BANK']?>">
                <input type="hidden" name="bayar[KD_BANK_TUNGGAL][]" value="<?=$_SESSION['KD_BANK_TUNGGAL']?>">
                <input type="hidden" name="bayar[KD_BANK_PERSEPSI][]" value="<?=$_SESSION['KD_BANK_PERSEPSI']?>">
                <input type="hidden" name="bayar[KD_TP][]" value="<?=$_SESSION['KD_TP']?>">
                <input type="hidden" name="bayar[DENDA_SPPT][]" value="<?=$jumlah_tunggakan?>">
                <input type="hidden" name="bayar[DENDA_SPPT_PER_BULAN][]" value="<?=$jumlah_tunggakan_per_bulan?>">
                <input type="hidden" name="bayar[JUMLAH_BULAN_DENDA][]" value="<?=$jumlah_bulan_denda?>">
                <input type="hidden" name="bayar[SEJUMLAH_RP][]" value="<?=$jumlah_yg_harus_dibayar?>">
                <!--<input type="hidden" value="<?=$itung['PBB_YG_HARUS_DIBAYAR_SPPT']?>">-->
                <input type="hidden" name="bayar[JML_SPPT_YG_DIBAYAR][]" value="<?=$jumlah_yg_harus_dibayar?>">
                <input type="hidden" name="bayar[TGL_PEMBAYARAN_SPPT][]" value="<?=date('Y-m-d', time())?>">
                <input type="hidden" name="bayar[TGL_REKAM_BYR_SPPT][]" value="<?=date('Y-m-d', time())?>">
                <input type="hidden" name="bayar[NIP_REKAM_BYR_SPPT][]" value="<?=$_SESSION['NIP']?>">

                <input type="hidden" name="KD_PROPINSI" value="<?=$itung['KD_PROPINSI']?>">
                <input type="hidden" name="KD_DATI2" value="<?=$itung['KD_DATI2']?>">
                <input type="hidden" name="KD_KECAMATAN" value="<?=$itung['KD_KECAMATAN']?>">
                <input type="hidden" name="KD_KELURAHAN" value="<?=$itung['KD_KELURAHAN']?>">
                <input type="hidden" name="KD_BLOK" value="<?=$itung['KD_BLOK']?>">
                <input type="hidden" name="NO_URUT" value="<?=$itung['NO_URUT']?>">
                <input type="hidden" name="KD_JNS_OP" value="<?=$itung['KD_JNS_OP']?>">
              </fieldset>
              <?php

              $total+=$jumlah_yg_harus_dibayar;

              } } } ?>

            <tbody>
              <td style="border-right: none;">Total Pembayaran : </td>
              <td style="border-right: none;"></td>
              <td style="border-right: none;"></td>
              <td><?=number_format($total, '0','.','.')?></td>
            </tbody>

              </table>
            </div>

            <!--<input type="text" id="diskon" name="diskon" placeholder="Diskon" class="form-control" style="width:100px;display:inline-block"> <b>%</b>
            <br>-->
            <input type="checkbox" name="checkbox" value="check"/> Konfirmasi Pembayaran

              <div class="" style="float:right">
                <a class="btn btn-default"  href="javascript:window.close();">Cancel</a>
                <button class="btn btn-primary" type="submit" name="simpan" value="Simpan" onclick="if(!this.form.checkbox.checked){alert('Anda harus mengkonfirmasi pembayaran terlebih dahulu!');return false}">Bayar</button>
              </div>
              </form>


          <?php } else {
            echo "tidak ada transaksi";
          } ?>

          </div>
    </div>

        <script type="text/javascript" src="../../bower_components/js/modal.js"></script>
        <script src="../../bower_components/jquery/dist/jquery.min.js"></script>
        <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>
        <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
        <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
        <script src="../../dist/js/sb-admin-2.js"></script>
        <script>
        $(document).ready(function() {
            $('#dataTables-example').DataTable({
                    responsive: true
            });
        });
        </script>
        <script type="text/javascript">
        $(document).ready(function() {
            $("#diskon").keyup(function(){
                var DISKON = $("#diskon").val();
                var JML = $("#jmlpa").val();
                    $.post(
                      'proses_calculate.php',
                      {jml:JML, diskon:DISKON},
                        function(data) {
                          if(data == ''){
                              $('#jml').html("Tidak ada kalkulasi");                                    
                          } else {
                              document.getElementById("jml").value = data;
                          }
                      });
            });
        });
  </script>
  </body>
</html>
