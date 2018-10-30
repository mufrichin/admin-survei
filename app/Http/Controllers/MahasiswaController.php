<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Biodata_mahasiswa;
use App\Angket_mahasiswa;
use Illuminate\Support\Facades\DB;


class MahasiswaController extends Controller
{
    function __construct()
    {
      $this->middleware(function($request, $next){
        if(session("tipe") != 1){
          session()->flash("msg", "Terjadi Kesalahan Mengambil data mahasiswa");
          return redirect("/");
        }

        if(null == session("userID")){
          session()->flash("msg", "Terjadi Kesalahan Mengambil data mahasiswa");
          return redirect("/");
        }
        return $next($request);
      })->except(["report", "responden", "get_datatable_responden"]);
    }


    public function index()
    {
      
      return redirect("/mahasiswa/angket"); 
    }

  public function simpanAngket(Request $request){
    $this->simpanBiodata();
    $data = $this->dataKuesioner($request->except("_token"));

    Angket_mahasiswa::insert($data);

    session()->flash("msg", "Terima kasih telah berpartisipasi mengisi angket.");
    return redirect("/");
  }

  function simpanBiodata(){
    $biodata = Biodata_mahasiswa::updateOrCreate(["nim"=>session("userID")], $this->getDataMahasiswa());
  }

  function angket(){
    return view("mahasiswa.angket");
  }

  function getDataMahasiswa(){
    $mahasiswa = [];
    $data_mahasiswa = DB::connection("pgsql_2")->table("dtum.m_mhs")
    ->join("dtum.m_prodi", "m_mhs.pro_kd", '=', 'm_prodi.pro_kd')
    ->join("dtum.m_jur", "m_prodi.jur_kd", '=', 'm_jur.jur_kd')
    ->join("dtum.m_fak", "m_jur.fak_kd", '=', 'm_fak.fak_kd')
    ->select("mhs_nim", "mhs_nm", "mhs_email", "kelas", "mhs_tahun", "m_prodi.pro_nm", "m_jur.jur_nm", "m_fak.fak_skt")->where("m_mhs.mhs_nim", "=", session("userID"))->first();

    $mahasiswa["nim"] = session("userID");
    $mahasiswa["nama"] = $data_mahasiswa->mhs_nm;
    $mahasiswa["email"] = $data_mahasiswa->mhs_email;
    $mahasiswa["fakultas"] = $data_mahasiswa->fak_skt;
    $mahasiswa["jurusan"] = $data_mahasiswa->jur_nm;
    $mahasiswa["prodi"] = $data_mahasiswa->pro_nm;
    $mahasiswa["kelas"] = $data_mahasiswa->kelas;
    $mahasiswa["tahun"] = $data_mahasiswa->mhs_tahun;

    return $mahasiswa;
  }

