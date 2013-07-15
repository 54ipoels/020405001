<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Input Master Lembur</h6></div>
			<?php
			//$this->load->view('asset/v_asset');
			$attributes = array('class'=>'form');
			echo form_open('gaji/submit_master_lembur', $attributes);
			?>
                <fieldset class="step" id="w2first">
                    <div class="formRow">
                        <label>Grade:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
								$grade = array(
									'name'  => 'grade', 
									'id'    => 'grade', 
									);
								echo form_input($grade) ;
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Uang Makan:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
								$makan = array(
									'name'  => 'makan', 
									'id'    => 'makan', 
									);
								echo form_input($makan) ;
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Uang Transport:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
								$transport = array(
									'name'  => 'transport', 
									'id'    => 'transport', 
									);
								echo form_input($transport) ;
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Uang Ex Voed:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
								$exvoed = array(
									'name'  => 'exvoed', 
									'id'    => 'exvoed', 
									);
								echo form_input($exvoed) ;
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Hari Kerja:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
								$harikerja = array(
									'name'  => 'harikerja', 
									'id'    => 'harikerja', 
									);
								echo form_input($harikerja) ;
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Hari Libur:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
								$harilibur = array(
									'name'  => 'harilibur', 
									'id'    => 'harilibur', 
									);
								echo form_input($harilibur) ;
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Shift Al:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
								$shift = array(
									'name'  => 'shift', 
									'id'    => 'shift', 
									);
								echo form_input($shift) ;
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tunj Supervisor:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
								$tunj_spv = array(
									'name'  => 'tunj_spv', 
									'id'    => 'tunj_spv', 
									);
								echo form_input($tunj_spv) ;
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Natura:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
								$natura = array(
									'name'  => 'natura', 
									'id'    => 'natura', 
									);
								echo form_input($natura) ;
							?>
						</div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				<div class="wizButtons"> 
                    <div class="status" id="status2"></div>
					<span class="wNavButtons">
                        <input class="basic" id="back2" value="RESET" type="reset" />
						<?php 
						$submit = array(
							'class' => 'blueB m110',
							'name' => 'submit_master_lembur_add',
							'value'	=> 'SIMPAN',
						);
						echo form_submit($submit)?>
                    </span>
				</div>
                <div class="clear"></div>
			<?php echo form_close();?>
        </div>
</div>