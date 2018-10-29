@extends('layouts.app_admin')

@section('content')  
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
	<div class="col-12 text-center text-sm-left mb-0">
		<span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
		<h3 class="page-title">Rekapitulasi Angket Alumni</h3>
	</div>
</div>
<!-- End Page Header -->

<div class="row">
	{{-- PERTANYAAN 1 --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Visi, Misi, Tujuan & Sasaran Prodi</h6>
			</div>
			<div class="card-body p-0 pb-3 text-center">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Apakah Ibu/bapak memahami rumusan visi, misi, tujuan, dan sasaran Program Studi ketika Ibu/Bapak masih kuliah?</span>
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
				<h6 class="m-0">Rumusan VMTS Prodi</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-5">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Dari mana Ibu/Bapak mengetahui rumusan tersebut?</span>
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
									{{-- 	{{ number_format((($jumlah / max($list_q2['total_responden'], 1)) * 100), 1) }} --}}
										{{ number_format((($jumlah / max($list_q2['total_pilihan'], 1)) * 100), 1) }}
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
				<h6 class="m-0">Kinerja Program Studi/Jurusan</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Bagaimana menurut Ibu/Bapak, kinerja Program Studi/Jurusan dalam mencapai visi, misi, tujuan dan sasaranya </span>
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
							{{-- @slot("judul") Kinerja Program Studi/Jurusan @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kinerja_prodi @endslot
							@slot("id_tabel") datatable3 @endslot
							@slot("judul_chart") Persentase Kinerja Program Studi/Jurusan @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q3['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>
		{{-- PERTANYAAN 4 --}}
		<div class="col-md-12 col-sm-12 mb-4">
			<div class="card card-small mb-4">
				<div class="card-header border-bottom">
					<h6 class="m-0">Relevansi Program Studi dengan Pekerjaan</h6>
				</div>
				<div class="card-body p-0 pb-3 text-center">
					<div class="row">
						<div class="col-md-6">
							<div class="text-center p-3">
								<span class="text-info font-italic font-weight-bold" >Apakah pekerjaan Ibu/Bapak relevan dengan Program Studi/Jurusan yang ditempuh di Universitas Negeri Malang ?</span>
							</div>
							<table class="table mb-0" id="datatable4">
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
											{{ number_format((($list_q4['jumlah_ya'] / max($list_q4['total_responden'], 1)) * 100), 1) }}
										</td>
										<td>
											{{ number_format((($list_q4['jumlah_tidak'] / max($list_q4['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
							@component("chart.column")
							{{-- @slot("judul") Relevansi Prodi dan Pekerjaan @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_vmts_2 @endslot
							@slot("id_tabel") datatable4 @endslot
							@slot("judul_chart") Persentase Relevansi Program Studi/Jurusan dengan Pekerjaan @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
							@slot("tipe_value") percent @endslot
							@endcomponent
						</div>
					</div>
				</div>
			</div>
		</div>


		{{-- PERTANYAAN 5 --}}
		<div class="col-md-12 col-sm-12 mb-4">
			<div class="card card-small mb-4">
				<div class="card-header border-bottom">
					<h6 class="m-0">Status Karir</h6>
				</div>
				<div class="card-body p-0 pb-3">
					<div class="row">
						<div class="col-md-5">
							<div class="text-center p-3">
								<span class="text-info font-italic font-weight-bold" >Dari pilihan berikut ini mana yang menjelaskan status karir Ibu/Bapak ?</span>
							</div>
							<table class="table mb-0" id="datatable5">
								<thead class="bg-light">
									<tr>
										<th scope="col" class="border-0">Pilihan</th>
										<th scope="col" class="border-0">Persentase (%)</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($list_q5['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($list_q5['total_pilihan'], 1)) * 100), 1) }}
											
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="col-md-7">
							@component("chart.pie_legend")
							{{-- @slot("judul") Status Karir @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_q5 @endslot
							@slot("id_tabel") datatable5 @endslot
							@slot("judul_chart") Persentase Status Karir  @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q5['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
							@endcomponent
						</div>
					</div>
				</div>
			</div>
		</div>


		{{-- PERTANYAAN 6 --}}
		<div class="col-md-12 col-sm-12 mb-4">
			<div class="card card-small mb-4">
				<div class="card-header border-bottom">
					<h6 class="m-0">Status Pekerjaan</h6>
				</div>
				<!-- {{print_r($list_q6)}} -->
				<div class="card-body p-0 pb-3">
					<div class="row">
						<div class="col-md-5">
							<div class="text-center p-3">
								<span class="text-info font-italic font-weight-bold" >Dari pilihan berikut ini mana yang menjelaskan status pekerjaan Ibu/Bapak ?</span>
							</div>
							<table class="table mb-0" id="datatable6">
								<thead class="bg-light">
									<tr>
										<th scope="col" class="border-0">Pilihan</th>
										<th scope="col" class="border-0">Persentase (%)</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($list_q6['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($list_q6['total_responden'], 1)) * 100), 1) }}
											{{-- {{ number_format((($jumlah / max($list_q6['total_pilihan'], 1)) * 100), 1) }} --}}
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<div class="col-md-7">
							@component("chart.pie_legend")
							{{-- @slot("judul") Status Pekerjaan @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_q6 @endslot
							@slot("id_tabel") datatable6 @endslot
							@slot("judul_chart") Persentase Status Pekerjaan  @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q6['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
							@endcomponent
						</div>
					</div>
				</div>
			</div>
		</div>


		

		{{-- PERTANYAAN 7a 1 --}}
		<div class="col-md-12 col-sm-12 mb-4">
			<div class="card card-small mb-4">
				<div class="card-header border-bottom">
					<h6 class="m-0">Visi, Misi, Tujuan, Sasaran</h6>
				</div>
				<div class="card-body p-0 pb-3">
					<div class="row">
						<div class="col-md-5">
							<div class="text-center p-3">
								<span class="text-info font-italic font-weight-bold" >Penilaian terhadap kualitas informasi dan profil program studi</span>
							</div>
							<table class="table mb-0" id="datatableq7a1">
								<thead class="bg-light">
									<tr>
										<th scope="col" class="border-0">Kategori</th>
										{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
										<th scope="col" class="border-0">Persentase (%)</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($list_q7a1['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q7a1['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>	
						</div>
						<div class="col-md-7">
							@component("chart.pie_legend")
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_q7a1 @endslot
							@slot("id_tabel") datatableq7a1 @endslot
							@slot("judul_chart") Persentase Kualitas Informasi dan Profil Program Studi @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q7a1['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
							@endcomponent
						</div>
					</div>
				</div>
			</div>
		</div>


{{-- PERTANYAAN 7a2-9 --}}

	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kepuasan Terhadap Program Studi</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian kepuasan terhadap Program Studi</span>
						</div>
						<table class="table mb-0" id="datatable_q7a2">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q7a2['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q7a2['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						{{-- List Pertanyaan --}}
						<div class="mt-2 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="collapse3" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<ul class="pl-2">
										<li>Kurikulum Program Studi</li>
										<li>Kualitas dosen Program Studi</li>
										<li>Kualitas pembimbingan tugas akhir/skripsi/tesis/disertasi</li>
										<li>Kualitas Prodi dalam menyiapkan karir professional</li>
										<li>Relevansi kurikulum Prodi dalam pengembangan individu</li>
										<li>Relevansi kurikulum Prodi dalam pengembangan akademik</li>
										<li>Relevansi kurikulum Prodi dalam pengembangan professional</li>
										<li>Relevansi kurikulum Prodi dengan bidang pekerjaan</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") program studi @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentaseq7a2 @endslot
							@slot("id_tabel") datatable_q7a2 @endslot
							@slot("judul_chart") Persentase kepuasan terhadap Program Studi @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q7a2['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>			
				</div>
			</div>
		</div>
	</div>
		<!-- akhir q7a1-9-->


		{{-- PERTANYAAN 7a10-12 --}}

	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kerjasama</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk kerjasama</span>
						</div>
						<table class="table mb-0" id="datatableq7a10">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q7a10['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q7a10['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						{{-- List Pertanyaan --}}
						<div class="mt-2 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<ul class="pl-2">
										<li>Kualitas jejaring yang dibangun Program Studi</li>
										<li>Kontribusi alumni dalam kegiatan akademik Program Studi</li>
										<li>Kontribusi alumni dalam kegiatan non-akademik Program Studi</li>

									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Kerjasama @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_q7a10 @endslot
							@slot("id_tabel") datatableq7a10 @endslot
							@slot("judul_chart") Persentase Kualitas Kerjasama @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q7a10['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>			
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 7a 13 --}}
		<div class="col-md-12 col-sm-12 mb-4">
			<div class="card card-small mb-4">
				<div class="card-header border-bottom">
					<h6 class="m-0">Luaran</h6>
				</div>
				<div class="card-body p-0 pb-3">
					<div class="row">
						<div class="col-md-5">
							<div class="text-center p-3">
								<span class="text-info font-italic font-weight-bold" >Penilaian kepuasan alumni terhadap pekerjaan alumni saat ini</span>
							</div>
							<table class="table mb-0" id="datatableq7a13">
								<thead class="bg-light">
									<tr>
										<th scope="col" class="border-0">Kategori</th>
										{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
										<th scope="col" class="border-0">Persentase (%)</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($list_q7a13['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q7a13['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>	
						</div>
						<div class="col-md-7">
							@component("chart.pie_legend")
							@slot("use_panel") no @endslot
							@slot("id_chart") persentaseq7a13 @endslot
							@slot("id_tabel") datatableq7a13 @endslot
							@slot("judul_chart") Persentase Kepuasan Alumni Terhadap Pekerjaan Alumni Saat ini @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q7a13['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
							@endcomponent
						</div>
					</div>
				</div>
			</div>
		</div>

			


{{-- PERTANYAAN 7b1-10 --}}

	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kepuasan Layanan Kelembagaan</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk kepuasan layanan kelembagaan</span>
						</div>
						<table class="table mb-0" id="datatableq7b1">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q7b1['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q7b1['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						{{-- List Pertanyaan --}}
						<div class="mt-2 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="collapse2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
								<div class="card-body">
									<ul class="pl-2">
										<li>Kejelasan dan kelengkapan informasi persyaratan yang diperlukan untuk memperoleh layanan kelembagaan</li>
										<li>Prosedur pemberian layanan kelembagaan</li>
										<li>Waktu pemberian layanan kelembagaan</li>
										<li>Biaya pemberian layanan kelembagaan</li>
										<li>Produk layanan kelembagaan</li>
										<li>Kompetensi layanan kelembagaan</li>
										<li>Perilaku pelaksana layanan kelembagaan</li>
										<li>penanganan pengaduan terkait pelaksanaan layanan kelembagaan</li>
										<li>kualitas layanan kelembagaan</li>


									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Kepuasan Layanan @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_q7b1 @endslot
							@slot("id_tabel") datatableq7b1 @endslot
							@slot("judul_chart") Persentase Kepuasan Layanan @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q7b1['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>			
				</div>
			</div>
		</div>
	</div>
		<!-- akhir q7b1-10 -->


	</div> <!-- body -->
	@endsection

	@push("reportjs")
	<script type="text/javascript" src="{{ asset("/js/highchart/highcharts.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/js/highchart/modules/data.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/js/highchart/modules/exporting.js") }}"></script>
	<script type="text/javascript" src="{{ asset("/js/highchart/modules/export-data.js") }}"></script>
	@endpush