<?php $__env->startSection('content'); ?>    

<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 text-center text-sm-center mb-0">
    <img src="<?php echo e(asset('images/um_logo_blue_text.png')); ?>" width="240"><br/><br/>
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Jumlah Responden</h3>
  </div>
</div>
<!-- End Page Header -->


<div class="row">
  <div class="col-md-4 mb-4">
   <div class="view view-fifth"> 
    <div class="stats-small stats-small--1 card card-small">
      <?php if($count['dosen']==0): ?>
      <a class="card-body p-0 d-flex" onclick="data_null()" >
        <?php else: ?>
        <a class="card-body p-0 d-flex" href="<?php echo e(url('responden/dosen')); ?>" >
         <?php endif; ?>
         <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Dosen</span>
            <h6 class="stats-small__value count my-3"><?php echo e($count['dosen']); ?></h6>
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
      <?php if($count['mahasiswa']==0): ?>
      <a class="card-body p-0 d-flex" onclick="data_null()" >
        <?php else: ?>
        <a class="card-body p-0 d-flex" href="<?php echo e(url('responden/mahasiswa')); ?>" >
         <?php endif; ?>
         <div class="d-flex flex-column m-auto" >
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Mahasiswa</span>
            <h6 class="stats-small__value count my-3"><?php echo e($count['mahasiswa']); ?></h6>
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
      <?php if($count['tendik']==0): ?>
      <a class="card-body p-0 d-flex" onclick="data_null()" >
        <?php else: ?>
        <a class="card-body p-0 d-flex" href="<?php echo e(url('responden/tendik')); ?>" >
         <?php endif; ?>
         <div class="d-flex flex-column m-auto">
          <div class="stats-small__data text-center">
            <span class="stats-small__label text-uppercase">Tenaga Kependidikan</span>
            <h6 class="stats-small__value count my-3"><?php echo e($count['tendik']); ?></h6>
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
   <?php if($count['alumni']==0): ?>
   <a class="card-body p-0 d-flex" onclick="data_null()" >
    <?php else: ?>
    <a class="card-body p-0 d-flex" href="<?php echo e(url('responden/alumni')); ?>" >
     <?php endif; ?>
     <div class="d-flex flex-column m-auto">
      <div class="stats-small__data text-center">
        <span class="stats-small__label text-uppercase">Alumni</span>
        <h6 class="stats-small__value count my-3"><?php echo e($count['alumni']); ?></h6>
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
   <?php if($count['pengguna']==0): ?>
   <a class="card-body p-0 d-flex" onclick="data_null()" >
    <?php else: ?>
    <a class="card-body p-0 d-flex" href="<?php echo e(url('responden/pengguna')); ?>" >
     <?php endif; ?>
     <div class="d-flex flex-column m-auto">
      <div class="stats-small__data text-center">
        <span class="stats-small__label text-uppercase">Pengguna</span>
        <h6 class="stats-small__value count my-3"><?php echo e($count['pengguna']); ?></h6>
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

     <?php if($count['mitra']==0): ?>
     <a class="card-body p-0 d-flex" onclick="data_null()">
      <?php else: ?>
      <a class="card-body p-0 d-flex" href="<?php echo e(url('responden/mitra')); ?>">
       <?php endif; ?>

       <div class="d-flex flex-column m-auto">
        <div class="stats-small__data text-center">
          
          <span class="stats-small__label text-uppercase">Mitra</span>
          <h6 class="stats-small__value count my-3"><?php echo e($count['mitra']); ?></h6>
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

<?php $__env->stopSection(); ?>


<?php $__env->startPush("style"); ?>
<!-- <style type="text/css">
  a.report{
    border-radius: 0px !important;
  }
</style> -->
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>