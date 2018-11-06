<?php if(isset($use_panel) && ($use_panel == "no")): ?>
  <div>
    <h6 class="m-0"><?php echo e(isset($judul) ? $judul : null); ?></h6>
    <div height="235" class="blog-users-by-device m-auto chartjs-render-monitor" width="321" style="display: block; width: 100%; height: 100%;" id="<?php echo e(isset($id_chart) ? $id_chart : null); ?>">
    </div>
  </div>
<?php else: ?>
  <div class="card card-small h-100">
    <div class="card-header border-bottom">
      <h6 class="m-0"><?php echo e(isset($judul) ? $judul : null); ?></h6>
    </div>
    <div class="card-body d-flex py-0">
      <div height="235" class="blog-users-by-device m-auto chartjs-render-monitor" width="321" style="display: block; width: 100%; height: 100%;" id="<?php echo e(isset($id_chart) ? $id_chart : null); ?>">

      </div>
    </div>
    <div class="card-footer border-top">
      <div class="row">

        <div class="col text-right view-report">
          <a href="#">Full report →</a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php $__env->startPush("highchart"); ?>
<script type="text/javascript">
  Highcharts.chart('<?php echo e(isset($id_chart) ? $id_chart : null); ?>', {
    data: {
      table: '<?php echo e(isset($id_tabel) ? $id_tabel : null); ?>'
    },
    chart: {
      type: 'column'
    },
    title: {
      text: '<?php echo e(isset($judul_chart) ? $judul_chart : null); ?>'
    },
    subtitle: {
      text: '<?php echo e(isset($subjudul_chart) ? $subjudul_chart : null); ?>'
    },
    yAxis: {
      min:0,
      max: 100,
      allowDecimals: true,
      title: {
        text: '<?php echo e(isset($judul_y) ? $judul_y : null); ?>'
      },
    },
    tooltip: {
      formatter: function () {
        <?php if(strtolower($tipe_value) == 'percent'): ?>
          return '<b>' + this.series.name + '</b><br/>' + this.point.y + '% ' + this.point.name.toLowerCase();
        <?php else: ?>
          return '<b>' + this.series.name + '</b><br/>' + this.point.y + ' ' + this.point.name.toLowerCase();
        <?php endif; ?>
      }
    },
    plotOptions: {
     series: {
      dataLabels: {
        enabled: true,
        <?php if($tipe_value == 'percent'): ?>
          format: '{y}%'
        <?php else: ?>
          format: '{y}'
        <?php endif; ?>
      }
    },
    enableMouseTracking: false
  }
});
</script>
<?php $__env->stopPush(); ?>