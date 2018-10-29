<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;
use App\Biodata_pengguna;
use App\Angket_pengguna;

class PenggunaController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
  return view("pengguna/identitas");
}

/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/

public function angket()
{
  if(null == session("biodata_id")){
    session()->flash("msg", "Isikan biodata anda.");
    return redirect("/pengguna");
  }
  return view('pengguna/angket');

}


public function create()
{
//
}

/**
* Store a newly created resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{

}

/**
* Display the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
//
}

/**
* Show the form for editing the specified resource.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
//
}

/**
* Update the specified resource in storage.
*
* @param  \Illuminate\Http\Request  $request
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
//
}

/**
* Remove the specified resource from storage.
*
* @param  int  $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
//
}

public function simpanBiodata(Request $request){
  $biodata = new Biodata_pengguna;
  $biodata->jabatan_pengisi = $request->jabatan_pengisi;
  $biodata->nama_instansi = $request->nama_instansi;
  $biodata->tahun_berdiri = $request->tahun_berdiri;
  $biodata->skala_operasional = $request->skala_operasional;
  $biodata->jumlah_pegawai = $request->jumlah_pegawai;
  $biodata->jumlah_um = $request->jumlah_um;
  $biodata->email =$request->email;

  if($biodata->save()){
// dd($biodata->id);
    session(["biodata_id" => $biodata->id]);
// dd(session("biodata_id"));
    return redirect("/pengguna/angket");
  }
  else {
    return redirect()->back()->withInput();
  }

}


public function simpanAngket(Request $request){
  if(null == session("biodata_id")){
    session()->flash("msg", "Isikan biodata anda.");
    return redirect("/pengguna");
  }
  $data = $this->dataKuesioner($request->except("_token"));

  Angket_pengguna::insert($data);

  session()->forget("biodata_id");
  session()->flash("msg", "Terima kasih telah berpartisipasi mengisi angket.");
  return redirect("/");
}

function dataKuesioner($request){
$biodata_id = session("biodata_id"); //diubah ke session hasil dari simpanBiodata
$tahun = (null != session('tahun')) ? session('tahun') : date("Y") ;
$timestamp = date("Y-m-d H:i:s");
$data = array();
$i=0;
foreach ($request as $key => $value) {
  $data[$i]["biodata_pengguna_id"] = $biodata_id;
  $data[$i]["tahun"] = $tahun;
  $data[$i]["kuesioner"] = $key;
  $data[$i]["value"] = (is_array($value))? json_encode($value) : $value;
  $data[$i]["created_at"] = $timestamp;
  $i++;
}

// dd($data);

return $data;
}

public function report() {
  $m_angket = new Angket_pengguna;

//Pertanyaan 1: Pemahaman VTMS Universitas
  $data_db = $m_angket->where('kuesioner', 'q1')->get();
  $list_q1 = array(
    'jumlah_ya' => 0, 
    'jumlah_tidak' => 0, 
    'total_responden' => count($data_db)
  );
  foreach ($data_db as $row) {
    if(strtolower($row->value) == 'ya') {
      $list_q1['jumlah_ya']++;
    }
    else if(strtolower($row->value) == 'tidak') {
      $list_q1['jumlah_tidak']++;
    }
  }

//Pertanyaan 2: Rumusan VMTS Universitas
  $data_db = DB::table("angket_pengguna")
  ->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
  ->where('kuesioner', 'q2')
  ->groupBy('value')
  ->get();
  $list_q2 = array(
    'kuesioner' => array(
      'Dokumen Jurusan (mis: katalog)' => 0,
      'Dokumen Universitas (mis: prospectus)' => 0,
      'Membaca banner' => 0, 
      'Kegiatan Kemahasiswaan' => 0, 
      'Laman UM' => 0, 
      'Lain-lain' => 0,
    ),
    'total_responden' => 0,
    'total_pilihan' => 0
  );

  foreach ($data_db as $row) {
    $arr_value = json_decode($row->value);

    if(!empty($arr_value)) {
      foreach ($arr_value as $jawaban) {
        $lain_exist = true;
        foreach ($list_q2['kuesioner'] as $pertanyaan => $jumlah) {
          if(strtolower($jawaban) == strtolower($pertanyaan)) {
            $list_q2['kuesioner'][$pertanyaan] += $row->jumlah_responden;
            $lain_exist = false;
          }
        }
//tambahkan counter pilihan "Lain-lain" jika ada value custom
        $list_q2['kuesioner']['Lain-lain'] += ($lain_exist ? $row->jumlah_responden : 0);
        $list_q2['total_pilihan']++;
      }
    }

    $list_q2['total_responden'] += $row->jumlah_responden;
  }

//Pertanyaan 3: Kinerja Universitas
  $list_q3 = array(
    'kuesioner' => array(
      'Kinerja sudah selaras dengan visi, misi, tujuan dan sasaran UM' => 0, 
      'Kinerja cukup selaras dengan visi, misi, tujuan dan sasaran UM' => 0, 
      'Kinerja kurang selaras dengan visi, misi, tujuan dan sasaran UM' => 0, 
      'Tidak tahu karena tidak mengetahui rumusan visi, misi, tujuan dan sasaran UM' => 0, 
      'Tidak tahu karena tidak pernah memperhatikan' => 0,
    ),
    'total_responden' => 0
  );
  $data_db = DB::table("angket_pengguna")
  ->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
  ->where('kuesioner', 'q3')
  ->groupBy('value')
  ->get();

  foreach ($data_db as $row) {
    foreach ($list_q3['kuesioner'] as $pertanyaan => $jumlah) {
      if(strtolower($row->value) == strtolower($pertanyaan)) {
        $list_q3['kuesioner'][$pertanyaan] += $row->jumlah_responden;
      }
    }
    $list_q3['total_responden'] += $row->jumlah_responden;
  }

  $list_q4a = $this->kepuasan('angket_pengguna', ['q4a', 'q4b', 'q4c', 'q4d', 'q4e', 'q4f', 'q4g', 'q4h', 'q4i']);

  $list_q5a = $this->kepuasan('angket_pengguna', 'q5a');
  $list_q5b = $this->kepuasan('angket_pengguna', 'q5b');
  $list_q5c = $this->kepuasan('angket_pengguna', 'q5c');
  $list_q5d = $this->kepuasan('angket_pengguna', 'q5d');

  $list_q5e = $this->kepuasan('angket_pengguna', ['q5e', 'q5f', 'q5g', 'q5h']);

  $list_q5i = $this->kepuasan('angket_pengguna', ['q5i', 'q5j', 'q5k', 'q5l', 'q5m', 'q5n', 'q5o', 'q5p', 'q5q']);



// print_r($data_db); print_r($list_q2); die();
  return view("pengguna.report", compact('list_q1', 'list_q2', 'list_q3', 'list_q4a', 'list_q4b','list_q4c','list_q4d','list_q4e','list_q4f','list_q4g','list_q4h','list_q4i','list_q5a','list_q5b','list_q5c','list_q5d','list_q5e','list_q5i','list_q5f','list_q5g','list_q5h','list_q5j','list_q5k','list_q5l','list_q5m','list_q5n','list_q5o','list_q5p','list_q5q'));
}

function responden() {
    $data = array();
    return view('pengguna/responden');
  }

  function get_datatable_responden(Request $request) {
    $params = $request->all();
    // die(json_encode($params['fakultas']));
    $columns = ['id', 'jabatan_pengisi', 'nama_instansi', 'email', 'skala_operasional', 'jumlah_pegawai', 'jumlah_um', 'created_at', 'id'];

    $totalData = DB::table('angket_pengguna')
    ->select(DB::raw("COUNT(id) AS jumlah_responden"))
    ->where('kuesioner', 'q1')
    ->count();

    $data_db = DB::table('angket_pengguna')
    ->select(DB::raw('group1.biodata_pengguna_id, group1.created_at, pengguna.id, pengguna.jabatan_pengisi, pengguna.nama_instansi, pengguna.email, pengguna.skala_operasional, pengguna.jumlah_pegawai, pengguna.jumlah_um'))
    ->from(DB::raw('(select biodata_pengguna_id, created_at from angket_pengguna group by biodata_pengguna_id, created_at) AS group1'))
    ->join('biodata_pengguna AS pengguna', 'pengguna.id', '=', 'group1.biodata_pengguna_id');
    if($params['skala_operasional']) { 
      $data_db->where("pengguna.skala_operasional", "ILIKE", "%{$params['skala_operasional']}%");
    }
    if($params['rentang_tanggal']) { 
      $split_date = explode(' - ', $params['rentang_tanggal']);
      $start_date = date('Y-m-d', strtotime(trim($split_date[0])));
      $end_date = date('Y-m-d', strtotime(trim($split_date[1])));
      $data_db->whereBetween(DB::raw("DATE(group1.created_at)"), [$start_date, $end_date]);
    }
    if(!empty($params['search']['value'])) {
      $data_db->where(function($query) use ($params) {
        $query->orWhere("pengguna.jabatan_pengisi", "ILIKE", "%{$params['search']['value']}%");
        $query->orWhere("pengguna.nama_instansi", "ILIKE", "%{$params['search']['value']}%");
        $query->orWhere("pengguna.email", "ILIKE", "%{$params['search']['value']}%");
      });
    }
    $totalFiltered = $data_db;
    $totalFiltered = $totalFiltered->count();

    $data_db->orderBy($columns[$params['order'][0]['column']], $params['order'][0]['dir']);
    $data_db->offset($params['start']);
    $data_db->limit($params['length']);
    $data_db = $data_db->get();

    $data = []; $i = $params['start'];
    foreach ($data_db as $row) {
      $tbody   = []; 
      $tbody[] = ($i+1);
      $tbody[] = $row->jabatan_pengisi;
      $tbody[] = $row->nama_instansi;
      $tbody[] = $row->email;
      $tbody[] = $row->skala_operasional;
      $tbody[] = '<div class="text-center">'.$row->jumlah_pegawai.'</div>';
      $tbody[] = '<div class="text-center">'.$row->jumlah_um.'</div>';
      $tbody[] = date("d-m-Y H:i", strtotime($row->created_at));
      $tbody[] = '<div>'
      .'<div class="btn-group">'
      .'<a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" onclick="showDetail(\''.$row->biodata_pengguna_id.'\',\''.$row->created_at.'\');" title="Lihat Detail"> <i class="fa fa-list"></i> </a>'
      .'<a href="" class="btn btn-sm btn-outline-danger" onclick="prepDelete(\''.$row->biodata_pengguna_id.'\',\''.$row->created_at.'\');" title="Hapus data"> <i class="fa fa-trash-alt"></i> </a>'
      .'</div>'
      .'</div>';

      $data[] = $tbody; $i++;
    }
    $totalData = count($data);
    $json_data = array(
      "draw"            => intval( $params['draw'] ),
      "recordsTotal"    => intval( $totalData ),
      "recordsFiltered" => intval( $totalFiltered ),
      "data"            => $data
    );
    echo json_encode($json_data);
  }

}