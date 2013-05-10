<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Edit Gaji Pegawai</h6></div>
			<?php
			foreach($showdata as $sd){}
			$attributes = array('class'=>'form');
			echo form_open('gaji/submit_edit_penggajian/'.$sd['id_pgj'], $attributes);
			echo form_hidden('id_pgj', $sd['id_pgj']);
			
			?>
                <fieldset class="step" id="w2first">
                    <div class="formRow">
                        <label>NIPP:<span class="req">*</span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								echo form_hidden('id_peg', $sd['id_pgj']); 
								echo form_hidden('year', $this->uri->segment(5)); 
								echo $sd['peg_nipp']; ?><br/>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>BULAN:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
							echo form_hidden('month',$sd['pgj_bulan']);
							//echo form_hidden('year',$sd['pgj_tahun']);
							//echo $bulan.' '. $sd['pgj_tahun'];
							echo $bulan.' '.$this->uri->segment(5);
							?>
                        </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>GAJI BRUTO:<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$gb = array(
									'name'  => 'gaji_bruto', 
									'id'    => 'gaji_bruto', 
									);
								echo form_input($gb,$sd['pgj_gaji_bruto']) ?><br/>
							<?php echo form_error('gaji_bruto')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>INSENTIVE:<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$insentive = array(
									'name'  => 'insentive', 
									'id'    => 'insentive', 
									);
								echo form_input($insentive,$sd['pgj_insentive']) ?><br/>
							<?php echo form_error('insentive')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>KOREKSI:<span class="req"></span></label>
                        <div class="formRight">
							
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>POT. PEGAWAI:<span class="req"></span></label>
                        <div class="formRight">
							<?php 
							if ($pot_pegawai == NULL)
							{
								$jum_pot_pegawai = 0;
							} else {
								foreach ($pot_pegawai as $pot_peg){	
								$jum_pot_pegawai = $pot_peg['pot_peg_siperkasa'] + $pot_peg['pot_peg_kokarga'] + $pot_peg['pot_peg_kosigarden'] + $pot_peg['pot_peg_flexy'] + $pot_peg['pot_peg_other'] + $pot_peg['pot_peg_ggc'] + $pot_peg['pot_peg_jht'] + $pot_peg['pot_peg_tht'] + $pot_peg['pot_peg_pensiun'];}
							}
							echo anchor('gaji/edit_pot_pegawai/'.$sd['pgj_id_peg'].'/'.$sd['pgj_bulan'].'/'.$sd['pgj_tahun'].'/'.$sd['id_pgj'], $jum_pot_pegawai);?>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>POT. PERUSAHAAN:<span class="req"></span></label>
                        <div class="formRight">
							<?php
							if ($pot_perusahaan == NULL)
							{
								$jum_pot_perusahaan = 0;
							} else {
								foreach ($pot_perusahaan as $pot_per){	}
								$jum_pot_perusahaan = $pot_per['pot_per_as_jiwa'] + $pot_per['pot_per_jk'] + $pot_per['pot_per_siharta'] + $pot_per['pot_per_other'] + $pot_per['pot_per_jht'] + $pot_per['pot_per_tht'] + $pot_per['pot_per_pensiun'];
							}
							echo anchor('gaji/edit_pot_perusahaan/'.$sd['pgj_id_peg'].'/'.$sd['pgj_bulan'].'/'.$sd['pgj_tahun'].'/'.$sd['id_pgj'], $jum_pot_perusahaan);?>
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