  function dataKuesioner($request) {
    $user_id = session("userID"); //diubah ke session hasil dari simpanBiodata
    $tahun = (null != session('tahun')) ? session('tahun') : date("Y");
    $timestamp = date("Y-m-d H:i:s");
    $data = array();
    $i=0;
    foreach ($request as $key => $value) {
      $data[$i]["mahasiswa_nim"] = $user_id;
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
    $m_angket = new Angket_mahasiswa;

    //Pertanyaan 1: Pemahaman VTMS prodi
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

    //Pertanyaan 2: Rumusan VMTS prodi
    $data_db = DB::table("angket_mahasiswa")
    ->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
    ->where('kuesioner', 'q2')
    ->groupBy('value')
    ->get();
    $list_q2 = array(
      'kuesioner' => array(
        'Masa Orientasi Maba' => 0,
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
        'Kinerja sudah selaras dengan visi, misi, tujuan dan sasaran Program Studi dan Jurusan' => 0, 
        'Kinerja cukup selaras dengan visi, misi, tujuan dan sasaran Program Studi dan Jurusan' => 0, 
        'Kinerja kurang selaras dengan visi, misi, tujuan dan sasaran Program Studi dan Jurusan' => 0, 
        'Tidak tahu karena tidak mengetahui rumusan visi, misi, tujuan dan sasaran Program Studi dan Jurusan' => 0, 
        'Tidak tahu karena tidak pernah memperhatikan' => 0,
      ),
      'total_responden' => 0
    );
    $data_db = DB::table("angket_mahasiswa")
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

    $list_q4a1 = $this->kepuasan('angket_mahasiswa', ['q4a1','q4a2']);
      //$list_q4a2 = $this->kepuasan('angket_mahasiswa', 'q4a2');
    $list_q4a3 = $this->kepuasan('angket_mahasiswa', ['q4a3','q4a4','q4a5','q4a6','q4a7','q4a8','q4a9','q4a12','q4a13','q4a14','q4a15','q4a16']);
      // $list_q4a4 = $this->kepuasan('angket_mahasiswa', 'q4a4');
      // $list_q4a5 = $this->kepuasan('angket_mahasiswa', 'q4a5');
      // $list_q4a6 = $this->kepuasan('angket_mahasiswa', 'q4a6');
      // $list_q4a7 = $this->kepuasan('angket_mahasiswa', 'q4a7');
      // $list_q4a8 = $this->kepuasan('angket_mahasiswa', 'q4a8');
      // $list_q4a9 = $this->kepuasan('angket_mahasiswa', 'q4a9');
    $list_q4a10 = $this->kepuasan('angket_mahasiswa', 'q4a10');
    $list_q4a11 = $this->kepuasan('angket_mahasiswa', 'q4a11');
    // $list_q4a12 = $this->kepuasan('angket_mahasiswa', ['q4a12','q4a13','q4a14','q4a15','q4a16']);
    // $list_q4a13 = $this->kepuasan('angket_mahasiswa', 'q4a13');
    // $list_q4a14 = $this->kepuasan('angket_mahasiswa', 'q4a14');
    // $list_q4a15 = $this->kepuasan('angket_mahasiswa', 'q4a15');
    // $list_q4a16 = $this->kepuasan('angket_mahasiswa', 'q4a16');
    $list_q4b1 = $this->kepuasan('angket_mahasiswa', ['q4b1','q4b2','q4b3']);
    // $list_q4b2 = $this->kepuasan('angket_mahasiswa', 'q4b2');
    // $list_q4b3 = $this->kepuasan('angket_mahasiswa', 'q4b3');
    $list_q4b4 = $this->kepuasan('angket_mahasiswa', ['q4b4','q4b5','q4b6','q4b7','q4b8','q4b9','q4b10','q4b11','q4b12']);
    // $list_q4b5 = $this->kepuasan('angket_mahasiswa', 'q4b5');
    // $list_q4b6 = $this->kepuasan('angket_mahasiswa', 'q4b6');
    // $list_q4b7 = $this->kepuasan('angket_mahasiswa', 'q4b7');
    // $list_q4b8 = $this->kepuasan('angket_mahasiswa', 'q4b8');
    // $list_q4b9 = $this->kepuasan('angket_mahasiswa', 'q4b9');
    // $list_q4b10 = $this->kepuasan('angket_mahasiswa', 'q4b10');
    // $list_q4b11 = $this->kepuasan('angket_mahasiswa', 'q4b11');
    // $list_q4b12 = $this->kepuasan('angket_mahasiswa', 'q4b12');

    return view("mahasiswa.report", compact('list_q1','list_q2','list_q3','list_q4a1','list_q4a2','list_q4a3','list_q4a4','list_q4a5','list_q4a6','list_q4a7','list_q4a8','list_q4a9','list_q4a10','list_q4a11','list_q4a12','list_q4a13','list_q4a14','list_q4a15','list_q4a16','list_q4b1','list_q4b2','list_q4b3','list_q4b4','list_q4b5','list_q4b5','list_q4b6','list_q4b7','list_q4b8','list_q4b9','list_q4b10','list_q4b11','list_q4b12'));
  }

  function responden() {
    $data = array(
      'list_fakultas' => getListFakultas(),
      'list_jurusan' => getListJurusan(),
      'list_prodi' => getListProdi(),
    );
    return view('mahasiswa/responden', $data);
  }

  function get_datatable_responden(Request $request) {
    $params = $request->all();
    // die(json_encode($params['fakultas']));
    $columns = ['id', 'nim', 'nama', 'prodi', 'jurusan', 'fakultas', 'created_at', 'id'];

    $totalData = DB::table('angket_mahasiswa')
    ->select(DB::raw("COUNT(id) AS jumlah_responden"))
    ->where('kuesioner', 'q1')
    ->count();

    $data_db = DB::table('angket_mahasiswa')
    ->select(DB::raw('group1.mahasiswa_nim, group1.created_at, mahasiswa.nim, mahasiswa.nama, mahasiswa.prodi, mahasiswa.jurusan, mahasiswa.fakultas'))
    ->from(DB::raw('(select mahasiswa_nim, created_at from angket_mahasiswa group by mahasiswa_nim, created_at) AS group1'))
    ->join('biodata_mahasiswa AS mahasiswa', 'mahasiswa.nim', '=', 'group1.mahasiswa_nim');
    if($params['fakultas']) { 
      $data_db->where("mahasiswa.fakultas", "ILIKE", "%{$params['fakultas']}%");
    }
    if($params['jurusan']) { 
      $data_db->where("mahasiswa.jurusan", "ILIKE", "%{$params['jurusan']}%");
    }
    if($params['prodi']) { 
      $data_db->where("mahasiswa.prodi", "ILIKE", "%{$params['prodi']}%");
    }
    if($params['rentang_tanggal']) { 
      $split_date = explode(' - ', $params['rentang_tanggal']);
      $start_date = date('Y-m-d', strtotime(trim($split_date[0])));
      $end_date = date('Y-m-d', strtotime(trim($split_date[1])));
      $data_db->whereBetween(DB::raw("DATE(group1.created_at)"), [$start_date, $end_date]);
    }
    if(!empty($params['search']['value'])) {
      $data_db->where(function($query) use ($params) {
        $query->orWhere("mahasiswa.nim", "ILIKE", "%{$params['search']['value']}%");
        $query->orWhere("mahasiswa.nama", "ILIKE", "%{$params['search']['value']}%");
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
      $tbody[] = $row->nim;
      $tbody[] = $row->nama;
      $tbody[] = $row->prodi;
      $tbody[] = $row->jurusan;
      $tbody[] = $row->fakultas;
      $tbody[] = date("d-m-Y H:i", strtotime($row->created_at));
      $tbody[] = '<div>'
      .'<div class="btn-group">'
      .'<a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" onclick="showDetail(\''.$row->nim.'\',\''.$row->created_at.'\');" title="Lihat Detail"> <i class="fa fa-list"></i> </a>'
      .'<a href="" class="btn btn-sm btn-outline-danger" onclick="prepDelete(\''.$row->nim.'\',\''.$row->created_at.'\');" title="Hapus data"> <i class="fa fa-trash-alt"></i> </a>'
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