<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;

use App\Biodata_mitra;
use App\Angket_mitra;

class MitraController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index() {
    return view("mitra/identitas");
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */

  public function angket() {
    if(null == session("biodata_id")) {
      session()->flash("msg", "Isikan biodata anda.");
      return redirect("/mitra");
    }
    return view('mitra/angket');

  }


  public function create() {
  //
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request) {

  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id) {
  //
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id) {
  //
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id) {
  //
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id) {
  //
  }

  public function simpanBiodata(Request $request) {
    $biodata = new Biodata_mitra;
    $biodata->jabatan_pengisi = $request->jabatan_pengisi;
    $biodata->nama_instansi = $request->nama_instansi;
    $biodata->no_telp = $request->no_telp;
    $biodata->tahun_berdiri = $request->tahun_berdiri;
    $biodata->skala_operasional = $request->skala_operasional;
    $biodata->tahun_kerjasama = $request->tahun_kerjasama;

    if($biodata->save()){
      session(["biodata_id" => $biodata->id]);
      return redirect("/mitra/angket");
    }
    else {
      return redirect()->back()->withInput();
    }

  }


  public function simpanAngket(Request $request) {
    if(null == session("biodata_id")){
      session()->flash("msg", "Isikan biodata anda.");
      return redirect("/mitra");
    }
    // print_r($request->all()); die();
    $data = $this->dataKuesioner($request->except("_token"));

    Angket_mitra::insert($data);

    session()->forget("dosen_id");
    session()->flash("msg", "Terima kasih telah berpartisipasi mengisi angket.");
    return redirect("/");
  }

