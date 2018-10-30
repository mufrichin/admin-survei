<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

use App\Pertanyaan_angket;

class PertanyaanController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index() {
    $data = array(
      'list_pertanyaan' => Pertanyaan_angket::all(),
      'list_fakultas' => $this->getListFakultas(),
      'list_jurusan' => $this->getListJurusan(),
      'list_prodi' => $this->getListProdi(),
    );
    return view('pertanyaan/list_pertanyaan', $data);
  }

  public function tambah() {
    return view("pertanyaan/tambah");
  }

  public function getPertanyaan(Request $request) {
    if($request->id){
      $data_db = Pertanyaan_angket::find($request->id);
      $data = [
        'status' => 1,
        'data' => $data_db
      ];
      echo json_encode($data);   
    }
    else {
      echo json_encode(['status' => 0]);
    }
  }

  public function simpanPertanyaan(Request $request) {
    $data = $this->prepDataPertanyaan($request->except("_token"));
 
    if($data){
      $status = Pertanyaan_angket::insert($data);
 
      if($status){
        show_alert('success', '', 'Sukses! Data berhasil disimpan');
      }
      else {
        show_alert('danger', '', 'Gagal! terjadi kesalahan dalam pross penyimpanan data');
      }
    }
    return redirect("pertanyaan");
  }
  public function prepDataPertanyaan($request=[]) {
    if($request['kd_pertanyaan']) {
      $timestamp = date("Y-m-d H:i:s");
      $data = [];
      $i = 0;
      foreach ($request['kd_pertanyaan'] as $key => $value) {
        $data[$key] = [
          'sasaran' => $request['sasaran'][$key],
          'kd_pertanyaan' => $request['kd_pertanyaan'][$key],
          'pertanyaan' => $request['pertanyaan'][$key],
          'created_at' => $timestamp
        ];
        $i++;
      }
    }
    return $data;
  }

  public function ubahPertanyaan(Request $request) {
    // die(var_dump($request->all()));
    if($request->id){
      $timestamp = date("Y-m-d H:i:s");
      $data = [
        'sasaran' => $request->sasaran,
        'kd_pertanyaan' => $request->kd_pertanyaan,
        'pertanyaan' => $request->pertanyaan,
        'updated_at' => $timestamp,
      ];

      $status = Pertanyaan_angket::find($request->id)->update($data);
 
      if($status){
        show_alert('success', '', 'Sukses! Data berhasil diubah');
      }
      else {
        show_alert('danger', '', 'Gagal! terjadi kesalahan dalam proses pengubahan data');
      }
    }
    else {
      show_alert('warning', '', 'Gagal! Item pertanyaan tidak ditemukan');
    }
    return redirect("pertanyaan");
  }
  
  public function hapusPertanyaan(Request $request) {
    if($request->id){
      $status = Pertanyaan_angket::destroy($request->id);
 
      if($status){
        show_alert('success', '', 'Sukses! Data berhasil dihapus');
      }
      else {
        show_alert('danger', '', 'Gagal! terjadi kesalahan dalam proses penghapusan data');
      }
    }
    return redirect("pertanyaan");
  }

}
