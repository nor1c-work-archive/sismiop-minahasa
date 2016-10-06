<?php

session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
    header("Location: ../index.php");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['export'])) {

  if($_GET['kelurahan']=="all_kel") {
    $TGL_AWAL = $_GET['tgl_awal'];
    $TGL_AKHIR = $_GET['tgl_akhir'];
    $KECAMATAN = $_GET['kecamatan'];
    $KELURAHAN = "all_kel";
  } else if($_GET['kecamatan']!="all_kel") {
    $TGL_AWAL = $_GET['tgl_awal'];
    $TGL_AKHIR = $_GET['tgl_akhir'];
    $KECAMATAN = $_GET['kecamatan'];
    $KELURAHAN = $_GET['kelurahan'];
  }

  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('Europe/London');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

  /** Include PHPExcel */
  require_once dirname(__FILE__) . '/../../lib/phpexcel/Classes/PHPExcel.php';
  // Create new PHPExcel object

  header("Pragma: Public");
  header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  header("Content-Type: application/force-download");
  header("Content-Type: application/octet-stream");
  header("Content-Type: application/download");
  header("Content-Type: application/vnd.ms-excel");
  header("Content-Disposition: attachment; filename=$TGL_AWAL-$TGL_AKHIR-$KECAMATAN.xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  header("Content-Transfer-Encoding: binary");

  flush();

  $objPHPExcel = new PHPExcel();

  // Add some data;
  $objPHPExcel = PHPExcel_IOFactory::load("template.xlsx");
  // Getting data from SPPT Database


  // START QUERYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY


  if ($_GET['kelurahan']=="all_kel") {
    $q = "SELECT a.*, b.NM_KELURAHAN, c.NM_WP_SPPT, c.RT_WP_SPPT, c.RW_WP_SPPT, c.JLN_WP_SPPT, d.RW_OP, d.RT_OP, d.JALAN_OP, e.NM_TP from pembayaran_sppt a 
                                        LEFT JOIN REF_KELURAHAN b on(a.KD_KECAMATAN=b.KD_KECAMATAN and a.KD_KELURAHAN=b.KD_KELURAHAN)
                                        LEFT JOIN ALL_SPPT c on(a.KD_KECAMATAN=c.KD_KECAMATAN and a.KD_KELURAHAN=c.KD_KELURAHAN and a.KD_BLOK=c.KD_BLOK and a.NO_URUT=c.NO_URUT and a.KD_JNS_OP=c.KD_JNS_OP)
                                        LEFT JOIN DAT_OBJEK_PAJAK d on(a.KD_KECAMATAN=d.KD_KECAMATAN and a.KD_KELURAHAN=d.KD_KELURAHAN and a.KD_BLOK=d.KD_BLOK and a.NO_URUT=d.NO_URUT and a.KD_JNS_OP=d.KD_JNS_OP)
                                        LEFT JOIN TEMPAT_PEMBAYARAN e on(a.KD_KANWIL_BANK=e.KD_KANWIL and a.KD_KPPBB_BANK=e.KD_KPPBB and a.KD_BANK_TUNGGAL=e.KD_BANK_TUNGGAL and a.KD_BANK_PERSEPSI=e.KD_BANK_PERSEPSI and a.KD_TP=e.KD_TP)
                                        WHERE a.TGL_PEMBAYARAN_SPPT >= '".$TGL_AWAL."' AND a.TGL_PEMBAYARAN_SPPT <= '".$TGL_AKHIR."' AND a.KD_KECAMATAN='".$KECAMATAN."'
                                        GROUP BY a.KD_KECAMATAN, a.KD_KELURAHAN, a.KD_BLOK, a.NO_URUT, a.KD_JNS_OP, a.THN_PAJAK_SPPT, a.PEMBAYARAN_SPPT_KE, a.KD_KANWIL_BANK, a.KD_KPPBB_BANK, a.KD_BANK_TUNGGAL, a.KD_BANK_PERSEPSI, a.KD_TP, a.DENDA_SPPT, a.JML_SPPT_YG_DIBAYAR, a.TGL_PEMBAYARAN_SPPT, a.JML_SPPT_YG_DIBAYAR
          ";
  } else if ($_GET['kelurahan']!="all_kel") {
    $q = "SELECT a.*, b.NM_KELURAHAN, c.NM_WP_SPPT, c.RT_WP_SPPT, c.RW_WP_SPPT, c.JLN_WP_SPPT, d.RW_OP, d.RT_OP, d.JALAN_OP, e.NM_TP from pembayaran_sppt a 
                                        LEFT JOIN REF_KELURAHAN b on(a.KD_KECAMATAN=b.KD_KECAMATAN and a.KD_KELURAHAN=b.KD_KELURAHAN)
                                        LEFT JOIN ALL_SPPT c on(a.KD_KECAMATAN=c.KD_KECAMATAN and a.KD_KELURAHAN=c.KD_KELURAHAN and a.KD_BLOK=c.KD_BLOK and a.NO_URUT=c.NO_URUT and a.KD_JNS_OP=c.KD_JNS_OP)
                                        LEFT JOIN DAT_OBJEK_PAJAK d on(a.KD_KECAMATAN=d.KD_KECAMATAN and a.KD_KELURAHAN=d.KD_KELURAHAN and a.KD_BLOK=d.KD_BLOK and a.NO_URUT=d.NO_URUT and a.KD_JNS_OP=d.KD_JNS_OP)
                                        LEFT JOIN TEMPAT_PEMBAYARAN e on(a.KD_KANWIL_BANK=e.KD_KANWIL and a.KD_KPPBB_BANK=e.KD_KPPBB and a.KD_BANK_TUNGGAL=e.KD_BANK_TUNGGAL and a.KD_BANK_PERSEPSI=e.KD_BANK_PERSEPSI and a.KD_TP=e.KD_TP)
                                        WHERE a.KD_KECAMATAN= '".$KECAMATAN."' AND a.KD_KELURAHAN='".$KELURAHAN."' AND a.TGL_PEMBAYARAN_SPPT >= '".$TGL_AWAL."' AND a.TGL_PEMBAYARAN_SPPT <= '".$TGL_AKHIR."'
                                        GROUP BY a.KD_KECAMATAN, a.KD_KELURAHAN, a.KD_BLOK, a.NO_URUT, a.KD_JNS_OP, a.THN_PAJAK_SPPT, a.PEMBAYARAN_SPPT_KE, a.KD_KANWIL_BANK, a.KD_KPPBB_BANK, a.KD_BANK_TUNGGAL, a.KD_BANK_PERSEPSI, a.KD_TP, a.DENDA_SPPT, a.JML_SPPT_YG_DIBAYAR, a.TGL_PEMBAYARAN_SPPT, a.JML_SPPT_YG_DIBAYAR
          ";
  }

  $co = mysqli_query($conn, $q);

  $no = 1;
  $kolom_awal = 1;
  while ($row = mysqli_fetch_assoc($co)) {
    $v_kolom_awal = $kolom_awal+=1;
    $objPHPExcel->getActiveSheet()
    ->setCellValue("A$v_kolom_awal", sprintf("%02s", $row['KD_PROPINSI']))
    ->setCellValue("B$v_kolom_awal", sprintf("%02s", $row['KD_DATI2']))
    ->setCellValue("C$v_kolom_awal", sprintf("%03s", $row['KD_KECAMATAN']))
    ->setCellValue("D$v_kolom_awal", sprintf("%03s", $row['KD_KELURAHAN']))
    ->setCellValue("E$v_kolom_awal", sprintf("%03s", $row['KD_BLOK']))
    ->setCellValue("F$v_kolom_awal", sprintf("%04s", $row['NO_URUT']))
    ->setCellValue("G$v_kolom_awal", sprintf("%01s", $row['KD_JNS_OP']))
    ->setCellValue("H$v_kolom_awal", $row['THN_PAJAK_SPPT'])
    ->setCellValue("I$v_kolom_awal", $row['PEMBAYARAN_SPPT_KE'])
    ->setCellValue("J$v_kolom_awal", sprintf("%02s", $row['KD_KANWIL_BANK']))
    ->setCellValue("K$v_kolom_awal", sprintf("%02s", $row['KD_KPPBB_BANK']))
    ->setCellValue("L$v_kolom_awal", sprintf("%02s", $row['KD_BANK_TUNGGAL']))
    ->setCellValue("M$v_kolom_awal", sprintf("%02s", $row['KD_BANK_PERSEPSI']))
    ->setCellValue("N$v_kolom_awal", sprintf("%02s", $row['KD_TP']))
    ->setCellValue("O$v_kolom_awal", $row['DENDA_SPPT'])
    ->setCellValue("P$v_kolom_awal", $row['JML_SPPT_YG_DIBAYAR'])
    ->setCellValue("Q$v_kolom_awal", $row['TGL_PEMBAYARAN_SPPT'])
    ->setCellValue("R$v_kolom_awal", $row['TGL_REKAM_BYR_SPPT'])
    ->setCellValue("S$v_kolom_awal", $row['NIP_REKAM_BYR_SPPT'])
    ->setCellValue("T$v_kolom_awal", $row['NM_WP_SPPT'])
    ->setCellValue("U$v_kolom_awal", $row['JLN_WP_SPPT'])
    ->setCellValue("V$v_kolom_awal", $row['RW_WP_SPPT'])
    ->setCellValue("W$v_kolom_awal", $row['RT_WP_SPPT'])
    ->setCellValue("X$v_kolom_awal", $row['JALAN_OP'])
    ->setCellValue("Y$v_kolom_awal", $row['RW_OP'])
    ->setCellValue("Z$v_kolom_awal", $row['RT_OP'])
    ;
  }
  $no++;

  // END OF QUERYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY

  // Rename worksheet
  $objPHPExcel->getActiveSheet()->setTitle('Sheet 1');


  // Set active sheet index to the first sheet, so Excel opens this as the first sheet
  $objPHPExcel->setActiveSheetIndex(0);


  // Save Excel 2007 file
  $callStartTime = microtime(true);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
  $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;



  // Save Excel 95 file
  $callStartTime = microtime(true);

  $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

  $objWriter->save('php://output');

  $callEndTime = microtime(true);
  $callTime = $callEndTime - $callStartTime;

  echo "Sukses Export", EOL;


} else {
  echo "Tidak ada data yang diexport";
}

?>
