<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Edit Gaji Pegawai</h6></div>
			<?php
			foreach($showdata as $sd){}
			foreach($pot_perusahaan as $pr){}
			$attributes = array('class'=>'form');
			echo form_open('gaji/submit_edit_pot_perusahaan/'.$pr['id_pot_gaji_perusahaan'], $attributes);
			echo form_hidden('id_pgj', $sd['id_pgj']);
			
			?>
                <fieldset class="step" id="w2first">
                    <div class="formRow">
                        <label>NIPP:<span class="req">*</span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								echo form_hidden('id_peg', $this->uri->segment(6)); 
								echo $sd['peg_nipp']; ?><br/>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>BULAN:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
							echo form_hidden('month', $this->uri->segment(4));
							echo form_hidden('year',$this->uri->segment(5));
							echo $bulan.' '.$this->uri->segment(5);
							?>
                        </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>GAJI BRUTO:<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                              <?php echo '<b>'.$sd['pgj_gaji_bruto'].'</b>' ?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>ASURANSI JIWA:<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$as_jiwa = array(
									'name'  => 'as_jiwa', 
									'id'    => 'as_jiwa', 
									);
								echo form_input($as_jiwa,$pr['pot_per_as_jiwa']) ?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>JK:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$jk = array(
									'name'  => 'jk', 
									'id'    => 'jk', 
									);
								echo form_input($jk,$pr['pot_per_jk']) ?>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>JKK:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$jkk = array(
									'name'  => 'jkk', 
									'id'    => 'jkk', 
									);
								echo form_input($jkk,$pr['pot_per_jkk']) ?>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>SIHARTA:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$siharta = array(
									'name'  => 'siharta', 
									'id'    => 'siharta', 
									);
								echo form_input($siharta,$pr['pot_per_siharta']) ?>
                            </div>
                        <div class="clear"></div>
                    </div><div class="formRow">
                        <label>JHT:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$jht = array(
									'name'  => 'jht', 
									'id'    => 'jht', 
									);
								echo form_input($jht,$pr['pot_per_jht']) ?>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>THT:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$jht = array(
									'name'  => 'tht', 
									'id'    => 'tht', 
									);
								echo form_input($jht,$pr['pot_per_tht']) ?>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>THT:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$tht = array(
									'name'  => 'tht', 
									'id'    => 'tht', 
									);
								echo form_input($tht,$pr['pot_per_tht']) ?>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>PENSIUN:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$pensiun = array(
									'name'  => 'pensiun', 
									'id'    => 'pensiun', 
									);
								echo form_input($pensiun,$pr['pot_per_pensiun']) ?>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>OTHER:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$other = array(
									'name'  => 'other', 
									'id'    => 'other', 
									);
								echo form_input($other,$pr['pot_per_other']) ?>
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
							'name' => 'submit_penggajian_edit',
							'value'	=> 'SIMPAN',
						);
						echo form_submit($submit)?>
                    </span>
				</div>
                <div class="clear"></div>
			<?php echo form_close();?>
        </div>
</div>