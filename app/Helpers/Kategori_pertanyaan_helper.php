<?php

/* Helper function for categorizing pertanyaan (used in laporan survei, list jawaban mentah) */

if (!function_exists('getKategoriPertanyaan')) {
  //GET LIST FAKULTAS, JURUSAN, PRODI, & UNIT KERJA
  function getKategoriPertanyaan($sasaran=''){
    switch ($sasaran) {
      case 'dosen':
        $result = [
          'Prodi' => ['q1', 'q2', 'q3'], 
          'Fakultas'  => ['q4', 'q5', 'q6'], 
          'Universitas' => ['q7', 'q8', 'q9'], 
          'Kepuasan'  => [
            'q10b', 'q10c', 'q10d' //VMTS Prodi, fakultas, universitas
            , 'q10a', 'q10f' //SDM (Penerimaan dosen, Beban mengajar)
            , 'q10e', 'q10g', 'q10h', 'q10i', 'q10j' //Pendidikan (Capaian pembelajaran, Sumber belajar, Penjadwalan, Sarana dan Prasarana mengajar, Dukungan untuk penelitian)
            , 'q10k', 'q10l' //Penelitian (Dukungan untuk diseminasi dan publikasi, Fasilitas )
            , 'q10m', 'q10n' //Abmas (Dukungan akademik dan pendanaan, fasilitas)
            , 'q10x', 'q10y', 'q10z', 'q10bb' //Keuangan, Sarana dan Prasarana (pengembangan profesi, Promosi dan retensi, Lingkungan, keselamatan, dan keamanan kerja, Gaji dan tunjangan )
            , 'q10o', 'q10p', 'q10q', 'q10r', 'q10s', 'q10t', 'q10u', 'q10v', 'q10w' //Kepuasan Layanan (Persyaratan, Prosedur, Waktu, Biaya, Produk, Kompetensi, Perilaku, Pengaduan, Kualitas Layanan)
          ], 
          'Bukti Pemahaman' => ['buktipemahamanvmts'], 
          'Kepuasan Kinerja'  => ['kepuasankinerja'],
          'Ketidakpuasan Kinerja'  => ['ketidakpuasankinerja'],
          'Rencana Kerja' => ['rencanakinerja'],
        ];
        break;
      
      default:
        $result = FALSE;
        break;
    }
    return $result;
  }
}
