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
					  $provinsi = '-';
					  $email = '-';
					  }
				foreach ($data_alamat as $row_alamat) :
				{ 
					$telp = $row_alamat['p_al_no_telp'];
					$jalan = $row_alamat['p_al_jalan'];
					$kelurahan = $row_alamat['p_al_kelurahan'];
					$kecamatan = $row_alamat['p_al_kecamatan'];
					$kabupaten = $row_alamat['p_al_kabupaten'];
					$provinsi = $row_alamat['p_al_provinsi'];
					$email = $row_alamat['p_al_email'];
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
				
				if($data_jabatan==NULL){
					$jabatan = "-";
					$tmt_jabatan = "-";
					
				}
				else{
				foreach ($data_jabatan as $row_jbt) :
				{
					$datestring = "%d-%m-%Y" ;
					$jabatan = $row_jbt['p_jbt_jabatan'];
					$tmt_jabatan = mdate($datestring,strtotime($row_jbt['p_jbt_tmt_start']));
				} endforeach;
				}
				
				if($data_tmt==NULL)
				{
					$status="-";
					$tmt = "-";
					$provider ="-";
					$tmt_reason = "-";
				} else {
					foreach ($data_tmt as $row_tmt) :
					{
						$datestring = "%d-%m-%Y" ;
						$tmt = mdate($datestring,strtotime($row_tmt['p_tmt_tmt']));
						$status = $row_tmt['p_tmt_status'];
						$provider = $row_tmt['p_tmt_provider'];
						$tmt_reason = $row_tmt['p_tmt_reason'];
					} endforeach;
					
					
				}
				
				if($data_unit == NULL){
					$kode_unit="-";
					$sub_unit ="-";
					$team = "-";
					$grade = "-";
				} else {
					foreach ($data_unit as $row_unit) :
					{
						$kode_unit = $row_unit['p_unt_kode_unit'];
						$sub_unit = $row_unit['su_sub_unit'];
						$team = $row_unit['p_unt_team'];
					} endforeach;
					if ($data_grade == NULL)
					{ $grade = '';} else {
						foreach ($data_grade as $row_grade) :
						{
							$grade = $row_grade['p_grd_grade'];
						} endforeach;
					}
				}
				
				
				?>
			<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <tfoot>
					<tr><td colspan=8><p align="right"><?php echo anchor ('pekerja/edit_data/'.$row_pegawai['peg_nipp'],'[edit]');?></p></td></tr>
				</tfoot>
				<tbody>
				
					<tr>
						<td width="25%" rowspan="11"><img src="<?php echo base_url()?>pegawai/foto/<?php echo $row_pegawai['peg_nipp']; ?>.jpg" width="220px" ></td>
						<td>NIPP</td><td><?php echo $row_pegawai['peg_nipp']; ?></td>
						<tr><td>NAMA</td><td><?php echo strtoupper($row_pegawai['peg_nama']); ?></td></tr>
						<tr><td>TEMPAT / TANGGAL LAHIR</td><td><?php echo strtoupper($row_pegawai['peg_tmpt_lahir']).' / '.$tgl_lahir; ?></td></tr>
						<tr><td>JENIS KELAMIN</td><td><?php echo strtoupper($kelamin); ?></td></tr>
						<tr><td>GOLONGAN DARAH</td><td><?php echo strtoupper($gol_darah); ?></td></tr>
						<tr><td>AGAMA</td><td><?php echo strtoupper($agama); ?></td></tr>
						<tr><td>TINGGI</td><td><?php echo $tinggi.' cm'; ?></td></tr>
						<tr><td>BERAT</td><td><?php echo $berat.' kg'; ?></td></tr>
						<tr><td>NOMOR TELP</td><td><?php echo $telp; ?></td></tr>
						<tr><td>STATUS KELUARGA</td><td><?php echo strtoupper($row_stk['p_stk_status_keluarga']); ?></td></tr>
                    </tr> 
                </tbody>
            </table>
			<div id="clear"></div>
        </div>
</div>

<?php 
# jika pegawai masih aktif 

if( $tmt_reason==""){?>
<div class="oneThree">
<div class="widget">
<div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>DELETE PEGAWAI</h6></div>
<?php echo form_open('pekerja/submit_delete_pegawai/'.$row_pegawai['peg_nipp']);?>
<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
	<tr><td>Reason</td>
	<td><?php 
	$reason = array(
		'Pindah Cabang' => 'Pindah Cabang',
		'Pensiun Dini' => 'Pensiun Dini',
		'Pensiun' => 'Pensiun',
		'PHK' => 'Pemutusan Hubungan Kerja',
		'Other' => 'Other'
		);
	echo form_dropdown('reason',$reason); ?></td></tr>
	<tr><td></td>
	<td><?php 
	$cabang = array(
		'name' => 'cabang',
		'id'   => 'cabang',
		'title'=> 'nama cabang tujuan',
	);
	echo form_input($cabang);
	?>
	<div style="color:red; size:1pt"> Jika Pindah Cabang Mohon Isi Nama Cabang</div>
	</td></tr>
	<tr><td>TERHITUNG MULAI</td>
	<td><?php 
	$tanggal = array(
		'name' => 'tanggal',
		'id'   => 'tanggal',
		'class'=> 'maskDate'
	);
	echo form_input($tanggal)?></td></tr>
	<tr><td>KETERANGAN</td>
	<td><?php 
	$ket = array(
		'name' => 'ket',
		'id'   => 'ket',
	);
	echo form_textarea($ket)?></td></tr>
	<tr><td colspan="2" align="right">
	<?php $submit = array(
			'class' => 'blueB m110',
			'id'	=> 'next2',
			'value'	=> 'Submit',
			);
	echo form_submit($submit)?></td></tr>
</table>
<?php echo form_close();?>
</div>
</div>
<?php } else {?>
<div class="oneThree">
<div class="widget">
<div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>AKTIFKAN PEGAWAI</h6></div>
<?php echo form_open('pekerja/submit_aktifkan_pegawai/'.$row_pegawai['peg_nipp']);?>
<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
	<tr><td>TERHITUNG MULAI</td>
	<td><?php 
	$tanggal = array(
		'name' => 'tanggal',
		'id'   => 'tanggal',
		'class'=> 'maskDate'
	);
	echo form_input($tanggal)?>
	<input type="text" name="status" id="status" value="<?php echo $status; ?>" /hidden>
	<input type="text" name="provider" id="provider" value="<?php echo $provider; ?>" /hidden>
	</td></tr>
	<tr><td colspan="2" align="right">
	<?php $submit = array(
			'class' => 'blueB m110',
			'id'	=> 'next2',
			'value'	=> 'Submit',
			);
	echo form_submit($submit)?></td></tr>
</table>
<?php echo form_close();?>
</div>
</div>
<?php } ?>

<div class="twoOne2">
	<div class="widget rightTabs" style="width:1150px;"> 
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /></div>     
            <ul class="tabs">
                <li><a href="#tab1">ALAMAT</a></li>
                <li><a href="#tab2">PENDIDIKAN</a></li>
				<li><a href="#tab3">JABATAN</a></li>
				<li><a href="#tab4">PASANGAN</a></li>
				<li><a href="#tab8">DATA ANAK</a></li>
				<li><a href="#tab5">DATA ORANG TUA</a></li>
				<li><a href="#tab6">DATA MERTUA</a></li>
        		<li><a href="#tab7">RIWAYAT JABATAN</a></li>
				<li><a href="#tab9">RIWAYAT GOLONGAN</a></li>
            	<li><a href="#tab10">SANKSI DISIPLIN</a></li>
            </ul>
            <div class="tab_container">
                <div id="tab1" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <tfoot>
							<tr><td colspan=2><p align="right">
							<?php 
								echo anchor('pekerja/edit_alamat_pegawai/'.$row_pegawai['peg_nipp'],'[edit]');
							?></p></td></tr>
						</tfoot>
                        <tbody>
								<tr><td width="30%">JALAN</td><td><?php echo strtoupper($jalan);?></td></tr>
                                <tr><td>KELURAHAN</td><td><?php echo strtoupper($kelurahan);?></td></tr>
								<tr><td>KECAMATAN</td><td><?php echo strtoupper($kecamatan);?></td></tr>
								<tr><td>KABUPATEN</td><td><?php echo strtoupper($kabupaten);?></td></tr>
								<tr><td>PROVINSI</td><td><?php echo strtoupper($provinsi);?></td></tr>
                            	<tr><td>EMAIL</td><td><?php echo strtoupper($email);?></td></tr>
                            
                        </tbody>
                    </table>
                </div>
                <div id="tab2" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <tfoot>
							<tr><td colspan=2><p align="right"><?php 
							if ($status !== 'Outsource')
							{
								echo anchor('pekerja/add_bahasa_pegawai/'.$row_pegawai['peg_nipp'],'[add]  '); 
								echo anchor('pekerja/edit_pendidikan_pegawai/'.$row_pegawai['peg_nipp'],'[edit]');
							}?></p></td></tr>
						</tfoot>
                        <tbody>
                            <tr><td width="30%">PENDIDIKAN TERAKHIR</td><td><?php echo strtoupper($row_pdd['p_pdd_tingkat']);?></td></tr>
                            <tr><td>LEMBAGA PENDIDIKAN</td><td><?php echo strtoupper($row_pdd['p_pdd_lp']);?></td></tr>
							<tr><td>TAHUN</td><td><?php echo $row_pdd['p_pdd_masuk'].' s/d '.$row_pdd['p_pdd_keluar'];?></td></tr>
							<?php if ($jumlah_bahasa == 0)
							{
								$jumlah_bahasa = 1;
							} ?>
							<tr><td rowspan=<?php echo $jumlah_bahasa ?>>BAHASA YANG DIKUASAI</td>
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
								<td><?php echo strtoupper($row_bhs['p_bhs_bahasa']);?></td>
							<?php } else {
							?>
								<tr><td><?php echo strtoupper($row_bhs['p_bhs_bahasa']);?></td></tr>
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
							<tr><td colspan=8><p align="right"><?php 
							//if ($status !== 'Outsource')
							//{
								echo anchor('pekerja/edit_provider_pegawai/'.$row_pegawai['peg_nipp'],'[pindah provider]')?>
								&nbsp;&nbsp;&nbsp; <?php echo anchor('pekerja/edit_status_pegawai/'.$row_pegawai['peg_nipp'],'[edit status]');?>
								&nbsp;&nbsp;&nbsp; <?php echo anchor('pekerja/edit_jabatan_pegawai/'.$row_pegawai['peg_nipp'],'[edit]');
							//}	
								?>
								</p></td></tr>
						</tfoot>
                        <tbody>
                            <tr><td>T.M.T KERJA</td><td><?php echo $tmt;
										echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										//echo anchor('pekerja/add_tmt_pegawai/'.$row_pegawai['peg_nipp'],'[edit]');?></td></tr>
							<tr><td width="30%">JABATAN TERAKHIR</td><td><?php echo strtoupper($jabatan);?></td></tr>
                            <tr><td>T.M.T JABATAN</td><td><?php echo strtoupper($tmt_jabatan);  ?></td></tr>
							<tr><td>UNIT</td><td><?php echo strtoupper($kode_unit);?></td></tr>
							<tr><td>SUB UNIT</td><td><?php echo strtoupper($sub_unit);?></td></tr>
							<tr><td>TEAM</td><td><?php echo strtoupper($team);?></td></tr>
							<tr><td>GRADE</td><td><?php echo strtoupper($grade);?></td></tr>
							<?php if($tmt_reason==""){?>
							<tr><td>STATUS PEGAWAI</td><td><?php echo strtoupper($status);?></td></tr>
							<tr><td>PROVIDER</td><td><?php echo strtoupper($provider);?></td></tr>
							<?php }else{?>
							<tr><td colspan="2"><?php echo strtoupper($tmt_reason);?></td></tr>
							<?php }?>
							
                        </tbody>
                    </table>
                </div>
				<?php 
				if ($data_pasangan == NULL)
				{
					$row_pasangan['p_ps_nama'] = '-';
					$row_pasangan['p_ps_tmpt_lahir'] = '-';
					$ps_tgl_lahir = '-';
					$ps_tgl_meninggal = '-';
					$row_pasangan['p_ps_alamat'] = '-';
					$row_pasangan['p_ps_pekerjaan'] = '-';
					$row_pasangan['p_ps_agama'] = '-';
					$row_pasangan['p_ps_jns_kelamin'] = '-';
					
				}else{
					foreach ($data_pasangan as $row_pasangan) :
					{
						$datestring = "%d-%m-%Y" ;
						//$tgl_lahir = mdate($datestring,strtotime($row_pasangan['p_ps_tgl_lahir']));
						
						if ($row_pasangan['p_ps_tgl_lahir'] == '0000-00-00'){$ps_tgl_lahir="-";} 
						else {$ps_tgl_lahir = mdate($datestring,strtotime($row_pasangan['p_ps_tgl_lahir']));}
						if ($row_pasangan['p_ps_tgl_meninggal'] == '0000-00-00'){$ps_tgl_meninggal="-";} 
						else {$ps_tgl_meninggal = mdate($datestring,strtotime($row_pasangan['p_ps_tgl_meninggal']));}
					
					} endforeach;}?>
                <div class="clear"></div>
				<div id="tab4" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <tfoot>
							<tr><td colspan=8><p align="right"><?php if ($status !== 'Outsource')
							{
								if($data_pasangan == NULL){ echo anchor('pekerja/add_pegawai_pasangan_baru/'.$row_pegawai['peg_nipp'],'[add]');}
								else{
									echo anchor('pekerja/edit_pasangan_pegawai/'.$row_pegawai['peg_nipp'],'[edit]');
									echo anchor('pekerja/delete_pasangan_pegawai/'.$row_pegawai['peg_nipp'],'[delete]');
								}
							}?></p></td></tr>
						</tfoot>
                        <tbody>
                            <tr><td width="30%">NAMA</td><td><?php echo strtoupper($row_pasangan['p_ps_nama']);?></td></tr>
                            <tr><td>TEMPAT / TANGGAL LAHIR</td><td><?php echo strtoupper($row_pasangan['p_ps_tmpt_lahir']).' / '.$ps_tgl_lahir;?></td></tr>
							<tr><td>TANGGAL MENINGGAL</td><td><?php echo strtoupper($ps_tgl_meninggal);?></td></tr>
							<tr><td>ALAMAT</td><td><?php echo strtoupper($row_pasangan['p_ps_alamat']);?></td></tr>
							<tr><td>PEKERJAAN</td><td><?php echo strtoupper($row_pasangan['p_ps_pekerjaan']);?></td></tr>
                        	<tr><td>AGAMA</td><td><?php echo strtoupper($row_pasangan['p_ps_agama']);?></td></tr>
							<tr><td>JENIS KELAMIN</td><td>
								<?php 	if($row_pasangan['p_ps_jns_kelamin']=='L'){$jk='LAKI-LAKI';}
										else if($row_pasangan['p_ps_jns_kelamin']=='P'){$jk='PEREMPUAN';}
										else {$jk='-';}
										echo $jk;
								?>
							</td></tr>
                        </tbody>
                    </table>
                </div>
				<?php 
				if ($data_ayah == NULL)
				{
					$row_ayah['p_ay_nama'] = '-';
					$row_ayah['p_ay_tmpt_lahir'] = '-';
					$row_ayah['p_ay_alamat'] = '-';
					$row_ayah['p_ay_pekerjaan'] = '-';
					$ay_tgl_lahir = '-';
					$ay_tgl_meninggal = '-';
				}else{
					foreach($data_ayah as $row_ayah) :
					{
						$datestring = "%d-%m-%Y" ;
						if ($row_ayah['p_ay_tgl_lahir'] == '0000-00-00'){$ay_tgl_lahir="-";} 
						else {$ay_tgl_lahir = mdate($datestring,strtotime($row_ayah['p_ay_tgl_lahir']));}
						if ($row_ayah['p_ay_tgl_meninggal'] == '0000-00-00'){$ay_tgl_meninggal="-";} 
						else {$ay_tgl_meninggal = mdate($datestring,strtotime($row_ayah['p_ay_tgl_meninggal']));}
					} endforeach;}
					
				if ($data_ibu == NULL)
				{
					$row_ibu['p_ibu_nama'] = '-';
					$row_ibu['p_ibu_tmpt_lahir'] = '-';
					$row_ibu['p_ibu_alamat'] = '-';
					$row_ibu['p_ibu_pekerjaan'] = '-';
					$ibu_tgl_lahir = '-';
					$ibu_tgl_meninggal = '-';
				} else {
					foreach($data_ibu as $row_ibu) :
					{
						$datestring = "%d-%m-%Y" ;
						if ($row_ibu['p_ibu_tgl_lahir'] == '0000-00-00'){$ibu_tgl_lahir="-";} 
						else {$ibu_tgl_lahir = mdate($datestring,strtotime($row_ibu['p_ibu_tgl_lahir']));}
						if ($row_ibu['p_ibu_tgl_meninggal'] == '0000-00-00'){$ibu_tgl_meninggal="-";} 
						else {$ibu_tgl_meninggal = mdate($datestring,strtotime($row_ibu['p_ibu_tgl_meninggal']));}
						
					} endforeach;}?>
                <div class="clear"></div>
				<div id="tab5" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <tfoot>
							<tr><td colspan=8><p align="right"><?php if ($status !== 'Outsource')
							{ echo anchor('pekerja/edit_ortu_pegawai/'.$row_pegawai['peg_nipp'],'[edit]'); }?></p></td></tr>
						</tfoot>
                        <tbody>
                            <tr><td width="30%">NAMA AYAH</td><td><?php echo strtoupper($row_ayah['p_ay_nama']); ?></td></tr>
                            <tr><td>TEMPAT / TANGGAL LAHIR</td><td><?php echo strtoupper($row_ayah['p_ay_tmpt_lahir']).' / '.$ay_tgl_lahir; ?></td></tr>
							<tr><td>TANGGAL MENINGGAL</td><td><?php echo $ay_tgl_meninggal; ?></td></tr>
							<tr><td>ALAMAT</td><td><?php echo strtoupper($row_ayah['p_ay_alamat']); ?></td></tr>
							<tr><td>PEKERJAAN</td><td><?php echo strtoupper($row_ayah['p_ay_pekerjaan']); ?></td></tr>
							<tr><td colspan=2></td></tr>
							<tr><td width="30%">NAMA IBU</td><td><?php echo strtoupper($row_ibu['p_ibu_nama']); ?></td></tr>
                            <tr><td>TEMPAT / TANGGAL LAHIR</td><td><?php echo strtoupper($row_ibu['p_ibu_tmpt_lahir']).' / '.$ibu_tgl_lahir; ?></td></tr>
							<tr><td>TANGGAL MENINGGAL</td><td><?php echo $ibu_tgl_meninggal; ?></td></tr>
							<tr><td>ALAMAT</td><td><?php echo strtoupper($row_ibu['p_ibu_alamat']); ?></td></tr>
							<tr><td>PEKERJAAN</td><td><?php echo strtoupper($row_ibu['p_ibu_pekerjaan']); ?></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="clear"></div>
				<div id="tab6" class="tab_content np">
				<?php if ($data_mert_ayah == NULL)
				{
					$row_m_ayah['p_may_nama'] = '-';
					$row_m_ayah['p_may_tmpt_lahir'] = '-';
					$row_m_ayah['p_may_alamat'] = '-';
					$row_m_ayah['p_may_pekerjaan'] = '-';
					$m_ay_tgl_lahir = '-';
					$m_ay_tgl_meninggal = '-';
				}else{
				foreach($data_mert_ayah as $row_m_ayah) :
				{
					$datestring = "%d-%m-%Y" ;
					if ($row_m_ayah['p_may_tgl_lahir'] == '0000-00-00'){$m_ay_tgl_lahir="-";} 
					else {$m_ay_tgl_lahir = mdate($datestring,strtotime($row_m_ayah['p_may_tgl_lahir']));}
					if ($row_m_ayah['p_may_tgl_meninggal'] == '0000-00-00'){$m_ay_tgl_meninggal="-";} 
					else {$m_ay_tgl_meninggal = mdate($datestring,strtotime($row_m_ayah['p_may_tgl_meninggal']));}
					
				} endforeach;}
				if ($data_mert_ibu == NULL)
				{
					$row_m_ibu['p_mib_nama'] = '-';
					$row_m_ibu['p_mib_tmpt_lahir'] = '-';
					$row_m_ibu['p_mib_alamat'] = '-';
					$row_m_ibu['p_mib_pekerjaan'] = '-';
					$m_ibu_tgl_lahir = '-';
					$m_ibu_tgl_meninggal = '-';
				} else {
				foreach($data_mert_ibu as $row_m_ibu) :
				{
					$datestring = "%d-%m-%Y" ;
					if ($row_m_ibu['p_mib_tgl_lahir'] == '0000-00-00'){$m_ibu_tgl_lahir="-";} 
					else {$m_ibu_tgl_lahir = mdate($datestring,strtotime($row_m_ibu['p_mib_tgl_lahir']));}
					if ($row_m_ibu['p_mib_tgl_meninggal'] == '0000-00-00'){$m_ibu_tgl_meninggal="-";} 
					else {$m_ibu_tgl_meninggal = mdate($datestring,strtotime($row_m_ibu['p_mib_tgl_meninggal']));}
					
					//$m_ibu_tgl_lahir = mdate($datestring,strtotime($row_m_ibu['p_mib_tgl_lahir']));
				} endforeach;}?>
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <tfoot>
							<tr><td colspan=8><p align="right"><?php if ($status !== 'Outsource')
							{
								if($data_mert_ayah == NULL){ echo anchor('pekerja/add_pegawai_mertua/'.$row_pegawai['peg_nipp'],'[add]');}
								else{ echo anchor('pekerja/edit_mertua_pegawai/'.$row_pegawai['peg_nipp'],'[edit]');}
							}?></p></td></tr>
						</tfoot>
                        <tbody>
                            <tr><td width="30%">NAMA AYAH MERTUA</td><td><?php echo $row_m_ayah['p_may_nama']; ?></td></tr>
                            <tr><td>TEMPAT / TANGGAL LAHIR</td><td><?php echo $row_m_ayah['p_may_tmpt_lahir'].' / '.$m_ay_tgl_lahir; ?></td></tr>
							<tr><td>TANGGAL MENINGGAL</td><td><?php echo $m_ay_tgl_meninggal; ?></td></tr>
							<tr><td>ALAMAT</td><td><?php echo $row_m_ayah['p_may_alamat']; ?></td></tr>
							<tr><td>PEKERJAAN</td><td><?php echo $row_m_ayah['p_may_pekerjaan']; ?></td></tr>
							<tr><td colspan=2></td></tr>
							<tr><td width="30%">NAMA IBU MERTUA</td><td><?php echo strtoupper($row_m_ibu['p_mib_nama']); ?></td></tr>
                            <tr><td>TEMPAT / TANGGAL LAHIR</td><td><?php echo strtoupper($row_m_ibu['p_mib_tmpt_lahir']).' / '.$m_ibu_tgl_lahir; ?></td></tr>
							<tr><td>TANGGAL MENINGGAL</td><td><?php echo strtoupper($m_ibu_tgl_meninggal); ?></td></tr>
							<tr><td>ALAMAT</td><td><?php echo strtoupper($row_m_ibu['p_mib_alamat']); ?></td></tr>
							<tr><td>PEKERJAAN</td><td><?php echo strtoupper($row_m_ibu['p_mib_pekerjaan']); ?></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="clear"></div>
				 <div id="tab7" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <thead>
							<tr>
								<td>JABATAN</td>
								<td>UNIT KERJA</td>
								<td>SURAT KEPUTUSAN</td>
								<td>TMT</td>
								<td>KETERANGAN</td>
								<td>ACTION</td>
							</tr>
						</thead>
						<tfoot><tr><td colspan="6" align="right"><?php echo anchor('pekerja/add_riwayat_jabatan/'.$row_pegawai['peg_nipp'],'[add]');?></td></tr></tfoot>
						<tbody>
								<?php foreach($data_riwayat_jabatan as $rj){ ?>
									<tr>
										<td><?php echo $rj['p_jbt_jabatan'];?></td>
										<td><?php echo $rj['p_jbt_unit'];?></td>
										<td>
											<?php if ($rj['p_jbt_skfile'] !== ""){
													echo anchor("pekerja/view_skjabatanfile/".$rj['p_jbt_skfile'],$rj['p_jbt_skno']," target ='_blank' ");	
												} else {
													echo $rj['p_jbt_skno'];
												}
											?>	
										</td>
										<td><?php echo mdate('%d-%m-%Y',strtotime($rj['p_jbt_tmt_start']));?></td>
										<td><?php echo $rj['p_jbt_keterangan'];?></td>
										<td><?php 
											echo anchor("pekerja/edit_riwayat_jabatan/$rj[id_peg_jabatan]", img(array('src'=>"images/icons/control/16/edit.png", 'alt'=>'Edit Riwayat Jabatan', 'title'=>'Edit Riwayat Jabatan')));
											echo '&nbsp';	
											echo anchor("pekerja/delete_riwayat_jabatan/$rj[id_peg_jabatan]/".$row_pegawai['peg_nipp'], img(array('src'=>"images/icons/control/16/busy.png", 'alt'=>'Delete Riwayat Jabatan', 'title'=>'Delete Riwayat Jabatan')));
											?>
										</td>
									</tr>
								<?php } ?>
                        </tbody>
                    </table>
                </div>
				<div class="clear"></div>
				<div id="tab8" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
						<tfoot>
							<tr><td colspan=8><p align="right"><?php if ($status !== 'Outsource')
							{	echo anchor('pekerja/add_anak_pegawai/'.$row_pegawai['peg_nipp'],'[add]  ');
								echo anchor('pekerja/edit_anak_pegawai/'.$row_pegawai['peg_nipp'],'[edit]');
							}?></p></td></tr>
						</tfoot>
                        <tbody>
							<?php 
							$number = 1;
							$datestring = "%d-%m-%Y" ;
							foreach ($data_anak as $row_anak) :
							{ 
							if($row_anak['peg_ank_tgl_lahir']=='0000-00-00'){$tgl_lahir_anak="00-00-0000";}
							else { $tgl_lahir_anak = mdate($datestring,strtotime($row_anak['peg_ank_tgl_lahir']));}
							?>
                            <tr><td width="5%" rowspan=7><?php echo $number ?></td><td width="25%">NAMA</td><td><?php echo strtoupper($row_anak['peg_ank_nama']); ?></td></tr>
                            <tr><td>TEMPAT / TANGGAL LAHIR</td><td><?php echo strtoupper($row_anak['peg_ank_tempat_lahir']).' / '.$tgl_lahir_anak; ?></td></tr>
							<tr><td>PENDIDIKAN</td><td><?php echo strtoupper($row_anak['peg_ank_pendidikan']); ?></td></tr>
							<tr><td>JENIS KELAMIN</td><td><?php 
										if($row_anak['peg_ank_jns_kelamin']=='L'){$jk='Laki-Laki';}
										else if($row_anak['peg_ank_jns_kelamin']=='P'){$jk='Perempuan';}
										else {$jk='-';}
										echo strtoupper($jk);
									?></td></tr>
							<tr><td>AGAMA</td><td><?php echo strtoupper($row_anak['peg_ank_agama']); ?></td></tr>
							<tr><td>STATUS</td><td><?php echo strtoupper($row_anak['peg_ank_status']); ?></td></tr>
							<tr><td colspan="2"><?php echo anchor('pekerja/delete_data_anak/'.$row_anak['id_peg_anak'].'/'.$row_pegawai['peg_nipp'],'[delete]'); ?></td></tr>
							<tr><td colspan="3"></td></tr>
							<?php 
							$number++;
							} endforeach;
							?>
                        </tbody>
                    </table>
                </div>
				<div class="clear"></div>
				<div id="tab9" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <thead>
							<tr>
								<td>GOLONGAN</td>
								<td>TMT</td>
								<td>SURAT KEPUTUSAN</td>
								<td>KETERANGAN</td>
								<td>ACTION</td>
							</tr>
						</thead>
						<tfoot><tr><td colspan="5" align="right" ><?php echo anchor('pekerja/add_riwayat_golongan/'.$row_pegawai['peg_nipp'],'[add]');?></td></tr></tfoot>
						<tbody>
								<?php foreach($data_riwayat_golongan as $rg){ ?>
									<tr>
										<td><?php echo strtoupper($rg['p_grd_grade']);?></td>
										<td><?php if($rg['p_grd_tmt'] == "0000-00-00"){echo "-";}else{echo mdate('%d-%m-%Y',strtotime($rg['p_grd_tmt']));}?></td>
										<td>
											<?php 
												if ($rg['p_grd_skfile'] !== ""){
													echo anchor("pekerja/view_skgolonganfile/".$rg['p_grd_skfile'],$rg['p_grd_skno']," target ='_blank' ");	
												} else {
													echo $rg['p_grd_skno'];
												}
											?>	
										</td>
										<td><?php echo strtoupper($rg['p_grd_keterangan']);?></td>
										<td><?php 
											echo anchor("pekerja/edit_riwayat_golongan/$rg[id_peg_grade]", img(array('src'=>"images/icons/control/16/edit.png", 'alt'=>'Edit Riwayat Golongan', 'title'=>'Edit Riwayat Golongan')));
											echo '&nbsp';	
											echo anchor("pekerja/delete_riwayat_golongan/$rg[id_peg_grade]/".$row_pegawai['peg_nipp'], img(array('src'=>"images/icons/control/16/busy.png", 'alt'=>'Delete Riwayat Golongan', 'title'=>'Delete Riwayat Golongan')));
											?>
										</td>
									</tr>
								<?php } ?>
                        </tbody>
                    </table>
                </div>
				<div class="clear"></div>
				<div id="tab10" class="tab_content np">
                    <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                        <thead>
							<tr>
								<td rowspan="2">JENIS SANKSI</td>
								<td rowspan="2">NO SURAT</td>
								<td colspan="2">MASA SANKSI</td>
								<td rowspan="2">KETERANGAN</td>
								<td rowspan="2">ACTION</td>
							</tr>
							<tr>
								<td>DARI</td>
								<td>SAMPAI</td>
							</tr>
						</thead>
						<tfoot><tr><td colspan="6" align="right"><?php echo anchor('pekerja/add_riwayat_sanksi/'.$row_pegawai['peg_nipp'],'[add]');?></td></tr></tfoot>
						<tbody>
								<?php foreach($data_riwayat_sanksi as $rs){ ?>
									<tr>
										<td><?php echo $rs['p_snk_jenis'];?></td>
										<td>
											<?php if ($rs['p_snk_file'] !== ""){
													echo anchor("pekerja/view_sksanksifile/".$rs['p_snk_file'],$rs['p_snk_no']," target ='_blank' ");	
												} else {
													echo $rs['p_snk_no'];
												}
											?>	
										</td>
										<td><?php if($rs['p_snk_start'] == "0000-00-00"){echo "-";}else{ echo mdate('%d-%m-%Y',strtotime($rs['p_snk_start']));}?></td>
										<td><?php if($rs['p_snk_end'] == "0000-00-00"){echo "-";}else{ echo mdate('%d-%m-%Y',strtotime($rs['p_snk_end']));}?></td>
										<td><?php echo strtoupper($rs['p_snk_keterangan']);?></td>
										<td><?php 
											echo anchor("pekerja/edit_riwayat_sanksi/$rs[id_peg_sanksi]", img(array('src'=>"images/icons/control/16/edit.png", 'alt'=>'Edit Riwayat Sanksi', 'title'=>'Edit Riwayat Sanksi')));
											echo '&nbsp';	
											echo anchor("pekerja/delete_riwayat_sanksi/$rs[id_peg_sanksi]/".$row_pegawai['peg_nipp'], img(array('src'=>"images/icons/control/16/busy.png", 'alt'=>'Delete Riwayat Sanksi', 'title'=>'Delete Riwayat Sanksi')));
											?>
										</td>
									</tr>
								<?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="clear"></div>
				
            </div>	
			<?php 
					foreach ($pegawai as $row_pegawai){}; 
					$nipp=$row_pegawai['peg_nipp'];
					$attr=" target='_blank' title='Export to Word' ";
					$print = anchor('pekerja/export_detail_pegawai_word/'.$nipp,' [Word] ',$attr);
					echo $print;
					echo " ";
					$attrpdf=" title='Export to PDF' alt='Export to PDF' ";
					echo anchor('pekerja/print_detail_pegawai_pdf/'.$nipp,' [PDF] ',$attrpdf);
					
				?> 
        </div>
</div>