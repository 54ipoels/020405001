<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Gaji</h6></div>
			<?php 
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open_multipart('gaji/run_import', $attributes) ?>
                <fieldset class="step" id="w2first">
					<h1>Import File</h1>
					<div class="formRow">
						<label>File:</label>
                        <div class="formRight"><input type="file" name="database" size="20" /></div>
						<div class="clear"></div>
                    </div>
					<div class="formRow">
						 <label>Bulan:</label>
                        <div class="formRight">
						<?php $bulan=array(
										""	=>	"",
										"1"	=>	"Januari",
										"2"	=> 	"Februari",
										"3"	=>	"Maret",
										"4"	=>	"April",
										"5"	=> 	"Mei",
										"6"	=>	"Juni",
										"7"	=>	"Juli",
										"8"	=>	"Agustus",
										"9"	=>	"September",
										"10"=>	"Oktober",
										"11"=>	"November",
										"12"=>	"Desember",
									);
								echo form_dropdown('bulan',$bulan);
								
						?>
						</div>
						<div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tahun:</label>
                        <div class="formRight"><input type="text" name="tahun" id="tahun" /></div>
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