<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Input Data STKP</h6></div>
			<?php 
			foreach ($pegawai as $row_pegawai) :
			{}endforeach;
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('diklat/add_data_stkp/'.$row_pegawai['peg_nipp'], $attributes) ?>
                <fieldset class="step" id="w2first">
					<?php echo form_hidden('nipp',$this->uri->segment(3))?>
                    <h1></h1>
					<div class="formRow">
                        <label>NIPP:</label>
                        <div class="formRight"><?php echo $row_pegawai['peg_nipp']?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Nama:</label>
                        <div class="formRight"><?php echo $row_pegawai['peg_nama']?></div>
                        <div class="clear"></div>
                    </div>
					 <div class="formRow">
                        <label>Type:</label>
                        <div class="formRight"><?php 
						$type = array(
							'INIT' => 'Initialization',
							'RECC' => 'Reccurent',
						);
						echo form_dropdown('type',$type) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Jenis STKP:</label>
                        <div class="formRight">
						<?php 
						/*
						$jenis_stkp = array();
						foreach ($list_stkp as $row_stkp_list) :
						{
							$jenis_stkp[$row_stkp_list['stkp']] = ($row_stkp_list['stkp']);
						} endforeach; 
						*/
						$jenis_stkp = array(
								"GSE"	=> "GSE",
								"FOO"	=> "FOO",
								"DGR"	=> "DGR",
								"AVSEC"	=> "AVSEC",
						);
						echo form_dropdown('stkp',$jenis_stkp,'');?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Penyelenggara:</label>
                        <div class="formRight">
						<?php 
						$lembaga = array(
							'name' => 'lembaga',
							'id'   => 'lembaga',
						);
						echo form_input($lembaga) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pelaksanaan:</label>
                        <div class="formRight">
						<?php 
						$pelaksanaan = array(
							'name' => 'pelaksanaan',
							'id'   => 'pelaksanaan',
							'class'=> 'maskDate',
							'style'=> 'width:20%'
						);
						echo form_input($pelaksanaan) ?>  &nbsp s/d &nbsp <?php 
						$selesai = array(
							'name' => 'selesai',
							'id'   => 'selesai',
							'class'=> 'maskDate',
							'style'=> 'width:20%'
						);
						echo form_input($selesai) ?> </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Validity:</label>
                        <div class="formRight">
						<?php 
						$validitas_awal = array(
							'name' => 'validitas_awal',
							'id'   => 'validitas_awal',
							'class'=> 'maskDate',
							'style'=> 'width:20%'
						);
						echo form_input($validitas_awal) ?> &nbsp s/d &nbsp<?php 
						$validitas_akhir = array(
							'name' => 'validitas_akhir',
							'id'   => 'validitas_akhir',
							'class'=> 'maskDate',
							'style'=> 'width:20%'
						);
						echo form_input($validitas_akhir) ?> </div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow"> 
                        <label>License:</label>
                        <div class="formRight">
						<?php 
						$license = array(
							'name' => 'license',
							'id'   => 'license',
						);
						echo form_input($license) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Rating:</label>
                        <div class="formRight">
						<?php 
						$rating = array(
							'name' => 'rating',
							'id'   => 'rating',
							'style'=> 'width:40%'
						);
						echo form_input($rating) ?></div>
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