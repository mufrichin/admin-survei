@extends('layouts.app_admin')

@section('content')    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Data Responden - Mitra</h3>
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
                <select name="" id="filterSkala" class="select2 form-control" title="Tampilkan data berdasarkan skala operasional"> 
                  <option></option>
                  <option value="Internasional" data-select2-id="21">Internasional</option>
                  <option value="Nasional" data-select2-id="22">Nasional</option>
                  <option value="Swasta" data-select2-id="23">Swasta</option>
                  <option value="BUMN" data-select2-id="24">BUMN</option>
                  <option value="Negeri" data-select2-id="25">Negeri</option>
                  <option value="Milik Sendiri" data-select2-id="26">Milik Sendiri</option>
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
                    <th scope="col" class="border-0">Jabatan Pengisi</th>
                    <th scope="col" class="border-0">Nama Instansi</th>
                    <th scope="col" class="border-0">No. Telepon</th>
                    <th scope="col" class="border-0">Skala Operasional</th>
                    <th scope="col" class="border-0">Tahun Kerjasama</th>
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
    initSelectFilterSkala();
    
    //INISIALISASI SELECT2 SKALA OPERASIONAL
    function initSelectFilterSkala(data='') {
      // data.unshift({'id': '', 'text': ''});
      filterSkala = $('#filterSkala').select2({ 
        placeholder: "Pilih Skala Operasional",
        allowClear: true,
        // data: data 
      });
      $('#filterSkala').val("");
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
      "order": [[6, 'desc']],
      "ajax": {
        url: "{{ url('/responden/mitra/get_datatable') }}",
        type: "post",
        data: function(d) {
          d._token = "{{ csrf_token() }}";
          d.skala_operasional = $('#filterSkala').val() || '';
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
    $('#rentang_tanggal, #filterSkala').on("change", function(e){
      if($(this).val()) {  
        initDatatable1.clear().draw();
      }
    });
    
    // Clear filter button onclick handler
    $('#clearFilterBtn').on("click", function() {
      $('#rentang_tanggal, #filterSkala').val(null).trigger('change');
      if(!$(this).val()) {
        initDatatable1.clear().draw();
      }
    })

  }); //End Document Ready
</script>
@endsection