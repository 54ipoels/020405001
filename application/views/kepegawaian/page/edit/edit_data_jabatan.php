<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Jabatan Pegawai</h6></div>
			<?php
			$datestring = "%d-%m-%Y" ;
			foreach ($jabatan as $row_jbt_tmt) : 
			{} endforeach;
			if($row_jbt_tmt['p_jbt_tmt_start']=="0000-00-00"){$jbt_tmt='00-00-0000';}
			else{$jbt_tmt = mdate($datestring,strtotime($row_jbt_tmt['p_jbt_tmt_start']));}
			
			foreach ($unit as $row_unit) : 
			{} endforeach;
			if($row_unit['p_unt_tmt_start']=="0000-00-00"){$unit_tmt='00-00-0000';}
			else{$unit_tmt = mdate($datestring,strtotime($row_unit['p_unt_tmt_start']));}
			
			if ($grade == NULL)
			{
				$grade = '';
			} else {
				foreach ($grade as $row_grade) :
				{
					$grade = $row_grade['p_grd_grade'];
				} endforeach;
			}
			
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/edit_data_jabatan/'.$this->uri->segment(3), $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1>Edit Data Jabatan</h1>
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
						<input type="text" name="id_peg_jbt" id="id_peg_jbt" value=<?php echo $row_jbt_tmt['id_peg_jabatan']; ?> /hidden>
						
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Terhitung Mulai Tanggal:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$tmt_jbt = array(
							'name' => 'tmt_jbt',
							'id'   => 'tmt_jbt',
							'class'=> 'maskDate',
							'style'=> 'width:30%',
							'value'=> $jbt_tmt
						);
						echo form_input($tmt_jbt) ?><br/>
						<?php echo form_error('tmt_jbt')?></div>
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
                        <label>Kode Sub Unit:</label>
                        <div class="formRight">
						<?php 
						$sub_unit['']="";
						foreach($list_sub_unit as $row_sub_unit_list){
							$sub_unit[$row_sub_unit_list['su_kode_sub_unit']] = $row_sub_unit_list['su_sub_unit'];
						}
						echo  form_dropdown('sub_unit',$sub_unit,$row_unit['p_unt_kode_sub_unit']);
						?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Team :</label>
                        <div class="formRight">
						<?php 
						$team_list['']="";
						foreach($list_team as $row_team_list){
							$team_list[$row_team_list['sut_team']] = $row_team_list['sut_team'];
						}
						echo  form_dropdown('team',$team_list,$row_unit['p_unt_team']);
						
						?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Terhitung Mulai Tanggal:<span class="req">*</span></label>
                        <div class="formRight"><?php 
						$tmt_unt = array(
							'name' => 'tmt_unt',
							'id'   => 'tmt_unt',
							'class'=> 'maskDate',
							'style'=> 'width:30%',
							'value'=> $unit_tmt
						);
						echo form_input($tmt_unt) ?><br/>
						<?php echo form_error('tmt_unt')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Grade (romawi):</label>
                        <div class="formRight"><?php 
						$grade = array(
							'name' => 'grade',
							'id'   => 'grade',
							'style'=> 'width:30%',
							'value'=> $grade
						);
						echo form_input($grade) ?><br/>
						<?php echo form_error('grade')?></div>
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