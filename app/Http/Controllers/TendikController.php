<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Biodata_tendik;
use App\Angket_tendik;

use Illuminate\Support\Facades\DB;

class TendikController extends Controller
{
  function __construct()
  {
    $this->middleware(function($request, $next){

      if(null == session("userID")){
        session()->flash("msg", "Terjadi Kesalahan Mengambil data tendik");
        return redirect("/");
      }
      if(session("tipe") != 3){
        session()->flash("msg", "Terjadi Kesalahan Mengambil data tendik");
        return redirect("/");
      }

      return $next($request);

    })->except(["report", "responden", "get_datatable_responden"]);

  }


  public function index()
  {

    return redirect("/tendik/angket"); 
  }

  public function angket()
  {
    return view('tendik/angket');
  }

  public function simpanAngket(Request $request){

    $this->simpanBiodata();
    $data = $this->dataKuesioner($request->except("_token"));

    Angket_tendik::insert($data);

// session()->forget("userID");
    session()->flash("msg", "Terima kasih telah berpartisipasi mengisi angket.");
    return redirect("/");
  }

  function simpanBiodata(){

    $biodata = Biodata_tendik::updateOrCreate(["nip"=>session("userID")], $this->getDataTendik());
  }

  function getDataTendik(){
    $tendik = [];
    $data_tendik = DB::connection("pgsql_2")->table("pegawai.pegawai")
    ->join("pegawai.unit_kerja", "pegawai.kode_unit", '=', 'unit_kerja.kode_unit')
    ->select("nip", "nama_pegawai", "gelar_depan", "gelar_belakang", "unit_kerja.nama_unit")->where("pegawai.nip", "=", session("userID"))->first();
// die(print_r($data_tendik));
    $tendik["nama"] = $data_tendik->gelar_depan.((!empty($data_tendik->gelar_depan))? " ": null).$data_tendik->nama_pegawai." ".$data_tendik->gelar_belakang;
    $tendik["nama_unit"] = $data_tendik->nama_unit;
    $tendik["nip"] = session("userID");
// dd($tendik);
    return $tendik;
  }

  function dataKuesioner($request){
$user_id = session("userID"); //diubah ke session hasil dari simpanBiodata
$tahun = (null != session('tahun')) ? session('tahun') : date("Y") ;
$timestamp = date("Y-m-d H:i:s");
$data = array();
$i=0;
foreach ($request as $key => $value) {
  $data[$i]["tendik_nip"] = $user_id;
  $data[$i]["tahun"] = $tahun;
  $data[$i]["kuesioner"] = $key;
  $data[$i]["value"] = (is_array($value))? json_encode($value) : $value;
  $data[$i]["created_at"] = $timestamp;
  $i++;
}

// dd($data);

return $data;
}

function report() {
  $data_db = DB::table("angket_tendik")->select("kuesioner", "value", DB::raw("COUNT(id) as count"))->whereIn("kuesioner", ["q1", "q4"])->groupBy("kuesioner", "value")->get();

  $list_pemahaman_vmts = array(
    "unit" => array("ya"=>0, "tidak"=>0, "total_responden"=>0),
    "universitas" => array("ya"=>0, "tidak"=>0, "total_responden"=>0),
  );
  foreach ($data_db as $key => $row) {
    if($row->kuesioner == 'q1') {
      if($row->value == 'Ya') {
        $list_pemahaman_vmts['unit']['ya'] = $row->count;
      }
      elseif($row->value == 'Tidak') {
        $list_pemahaman_vmts['unit']['tidak'] = $row->count;
      }
      $list_pemahaman_vmts["unit"]["total_responden"] = $list_pemahaman_vmts["unit"]["ya"] + $list_pemahaman_vmts["unit"]["tidak"];
    }
    if($row->kuesioner == 'q4') {
      if($row->value == 'Ya') {
        $list_pemahaman_vmts['universitas']['ya'] = $row->count;
      }
      elseif($row->value == 'Tidak') {
        $list_pemahaman_vmts['universitas']['tidak'] = $row->count;
      }
      $list_pemahaman_vmts["universitas"]["total_responden"] = $list_pemahaman_vmts["universitas"]["ya"] + $list_pemahaman_vmts["universitas"]["tidak"];
    }
  }


//Pertanyaan 2: Rumusan VMTS Universitas
  $data_db = DB::table("angket_tendik")
  ->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
  ->where('kuesioner', 'q2')
  ->groupBy('value')
  ->get();
  $media_vmts_unit = array(
    'kuesioner' => array(
      'Rapat' => 0,
      'Katalog dan/atau dokumen jurusan lainnya' => 0, 
      'Membaca banner' => 0, 
      'Kegiatan kemahasiswaan' => 0, 
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
        foreach ($media_vmts_unit['kuesioner'] as $pertanyaan => $jumlah) {
          if(strtolower($jawaban) == strtolower($pertanyaan)) {
            $media_vmts_unit['kuesioner'][$pertanyaan] += $row->jumlah_responden;
            $lain_exist = false;
          }
        }
//tambahkan counter pilihan "Lain-lain" jika ada value custom
        $media_vmts_unit['kuesioner']['Lain-lain'] += ($lain_exist ? $row->jumlah_responden : 0);
        $media_vmts_unit['total_pilihan']++;
      }
    }

    $media_vmts_unit['total_responden'] += $row->jumlah_responden;
  }

//Pertanyaan 3: Kinerja Unit
  $data_db = DB::table("angket_tendik")
  ->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
  ->where('kuesioner', 'q3')
  ->groupBy('value')
  ->get();
  $kinerja_unit = array(
    'kuesioner' => array(
      'Kinerja sudah selaras dengan visi, misi, tujuan dan sasaran UM' => 0, 
      'Kinerja cukup selaras dengan visi, misi, tujuan dan sasaran UM' => 0, 
      'Kinerja kurang selaras dengan visi, misi, tujuan dan sasaran UM' => 0, 
      'Tidak tahu karena tidak mengetahui rumusan visi, misi, tujuan dan sasaran UM' => 0, 
      'Tidak tahu karena tidak pernah memperhatikan' => 0,
    ),
    'total_responden' => 0
  );
  foreach ($data_db as $row) {
    foreach ($kinerja_unit['kuesioner'] as $pertanyaan => $jumlah) {
      if(strtolower($row->value) == strtolower($pertanyaan)) {
        $kinerja_unit['kuesioner'][$pertanyaan] += $row->jumlah_responden;
      }
    }
    $kinerja_unit['total_responden'] += $row->jumlah_responden;
  }



