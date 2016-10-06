<?php

include "../../bin/dbconn.php";

if (isset($_GET['opt']) || isset($_POST['opt'])) {
  $opt = $_POST['opt'];

  if (isset($_GET['opt']) || isset($_POST['opt'])) {
      $opt = $_POST['opt'];

      switch ($opt) {
        case 'nop':
            if (isset($_POST['KD_PROPINSI']) AND isset($_POST['KD_DATI2']) AND isset($_POST['KD_KECAMATAN']) AND isset($_POST['KD_KELURAHAN']) AND isset($_POST['KD_BLOK']) AND isset($_POST['NO_URUT']) AND isset($_POST['KD_JNS_OP'])) {
              $KD_PROPINSI = strtoupper($_POST['KD_PROPINSI']);
              $KD_DATI2 = strtoupper($_POST['KD_DATI2']);
              $KD_KECAMATAN = strtoupper($_POST['KD_KECAMATAN']);
              $KD_KELURAHAN = strtoupper($_POST['KD_KELURAHAN']);
              $KD_BLOK = strtoupper($_POST['KD_BLOK']);
              $NO_URUT = strtoupper($_POST['NO_URUT']);
              $KD_JNS_OP = strtoupper($_POST['KD_JNS_OP']);

              if ($KD_PROPINSI == "" || $KD_DATI2 == "" || $KD_KECAMATAN == "" || $KD_KELURAHAN == "" || $KD_BLOK == "" || $NO_URUT == "" || $KD_JNS_OP == "") {
                echo "Tidak boleh ada yang kosong";
              } else {
                $q = "SELECT * from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
                    WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
                    a.KD_PROPINSI LIKE '%".$KD_PROPINSI."%' AND
                    a.KD_DATI2 LIKE '%".$KD_DATI2."%' AND
                    a.KD_KECAMATAN LIKE '%".$KD_KECAMATAN."%' AND
                    a.KD_KELURAHAN LIKE '%".$KD_KELURAHAN."%' AND
                    a.KD_BLOK LIKE '%".$KD_BLOK."%' AND
                    a.NO_URUT LIKE '%".$NO_URUT."%' AND
                    a.KD_JNS_OP LIKE '%".$KD_JNS_OP."%'
                ";
              }
            }
          break;
        case 'nmwp':
            $keyword = $_POST['keyword'];

            $q = "SELECT * from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
                WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
                b.NM_WP LIKE '%".$keyword."%'
            ";
          break;
        case 'jlnop':
        echo $opt;
            $keyword = $_POST['keyword'];

            $q = "SELECT * from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
              WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID AND
              a.JALAN_OP LIKE '%".$keyword."%'
            ";
          break;
        default:
          break;
      }
    } else {
      echo "Tidak ada OPT";
    }
} else {
  $q = "SELECT * FROM DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
  WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID
  LIMIT 5";
}

$qa = mysqli_query($conn, $q) or die (mysqli_error($conn));

echo $qa->num_rows . "<br>";
$no = 1;
while ($data = mysqli_fetch_assoc($qa)) {
  echo $no++ . $data['NM_WP'] . "<br>";
}


?>



<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <select id="graph_select" name="opt">
        <option id="nop">NOP</option>
        <option id="nmwp">Nama WP</option>
        <option id="jlnop">Jalan OP</option>
    </select>

    <!-- NOP -->
    <span id="nops">
    <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <input type="hidden" name="opt" value="nop">

        <input type="text" name="KD_PROPINSI">
        <input type="text" name="KD_DATI2">
        <input type="text" name="KD_KECAMATAN">
        <input type="text" name="KD_KELURAHAN">
        <input type="text" name="KD_BLOK">
        <input type="text" name="NO_URUT">
        <input type="text" name="KD_JNS_OP">
        <input type="submit" name="cari" value="Cari">
    </form>
    </span>

    <!-- NAMA WP -->
    <span id="nmwps">
    <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <input type="hidden" name="opt" value="nmwp">

        <input type="text" name="keyword" value="">
        <input type="submit" name="cari" value="Cari">
    </form>
    </span>

    <span id="jlnops">
      <form class="" action="<?=$_SERVER['PHP_SELF']?>" method="post">
          <input type="hidden" name="opt" value="jlnop">

          <input type="text" name="keyword" value="">
          <input type="submit" name="cari" value="Cari">
      </form>
    </span>

  </body>
  <script src="../../bower_components/jquery/dist/jquery.min.js"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- Metis Menu Plugin JavaScript -->
  <script src="../../bower_components/metisMenu/dist/metisMenu.min.js"></script>

  <!-- DataTables JavaScript -->
  <script src="../../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
  <script src="../../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

  <!-- Custom Theme JavaScript -->
  <script src="../../dist/js/sb-admin-2.js"></script>

  <!-- Page-Level Demo Scripts - Tables - Use for reference -->
  <script>
  $(document).ready(function() {
      $('#dataTables-example').DataTable({
              responsive: true
      });
  });
  </script>
  <script type="text/javascript">
    $(function() {
    $("#graph_select").change(function() {
      if ($("#nop").is(":selected")) {
        $("#nops").show();
        $("#nmwps").hide();
        $("#jlnops").hide();
      } else if ($("#nmwp").is(":selected")) {
        $("#nops").hide();
        $("#nmwps").show();
        $("#jlnops").hide();
      } else {
        $("#nops").hide();
        $("#nmwps").hide();
        $("#jlnops").show();
      }
    }).trigger('change');
    });
  </script>
</html>
