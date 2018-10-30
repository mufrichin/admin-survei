<?php $__env->startSection('content'); ?>    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Data Responden - Mahasiswa</h3>
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
                <select name="" id="filterFakultas" class="select2 form-control" title="Tampilkan data berdasarkan fakultas ">
                  <option></option>
                </select>
              </div>
              <div class="form-group mr-sm-2 mb-2">
                <select name="" id="filterJurusan" class="select2 form-control" title="Tampilkan data berdasarkan jurusan"disabled=""> 
                  <option></option>
                </select>
              </div>
              <div class="form-group mr-sm-2 mb-2">
                <select name="" id="filterProdi" class="select2 form-control" title="Tampilkan data berdasarkan prodi"disabled=""> 
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
        
        <div class="row">
          <div class="col-md-12">
            <div class="table-responsive pt-3">
              <table id="datatableServer" class="table mb-0 w-100">
                <thead class="">
                  <tr>
                    <th scope="col" class="border-0 no-sort">#</th>
                    <th scope="col" class="border-0">NIP</th>
                    <th scope="col" class="border-0">Nama Mahasiswa</th>
                    <th scope="col" class="border-0">Prodi</th>
                    <th scope="col" class="border-0">Jurusan</th>
                    <th scope="col" class="border-0">Fakultas</th>
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

<?php $__env->stopSection(); ?>


<?php $__env->startPush("style"); ?>
<!-- <style type="text/css">
  a.report{
    border-radius: 0px !important;
  }
</style> -->
<?php $__env->stopPush(); ?>

<?php $__env->startSection('pagespecificjs'); ?> 
<script>
  $(document).ready(function() {
    var listFakultas = <?php echo json_encode($list_fakultas); ?>;
    var listJurusan = <?php echo json_encode($list_jurusan); ?>;
    var listProdi = <?php echo json_encode($list_prodi); ?>;
    //Preparing initial data for select2 filter prodi, jurusan, dan fakultas  
    var filterProdi = null;
    var filterJurusan = null;
    var filterFakultas = null;
    dataFilterProdi = $.map(listProdi, function(row, idx) {
          return {"id": row.pro_nm, "text": row.pro_nm, "pro_kd": row.pro_kd};
        });
    dataFilterJurusan = $.map(listJurusan, function(row, idx) {
          return {"id": row.jur_nm, "text": row.jur_nm, "jur_kd": row.jur_kd};
        });
    dataFilterFakultas = $.map(listFakultas, function(row, idx) {
        return {"id": row.fak_skt, "text": row.fak_nm+' ('+row.fak_skt+')', "fak_kd": row.fak_kd};
      });
    initSelectFilterProdi(dataFilterProdi);
    initSelectFilterJurusan(dataFilterJurusan);
    initSelectFilterFakultas(dataFilterFakultas);
    
    //INISIALISASI SELECT2 FAKULTAS, JURUSAN, & PRODI
    function initSelectFilterFakultas(data='') {
      data.unshift({'id': '', 'text': ''});
      filterFakultas = $('#filterFakultas').select2({ 
        placeholder: "Pilih Fakultas",
        allowClear: true,
        data: data 
      });
      $('#filterFakultas').val("");
    }
    function initSelectFilterJurusan(data='') {
      data.unshift({'id': '', 'text': ''});
      if(filterJurusan != null) {
        //reinit filterJurusan if already initialized
        $("#filterJurusan").empty().trigger("change");
      }
      filterJurusan = $('#filterJurusan').select2({ 
        placeholder: "Pilih Jurusan",
        allowClear: true,
        data: data 
      });
      $('#filterJurusan').val("");
    }
    function initSelectFilterProdi(data='') { 
      data.unshift({'id': '', 'text': ''});
      if(filterProdi != null) {
        //reinit filterProdi if already initialized
        $("#filterProdi").empty().trigger("change");
      }
      filterProdi = $('#filterProdi').select2({ 
        placeholder: "Pilih Prodi",
        allowClear: true,
        data: data 
      });
      $('#filterProdi').val("");
    }
    //Event handler untuk onchange select filter fakultas
    $('#filterFakultas').on('change', function(e) {
      if($('#filterFakultas').val()) {
        let data = $('#filterFakultas').select2("data");
        let filteredJurusan = $.map(listJurusan, function(row, idx) {
          if(row.fak_kd == data[0].fak_kd){
            return {"id": row.jur_nm, "text": row.jur_nm, "jur_kd": row.jur_kd};
          }
        });
        initSelectFilterJurusan(filteredJurusan);
        $("#filterJurusan").attr("disabled", false);
      }
      else {
        $("#filterJurusan").attr("disabled", true);
        $("#filterJurusan").val("");
      }
    });
    //Event handler untuk onchange select filter jurusan
    $('#filterJurusan').on('change', function(e) {
      if($('#filterJurusan').val()) {
        let data = $('#filterJurusan').select2("data");
        console.log(data);
        let filteredProdi = $.map(listProdi, function(row, idx) {
          if(row.jur_kd == data[0].jur_kd){
            return {"id": row.pro_nm, "text": row.pro_nm};
          }
        });
        initSelectFilterProdi(filteredProdi);
        $("#filterProdi").attr("disabled", false);
      }
      else {
        $("#filterProdi").attr("disabled", true);
        $("#filterProdi").val("");
      }
    });

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
        url: "<?php echo e(url('/responden/mahasiswa/get_datatable')); ?>",
        type: "post",
        data: function(d) {
          d._token = "<?php echo e(csrf_token()); ?>";
          d.fakultas = $('#filterFakultas').val() || '';
          d.jurusan = $('#filterJurusan').val() || '';
          d.prodi = $('#filterProdi').val() || '';
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
    $('#rentang_tanggal, #filterFakultas, #filterJurusan, #filterProdi').on("change", function(e){
      if($(this).val()) {
        initDatatable1.clear().draw();
      }
    });
    
    // Clear filter button onclick handler
    $('#clearFilterBtn').on("click", function() {
      $('#rentang_tanggal, #filterFakultas, #filterJurusan, #filterProdi').val(null).trigger('change');
      if(!$(this).val()) {
        initDatatable1.clear().draw();
      }
    })

  }); //End Document Ready
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>