  public function dataKuesioner($request) {
    $biodata_id = session("biodata_id"); //diubah ke session hasil dari simpanBiodata
    $tahun = (null != session('tahun')) ? session('tahun') : date("Y");
    $timestamp = date("Y-m-d H:i:s");
    $data = array();
    $i=0;
    foreach ($request as $key => $value) {
      $data[$i]["biodata_mitra_id"] = $biodata_id;
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
    //Pertanyaan 1: Pemahaman VTMS Universitas
    $data_db = DB::table("angket_mitra")->where('kuesioner', 'q1')->get();
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
    $data_db = DB::table("angket_mitra")
                ->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
                ->where('kuesioner', 'q2')
                ->groupBy('value')
                ->get();
    $list_q2 = array(
              'kuesioner' => array(
                  'Dokumen Jurusan (mis: katalog)' => 0, 
                  'Dokumen Universitas (mis: prospectus)' => 0, 
                  'Membaca banner' => 0, 
                  'Kegiatan kemahasiswaan' => 0, 
                  'Laman UM' => 0, 
                  'Lain-lain' => 0,
              ),
              'total_responden' => 0,
              'total_pilihan' => 0
            );
    // print_r($data_db); die();
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
    $data_db = DB::table('angket_mitra')
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

    //Pertanyaan 4A: Profil Universitas (VMTS)
    $list_q4a = $this->kepuasan('angket_mitra', 'q4a');

    //Pertanyaan 4B, C, D, E: Jejaring, Kontribusi universitas, Kontribusi pengguna di akademik, Kontribusi pengguna di non-akademik (Kerjasama)
    $list_q4b = $this->kepuasan('angket_mitra', ['q4b','q4c', 'q4d', 'q4e', 'q4f', 'q4g', 'q4h']);

    /*//Pertanyaan 4F: Pembelajaran (Pendidikan)
    $list_q4f = $this->kepuasan('angket_mitra', 'q4f');

    //Pertanyaan 4G: Keterlibatan (Penelitian)
    $list_q4g = $this->kepuasan('angket_mitra', 'q4g');

    //Pertanyaan 4H: Keterlibatan (Pengadian kepada masyarakat)
    $list_q4h = $this->kepuasan('angket_mitra', 'q4h');*/
    
    //Pertanyaan 4 I - Q: Kelembagaan
    $list_q4i = $this->kepuasan('angket_mitra', ['q4i', 'q4j', 'q4k', 'q4l', 'q4m', 'q4n', 'q4o', 'q4p', 'q4q']);
    /*$list_q4i = $this->kepuasan('angket_mitra', 'q4i');
    $list_q4j = $this->kepuasan('angket_mitra', 'q4j');
    $list_q4k = $this->kepuasan('angket_mitra', 'q4k');
    $list_q4l = $this->kepuasan('angket_mitra', 'q4l');
    $list_q4m = $this->kepuasan('angket_mitra', 'q4m');
    $list_q4n = $this->kepuasan('angket_mitra', 'q4n');
    $list_q4o = $this->kepuasan('angket_mitra', 'q4o');
    $list_q4p = $this->kepuasan('angket_mitra', 'q4p');
    $list_q4q = $this->kepuasan('angket_mitra', 'q4q');*/

    // print_r($list_q4a); print_r($list_q4b); die();
    return view("mitra.report", compact('list_q1', 'list_q2', 'list_q3', 'list_q4a', 'list_q4b', 'list_q4c', 'list_q4d', 'list_q4e', 'list_q4f', 'list_q4g', 'list_q4h', 'list_q4i', 'list_q4j', 'list_q4k', 'list_q4l', 'list_q4m', 'list_q4n', 'list_q4o', 'list_q4p', 'list_q4q'));
  }

  function responden() {
    $data = array();
    return view('mitra/responden');
  }

  function get_datatable_responden(Request $request) {
    $params = $request->all();
    // die(json_encode($params['fakultas']));
    $columns = ['id', 'jabatan_pengisi', 'nama_instansi', 'no_telp', 'skala_operasional', 'tahun_kerjasama', 'created_at', 'id'];

    $totalData = DB::table('angket_mitra')
    ->select(DB::raw("COUNT(id) AS jumlah_responden"))
    ->where('kuesioner', 'q1')
    ->count();

    $data_db = DB::table('angket_mitra')
    ->select(DB::raw('group1.biodata_mitra_id, group1.created_at, mitra.id, mitra.jabatan_pengisi, mitra.nama_instansi, mitra.no_telp, mitra.skala_operasional, mitra.tahun_kerjasama'))
    ->from(DB::raw('(select biodata_mitra_id, created_at from angket_mitra group by biodata_mitra_id, created_at) AS group1'))
    ->join('biodata_mitra AS mitra', 'mitra.id', '=', 'group1.biodata_mitra_id');
    if($params['skala_operasional']) { 
      $data_db->where("mitra.skala_operasional", "ILIKE", "%{$params['skala_operasional']}%");
    }
    if($params['rentang_tanggal']) { 
      $split_date = explode(' - ', $params['rentang_tanggal']);
      $start_date = date('Y-m-d', strtotime(trim($split_date[0])));
      $end_date = date('Y-m-d', strtotime(trim($split_date[1])));
      $data_db->whereBetween(DB::raw("DATE(group1.created_at)"), [$start_date, $end_date]);
    }
    if(!empty($params['search']['value'])) {
      $data_db->where(function($query) use ($params) {
        $query->orWhere("mitra.jabatan_pengisi", "ILIKE", "%{$params['search']['value']}%");
        $query->orWhere("mitra.nama_instansi", "ILIKE", "%{$params['search']['value']}%");
        $query->orWhere("mitra.no_telp", "ILIKE", "%{$params['search']['value']}%");
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
      $tbody[] = $row->no_telp;
      $tbody[] = $row->skala_operasional;
      $tbody[] = $row->tahun_kerjasama;
      $tbody[] = date("d-m-Y H:i", strtotime($row->created_at));
      $tbody[] = '<div>'
      .'<div class="btn-group">'
      .'<a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" onclick="showDetail(\''.$row->biodata_mitra_id.'\',\''.$row->created_at.'\');" title="Lihat Detail"> <i class="fa fa-list"></i> </a>'
      .'<a href="" class="btn btn-sm btn-outline-danger" onclick="prepDelete(\''.$row->biodata_mitra_id.'\',\''.$row->created_at.'\');" title="Hapus data"> <i class="fa fa-trash-alt"></i> </a>'
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
