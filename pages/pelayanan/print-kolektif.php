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
      <style>
      </style>
    </head>
    <body onload="window.print()">
      <?php 
    $sql = "select * from PST_PERMOHONAN
            where KD_KANWIL='".$KD_KANWIL."' and KD_KPPBB='".$KD_KPPBB."' and THN_PELAYANAN='".$THN_PELAYANAN."' and BUNDEL_PELAYANAN='".$BUNDEL_PELAYANAN."' and NO_URUT_PELAYANAN='".$NO_URUT_PELAYANAN."'";
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
            KOLEKTIF
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
    <br>
      <b>Detail Permohonan</b>
      <table style="border-collapse:collapse" border="1">
        <tr>
          <td>No</td>
          <td>NOP</td>
          <td>Alamat</td>
          <td>Jenis Pelayanan</td>
          <td>Tahun Pajak</td>
          <td>Tanggal Selesai</td>
        </tr>

        <?php $sql = "select * from PST_PERMOHONAN_KOLEKTIF where KD_KANWIL='".$KD_KANWIL."' and KD_KPPBB='".$KD_KPPBB."' and THN_PELAYANAN='".$THN_PELAYANAN."' and BUNDEL_PELAYANAN='".$BUNDEL_PELAYANAN."' and NO_URUT_PELAYANAN='".$NO_URUT_PELAYANAN."'";
          $sqlb = mysqli_query($conn, $sql);
          $no = 1;
          while ($data = mysqli_fetch_assoc($sqlb)) { ?>
          <tr>
            <td><?=$no;?></td>
            <td><?=$data['KD_PROPINSI_PEMOHON'].'-'.$data['KD_DATI2_PEMOHON'].'-'.$data['KD_KECAMATAN_PEMOHON'].'-'.$data['KD_KELURAHAN_PEMOHON'].'-'.$data['KD_BLOK_PEMOHON'].'-'.$data['NO_URUT_PEMOHON'].'-'.$data['KD_JNS_OP_PEMOHON']?></td>
            <td><?=$data['ALAMAT_PEMOHON'];?></td>
            <td>
            <?php
              $sql = "select * from REF_JNS_PELAYANAN where KD_JNS_PELAYANAN='".$data['KD_JNS_PELAYANAN']."'";
              $sqla = mysqli_query($conn, $sql);
              $datas = mysqli_fetch_assoc($sqla);
              echo $datas['NM_JENIS_PELAYANAN'];
            ?>  
            </td>
            <td><?=$data['THN_PAJAK'];?></td>
            <td><?=date('d/m/Y', strtotime($data['TGL_PERKIRAAN_SELESAI']))?></td>
          </tr>
        <?php $no++; } ?>
      </table>
    </body>
    </html>

  <?php
    unset($_SESSION['KD_KANWIL']);
    unset($_SESSION['KD_KPPBB']);
    unset($_SESSION['THN_PELAYANAN']);
    unset($_SESSION['BUNDEL_PELAYANAN']);
    unset($_SESSION['NO_URUT_PELAYANAN']);
 } else {
   if ($_SESSION['ROLE']=="PEMBATALAN") {
     header("Location: ../pembatalan/index.php");
   } else {
     header("Location: ../../index.php");
   }
} ?>
