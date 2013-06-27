<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Edit Data STKP</h6></div>
			<?php 
			foreach ($stkp as $row_stkp) :
			{}endforeach;
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open_multipart('diklat/update_stkp/'.$row_stkp['id_peg_stkp'], $attributes) ?>
                <fieldset class="step" id="w2first">
					<?php //echo form_hidden('nipp',$this->uri->segment(3))
						echo form_hidden('nipp',$row_stkp['peg_nipp']);
					?>
                    <h1></h1>
					<div class="formRow">
                        <label>NIPP:</label>
                        <div class="formRight"><?php echo $row_stkp['peg_nipp']?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Nama:</label>
                        <div class="formRight"><?php echo $row_stkp['peg_nama']?></div>
                        <div class="clear"></div>
                    </div>
					 <div class="formRow">
                        <label>Type:</label>
                        <div class="formRight"><?php 
						$type = array(
							'INIT' => 'Initialization',
							'RECC' => 'Reccurent',
						);
						echo form_dropdown('type',$type,$row_stkp['p_stkp_type']) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                       <label>Jenis STKP:</label>
                        <div class="formRight">
						<?php 
						$jenis_stkp = array(
									'GSE'	=>	"GSE",
									'FOO'	=>	"FOO",
									'DGR'	=>	"DGR",
									'AVSEC'	=>	"AVSEC",
						);
						echo form_dropdown('jenis_stkp',$jenis_stkp,$row_stkp['p_stkp_jenis']) ?></div>
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
						echo form_input($lembaga,$row_stkp['p_stkp_lembaga']) ?></div>
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
						if ($row_stkp['p_stkp_pelaksanaan']=="0000-00-00"){
							$tgl_pelaksanaan = "00-00-0000";
						} else {
							$tgl_pelaksanaan = mdate($datestring, strtotime($row_stkp['p_stkp_pelaksanaan']));
						}
						echo form_input($pelaksanaan,$tgl_pelaksanaan) ?> &nbsp s/d &nbsp <?php 
						$selesai = array(
							'name' => 'selesai',
							'id'   => 'selesai',
							'class'=> 'maskDate',
							'style'=> 'width:20%'
						);
						if ($row_stkp['p_stkp_selesai']=="0000-00-00"){
							$tgl_selesai = "00-00-0000";
						} else {
							$tgl_selesai = mdate($datestring, strtotime($row_stkp['p_stkp_selesai']));
						}
						echo form_input($selesai,$tgl_selesai) ?> 
						
						</div>
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
						if ($row_stkp['p_stkp_mulai']=="0000-00-00"){
							$val_awal = "00-00-0000";
						} else {
							$val_awal = mdate($datestring, strtotime($row_stkp['p_stkp_mulai']));
						}
						echo form_input($validitas_awal,$val_awal) ?> &nbsp s/d &nbsp<?php 
						$validitas_akhir = array(
							'name' => 'validitas_akhir',
							'id'   => 'validitas_akhir',
							'class'=> 'maskDate',
							'style'=> 'width:20%'
						);
						if ($row_stkp['p_stkp_finish']=="0000-00-00"){
							$val_akhir = "00-00-0000";
						} else {
							$val_akhir = mdate($datestring, strtotime($row_stkp['p_stkp_finish']));
						}
						echo form_input($validitas_akhir,$val_akhir) ?> </div>
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
						echo form_input($license,$row_stkp['p_stkp_no_license']) ?></div>
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
						echo form_input($rating,$row_stkp['p_stkp_rating']) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Instruktur Nama:</label>
                        <div class="formRight">
						<?php 
						$instruktur = array(
							'name' => 'instruktur',
							'id'   => 'instruktur',
						);
						echo form_input($instruktur,$row_stkp['p_stkp_instruktur']) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Instruktur From:</label>
                        <div class="formRight">
						<?php 
						$instruktur_from = array(
							'name' => 'instruktur_from',
							'id'   => 'instruktur_from',
						);
						echo form_input($instruktur,$row_stkp['p_stkp_instruktur_from']) ?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>File:</label>
                        <div class="formRight"><input type="file" name="file" size="20" /></div>
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