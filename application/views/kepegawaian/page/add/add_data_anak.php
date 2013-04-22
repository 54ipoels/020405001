<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Anak Pegawai</h6></div>
			<?php 
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/add_data_anak/', $attributes) ?>
                <fieldset class="step" id="w2first">
					<?php echo form_hidden('nipp',$this->uri->segment(3))?>
                    <h1>Data Anak</h1>
					<div class="formRow">
                        <label>Nama:</label>
                        <div class="formRight"><input type="text" name="nama" id="nama" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tempat Lahir:</label>
                        <div class="formRight"><input type="text" name="tempat" id="tempat" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Lahir:</label>
                        <div class="formRight"><input type="text" name="tanggal" id="tanggal" class="maskDate" /><span class="formNote">Format Date : dd/mm/yyyy</span></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pendidikan:</label>
                        <div class="formRight"><input type="text" name="pendidikan" id="pendidikan" /></div>
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