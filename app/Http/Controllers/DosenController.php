<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Session;
use App\Biodata_dosen;
use App\Angket_dosen;
use Illuminate\Support\Facades\DB;


class DosenController extends Controller
{

	function __construct()
    {
      $this->middleware(function($request, $next){
        if(session("tipe") != 2){
          session()->flash("msg", "Terjadi Kesalahan Mengambil data dosen");
          return redirect("/");
        }

        if(null == session("userID")){
          session()->flash("msg", "Terjadi Kesalahan Mengambil data dosen");
          return redirect("/");
        }
        return $next($request);
      })->except(["report", "responden", "get_datatable_responden"]);
    }

    public function index()
    {
    
    	return redirect("/dosen/angket"); 
        
    }


    public function angket()
    {
    	if(null == session("userID")){
    		session()->flash("msg", "Terjadi Kesalahan Mengambil data dosen");
    		return redirect("/");
    	}
    	return view('dosen/angket');

    }

    public function simpanAngket(Request $request){
    	if(null == session("userID")){
    		session()->flash("msg", "Terjadi Kesalahan Mengambil data dosen");
    		return redirect("/");
    	}
    	$this->simpanBiodata();
    	$data = $this->dataKuesioner($request->except("_token"));

    	Angket_dosen::insert($data);

    	session()->flash("msg", "Terima kasih telah berpartisipasi mengisi angket.");
    	return redirect("/");
    }

    function simpanBiodata(){
    	$biodata = Biodata_dosen::updateOrCreate(["nip"=>session("userID")], $this->getDataDosen());
    }

    function getDataDosen(){
    	$dosen = [];
    	$data_dosen = DB::connection("pgsql_2")->table("dtum.m_dosen")
    	->join("dtum.m_jur", "m_dosen.jur_kd", '=', 'm_jur.jur_kd')
    	->join("dtum.m_fak", "m_jur.fak_kd", '=', 'm_fak.fak_kd')
    	->select("dsn_nm", "dsn_gelar", "dsn_gelar2", "jur_nm", "m_fak.fak_skt")->where("m_dosen.dsn_nip", "=", session("userID"))->first();

        // dd($data_dosen);

        $dosen["nama"] = $data_dosen->dsn_gelar.(!is_null($data_dosen->dsn_gelar))? " ": null.$data_dosen->dsn_nm." ".$data_dosen->dsn_gelar2;
        $dosen["fakultas"] = $data_dosen->fak_skt;
        $dosen["jurusan"] = $data_dosen->jur_nm;
        $dosen["nip"] = session("userID");

      return $dosen;
    }

    function dataKuesioner($request){
    	$user_id = session('userID'); 
    	$tahun = (null != session('tahun')) ? session('tahun') : date("Y") ;
    	$timestamp = date("Y-m-d H:i:s");
    	$data = [];
    	$i=0;
    	foreach ($request as $key => $value) {
    		$data[$i]["dosen_nip"] = $user_id;
    		$data[$i]["tahun"] = $tahun;
    		$data[$i]["kuesioner"] = $key;
    		$data[$i]["value"] = (is_array($value))? json_encode($value) : $value;
    		$data[$i]["created_at"] = $timestamp;
    		$i++;
    	}

    	return $data;
    }


