<?php

require_once("../config/conn.php");

function Terbilang($x)
{
  $abil = array("", "SATU", "DUA", "TIGA", "EMPAT", "LIMA", "ENAM", "TUJUH", "DELAPAN", "SEMBILAN", "SEPULUH", "SEBELAS");
  if ($x < 12)
    return " " . $abil[$x];
  elseif ($x < 20)
    return Terbilang($x - 10) . "BELAS";
  elseif ($x < 100)
    return Terbilang($x / 10) . " PULUH" . Terbilang($x % 10);
  elseif ($x < 200)
    return " SERATUS" . Terbilang($x - 100);
  elseif ($x < 1000)
    return Terbilang($x / 100) . " RATUS" . Terbilang($x % 100);
  elseif ($x < 2000)
    return " SERIBU" . Terbilang($x - 1000);
  elseif ($x < 1000000)
    return Terbilang($x / 1000) . " RIBU" . Terbilang($x % 1000);
  elseif ($x < 1000000000)
    return Terbilang($x / 1000000) . " JUTA" . Terbilang($x % 1000000);
}


error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../lib/phpexcel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
// Add some data;
$objPHPExcel = PHPExcel_IOFactory::load("../excel/template/templateSPPTNew2.xlsx");
// Getting data from SPPT Database
$objPHPExcel->getDefaultStyle()->getFont()->setName('Calibri')->setSize(14);


$query = 'select * from SPPT_PRINT
where KD_KECAMATAN=360 and
KD_KELURAHAN=004';

// select KD_KLS_TANAH from SPPT_MANDOLANG2 a, KELAS_TANAH b where a.KD_KLS_TANAH=b.KD_KLS_TANAH

// select * from SPPT_MANDOLANG2 a, KELAS_TANAH b, KELAS_BANGUNAN c
// where a.KD_KLS_TANAH=b.KD_KLS_TANAH

$stid = oci_parse($conn, $query);
$r = oci_execute($stid);
$count = oci_num_rows($stid);

// left side

$no=1;
$nop=5;
$thn_pajak=4;
$nm_wp=7;
$jln_op=7;
$rw_op=8;
$rt_op=8;
// $kel_op=12;
// $kec_op=13;
// $kota_op=14;
$nm_op=31;
$nip_op=32;
$jln_wp=8;
$rw_wp=9;
$rt_wp=9;
$kel_wp=10;
$kota_wp=11;
$npwp = 12;
$luas_bm=14;
$luas_bng=16;
$kls_bm=14;
$kls_bng=16;
$njop_bm=14;
$njop_bng=16;
$njop_sppt=18;
$njoptkp=19;
$terhutang=23;
$hdibayar=21;
$klpersen=21;
$hdibayart=25;
$njopp=20;
$persen=21;
$tglcetak=27;
$tgl_jatuhtmp=27;
$bank=28;
$nm_wp_bawah=35;
$nop_bawah=38;
$sppt_bawah=39;
$kec=36;
$kel=37;
$kecatas=9;
$kelatas=10;
$kab=11;
$njop_mt=14;
$njop_mbng=16;
$op_bumi=14;
$op_bng=16;
$format_kd_bm=14;
$format_kd_bng=16;
$no_akun=3;
$nipastext=36;
$ik_op=31;
$ki_op=31;
$ik_nip=32;
$ki_nip=32;
$kanan1 = 14;
$kanan2 = 23;

// right side

$rnop=5;
$rthn_pajak=4;
$rnm_wp=7;
$rjln_op=7;
$rrw_op=8;
$rrt_op=8;
// $kel_op=12;
// $kec_op=13;
// $kota_op=14;
$rnm_op=31;
$rnip_op=32;
$rjln_wp=8;
$rrw_wp=9;
$rrt_wp=9;
$rkel_wp=10;
$rkota_wp=11;
$rnpwp = 12;
$rluas_bm=14;
$rluas_bng=16;
$rkls_bm=14;
$rkls_bng=16;
$rnjop_bm=14;
$rnjop_bng=16;
$rnjop_sppt=18;
$rnjoptkp=19;
$rterhutang=23;
$rhdibayar=21;
$rklpersen=21;
$rhdibayart=25;
$rnjopp=20;
$rpersen=21;
$rtglcetak=27;
$rtgl_jatuhtmp=27;
$rbank=28;
$rnm_wp_bawah=35;
$rnop_bawah=38;
$rsppt_bawah=39;
$rkec=36;
$rkel=37;
$rkecatas=9;
$rkelatas=10;
$rkab=11;
$rnjop_mt=14;
$rnjop_mbng=16;
$rop_bumi=14;
$rop_bng=16;
$rformat_kd_bm=14;
$rformat_kd_bng=16;
$rno_akun=3;
$rnipastext=36;
$rik_op=31;
$rki_op=31;
$rik_nip=32;
$rki_nip=32;
$rkanan1 = 14;
$rkanan2 = 23;


