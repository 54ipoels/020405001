<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Pribadi Pegawai</h6></div>
			<?php 
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/submit_data_mertua/', $attributes) ?>
                <fieldset class="step" id="w2first">
					<?php echo form_hidden('nipp',$this->uri->segment(3))?>
                    <h1>Step 4 Part 2 - Data Mertua</h1>
					<div class="formRow">
                        <label>Nama Ayah Mertua:</label>
                        <div class="formRight"><input type="text" name="nama_mert_ayah" id="nama_mert_ayah" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tempat Lahir:</label>
                        <div class="formRight"><input type="text" name="tempat_mert_ayah" id="tempat_mert_ayah" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Lahir:</label>
                        <div class="formRight"><input type="text" name="tanggal_mert_ayah" id="tanggal_mert_ayah" class="maskDate" value="00/00/0000"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Meninggal:</label>
                        <div class="formRight"><input type="text" name="meninggal_mert_ayah" id="meninggal_mert_ayah" class="maskDate" value="00/00/0000"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Alamat:</label>
                        <div class="formRight"><input type="text" name="almt_mert_ayah" id="almt_mert_ayah" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pekerjaan:</label>
                        <div class="formRight"><input type="text" name="kerja_mert_ayah" id="kerja_mert_ayah" /></div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				<fieldset class="step" id="w3confirmation">
                    <h1>Step 4 Part 2 - Data Mertua</h1>
					<div class="formRow">
                        <label>Nama Ibu Mertua:</label>
                        <div class="formRight"><input type="text" name="nama_mert_ibu" id="nama_mert_ibu" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tempat Lahir:</label>
                        <div class="formRight"><input type="text" name="tempat_mert_ibu" id="tempat_mert_ibu" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Lahir:</label>
                        <div class="formRight"><input type="text" name="tanggal_mert_ibu" id="tanggal_mert_ibu" class="maskDate" value='00/00/0000' /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Meninggal:</label>
                        <div class="formRight"><input type="text" name="meninggal_mert_ibu" id="meninggal_mert_ibu" class="maskDate" value="00/00/0000" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Alamat:</label>
                        <div class="formRight"><input type="text" name="almt_mert_ibu" id="almt_mert_ibu" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pekerjaan:</label>
                        <div class="formRight"><input type="text" name="kerja_mert_ibu" id="kerja_mert_ibu" /></div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				<div class="wizButtons"> 
                    <div class="status" id="status2"></div>
					<span class="wNavButtons">
                        <input class="basic" id="back2" value="Back" type="reset" />
                        <input class="blueB ml10" id="next2" value="Next" type="submit" />
                    </span>
				</div>
				</fieldset>
                <div class="clear"></div>
			</form>
			<div class="data" id="w2"></div>
        </div>
</div>