<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Upload Photo Pegawai</h6></div>
			<?php 
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open_multipart('pekerja/do_upload_foto', $attributes) ?>
                <fieldset class="step" id="w2first">
					<h1></h1>
					<div class="formRow">
						<label>File Photo:</label>
                        <div class="formRight"><input type="file" name="userfile" size="20" /></div>
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
			</form>
			<div class="data" id="w2"></div>
        </div>
</div>

<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Upload Diklat Pegawai</h6></div>
			<?php 
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open_multipart('pekerja/do_upload_diklat', $attributes) ?>
                <fieldset class="step" id="w2first">
					<h1></h1>
					<div class="formRow">
						<label>File Diklat:</label>
                        <div class="formRight"><input type="file" name="userfile" size="20" /></div>
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
			</form>
			<div class="data" id="w2"></div>
    </div>
</div>
<div class="widget">
<div >
<b>NB : </b><br>
- Rename Foto Sesuai dengan NIPP ybs sebelum diupload <br>
- Rename Diklat Sesuai dengan No Sertifikat sebelum diupload  <br>
</div>
</div>
<?php
if (isset($error)){
?>
<br><br>
<div class="widget" style="color:red; size:3pt;">
<h6><b><?php print_r($error);?></b></h6>
</div>
<?php } ?>