<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Pribadi Pegawai</h6></div>
			<?php 
			foreach ($alamat as $row_alamat) : 
			{} endforeach;
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/edit_data_alamat/'.$this->uri->segment(3), $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1>Edit Data Alamat</h1>
                    <div class="formRow">
                        <label>Jalan:</label>
                        <div class="formRight"><?php 
						$jalan = array(
							'name' => 'jalan',
							'id'   => 'jalan',
							'value'=> $row_alamat['p_al_jalan']
						);
						echo form_input($jalan) ?><br/>
						<?php echo form_error('jalan')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Kelurahan:</label>
                        <div class="formRight"><?php 
						$kelurahan = array(
							'name' => 'kelurahan',
							'id'   => 'kelurahan',
							'value'=> $row_alamat['p_al_kelurahan']
						);
						echo form_input($kelurahan) ?><br/>
						<?php echo form_error('kelurahan')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Kecamatan:</label>
                        <div class="formRight"><?php 
						$kecamatan = array(
							'name' => 'kecamatan',
							'id'   => 'kecamatan',
							'value'=> $row_alamat['p_al_kecamatan']
						);
						echo form_input($kecamatan) ?><br/>
						<?php echo form_error('kecamatan')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Kabupaten:</label>
                        <div class="formRight"><?php 
						$kabupaten = array(
							'name' => 'kabupaten',
							'id'   => 'kabupaten',
							'value'=> $row_alamat['p_al_kabupaten']
						);
						echo form_input($kabupaten) ?><br/>
						<?php echo form_error('kabupaten')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Provinsi:</label>
                        <div class="formRight"><?php 
						$provinsi = array(
							'name' => 'provinsi',
							'id'   => 'provinsi',
							'value'=> $row_alamat['p_al_provinsi']
						);
						echo form_input($provinsi) ?><br/>
						<?php echo form_error('provinsi')?></div>
                        <div class="clear"></div>
                    </div>
                	<div class="formRow">
                        <label>Email:</label>
                        <div class="formRight"><?php 
						$email = array(
							'name' => 'email',
							'id'   => 'email',
							'value'=> $row_alamat['p_al_email']
						);
						echo form_input($email) ?><br/>
						<?php echo form_error('email')?></div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
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