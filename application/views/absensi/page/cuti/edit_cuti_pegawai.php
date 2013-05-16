<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Edit Cuti Pegawai</h6></div>
			<?php
			foreach ($cuti as $rc){}
			$this->load->view('asset/v_asset');
			$attributes = array('class'=>'form');
			echo form_open('c_absensi/update_cuti_pegawai', $attributes);
			?>
                <fieldset class="step" id="w2first">
                    <div class="formRow">
                        <label>NIPP:<span class="req">*</span></label>
                        <div class="formRight">
						<!--
							<div id="tampil_data">
                            <select class="unit" name="unit">
                                <option value="pilih"> -- Pilih Unit -- </option>
                                <?php// foreach($showdata as $unit) { ?>
                                <option value="<?php //echo $unit['kode_unit']; ?>"><?php //echo $unit['kode_unit']; ?></option>
                                <?php //} ?>
                            </select>
                            </div>
						-->
							<?php 
								$nipp = array('name' => 'nipp', 'id'   => 'nipp', 'readonly'   => 'readonly', );
								echo form_input($nipp, $rc['peg_nipp']); 
								$id_peg = array('name' => 'id_peg', 'id' => 'id_peg');
								echo form_input($id_peg, $rc['cm_id_peg'],'hidden'); 
								$cm_id = array('name' => 'cm_id', 'id' => 'cm_id');
								echo form_input($cm_id, $rc['cm_id'],'hidden'); 
							?>
						</div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>TOTAL CUTI:<span class="req">*</span></label>
                        <div class="formRight">
						<?php 
						$totalcuti = array('name' => 'totalcuti', 'id'   => 'totalcuti', );
						echo form_input($totalcuti, $rc['cm_total']) ?><br/>
						<?php echo form_error('totalcuti'); ?>                       
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>WAKTU PENGGUNAAN:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
							$year = array(
										  '2012' => '2012',
										  '2013' => '2013',
										  '2014' => '2014',
										  '2015' => '2015',
										  '2016' => '2016',
										);
						
							echo form_dropdown('year', $year, $rc['cm_year']);
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
							'name' => 'submit_cuti_add',
							'value'	=> 'SIMPAN',
						);
						echo form_submit($submit)?>
                    </span>
				</div>
                <div class="clear"></div>
			<?php echo form_close();?>
        </div>
</div>