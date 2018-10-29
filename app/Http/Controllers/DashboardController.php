<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


// use App\Angket_mitra;

class DashboardController extends Controller
{

  public function index() {
    $count['dosen'] = DB::table("angket_dosen")->select(DB::raw("DISTINCT dosen_nip as count"))->get()->count();
    $count['mahasiswa'] = DB::table("angket_mahasiswa")->select(DB::raw("DISTINCT mahasiswa_nim as count"))->get()->count();
    $count['alumni'] = DB::table("biodata_alumni")->count();
    $count['tendik'] = DB::table("angket_tendik")->select(DB::raw("DISTINCT tendik_nip as count"))->get()->count();
    $count['pengguna'] = DB::table("biodata_pengguna")->count();
    $count['mitra'] = DB::table("biodata_mitra")->count();
  //dd($count);
    return view('dashboard', compact('count'));
  }

  public function rekapitulasi() {
    return view('rekapitulasi');
  }

  //Fungsi dibawah belum dipakai. Nantinya akan digunakan untuk menampilkan daftar responden di sisi admin
  public function responden() {
    return view('responden');
  }

  public function get_datatable_responden(Request $request) {
    //cek apakah request adalah asynchronous
    if($request->ajax()) {

    }
  }
}
