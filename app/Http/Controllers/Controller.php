<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Saml2;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function pemahamanVMTS($tabel, $kuesioner) {
    $data = DB::table($table)->select("kuesioner", "value", DB::raw("COUNT(id) as count"))->where("kuesioner", $kuesioner)->groupBy("kuesioner", "value")->get();
  }

  public function mediaVMTS($tabel, $kuesioner) {
    $data = array("data"=>array(), "responden"=>0);
    $media_vmts = DB::table($tabel)
    ->select("value")
    ->where('kuesioner', $kuesioner)
    ->get();

    $data["responden"] = count($media_vmts);

    foreach ($media_vmts as $media) {
      $media->value = json_decode($media->value);
      for ($i=0; $i < sizeof($media->value) ; $i++) { 
        if(!array_key_exists($media->value[$i], $data["data"])){
          $data["data"][$media->value[$i]] = 1;
        }else{
          $data["data"][$media->value[$i]] = $data["data"][$media->value[$i]]+1;
        }

      }
    } 
    return $data;
  }

  public function kinerja($tabel, $kuesioner) {
    $data = array("data"=>array(), "responden"=>0);
    $kinerja = DB::table($tabel)
    ->select("value", DB::raw("COUNT(id) as count"))
    ->where("kuesioner", $kuesioner)
    ->groupBy("value")
    ->get();

    foreach ($kinerja as $data_kinerja) {
      $data["data"][$data_kinerja->value] = $data_kinerja->count;
      $data["responden"] = $data["responden"]+$data_kinerja->count;
    }

    return $data;
  }

  public function kinerja_prodi($tabel, $kuesioner) {
    $list_kinerja_prodi = array(
      'kuesioner' => array(
          'Kinerja sudah selaras dengan visi, misi, tujuan dan sasaran Program Studi/Jurusan' => 0, 
          'Kinerja cukup selaras dengan visi, misi, tujuan dan sasaran Program Studi/Jurusan' => 0, 
          'Kinerja kurang selaras dengan visi, misi, tujuan dan sasaran Program Studi/Jurusan' => 0, 
          'Tidak tahu karena tidak mengetahui rumusan visi, misi, tujuan dan sasaran Program Studi/Jurusan' => 0, 
          'Tidak tahu karena tidak pernah memperhatikan' => 0,
      ),
      'total_responden' => 0
    );
    $data_db = DB::table($tabel)
                ->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
                ->where('kuesioner', $kuesioner)
                ->groupBy('value')
                ->get();
    foreach ($data_db as $row) {
      foreach ($list_kinerja_prodi['kuesioner'] as $pertanyaan => $jumlah) {
        if(strtolower($row->value) == strtolower($pertanyaan)) {
          $list_kinerja_prodi['kuesioner'][$pertanyaan] += $row->jumlah_responden;
        }
      }
      $list_kinerja_prodi['total_responden'] += $row->jumlah_responden;
    }

    return $list_kinerja_prodi;
  }

  public function kepuasan($tabel, $kuesioner) {
    $list_kepuasan = array(
      'kuesioner' => array(
        'skor_4' => ["alias" => 'Sangat Puas',"responden" => 0, "skor" => 0],
        'skor_3' => ["alias" => 'Puas',"responden" => 0, "skor" => 0], 
        'skor_2' => ["alias" => 'Cukup Puas',"responden" => 0, "skor" => 0], 
        'skor_1' => ["alias" => 'Tidak Puas', "responden" => 0, "skor" => 0] 
      ),
      'total_skor' => 0,
      'total_responden' => 0
    );
    
    $query = DB::table($tabel);
    $query->select("value", 
          DB::raw("COUNT(id) AS jumlah_responden"), 
          DB::raw("SUM(value::INT) AS jumlah_skor"));
    if(is_array($kuesioner)) {
      $query->whereIn('kuesioner', $kuesioner);
    }
    else {
      $query->where('kuesioner', $kuesioner);
    }
    $data_db = $query->groupBy('value')->get();

    foreach ($data_db as $row) {
      foreach ($list_kepuasan['kuesioner'] as $pertanyaan => $jumlah) {
        if(strtolower("skor_".$row->value) == strtolower($pertanyaan)) {
          $list_kepuasan['kuesioner'][$pertanyaan]['responden'] += $row->jumlah_responden;
          $list_kepuasan['kuesioner'][$pertanyaan]['skor'] += $row->jumlah_skor;
        }
      }
      $list_kepuasan['total_skor'] += $row->value;
      $list_kepuasan['total_responden'] += $row->jumlah_responden;
    }
    
    //khusus untuk menghitung total responden pada grafik dengan multi pertanyaan (Rumus = Total responden / jumlah kategori jawaban):
    $list_kepuasan['total_responden_sesungguhnya'] = $list_kepuasan['total_responden'] / count($kuesioner);  

    return $list_kepuasan;
  }
  public function error(){
    dd(session('saml2_error_detail'));
  }

  public function logout()
  {
    return Saml2::logout();
  }

  //GET LIST FAKULTAS, JURUSAN, PRODI, & UNIT KERJA
  function getListFakultas(){
    $data_db = DB::connection("pgsql_2")->table("dtum.m_fak")->select("fak_kd", "fak_nm", "fak_skt");
    $data_db->where("fak_kd", "!=", '00');
    $data_db->orderBy('fak_kd', 'asc');
    $data_db = $data_db->get();

    return $data_db;
  }
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