  $data_db = DB::table("angket_tendik")
  ->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
  ->where('kuesioner', 'q5')
  ->groupBy('value')
  ->get();
  $media_vmts_universitas = array(
    'kuesioner' => array(
      'Rapat' => 0,
      'Katalog dan/atau dokumen jurusan lainnya' => 0, 
      'Membaca banner' => 0, 
      'Kegiatan kemahasiswaan' => 0, 
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
        foreach ($media_vmts_universitas['kuesioner'] as $pertanyaan => $jumlah) {
          if(strtolower($jawaban) == strtolower($pertanyaan)) {
            $media_vmts_universitas['kuesioner'][$pertanyaan] += $row->jumlah_responden;
            $lain_exist = false;
          }
        }
//tambahkan counter pilihan "Lain-lain" jika ada value custom
        $media_vmts_universitas['kuesioner']['Lain-lain'] += ($lain_exist ? $row->jumlah_responden : 0);
        $media_vmts_universitas['total_pilihan']++;
      }
    }

    $media_vmts_universitas['total_responden'] += $row->jumlah_responden;
  }

//Pertanyaan 3: Kinerja Universitas
  $data_db = DB::table("angket_tendik")
  ->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
  ->where('kuesioner', 'q6')
  ->groupBy('value')
  ->get();
  $kinerja_universitas = array(
    'kuesioner' => array(
      'Kinerja sudah selaras dengan visi, misi, tujuan dan sasaran UM' => 0, 
      'Kinerja cukup selaras dengan visi, misi, tujuan dan sasaran UM' => 0, 
      'Kinerja kurang selaras dengan visi, misi, tujuan dan sasaran UM' => 0, 
      'Tidak tahu karena tidak mengetahui rumusan visi, misi, tujuan dan sasaran UM' => 0, 
      'Tidak tahu karena tidak pernah memperhatikan' => 0,
    ),
    'total_responden' => 0
  );
  foreach ($data_db as $row) {
    foreach ($kinerja_universitas['kuesioner'] as $pertanyaan => $jumlah) {
      if(strtolower($row->value) == strtolower($pertanyaan)) {
        $kinerja_universitas['kuesioner'][$pertanyaan] += $row->jumlah_responden;
      }
    }
    $kinerja_universitas['total_responden'] += $row->jumlah_responden;
  }

  $list_q7a = $this->kepuasan('angket_tendik', ['q7a','q7b']);
//$list_q7b = $this->kepuasan('angket_tendik', 'q7b');
  $list_q7c = $this->kepuasan('angket_tendik', ['q7c','q7d','q7e','q7f']);
