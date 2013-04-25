<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Jabatan</h6></div>
			<?php 
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/add_data_jabatan/part_two', $attributes) ?>
                <fieldset class="step" id="w2first">
					<?php echo form_hidden('nipp',$this->uri->segment(3))?>
                    <h1>Data Jabatan</h1>
					<div class="formRow">
                        <label>Jabatan yang Ada:</label>
						 <div class="formRight searchDrop">
                        <select name="list_jabatan" data-placeholder="Pilih Jabatan..." class="chzn-select" tabindex="1"><?php 
						foreach ($list_jabatan as $row_jabatan) :
						{ ?>
							<option value="<?php echo $row_jabatan['peg_tab_jab'];?>"><?php echo $row_jabatan['peg_tab_jab']; ?></option>
							
						<?php } endforeach; ?>
						</select>
						<?php 
						$check = array(
								  'name'        => 'edit',
								  'id'          => 'edit',
								  'value'       => 'yes',
								  'checked'     => FALSE, 
								);
						echo form_checkbox($check);?><span class="formNote">Centang bila ingin edit</span></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Jabatan Baru:</label>
                        <div class="formRight"><input type="text" name="jabatan" id="jabatan" /></div>
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