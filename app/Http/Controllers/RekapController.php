<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Biodata_dosen;
use App\Angket_dosen;
use App\Pertanyaan_angket;
use DB;

class RekapController extends Controller
{
    public function index()
    {

    	$kuesioner = Pertanyaan_angket::select("kd_pertanyaan")->where("sasaran", "dosen")->get()->toArray();
    	// dd($kuesioner);
    	$data_rekap = array();
    	// $angket_dosen = Angket_dosen::with(["biodata_dosen" => function($query){
    	// 	$query->whereIn("jurusan", ['Sastra Indonesia', 'Sastra Arab', 'Biologi', 'Fisika']);

    	// 	dd($query);
    	// }])->select("dosen_nip", "kuesioner", "value", "created_at")->where("tahun", date("Y"))->get();

    	$angket_dosen = Angket_dosen::select("dosen_nip", "kuesioner", "value", "created_at")->where("tahun", date("Y"))->whereNotIn("value", ['SS', 'S', 'KS', 'TS', 'STS'])->orderBy("dosen_nip")->get();
    	// $angket_dosen = DB::table("angket_dosen")->select("dosen_nip", "kuesioner", "value", "created_at")->where("tahun", date("Y"))->whereNotIn("value", ["SS", "S"])->orderBy("kuesioner")->get();
    	// dd($angket_dosen);
    	$i=-1;
    	$current_nip = null;
    	$created_at = null;

    		foreach ($angket_dosen as $angket_dosen) {
	    		// $current_nip = $angket_dosen->dosen_nip;

	    		if($angket_dosen->dosen_nip != $current_nip){
	    			$i++;
	    			$current_nip = $angket_dosen->dosen_nip;
	    		}
	    		$data_rekap[$i]["nip"] = $current_nip;
	    		$data_rekap[$i][$angket_dosen->kuesioner] = $angket_dosen->value;
	    		

	    		
	    	}

    	dd($data_rekap);
    }
}
