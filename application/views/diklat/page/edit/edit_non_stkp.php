<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Edit Data Non STKP</h6></div>
			<?php 
			foreach ($nstkp as $row_nstkp) :
			{}endforeach;
			$attributes = array('class'=>'form','id'=>'wizard3');
			$datestring = "%d-%m-%Y";
			echo form_open_multipart('diklat/update_non_stkp/'.$row_nstkp['id_peg_non_stkp'], $attributes) ?>
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
                        <label>Jenis Training:</label>
                        <div class="formRight">
						<?php 
							$jenis_non_stkp = array(
									'name' => 'non_stkp',
									'id'   => 'non_stkp',
								);
						/*
						foreach ($list_stkp as $row_stkp_list) :
						{
							$jenis_stkp[$row_stkp_list['stkp']] = ($row_stkp_list['stkp']);
						} endforeach; 
						*/

						echo form_input($jenis_non_stkp,$row_nstkp['p_nstkp_jenis']);?></div>
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
						if ($row_nstkp['p_nstkp_pelaksanaan']=="0000-00-00"){$tgl_start="00-00-0000";}
						else {$tgl_start = mdate($datestring, strtotime($row_nstkp['p_nstkp_pelaksanaan']));}
						$tanggal_start = array(
							'name' => 'tanggal_start',
							'id'   => 'tanggal_start',
							'class'=> 'maskDate',
							'style'=> 'width:20%'
					 	);
						//$tgl_start = mdate($datestring, strtotime($row_nstkp['p_nstkp_pelaksanaan']));
						echo form_input($tanggal_start,$tgl_start); ?> &nbsp s/d &nbsp<?php 
						
						if ($row_nstkp['p_nstkp_selesai']=="0000-00-00"){$tgl_end="00/00/0000";}
						else {$tgl_end = mdate($datestring, strtotime($row_nstkp['p_nstkp_selesai']));}
						$tanggal_end = array(
							'name' => 'tanggal_end',
							'id'   => 'tanggal_end',
							'class'=> 'maskDate',
							'style'=> 'width:20%'
						);
						//$tgl_end = mdate($datestring, strtotime($row_nstkp['p_nstkp_selesai']));
						echo form_input($tanggal_end,$tgl_end) 
						?> </div>
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
                        <label>Instruktur Nama:</label>
                        <div class="formRight">
						<?php 
						$instruktur = array(
							'name' => 'instruktur',
							'id'   => 'instruktur',
						);
						echo form_input($instruktur,$row_nstkp['p_nstkp_instruktur']) ?></div>
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
						echo form_input($instruktur,$row_nstkp['p_nstkp_instruktur_from']) ?></div>
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