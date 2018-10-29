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

@push("highchart")

<script type="text/javascript">
  
  Highcharts.chart('{{ $id_chart or null }}', {
    chart: {
        type: 'column'
    },
    title: {
        text: '{{ $judul_chart or null }}'
    },
    subtitle: {
        text: '{{ $subjudul_chart or null }}'
    },
    xAxis: {
        categories: [
            'Persyaratan',
            'Prosedur',
            'Waktu',
            'Biaya',
            'Produk',
            'Kompetensi',
            'Perilaku',
            'Pengaduan',
            'Kualitas'
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Jumlah reponden'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y} responden</b></td></tr>',
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
        name: 'Sangat Puas',
        data: [25, 25, 25, 25, 25, 25, 25, 25, 25]

    }, {
        name: 'Puas',
        data: [25, 25, 25, 25, 25, 25, 25, 25, 25]

    }, {
        name: 'Cukup Puas',
        data: [25, 25, 25, 25, 25, 25, 25, 25, 25]
    }, {
        name: 'Tidak Puas',
        data: [25, 25, 25, 25, 25, 25, 25, 25, 25]

    }]
});
</script>
@endpush