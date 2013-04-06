<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Edit Data Non STKP</h6></div>
			<?php 
			foreach ($nstkp as $row_nstkp) :
			{}endforeach;
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('diklat/update_non_stkp/'.$row_nstkp['id_peg_non_stkp'], $attributes) ?>
                <fieldset class="step" id="w2first">
					<?php //echo form_hidden('nipp',$this->uri->segment(3))
						echo form_hidden('nipp',$row_nstkp['peg_nipp']);
					?>
                    <h1></h1>
					<div class="formRow">
                        <label>NIPP:</label>
                        <div class="formRight"><?php echo $row_nstkp['peg_nipp']?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Nama:</label>
                        <div class="formRight"><?php echo $row_nstkp['peg_nama']?></div>
                        <div class="clear"></div>
                    </div>
					 <div class="formRow">
                        <label>Type:</label>
                        <div class="formRight"><?php 
						$type = array(
							'INIT' => 'Initialization',
							'RECC' => 'Reccurent',
						);
						echo form_dropdown('type',$type,$row_nstkp['p_nstkp_jenis']) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Jenis STKP:</label>
                        <div class="formRight">
						<?php 
							$jenis_non_stkp = array(
											''					=>	'',
											'bahasa inggris' 	=> 	"Bahasa Inggris",		
											'bahasa jepang'	 	=> 	"Bahasa Jepang",		
								);
						/*
						foreach ($list_stkp as $row_stkp_list) :
						{
							$jenis_stkp[$row_stkp_list['stkp']] = ($row_stkp_list['stkp']);
						} endforeach; 
						*/

						echo form_dropdown('non_stkp',$jenis_non_stkp,$row_nstkp['p_nstkp_jenis']);?></div>
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
						echo form_input($lembaga,$row_nstkp['p_nstkp_lembaga']) ?></div>
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
						$datestring = "%d-%m-%Y" ;
						$tgl_pelaksanaan = mdate($datestring, strtotime($row_nstkp['p_nstkp_pelaksanaan']));
						echo form_input($pelaksanaan,$tgl_pelaksanaan) ?></div>
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
						$val_awal = mdate($datestring, strtotime($row_nstkp['p_nstkp_mulai']));
						echo form_input($validitas_awal,$val_awal) ?> &nbsp s/d &nbsp<?php 
						$validitas_akhir = array(
							'name' => 'validitas_akhir',
							'id'   => 'validitas_akhir',
							'class'=> 'maskDate',
							'style'=> 'width:20%'
						);
						$val_akhir = mdate($datestring, strtotime($row_nstkp['p_nstkp_finish']));
						echo form_input($validitas_akhir,$val_akhir) ?></div>
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
						echo form_input($license,$row_nstkp['p_nstkp_no_license']) ?></div>
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
						echo form_input($rating,$row_nstkp['p_nstkp_rating']) ?></div>
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