    public function report() {
    //Pertanyaan 1: Pemahaman VTMS Universitas
    	$data_db = DB::table("angket_dosen")->select("kuesioner", "value", DB::raw("COUNT(id) as count"))->whereIn("kuesioner", ["q1", "q4", "q7"])->groupBy("kuesioner", "value")->get();
    	$list_pemahaman_vmts = array(
    		"prodi" => array("ya"=>0, "tidak"=>0, "total_responden"=>0),
    		"fakultas" => array("ya"=>0, "tidak"=>0, "total_responden"=>0),
    		"universitas" => array("ya"=>0, "tidak"=>0, "total_responden"=>0),
    	);
    	foreach ($data_db as $key => $row) {
    		if($row->kuesioner == 'q1') {
    			if($row->value == 'Ya') {
    				$list_pemahaman_vmts['prodi']['ya'] = $row->count;
    			}
    			elseif($row->value == 'Tidak') {
    				$list_pemahaman_vmts['prodi']['tidak'] = $row->count;
    			}
    			$list_pemahaman_vmts["prodi"]["total_responden"] = $list_pemahaman_vmts["prodi"]["ya"] + $list_pemahaman_vmts["prodi"]["tidak"];
    		}
    		if($row->kuesioner == 'q4') {
    			if($row->value == 'Ya') {
    				$list_pemahaman_vmts['fakultas']['ya'] = $row->count;
    			}
    			elseif($row->value == 'Tidak') {
    				$list_pemahaman_vmts['fakultas']['tidak'] = $row->count;
    			}
    			$list_pemahaman_vmts["fakultas"]["total_responden"] = $list_pemahaman_vmts["fakultas"]["ya"] + $list_pemahaman_vmts["fakultas"]["tidak"];
    		}
    		if($row->kuesioner == 'q7') {
    			if($row->value == 'Ya') {
    				$list_pemahaman_vmts['universitas']['ya'] = $row->count;
    			}
    			elseif($row->value == 'Tidak') {
    				$list_pemahaman_vmts['universitas']['tidak'] = $row->count;
    			}
    			$list_pemahaman_vmts["universitas"]["total_responden"] = $list_pemahaman_vmts["universitas"]["ya"] + $list_pemahaman_vmts["universitas"]["tidak"];
    		}
    	}

    //Pertanyaan 2: Rumusan VMTS Prodi
    	$data_db = DB::table("angket_dosen")
    	->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
    	->where('kuesioner', 'q2')
    	->groupBy('value')
    	->get();
    	$media_vmts_prodi = array(
    		'kuesioner' => array(
    			'Rapat Jurusan' => 0, 
    			'Katalog dan/atau dokumen Jurusan lainnya' => 0, 
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
    				foreach ($media_vmts_prodi['kuesioner'] as $pertanyaan => $jumlah) {
    					if(strtolower($jawaban) == strtolower($pertanyaan)) {
    						$media_vmts_prodi['kuesioner'][$pertanyaan] += $row->jumlah_responden;
    						$lain_exist = false;
    					}
    				}
          //tambahkan counter pilihan "Lain-lain" jika ada value custom
    				$media_vmts_prodi['kuesioner']['Lain-lain'] += ($lain_exist ? $row->jumlah_responden : 0);
    				$media_vmts_prodi['total_pilihan']++;
    			}
    		}
    		$media_vmts_prodi['total_responden'] += $row->jumlah_responden;
    	}

