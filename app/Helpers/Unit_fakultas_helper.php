<?php

/* Helper function for getting list fakultas, jurusan, prodi, & unit kerja (usually for select2) */

if (!function_exists('getListFakultas')) {
  //GET LIST FAKULTAS, JURUSAN, PRODI, & UNIT KERJA
  function getListFakultas(){
    $data_db = DB::connection("pgsql_2")->table("dtum.m_fak")->select("fak_kd", "fak_nm", "fak_skt");
    $data_db->where("fak_kd", "!=", '00');
    $data_db->orderBy('fak_kd', 'asc');
    $data_db = $data_db->get();

    return $data_db;
  }
}

if (!function_exists('getListJurusan')) {
  function getListJurusan($fak_kd=''){
    $data_db = DB::connection("pgsql_2")->table("dtum.m_jur")->select("jur_kd", "jur_nm", "fak_kd");
    if($fak_kd) {
      $data_db->where("fak_kd", "=", $fak_kd);
    }
    $data_db->where("fak_kd", "!=", '00');
    $data_db->orderBy('fak_kd', 'asc');
    $data_db->orderBy('jur_kd', 'asc');
    $data_db = $data_db->get();

    return $data_db;
  }
}

if (!function_exists('getListProdi')) {
  function getListProdi($jur_kd=''){
    $data_db = DB::connection("pgsql_2")->table("dtum.m_prodi")->select("pro_kd", "pro_nm", "jur_kd");
    if($jur_kd) {
      $data_db->where("jur_kd", "=", $jur_kd);
    }
    $data_db->where("jur_kd", "!=", '00');
    $data_db->orderBy('jur_kd', 'asc');
    $data_db->orderBy('pro_kd', 'asc');
    $data_db = $data_db->get();

    return $data_db;
  }
}

if (!function_exists('getListJurusanProdi')) {
  function getListJurusanProdi($jur_kd=''){
    $data_db = DB::connection("pgsql_2")->table("dtum.m_prodi AS prodi")
    ->select("prodi.pro_kd", "prodi.pro_nm", "prodi.pro_skt", "prodi.jur_kd", "jurusan.jur_nm", "jurusan.jur_skt", "jurusan.fak_kd")
    ->join("dtum.m_jur AS jurusan", "jurusan.jur_kd", "=", "prodi.jur_kd");
    if($jur_kd) {
      $data_db->where("prodi.jur_kd", "=", $jur_kd);
    }
    $data_db->where("prodi.jur_kd", "!=", '00');
    $data_db->orderBy('prodi.jur_kd', 'asc');
    $data_db->orderBy('prodi.pro_kd', 'asc');
    $data_db = $data_db->get();

    return $data_db;
  }
}

if (!function_exists('getListUnitKerja')) {
  function getListUnitKerja($kode_unit=''){
    $data_db = DB::connection("pgsql_2")->table("pegawai.unit_kerja AS unit")
    ->select("unit.kode_unit", "unit.nama_unit");
    if($kode_unit) {
      $data_db->where("unit.kode_unit", "=", $kode_unit);
    }
    $data_db->orderBy('unit.kode_unit', 'asc');
    $data_db = $data_db->get();

    return $data_db;
  }
}
