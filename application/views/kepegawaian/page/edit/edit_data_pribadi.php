<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Pribadi Pegawai</h6></div>
			<?php 
			foreach ($pegawai as $row_pegawai) : 
			{} endforeach;
			if ($agama == NULL)
			{
				$row_agama['p_ag_agama'] = '';
			}else{
				foreach ($agama as $row_agama) : 
				{} endforeach;
			}
			if ($fisik == NULL)
			{
				$row_fisik['p_fs_tinggi'] = '';
				$row_fisik['p_fs_berat'] = '';
			}else{
			foreach ($fisik as $row_fisik) : 
			{} endforeach;
			}
			if ($status_keluarga == NULL)
			{
				$row_stk['p_stk_status_keluarga'] = '';
			}else{
				foreach ($status_keluarga as $row_stk) : 
				{} endforeach;
			}
			if ($alamat == NULL)
			{
				$row_alamat['p_al_no_telp']='';
			}else{
				foreach ($alamat as $row_alamat) : 
				{} endforeach;
			}
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/edit_data_diri/'.$this->uri->segment(3), $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1>Step 1 Part 1 - Edit Data Diri</h1>
						<?php 
						$nipp = array(
							'name' => 'nipp',
							'id'   => 'nipp',
							'value'=> $row_pegawai['peg_nipp']
						);
						echo form_hidden($nipp) ?>
                    <div class="formRow">
                        <label>Nama:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$nama = array(
							'name' => 'nama',
							'id'   => 'nama',
							'value'=> $row_pegawai['peg_nama']
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
							'value'=> $row_pegawai['peg_tmpt_lahir']
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
							'class'=> 'maskDate',
							'value'=> mdate('%d-%m-%Y',strtotime($row_pegawai['peg_tgl_lahir'])),
						);
						
						echo form_input($tanggal) ?><br/>
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
						echo form_dropdown('jns_klm',$jns_klm,$row_pegawai['peg_jns_kelamin']) ?><br/>
						<?php echo form_error('jns_klm')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Golongan Darah:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$gol_drh = array(
							'name' => 'gol_drh',
							'id'   => 'gol_drh',
							'value'=> $row_pegawai['peg_gol_darah']
						);
						echo form_input($gol_drh) ?><br/>
						<?php echo form_error('gol_drh')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Agama:</label>
                        <div class="formRight"><?php 
						$agama = array(
							'hindu' => 'Hindu',
							'islam' => 'Islam',
							'protestan' => 'Kristen Protestan',
							'katolik' => 'Kristen Katolik',
							'budha' => 'Budha',
							'kongfucu' => 'Kong Fu Cu'
						);
						echo form_dropdown('agama',$agama,strtolower($row_agama['p_ag_agama'])) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
					<span class="req">* Tidak Boleh Kosong</span>
					<div class="clear"></div>
					</div>
                </fieldset>
				<fieldset id="w2confirmation" class="step">
                    <h1>Step 1 Part 2 - Edit Data Fisik</h1>
					<div class="formRow">
                        <label>Tinggi Badan:</label>
                        <div class="formRight"><?php 
						$tinggi = array(
							'name' => 'tinggi',
							'id'   => 'tinggi',
							'style'=> 'width:40%',
							'value'=> $row_fisik['p_fs_tinggi']
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
							'style'=> 'width:40%',
							'value'=> $row_fisik['p_fs_berat']
						);
						echo form_input($berat) ?> &nbsp Kg</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Nomor Telp:</label>
                        <div class="formRight"><?php 
						$telepon = array(
							'name' => 'no_telp',
							'id'   => 'no_telp',
							'value'=> $row_alamat['p_al_no_telp'],
						);
						echo form_input($telepon) ?> </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Status Keluarga:</label>
                        <div class="formRight"><?php 
						$stk = array(
							'TK' => 'TK',
							'K'  => 'K',
							'K1' => 'K1',
							'K2' => 'K2',
							'K3' => 'K3',
							'K4' => 'K4',
							'K5' => 'K5'
						);
						echo form_dropdown('stk',$stk,$row_stk['p_stk_status_keluarga']) ?></div>
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