<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Jabatan Pegawai</h6></div>
			<?php
			$datestring = "%d-%m-%Y" ;
			
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			foreach($jabatan as $row){
			echo form_open('pekerja/edit_data_riwayat_jabatan/'.$this->uri->segment(3), $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1>Edit Data Jabatan</h1>
                    <div class="formRow">
                        <label>NIPP :<span class="req">*</span></label>
                        <div class="formRight">
							<input type="text" name="nipp" value="<?php echo $row['p_jbt_nipp'];?>" style="width:80%;" readonly />
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Jabatan Terakhir:</label>
                        <div class="formRight searchDrop">
						<select name="jabatan" data-placeholder="Pilih Jabatan..." class="chzn-select" tabindex="1" value="<?php echo $row_jbt_tmt['p_jbt_jabatan'];?>"><?php 
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
						<input type="text" name="id_peg_jbt" id="id_peg_jbt" value=<?php echo $row['id_peg_jabatan']; ?> /hidden>
						
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>TMT Start:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						if($row['p_jbt_tmt_start']=="0000-00-00"){$jbt_tmt_start='00-00-0000';}
						else{$jbt_tmt_start = mdate($datestring,strtotime($row['p_jbt_tmt_start']));}
						$tmt_jbt = array(
							'name' => 'tmt_jbt',
							'id'   => 'tmt_jbt',
							'class'=> 'maskDate',
							'style'=> 'width:30%',
							'value'=> $jbt_tmt_start
						);
						echo form_input($tmt_jbt) ?><br/>
						<?php echo form_error('tmt_jbt')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>TMT End:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						if($row['p_jbt_tmt_end']=="0000-00-00"){$jbt_tmt_end='00-00-0000';}
						else{$jbt_tmt_end = mdate($datestring,strtotime($row['p_jbt_tmt_end']));}
						$tmt_end_jbt = array(
							'name' => 'tmt_end_jbt',
							'id'   => 'tmt_end_jbt',
							'class'=> 'maskDate',
							'style'=> 'width:30%',
							'value'=> $jbt_tmt_end
						);
						echo form_input($tmt_end_jbt) ?><br/>
						<?php echo form_error('tmt_end_jbt')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>No SK :<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$sk_no = array(
							'name' => 'skno',
							'id'   => 'skno',
							'style'=> 'width:80%',
							'value'=> $row['p_jbt_skno']
						);
						echo form_input($sk_no) ?><br/>
						<?php echo form_error('sk_no')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>SK Pejabat :<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$sk_pejabat = array(
							'name' => 'skpejabat',
							'id'   => 'skpejabat',
							'style'=> 'width:80%',
							'value'=> $row['p_jbt_skpejabat']
						);
						echo form_input($sk_pejabat) ?><br/>
						<?php echo form_error('sk_pejabat')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal SK :<span class="req">*</span></label>
                        <div class="formRight"><?php 
						if($row['p_jbt_sktanggal']=="0000-00-00"){$jbt_sktanggal='00-00-0000';}
						else{$jbt_sktanggal = mdate($datestring,strtotime($row['p_jbt_sktanggal']));}
						$sk_tanggal_jbt = array(
							'name' => 'sktanggal',
							'id'   => 'sktanggal',
							'class'=> 'maskDate',
							'style'=> 'width:30%',
							'value'=> $jbt_sktanggal
						);
						echo form_input($sk_tanggal_jbt) ?><br/>
						<?php echo form_error('sk_tanggal_jbt')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>SK Keterangan :<span class="req"></span></label>
                        <div class="formRight"><?php 
						$keterangan = array(
							'name' => 'keterangan',
							'id'   => 'keterangan',
							'style'=> 'width:100%',
							'value'=> $row['p_jbt_keterangan']
						);
						echo form_textarea($keterangan) ?><br/>
						<?php echo form_error('keterangan')?></div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				<div class="wizButtons"> 
                    <div class="status" id="status2"></div>
					<span class="wNavButtons">
						<?php 
						$submit = array(
							'class' => 'blueB m110',
							'id'	=> 'next2',
							'value'	=> 'Submit',
						);
						echo form_submit($submit)?>
                    </span>
				</div>
                <div class="clear"></div>
			<?php echo form_close(); }?>
			<div class="data" id="w2"></div>
    </div>
</div>

<div class="oneTwo">
<div class="widget">
<div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Upload SK Jabatan</h6></div>
<?php 	echo form_open_multipart('pekerja/upload_sk_jabatan/');
		foreach($jabatan as $rowfile){
		?>
				<fieldset class="step" id="w2first">
					<h1></h1>
					<div class="formRow">
						<label>File SK:</label>
                        <div class="formRight"><input type="file" name="file" size="20" /></div>
						<input type="text" name="id_peg_jbt" value="<?php echo $id_peg_jabatan; ?>"   hidden />
						<input type="text" name="nipp" value="<?php echo $rowfile['p_jbt_nipp']; ?>"   hidden />
						<input type="text" name="no_sk" value="<?php echo $rowfile['p_jbt_skno']; ?>"   hidden />
						<div class="clear"></div>
                    </div>
					
				</fieldset>
				<div class="wizButtons"> 
                    <div class="status" id="status2"></div>
					<span class="wNavButtons">
                        <input class="blueB ml10" id="next2" value="upload" type="submit" />
                    </span>
				</div>
                <div class="clear"></div>
<?php 	}
		echo form_close();?>
</div>
</div>