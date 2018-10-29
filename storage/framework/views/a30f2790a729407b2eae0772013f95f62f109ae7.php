<?php  $menu = Request::segment(2);  ?>

<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Survei Kepuasan - Satuan Penjamin Mutu - Universitas Negeri Malang</title>
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" id="main-stylesheet" data-version="1.0.0" href="<?php echo asset('css/shards-dashboards.1.0.0.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo asset('css/extras.1.0.0.min.css'); ?>">
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.6/quill.snow.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  
  
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  
  <link href="<?php echo e(asset('css/custom.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/slide.css')); ?>" rel="stylesheet" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.sidr/2.2.1/stylesheets/jquery.sidr.dark.min.css">

  <style>
  .menu {
    display: inline-block;
    cursor: pointer;
  }

  .bar1, .bar2, .bar3 {
    width: 35px;
    height: 5px;
    background-color: #007bff;
    margin: 6px 15px;
    transition: 0.4s;
  }

  .change .bar1 {
    -webkit-transform: rotate(-45deg) translate(-9px, 6px);
    transform: rotate(-45deg) translate(-9px, 6px);
  }

  .change .bar2 {opacity: 0;}

  .change .bar3 {
    -webkit-transform: rotate(45deg) translate(-8px, -8px);
    transform: rotate(45deg) translate(-8px, -8px);
  }
</style>

<style type="text/css">
.center{
  margin: auto;
}        

</style>


<?php echo $__env->yieldPushContent("style"); ?>
</head>
<body>

  <a id="simple-menu" href="#sidr">
    <div class="menu" onclick="myFunction(this)">
      <div class="bar1"></div>
      <div class="bar2"></div>
      <div class="bar3"></div>
    </div>
  </a>

  <div id="sidr">
    <!-- Your content -->
    <ul>
      <li><a href="<?php echo e(url('http://survei.um.ac.id')); ?>"><img id="main-logo" class="d-inline-block align-center mr-1" style="max-width: 27px;" src="<?php echo e(asset('images/um_logo.png')); ?>">  SIPUAS</a></li>
      <li><a href="<?php echo e(url('/')); ?>">
        <i class="fa fa-home" aria-hidden="true"></i> Responden</a></li>
      <li><a href="<?php echo e(url('/rekapitulasi')); ?>">
        <i class="fas fa-chart-pie"></i> Rekapitulasi</a></li>
        <li><a href="<?php echo e(url('/responden')); ?>"><i class="fas fa-user"></i> Detail Responden</a></li>
      </ul>
    </div>

    <div class="main-content-container container-fluid px-4">

      <?php if(null != session("msg")): ?>
      <div class="row" style="margin-bottom:60px;">
        <div class="col-12">
          <div class="alert alert-accent alert-dismissible fade show mb-0" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
            <?php echo e(session("msg")); ?>

          </div>
        </div>
      </div>
      <?php endif; ?>

      <?php echo $__env->yieldContent('content'); ?>
            <!-- <div class="page-header row no-gutters py-4">
              <div class="col-12 text-center text-sm-center mb-0">
                <h3 class="page-title">#dukungmutuUM</h3>
              </div>
            </div> -->
          </div>
        </main>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="//cdn.jsdelivr.net/jquery/2.2.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/jquery.sidr/2.2.1/jquery.sidr.min.js"></script>
    <!-- tool action -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <script src="https://unpkg.com/shards-ui@latest/dist/js/shards.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sharrre/2.0.1/jquery.sharrre.min.js"></script>
    <!-- data table -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    
    
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    
    
    
    
    
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
      
      $('[data-toggle="tooltip"]').tooltip({
        template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner bg-dark text-white"></div></div>'
      });
    </script>

    <script>
      function myFunction(x) {
        x.classList.toggle("change");
      }
    </script>

    <script>
      $(document).ready(function() {
        $('#simple-menu').sidr();
      });
    </script>

    <?php echo $__env->yieldContent('pagespecificjs'); ?>


    <?php echo $__env->yieldPushContent("reportjs"); ?>
    <?php echo $__env->yieldPushContent("highchart"); ?>
  </body>
  </html>