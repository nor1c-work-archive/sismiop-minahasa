<?php
session_start();//session starts here
include '../../bin/dbconn.php';

if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");//redirect to login page to secure the welcome page without login access.
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
    $KD_KANWIL = $_SESSION['KD_KANWIL'];
    $KD_KPPBB = $_SESSION['KD_KPPBB'];
    $THN_PELAYANAN = $_SESSION['THN_PELAYANAN'];
    $BUNDEL_PELAYANAN = $_SESSION['BUNDEL_PELAYANAN'];
    $NO_URUT_PELAYANAN = $_SESSION['NO_URUT_PELAYANAN'];
  ?>

    <!DOCTYPE html>
    <html>
    <head>
      <title></title>
    </head>
    <body onload="window.print()">
      <?php 
    $sql = "select a.*, b.*, c.* from PST_PERMOHONAN a
            LEFT JOIN PST_LAMPIRAN b
            on(a.KD_KANWIL=b.KD_KANWIL and a.KD_KPPBB=b.KD_KPPBB and a.THN_PELAYANAN=b.THN_PELAYANAN and a.BUNDEL_PELAYANAN=b.BUNDEL_PELAYANAN and a.NO_URUT_PELAYANAN=b.NO_URUT_PELAYANAN)
            LEFT JOIN PST_DETAIL c
            on(a.KD_KANWIL=c.KD_KANWIL and a.KD_KPPBB=c.KD_KPPBB and a.THN_PELAYANAN=c.THN_PELAYANAN and a.BUNDEL_PELAYANAN=c.BUNDEL_PELAYANAN and a.NO_URUT_PELAYANAN=c.NO_URUT_PELAYANAN)
            where a.KD_KANWIL='".$KD_KANWIL."' and a.KD_KPPBB='".$KD_KPPBB."' and a.THN_PELAYANAN='".$THN_PELAYANAN."' and a.BUNDEL_PELAYANAN='".$BUNDEL_PELAYANAN."' and a.NO_URUT_PELAYANAN='".$NO_URUT_PELAYANAN."'";
    $sqla = mysqli_query($conn, $sql) or die (mysqli_error($conn));
    while ($data = mysqli_fetch_assoc($sqla)) {
    ?>
      <table>
        <tr>
          <td width="200">No Surat</td>
          <td>:</td>
          <td><?=$data['KD_KANWIL'].'-'.$data['KD_KPPBB'].'-'.$data['THN_PELAYANAN'].'-'.$data['BUNDEL_PELAYANAN'].'-'.$data['NO_URUT_PELAYANAN']?></td>
        </tr>
        <tr>
          <td width="200">Nomor</td>
          <td>:</td>
          <td><?=$data['NO_SRT_PERMOHONAN']?></td>
        </tr>
        <tr>
          <td width="200">Tgl Surat</td>
          <td>:</td>
          <td><?=date('d/m/Y', strtotime($data['TGL_SURAT_PERMOHONAN']))?></td>
        </tr>
        <tr>
          <td width="200">Nama Pemohon</td>
          <td>:</td>
          <td><?=$data['NAMA_PEMOHON']?></td>
        </tr>
        <tr>
          <td width="200">Alamat Pemohon</td>
          <td>:</td>
          <td><?=$data['ALAMAT_PEMOHON']?></td>
        </tr>
        <tr>
          <td width="200">Keterangan</td>
          <td>:</td>
          <td><?=$data['KETERANGAN_PST']?></td>
        </tr>
        <tr>
          <td width="200">Catatan</td>
          <td>:</td>
          <td><?=$data['CATATAN_PST']?></td>
        </tr>
        <tr>
          <td width="200">Kolektif</td>
          <td>:</td>
          <td>
            <?php
              if ($data['STATUS_KOLEKTIF']=="0") {
                echo "PERORANGAN";
              } else if($data['STATUS_KOLEKTIF']=="1") {
                echo "KOLEKTIF";
              }
            ?>
          </td>
        </tr>
        <tr>
          <td width="200">Tgl Terima Dokumen</td>
          <td>:</td>
          <td><?=date('d/m/Y', strtotime($data['TGL_TERIMA_DOKUMEN_WP']))?></td>
        </tr>
        <tr>
          <td width="200">Tgl Perkiraan Selesai</td>
          <td>:</td>
          <td><?=date('d/m/Y', strtotime($data['TGL_PERKIRAAN_SELESAI']))?></td>
        </tr>
        <tr>
          <td width="200">NIP Penerima</td>
          <td>:</td>
          <td><?=$data['NIP_PENERIMA']?></td>
        </tr>
      </table>
    <?php } ?>
    </body>
    </html>

  <?php

 } else {
   if ($_SESSION['ROLE']=="PEMBATALAN") {
     header("Location: ../pembatalan/index.php");
   } else {
     header("Location: ../../index.php");
   }
} ?>