//$list_q7d = $this->kepuasan('angket_tendik', 'q7d');
//$list_q7e = $this->kepuasan('angket_tendik', 'q7e');
//$list_q7f = $this->kepuasan('angket_tendik', 'q7f');
  $list_q7g = $this->kepuasan('angket_tendik', ['q7g','q7h','q7i','q7j','q7k','q7l','q7m']);
//$list_q7h = $this->kepuasan('angket_tendik', 'q7h');
//$list_q7i = $this->kepuasan('angket_tendik', 'q7i');
//$list_q7j = $this->kepuasan('angket_tendik', 'q7j');
//$list_q7k = $this->kepuasan('angket_tendik', 'q7k');
//$list_q7l = $this->kepuasan('angket_tendik', 'q7l');
//$list_q7m = $this->kepuasan('angket_tendik', 'q7m');
  $list_q7n = $this->kepuasan('angket_tendik', ['q7n','q7o','q7p','q7q','q7r','q7s','q7t','q7u','q7v']);
// $list_q7o = $this->kepuasan('angket_tendik', 'q7o');
//$list_q7p = $this->kepuasan('angket_tendik', 'q7p');
//$list_q7q = $this->kepuasan('angket_tendik', 'q7q');
//$list_q7r = $this->kepuasan('angket_tendik', 'q7r');
//$list_q7s = $this->kepuasan('angket_tendik', 'q7s');
//$list_q7t = $this->kepuasan('angket_tendik', 'q7t');
//$list_q7u = $this->kepuasan('angket_tendik', 'q7u');
//$list_q7v = $this->kepuasan('angket_tendik', 'q7v');


  return view("tendik.report", compact('list_pemahaman_vmts', 'media_vmts_unit','media_vmts_universitas','kinerja_unit','kinerja_universitas','list_q1', 'list_q2', 'list_q3', 'list_q4', 'list_q5', 'list_q6', 'list_q7a', 'list_q7b', 'list_q7c', 'list_q7d', 'list_q7e', 'list_q7f', 'list_q7g', 'list_q7h', 'list_q7i', 'list_q7j', 'list_q7k', 'list_q7l', 'list_q7m', 'list_q7n', 'list_q7o', 'list_q7p', 'list_q7q', 'list_q7r', 'list_q7s', 'list_q7t', 'list_q7u', 'list_q7v'));
}

  function responden() {
    $data = array(
      'list_unit' => getListUnitKerja(),
    );
    return view('tendik/responden', $data);
  }

  function get_datatable_responden(Request $request) {
    $params = $request->all();
    $columns = ['id', 'nip', 'nama', 'unit_kerja', 'created_at', 'id'];

    $totalData = DB::table('angket_tendik')
    ->select(DB::raw("COUNT(id) AS jumlah_responden"))
    ->where('kuesioner', 'q1')
    ->count();

    $data_db = DB::table('angket_tendik')
    ->select(DB::raw('group1.tendik_nip, group1.created_at, tendik.nip, tendik.nama, tendik.nama_unit'))
    ->from(DB::raw('(select tendik_nip, created_at from angket_tendik group by tendik_nip, created_at) AS group1'))
    ->join('biodata_tendik AS tendik', 'tendik.nip', '=', 'group1.tendik_nip');
    if($params['unit_kerja']) { 
      $data_db->where("tendik.nama_unit", "ILIKE", "%{$params['unit_kerja']}%");
    }
    if($params['rentang_tanggal']) { 
      $split_date = explode(' - ', $params['rentang_tanggal']);
      $start_date = date('Y-m-d', strtotime(trim($split_date[0])));
      $end_date = date('Y-m-d', strtotime(trim($split_date[1])));
      $data_db->whereBetween(DB::raw("DATE(group1.created_at)"), [$start_date, $end_date]);
    }
    if(!empty($params['search']['value'])) {
      $data_db->where(function($query) use ($params) {
        $query->orWhere("tendik.nip", "ILIKE", "%{$params['search']['value']}%");
        $query->orWhere("tendik.nama", "ILIKE", "%{$params['search']['value']}%");
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
      $tbody[] = $row->nip;
      $tbody[] = $row->nama;
      $tbody[] = $row->nama_unit;
      $tbody[] = date("d-m-Y H:i", strtotime($row->created_at));
      $tbody[] = '<div>'
      .'<div class="btn-group">'
      .'<a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" onclick="showDetail(\''.$row->tendik_nip.'\',\''.$row->created_at.'\');" title="Lihat Detail"> <i class="fa fa-list"></i> </a>'
      .'<a href="" class="btn btn-sm btn-outline-danger" onclick="prepDelete(\''.$row->tendik_nip.'\',\''.$row->created_at.'\');" title="Hapus data"> <i class="fa fa-trash-alt"></i> </a>'
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
