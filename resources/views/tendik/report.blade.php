@extends('layouts.app_admin')

@section('content')  
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Rekapitulasi Angket Tendik</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row">
	
		{{-- PERTANYAAN 1 --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Visi, Misi, Tujuan & Sasaran Unit Kerja dan Universitas</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
					<span class="text-info font-italic font-weight-bold" >Apakah Ibu/bapak memahami rumusan visi, misi, tujuan, dan sasaran Universitas Negeri Malang?</span>
				</div>
				<table class="table mb-0" id="datatable1">
					<thead class="bg-light">
						<tr>
							<th scope="col" class="border-0"></th>
							<th scope="col" class="border-0">Ya (%)</th>
							<th scope="col" class="border-0">Tidak (%)</th>
						</tr>
					</thead>
					<tbody>
						@php
							$key = array_keys($list_pemahaman_vmts);
							$i=0;
						@endphp
						@foreach($list_pemahaman_vmts as $pemahaman_vmts)
						<tr>
							<th>{{ ucfirst($key[$i++]) }}</th>
							<td>
										{{ number_format((($pemahaman_vmts['ya']/max($pemahaman_vmts["total_responden"], 1))*100), 1) }}
									</td>
									<td>
										{{ number_format((($pemahaman_vmts['tidak']/max($pemahaman_vmts["total_responden"], 1))*100), 1) }}
									</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
			<div class="col-md-6">
						@component("chart.column")
							{{-- @slot("judul") Visi, Misi, Tujuan & Sasaran @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_vmts @endslot
							@slot("id_tabel") datatable1 @endslot
							@slot("judul_chart") Pemahaman VMTS @endslot
							@slot("subjudul_chart") Responden : Unit Kerja {{ $list_pemahaman_vmts["unit"]["total_responden"] }} | Universitas {{ $list_pemahaman_vmts["universitas"]["total_responden"] }} @endslot
							@slot("judul_y") Persen @endslot
							@slot("tipe_value") percent @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Rumusan VMTS Unit Kerja dan Universitas</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Dari mana Ibu/Bapak mengetahui rumusan visi, misi, tujuan, dan sasaran unit kerja?</span>
						</div>
						<table class="table mb-0 d-none" id="datatable2">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($media_vmts_unit['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($media_vmts_unit['total_responden'], 1)) * 100), 1) }}
											{{-- {{ number_format((($jumlah / max($media_vmts_unit['total_pilihan'], 1)) * 100), 1) }} --}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@component("chart.pie_legend")
							{{-- @slot("judul") Rumusan VMTS Unit Kerja @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_vmts_unit @endslot
							@slot("id_tabel") datatable2 @endslot
							@slot("judul_chart") Persentase Rumusan VMTS Unit Kerja @endslot
							@slot("subjudul_chart") Total Responden: {{ $media_vmts_unit['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Dari mana Ibu/Bapak mengetahui rumusan visi, misi, tujuan, dan sasaran Universitas?</span>
						</div>
						<table class="table mb-0 d-none" id="datatable5">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($media_vmts_unit['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($media_vmts_unit['total_responden'], 1)) * 100), 1) }}
											{{-- {{ number_format((($jumlah / max($media_vmts_unit['total_pilihan'], 1)) * 100), 1) }} --}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@component("chart.pie_legend")
							{{-- @slot("judul") Rumusan VMTS Universitas @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_vmts_universitas @endslot
							@slot("id_tabel") datatable5 @endslot
							@slot("judul_chart") Persentase Rumusan VMTS Universitas @endslot
							@slot("subjudul_chart") Total Responden: {{ $media_vmts_unit['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>
	
	{{-- PERTANYAAN 3 --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kinerja VMTS Unit Kerja</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Bagaimana menurut Ibu/Bapak, kinerja unit kerja dalam mencapai visi dan sasarannya?</span>
						</div>
						<table class="table mb-0 d-none" id="datatable3">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($kinerja_unit['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($kinerja_unit['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@component("chart.pie_legend")
							{{-- @slot("judul") Kinerja Unit Kerja @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kinerja_unit @endslot
							@slot("id_tabel") datatable3 @endslot
							@slot("judul_chart") Persentase Kinerja Unit Kerja @endslot
							@slot("subjudul_chart") Total Responden: {{ $kinerja_unit['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Bagaimana menurut Ibu/Bapak, kinerja universitas dalam mencapai visi dan sasarannya?</span>
						</div>
						<table class="table mb-0 d-none" id="datatable6">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($kinerja_universitas['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($kinerja_universitas['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@component("chart.pie_legend")
							{{-- @slot("judul") Kinerja Universitas @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kinerja_universitas @endslot
							@slot("id_tabel") datatable6 @endslot
							@slot("judul_chart") Persentase Kinerja Universitas @endslot
							@slot("subjudul_chart") Total Responden: {{ $kinerja_universitas['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 7A, B --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Visi, Misi, Tujuan & Sasaran </h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk Kepuasan VMTS</span>
						</div>
						<table class="table mb-0" id="datatable7a">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q7a['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q7a['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q7a" aria-expanded="true" aria-controls="pertanyaan_q7a">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q7a" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Rumusan Visi, Misi, Tujuan, dan Sasaran Unit Kerja</li>
									<li>Rumusan Visi, Misi, Tujuan, dan Sasaran Universitas</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Rumusan VMTS  @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kepuasan_rumusan @endslot
							@slot("id_tabel") datatable7a @endslot
							@slot("judul_chart") Persentase Kepuasan Rumusan VMTS @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q7a['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

{{-- PERTANYAAN 7N, O, P, Q, R, S, T, U, V --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kepuasan Layanan</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk Kepuasan Layanan</span>
						</div>
						<table class="table mb-0" id="datatable7n">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q7n['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q7n['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q7n" aria-expanded="true" aria-controls="pertanyaan_q7n">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q7n" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Kejelasan dan kelengkapan informasi persyaratan yang diperlukan untuk memperoleh layanan kelembagaan</li>
									<li>Prosedur pemberian layanan kelembagaan</li>
									<li>Waktu pemberian layanan kelembagaan</li>
									<li>Biaya pemberian layanan kelembagaan</li>
									<li>Produk layanan kelembagaan</li>
									<li>Kompetensi pelaksana layanan kelembagaan</li>
									<li>Perilaku pelaksana layanan kelembagaan</li>
									<li>Penanganan pengaduan terkait pelaksanaan layanan kelembagaan</li>
									<li>Kualitas layanan kelembagaan</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">			
						@component("chart.pie_legend")
							{{-- @slot("judul") Kepuasan Layanan @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kepuasan_layanan @endslot
							@slot("id_tabel") datatable7n @endslot
							@slot("judul_chart") Persentase Kepuasan Layanan @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q7n['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>


{{-- PERTANYAAN 7C, D, E, F --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Sumber Daya Manusia</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk Sumber Daya Manusia</span>
						</div>
						<table class="table mb-0" id="datatable7c">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q7c['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q7c['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q7c" aria-expanded="true" aria-controls="pertanyaan_q7c">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q7c" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Kualitas dan transparansi proses penerimaan Tenaga Kependidikan</li>
									<li>Relevansi keahlian Ibu/Bapak dengan unit kerja</li>
									<li>Deskripsi Tugas</li>
									<li>Beban Pekerjaan</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">			
						@component("chart.pie_legend")
							{{-- @slot("judul") Kepuasan SDM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kepuasan_sdm @endslot
							@slot("id_tabel") datatable7c @endslot
							@slot("judul_chart") Persentase Kepuasan Sumber Daya Manusia @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q7c['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

{{-- PERTANYAAN 7G, H, I, J, K, L, M --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Keuangan, Sarana dan Prasarana</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian Kepuasan Keuangan, Sarana dan Prasarana</span>
						</div>
						<table class="table mb-0" id="datatable7g">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q7g['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q7g['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q7g" aria-expanded="true" aria-controls="pertanyaan_q7g">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q7g" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Kualitas Sarana dan Prasarana</li>
									<li>Kualitas dukungan untuk pengembangan profesi</li>
									<li>Kualitas koordinasi di dalam unit</li>
									<li>Kualitas koordinasi antar unit di dalam universitas</li>
									<li>Kualitas, keamanan, dan kenyamanan lingkungan kerja</li>
									<li>Keselamatan lingkungan dan keamanan kerja</li>
									<li>Gaji dan tunjangan</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">	
						@component("chart.pie_legend")
							{{-- @slot("judul") Kualitas Keuangan, Sarana, dan Prasarana @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kualitas_keusarpras @endslot
							@slot("id_tabel") datatable7g @endslot
							@slot("judul_chart") Persentase Kepuasan Keuangan, Sarana dan Prasarana @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q7g['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

</div> <!-- body -->
@endsection

@push("reportjs")
<script type="text/javascript" src="{{ asset("/js/highchart/highcharts.js") }}"></script>
<script type="text/javascript" src="{{ asset("/js/highchart/modules/data.js") }}"></script>
<script type="text/javascript" src="{{ asset("/js/highchart/modules/exporting.js") }}"></script>
<script type="text/javascript" src="{{ asset("/js/highchart/modules/export-data.js") }}"></script>
@endpush