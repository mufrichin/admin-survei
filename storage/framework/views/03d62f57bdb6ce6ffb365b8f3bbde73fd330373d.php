<?php $__env->startSection('content'); ?>    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Data Pertanyaan Angket</h3>
  </div>
</div>
<!-- End Page Header -->

<!-- Top Referrals Component -->
<div class="row">
  <div class="col-md-12 mb-4">

    <?php echo session('alert_msg'); ?>

    
    <div class="card card-small">
      <div class="card-header border-bottom">
        <h6 class="m-0">
          Tabel Pertanyaan
          <a href="<?php echo e(url('pertanyaan/tambah')); ?>" class="btn btn-success float-right" title="Tambah Data"><i class="fa fa-plus"></i> Tambah</a>
        </h6>
      </div>
      <div class="card-body pt-0">
        <div class="row border-bottom py-2 bg-light">
          <div class="col-12">
            <div class="form-inline">
              <div class="form-group mr-sm-2 mb-2">
                <select name="sasaran" id="filterSasaran" class="form-control" title="Tampilkan data berdasarkan sasaran ">
                  <option value="" selected="" disabled="">Pilih Sasaran</option>
                  <option value="dosen">Dosen</option>
                  <option value="mahasiswa">Mahasiswa</option>
                  <option value="tendik">Tenaga Kependidikan</option>
                  <option value="alumni">Alumni</option>
                  <option value="pengguna">Pengguna</option>
                  <option value="mitra">Mitra</option>
                </select>
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
              <table id="datatable" class="table mb-0 w-100">
                <thead class="">
                  <tr>
                    <th scope="col" class="border-0 no-sort no-search">#</th>
                    <th scope="col" class="border-0">Sasaran</th>
                    <th scope="col" class="border-0">Kode Pertanyaan</th>
                    <th scope="col" class="border-0">Pertanyaan</th>
                    <th scope="col" class="border-0">Timestamp</th>
                    <th scope="col" class="border-0 no-sort no-search">Aksi</th>
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


