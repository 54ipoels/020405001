<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Anak Pegawai</h6></div>
			<?php 
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/edit_data_anak/'.$this->uri->segment(3), $attributes); ?>
			<fieldset class="step" id="w2first">
                    <h1>Edit Data Anak</h1>
			<?php
			$number = 1;
			$datestring = "%d/%m/%Y" ;
			foreach ($anak as $row_anak) : 
			{ 
				echo form_hidden('id_anak_'.$number, $row_anak['id_peg_anak']);?>
                    <div class="formRow">
                        <label>Nama:</label>
                        <div class="formRight"><?php 
						$nama = array(
							'name' => 'nama_'.$number,
							'id'   => 'nama_'.$number,
							'value'=> $row_anak['peg_ank_nama']
						);
						echo form_input($nama) ?><br/>
						<?php echo form_error('nama')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Tempat Lahir:</label>
                        <div class="formRight"><?php 
						$tempat = array(
							'name' => 'tempat_'.$number,
							'id'   => 'tempat_'.$number,
							'value'=> $row_anak['peg_ank_tempat_lahir']
						);
						echo form_input($tempat) ?><br/>
						<?php echo form_error('tempat')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Lahir:</label>
                        <div class="formRight"><?php 
						if($row_anak['peg_ank_tgl_lahir'] == "0000-00-00"){$tgl_lhr='00-00-0000';}
						else{$tgl_lhr = mdate($datestring,strtotime($row_anak['peg_ank_tgl_lahir']));}
						$tanggal = array(
							'name' => 'tanggal_'.$number,
							'id'   => 'tanggal_'.$number,
							'value'=> $tgl_lhr,
							'class'=> 'maskDate'
						);
						echo form_input($tanggal) ?><span class="formNote">Format Date : dd/mm/yyyy</span>
						<?php echo form_error('tanggal')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pendidikan:</label>
                        <div class="formRight"><?php 
						$pendidikan = array(
							'name' => 'pendidikan_'.$number,
							'id'   => 'pendidikan_'.$number,
							'value'=> $row_anak['peg_ank_pendidikan']
						);
						echo form_input($pendidikan) ?><br/>
						<?php echo form_error('pendidikan')?></div>
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
						echo form_dropdown('agama_'.$number,$agama,$row_anak['peg_ank_agama']) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Jenis Kelamin:</label>
                        <div class="formRight"><?php 
						$jns_klm = array(
							'L' => 'Laki-Laki',
							'P' => 'Perempuan',
						);
						echo form_dropdown('jns_klm_'.$number,$jns_klm,$row_anak['peg_ank_jns_kelamin']) ?><br/>
						<?php echo form_error('jns_klm')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Status Anak:</label>
                        <div class="formRight"><?php 
						$stk = array(
							'TK' => 'TK',
							'K'	 =>	'K',
							'K1' => 'K1',
							'K2' => 'K2',
							'K3' => 'K3',
							'K4' => 'K4',
							'K5' => 'K5'
						);
						echo form_dropdown('status_'.$number,$stk,$row_anak['peg_ank_status']) ?><br/>
						<?php echo form_error('status')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                         
                    </div>
                </fieldset>
			<?php 
			$number++;
			} endforeach;
			echo form_hidden('jumlah', $number-1);
			?>
                
				<div class="wizButtons"> 
                    <div class="status" id="status2"></div>
					<span class="wNavButtons">
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