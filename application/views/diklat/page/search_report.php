<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Search Report STKP dan Non STKP</h6></div>
			<?php 
			
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('diklat/report_bulanan/part_two', $attributes) ?>
                <fieldset class="step" id="w2first">
					<?php echo form_hidden('nipp',$this->uri->segment(3))?>
                    <h1></h1>
					<div class="formRow">
                        <label>Jenis:</label>
                        <div class="formRight"><?php 
						$jenis = array(
							'STKP' => 'STKP',
							'NSTKP' => 'Non STKP',
						);
						echo form_dropdown('jenis',$jenis) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Bulan / Tahun:</label>
                        <div class="formRight"><?php 
						$bulan = array(
							''	=>	'',
							'01' => 'Januari',
							'02' => 'Februari',
							'03' => 'Maret',
							'04' => 'April',
							'05' => 'Mei',
							'06' => 'Juni',
							'07' => 'Juli',
							'08' => 'Agustus',
							'09' => 'September',
							'10' => 'Oktober',
							'11' => 'November',
							'12' => 'Desember',
						);
						echo form_dropdown('bulan',$bulan); ?>&nbsp; &nbsp;<?php
						$tahun = array(
								'name' => 'tahun',
								'id'   => 'tahun',
								'style'=> 'width:30%',
							);
						echo form_input($tahun);?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Training / Jenis STKP:</label>
                        <div class="formRight"><?php 
						 
						$jenis_stkp = array(
							'name' 	=> 'jenis_stkp',
							'id' 	=> 'jenis_stkp',
						); 
						echo form_input($jenis_stkp); 
						?></div>
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