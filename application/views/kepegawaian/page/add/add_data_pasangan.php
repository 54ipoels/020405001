<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Pribadi Pegawai</h6></div>
			<?php 
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/submit_data_pasangan_baru/', $attributes) ?>
                <fieldset class="step" id="w2first">
					<?php echo form_hidden('nipp',$this->uri->segment(3))?>
                    <h1>Step 2 Part 1 - Data Pasangan</h1>
					<div class="formRow">
                        <label>Nama Pasangan:</label>
                        <div class="formRight"><input type="text" name="nama_psgn" id="nama_psgn" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tempat Lahir:</label>
                        <div class="formRight"><input type="text" name="tempat_psgn" id="tempat_psgn" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Lahir:</label>
                        <div class="formRight"><input type="text" name="tanggal_psgn" id="tanggal_psgn" class="maskDate" value="00/00/0000"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Meninggal:</label>
                        <div class="formRight"><input type="text" name="meninggal_psgn" id="meninggal_psgn" class="maskDate" value="00/00/0000"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Alamat Pasangan:</label>
                        <div class="formRight"><input type="text" name="almt_psgn" id="almt_psgn" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pekerjaan Pasangan:</label>
                        <div class="formRight"><input type="text" name="kerja_psgn" id="kerja_psgn" /></div>
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