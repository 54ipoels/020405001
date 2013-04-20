<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Pribadi Pegawai</h6></div>
			<?php 
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/submit_data_diri', $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1>Step 1 Part 1 - Data Diri</h1>
                    <div class="formRow">
                        <label>NIPP:<span class="req">*</span></label>
                        <div class="formRight">
						<?php 
						$nipp = array(
							'name' => 'nipp',
							'id'   => 'nipp',
						);
						echo form_input($nipp) ?><br/>
						<?php echo form_error('nipp')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Nama:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$nama = array(
							'name' => 'nama',
							'id'   => 'nama',
						);
						echo form_input($nama) ?><br/>
						<?php echo form_error('nama')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Tempat Lahir:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$tempat = array(
							'name' => 'tempat',
							'id'   => 'tempat',
						);
						echo form_input($tempat) ?><br/>
						<?php echo form_error('tempat')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Lahir:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$tanggal = array(
							'name' => 'tanggal',
							'id'   => 'tanggal',
							'class'=> 'maskDate'
						);
						echo form_input($tanggal) ?><span class="formNote">Format Date : dd/mm/yyyy</span><br/>
						<?php echo form_error('tanggal')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Jenis Kelamin:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$jns_klm = array(
							'L' => 'Laki-Laki',
							'P' => 'Perempuan',
						);
						echo form_dropdown('jns_klm',$jns_klm) ?><br/>
						<?php echo form_error('jns_klm')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Golongan Darah:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$gol_drh = array(
							'name' => 'gol_drh',
							'id'   => 'gol_drh',
						);
						echo form_input($gol_drh) ?><br/>
						<?php echo form_error('gol_drh')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Agama:</label>
                        <div class="formRight"><?php 
						$agama = array(
							'Hindu' => 'Hindu',
							'Islam' => 'Islam',
							'Protestan' => 'Kristen Protestan',
							'Katolik' => 'Kristen Katolik',
							'Budha' => 'Budha',
							'Kongfucu' => 'Kong Fu Cu'
						);
						echo form_dropdown('agama',$agama) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
					<span class="req">* Tidak Boleh Kosong</span>
					<div class="clear"></div>
					</div>
                </fieldset>
				<fieldset id="w2confirmation" class="step">
                    <h1>Step 1 Part 2 - Data Jabatan</h1>
					<div class="formRow">
                        <label>Jabatan:</label>
                        <div class="formRight searchDrop">
						<select name="jabatan" data-placeholder="Pilih Jabatan..." class="chzn-select" tabindex="1"><?php 
						foreach ($list_jabatan as $row_jabatan) :
						{ ?>
							<option value="<?php echo $row_jabatan['peg_tab_jab'];?>"><?php echo $row_jabatan['peg_tab_jab']; ?></option>
							
						<?php } endforeach; ?>
						</select></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Terhitung Mulai Tanggal:</label>
                        <div class="formRight"><?php 
						$tmt = array(
							'name' => 'tmt',
							'id'   => 'tmt',
							'class'=> 'maskDate'
						);
						echo form_input($tmt) ?><span class="formNote">Format Date : dd/mm/yyyy</span></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Unit:</label>
                        <div class="formRight"><?php 
						$unit = array();
						foreach ($list_unit as $row_unit) :
						{
							$unit[$row_unit['kode_unit']] = ($row_unit['nama_unit']);
						} endforeach; 
						echo form_dropdown('unit',$unit);?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Status Pegawai:</label>
                        <div class="formRight"><?php 
						$stp = array(
							'PKWT' => 'PKWT',
							'Outsource' => 'Outsource',
						);
						echo form_dropdown('stp',$stp) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Provider:</label>
                        <div class="formRight"><?php 
						$provider = array(
							'name' => 'provider',
							'id'   => 'provider',
						);
						echo form_input($provider) ?></div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				<fieldset id="w3confirmation" class="step">
                    <h1>Step 1 Part 3 - Data Fisik</h1>
					<div class="formRow">
                        <label>Tinggi Badan:</label>
                        <div class="formRight"><?php 
						$tinggi = array(
							'name' => 'tinggi',
							'id'   => 'tinggi',
							'style'=> 'width:40%'
						);
						echo form_input($tinggi) ?> &nbsp cm</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Berat Badan:</label>
                        <div class="formRight"><?php 
						$berat = array(
							'name' => 'berat',
							'id'   => 'berat',
							'style'=> 'width:40%'
						);
						echo form_input($berat) ?> &nbsp Kg</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Status Keluarga:</label>
                        <div class="formRight"><?php 
						$stk = array(
							'TK' => 'TK',
							'K1' => 'K1',
							'K2' => 'K2',
							'K3' => 'K3',
							'K4' => 'K4',
							'K5' => 'K5'
						);
						echo form_dropdown('stk',$stk) ?></div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
                <fieldset id="w4confirmation" class="step">
                    <h1>Step 1 Part 4 - Data Alamat</h1>
                    <div class="formRow">
                        <label>Jalan:</label>
                        <div class="formRight"><?php 
						$jalan = array(
							'name' => 'jalan',
							'id'   => 'jalan',
						);
						echo form_textarea($jalan) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Kelurahan:</label>
                        <div class="formRight"><?php 
						$kelurahan = array(
							'name' => 'kelurahan',
							'id'   => 'kelurahan',
						);
						echo form_input($kelurahan) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Kecamatan:</label>
                        <div class="formRight"><?php 
						$kecamatan = array(
							'name' => 'kecamatan',
							'id'   => 'kecamatan',
						);
						echo form_input($kecamatan) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Kabupaten:</label>
                        <div class="formRight"><?php 
						$kabupaten = array(
							'name' => 'kabupaten',
							'id'   => 'kabupaten',
						);
						echo form_input($kabupaten) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Propinsi:</label>
                        <div class="formRight"><?php 
						$provinsi = array(
							'name' => 'provinsi',
							'id'   => 'provinsi',
						);
						echo form_input($provinsi) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>No Telp:</label>
                        <div class="formRight"><?php 
						$notelp = array(
							'name' => 'notelp',
							'id'   => 'notelp',
						);
						echo form_input($notelp) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Email:</label>
                        <div class="formRight"><?php 
						$email = array(
							'name' => 'email',
							'id'   => 'email',
						);
						echo form_input($email) ?></div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
				<fieldset id="w5confirmation" class="step">
                    <h1>Step 1 Part 5 - Pendidikan</h1>
					<div class="formRow">
						<label>Tingkat Pendidikan:</label>
                        <div class="formRight"><?php 
						$tp = array(
							'SD'  => 'Sekolah Dasar',
							'SMP' => 'Sekolah Menengah Pertama',
							'SMA' => 'Sekolah Menengan Atas',
							'D1'  => 'Diploma 1',
							'D2'  => 'Diploma 2',
							'D3'  => 'Diploma 3',
							'D4'  => 'Diploma 4',
							'S1'  => 'Strata 1',
							'S2'  => 'Strata 2',
							'S3'  => 'Strata 3'
						);
						echo form_dropdown('tgk_pdd',$tp) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Lembaga Pendidikan:</label>
                        <div class="formRight"><?php 
						$lp = array(
							'name' => 'lembaga',
							'id'   => 'lembaga',
						);
						echo form_input($lp) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tahun:</label>
                        <div class="formRight"><?php 
						$lp = array(
							'name' => 'masuk',
							'id'   => 'masuk',
							'style'=> 'width:20%'
						);
						echo form_input($lp) ?>&nbsp s/d &nbsp
						<?php 
						$lp = array(
							'name' => 'keluar',
							'id'   => 'keluar',
							'style'=> 'width:20%'
						);
						echo form_input($lp) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Bahasa yang dikuasai:</label>
                        <div class="formRight"><?php 
						$bahasa = array(
							'name' => 'bahasa',
							'id'   => 'bahasa',
						);
						echo form_input($bahasa) ?></div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				<div class="wizButtons"> 
                    <div class="status" id="status2"></div>
					<span class="wNavButtons">
                        <input class="basic" id="back2" value="Back" type="reset" />
						<?php 
						$submit = array(
							'class' => 'blueB m110',
							'id'	=> 'next2',
							'value'	=> 'Submit',
						);
						echo form_submit($submit)?>
                    </span>
				</div>
                <div class="clear"></div>
			<?php echo form_close();?>
			<div class="data" id="w2"></div>
        </div>
</div>