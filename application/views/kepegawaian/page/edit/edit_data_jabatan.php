<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Jabatan Pegawai</h6></div>
			<?php 
			foreach ($jabatan as $row_jbt_tmt) : 
			{
				$datestring = "%d-%m-%Y" ;
				$tmt = mdate($datestring,strtotime($row_jbt_tmt['p_jbt_tmt_start']));
			} endforeach;
			foreach ($unit as $row_unit) : 
			{} endforeach;
			if ($grade == NULL)
				{ $grade = '';} else {
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
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Terhitung Mulai Tanggal:</label>
                        <div class="formRight"><?php 
						$tmt = array(
							'name' => 'tmt_jbt',
							'id'   => 'tmt_jbt',
							'class'=> 'maskDate',
							'style'=> 'width:30%',
							'value'=> $tmt
						);
						echo form_input($tmt) ?><br/>
						<?php echo form_error('tmt')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Unit:</label>
                        <div class="formRight"><?php 
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
							'name' => 'tmt_unt',
							'id'   => 'tmt_unt',
							'class'=> 'maskDate',
							'style'=> 'width:30%',
							'value'=> mdate($datestring, strtotime($row_unit['p_unt_tmt_start']))
						);
						echo form_input($tmt) ?><br/>
						<?php echo form_error('tmt')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Grade:</label>
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