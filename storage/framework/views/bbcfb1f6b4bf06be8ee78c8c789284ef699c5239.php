<?php $__env->startSection('content'); ?>    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Jawaban Responden - Dosen</h3>
  </div>
</div>
<!-- End Page Header -->

<!-- Top Referrals Component -->
<div class="row">
  <div class="col-md-12 mb-4">
    <div class="card card-small">
      <div class="card-header border-bottom">
        <h6 class="m-0">
          <?php echo e(isset($responden['nama']) ? $responden['nama'] : "Si Tanpa Nama"); ?>

          <small class="text-muted d-block">NIP: <?php echo e(isset($responden['nip']) ? $responden['nip'] : "-"); ?></small>
        </h6>
      </div>
      <div class="card-body pt-0">
        <div class="row py-4">
          <div class="col-sm-4 col-md-2">
            <ul class="list-group mb-4">
              <?php  $num = 0;  ?>
              <?php $__currentLoopData = $kategori_pertanyaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama_kategori => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="#kategori_<?php echo e($num); ?>" class="list-group-item list-group-item-info"><?php echo e($nama_kategori); ?></a>
                <?php  $num++;  ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
          <div class="col-sm-8 col-md-10">
            
              <?php  $num = 0;  ?>
              <?php $__currentLoopData = $kategori_pertanyaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nama_kategori => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h6 id="kategori_<?php echo e($num); ?>" class="border-bottom text-info"><?php echo e($nama_kategori); ?></h6>
                <ol>
                  <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li>
                    <strong class="d-block mb-2"><?php echo e($list_jawaban[$item]->pertanyaan); ?></strong>
                    <p class="text-muted">
                      <?php if(strtolower($nama_kategori) == "kepuasan"): ?>
                        <?php echo e(isset($opsi_kepuasan[$list_jawaban[$item]->value]) ? $opsi_kepuasan[$list_jawaban[$item]->value] : '-'); ?>

                      <?php else: ?> 
                        <?php echo e(isset($list_jawaban[$item]->value) ? $list_jawaban[$item]->value : '-'); ?>

                      <?php endif; ?>
                    </p>
                  </li>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ol>
                <?php  $num++;  ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Top Referrals Component -->

<?php $__env->stopSection(); ?>


<?php $__env->startPush("style"); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('pagespecificjs'); ?> 
<script>
  $(document).ready(function() {
    
  }); //End Document Ready
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>