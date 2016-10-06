<?php
session_start();
include '../../bin/dbconn.php';


if(!$_SESSION['NM_LOGIN'])
{
   header("Location: ../../index.php");
}

if ($_SESSION['ROLE']=="ADMINISTRATOR") {
    if (isset($_GET['proses']) || isset($_POST['proses'])) {
            $KECAMATAN = $_POST['KECAMATAN'];
            $KELURAHAN = $_POST['KELURAHAN'];
            $TAHUN     = $_POST['tahun'];

        if (isset($_POST['checkedbuku1'])) {
            $TGL_JATUH_TEMPO_SPPT_1 = $_POST['TGL_JATUH_TEMPO_SPPT_1'];
            $TGL_TERBIT_SPPT_1      = $_POST['TGL_TERBIT_SPPT_1'];
            $buku1 = "UPDATE ALL_SPPT SET TGL_JATUH_TEMPO_SPPT='$TGL_JATUH_TEMPO_SPPT_1', TGL_TERBIT_SPPT='$TGL_TERBIT_SPPT_1' WHERE KD_KECAMATAN='$KECAMATAN' AND KD_KELURAHAN='$KELURAHAN' AND THN_PAJAK_SPPT='$TAHUN' AND PBB_YG_HARUS_DIBAYAR_SPPT <= (SELECT NILAI_MAX_BUKU FROM REF_BUKU WHERE KD_BUKU=1)";
            mysqli_query($conn, $buku1);
        }

        if (isset($_POST['checkedbuku2'])) {
            $TGL_JATUH_TEMPO_SPPT_2 = $_POST['TGL_JATUH_TEMPO_SPPT_2'];
            $TGL_TERBIT_SPPT_2      = $_POST['TGL_TERBIT_SPPT_2'];
            $buku2 = "UPDATE ALL_SPPT SET TGL_JATUH_TEMPO_SPPT='$TGL_JATUH_TEMPO_SPPT_2', TGL_TERBIT_SPPT='$TGL_TERBIT_SPPT_2' WHERE KD_KECAMATAN='$KECAMATAN' AND KD_KELURAHAN='$KELURAHAN' AND THN_PAJAK_SPPT='$TAHUN' AND PBB_YG_HARUS_DIBAYAR_SPPT <= (SELECT NILAI_MAX_BUKU FROM REF_BUKU WHERE KD_BUKU=2) AND PBB_YG_HARUS_DIBAYAR_SPPT >= (SELECT NILAI_MIN_BUKU FROM REF_BUKU WHERE KD_BUKU=2)";
            mysqli_query($conn, $buku2);
        }

        if (isset($_POST['checkedbuku3'])) {
            $TGL_JATUH_TEMPO_SPPT_3 = $_POST['TGL_JATUH_TEMPO_SPPT_3'];
            $TGL_TERBIT_SPPT_3      = $_POST['TGL_TERBIT_SPPT_3'];
            $buku1 = "UPDATE ALL_SPPT SET TGL_JATUH_TEMPO_SPPT='$TGL_JATUH_TEMPO_SPPT_3', TGL_TERBIT_SPPT='$TGL_TERBIT_SPPT_3' WHERE KD_KECAMATAN='$KECAMATAN' AND KD_KELURAHAN='$KELURAHAN' AND THN_PAJAK_SPPT='$TAHUN' AND PBB_YG_HARUS_DIBAYAR_SPPT <= (SELECT NILAI_MAX_BUKU FROM REF_BUKU WHERE KD_BUKU=3) AND PBB_YG_HARUS_DIBAYAR_SPPT >= (SELECT NILAI_MIN_BUKU FROM REF_BUKU WHERE KD_BUKU=3)";
            mysqli_query($conn, $buku3);
        }

        if (isset($_POST['checkedbuku4'])) {
            $TGL_JATUH_TEMPO_SPPT_4 = $_POST['TGL_JATUH_TEMPO_SPPT_4'];
            $TGL_TERBIT_SPPT_4      = $_POST['TGL_TERBIT_SPPT_4'];
            $buku1 = "UPDATE ALL_SPPT SET TGL_JATUH_TEMPO_SPPT='$TGL_JATUH_TEMPO_SPPT_4', TGL_TERBIT_SPPT='$TGL_TERBIT_SPPT_4' WHERE KD_KECAMATAN='$KECAMATAN' AND KD_KELURAHAN='$KELURAHAN' AND THN_PAJAK_SPPT='$TAHUN' AND PBB_YG_HARUS_DIBAYAR_SPPT <= (SELECT NILAI_MAX_BUKU FROM REF_BUKU WHERE KD_BUKU=4) AND PBB_YG_HARUS_DIBAYAR_SPPT >= (SELECT NILAI_MIN_BUKU FROM REF_BUKU WHERE KD_BUKU=4)";
            mysqli_query($conn, $buku4);
        }

        if (isset($_POST['checkedbuku5'])) {
            $TGL_JATUH_TEMPO_SPPT_5 = $_POST['TGL_JATUH_TEMPO_SPPT_5'];
            $TGL_TERBIT_SPPT_5      = $_POST['TGL_TERBIT_SPPT_5'];
            $buku1 = "UPDATE ALL_SPPT SET TGL_JATUH_TEMPO_SPPT='$TGL_JATUH_TEMPO_SPPT_5', TGL_TERBIT_SPPT='$TGL_TERBIT_SPPT_5' WHERE KD_KECAMATAN='$KECAMATAN' AND KD_KELURAHAN='$KELURAHAN' AND THN_PAJAK_SPPT='$TAHUN' AND PBB_YG_HARUS_DIBAYAR_SPPT <= (SELECT NILAI_MAX_BUKU FROM REF_BUKU WHERE KD_BUKU=5) AND PBB_YG_HARUS_DIBAYAR_SPPT >= (SELECT NILAI_MIN_BUKU FROM REF_BUKU WHERE KD_BUKU=5)";
            mysqli_query($conn, $buku5);
        }

        $_SESSION['kecamatan'] = $KECAMATAN;
        $_SESSION['kelurahan'] = $KELURAHAN;
        $_SESSION['tahun'] = $TAHUN;
        header("Location: penetapan-massal.php");
    } else {
        header("Location: penetapan-massal.php");
    }
 } else {
   if ($_SESSION['ROLE']=="PEMBATALAN") {
     header("Location: ../pembatalan/index.php");
   } else {
     header("Location: ../../index.php");
   }
} ?>
