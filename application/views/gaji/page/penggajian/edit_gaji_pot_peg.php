<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Edit Gaji Pegawai</h6></div>
			<?php
			foreach($showdata as $sd){}
			foreach($pot_pegawai as $pp){}
			$attributes = array('class'=>'form');
			echo form_open('gaji/submit_edit_pot_pegawai/'.$pp['id_pot_gaji_pegawai'], $attributes);
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
							echo $bulan.' '. $sd['pgj_tahun'];
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
                        <label>SIPERKASA:<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$siperkasa = array(
									'name'  => 'siperkasa', 
									'id'    => 'siperkasa', 
									);
								echo form_input($siperkasa,$pp['pot_peg_siperkasa']) ?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>KOKARGA:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$kokarga = array(
									'name'  => 'kokarga', 
									'id'    => 'kokarga', 
									);
								echo form_input($kokarga,$pp['pot_peg_kokarga']) ?>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>KOSIGARDEN:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$kosigarden = array(
									'name'  => 'kosigarden', 
									'id'    => 'kosigarden', 
									);
								echo form_input($kosigarden,$pp['pot_peg_kosigarden']) ?>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>FLEXY:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$flexy = array(
									'name'  => 'flexy', 
									'id'    => 'flexy', 
									);
								echo form_input($flexy,$pp['pot_peg_flexy']) ?>
                            </div>
                        <div class="clear"></div>
                    </div><div class="formRow">
                        <label>GGC:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$ggc = array(
									'name'  => 'ggc', 
									'id'    => 'ggc', 
									);
								echo form_input($ggc,$pp['pot_peg_ggc']) ?>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>JHT:<span class="req"></span></label>
                        <div class="formRight">
							 <?php 
								$jht = array(
									'name'  => 'jht', 
									'id'    => 'jht', 
									);
								echo form_input($jht,$pp['pot_peg_jht']) ?>
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
								echo form_input($tht,$pp['pot_peg_tht']) ?>
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
								echo form_input($pensiun,$pp['pot_peg_pensiun']) ?>
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
								echo form_input($other,$pp['pot_peg_other']) ?>
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