<div class="twoOne">
<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Detail Pegawai</h6></div>
            <?php 
				foreach ($pegawai as $row_pegawai) :
				{ 
					if ($row_pegawai['peg_jns_kelamin'] == 'P')
					{
						$kelamin = 'Perempuan';
					}
					else
					{
						$kelamin = 'Laki Laki';
					}
					if ($row_pegawai['peg_gol_darah'] == NULL)
					{
						$gol_darah = '-';
					}
					else
					{
						$gol_darah = $row_pegawai['peg_gol_darah'];
					}
					$datestring = "%d-%m-%Y" ;
					$tgl_lahir = mdate($datestring,strtotime($row_pegawai['peg_tgl_lahir']));
					$detail = anchor('pekerja/get_pegawai/'.$row_pegawai['peg_nipp'],'Detail'); 
				}endforeach; 
				if ($data_agama == NULL)
					{ $agama = '-';}
				else {
					foreach ($data_agama as $row_agama) :
					{ 
						$agama = $row_agama['p_ag_agama'];
					}endforeach;
				}
				if ($data_fisik == NULL)
					{ $foto = '';
					  $tinggi = '-';
					  $berat = '-';}
				foreach ($data_fisik as $row_fisik) :
				{ 
					$foto = $row_fisik['p_fs_foto'];
					$tinggi = $row_fisik['p_fs_tinggi'];
					$berat = $row_fisik['p_fs_berat'];
				}endforeach;
				if ($data_alamat == NULL)
					{ $telp = '-';
					  $jalan = '-';
					  $kelurahan = '-';
					  $kecamatan = '-';
					  $kabupaten = '-';
					  $provinsi = '-';}
				foreach ($data_alamat as $row_alamat) :
				{ 
					$telp = $row_alamat['p_al_no_telp'];
					$jalan = $row_alamat['p_al_jalan'];
					$kelurahan = $row_alamat['p_al_kelurahan'];
					$kecamatan = $row_alamat['p_al_kecamatan'];
					$kabupaten = $row_alamat['p_al_kabupaten'];
					$provinsi = $row_alamat['p_al_provinsi'];
				}endforeach;
				if ($data_status_keluarga == NULL)
					{ $row_stk['p_stk_status_keluarga'] = '-';}
				foreach ($data_status_keluarga as $row_stk) :
				{ 
				}endforeach;
				if ($data_pendidikan == NULL)
				{
					$row_pdd['p_pdd_tingkat'] = '';
					$row_pdd['p_pdd_lp']='';
					$row_pdd['p_pdd_masuk']='';
					$row_pdd['p_pdd_keluar']='';
				}else{
					foreach ($data_pendidikan as $row_pdd) :
					{ 
					}endforeach;
				}
				?>
				<?php  
				if($data_jabatan_tmt == NULL){
					$tmt = "-";
					$status = "-";
					$provider = "-";
					$jabatan = "-";
				} else {
					foreach ($data_jabatan_tmt as $row_jbt_tmt) :
						{
							$datestring = "%d-%m-%Y" ;
							$tmt = mdate($datestring,strtotime($row_jbt_tmt['p_tmt_tmt']));
							$status = $row_jbt_tmt['p_tmt_status'];
							$provider = $row_jbt_tmt['p_tmt_provider'];
							$jabatan = $row_jbt_tmt['p_jbt_jabatan'];
						} endforeach;
				}
				if($data_unit == NULL){
					$unit = "-";
				} else {
					foreach ($data_unit as $row_unit) :
					{
						$unit = $row_unit['p_unt_kode_unit'];
					} endforeach;
				}
				if ($data_grade == NULL)
				{ $grade = '';} else {
					foreach ($data_grade as $row_grade) :
					{
						$grade = $row_grade['p_grd_grade'];
					} endforeach;
				}?>
			<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <tfoot>
					<tr><td colspan=8><p align="right"><?php echo anchor ('pekerja/edit_data/'.$row_pegawai['peg_nipp'],'[edit]');?></p></td></tr>
				</tfoot>
				<tbody>
				
					<tr>
						<td width="25%" rowspan="11"><img src="<?php echo base_url()?>pegawai/foto/<?php echo $foto; ?>" width="220px" ></td>
						<td>NIPP</td><td><?php echo $row_pegawai['peg_nipp']; ?></td>
						<tr><td>Nama</td><td><?php echo $row_pegawai['peg_nama']; ?></td></tr>
						<tr><td>Tempat / Tanggal Lahir</td><td><?php echo $row_pegawai['peg_tmpt_lahir'].' / '.$tgl_lahir; ?></td></tr>
						<tr><td>Jenis Kelamin</td><td><?php echo $kelamin; ?></td></tr>
						<tr><td>Golongan Darah</td><td><?php echo $gol_darah; ?></td></tr>
						<tr><td>Agama</td><td><?php echo $agama; ?></td></tr>
						<tr><td>Tinggi</td><td><?php echo $tinggi.' cm'; ?></td></tr>
						<tr><td>Berat</td><td><?php echo $berat.' kg'; ?></td></tr>
						<tr><td>Nomor Telp</td><td><?php echo $telp; ?></td></tr>
						<tr><td>Status Keluarga</td><td><?php echo $row_stk['p_stk_status_keluarga']; ?></td></tr>
                    </tr> 
                </tbody>
            </table>
			<div id="clear"></div>
        </div>
