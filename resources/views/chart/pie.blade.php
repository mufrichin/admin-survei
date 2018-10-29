<div class="card card-small h-100">
	<div class="card-header border-bottom">
		<h6 class="m-0">{{ $judul or null }}</h6>
	</div>
	<div class="card-body d-flex py-0">
		<div height="235" class="blog-users-by-device m-auto chartjs-render-monitor" width="321" style="display: block; width: 100%; min-height: 100%;" id="{{ $id_chart or null }}">

		</div>
	</div>
	<div class="card-footer border-top">
		<div class="row">

			<div class="col text-right view-report">
				{{-- <a href="#">Full report →</a> --}}
			</div>
		</div>
	</div>
</div>

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
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: [{
            name: 'Chrome',
            y: 61.41
        }, {
            name: 'Internet Explorer',
            y: 11.84
        }, {
            name: 'Firefox',
            y: 10.85
        }, {
            name: 'Edge',
            y: 4.67
        }, {
            name: 'Safari',
            y: 4.18
        }, {
            name: 'Sogou Explorer',
            y: 1.64
        }, {
            name: 'Opera',
            y: 1.6
        }, {
            name: 'QQ',
            y: 1.2
        }, {
            name: 'Other',
            y: 2.61
        }]
    }]
});
</script>
@endpush