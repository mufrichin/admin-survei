@extends('layouts.app_admin')

@section('content')    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Data Responden - Tendik</h3>
  </div>
</div>
<!-- End Page Header -->

<!-- Top Referrals Component -->
<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card card-small">
      <div class="card-header border-bottom">
        <h6 class="m-0">Tabel Responden</h6>
      </div>
      <div class="card-body pt-0">
        <div class="row border-bottom py-2 bg-light">
          <div class="col-12">
            <div class="form-inline">
              <div class="form-group mr-sm-2 mb-2">
                <select name="" id="filterUnitKerja" class="select2 form-control" title="Tampilkan data berdasarkan unit kerja"> 
                  <option></option>
                </select>
              </div>
              <div class="form-group mr-sm-2 mb-2">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <i class="fa fa-calendar input-group-text"></i>
                  </div>
                  <input type="text" class="daterange input-sm form-control" name="rentang_tanggal" placeholder="Rentang Tanggal" id="rentang_tanggal" title="Tampilkan data berdasarkan tanggal mengisi angket">
                </div>
              </div>
              <div class="form-group mr-sm-2 mb-2">
                <button type="button" id="clearFilterBtn" class="btn btn-sm btn-secondary" title="Bersihkan filter"><i class="fa fa-undo"></i> Reset</button>
              </div>
            </div>
          </div>
        </div>
        {{-- Datatable --}}
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive pt-3">
              <table id="datatableServer" class="table mb-0 w-100">
                <thead class="">
                  <tr>
                    <th scope="col" class="border-0 no-sort">#</th>
                    <th scope="col" class="border-0">NIP</th>
                    <th scope="col" class="border-0">Nama Tendik</th>
                    <th scope="col" class="border-0">Unit Kerja</th>
                    <th scope="col" class="border-0">Tanggal Isi</th>
                    <th scope="col" class="border-0 no-sort">Aksi</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
            </div>
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
    var listUnitKerja = {!! json_encode($list_unit) !!};

    //Preparing initial data for select2 filter jurusan dan fakultas  
    var filterJurusan = null;
    var filterUnitKerja = null;
    dataFilterUnitKerja = $.map(listUnitKerja, function(row, idx) {
        return {"id": row.nama_unit, "text": row.nama_unit+' ('+row.nama_unit+')', "kode_unit": row.kode_unit};
      });
    initSelectFilterUnitKerja(dataFilterUnitKerja);
    
    //INISIALISASI SELECT2 UNIT KERJA
    function initSelectFilterUnitKerja(data='') {
      data.unshift({'id': '', 'text': ''});
      filterUnitKerja = $('#filterUnitKerja').select2({ 
        placeholder: "Pilih Unit Kerja",
        allowClear: true,
        data: data 
      });
      $('#filterUnitKerja').val("");
    }

    // INISIALISASI DATERANGEPICKER
    $('input.daterange').daterangepicker({
      // autoUpdateInput: false,
      autoApply: true,
      locale: {
        format: 'DD-MM-YYYY'
      }
    });
    $('input.daterange').val(''); //kosongkan value di awal load

    //INISIALISASI DATATABLE
    var initDatatable1 = $('#datatableServer').DataTable({
      "processing": true,
      "serverSide": true,
      "searchDelay": 800,
      "order": [[4, 'desc']],
      "ajax": {
        url: "{{ url('/admin/responden/tendik/get_datatable') }}",
        type: "post",
        data: function(d) {
          d._token = "{{ csrf_token() }}";
          d.unit_kerja = $('#filterUnitKerja').val() || '';
          d.rentang_tanggal = $('#rentang_tanggal').val() || '';
        },
        error: function() {
          console.log('Get datatable error!');
        }
      },
      "columnDefs": [
      {targets : "no-sort", orderable: false},
      {targets : "no-search", searchable: false},
      {targets : "no-view", visible: false}
      ],
      "drawCallback": function(settings) {}
    });
    // Select Filter OnChange Handler
    $('#filterUnitKerja, #rentang_tanggal').on("change", function(e){
      if($(this).val()) {
        initDatatable1.clear().draw();
      }
    });
    
    // Clear filter button onclick handler
    $('#clearFilterBtn').on("click", function() {
      $('#rentang_tanggal, #filterUnitKerja').val(null).trigger('change');
      if(!$(this).val()) {
        initDatatable1.clear().draw();
      }
    })

  }); //End Document Ready
</script>
@endsection