</div>
<div class="OneTwo">
	<div class="widget rightTabs"> 
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /></div>     
            <ul class="tabs">
                <li><a href="#tab1">Alamat</a></li>
                <li><a href="#tab2">Pendidikan</a></li>
				<li><a href="#tab3">Jabatan</a></li>
				<li><a href="#tab4">Data Kompetensi</a></li>
				<li><a href="#tab5">Data Non Kompetensi</a></li>
            </ul>
            <div class="tab_container">
                <div id="tab1" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <tfoot>
							<tr><td colspan=2></td></tr>
						</tfoot>
                        <tbody>
								<tr><td width="30%">Jalan</td><td><?php echo $jalan;?></td></tr>
                                <tr><td>Kelurahan</td><td><?php echo $kelurahan;?></td></tr>
								<tr><td>Kecamatan</td><td><?php echo $kecamatan;?></td></tr>
								<tr><td>Kabupaten</td><td><?php echo $kabupaten;?></td></tr>
								<tr><td>Provinsi</td><td><?php echo $provinsi;?></td></tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div id="tab2" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <tfoot>
							<tr><td colspan=2><p align="right"></td></tr>
						</tfoot>
                        <tbody>
                            <tr><td width="30%">Pendidikan Terakhir</td><td><?php echo $row_pdd['p_pdd_tingkat'];?></td></tr>
                            <tr><td>Lembaga Pendidikan</td><td><?php echo $row_pdd['p_pdd_lp'];?></td></tr>
							<tr><td>Tahun</td><td><?php echo $row_pdd['p_pdd_masuk'].' s/d '.$row_pdd['p_pdd_keluar'];?></td></tr>
							<?php if ($jumlah_bahasa == 0)
							{
								$jumlah_bahasa = 1;
							} ?>
							<tr><td rowspan=<?php echo $jumlah_bahasa ?>>Bahasa yang dikuasai</td>
							<?php 
							$jumlah_bhs = 1;
							if ($data_bahasa == NULL)
							{ ?>
								<td></td>
							<?php }
							foreach ($data_bahasa as $row_bhs) :
							{ 	
							if ($jumlah_bhs == 1)
							{?>
								<td><?php echo $row_bhs['p_bhs_bahasa'];?></td>
							<?php } else {
							?>
								<tr><td><?php echo $row_bhs['p_bhs_bahasa'];?></td></tr>
							<?php }
							$jumlah_bhs++;
							}endforeach; ?>
							</tr>
						</tbody>
                    </table>
                </div>
				
                <div class="clear"></div>
				<div id="tab3" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <tfoot>
							<tr><td colspan=8></td></tr>
						</tfoot>
                        <tbody>
                            <tr><td width="30%">Jabatan Terakhir</td><td><?php echo $jabatan?></td></tr>
                            <tr><td>Terhitung Mulai Tanggal</td><td><?php echo $tmt; ?></td></tr>
							<tr><td>Unit</td><td><?php echo $unit ?></td></tr>
							<tr><td>Grade</td><td><?php echo $grade?></td></tr>
							<tr><td>Status Pegawai</td><td><?php echo $status?></td></tr>
							<tr><td>Provider</td><td><?php echo $provider?></td></tr>
                        </tbody>
                    </table>
                </div>
				<div id="tab4" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
						<thead>
						<tr>
							<td rowspan="2">No</td>
							<td rowspan="2">Jenis</td>
							<td rowspan="2">Rating</td>
							<td rowspan="2">No License / STKP</td>
							<td colspan="2">Validitas</td>
							<td rowspan="2">Lembaga</td>
							<td colspan="2">Tanggal Pelaksanaan</td>
							<td rowspan="2">Type STKP</td>
						</tr>
						<tr>
							<td>From</td><td>Until</td><td>From</td><td>Until</td>
						</tr>
						</thead>
                        <tfoot>
							<tr><td colspan=10></td></tr>
						</tfoot>
                        <tbody> <?php
						$datestring = "%d-%M-%Y" ;
						$monthstring = "%m";
						$yearstring = "%Y";
						$nipp = '';
						$stkp = '';
						$waktu = '';
						if ($this->uri->segment(3)== NULL)
						{
							$number = 1;
						} else {
							if ($this->uri->segment(2) == 'get_stkp')
							{	
								$number = $this->uri->segment(3)+1;
							} else {
								$number = $this->uri->segment(5)+1;
							}
						}
						foreach ($data_stkp as $row_pegawai) :
						{ 
							if ($row_pegawai['p_stkp_pelaksanaan'] == '0000-00-00')
							{
								$mulai= '-';
							}
							else
							{
								$mulai = mdate($datestring,strtotime($row_pegawai['p_stkp_pelaksanaan']));
							}
							if ($row_pegawai['p_stkp_selesai'] == '0000-00-00')
							{
								$selesai = '-';
							}
							else
							{
								$selesai =mdate($datestring,strtotime( $row_pegawai['p_stkp_pelaksanaan']));
							}
							if ($row_pegawai['p_stkp_mulai'] == '0000-00-00')
							{
								$stkp_mulai = '-';
							}
							else
							{
								$stkp_mulai = mdate($datestring,strtotime($row_pegawai['p_stkp_mulai']));
							}
							if ($row_pegawai['p_stkp_finish'] == '0000-00-00')
							{
								$stkp_selesai = '-';
							}
							else
							{
								$stkp_selesai = mdate($datestring,strtotime($row_pegawai['p_stkp_finish']));
							}
							$color = '';
							if ((mdate($yearstring,strtotime($row_pegawai['p_stkp_finish'])) <= $year)){
								if (mdate($monthstring,strtotime($row_pegawai['p_stkp_finish']))-$month <= 4) {
									$color = 'style="background-color:#ffdfdf"';
								}
							} ?>
						<tr>
                        <td <?php echo $color ?>><center><?php echo $number; ?></center></td>
						<td <?php echo $color ?>><?php echo $row_pegawai['p_stkp_jenis']; ?></td>
						<td <?php echo $color ?>><?php echo $row_pegawai['p_stkp_rating']; ?></td>
						<td <?php echo $color ?>><center><?php echo $row_pegawai['p_stkp_no_license']; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $stkp_mulai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $stkp_selesai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $row_pegawai['p_stkp_lembaga']; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $mulai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $selesai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $row_pegawai['p_stkp_type']; ?></center></td>
						
						<?php $number++;} endforeach;?>
                        </tbody>
                    </table>
                </div>
				<div class="clear"></div>
				<div id="tab5" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
						<thead>
						<tr>
							<td rowspan="2">No</td>
							<td rowspan="2">Training</td>
							<td rowspan="2">No Sertifikat</td>
							<td colspan="2">Pelaksanaan</td>
							<td rowspan="2">Lembaga</td>
						</tr>
						<tr>
							<td>From</td><td>Until</td>
						</tr>
						</thead>
                        <tfoot>
							<tr><td colspan=8></td></tr>
						</tfoot>
                        <tbody> <?php 
				$datestring = "%d-%M-%Y" ;
				$nipp = '';
				if ($this->uri->segment(3)== NULL)
				{
					$number = 1;
				} else {
					if ($this->uri->segment(2) == 'get_non_stkp')
					{
						$number = $this->uri->segment(3)+1;
					} else {
						$number = $this->uri->segment(5)+1;
					}
				}
				foreach ($data_nstkp as $row_pegawai) :
				{ 
					if ($row_pegawai['p_nstkp_pelaksanaan'] == '0000-00-00')
					{
						$pelaksanaan = '-';
					}
					else
					{
						$pelaksanaan = $row_pegawai['p_nstkp_pelaksanaan'];
					}
					
					if ($row_pegawai['p_nstkp_jenis'] == ""){$jenis_anchor = "";} else {$jenis_anchor = anchor('diklat/get_nstkp_selection/jenis/'.$row_pegawai['p_nstkp_jenis'], 	$row_pegawai['p_nstkp_jenis']);}
					if ($row_pegawai['p_nstkp_lembaga'] == ""){$lembaga_anchor = "";} else {$lembaga_anchor = anchor('diklat/get_nstkp_selection/lembaga/'.$row_pegawai['p_nstkp_lembaga'], $row_pegawai['p_nstkp_lembaga']);}
					if ($row_pegawai['p_nstkp_selesai'] == '0000-00-00')
					{
						$selesai = '-';
					}
					else
					{
						$selesai =mdate($datestring,strtotime( $row_pegawai['p_nstkp_selesai']));
					}
					if ($row_pegawai['p_nstkp_pelaksanaan'] == '0000-00-00')
					{
						$mulai = '-';
					}else
					{
						$mulai = mdate($datestring,strtotime($row_pegawai['p_nstkp_pelaksanaan']));
					}
					
					?>
						<tr>
                        <td><center><?php echo $number; ?></center></td>
						<td><?php echo $jenis_anchor; ?></td>
						<td><center><?php echo $row_pegawai['p_nstkp_no_license']; ?></center></td>
						<td><center><?php echo $mulai; ?></center></td>
						<td><center><?php echo $selesai; ?></center></td>
						<td><center><?php echo $lembaga_anchor; ?></center></td>
						
						<?php $number++;} endforeach;?>
                        </tbody>
                    </table>
                </div>
				<div class="clear"></div>
            </div>	
			<?php 
					foreach ($pegawai as $row_pegawai){}; 
					$nipp=$row_pegawai['peg_nipp'];
					$attr=" target='_blank'";
					$print = anchor('pekerja/print_kompetensi/'.$nipp,'Print',$attr);
					$create_pdf = anchor('creator/create_pdf_kompetensi/'.$nipp,'PDF',$attr);
					echo $print." ".$create_pdf;	
				?> 
        </div>
</div>
</div>
