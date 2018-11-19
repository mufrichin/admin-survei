<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Saml2;

// use App\Angket_mitra;

class AdminController extends Controller
{
  public function __construct() {
    $this->middleware(function($request, $next){
        /*if(session("tipe") != 2){
          session()->flash("msg", "Terjadi Kesalahan Mengambil data dosen");
          return redirect("/");
        }*/

        /*if(null == session("userID")){
          session()->flash("msg", "Terjadi Kesalahan Mengambil data dosen");
          return redirect("/");
        }*/
        return $next($request);
      })->except(["logout_admin", "check_session", "index"]);
  }

  public function index() {
    return view('dashboard');
  }

  public function login_admin(Request $request) {
    /*if(!is_null(session("tipe"))) {
        return $next($request);
    } else {
        return Saml2::login();
    }*/
    return redirect('check_session');
  }
  public function logout_admin() {
    return Saml2::logout();
  }
  public function check_session(Request $request) {
    print("<pre>". print_r($request->session()->all(), true). "</pre>");
  }

  public function rekapitulasi() {
    return view('rekapitulasi');
  }

  public function responden() {
    $count['dosen'] = DB::table("angket_dosen")->select(DB::raw("DISTINCT dosen_nip as count"))->get()->count();
    $count['mahasiswa'] = DB::table("angket_mahasiswa")->select(DB::raw("DISTINCT mahasiswa_nim as count"))->get()->count();
    $count['alumni'] = DB::table("biodata_alumni")->count();
    $count['tendik'] = DB::table("angket_tendik")->select(DB::raw("DISTINCT tendik_nip as count"))->get()->count();
    $count['pengguna'] = DB::table("biodata_pengguna")->count();
    $count['mitra'] = DB::table("biodata_mitra")->count();
    return view('responden', compact('count'));
  }


  public function get_datatable_responden(Request $request) {
    //cek apakah request adalah asynchronous
    if($request->ajax()) {

    }
  }
}
