@extends('layouts.app')

@section('content') 
  <div class="row">
    <div class="col-md-12 text-center mb-5 bg-white py-4">
      <h3>404</h3>
      {{-- <h3>Ups!</h3> --}}
      <p class="text-muted">Ups! Halaman yang anda cari tidak ditemukan!</p>
      <a href="javascript: history.go(-1);" class="btn btn-accent btn-pill">&larr; Kembali ke Halaman Sebelumnya</a>
    </div>  
  </div>

@endsection