while(($row = oci_fetch_array($stid, OCI_ASSOC)) != false) {

  if ($row['NJOP_SPPT']<1000000000) {
    $persena = "0.1 % ";
  } else {
    $persena = "0.2 % ";
  }

    if ($row['LUAS_BNG_SPPT']==0) {
      $v_kd = "";
      $v_luas = "";
      $v_njop = "";
      $v_njopn = "";
      $v_op = "";
    } else {
      $v_kd = $row['KD_KLS_BNG'];
      $v_luas = $row['LUAS_BNG_SPPT'];
      $v_njop = number_format($row['NJOP_BNG'],'0',',',',');
      $v_njopn = number_format($row['NJOP_BNG_SPPT'],'0',',',',');
      $v_op = "BANGUNAN";
    }

    if ($row['NPWP_SPPT']==0) {
      $v_npwp = "-";
    } else {
      $v_npwp = $row['NPWP_SPPT'];
    }

  if ($no==1) {
        //   $objPHPExcel->getActiveSheet()
        //   ->getStyle('E13:E291216')
        //   ->getNumberFormat()
        //   ->setFormatCode(
        //    PHPExcel_Style_NumberFormat::FORMAT_TEXT
        //  );
        //  $objPHPExcel->getActiveSheet()->setCellValueExplicit('E13:E291216', $val,PHPExcel_Cell_DataType::TYPE_STRING);

         $objPHPExcel->getActiveSheet()
         ->setCellValue('L3', $no)
         ->setCellValue('B5',
         sprintf("%02s", $row['KD_PROPINSI']).'.'.
         sprintf("%02s", $row['KD_DATI2']).'.'.
         sprintf("%03s", $row['KD_KECAMATAN']).'.'.
         sprintf("%03s", $row['KD_KELURAHAN']).'.'.
         sprintf("%03s", $row['KD_BLOK']).'.'.
         sprintf("%04s", $row['NO_URUT']).'.'.
         sprintf("%01s", $row['KD_JNS_OP']))
         ->setCellValue('J4', $row['THN_PAJAK_SPPT'])
         ->setCellValue('B7', $row['JLN_OP_SPPT'])
         ->setCellValue('B8', 'RW')
         ->setCellValue('D8', 'RT')
        //  ->setCellValue('B12', $row[''])
        //  ->setCellValue('B13', $row[''])
        //  ->setCellValue('B14', $row[''])
         ->setCellValue('J32', 'NIP. 19590110 198503 1 015')
         ->setCellValue('H7', $row['NM_WP_SPPT'])
         ->setCellValue('H8', $row['JLN_WP_SPPT'])
         ->setCellValue('H9', 'RW')
         ->setCellValue('J9', 'RT')
         ->setCellValue('H10', $row['KELURAHAN_WP_SPPT'])
         ->setCellValue('H11', $row['KOTA_WP_SPPT'])

         ->setCellValue('I12', $v_npwp)

         ->setCellValue('A14', 'BUMI')
         ->setCellValue('A16', $v_op)

         ->setCellValue('D14', $row['LUAS_BUMI_SPPT'])
         ->setCellValue('D16', $v_luas)
         ->setCellValue('E14', sprintf("%03s", $row['KD_KLS_TANAH']))
         ->setCellValue('E16', $v_kd)
         ->setCellValue('K14', number_format($row['NJOP_BUMI_SPPT']),'0',',',',')
         ->setCellValue('K16', $v_njopn)
         ->setCellValue('K18', number_format($row['NJOP_SPPT'],'0',',',','))
         ->setCellValue('K19', number_format($row['NJOPTKP_SPPT'],'0',',',','))
         ->setCellValue('K20', number_format($row['NJOP_SPPT_AKHIR'],'0',',',','))
         ->setCellValue('H14', number_format($row['NJOP_TANAH'],'0',',',','))
         ->setCellValue('H16', $v_njop)
         ->setCellValue('K23', number_format($row['PBB_YG_HARUS_DIBAYAR_SPPT'],'0',',',','))
         ->setCellValue('K21', number_format($row['PBB_TERHUTANG_SPPT'],'0',',',','))
         ->setCellValue('H21', number_format($row['NJOP_SPPT_AKHIR']),'0',',',',')
         ->setCellValue('B25', Terbilang($row['PBB_YG_HARUS_DIBAYAR_SPPT']) . " RUPIAH")
         ->setCellValue('F21', "$persena X")
         ->setCellValue('J27', $row['TGL_CETAK_SPPT'])
         ->setCellValue('E27', $row['TGL_JATUH_TEMPO_SPPT'])
         ->setCellValue('D35', $row['NM_WP_SPPT'])
         // ->setCellValue('E43', $row[''])
         // ->setCellValue('E44', $row[''])
         ->setCellValue('E28', "BANK SULUT")
         ->setCellValue('J31', "JAN W. LUNTUNGAN, SH")
         ->setCellValue('F36', $row['NM_KECAMATAN'])
         ->setCellValue('F37', $row['NM_KELURAHAN'])
         ->setCellValue('B9', $row['NM_KECAMATAN'])
         ->setCellValue('B10', $row['NM_KELURAHAN'])
         ->setCellValue('B11', 'MINAHASA')
         ->setCellValue('E38', sprintf("%02s", $row['KD_PROPINSI']).'.'.
         sprintf("%02s", $row['KD_DATI2']).'.'.
         sprintf("%03s", $row['KD_KECAMATAN']).'.'.
         sprintf("%03s", $row['KD_KELURAHAN']).'.'.
         sprintf("%03s", $row['KD_BLOK']).'.'.
         sprintf("%04s", $row['NO_URUT']).'.'.
         sprintf("%01s", $row['KD_JNS_OP']))
         ->setCellValue('E39', $row['THN_PAJAK_SPPT'] . " / " . number_format($row['PBB_YG_HARUS_DIBAYAR_SPPT']),'0',',',',')
         ;
         $objPHPExcel->getActiveSheet()->getStyle('B2')->getNumberFormat()->setFormatCode("##.##.###.###.###.####.#");
        //  $objPHPExcel->getActiveSheet()->getStyle('E13')->getNumberFormat()->setFormatCode('000');
         $objPHPExcel->getActiveSheet()->getStyle('E14')->getNumberFormat()->setFormatCode('000');
         $objPHPExcel->getActiveSheet()->getStyle('E16')->getNumberFormat()->setFormatCode('000');
         $objPHPExcel->getActiveSheet()->getStyle('L3')->getNumberFormat()->setFormatCode('0000');
         $style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
         $style2 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
         $objPHPExcel->getActiveSheet()->getStyle('D14:K23')->applyFromArray($style2);
        //  $money = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
        //  $objPHPExcel->getActiveSheet()->getStyle('K24')->applyFromArray($money);
         $objPHPExcel->getActiveSheet()->getStyle("I31:K31")->applyFromArray($style);
         $objPHPExcel->getActiveSheet()->getStyle("I32:K32")->applyFromArray($style);
       } else if ($no==2) {
         $objPHPExcel->getActiveSheet()
         ->setCellValue('Y3', $no)
         ->setCellValue('O5',
         sprintf("%02s", $row['KD_PROPINSI']).'.'.
         sprintf("%02s", $row['KD_DATI2']).'.'.
         sprintf("%03s", $row['KD_KECAMATAN']).'.'.
         sprintf("%03s", $row['KD_KELURAHAN']).'.'.
         sprintf("%03s", $row['KD_BLOK']).'.'.
         sprintf("%04s", $row['NO_URUT']).'.'.
         sprintf("%01s", $row['KD_JNS_OP']))
         ->setCellValue('W4', $row['THN_PAJAK_SPPT'])
         ->setCellValue('O7', $row['JLN_OP_SPPT'])
         ->setCellValue('O8', 'RW')
         ->setCellValue('Q8', 'RT')
         // ->setCellValue('B12', $row[''])
         // ->setCellValue('B13', $row[''])
         // ->setCellValue('B14', $row[''])
         ->setCellValue('W32', 'NIP. 19590110 198503 1 015')
         ->setCellValue('U7', $row['NM_WP_SPPT'])
         ->setCellValue('U8', $row['JLN_WP_SPPT'])
         ->setCellValue('U9', 'RW')
         ->setCellValue('W9', 'RT')
         ->setCellValue('U10', $row['KELURAHAN_WP_SPPT'])
         ->setCellValue('U11', $row['KOTA_WP_SPPT'])

         ->setCellValue('V12', $v_npwp)

         ->setCellValue('N14', 'BUMI')
         ->setCellValue('N16', $v_op)

         ->setCellValue('Q14', $row['LUAS_BUMI_SPPT'])
         ->setCellValue('Q16', $v_luas)
         ->setCellValue('R14', sprintf("%03s", $row['KD_KLS_TANAH']))
         ->setCellValue('R16', $v_kd)
         ->setCellValue('X14', number_format($row['NJOP_BUMI_SPPT'],'0',',',','))
         ->setCellValue('X16', $v_njopn)
         ->setCellValue('X18', number_format($row['NJOP_SPPT'],'0',',',','))
         ->setCellValue('X19', number_format($row['NJOPTKP_SPPT'],'0',',',','))
         ->setCellValue('X20', number_format($row['NJOP_SPPT_AKHIR'],'0',',',','))
         ->setCellValue('U14', number_format($row['NJOP_TANAH'],'0',',',','))
         ->setCellValue('U16', $v_njop)
         ->setCellValue('X23', number_format($row['PBB_YG_HARUS_DIBAYAR_SPPT'],'0',',',','))
         ->setCellValue('X21', number_format($row['PBB_TERHUTANG_SPPT'],'0',',',','))
         ->setCellValue('U21', number_format($row['NJOP_SPPT_AKHIR'],'0',',',','))
         ->setCellValue('O25', Terbilang($row['PBB_YG_HARUS_DIBAYAR_SPPT']) . " RUPIAH")
         ->setCellValue('S21', "$persena X")
         ->setCellValue('W27', $row['TGL_CETAK_SPPT'])
         ->setCellValue('R27', $row['TGL_JATUH_TEMPO_SPPT'])
         ->setCellValue('Q35', $row['NM_WP_SPPT'])
         // ->setCellValue('N43', $row[''])
         // ->setCellValue('N44', $row[''])
         ->setCellValue('R28', "BANK SULUT")
         ->setCellValue('W31', "JAN W. LUNTUNGAN, SH")
         ->setCellValue('S36', $row['NM_KECAMATAN'])
         ->setCellValue('S37', $row['NM_KELURAHAN'])
         ->setCellValue('O9', $row['NM_KECAMATAN'])
         ->setCellValue('O10', $row['NM_KELURAHAN'])
         ->setCellValue('O11', 'MINAHASA')
         ->setCellValue('R38', sprintf("%02s", $row['KD_PROPINSI']).'.'.
         sprintf("%02s", $row['KD_DATI2']).'.'.
         sprintf("%03s", $row['KD_KECAMATAN']).'.'.
         sprintf("%03s", $row['KD_KELURAHAN']).'.'.
         sprintf("%03s", $row['KD_BLOK']).'.'.
         sprintf("%04s", $row['NO_URUT']).'.'.
         sprintf("%01s", $row['KD_JNS_OP']))
         ->setCellValue('R39', $row['THN_PAJAK_SPPT'] . " / " . number_format($row['PBB_YG_HARUS_DIBAYAR_SPPT'],'0',',',','))
         ;
        //  $objPHPExcel->getActiveSheet()->getStyle('R13')->getNumberFormat()->setFormatCode('000');
        $objPHPExcel->getActiveSheet()->getStyle('R14')->getNumberFormat()->setFormatCode('000');
         $objPHPExcel->getActiveSheet()->getStyle('R16')->getNumberFormat()->setFormatCode('000');
         $objPHPExcel->getActiveSheet()->getStyle('Y3')->getNumberFormat()->setFormatCode('0000');
         $style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
         $style2 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
         $objPHPExcel->getActiveSheet()->getStyle('Q14:X23')->applyFromArray($style2);
        //  $objPHPExcel->getActiveSheet()->getStyle('W36')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
         $objPHPExcel->getActiveSheet()->getStyle("V31:X31")->applyFromArray($style);
         $objPHPExcel->getActiveSheet()->getStyle("V32:X32")->applyFromArray($style);
       } else if ($no%2 == 1) {
         $h_nop = $nop+=39;
         $h_thn_pajak = $thn_pajak+=39;
         $h_nm_wp = $nm_wp+=39;
         $h_jln_op = $jln_op+=39;
         $h_rw_op = $rw_op+=39;
         $h_rt_op = $rt_op+=39;
         $h_nm_op = $nm_op+=39;
         $h_nip_op = $nip_op+=39;
         $h_jln_wp = $jln_wp+=39;
         $h_rw_wp = $rw_wp+=39;
         $h_rt_wp = $rt_wp+=39;
         $h_kel_wp = $kel_wp+=39;
         $h_kota_wp = $kota_wp+=39;
         $h_npwp = $npwp+=39;
         $h_kls_bm = $kls_bm+=39;
         $h_kls_bng = $kls_bng+=39;
         $h_njop_bm = $njop_bm+=39;
         $h_njop_bng = $njop_bng+=39;
         $h_njop_sppt = $njop_sppt+=39;
         $h_njoptkp = $njoptkp+=39;
         $h_terhutang = $terhutang+=39;
         $h_hdibayar = $hdibayar+=39;
         $h_njopp = $njopp+=39;
         $h_klpersen = $klpersen+=39;
         $h_hdibayart = $hdibayart+=39;
         $h_persen = $persen+=39;
         $h_tglcetak = $tglcetak+=39;
         $h_luas_bm = $luas_bm+=39;
         $h_luas_bng = $luas_bng+=39;
         $h_tgl_jatuh_tmp = $tgl_jatuhtmp+=39;
         $h_bank = $bank+=39;
         $h_nm_wp_bawah = $nm_wp_bawah+=39;
         $h_nop_bawah = $nop_bawah+=39;
         $h_sppt_bawah = $sppt_bawah+=39;
         $h_kec = $kec+=39;
         $h_kel = $kel+=39;
         $h_kecatas = $kecatas+=39;
         $h_kelatas = $kelatas+=39;
         $h_kab = $kab+=39;
         $h_njop_mt = $njop_mt+=39;
         $h_njop_mbng = $njop_mbng+=39;
         $h_op_bumi = $op_bumi+=39;
         $h_op_bng= $op_bng+=39;
         $h_format_kd_bm = $format_kd_bm+=39;
         $h_format_kd_bng = $format_kd_bng+=39;
         $h_no_akun = $no_akun+=39;
         $h_nipastext = $nipastext+=39;
         $h_ik_op = $ik_op+=39;
         $h_ki_op = $ki_op+=39;
         $h_ik_nip = $ik_nip+=39;
         $h_ki_nip = $ki_nip+=39;
         $h_kanan1 = $kanan1+=39;
         $h_kanan2 = $kanan2+=39;

         $objPHPExcel->getActiveSheet()
         ->setCellValue("L$h_no_akun", $no)
         ->setCellValue("B$h_nop",
         sprintf("%02s", $row['KD_PROPINSI']).'.'.
         sprintf("%02s", $row['KD_DATI2']).'.'.
         sprintf("%03s", $row['KD_KECAMATAN']).'.'.
         sprintf("%03s", $row['KD_KELURAHAN']).'.'.
         sprintf("%03s", $row['KD_BLOK']).'.'.
         sprintf("%04s", $row['NO_URUT']).'.'.
         sprintf("%01s", $row['KD_JNS_OP']))
         ->setCellValue("J$h_thn_pajak", $row['THN_PAJAK_SPPT'])
         ->setCellValue("B$h_jln_op", $row['JLN_OP_SPPT'])
         ->setCellValue("B$h_rw_op", 'RW')
         ->setCellValue("D$h_rt_op", 'RT')
         // ->setCellValue('B12', $row[''])
         // ->setCellValue('B13', $row[''])
         // ->setCellValue('B14', $row[''])
         ->setCellValue("J$h_nip_op", 'NIP. 19590110 198503 1 015')
         ->setCellValue("H$h_nm_wp", $row['NM_WP_SPPT'])
         ->setCellValue("H$h_jln_wp", $row['JLN_WP_SPPT'])
         ->setCellValue("H$h_rw_wp", 'RW')
         ->setCellValue("J$h_rt_wp", 'RT')
         ->setCellValue("H$h_kel_wp", $row['KELURAHAN_WP_SPPT'])
         ->setCellValue("H$h_kota_wp", $row['KOTA_WP_SPPT'])

         ->setCellValue("I$h_npwp", $v_npwp)

         ->setCellValue("A$h_op_bumi", 'BUMI')
         ->setCellValue("A$h_op_bng", $v_op)

         ->setCellValue("D$h_luas_bm", $row['LUAS_BUMI_SPPT'])
         ->setCellValue("D$h_luas_bng", $v_luas)
         ->setCellValue("E$h_kls_bm", sprintf("%03s", $row['KD_KLS_TANAH']))
         ->setCellValue("E$h_kls_bng", $v_kd)
         ->setCellValue("K$h_njop_bm", number_format($row['NJOP_BUMI_SPPT'],'0',',',','))
         ->setCellValue("K$h_njop_bng", $v_njopn)
         ->setCellValue("K$h_njop_sppt", number_format($row['NJOP_SPPT'],'0',',',','))
         ->setCellValue("K$h_njoptkp", number_format($row['NJOPTKP_SPPT'],'0',',',','))
         ->setCellValue("K$h_njopp", number_format($row['NJOP_SPPT_AKHIR'],'0',',',','))
         ->setCellValue("H$h_njop_mt", number_format($row['NJOP_TANAH'],'0',',',','))
         ->setCellValue("H$h_njop_mbng", $v_njop)
         ->setCellValue("K$h_terhutang", number_format($row['PBB_YG_HARUS_DIBAYAR_SPPT'],'0',',',','))
         ->setCellValue("K$h_hdibayar", number_format($row['PBB_TERHUTANG_SPPT'],'0',',',','))
         ->setCellValue("H$h_klpersen", number_format($row['NJOP_SPPT_AKHIR'],'0',',',','))
         ->setCellValue("B$h_hdibayart", Terbilang($row['PBB_YG_HARUS_DIBAYAR_SPPT']) . " RUPIAH")
         ->setCellValue("F$h_persen", "$persena X")
         ->setCellValue("J$h_tglcetak", $row['TGL_CETAK_SPPT'])
         ->setCellValue("E$h_tgl_jatuh_tmp", $row['TGL_JATUH_TEMPO_SPPT'])
         ->setCellValue("D$h_nm_wp_bawah", $row['NM_WP_SPPT'])
         // ->setCellValue('E' . $ganjil+=39, $row[''])
         // ->setCellValue('E' . $ganjil+=39, $row[''])
         ->setCellValue("E$h_bank", "BANK SULUT")
        ->setCellValue("J$h_nm_op", "JAN W. LUNTUNGAN, SH")
        ->setCellValue("F$h_kec", $row['NM_KECAMATAN'])
        ->setCellValue("F$h_kel", $row['NM_KELURAHAN'])
        ->setCellValue("B$h_kecatas", $row['NM_KECAMATAN'])
        ->setCellValue("B$h_kelatas", $row['NM_KELURAHAN'])
        ->setCellValue("B$h_kab", 'MINAHASA')
         ->setCellValue("E$h_nop_bawah", sprintf("%02s", $row['KD_PROPINSI']).'.'.
         sprintf("%02s", $row['KD_DATI2']).'.'.
         sprintf("%03s", $row['KD_KECAMATAN']).'.'.
         sprintf("%03s", $row['KD_KELURAHAN']).'.'.
         sprintf("%03s", $row['KD_BLOK']).'.'.
         sprintf("%04s", $row['NO_URUT']).'.'.
         sprintf("%01s", $row['KD_JNS_OP']))
         ->setCellValue("E$h_sppt_bawah", $row['THN_PAJAK_SPPT'] . " / " . number_format($row['PBB_YG_HARUS_DIBAYAR_SPPT'],'0',',',','))
         ;
        //  $objPHPExcel->getActiveSheet()->getStyle("E$h_format_kd_bm")->getNumberFormat()->setFormatCode('000');
        $objPHPExcel->getActiveSheet()->getStyle("E$h_format_kd_bm")->getNumberFormat()->setFormatCode('000');
         $objPHPExcel->getActiveSheet()->getStyle("E$h_format_kd_bng")->getNumberFormat()->setFormatCode('000');
         $objPHPExcel->getActiveSheet()->getStyle("L$h_no_akun")->getNumberFormat()->setFormatCode('0000');
         $style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
         $style2 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
         $objPHPExcel->getActiveSheet()->getStyle("D$h_kanan1:K$h_kanan2")->applyFromArray($style2);
        //  $objPHPExcel->getActiveSheet()->getStyle("J$h_nipastext")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
        $objPHPExcel->getActiveSheet()->getStyle("I$h_ik_nip:K$h_ki_nip")->applyFromArray($style);
        $objPHPExcel->getActiveSheet()->getStyle("I$h_ki_op:K$h_ik_op")->applyFromArray($style);
       } else if ($no%2 == 0) {
         $r_nop = $rnop+=39;
         $r_thn_pajak = $rthn_pajak+=39;
         $r_nm_wp = $rnm_wp+=39;
         $r_jln_op = $rjln_op+=39;
         $r_rw_op = $rrw_op+=39;
         $r_rt_op = $rrt_op+=39;
         $r_nm_op = $rnm_op+=39;
         $r_nip_op = $rnip_op+=39;
         $r_jln_wp = $rjln_wp+=39;
         $r_rw_wp = $rrw_wp+=39;
         $r_rt_wp = $rrt_wp+=39;
         $r_kel_wp = $rkel_wp+=39;
         $r_kota_wp = $rkota_wp+=39;
         $r_npwp = $rnpwp+=39;
         $r_kls_bm = $rkls_bm+=39;
         $r_kls_bng = $rkls_bng+=39;
         $r_njop_bm = $rnjop_bm+=39;
         $r_njop_bng = $rnjop_bng+=39;
         $r_njop_sppt = $rnjop_sppt+=39;
         $r_njoptkp = $rnjoptkp+=39;
         $r_terhutang = $rterhutang+=39;
         $r_hdibayar = $rhdibayar+=39;
         $r_njopp = $rnjopp+=39;
         $r_klpersen = $rklpersen+=39;
         $r_hdibayart = $rhdibayart+=39;
         $r_persen = $rpersen+=39;
         $r_tglcetak = $rtglcetak+=39;
         $r_luas_bm = $rluas_bm+=39;
         $r_luas_bng = $rluas_bng+=39;
         $r_tgl_jatuh_tmp = $rtgl_jatuhtmp+=39;
         $r_bank = $rbank+=39;
         $r_nm_wp_bawah = $rnm_wp_bawah+=39;
         $r_nop_bawah = $rnop_bawah+=39;
         $r_sppt_bawah = $rsppt_bawah+=39;
         $r_kec = $rkec+=39;
         $r_kel = $rkel+=39;
         $r_kecatas = $rkecatas+=39;
         $r_kelatas = $rkelatas+=39;
         $r_kab = $rkab+=39;
         $r_njop_mt = $rnjop_mt+=39;
         $r_njop_mbng = $rnjop_mbng+=39;
         $r_op_bumi = $rop_bumi+=39;
         $r_op_bng= $rop_bng+=39;
         $r_format_kd_bm = $rformat_kd_bm+=39;
         $r_format_kd_bng = $rformat_kd_bng+=39;
         $r_no_akun = $rno_akun+=39;
         $r_nipastext = $rnipastext+=39;
         $r_ik_op = $rik_op+=39;
         $r_ki_op = $rki_op+=39;
         $r_ik_nip = $rik_nip+=39;
         $r_ki_nip = $rki_nip+=39;
         $r_kanan1 = $rkanan1+=39;
         $r_kanan2 = $rkanan2+=39;

           $objPHPExcel->getActiveSheet()
           ->setCellValue("Y$r_no_akun", $no)
           ->setCellValue("O$r_nop", sprintf("%02s", $row['KD_PROPINSI']).'.'.
           sprintf("%02s", $row['KD_DATI2']).'.'.
           sprintf("%03s", $row['KD_KECAMATAN']).'.'.
           sprintf("%03s", $row['KD_KELURAHAN']).'.'.
           sprintf("%03s", $row['KD_BLOK']).'.'.
           sprintf("%04s", $row['NO_URUT']).'.'.
           sprintf("%01s", $row['KD_JNS_OP']))
           ->setCellValue("W$r_thn_pajak", $row['THN_PAJAK_SPPT'])
           ->setCellValue("O$r_jln_op", $row['JLN_OP_SPPT'])
           ->setCellValue("O$r_rw_op", 'RW')
           ->setCellValue("Q$r_rt_op", 'RT')
           // ->setCellValue('B12', $row[''])
           // ->setCellValue('B13', $row[''])
           // ->setCellValue('B14', $row[''])
           ->setCellValue("W$r_nip_op", 'NIP. 19590110 198503 1 015')
           ->setCellValue("U$r_nm_wp", $row['NM_WP_SPPT'])
           ->setCellValue("U$r_jln_wp", $row['JLN_WP_SPPT'])
           ->setCellValue("U$r_rw_wp", 'RW')
           ->setCellValue("W$r_rt_wp", 'RT')
           ->setCellValue("U$r_kel_wp", $row['KELURAHAN_WP_SPPT'])
           ->setCellValue("U$r_kota_wp", $row['KOTA_WP_SPPT'])

           ->setCellValue("V$r_npwp", $v_npwp)

           ->setCellValue("N$r_op_bumi", 'BUMI')
           ->setCellValue("N$r_op_bng", $v_op)

           ->setCellValue("Q$r_luas_bm", $row['LUAS_BUMI_SPPT'])
           ->setCellValue("Q$r_luas_bng", $v_luas)
           ->setCellValue("R$r_kls_bm", sprintf("%03s", $row['KD_KLS_TANAH']))
           ->setCellValue("R$r_kls_bng", $v_kd)
           ->setCellValue("X$r_njop_bm", number_format($row['NJOP_BUMI_SPPT'],'0',',',','))
           ->setCellValue("X$r_njop_bng", $v_njopn)
           ->setCellValue("X$r_njop_sppt", number_format($row['NJOP_SPPT'],'0',',',','))
           ->setCellValue("X$r_njoptkp", number_format($row['NJOPTKP_SPPT'],'0',',',','))
           ->setCellValue("X$r_njopp", number_format($row['NJOP_SPPT_AKHIR'],'0',',',','))
           ->setCellValue("U$r_njop_mt", number_format($row['NJOP_TANAH'],'0',',',','))
           ->setCellValue("U$r_njop_mbng", $v_njop)
           ->setCellValue("X$r_terhutang", number_format($row['PBB_YG_HARUS_DIBAYAR_SPPT'],'0',',',','))
           ->setCellValue("X$r_hdibayar", number_format($row['PBB_TERHUTANG_SPPT'],'0',',',','))
           ->setCellValue("U$r_klpersen", number_format($row['NJOP_SPPT_AKHIR'],'0',',',','))
           ->setCellValue("O$r_hdibayart", Terbilang($row['PBB_YG_HARUS_DIBAYAR_SPPT']) . " RUPIAH")
           ->setCellValue("S$r_persen", "$persena X")
           ->setCellValue("W$r_tglcetak", $row['TGL_CETAK_SPPT'])
           ->setCellValue("R$r_tgl_jatuh_tmp", $row['TGL_JATUH_TEMPO_SPPT'])
           ->setCellValue("Q$r_nm_wp_bawah", $row['NM_WP_SPPT'])
           // ->setCellValue('M' . $genap+=39, $row[''])
           // ->setCellValue('N' . $genap+=39, $row[''])
           ->setCellValue("R$r_bank", "BANK SULUT")
          ->setCellValue("W$r_nm_op", "JAN W. LUNTUNGAN, SH")
          ->setCellValue("S$r_kec", $row['NM_KECAMATAN'])
          ->setCellValue("S$r_kel", $row['NM_KELURAHAN'])
          ->setCellValue("O$r_kecatas", $row['NM_KECAMATAN'])
          ->setCellValue("O$r_kelatas", $row['NM_KELURAHAN'])
          ->setCellValue("O$r_kab", 'MINAHASA')
           ->setCellValue("R$r_nop_bawah", sprintf("%02s", $row['KD_PROPINSI']).'.'.
           sprintf("%02s", $row['KD_DATI2']).'.'.
           sprintf("%03s", $row['KD_KECAMATAN']).'.'.
           sprintf("%03s", $row['KD_KELURAHAN']).'.'.
           sprintf("%03s", $row['KD_BLOK']).'.'.
           sprintf("%04s", $row['NO_URUT']).'.'.
           sprintf("%01s", $row['KD_JNS_OP']))
           ->setCellValue("R$r_sppt_bawah", $row['THN_PAJAK_SPPT'] . " / " . number_format($row['PBB_YG_HARUS_DIBAYAR_SPPT'],'0',',',','))
           ;
          //  $objPHPExcel->getActiveSheet()->getStyle("R$r_format_kd_bm")->getNumberFormat()->setFormatCode('000');
          $objPHPExcel->getActiveSheet()->getStyle("R$r_format_kd_bm")->getNumberFormat()->setFormatCode('000');
           $objPHPExcel->getActiveSheet()->getStyle("R$r_format_kd_bng")->getNumberFormat()->setFormatCode('000');
           $objPHPExcel->getActiveSheet()->getStyle("Y$r_no_akun")->getNumberFormat()->setFormatCode('0000');
           $style = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
           $style2 = array('alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT));
           $objPHPExcel->getActiveSheet()->getStyle("Q$r_kanan1:X$r_kanan2")->applyFromArray($style2);
          //  $objPHPExcel->getActiveSheet()->getStyle("W$r_nipastext")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
           $objPHPExcel->getActiveSheet()->getStyle("W$r_ik_op:X$r_ki_op")->applyFromArray($style);
           $objPHPExcel->getActiveSheet()->getStyle("W$r_ik_nip:X$r_ki_nip")->applyFromArray($style);
       }
   $no++;

}



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('PRINT');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

$objWriter->save('../proses/Data Jadi/22. LANGOWAN BARAT/03. RARINGIS.xlsx');



// Save Excel 95 file
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo "sukses", EOL;
