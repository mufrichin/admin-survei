@extends('layouts.app_admin')

@section('content') 
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Rekapitulasi Angket Dosen</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row">
	{{-- PERTANYAAN 1, 5, 7 --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Visi, Misi, Tujuan & Sasaran Prodi, Fakultas, dan Universitas</h6>
			</div>
			<div class="card-body p-0 pb-3 text-center">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Apakah Ibu/bapak memahami rumusan visi, misi, tujuan, dan sasaran Universitas Negeri Malang?</span>
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
							@slot("subjudul_chart") Responden : Prodi {{ $list_pemahaman_vmts["prodi"]["total_responden"] }} | Fakultas {{ $list_pemahaman_vmts["fakultas"]["total_responden"] }} | Universitas {{ $list_pemahaman_vmts["universitas"]["total_responden"] }} @endslot
							@slot("judul_y") Persen @endslot
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
				<h6 class="m-0">Rumusan VMTS Prodi, Fakultas, dan Universitas</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-4">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Dari mana Ibu/Bapak mengetahui rumusan visi, misi, tujuan, dan sasaran Prodi/Jurusan tempat Ibu/Bapak bekerja?</span>
						</div>
						<table class="table mb-0 d-none" id="datatable2">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($media_vmts_prodi['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($media_vmts_prodi['total_responden'], 1)) * 100), 1) }}
											{{-- {{ number_format((($jumlah / max($media_vmts_prodi['total_pilihan'], 1)) * 100), 1) }} --}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@component("chart.pie_legend")
							{{-- @slot("judul") Rumusan VMTS UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_rumusan_prodi @endslot
							@slot("id_tabel") datatable2 @endslot
							@slot("judul_chart") Persentase Rumusan VMTS Prodi @endslot
							@slot("subjudul_chart") Total Responden: {{ $media_vmts_prodi['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>

					<div class="col-md-4">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Dari mana Ibu/Bapak mengetahui rumusan visi, misi, tujuan, dan sasaran Fakultas tempat Ibu/Bapak bekerja?</span>
						</div>
						<table class="table mb-0 d-none" id="datatable5">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($media_vmts_fakultas['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($media_vmts_fakultas['total_responden'], 1)) * 100), 1) }}
											{{-- {{ number_format((($jumlah / max($media_vmts_fakultas['total_pilihan'], 1)) * 100), 1) }} --}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@component("chart.pie_legend")
							{{-- @slot("judul") Rumusan VMTS UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_rumusan_fakultas @endslot
							@slot("id_tabel") datatable5 @endslot
							@slot("judul_chart") Persentase Rumusan VMTS Fakultas @endslot
							@slot("subjudul_chart") Total Responden: {{ $media_vmts_fakultas['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>

					<div class="col-md-4">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Dari mana Ibu/Bapak mengetahui rumusan visi, misi, tujuan, dan sasaran Universitas?</span>
						</div>
						<table class="table mb-0 d-none" id="datatable8">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($media_vmts_universitas['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($media_vmts_universitas['total_responden'], 1)) * 100), 1) }}
											{{-- {{ number_format((($jumlah / max($media_vmts_universitas['total_pilihan'], 1)) * 100), 1) }} --}}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						@component("chart.pie_legend")
							{{-- @slot("judul") Rumusan VMTS UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_rumusan_universitas @endslot
							@slot("id_tabel") datatable8 @endslot
							@slot("judul_chart") Persentase Rumusan VMTS Universitas  @endslot
							@slot("subjudul_chart") Total Responden: {{ $media_vmts_universitas['total_responden'] }} orang @endslot
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
				<h6 class="m-0">Kinerja VMTS Program Studi</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Bagaimana menurut Ibu/Bapak, kinerja Program Studi dalam mencapai visi dan sasarannya?</span>
						</div>
						<table class="table mb-0" id="datatable3_prodi">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($kinerja_prodi['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($kinerja_prodi['total_responden'], 1)) * 100), 1) }}
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
							@slot("id_tabel") datatable3_prodi @endslot
							@slot("judul_chart") Persentase Kinerja VMTS Program Studi @endslot
							@slot("subjudul_chart") Total Responden: {{ $kinerja_prodi['total_responden'] }} orang @endslot
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
				<h6 class="m-0">Kinerja VMTS Fakultas</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Bagaimana menurut Ibu/Bapak, kinerja Fakultas dalam mencapai visi dan sasarannya?</span>
						</div>
						<table class="table mb-0" id="datatable6">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Pilihan</th>
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($kinerja_fakultas['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $pertanyaan }}</td>
										<td class="text-right">
											{{ number_format((($jumlah / max($kinerja_fakultas['total_responden'], 1)) * 100), 1) }}
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
							@slot("id_chart") persentase_kinerja_fak @endslot
							@slot("id_tabel") datatable6 @endslot
							@slot("judul_chart") Persentase Kinerja VMTS Fakultas @endslot
							@slot("subjudul_chart") Total Responden: {{ $kinerja_fakultas['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 9 --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kinerja VMTS Universitas</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Bagaimana menurut Ibu/Bapak, kinerja Universitas dalam mencapai visi dan sasarannya?</span>
						</div>
						<table class="table mb-0" id="datatable9">
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
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Kinerja Universitas @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_kinerja_univ @endslot
							@slot("id_tabel") datatable9 @endslot
							@slot("judul_chart") Persentase Kinerja VMTS Universitas @endslot
							@slot("subjudul_chart") Total Responden: {{ $kinerja_universitas['total_responden'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>
				</div>
			</div>
		</div>
	</div>	

	{{-- PERTANYAAN 10B, C, D --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Visi, Misi, Tujuan, dan Sasaran (VMTS)</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Rumusan VMTS</span>
						</div>
						<table class="table mb-0" id="datatable10b">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q10b['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q10b['total_responden'], 1)) * 100), 1) }}
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
									<li>Rumusan Visi, Misi, Tujuan, dan Sasaran Prodi</li>
									<li>Rumusan Visi, Misi, Tujuan, dan Sasaran Fakultas</li>
									<li>Rumusan Visi, Misi, Tujuan, dan Sasaran Universitas</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Profil UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_vmts_prodi @endslot
							@slot("id_tabel") datatable10b @endslot
							@slot("judul_chart") Persentase Rumusan VMTS @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q10b['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 10A, F --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Sumber Daya Manusia (SDM)</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >SDM</span>
						</div>
						<table class="table mb-0" id="datatable10a">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q10a['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q10a['total_responden'], 1)) * 100), 1) }}
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
									<li>Kualitas dan Transparansi proses penerimaan Dosen</li>
									<li>Beban Mengajar</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Profil UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_penerimaan @endslot
							@slot("id_tabel") datatable10a @endslot
							@slot("judul_chart") Persentase SDM @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q10a['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>

				</div>
			</div>
		</div>
	</div>
	
	{{-- PERTANYAAN 10E, G, H, I, J --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Pendidikan</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Pendidikan</span>
						</div>
						<table class="table mb-0" id="datatable10e">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q10e['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q10e['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>	
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4e" aria-expanded="true" aria-controls="pertanyaan_q4e">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4e" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Penjadwalan Kegiatan pembelajaran</li>
									<li>Kualitas sarana dan prasarana mengajar</li>
									<li>Relevansi rumusan capaian pembelajaran dengan kebutuhan dunia kerja</li>
									<li>Ketersediaan sumber belajar untuk kegiatan pembelajaran</li>
									<li>Dukungan akademik dan pendanaan</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Profil UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_pencapaian_pemb @endslot
							@slot("id_tabel") datatable10e @endslot
							@slot("judul_chart") Persentase Pendidikan @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q10e['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 10K, L --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Penelitian</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">

					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Penelitian</span>
						</div>
						<table class="table mb-0" id="datatable10k">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q10k['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q10k['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>	
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4k" aria-expanded="true" aria-controls="pertanyaan_q4k">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4k" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Dukungan akademik pendanaan untuk diseminasi dan publikasi</li>
									<li>Ketersediaan fasilitas untuk melakukan penelitian</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Profil UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_diseminasi @endslot
							@slot("id_tabel") datatable10k @endslot
							@slot("judul_chart") Persentase Penelitian @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q10k['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 10M, N --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Pengabdian Masyarakat</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Pengabdian Masyarakat</span>
						</div>
						<table class="table mb-0" id="datatable10m">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q10m['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q10m['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>	
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4m" aria-expanded="true" aria-controls="pertanyaan_q4m">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4m" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Dukungan akademik dan pendanaan untuk pengabdian kepada masyarakat</li>
									<li>Ketersediaan fasilitas untuk melakukan pengabdian kepada masyarakat</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Profil UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_dukungan_akad @endslot
							@slot("id_tabel") datatable10m @endslot
							@slot("judul_chart") Persentase Pengabdian Masyarakat @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q10m['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>

				</div>
			</div>
		</div>
	</div>


	{{-- PERTANYAAN 10X, Y, Z --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Keuangan, Sarana dan prasarana</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Keuangan, Sarana dan prasarana</span>
						</div>
						<table class="table mb-0" id="datatable10x">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q10x['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q10x['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>	
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4x" aria-expanded="true" aria-controls="pertanyaan_q4x">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4x" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Dukungan untuk pengembangan profesi</li>
									<li>Dukungan untuk kegiatan promosi dan dan retensi</li>
									<li>Kualitas, keamanan, keselamatan, dan kenyamanan lingkungan kerja</li>
									<li>Gaji dan Tunjangan</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						@component("chart.pie_legend")
							{{-- @slot("judul") Profil UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_pengembangan_profesi @endslot
							@slot("id_tabel") datatable10x @endslot
							@slot("judul_chart") Persentase Keuangan, Sarana dan prasarana @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q10x['total_responden_sesungguhnya'] }} orang @endslot
							@slot("judul_y") Persentase @endslot
						@endcomponent
					</div>

				</div>
			</div>
		</div>
	</div>

	{{-- PERTANYAAN 10O, P, Q, R, S, T, U, V, W --}}
	<div class="col-md-12 col-sm-12 mb-4">
		<div class="card card-small mb-4">
			<div class="card-header border-bottom">
				<h6 class="m-0">Kepuasan Layanan</h6>
			</div>
			<div class="card-body p-0 pb-3">
				<div class="row">
					<div class="col-md-6">
						<div class="text-center p-3">
							<span class="text-info font-italic font-weight-bold" >Kepuasan Layanan</span>
						</div>
						<table class="table mb-0" id="datatable10o">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									{{-- <th scope="col" class="border-0">Jumlah Skor</th> --}}
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($list_q10o['kuesioner'] as $pertanyaan => $jumlah)
									<tr>
										<td>{{ $jumlah['alias'] }}</td>
										{{-- <td class="text-right">{{ $jumlah['skor'] }}</td> --}}
										<td class="text-right">
											{{ number_format((($jumlah['responden'] / max($list_q10o['total_responden'], 1)) * 100), 1) }}
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>	
						{{-- List Pertanyaan --}}
						<div class="mt-4 p-2">
							<button class="btn btn-dark btn-block" data-toggle="collapse" data-target="#pertanyaan_q4o" aria-expanded="true" aria-controls="pertanyaan_q4o">Daftar Pertanyaan <i class="fa fa-caret-down"></i></button>
							<div id="pertanyaan_q4o" class="collapse pt-3" aria-labelledby="headingOne">
								<ul>
									<li>Kejelasan kelengkapan informasi persyaratan untuk memperoleh layanan kelembagaan</li>
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
							{{-- @slot("judul") Profil UM @endslot --}}
							@slot("use_panel") no @endslot
							@slot("id_chart") persentase_persyaratan @endslot
							@slot("id_tabel") datatable10o @endslot
							@slot("judul_chart") Persentase Kepuasan Layanan @endslot
							@slot("subjudul_chart") Total Responden: {{ $list_q10o['total_responden_sesungguhnya'] }} orang @endslot
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