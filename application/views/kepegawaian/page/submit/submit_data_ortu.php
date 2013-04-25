<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Pribadi Pegawai</h6></div>
			<?php 
			if ($this->uri->segment(3) == 'pribadi')
			{
				$step1 = 'Step 2 Part 1 - Data Orang Tua';
				$step2 = 'Step 2 Part 2 - Data Orang Tua';
				echo form_hidden('nipp',$this->uri->segment(4));
				$next = 'pribadi/'.$this->uri->segment(4);
			} else {
				$step1 = 'Step 3 Part 1 - Data Orang Tua';
				$step2 = 'Step 3 Part 2 - Data Orang Tua';
				echo form_hidden('nipp',$this->uri->segment(3));
				$next = $this->uri->segment(3);
			}
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/submit_data_ortu/'.$next, $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1><?php echo $step1; ?></h1>
					<div class="formRow">
                        <label>Nama Ayah:</label>
                        <div class="formRight"><input type="text" name="nama_ayah" id="nama_ayah" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tempat Lahir:</label>
                        <div class="formRight"><input type="text" name="tempat_ayah" id="tempat_ayah" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Lahir:</label>
                        <div class="formRight"><input type="text" name="tanggal_ayah" id="tanggal_ayah" class="maskDate" value="00/00/0000"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Meninggal:</label>
                        <div class="formRight"><input type="text" name="meninggal_ayah" id="meninggal_ayah" class="maskDate" value="00/00/0000"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Alamat:</label>
                        <div class="formRight"><input type="text" name="almt_ayah" id="almt_ayah" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pekerjaan:</label>
                        <div class="formRight"><input type="text" name="kerja_ayah" id="kerja_ayah" /></div>
                        <div class="clear"></div>
                    </div>
				</fieldset>
				</fieldset>
				<fieldset id="w8confirmation" class="step">
                    <h1><?php echo $step2; ?></h1>
					<div class="formRow">
                        <label>Nama Ibu:</label>
                        <div class="formRight"><input type="text" name="nama_ibu" id="nama_ibu" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tempat Lahir:</label>
                        <div class="formRight"><input type="text" name="tempat_ibu" id="tempat_ibu" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Lahir:</label>
                        <div class="formRight"><input type="text" name="tanggal_ibu" id="tanggal_ibu" class="maskDate" value="00/00/0000"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Meninggal:</label>
                        <div class="formRight"><input type="text" name="meninggal_ibu" id="meninggal_ibu" class="maskDate" value="00/00/0000"/></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Alamat:</label>
                        <div class="formRight"><input type="text" name="almt_ibu" id="almt_ibu" /></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pekerjaan:</label>
                        <div class="formRight"><input type="text" name="kerja_ibu" id="kerja_ibu" /></div>
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
                <div class="clear"></div>
			</form>
			<div class="data" id="w2"></div>
        </div>
</div>