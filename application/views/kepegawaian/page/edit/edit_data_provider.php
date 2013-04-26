<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Provider Pegawai</h6></div>
			<?php 
			/*
			foreach ($jabatan_tmt as $row_jbt_tmt) : 
			{
				$datestring = "%d-%m-%Y" ;
				$tmt = mdate($datestring,strtotime($row_jbt_tmt['p_tmt_tmt']));
			} endforeach;
			
			foreach ($unit as $row_unit) : 
			{} endforeach;
			*/
			$datestring = "%d-%m-%Y" ;
			foreach ($jabatan as $row_jbt_tmt) : 
			{} endforeach;
			if($row_jbt_tmt['p_jbt_tmt_start']=="0000-00-00"){$jbt_tmt='00-00-0000';}
			else{$jbt_tmt = mdate($datestring,strtotime($row_jbt_tmt['p_jbt_tmt_start']));}
			
			foreach ($unit as $row_unit) : 
			{} endforeach;
			if($row_unit['p_unt_tmt_start']=="0000-00-00"){$unit_tmt='00-00-0000';}
			else{$unit_tmt = mdate($datestring,strtotime($row_unit['p_unt_tmt_start']));}
		
			if($data_tmt==NULL)
			{
				$status="-";
				$tmt = "-";
				$provider ="-";
			} else {
				foreach ($data_tmt as $row_tmt) :
				{
					$datestring = "%d-%m-%Y" ;
					$tmt = mdate($datestring,strtotime($row_tmt['p_tmt_tmt']));
					$status = $row_tmt['p_tmt_status'];
					$provider = $row_tmt['p_tmt_provider'];
				} endforeach;
			}
			
			if ($grade == NULL)
				{ $grade = '';} else {
					foreach ($grade as $row_grade) :
					{
						$grade = $row_grade['p_grd_grade'];
					} endforeach;
				}
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/edit_data_provider/'.$this->uri->segment(3), $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1>Pindah Provider</h1>
                    <div class="formRow">
                        <label>NIPP:</label>
                        <div class="formRight"><?php 
						$nipp_baru = array(
							'name' => 'nipp_baru',
							'id'   => 'nipp_baru',
						);
						echo form_input($nipp_baru) ?><br/>
						<?php echo form_error('nipp_baru')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Jabatan :</label>
                        <div class="formRight searchDrop">
						<input type="text" name="id_peg_jbt" id="id_peg_jbt" value=<?php echo $row_jbt_tmt['id_peg_jabatan']; ?> /hidden>
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
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Unit:</label>
                        <div class="formRight">
						<input type="text" name="id_peg_unit" id="id_peg_unit" value=<?php echo $row_unit['id_peg_unit']; ?> /hidden>
						<?php 
						$unit = array();
						foreach ($list_unit as $row_unit_list) :
						{
							$unit[$row_unit_list['kode_unit']] = ($row_unit_list['nama_unit']);
						} endforeach; 
						echo form_dropdown('unit',$unit,$row_unit['p_unt_kode_unit']);?><br/>
						<?php echo form_error('unit')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Terhitung Mulai Tanggal:</label>
                        <div class="formRight"><?php 
						$tmt = array(
							'name' => 'tmt',
							'id'   => 'tmt',
							'class'=> 'maskDate',
							/*'value'=> $tmt*/
						);
						echo form_input($tmt) ?><br/>
						<?php echo form_error('tmt')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Status Pegawai:</label>
                        <div class="formRight"><?php 
						$status = array(
							'Tetap'	=> 'Tetap',
							'PKWT' => 'PKWT',
							'Outsource' => 'Outsource',
						);
						#$value = $row_jbt_tmt['p_tmt_status'];
						echo form_dropdown('status',$status,'Outsource') ?><br/>
						<?php echo form_error('status')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
						<label>Grade</label>
						<div class="formRight">	<?php 
						$grade = array(
							'name' => 'grade',
							'id'   => 'grade',
							'style'=> 'width:30%',
						);	
						echo form_input($grade);?><br/>
						</div>
						<div class="clear"></div>
					</div>
					<div class="formRow">
                        <label>Provider:</label>
                        <div class="formRight"><?php 
						$provider = array(
							'name' => 'provider',
							'id'   => 'provider',
							/*'value'=> $row_jbt_tmt['p_tmt_provider']*/
						);
						echo form_input($provider) ?><br/>
						<?php echo form_error('provider')?></div>
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
			<?php echo form_close();?>
			<div class="data" id="w2"></div>
        </div>
</div>