<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" />
            <h6>Input Data Hari Libur</h6></div>
			<?php 
			$attributes = array('class'=>'form');
			echo form_open('c_absensi/submit_gaji', $attributes);
			?>
                <fieldset class="step" id="w1first">
                    <div class="formRow">
                        <label>Grade :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$grade=array(
									"name" 	=> "grade",
									"id"	=> "grade",
								); 
								echo form_input($grade)."<br>";
								echo form_error('grade');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Minimal :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$min=array(
									"name" 	=> "min",
									"id"	=> "min",
								); 
								echo form_input($min)."<br>";
								echo form_error('min');
							?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Maksimal :<span class="req">*</span></label>
                        <div class="formRight">
							<?php 
								$max=array(
									"name" 	=> "max",
									"id"	=> "max",
								); 
								echo form_input($max)."<br>";
								echo form_error('max');
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