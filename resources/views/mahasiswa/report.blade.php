@extends('layouts.app_admin')

@section('content') 

<div class="page-header row no-gutters py-4">
  <div class="col-12 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Rekapitulasi Angket Mahasiswa</h3>
  </div>
</div>

<div class="row">
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Pemahaman Visi, Misi, Tujuan & Sasaran Program Studi</h6>
			</div>
			<div class="card-body p-0 pb-3 text-center">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Apakah Anda memahami rumusan visi, misi, tujuan, dan sasaran Program Studi?</span>
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
							{{-- @slot("judul") Visi, Misi, Tujuan & Sasaran Program Studi @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_vmts @endslot
							@slot("id_tabel") datatable1 @endslot
							@slot("judul_chart") Persentase Pemahaman VMTS Program Studi @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q1['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
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
				<h6 class="m-0">Rumusan VMTS Program Studi</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Dari mana Anda mengetahui rumusan tersebut?</span>
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
							{{-- @slot("judul") Rumusan VMTS Prodi @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_rumusan @endslot
							@slot("id_tabel") datatable2 @endslot
							@slot("judul_chart") Persentase Rumusan VMTS Program Studi @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q2['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kinerja Program Studi</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Bagaimana menurut Anda, kinerja Program Studi / Jurusan dalam mencapai visi dan sasarannya?</span>
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
							{{-- @slot("judul") Kinerja Jurusan / Prodi @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kinerja_prodi @endslot
							@slot("id_tabel") datatable3 @endslot
							@slot("judul_chart") Persentase Kinerja Jurusan / Prodi @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q3['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kepuasan Program Studi</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian Visi, Misi, Tujuan dan Sasaran Program Studi</span>
						</div>
						<table class="table mb-0" id="datatable4a1">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q4a1['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q4a1['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4a1" aria-expanded="true" aria-controls="pertanyaan_q4a1">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4a1" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Kualitas, informasi, profil dan spesifikasi prodi</li>
									<li>Rumusan Visi, Misi, Tujuan dan Sasaran Prodi</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">	
							@component("chart.pie_legend")
							{{-- @slot("judul") Visi, Misi, Tujuan dan Sasaran Program Studi @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_vmts_prodi @endslot
							@slot("id_tabel") datatable4a1 @endslot
							@slot("judul_chart") Persentase Penilaian Visi, Misi, Tujuan dan Sasaran Program Studi @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4a1['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kepuasan Pendidikan</h6>
			</div>

			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian untuk Kepuasan Pendidikan</span>
						</div>
						<table class="table mb-0" id="datatable4a3">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q4a3['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q4a3['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4a3" aria-expanded="true" aria-controls="pertanyaan_q4a3">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4a3" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Kemutakhiran kurikulum program studi</li>
									<li>Kualitas dosen program studi</li>
									<li>Strategi pengajaran dan pembelajaran</li>
									<li>Sarana dan prasarana dalam kegiatan pembelajaran</li>
									<li>Kualitas proses belajar mengajar di prodi</li>
									<li>Kualitas dan transparansi penilaian hasil belajar</li>
									<li>Pemberian saran dan masukan oleh dosen</li>
									<li>Kualitas prodi dalam menyiapkan karir profesional</li>
									<li>Relevansi kurikulum prodi dalam pengembangan individu</li>
									<li>Relevansi kurikulum prodi dalam pengembangan akademik</li>
									<li>Relevansi kurikulum prodi dalam pengembangan profesional</li>
									<li>Relevansi kurikulum prodi dengan perkembangan dan kebutuhan dunia kerja</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">	
						@component("chart.pie_legend")
							{{-- @slot("judul") Kualitas Pendidikan @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_pendidikan @endslot
							@slot("id_tabel") datatable4a3 @endslot
							@slot("judul_chart") Penilaian untuk Kualitas Pendidikan @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4a3['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>
<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Penelitian</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Keterlibatan Dalam Penelitian</span>
						</div>
						<table class="table mb-0" id="datatable4a10">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q4a10['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q4a10['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						</div>
					<div class="col-md-6">	
						@component("chart.pie_legend")
							{{-- @slot("judul") Keterlibatan dalam Penelitian @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kepuasan_penelitian @endslot
							@slot("id_tabel") datatable4a10 @endslot
							@slot("judul_chart") Persentase Kepuasan Keterlibatan Mahasiswa dalam Penelitian @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4a10['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 4A10 --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Pengabdian Masyarakat</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Keterlibatan dalam Pengabdian Masyarakat</span>
						</div>
						<table class="table mb-0" id="datatable4a11">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q4a11['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q4a11['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						</div>
					<div class="col-md-6">	
						@component("chart.pie_legend")
							{{-- @slot("judul") Keterlibatan dalam Pengabdian @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kepuasan_pengabdian @endslot
							@slot("id_tabel") datatable4a11 @endslot
							@slot("judul_chart") Persentase Kepuasan Keterlibatan Mahasiswa dalam Pengabdian Masyarakat @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4a11['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Sumber Daya</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penilaian Sumber Daya untuk Mahasiswa </span>
						</div>
						<table class="table mb-0" id="datatableq4b1">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q4b1['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q4b1['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4b1" aria-expanded="true" aria-controls="pertanyaan_q4b1">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4b1" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Kualitas seleksi dan informasi penerimaan Mahasiswa Baru</li>
									<li>Kualitas dan dukungan teknologi dan informasi</li>
									<li>Kualitas dan dukungan terhadap aktivitas ekstrakurikuler</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">		
						@component("chart.pie_legend")
							{{-- @slot("judul") Kualitas Sumber Daya untuk Mahasiswa @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kualitas_sd @endslot
							@slot("id_tabel") datatableq4b1 @endslot
							@slot("judul_chart") Persentase Kepuasan Kualitas Sumber Daya untuk Mahasiswa @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4b1['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>


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
						<table class="table mb-0" id="datatableq4b4">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q4b4['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q4b4['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4b4" aria-expanded="true" aria-controls="pertanyaan_q4b4">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4b4" class="collapse pt-3" aria-labelledby="headingOne">
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
							@slot("id_tabel") datatableq4b4 @endslot
							@slot("judul_chart") Persentase Kepuasan Layanan @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q4b4['total_responden_sesungguhnya'] }} orang @endslot
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