@extends('layouts.app_admin')

@section('content') 
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Rekapitulasi Angket Pengguna</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row">
	{{-- PERTANYAAN 1 --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Pemahaman Visi, Misi, Tujuan & Sasaran UM</h6>
			</div>
			<div class="card-body p-0 pb-3 text-center">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Apakah Ibu/bapak memahami rumusan visi, misi, tujuan, dan sasaran Universitas Negeri Malang (UM) ?</span>
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
							{{-- @slot("judul") Visi, Misi, Tujuan & Sasaran Universitas @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_vmts @endslot
							@slot("id_tabel") datatable1 @endslot
							@slot("judul_chart") Persentase Pemahaman VMTS Universitas @endslot
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
					<div class="col-md-5">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Dari mana Ibu/Bapak mengetahui rumusan visi, misi, tujuan, dan sasaran Universitas Negeri Malang (UM)?</span>
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
					<div class="col-md-7">
						@component("chart.pie_legend")
							{{-- @slot("judul") Rumusan VMTS Universitas @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_rumusan @endslot
							@slot("id_tabel") datatable2 @endslot
							@slot("judul_chart") Persentase Rumusan VMTS Universitas @endslot
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
							<span class="text-info font-italic font-weight-bold" >Bagaimana menurut Ibu/Bapak, kinerja UM dalam mencapai visi, misi, tujuan dan sasarannya?</span>
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
							{{-- @slot("judul") Kinerja Universitas @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kinerja @endslot
							@slot("id_tabel") datatable3 @endslot
							@slot("judul_chart") Persentase Penilaian Kinerja Universitas @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q3['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 4A, B, C, D, E, F, G, H, I --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kompetensi Lulusan</h6>
			</div>

			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk Kompetensi Lulusan UM</span>
						</div>
						<table class="table mb-0" id="datatable4a_h">
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
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4a" aria-expanded="true" aria-controls="pertanyaan_q4a">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4a" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Integritas (Etika dan Moral) lulusan UM dalam bekerja</li>
									<li>Profesionalisme lulusan UM dalam bekerja</li>
									<li>Kemahiran berkomunikasi baik lisan maupun tulisan dalam bahasa Inggris</li>
									<li>Tingkat penguasaan TIK untuk menunjang dan memaksimalkan pekerjaan</li>
									<li>Kemahiran dan kecerdasan berkomunikasi dalam situasi kerja</li>
									<li>Kemampuan bekerja dalam tim</li>
									<li>Potensi pengembangan diri dalam bekerja</li>
									<li>Wawasan interdisipliner</li>
									<li>Kepemimpinan</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">	
						@component("chart.pie_legend")
							{{-- @slot("judul") Kompetensi Lulusan UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kompetensi_lulusan @endslot
							@slot("id_tabel") datatable4a_h @endslot
							@slot("judul_chart") Persentase Kepuasan Kompetensi Lulusan UM @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4a['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 5A --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Profil UM</h6>
			</div>
			<div class="card-body p-0 pb-3 text-center">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk kualitas informasi dan profil prodi di UM</span>
						</div>
						<table class="table mb-0" id="datatable5a">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q5a['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q5a['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Profil Prodi @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_profil_prodi @endslot
							@slot("id_tabel") datatable5a @endslot
							@slot("judul_chart") Persentase Kepuasan Informasi Profil Prodi di UM @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q5a['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 5B --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Sumber Daya Manusia</h6>
			</div>
			<div class="card-body p-0 pb-3 text-center">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk Kualitas Alumni</span>
						</div>
						<table class="table mb-0" id="datatable5b">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q5b['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q5b['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Kualitas Alumni yang Bekerja di Instansi Pengguna @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kualitas_alumni @endslot
							@slot("id_tabel") datatable5b @endslot
							@slot("judul_chart") Persentase Kepuasan Kualitas Alumni yang Bekerja di Instansi Pengguna @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q5b['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 5C --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Penelitian</h6>
			</div>
			<div class="card-body p-0 pb-3 text-center">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian kepuasan untuk keterlibatan Pengguna dalam penelitian</span>
						</div>
						<table class="table mb-0" id="datatable5c">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q5c['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q5c['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Keterlibatan Pengguna dalam Penelitian @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_keterlibatan_penelitian @endslot
							@slot("id_tabel") datatable5c @endslot
							@slot("judul_chart") Persentase Kepuasanan Pengguna untuk Keterlibatan dalam Penelitian @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q5c['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 5D --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Pengabdian kepada Masyarakat </h6>
			</div>
			<div class="card-body p-0 pb-3 text-center">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian kepuasan untuk keterlibatan Pengguna dalam Pengabdian kepada Masyarakat</span>
						</div>
						<table class="table mb-0" id="datatable5d">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q5d['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q5d['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Keterlibatan Pengguna dalam Pengabdian kepada Masyarakat @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_pengabdian_masyarakat @endslot
							@slot("id_tabel") datatable5d @endslot
							@slot("judul_chart") Persentase Kepuasan  Pengguna untuk Keterlibatan dalam Pengabdian kepada Masyarakat @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q5d['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

{{-- PERTANYAAN 5E, F, G, H --}}
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
						<table class="table mb-0" id="datatable5e_h">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q5e['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q5e['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q5e" aria-expanded="true" aria-controls="pertanyaan_q5e">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q5e" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Kualitas jejaring yang dibangun Universitas</li>
									<li>Kontribusi Universitas terhadap pengguna</li>
									<li>Kontribusi pengguna terhadap kegiatan akademik Universitas</li>
									<li>Kontribusi pengguna terhadap kegiatan non-akademik Universitas</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">	
						@component("chart.pie_legend")
							{{-- @slot("judul") Kualitas Kerjasama UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kerjasama @endslot
							@slot("id_tabel") datatable5e_h @endslot
							@slot("judul_chart") Persentase Kepuasan Kualitas Kerjasama UM @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q5e['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 5I, J, K, L, M, N, O, P, Q --}}
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
						<table class="table mb-0" id="datatable5i_h">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q5i['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q5i['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q5i" aria-expanded="true" aria-controls="pertanyaan_q5i">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q5i" class="collapse pt-3" aria-labelledby="headingOne">
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
							@slot("id_tabel") datatable5i_h @endslot
							@slot("judul_chart") Persentase Kepuasan Layanan @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q5i['total_responden_sesungguhnya'] }} orang @endslot
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