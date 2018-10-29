@if(isset($use_panel) && ($use_panel == "no"))
  <div>
    <h6 class="m-0">{{ $judul or null }}</h6>
    <div height="235" class="blog-users-by-device m-auto chartjs-render-monitor" width="321" style="display: block; width: 100%; height: 100%;" id="{{ $id_chart or null }}">
    </div>
  </div>
@else
  <div class="card card-small h-100">
  	<div class="card-header border-bottom">
  		<h6 class="m-0">{{ $judul or null }}</h6>
  	</div>
  	<div class="card-body d-flex py-0">
  		<div height="235" class="blog-users-by-device m-auto chartjs-render-monitor" width="321" style="display: block; width: 100%; height: 100%;" id="{{ $id_chart or null }}">

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
@endif

@push("highchart")
<script type="text/javascript">
  Highcharts.chart('{{ $id_chart or null }}', {
    chart: {
      plotBackgroundColor: null,
      plotBorderWidth: null,
      plotShadow: false,
      type: 'pie'
    },
    title: {
      text: '{{ $judul_chart or null }}'
    },
    subtitle: {
      text: '{{ $subjudul_chart or null }}'
    },
    tooltip: {
      pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
      pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
          enabled: true,
          // format: '<b>{point.name}</b><br>{point.percentage:.1f} %',
          format: '{point.percentage:.1f} %',
          distance: -50,
          filter: {
              property: 'percentage',
              operator: '>',
              value: 4
          }
        },
        showInLegend: true
      }
    },
    data: {
      table: '{{ $id_tabel or null }}'
    },
    series: [{
      name: '{{ $judul_y or null }}',
      colorByPoint: true
    }]
  });
</script>
@endpush