<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Status Pegawai</h6></div>
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/edit_data_status_pegawai/'.$this->uri->segment(3), $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1>Status Pegawai</h1>
					<?php foreach($peg_tmt as $row_tmt){ ?>
						<div class="formRow">
							<label>NIPP:</label>
							<div class="formRight">
							<input type="hidden" name="id_tmt" value="<?php echo $row_tmt['id_peg_tmt'];?>" readonly>
							<input type="text" name="nipp" value="<?php echo $row_tmt['p_tmt_nipp'];?>" readonly>
							<br/>
							<?php echo form_error('nipp')?></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label>Provider:</label>
							<div class="formRight"><input type="text" name="provider" value="<?php echo $row_tmt['p_tmt_provider'];?>"><br/>
							<?php echo form_error('nipp')?></div>
							<div class="clear"></div>
						</div>
						<div class="formRow">
							<label>Status Pegawai:</label>
							<div class="formRight"><?php 
							$status = array(
								'Tetap'	=> 'Tetap',
								'PKWT' => 'PKWT',
								'Outsource' => 'Outsource',
							);
							#$value = $row_jbt_tmt['p_tmt_status'];
							echo form_dropdown('status',$status,$row_tmt['p_tmt_status']) ?><br/>
							<?php echo form_error('status')?></div>
							<div class="clear"></div>
						</div>
						 <div class="formRow">
                        <label>Terhitung Mulai Tanggal:</label>
                        <div class="formRight"><?php 
							$tmt = array(
								'name' => 'tmt',
								'id'   => 'tmt',
								'class'=> 'maskDate',
								
							);
							echo form_input($tmt) ?><br/>
							<?php echo form_error('tmt')?></div>
							<div class="clear"></div>
						</div>
					<?php } ?>
                    
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