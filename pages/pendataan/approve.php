<?php
    session_start();//session starts here
    include '../../bin/dbconn.php';

    if (isset($_GET['approve']) || isset($_POST['approve'])) {
          $NO_FORMULIR = $_POST['NO_FORMULIR'];

          $sql = "select a.*, b.KD_KLS_BNG, b.LUAS_BNG from SPOP a 
                                LEFT JOIN LSPOP b
                                on(a.KD_KECAMATAN=b.KD_KECAMATAN and a.KD_KELURAHAN=b.KD_KELURAHAN and a.KD_BLOK=b.KD_BLOK and a.NO_URUT=b.NO_URUT and a.KD_JNS_OP=b.KD_JNS_OP and a.NO_FORMULIR=b.NO_FORMULIR)
                                where a.NO_FORMULIR='".$NO_FORMULIR."'";
          $sqla = mysqli_query($conn, $sql) or die(mysqli_error($conn));

          $data = mysqli_fetch_assoc($sqla);
            $bng = "select NILAI_PER_M2_BNG*1000 as NJOP_BNG from KELAS_BANGUNAN_2016 where KD_KLS_BNG='".$data['KD_KLS_BNG']."'";
            $bnga = mysqli_query($conn, $bng);
            $njopbng = mysqli_fetch_assoc($bnga);

            $tnh = "select NILAI_PER_M2_TANAH*1000 as NJOP_BUMI from KELAS_TANAH_2016 where KD_KLS_TANAH='".$data['KD_KLS_TANAH']."'";
            $tnha = mysqli_query($conn, $tnh);
            $njoptnh = mysqli_fetch_assoc($tnha);

            $KD_PROPINSI          = $data['KD_PROPINSI'];
            $KD_DATI2             = $data['KD_DATI2'];
            $KD_KECAMATAN         = $data['KD_KECAMATAN'];
            $KD_KELURAHAN         = $data['KD_KELURAHAN'];
            $KD_BLOK              = $data['KD_BLOK'];
            $NO_URUT              = $data['NO_URUT'];
            $KD_JNS_OP            = $data['KD_JNS_OP'];
            $SUBJEK_PAJAK_ID      = $data['KTP_WP'];
            $NO_FORMULIR_SPOP     = $data['NO_FORMULIR'];
            $NO_PERSIL            = $data['NO_PERSIL'];
            $JALAN_OP             = $data['JALAN_OP'];
            $BLOK_KAV_NO_OP       = $data['BLOK_KAV_NO_OP'];
            $RW_OP                = $data['RW_OP'];
            $RT_OP                = $data['RT_OP'];
            $KD_STATUS_CABANG     = $data['KD_STATUS_CABANG'];
            $KD_STATUS_WP         = $data['KD_STATUS_WP'];
            $TOTAL_LUAS_BUMI      = $data['TOTAL_LUAS_BUMI'];
            $TOTAL_LUAS_BNG       = $data['LUAS_BNG'];
            $NJOP_BUMI            = $njoptnh['NJOP_BUMI'];
            $NJOP_BNG             = $njopbng['NJOP_BNG'];
            $STATUS_PETA_OP       = "0";
            $JNS_TRANSAKSI_OP     = $data['KD_JNS_TRANSAKSI'];
            $TGL_PENDATAAN_OP     = $data['TGL_PENDATAAN'];
            $NIP_PENDATA          = $data['NIP_PENDATA'];
            $TGL_PEMERIKSAAN_OP   = date('Y-m-d', time());
            $NIP_PEMERIKSA_OP     = $_SESSION['NIP'];
            $TGL_PEREKAMAN_OP     = $data['TGL_REKAM_OP'];
            $NIP_PEREKAM_OP       = $data['NIP_PEREKAM'];

            $NM_WP                  = $data['NM_WP'];
            $JALAN_WP               = $data['JALAN_WP'];
            $RW_WP                  = $data['RW_WP'];
            $RT_WP                  = $data['RT_WP'];
            $NPWP                   = $data['NPWP'];
            $STATUS_PEKERJAAN_WP    = $data['STATUS_PEKERJAAN_WP'];
            $BLOK_KAV_NO_WP         = $data['BLOK_KAV_NO_WP'];
            $KELURAHAN_WP           = $data['KELURAHAN_WP'];
            $KOTA_WP                = $data['KOTA_WP'];
            $KD_POS_WP              = $data['KD_POS_WP'];
            $TELP_WP                = $data['TELP_WP'];


            $APPROVE = "INSERT INTO DAT_OBJEK_PAJAK_TES SET KD_PROPINSI='$KD_PROPINSI', KD_DATI2='$KD_DATI2', KD_KECAMATAN='$KD_KECAMATAN', KD_KELURAHAN='$KD_KELURAHAN', KD_BLOK='$KD_BLOK', NO_URUT='$NO_URUT', KD_JNS_OP='$KD_JNS_OP', SUBJEK_PAJAK_ID='$SUBJEK_PAJAK_ID', NO_FORMULIR_SPOP='$NO_FORMULIR_SPOP', NO_PERSIL='$NO_PERSIL', JALAN_OP='$JALAN_OP', BLOK_KAV_NO_OP='$BLOK_KAV_NO_OP', RW_OP='$RW_OP', RT_OP='$RT_OP', KD_STATUS_CABANG='$KD_STATUS_CABANG', KD_STATUS_WP='$KD_STATUS_WP', TOTAL_LUAS_BUMI='$TOTAL_LUAS_BUMI', TOTAL_LUAS_BNG='$TOTAL_LUAS_BNG', NJOP_BUMI='$NJOP_BUMI', NJOP_BNG='$NJOP_BNG', STATUS_PETA_OP='$STATUS_PETA_OP', JNS_TRANSAKSI_OP='$JNS_TRANSAKSI_OP', TGL_PENDATAAN_OP='$TGL_PENDATAAN_OP', NIP_PENDATA='$NIP_PENDATA', TGL_PEMERIKSAAN_OP='$TGL_PEMERIKSAAN_OP', NIP_PEMERIKSA_OP='$NIP_PEMERIKSA_OP', TGL_PEREKAMAN_OP='$TGL_PEREKAMAN_OP', NIP_PEREKAM_OP='$NIP_PEREKAM_OP'";
            if (mysqli_query($conn, $APPROVE) or die(mysqli_error($conn))) {
              
                $APPROVE_SP = "INSERT INTO DAT_SUBJEK_PAJAK_TES SET SUBJEK_PAJAK_ID='$SUBJEK_PAJAK_ID', NM_WP='$NM_WP', JALAN_WP='$JALAN_WP', BLOK_KAV_NO_WP='$BLOK_KAV_NO_WP', RW_WP='$RW_WP', RT_WP='$RT_WP', KELURAHAN_WP='$KELURAHAN_WP', KOTA_WP='$KOTA_WP', KD_POS_WP='$KD_POS_WP', TELP_WP='$TELP_WP', NPWP='$NPWP', STATUS_PEKERJAAN_WP='$STATUS_PEKERJAAN_WP'";
                if (mysqli_query($conn, $APPROVE_SP) or die(mysqli_error($conn))) {
                    $CHECK = "UPDATE SPOP SET STATUS_APPROVE='1' WHERE NO_FORMULIR='$NO_FORMULIR'";
                    if (mysqli_query($conn, $CHECK)) {
                        $_SESSION['notif'] = "SPOP Telah Diapprove";
                        header("Location: spop.php");
                      } else {
                        $_SESSION['gagal'] = "SPOP Gagal Diapprove";
                        header("Location: spop.php");
                    }
                } else {
                    echo "Gagal";
                }
            } else {
              echo "Gagal";
            }
        } else {
            echo "Tidak ada proses";
        }
?>