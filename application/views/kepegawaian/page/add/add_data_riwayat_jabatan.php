<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Jabatan <?php echo $this->uri->segment(3); ?></h6></div>
			<?php 
			$datestring = "%d-%m-%Y" ;
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open_multipart('pekerja/add_data_riwayat_jabatan/', $attributes) ?>
                <fieldset class="step" id="w2first">
					<?php echo form_hidden('nipp',$this->uri->segment(3))?>
					 <div class="formRow">
                        <label>NIPP :<span class="req">*</span></label>
                        <div class="formRight">
							<input type="text" name="nipp" value="<?php echo $this->uri->segment(3);?>" style="width:80%;" readonly />
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Jabatan :</label>
                        <div class="formRight searchDrop">
						<select name="jabatan" data-placeholder="Pilih Jabatan..." class="chzn-select" tabindex="1" ><?php 
						foreach ($list_jabatan as $row_jabatan) :
						{ 
							if ($row_jabatan['peg_tab_jab'] == $row_jbt_tmt['p_jbt_jabatan'])
							{?>
								<option value="<?php echo $row_jabatan['peg_tab_jab'];?>" selected="selected"><?php echo $row_jabatan['peg_tab_jab']; ?></option>
							
						<?php }else{ ?>
								<option value="<?php echo $row_jabatan['peg_tab_jab'];?>"><?php echo $row_jabatan['peg_tab_jab']; ?></option>
							<?php }
							} endforeach; ?>
						</select></div>
						<div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Unit :</label>
						<div class="formRight">
							<?php
								foreach ($list_unit as $row_unit)
								{
									$unit_code = $row_unit['kode_unit'];
									$var_unit[$unit_code] =  $row_unit['nama_unit']; 	
								}
								echo form_dropdown('unit',$var_unit);
							?>
						</div>
                    	<div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>TMT Start:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						//if($row['p_jbt_tmt_start']=="0000-00-00"){$jbt_tmt_start='00-00-0000';}
						//else{$jbt_tmt_start = mdate($datestring,strtotime($row['p_jbt_tmt_start']));}
						$tmt_jbt = array(
							'name' => 'tmt_jbt',
							'id'   => 'tmt_jbt',
							'class'=> 'maskDate',
							'style'=> 'width:30%',
							//'value'=> $jbt_tmt_start
						);
						echo form_input($tmt_jbt) ?><br/>
						<?php echo form_error('tmt_jbt')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>TMT End:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						//if($row['p_jbt_tmt_end']=="0000-00-00"){$jbt_tmt_end='00-00-0000';}
						//else{$jbt_tmt_end = mdate($datestring,strtotime($row['p_jbt_tmt_end']));}
						$tmt_end_jbt = array(
							'name' => 'tmt_end_jbt',
							'id'   => 'tmt_end_jbt',
							'class'=> 'maskDate',
							'style'=> 'width:30%',
							//'value'=> $jbt_tmt_end
						);
						echo form_input($tmt_end_jbt) ?><br/>
						<?php echo form_error('tmt_end_jbt')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>No SK :<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$sk_no = array(
							'name' => 'no_sk',
							'id'   => 'no_sk',
							'style'=> 'width:80%',
							//'value'=> $row['p_jbt_skno']
						);
						echo form_input($sk_no) ?><br/>
						<?php echo form_error('sk_no')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
						<label>File SK:</label>
                        <div class="formRight"><input type="file" name="file" size="20" /></div>
						<div class="clear"></div>
                    </div>
					
					<div class="formRow">
                        <label>SK Keterangan :<span class="req"></span></label>
                        <div class="formRight"><?php 
						$keterangan = array(
							'name' => 'keterangan',
							'id'   => 'keterangan',
							'style'=> 'width:100%',
							//'value'=> $row['p_jbt_keterangan']
						);
						echo form_textarea($keterangan) ?><br/>
						<?php echo form_error('keterangan')?></div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				<div class="wizButtons"> 
                    <div class="status" id="status2"></div>
					<span class="wNavButtons">
                        <input class="blueB ml10" id="next2" value="Next" type="submit" />
                    </span>
				</div>
                <div class="clear"></div>
			</form>
			<div class="data" id="w2"></div>
        </div>
</div>