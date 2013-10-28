<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Sanksi Disiplin <?php echo $this->uri->segment(3); ?></h6></div>
			<?php 
			$datestring = "%d-%m-%Y" ;
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open_multipart('pekerja/add_data_sanksi/', $attributes) ?>
                <fieldset class="step" id="w2first">
					<?php echo form_hidden('nipp',$this->uri->segment(3))?>
                   <div class="formRow">
                        <label>Jenis Sanksi :</label>
						<div class="formRight">
							<?php 
								echo form_input('sanksi');
							?>
						</div>
						<div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>No SK :</label>
						<div class="formRight">
							<?php echo form_input('no_sk');?>
						</div>
						<div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>SK File :</label>
						<div class="formRight">
							<input type="file" name="file" size="20" />
						</div>
						<div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tgl Mulai :</label>
						<div class="formRight">
							<?php 
								//if($row['p_snk_start']=="0000-00-00"){$snk_start = '00-00-0000';}
								//else{$snk_start = mdate($datestring,strtotime($row['p_snk_start']));}
								$tmt_start = array(
									'name' => 'tmt_start',
									'id'   => 'tmt_start',
									'class'=> 'maskDate',
									'style'=> 'width:30%',
									//'value'=> $snk_start
								);
								echo form_input($tmt_start); 
							?>
							<br/>
						</div>
						<div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tgl Berakhir :</label>
						<div class="formRight">
							<?php 
								//if($row['p_snk_end']=="0000-00-00"){$snk_end = '00-00-0000';}
								//else{$snk_end = mdate($datestring,strtotime($row['p_snk_end']));}
								$tmt_end = array(
									'name' => 'tmt_end',
									'id'   => 'tmt_end',
									'class'=> 'maskDate',
									'style'=> 'width:30%',
									//'value'=> $snk_end
								);
								echo form_input($tmt_end); 
							?>
							<br/>
						</div>
						<div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Keterangan :</label>
						<div class="formRight">
							<?php echo form_textarea('keterangan'); ?>
						</div>
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