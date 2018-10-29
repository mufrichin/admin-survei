<div class="card card-small">
	<div class="card-header border-bottom">
		<h6 class="m-0">{{ $judul or null }}</h6>
	</div>
	<div class="card-body pt-0">

		<div style="max-width: 100% !important; display: block; width: 709px; min-height: 100%;" class="blog-overview-users chartjs-render-monitor" width="709" id="{{ $id_chart or null }}"></div>
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
        type: 'column'
    },
    title: {
        text: '{{ $judul or null }}'
    },
    xAxis: {
        categories: [
            'Prodi',
            'Universitas'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: '% Pemahaman Dosen'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} %</b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [{
        name: 'Ya',
        data: [49.9, 71.5]

    }, {
        name: 'Tidak',
        data: [83.6, 78.8]

    }]
});
</script>

@endpush