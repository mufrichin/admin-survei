@extends('layouts.app_admin')

@section('content')    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Tambah Pertanyaan</h3>
  </div>
</div>
<!-- End Page Header -->

<!-- Top Referrals Component -->
<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card card-small">
      <div class="card-header border-bottom">
        <h6 class="m-0">
          Form Tambah Pertanyaan
          <div class="float-right">
            <button id="btnAddRow" class="btn btn-outline-success" onclick="addRowChildren(event);" title="Tambahkan Input"><i class="fa fa-plus"></i></button>
          </div>
        </h6>
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-12">
            <form action="{{ url('pertanyaan/simpanPertanyaan') }}" method="post" class="form">
              {{ csrf_field() }}
              <div id="containerFormTambah" class="p-2">
                <!-- Dynamically added by js -->
              </div> <!-- end containerFormTambah -->
              <button type="submit" class="btn btn-primary float-right mt-2"><i class="fa fa-check"></i> Simpan</button>
            </form>
          </div>
        </div>
        {{-- Datatable --}}
        <div class="row">
          <div class="col-md-12">
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Top Referrals Component -->

@endsection


@push("style")
<!-- <style type="text/css">
  a.report{
    border-radius: 0px !important;
  }
</style> -->
@endpush

@section('pagespecificjs') 
<script>
  $(document).ready(function() {
    //Initial row input insertion
    addRowChildren();
  }); //End Document Ready

  //ADD NEW ROW TO INPUT NILAI TABLE
  function addRowChildren(e) {
    if(e!=undefined) { e.preventDefault(); }
    let countRow = $('#containerFormTambah div.rowInput').length;
    if(countRow < 15) {
      let num = (countRow+1);
      let html = ''
        +'<div class="row rowInput pt-2 pb-2 pb-md-0 border-bottom">'
          +'<div class="col-md-1 colNum text-center">'
            +'<label for="" class="col-form-label">'
              +'<span class="d-md-none">Pertanyaan #</span>'
              +'<span class="num">'+ num +'</span>'
            +'</label>'
          +'</div>'
          +'<div class="col-md-2">'
            +'<div class="form-group">'
              +'<select name="sasaran[]" id="sasaran_'+num+'" class="select2 form-control" title="Sasaran" required="">' 
                +'<option value="" selected="" disabled="">Pilih Sasaran</option>'
                +'<option value="dosen">Dosen</option>'
                +'<option value="mahasiswa">Mahasiswa</option>'
                +'<option value="tendik">Tenaga Kependidikan</option>'
                +'<option value="alumni">Alumni</option>'
                +'<option value="pengguna">Pengguna</option>'
                +'<option value="mitra">Mitra</option>'
              +'</select>'
            +'</div>'
          +'</div>'
          +'<div class="col-md-2">'
            +'<div class="form-group">'
              +'<input type="text" name="kd_pertanyaan[]" id="kd_pertanyaan_'+num+'" class="form-control" placeholder="Kode Pertanyaan" required="">'
            +'</div>'
          +'</div>'
          +'<div class="col-md-6">'
            +'<div class="form-group">'
              +'<input name="pertanyaan[]" id="pertanyaan_'+num+'" class="form-control" placeholder="Pertanyaan" required="">'
            +'</div>'
          +'</div>'
          +'<div class="col-md-1 text-right text-md-left">'
            +'<button type="button" class="btn btn-outline-danger" onclick="delRowChildren(event);" title="Hapus Input"><i class="fa fa-times"></i></button>'
          +'</div>'
        +'</div>';
      $(html).appendTo('#containerFormTambah').hide().fadeIn();
      $("#sasaran_"+num).val($("#sasaran_"+(num-1)).val());
    }
  }
  //REMOVE ROW FROM INPUT NILAI TABLE
  function delRowChildren(e) {
    e.preventDefault();
    let target = $(e.currentTarget).closest('div.rowInput');
    let countRow = $('#containerFormTambah div.rowInput').length;
    if(target && (countRow > 1)) {
      $(target).remove();
      //resetting table index number (#)
      $('#containerFormTambah div.rowInput').each(function(idx) {
        $(this).find('div.colNum:first-child .num').text(idx+1);
      });
    }
  }
</script>
@endsection