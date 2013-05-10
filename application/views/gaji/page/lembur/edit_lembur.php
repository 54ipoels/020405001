<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Edit Lembur Pegawai</h6></div>
			<?php
			foreach($showdata as $sd){}
			$this->load->view('asset/v_asset');
			$attributes = array('class'=>'form');
			echo form_open('gaji/submit_lembur_pegawai', $attributes);
			echo form_hidden('id_lembur', $sd['id_lembur']);
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
								echo form_hidden('id_peg', $sd['lmb_id_peg']); 
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
						
							echo form_dropdown('month', $month, $sd['lmb_bulan']);
							
							$year = array(
										  '2012' => '2012',
										  '2013' => '2013',
										  '2014' => '2014',
										  '2015' => '2015',
										  '2016' => '2016',
										);
						
							echo form_dropdown('year', $year,  $sd['lmb_tahun']);
							?>
                        </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>UANG MAKAN<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$um = array(
									'name'  => 'uang_makan', 
									'id'    => 'uang_makan', 
									);
								echo form_input($um, $sd['lmb_uang_makan']) ?><br/>
							<?php echo form_error('uang_makan')?>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>UANG TRANSPORT<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$ut = array(
									'name'  => 'uang_transport', 
									'id'    => 'uang_transport', 
									);
								echo form_input($ut,  $sd['lmb_uang_transport']) ?><br/>
							<?php echo form_error('uang_transport')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>JUMLAH HARI KERJA<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$hari_kerja = array(
									'name'  => 'jumlah_hari_kerja', 
									'id'    => 'jumlah_hari_kerja', 
									);
								echo form_input($hari_kerja,  $sd['lmb_jumlah_hari_kerja']) ?><br/>
							<?php echo form_error('jumlah_hari_kerja')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div><div class="formRow">
                        <label>UANG HARI KERJA <span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$hk = array(
									'name'  => 'hari_kerja', 
									'id'    => 'hari_kerja', 
									);
								echo form_input($hk, $sd['lmb_hari_kerja']) ?><br/>
							<?php echo form_error('hari_kerja')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>JAM HARI KERJA<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$jhk = array(
									'name'  => 'jml_hr_kerja', 
									'id'    => 'jml_hr_kerja', 
									);
								echo form_input($jhk, $sd['lmb_jml_hr_kerja']) ?><br/>
							<?php echo form_error('jml_hr_kerja')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>UANG HARI LIBUR <span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$hl = array(
									'name'  => 'hari_libur', 
									'id'    => 'hari_libur', 
									);
								echo form_input($hl, $sd['lmb_hari_libur']) ?><br/>
							<?php echo form_error('hari_libur')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>JAM HARI LIBUR<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$jhl = array(
									'name'  => 'jml_hr_libur', 
									'id'    => 'jml_hr_libur', 
									);
								echo form_input($jhl, $sd['lmb_jml_hr_libur']) ?><br/>
							<?php echo form_error('jml_hr_libur')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>EX. VOED @ <span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$ev = array(
									'name'  => 'jml_ex_voed', 
									'id'    => 'jml_ex_voed', 
									);
								echo form_input($ev,$sd['lmb_jml_ex_voed']) ?><br/>
							<?php echo form_error('jml_ex_voed')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Jumlah EX. VOED <span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$ev = array(
									'name'  => 'ex_voed', 
									'id'    => 'ex_voed', 
									);
								echo form_input($ev,$sd['lmb_ex_voed']) ?><br/>
							<?php echo form_error('ex_voed')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>SHIFT ALL<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$shift = array(
									'name'  => 'shift_all', 
									'id'    => 'shift_all', 
									);
								echo form_input($shift, $sd['lmb_shift_all']) ?><br/>
							<?php echo form_error('shift_all')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>NATURA<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$natura = array(
									'name'  => 'natura', 
									'id'    => 'natura', 
									);
								echo form_input($natura, $sd['lmb_natura']) ?><br/>
							<?php echo form_error('natura')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>TUNJANGAN STKP<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$tunj_stkp = array(
									'name'  => 'tunj_stkp', 
									'id'    => 'tunj_stkp', 
									);
								echo form_input($tunj_stkp,$sd['lmb_tunj_stkp']) ?><br/>
							<?php echo form_error('tunj_stkp')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>POTONGAN<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$potongan = array(
									'name'  => 'potongan', 
									'id'    => 'potongan', 
									);
								echo form_input($potongan, $sd['lmb_potongan']) ?><br/>
							<?php echo form_error('potongan')?>
                            </div>
                            </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>APRESIASI<span class="req"></span></label>
                        <div class="formRight">
							<div id="tampil_data2">
                            <?php 
								$apresiasi = array(
									'name'  => 'apresiasi', 
									'id'    => 'apresiasi', 
									);
								echo form_input($apresiasi, $sd['lmb_apresiasi']) ?><br/>
							<?php echo form_error('apresiasi')?>
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
								echo form_input($koreksi,$sd['lmb_koreksi']) ?><br/>
							<?php echo form_error('koreksi')?>
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
							'name' => 'submit_lembur_edit',
							'value'	=> 'SIMPAN',
						);
						echo form_submit($submit)?>
                    </span>
				</div>
                <div class="clear"></div>
			<?php echo form_close();?>
        </div>
</div>