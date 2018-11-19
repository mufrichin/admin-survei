@extends('layouts.app_admin')

@section('content')    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 text-center text-sm-center mb-0">
    <img src="{{asset('images/um_logo_blue_text.png')}}" width="240"><br/><br/>
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Jumlah Responden</h3>
  </div>
</div>
<!-- End Page Header -->


<div class="row">
  <div class="col-md-4 mb-4">
   <div class="view view-fifth"> 
    <div class="stats-small stats-small--1 card card-small">
      @if ($count['dosen']==0)
      <a class="card-body p-0 d-flex" onclick="data_null()" >
        @else
        <a class="card-body p-0 d-flex" href="{{url('responden/dosen')}}" >
         @endif
         <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Dosen</span>
            <h6 class="stats-small__value count my-3">{{ $count['dosen'] }}</h6>
            <div class="mask">
              <h2>Lihat Responden</h2>
            </div>
          </div>
        </div>
        <canvas height="120" class="blog-overview-stats-small-1"></canvas>
      </a>
    </a>
  </div>
</div>
</div>
<div class="col-md-4 mb-4">
  <div class="view view-fifth"> 
    <div class="stats-small stats-small--1 card card-small">
      @if ($count['mahasiswa']==0)
      <a class="card-body p-0 d-flex" onclick="data_null()" >
        @else
        <a class="card-body p-0 d-flex" href="{{url('responden/mahasiswa')}}" >
         @endif
         <div class="d-flex flex-column m-auto" >
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Mahasiswa</span>
            <h6 class="stats-small__value count my-3">{{ $count['mahasiswa'] }}</h6>
            <div class="mask">
              <h2>Lihat Responden</h2>
            </div>
          </div>
        </div>
        <canvas height="120" class="blog-overview-stats-small-2"></canvas>
      </a>
    </a>
  </div>
</div>
</div>
<div class="col-md-4 mb-4">
  <div class="view view-fifth"> 
    <div class="stats-small stats-small--1 card card-small">
      @if ($count['tendik']==0)
      <a class="card-body p-0 d-flex" onclick="data_null()" >
        @else
        <a class="card-body p-0 d-flex" href="{{url('responden/tendik')}}" >
         @endif
         <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Tenaga Kependidikan</span>
            <h6 class="stats-small__value count my-3">{{ $count['tendik'] }}</h6>
            <div class="mask">
              <h2>Lihat Responden</h2>
            </div>
          </div>
        </div>
        <canvas height="120" class="blog-overview-stats-small-3"></canvas>
      </a>
    </a>
  </div>
</div>
</div>
<div class="col-md-4 mb-4">
 <div class="view view-fifth"> 
  <div class="stats-small stats-small--1 card card-small">
   @if ($count['alumni']==0)
   <a class="card-body p-0 d-flex" onclick="data_null()" >
    @else
    <a class="card-body p-0 d-flex" href="{{url('responden/alumni')}}" >
     @endif
     <div class="d-flex flex-column m-auto">
      <div class="stats-small__data text-center">
        <span class="stats-small__label text-uppercase">Alumni</span>
        <h6 class="stats-small__value count my-3">{{ $count['alumni'] }}</h6>
        <div class="mask">
          <h2>Lihat Responden</h2>
        </div>
      </div>
    </div>
    <canvas height="120" class="blog-overview-stats-small-4"></canvas>
  </a>
</a>
</div>
</div>
</div>
<div class="col-md-4 mb-4">
 <div class="view view-fifth"> 
  <div class="stats-small stats-small--1 card card-small">
   @if ($count['pengguna']==0)
   <a class="card-body p-0 d-flex" onclick="data_null()" >
    @else
    <a class="card-body p-0 d-flex" href="{{url('responden/pengguna')}}" >
     @endif
     <div class="d-flex flex-column m-auto">
      <div class="stats-small__data text-center">
        <span class="stats-small__label text-uppercase">Pengguna</span>
        <h6 class="stats-small__value count my-3">{{ $count['pengguna'] }}</h6>
        <div class="mask">
          <h2>Lihat Responden</h2>
        </div>
      </div>
    </div>
    <canvas height="120" class="blog-overview-stats-small-5"></canvas>
  </a>
</a>
</div>
</div>
</div>
<div class="col-md-4 mb-4">
  <div class="view view-fifth"> 
    <div class="stats-small stats-small--1 card card-small">

     @if ($count['mitra']==0)
     <a class="card-body p-0 d-flex" onclick="data_null()">
      @else
      <a class="card-body p-0 d-flex" href="{{url('responden/mitra')}}">
       @endif

       <div class="d-flex flex-column m-auto">
        <div class="stats-small__data text-center">
          
          <span class="stats-small__label text-uppercase">Mitra</span>
          <h6 class="stats-small__value count my-3">{{ $count['mitra'] }}</h6>
          <div class="mask">
            <h2>Lihat Responden</h2>
          </div>

        </div>
        
      </div>
      <canvas height="120" class="blog-overview-stats-small-5"></canvas>
    </a>
  </a>

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


@push("style")
<!-- <style type="text/css">
  a.report{
    border-radius: 0px !important;
  }
</style> -->
@endpush