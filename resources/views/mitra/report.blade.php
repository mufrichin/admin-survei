@extends('layouts.app_admin')

@section('content') 
	
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Rekapitulasi Angket Mitra</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row">
	{{-- PERTANYAAN 1 --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Visi, Misi, Tujuan & Sasaran UM</h6>
			</div>
			<div class="card-body p-0 pb-3 text-center">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Apakah Ibu/bapak memahami rumusan visi, misi, tujuan, dan sasaran UM?</span>
						</div>
						<table class="table mb-0" id="datatable1">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0"></th>
									<th scope="col" class="border-0">Ya</th>
									<th scope="col" class="border-0">Tidak</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th>Pilihan</th>
									<td>
										{{ number_format((($list_q1['jumlah_ya'] / max($list_q1['total_responden'], 1)) * 100), 1) }}
									</td>
									<td>
										{{ number_format((($list_q1['jumlah_tidak'] / max($list_q1['total_responden'], 1)) * 100), 1) }}
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						@component("chart.column")
							{{-- @slot("judul") Visi, Misi, Tujuan & Sasaran UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_vmts @endslot
							@slot("id_tabel") datatable1 @endslot
							@slot("judul_chart") Persentase Pemahaman VMTS UM @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q1['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
							@slot("tipe_value") percent @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 2 --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Rumusan VMTS UM</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Dari mana Ibu/Bapak mengetahui rumusan visi, misi, tujuan, dan sasaran UM?</span>
						</div>
						<table class="table mb-0" id="datatable2">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q2['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($list_q2['total_responden'], 1)) * 100), 1) }}
											{{-- {{ number_format((($jumlah / max($list_q2['total_pilihan'], 1)) * 100), 1) }} --}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Rumusan VMTS UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_rumusan @endslot
							@slot("id_tabel") datatable2 @endslot
							@slot("judul_chart") Persentase Rumusan VMTS UM @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q2['total_responden'] }} orang @endslot
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
				<h6 class="m-0">Kinerja UM</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Bagaimana menurut Ibu/Bapak, kinerja UM dalam mencapai visi, misi, tujuan, dan sasarannya?</span>
						</div>
						<table class="table mb-0" id="datatable3">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q3['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($list_q3['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Kinerja UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kinerja @endslot
							@slot("id_tabel") datatable3 @endslot
							@slot("judul_chart") Persentase Kinerja UM @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q3['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 4A --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Profil UM</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-5">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk kualitas informasi dan profil UM</span>
						</div>
						<table class="table mb-0" id="datatable4a">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q4a['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q4a['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>	
					</div>
					<div class="col-md-7">
						@component("chart.pie_legend")
							{{-- @slot("judul") Profil UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_profil @endslot
							@slot("id_tabel") datatable4a @endslot
							@slot("judul_chart") Persentase Kualitas Profil UM @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4a['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 4B, C, D, E --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kerjasama UM</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk kerjasama UM</span>
						</div>
						<table class="table mb-0" id="datatable4b_h">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q4b['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q4b['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4b" aria-expanded="true" aria-controls="pertanyaan_q4b">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4b" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Kualitas jejaring yang dibangun Universitas</li>
									<li>Kontribusi Universitas terhadap mitra</li>
									<li>Kontribusi mitra terhadap kegiatan akademik Universitas</li>
									<li>Kontribusi mitra terhadap kegiatan non-akademik Universitas</li>
									<li>Keterlibatan Ibu/Bapak dalam kegiatan pembelajaran</li>
									<li>Keterlibatan Ibu/Bapak dalam kegiatan penelitian</li>
									<li>Keterlibatan Ibu/Bapak dalam pengabdian kepada masyarakat</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Profil UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kerjasama @endslot
							@slot("id_tabel") datatable4b_h @endslot
							@slot("judul_chart") Persentase Kualitas Kerjasama UM @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4b['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>			
				</div>
			</div>
		</div>
	</div>

	
	{{-- PERTANYAAN 4I - Q --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kepuasan Layanan</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold">Penilaian untuk kepuasan layanan</span>
						</div>
						<table class="table mb-0" id="datatable4i">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q4i['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q4i['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>	
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4i" aria-expanded="true" aria-controls="pertanyaan_q4i">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4i" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Kejelasan dan kelengkapan informasi yang diperlukan untuk memperoleh layanan kelembagaan</li>
									<li>Prosedur pemberian layanan kelembagaan</li>
									<li>Waktu pemberian layanan kelembagaan</li>
									<li>Biaya pemberian layanan kelembagaan</li>
									<li>Produk layanan kelembagaan</li>
									<li>Kompetensi pelaksana layanan kelembagaan</li>
									<li>Perilaku pelaksana layanan kelembagaan</li>
									<li>Penanganan pengaduan terkait layanan kelembagaan</li>
									<li>Kualitas layanan kelembagaan</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Profil UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kejelasan @endslot
							@slot("id_tabel") datatable4i @endslot
							@slot("judul_chart") Persentase Kepuasan Layanan @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4i['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>

				</div>
			</div>
		</div>
	</div>

</div>
@endsection

@push("reportjs")
	<script type="text/javascript" src="{{ asset("/js/highchart/highcharts.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/js/highchart/modules/data.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/js/highchart/modules/exporting.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/js/highchart/modules/export-data.js") }}"></script>
@endpush