<?php $__env->startSection('content'); ?> 
<!-- Page Header -->
<div class="page-header row no-gutters py-4">
  <div class="col-12 text-center text-sm-left mb-0">
    <span class="text-uppercase page-subtitle">SI Survei Kepuasan</span>
    <h3 class="page-title">Rekapitulasi Angket Dosen</h3>
  </div>
</div>
<!-- End Page Header -->

<div class="row">
	
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
								<?php 
									$key = array_keys($list_pemahaman_vmts);
									$i=0;
								 ?>
								<?php $__currentLoopData = $list_pemahaman_vmts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pemahaman_vmts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<th><?php echo e(ucfirst($key[$i++])); ?></th>
									<td>
										<?php echo e(number_format((($pemahaman_vmts['ya']/max($pemahaman_vmts["total_responden"], 1))*100), 1)); ?>

									</td>
									<td>
										<?php echo e(number_format((($pemahaman_vmts['tidak']/max($pemahaman_vmts["total_responden"], 1))*100), 1)); ?>

									</td>
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<?php $__env->startComponent("chart.column"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_vmts <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable1 <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Pemahaman VMTS <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Responden : Prodi <?php echo e($list_pemahaman_vmts["prodi"]["total_responden"]); ?> | Fakultas <?php echo e($list_pemahaman_vmts["fakultas"]["total_responden"]); ?> | Universitas <?php echo e($list_pemahaman_vmts["universitas"]["total_responden"]); ?> <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persen <?php $__env->endSlot(); ?>
							<?php $__env->slot("tipe_value"); ?> percent <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	
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
								<?php $__currentLoopData = $media_vmts_prodi['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($pertanyaan); ?></td>
										<td class="text-right">
											<?php echo e(number_format((($jumlah / max($media_vmts_prodi['total_responden'], 1)) * 100), 1)); ?>

											
										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_rumusan_prodi <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable2 <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Rumusan VMTS Prodi <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($media_vmts_prodi['total_responden']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
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
								<?php $__currentLoopData = $media_vmts_fakultas['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($pertanyaan); ?></td>
										<td class="text-right">
											<?php echo e(number_format((($jumlah / max($media_vmts_fakultas['total_responden'], 1)) * 100), 1)); ?>

											
										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_rumusan_fakultas <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable5 <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Rumusan VMTS Fakultas <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($media_vmts_fakultas['total_responden']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
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
								<?php $__currentLoopData = $media_vmts_universitas['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($pertanyaan); ?></td>
										<td class="text-right">
											<?php echo e(number_format((($jumlah / max($media_vmts_universitas['total_responden'], 1)) * 100), 1)); ?>

											
										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_rumusan_universitas <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable8 <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Rumusan VMTS Universitas  <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($media_vmts_universitas['total_responden']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	
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
								<?php $__currentLoopData = $kinerja_prodi['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($pertanyaan); ?></td>
										<td class="text-right">
											<?php echo e(number_format((($jumlah / max($kinerja_prodi['total_responden'], 1)) * 100), 1)); ?>

										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_kinerja <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable3_prodi <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Kinerja VMTS Program Studi <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($kinerja_prodi['total_responden']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	
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
								<?php $__currentLoopData = $kinerja_fakultas['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($pertanyaan); ?></td>
										<td class="text-right">
											<?php echo e(number_format((($jumlah / max($kinerja_fakultas['total_responden'], 1)) * 100), 1)); ?>

										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_kinerja_fak <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable6 <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Kinerja VMTS Fakultas <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($kinerja_fakultas['total_responden']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	
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
								<?php $__currentLoopData = $kinerja_universitas['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($pertanyaan); ?></td>
										<td class="text-right">
											<?php echo e(number_format((($jumlah / max($kinerja_universitas['total_responden'], 1)) * 100), 1)); ?>

										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-6">
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_kinerja_univ <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable9 <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Kinerja VMTS Universitas <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($kinerja_universitas['total_responden']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>	

	
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
									
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $list_q10b['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($jumlah['alias']); ?></td>
										
										<td class="text-right">
											<?php echo e(number_format((($jumlah['responden'] / max($list_q10b['total_responden'], 1)) * 100), 1)); ?>

										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>	
						
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
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_vmts_prodi <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable10b <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Rumusan VMTS <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($list_q10b['total_responden_sesungguhnya']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
					</div>

				</div>
			</div>
		</div>
	</div>

	
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
									
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $list_q10a['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($jumlah['alias']); ?></td>
										
										<td class="text-right">
											<?php echo e(number_format((($jumlah['responden'] / max($list_q10a['total_responden'], 1)) * 100), 1)); ?>

										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>	
						
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
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_penerimaan <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable10a <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase SDM <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($list_q10a['total_responden_sesungguhnya']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
					</div>

				</div>
			</div>
		</div>
	</div>
	
	
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
									
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $list_q10e['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($jumlah['alias']); ?></td>
										
										<td class="text-right">
											<?php echo e(number_format((($jumlah['responden'] / max($list_q10e['total_responden'], 1)) * 100), 1)); ?>

										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>	
						
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
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_pencapaian_pemb <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable10e <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Pendidikan <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($list_q10e['total_responden_sesungguhnya']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
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
							<span class="text-info font-italic font-weight-bold" >Penelitian</span>
						</div>
						<table class="table mb-0" id="datatable10k">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $list_q10k['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($jumlah['alias']); ?></td>
										
										<td class="text-right">
											<?php echo e(number_format((($jumlah['responden'] / max($list_q10k['total_responden'], 1)) * 100), 1)); ?>

										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>	
						
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
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_diseminasi <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable10k <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Penelitian <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($list_q10k['total_responden_sesungguhnya']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
					</div>

				</div>
			</div>
		</div>
	</div>

	
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
									
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $list_q10m['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($jumlah['alias']); ?></td>
										
										<td class="text-right">
											<?php echo e(number_format((($jumlah['responden'] / max($list_q10m['total_responden'], 1)) * 100), 1)); ?>

										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>	
						
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
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_dukungan_akad <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable10m <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Pengabdian Masyarakat <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($list_q10m['total_responden_sesungguhnya']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
					</div>

				</div>
			</div>
		</div>
	</div>


	
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
									
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $list_q10x['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($jumlah['alias']); ?></td>
										
										<td class="text-right">
											<?php echo e(number_format((($jumlah['responden'] / max($list_q10x['total_responden'], 1)) * 100), 1)); ?>

										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>	
						
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
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_pengembangan_profesi <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable10x <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Keuangan, Sarana dan prasarana <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($list_q10x['total_responden_sesungguhnya']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
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
							<span class="text-info font-italic font-weight-bold" >Kepuasan Layanan</span>
						</div>
						<table class="table mb-0" id="datatable10o">
							<thead class="bg-light">
								<tr>
									<th scope="col" class="border-0">Kategori</th>
									
									<th scope="col" class="border-0">Persentase (%)</th>
								</tr>
							</thead>
							<tbody>
								<?php $__currentLoopData = $list_q10o['kuesioner']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pertanyaan => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($jumlah['alias']); ?></td>
										
										<td class="text-right">
											<?php echo e(number_format((($jumlah['responden'] / max($list_q10o['total_responden'], 1)) * 100), 1)); ?>

										</td>
									</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>	
						
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
						<?php $__env->startComponent("chart.pie_legend"); ?>
							
							<?php $__env->slot("use_panel"); ?> no <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_chart"); ?> persentase_persyaratan <?php $__env->endSlot(); ?>
							<?php $__env->slot("id_tabel"); ?> datatable10o <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_chart"); ?> Persentase Kepuasan Layanan <?php $__env->endSlot(); ?>
							<?php $__env->slot("subjudul_chart"); ?> Total Responden: <?php echo e($list_q10o['total_responden_sesungguhnya']); ?> orang <?php $__env->endSlot(); ?>
							<?php $__env->slot("judul_y"); ?> Persentase <?php $__env->endSlot(); ?>
						<?php echo $__env->renderComponent(); ?>
					</div>

				</div>
			</div>
		</div>
	</div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush("reportjs"); ?>
	<script type="text/javascript" src="<?php echo e(asset("/js/highchart/highcharts.js")); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset("/js/highchart/modules/data.js")); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset("/js/highchart/modules/exporting.js")); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset("/js/highchart/modules/export-data.js")); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>