    //Pertanyaan 5: Media Penyampaian VMTS fakultas
    	$data_db = DB::table("angket_dosen")
    	->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
    	->where('kuesioner', 'q5')
    	->groupBy('value')
    	->get();
    	$media_vmts_fakultas = array(
    		'kuesioner' => array(
    			'Rapat' => 0, 
    			'Katalog dan/atau dokumen Fakultas lainnya' => 0, 
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
    				foreach ($media_vmts_fakultas['kuesioner'] as $pertanyaan => $jumlah) {
    					if(strtolower($jawaban) == strtolower($pertanyaan)) {
    						$media_vmts_fakultas['kuesioner'][$pertanyaan] += $row->jumlah_responden;
    						$lain_exist = false;
    					}
    				}
          //tambahkan counter pilihan "Lain-lain" jika ada value custom
    				$media_vmts_fakultas['kuesioner']['Lain-lain'] += ($lain_exist ? $row->jumlah_responden : 0);
    				$media_vmts_fakultas['total_pilihan']++;
    			}
    		}
    		$media_vmts_fakultas['total_responden'] += $row->jumlah_responden;
    	}

    //Pertanyaan 8: Media Penyampaian VMTS universitas
    	$data_db = DB::table("angket_dosen")
    	->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
    	->where('kuesioner', 'q8')
    	->groupBy('value')
    	->get();
    	$media_vmts_universitas = array(
    		'kuesioner' => array(
    			'Rapat' => 0, 
    			'Katalog dan/atau dokumen Universitas lainnya' => 0, 
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

    //Pertanyaan 3: Kinerja Prodi
    	$kinerja_prodi = array(
    		'kuesioner' => array(
    			'Kinerja sudah selaras dengan visi, misi, tujuan, dan sasaran Program Studi/Jurusan' => 0, 
    			'Kinerja cukup selaras dengan visi, misi, tujuan, dan sasaran Program Studi/Jurusan' => 0, 
    			'Kinerja kurang selaras dengan visi, misi, tujuan, dan sasaran Program Studi/Jurusan' => 0, 
    			'Tidak tahu karena tidak mengetahui rumusan visi, misi, tujuan, dan sasaran Program Studi/Jurusan' => 0, 
    			'Tidak tahu karena tidak pernah memperhatikan' => 0,
    		),
    		'total_responden' => 0
    	);
    	$data_db = DB::table('angket_dosen')
    	->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
    	->where('kuesioner', 'q3')
    	->groupBy('value')
    	->get();
    	foreach ($data_db as $row) {
    		foreach ($kinerja_prodi['kuesioner'] as $pertanyaan => $jumlah) {
    			if(strtolower($row->value) == strtolower($pertanyaan)) {
    				$kinerja_prodi['kuesioner'][$pertanyaan] += $row->jumlah_responden;
    			}
    		}
    		$kinerja_prodi['total_responden'] += $row->jumlah_responden;
    	}

    //Pertanyaan 6: Kinerja Fakultas
    	$kinerja_fakultas = array(
    		'kuesioner' => array(
    			'Kinerja sudah selaras dengan visi, misi, tujuan, dan sasaran Fakultas' => 0, 
    			'Kinerja cukup selaras dengan visi, misi, tujuan, dan sasaran Fakultas' => 0, 
    			'Kinerja kurang selaras dengan visi, misi, tujuan, dan sasaran Fakultas' => 0, 
    			'Tidak tahu karena tidak mengetahui rumusan visi, misi, tujuan, dan sasaran Fakultas' => 0, 
    			'Tidak tahu karena tidak pernah memperhatikan' => 0,
    		),
    		'total_responden' => 0
    	);
    	$data_db = DB::table('angket_dosen')
    	->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
    	->where('kuesioner', 'q6')
    	->groupBy('value')
    	->get();
    	foreach ($data_db as $row) {
    		foreach ($kinerja_fakultas['kuesioner'] as $pertanyaan => $jumlah) {
    			if(strtolower($row->value) == strtolower($pertanyaan)) {
    				$kinerja_fakultas['kuesioner'][$pertanyaan] += $row->jumlah_responden;
    			}
    		}
    		$kinerja_fakultas['total_responden'] += $row->jumlah_responden;
    	}

    //Pertanyaan : Kinerja Univerrsitas
    	$kinerja_universitas = array(
    		'kuesioner' => array(
    			'Kinerja sudah selaras dengan visi, misi, tujuan, dan sasaran Universitas' => 0, 
    			'Kinerja cukup selaras dengan visi, misi, tujuan, dan sasaran Universitas' => 0, 
    			'Kinerja kurang selaras dengan visi, misi, tujuan, dan sasaran Universitas' => 0, 
    			'Tidak tahu karena tidak mengetahui rumusan visi, misi, tujuan, dan sasaran Universitas' => 0, 
    			'Tidak tahu karena tidak pernah memperhatikan' => 0,
    		),
    		'total_responden' => 0
    	);
    	$data_db = DB::table('angket_dosen')
    	->select("value", DB::raw("COUNT(id) AS jumlah_responden"))
    	->where('kuesioner', 'q9')
    	->groupBy('value')
    	->get();
    	foreach ($data_db as $row) {
    		foreach ($kinerja_universitas['kuesioner'] as $pertanyaan => $jumlah) {
    			if(strtolower($row->value) == strtolower($pertanyaan)) {
    				$kinerja_universitas['kuesioner'][$pertanyaan] += $row->jumlah_responden;
    			}
    		}
    		$kinerja_universitas['total_responden'] += $row->jumlah_responden;
    	}

    //Pertanyaan 10B, C, D: VMTS Prodi, fakultas, universitas
    	$list_q10b = $this->kepuasan('angket_dosen', ['q10b', 'q10c', 'q10d']);
    /*$list_q10c = $this->kepuasan('angket_dosen', 'q10c');
    $list_q10d = $this->kepuasan('angket_dosen', 'q10d');*/

    //Pertanyaan 10A, F: SDM (Penerimaan dosen, Beban mengajar)
    $list_q10a = $this->kepuasan('angket_dosen', ['q10a', 'q10f']);
    // $list_q10f = $this->kepuasan('angket_dosen', 'q10f');
    
    //Pertanyaan 10E, G, H, I: Pendidikan (Capaian pembelajaran, Sumber belajar, Penjadwalan, Sarana dan Prasarana mengajar, Dukungan untuk penelitian)
    $list_q10e = $this->kepuasan('angket_dosen', ['q10e', 'q10g', 'q10h', 'q10i', 'q10j']);
    /*$list_q10g = $this->kepuasan('angket_dosen', 'q10g');
    $list_q10h = $this->kepuasan('angket_dosen', 'q10h');
    $list_q10i = $this->kepuasan('angket_dosen', 'q10i');
    $list_q10j = $this->kepuasan('angket_dosen', 'q10j');*/

    //Pertanyaan 10K, L: Penelitian (Dukungan untuk diseminasi dan publikasi, Fasilitas )
    $list_q10k = $this->kepuasan('angket_dosen', ['q10k', 'q10l']);
    // $list_q10l = $this->kepuasan('angket_dosen', 'q10l');

    //Pertanyaan 10M, N: Abmas (Dukungan akademik dan pendanaan, fasilitas)
    $list_q10m = $this->kepuasan('angket_dosen', ['q10m', 'q10n']);
    // $list_q10n = $this->kepuasan('angket_dosen', 'q10n');

    //Pertanyaan 10X, Y, Z, BB: Keuangan, Sarana dan Prasarana (pengembangan profesi, Promosi dan retensi, Lingkungan, keselamatan, dan keamanan kerja, Gaji dan tunjangan )
    $list_q10x = $this->kepuasan('angket_dosen', ['q10x', 'q10y', 'q10z', 'q10bb']);
    /*$list_q10y = $this->kepuasan('angket_dosen', 'q10y');
    $list_q10z = $this->kepuasan('angket_dosen', 'q10z');
    $list_q10bb = $this->kepuasan('angket_dosen', 'q10bb');*/

    //Pertanyaan 10O, P, Q, R, S, T, U, V, W: Kepuasan Layanan (Persyaratan, Prosedur, Waktu, Biaya, Produk, Kompetensi, Perilaku, Pengaduan, Kualitas Layanan)
    $list_q10o = $this->kepuasan('angket_dosen', ['q10o', 'q10p', 'q10q', 'q10r', 'q10s', 'q10t', 'q10u', 'q10v', 'q10w']);
    /*$list_q10p = $this->kepuasan('angket_dosen', 'q10p');
    $list_q10q = $this->kepuasan('angket_dosen', 'q10q');
    $list_q10r = $this->kepuasan('angket_dosen', 'q10r');
    $list_q10s = $this->kepuasan('angket_dosen', 'q10s');
    $list_q10t = $this->kepuasan('angket_dosen', 'q10t');
    $list_q10u = $this->kepuasan('angket_dosen', 'q10u');
    $list_q10v = $this->kepuasan('angket_dosen', 'q10v');
    $list_q10w = $this->kepuasan('angket_dosen', 'q10w');    */
    
    // print_r($data_db); print_r($list_q4a); die();
    return view("dosen.report", compact('list_pemahaman_vmts', 'media_vmts_prodi', 'media_vmts_fakultas', 'media_vmts_universitas', 'kinerja_prodi', 'kinerja_fakultas', 'kinerja_universitas', 'list_q10a', 'list_q10f', 'list_q10b', 'list_q10c', 'list_q10d', 'list_q10e', 'list_q10f', 'list_q10g', 'list_q10h', 'list_q10i', 'list_q10j', 'list_q10k', 'list_q10l', 'list_q10m', 'list_q10n', 'list_q10o', 'list_q10p', 'list_q10q', 'list_q10r', 'list_q10s', 'list_q10t', 'list_q10u', 'list_q10v', 'list_q10w', 'list_q10x', 'list_q10y', 'list_q10z', 'list_q10bb'));
  }

  function responden() {
  	$data = array(
  		'list_fakultas' => $this->getListFakultas(),
  		'list_jurusan' => $this->getListJurusan(),
  	);
  	return view('dosen/responden', $data);
  }

  function get_datatable_responden(Request $request) {
    $params = $request->all();
    $columns = ['id', 'nip', 'nama', 'jurusan', 'fakultas', 'created_at', 'id'];

    $totalData = DB::table('angket_dosen')
    ->select(DB::raw("COUNT(id) AS jumlah_responden"))
    ->where('kuesioner', 'q1')
    ->count();

    $data_db = DB::table('angket_dosen')
    ->select(DB::raw('group1.dosen_nip, group1.created_at, dosen.nip, dosen.nama, dosen.jurusan, dosen.fakultas'))
    ->from(DB::raw('(select dosen_nip, created_at from angket_dosen group by dosen_nip, created_at) AS group1'))
    ->join('biodata_dosen AS dosen', 'dosen.nip', '=', 'group1.dosen_nip');
    if($params['fakultas']) { 
      $data_db->where("dosen.fakultas", "ILIKE", "%{$params['fakultas']}%");
    }
    if($params['jurusan']) { 
      $data_db->where("dosen.jurusan", "ILIKE", "%{$params['jurusan']}%");
    }
    if($params['rentang_tanggal']) { 
      $split_date = explode(' - ', $params['rentang_tanggal']);
      $start_date = date('Y-m-d', strtotime(trim($split_date[0])));
      $end_date = date('Y-m-d', strtotime(trim($split_date[1])));
      $data_db->whereBetween(DB::raw("DATE(group1.created_at)"), [$start_date, $end_date]);
    }
    if(!empty($params['search']['value'])) {
      $data_db->where(function($query) use ($params) {
        $query->orWhere("dosen.nip", "ILIKE", "%{$params['search']['value']}%");
        $query->orWhere("dosen.nama", "ILIKE", "%{$params['search']['value']}%");
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
      $tbody[] = $row->jurusan;
      $tbody[] = $row->fakultas;
      $tbody[] = date("d-m-Y H:i", strtotime($row->created_at));
      $tbody[] = '<div>'
      .'<div class="btn-group">'
      .'<a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" onclick="showDetail(\''.$row->dosen_nip.'\',\''.$row->created_at.'\');" title="Lihat Detail"> <i class="fa fa-list"></i> </a>'
      .'<a href="" class="btn btn-sm btn-outline-danger" onclick="prepDelete(\''.$row->dosen_nip.'\',\''.$row->created_at.'\');" title="Hapus data"> <i class="fa fa-trash-alt"></i> </a>'
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