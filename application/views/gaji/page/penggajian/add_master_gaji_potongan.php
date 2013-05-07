<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" />
            <h6>Input Data Master Potongan Gaji</h6></div>
			<?php 
			$attributes = array('class'=>'form');
			echo form_open('gaji/submit_master_gaji_potongan', $attributes);
			?>
                <fieldset class="step" id="w1first">
                    <div class="formRow">
                        <label>Pot Pegawai Siperkasa :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$peg_siperkasa=array(
									"name" 	=> "peg_siperkasa",
									"id"	=> "peg_siperkasa",
								); 
								echo form_input($peg_siperkasa)."<br>";
								echo form_error('peg_siperkasa');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pot Pegawai JHT :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$peg_jht = array(
									"name" 	=> "peg_jht",
									"id"	=> "peg_jht",
								); 
								echo form_input($peg_jht)."<br>";
								echo form_error('peg_jht');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pot Pegawai THT :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$peg_tht = array(
									"name" 	=> "peg_tht",
									"id"	=> "peg_tht",
								); 
								echo form_input($peg_tht)."<br>";
								echo form_error('peg_tht');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pot Pegawai Pensiun :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$peg_pensiun = array(
									"name" 	=> "peg_pensiun",
									"id"	=> "peg_pensiun",
								); 
								echo form_input($peg_pensiun)."<br>";
								echo form_error('peg_pensiun');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pot Perusahaan Pensiun :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$per_pensiun = array(
									"name" 	=> "per_pensiun",
									"id"	=> "per_pensiun",
								); 
								echo form_input($per_pensiun)."<br>";
								echo form_error('per_pensiun');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pot Perusahaan THT :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$per_tht = array(
									"name" 	=> "per_tht",
									"id"	=> "per_tht",
								); 
								echo form_input($per_tht)."<br>";
								echo form_error('per_tht');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pot Perusahaan JHT :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$per_jht = array(
									"name" 	=> "per_jht",
									"id"	=> "per_jht",
								); 
								echo form_input($per_jht)."<br>";
								echo form_error('per_jht');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pot Perusahaan JK :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$per_jk = array(
									"name" 	=> "per_jk",
									"id"	=> "per_jk",
								); 
								echo form_input($per_jk)."<br>";
								echo form_error('per_jk');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pot Perusahaan JKK :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$per_jkk = array(
									"name" 	=> "per_jkk",
									"id"	=> "per_jkk",
								); 
								echo form_input($per_jkk)."<br>";
								echo form_error('per_jkk');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pot Perusahaan As Jiwa :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$per_as_jiwa = array(
									"name" 	=> "per_as_jiwa",
									"id"	=> "per_as_jiwa",
								); 
								echo form_input($per_as_jiwa)."<br>";
								echo form_error('per_as_jiwa');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					
                </fieldset>
				<div class="wizButtons"> 
                    <div class="status" id="status1"></div>
					<span class="wNavButtons">
                        <input class="basic" id="back2" value="RESET" type="reset" />
						<?php 
						$submit = array(
							'class' => 'blueB m110',
							'name' => 'submit_gaji_add',
							'value'	=> 'SIMPAN',
						);
						echo form_submit($submit)?>
                    </span>
				</div>
                <div class="clear"></div>
			<?php echo form_close();?>
        </div>
</div>