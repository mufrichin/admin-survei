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
    data: {
      table: '{{ $id_tabel or null }}'
    },
    chart: {
      type: 'column'
    },
    title: {
      text: '{{ $judul_chart or null }}'
    },
    subtitle: {
      text: '{{ $subjudul_chart or null }}'
    },
    yAxis: {
      min:0,
      max: 100,
      allowDecimals: true,
      title: {
        text: '{{ $judul_y or null }}'
      },
    },
    tooltip: {
      formatter: function () {
        @if(strtolower($tipe_value) == 'percent')
          return '<b>' + this.series.name + '</b><br/>' + this.point.y + '% ' + this.point.name.toLowerCase();
        @else
          return '<b>' + this.series.name + '</b><br/>' + this.point.y + ' ' + this.point.name.toLowerCase();
        @endif
      }
    },
    plotOptions: {
     series: {
      dataLabels: {
        enabled: true,
        @if($tipe_value == 'percent')
          format: '{y}%'
        @else
          format: '{y}'
        @endif
      }
    },
    enableMouseTracking: false
  }
});
</script>
@endpush