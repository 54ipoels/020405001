<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Edit Gaji Pegawai</h6></div>
			<?php
			foreach($showdata as $sd){}
			$this->load->view('asset/v_asset');
			$attributes = array('class'=>'form');
			echo form_open('c_absensi/submit_penggajian', $attributes);
			echo form_hidden('id_pgj', $sd['id_pgj']);
			
			?>
                <fieldset class="step" id="w2first">
                    <div class="formRow">
                        <label>NIPP:<span class="req">*</span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$nipp = array(
									'name'  => 'nipp', 
									'id'    => 'nipp', 
									'readonly' => 'readonly',
									);
								echo form_hidden('id_peg', $sd['pgj_id_peg']); 
								echo form_input($nipp, $sd['peg_nipp']); ?><br/>
							<?php echo form_error('nipp')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>BULAN:<span class="req">*</span></label>
                        <div class="formRight">
							<?php
							$month = array(
										  '1' => 'JANUARI',
										  '2' => 'FEBRUARI',
										  '3' => 'MARET',
										  '4' => 'APRIL',
										  '5' => 'MEI',
										  '6' => 'JUNI',
										  '7' => 'JULI',
										  '8' => 'AGUSTUS',
										  '9' => 'SEPTEMBER',
										  '10' => 'OKTOBER',
										  '11' => 'NOVEMBER',
										  '12' => 'DESEMBER',
										);
						
							echo form_dropdown('month', $month,  $sd['pgj_bulan']);
							
							$year = array(
										  '2012' => '2012',
										  '2013' => '2013',
										  '2014' => '2014',
										  '2015' => '2015',
										  '2016' => '2016',
										);
						
							echo form_dropdown('year', $year,  $sd['pgj_tahun']);
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
                        <label>MASA BAKTI<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$mb = array(
									'name'  => 'masa_bakti', 
									'id'    => 'masa_bakti', 
									);
								echo form_input($mb,$sd['pgj_masa_bakti']) ?><br/>
							<?php echo form_error('masa_bakti')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>KOREKSI<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$koreksi = array(
									'name'  => 'koreksi', 
									'id'    => 'koreksi', 
									);
								echo form_input($koreksi,$sd['pgj_koreksi']) ?><br/>
							<?php echo form_error('koreksi')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>INSENTIVE<span class="req"></span></label>
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
                        <label>POTONGAN<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$pot = array(
									'name'  => 'potongan', 
									'id'    => 'potongan', 
									);
								echo form_input($pot,$sd['pgj_potongan']) ?><br/>
							<?php echo form_error('potongan')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>PEMBULATAN<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$pembulatan = array(
									'name'  => 'pembulatan', 
									'id'    => 'pembulatan', 
									);
								echo form_input($pembulatan,$sd['pgj_pembulatan']) ?><br/>
							<?php echo form_error('pembulatan')?>
                            </div>
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