<!-- Modal START-->
<div class="modal fade" id="modalForm">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?php echo e(url('pertanyaan/ubahPertanyaan')); ?>" method="POST" id="formEdit">
        <div class="modal-header">
          <h5 id="modalFormHeader" class="modal-title">Ubah Pertanyaan</h5>
        </div>
        <div class="modal-body">
          <div class="row">
            <?php echo e(csrf_field()); ?>

            <input type="hidden" name="id" id="hidden_id">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="sasaran">Sasaran</label>
                <select name="sasaran" id="sasaran" class="form-control" required="">
                  <option value="" selected="" disabled="">Pilih Sasaran</option>
                  <option value="dosen">Dosen</option>
                  <option value="mahasiswa">Mahasiswa</option>
                  <option value="tendik">Tenaga Kependidikan</option>
                  <option value="alumni">Alumni</option>
                  <option value="pengguna">Pengguna</option>
                  <option value="mitra">Mitra</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="kd_pertanyaan">Kode Pertanyaan</label>
                <input type="text" name="kd_pertanyaan" id="kd_pertanyaan" class="form-control" placeholder="Kode Pertanyaan" required="">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label for="pertanyaan">Pertanyaan</label>
                <textarea type="text" name="pertanyaan" id="pertanyaan" class="form-control" placeholder="Pertanyaan" rows="10" required=""></textarea>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="text-right">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="ti-close pdd-right-5"></i>Batal</button>
            <button type="submit" id="btnSubmit" class="btn btn-primary"><i class="ti-save pdd-right-5"></i>Simpan</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal END-->

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
    var listPertanyaan = <?php echo json_encode($list_pertanyaan); ?>;
    
    //INISIALISASI DATATABLE
    var initDatatable1 = $("#datatable").DataTable({
      "columnDefs": [ 
        {"targets": "no-sort", "orderable": false },
        {"targets": "no-search", "searchable": false},
        {"targets": "no-view", "visible": false}
      ], 
      "order": [[1, 'asc'], [2, 'asc'], [4, 'desc']]    
    });
    initDatatable1.on( 'order.dt search.dt', function () {
      initDatatable1.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
          cell.innerHTML = '<div class="text-center">'+ (i+1) +'</div>';
      });
    }).draw();

    //loading table body with json data`
    loadTabelPertanyaan(listPertanyaan);
    
    function loadTabelPertanyaan(json){
      //clear table
      initDatatable1.clear().draw();
      for(var i=0, data; data = json[i]; i++) {
        initDatatable1.row.add( [
            /*'<div class="checkbox ml-4">'
              +'<i class="d-none">'+data.id+'</i>'
              +'<input id="task-'+data.id+'" value="'+data.id+'" name="task[]" type="checkbox">'
                +'<label for="task-'+data.id+'"></label>'
            +'</div>',*/
            '<div class="text-center">'+ (i+1) +'</div>',
            '<div>'+ data.sasaran +'</div>',
            '<div>'+ data.kd_pertanyaan +'</div>',
            '<div>'+ data.pertanyaan +'</div>',
            '<div>'+ moment(data.created_at).format("DD-MM-YYYY HH:mm") +'</div>',
            '<div>'
              +'<div class="btn-group">'
                +'<a href="javascript:void(0);" class="btn btn-sm btn-outline-primary" data-id="'+data.id+'" onclick="showModalForm(event);" title="Ubah data"> <i class="fa fa-edit"></i> </a>'
                +'<a href="javascript:void(0);" class="btn btn-sm btn-outline-danger btnDelete" data-id="'+data.id+'" title="Hapus data"> <i class="fa fa-trash-alt"></i> </a>'
                /*+'<a href="'+ '<?php echo e(url("pertanyaan/hapus")); ?>'+'/'+data.id +'" class="btn btn-sm btn-outline-danger" data-id="'+data.id+'" onclick="return confirm(\'Hapus data?\');" title="Hapus data"> <i class="fa fa-trash-alt"></i> </a>'*/
              +'</div>'
            +'</div>'
        ] ).draw( false );
      }
    }

    // Delete button handler
    $('.btnDelete').on("click", function(e) {
      var proceedDel = confirm('Apakah anda yakin ingin menghapus data?');
      if(proceedDel) {
        let target = e.currentTarget;
        let id = $(target).data('id') || null;
        if(id) {
          prepDelete('<?php echo e(url("pertanyaan/hapusPertanyaan")); ?>', 'post', [
            {name: 'id', value: id}
          ]);
        }
      }
    });
    
    // Clear filter button onclick handler
    $('#clearFilterBtn').on("click", function() {
      $('#filterSasaran').val(null).trigger('change');
      if(!$(this).val()) {
        initDatatable1.columns().search('').draw();
      }
    });

    // Filter by sasaran select onchange handler
    $("#filterSasaran").on("change", function() {
      if($(this).val()) {
        initDatatable1.column(1).search($(this).val()).draw();
      }
    });

  }); //End Document Ready

  // Show modal form
  function showModalForm(e) {
    e.preventDefault();
    var id = $(e.currentTarget).data('id') || null;
    //jika klik tombol tambah data:
    if(!id) {
      //Nothing happens ... maybe go to tambah data?
    }
    //jika klik tombol edit data:
    else {
      getDetail(id);
    }
  }
  function getDetail(id, callback) {
    if(id) {
      $.ajax({
        url: '<?php echo e(url("pertanyaan/getPertanyaan")); ?>',
        data: { 'id': id, '_token': "<?php echo e(csrf_token()); ?>" },
        type: 'POST',
        dataType: 'json',
        beforeSend: function() { },
        success: function(response, status) {
          if(response.status) {
            var data = response.data;
            $('#hidden_id').val(data.id);
            $('#sasaran').val(data.sasaran);
            $('#kd_pertanyaan').val(data.kd_pertanyaan);
            $('#pertanyaan').val(data.pertanyaan);
            
            $('#modalForm').modal('show');
          }
        },
        error: function(jqXhr, message, errorThrown){
          console.log('Request error!', message);
          alert('Error! Perintah tidak dapat dijalankan', 'error');
        }
      });
    }
  }

  // Send post request for delete
  function prepDelete(action, method, values) {
    var form = $('<form/>', {
      action: action,
      method: method
    });
    $.each(values, function() {
      form.append($('<input/>', {
        type: 'hidden',
        name: this.name,
        value: this.value
      }));
    });
    form.append('<?php echo e(csrf_field()); ?>');    
    form.appendTo('body').submit();
  }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>