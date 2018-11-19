@extends('layouts.app_admin')

@push("style")
<style type="text/css">
  table#tabelJumlahResponden tr th {
    vertical-align: middle;
  }
</style>
@endpush

@section('content')    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 text-center text-sm-center mb-0">
    <img src="{{asset('images/um_logo_blue_text.png')}}" width="240"><br/><br/>
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3>Beranda</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row mb-4">
  <div class="col-md-12">
    <div class="alert alert-secondary fade show mb-0" role="alert">
      <div class="row">
        <div class="col-sm-8 align-middle text-left">
          <i class="fa fa-info mx-2"></i>
          <strong>Selamat datang!</strong> Anda sedang mengakses sebagai pengguna publik, klik tombol di samping untuk masuk sebagai Admin
        </div>
        <div class="col-sm-4 align-middle text-right">
          <a href="{{ url('/login_admin') }}" class="btn btn-info"><i class="fa fa-sign-in-alt"></i> Login Admin</a> 
        </div> 
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col">
    <div class="card card-small overflow-hidden mb-4">
      <div class="card-header">
        <h6 class="m-0">Jumlah Responden Berdasarkan Sasaran</h6>
      </div>
      <div class="card-body p-0 pb-3 text-center">
        <table id="tabelJumlahResponden" class="table mb-0">
          <thead class="thead bg-light">
            <tr>
              <th scope="col" class="border-bottom-0" rowspan="2">#</th>
              <th scope="col" class="border-bottom-0" rowspan="2">Sasaran</th>
              <th scope="col" class="border-bottom-0" colspan="3">Jumlah Responden</th>
              <th scope="col" class="border-bottom-0" rowspan="2">Total</th>
            </tr>
            <tr>
              <th scope="col" class="border-bottom-0">Universitas</th>
              <th scope="col" class="border-bottom-0">Fakultas</th>
              <th scope="col" class="border-bottom-0">Prodi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td class="text-left">Dosen</td>
              <td>1</td>
              <td>1</td>
              <td>1</td>
              <td class="font-weight-bold">3</td>
            </tr>
            <tr>
              <td>2</td>
              <td class="text-left">Mahasiswa</td>
              <td>1</td>
              <td>1</td>
              <td>1</td>
              <td class="font-weight-bold">3</td>
            </tr>
            <tr>
              <td class="font-weight-bold">3</td>
              <td class="text-left">Alumni</td>
              <td>1</td>
              <td>1</td>
              <td>1</td>
              <td class="font-weight-bold">3</td>
            </tr>
            <tr>
              <td>4</td>
              <td class="text-left">Tenaga Kependidikan</td>
              <td>1</td>
              <td>1</td>
              <td>1</td>
              <td class="font-weight-bold">3</td>
            </tr>
            <tr>
              <td>5</td>
              <td class="text-left">Pengguna</td>
              <td>1</td>
              <td>1</td>
              <td>1</td>
              <td class="font-weight-bold">3</td>
            </tr>
            <tr>
              <td>6</td>
              <td class="text-left">Mitra</td>
              <td>1</td>
              <td>1</td>
              <td>1</td>
              <td class="font-weight-bold">3</td>
            </tr>
          </tbody>
          <tfoot class="bg-light">
            <tr>
              <td colspan="2">&nbsp;</td>
              <td class="font-weight-bold">6</td>
              <td class="font-weight-bold">6</td>
              <td class="font-weight-bold">6</td>
              <td class="font-weight-bold">18</td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- End Top Referrals Component -->
<script>
  function data_null(){
    swal("Kesalahan", "Belum ada responden yang mengisi angket", "warning");
  }
</script>

@endsection