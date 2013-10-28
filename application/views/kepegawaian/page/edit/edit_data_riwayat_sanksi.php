<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Jabatan Pegawai</h6></div>
			<?php
			$datestring = "%d-%m-%Y" ;
			$attributes = array('class'=>'form','id'=>'wizard3');
			foreach($sanksi as $row){
			echo form_open_multipart('pekerja/edit_data_riwayat_sanksi/'.$this->uri->segment(3), $attributes);
			?>
                <fieldset class="step" id="w2first">
                    <?php 	echo form_hidden('id_peg_sanksi',$id_peg_sanksi); ?>
					<h1>Edit Data Jabatan</h1>
                    <div class="formRow">
                        <label>NIPP :<span class="req">*</span></label>
                        <div class="formRight">
							<input type="text" name="nipp" value="<?php echo $row['p_snk_nipp'];?>" style="width:80%;" readonly />
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Jenis Sanksi :</label>
						<div class="formRight">
							<?php 
								echo form_input('sanksi', $row['p_snk_jenis']);
							?>
						</div>
						<div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>No SK :</label>
						<div class="formRight">
							<?php echo form_input('no_sk', $row['p_snk_no']);?>
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
								if($row['p_snk_start']=="0000-00-00"){$snk_start = '00-00-0000';}
								else{$snk_start = mdate($datestring,strtotime($row['p_snk_start']));}
								$tmt_start = array(
									'name' => 'tmt_start',
									'id'   => 'tmt_start',
									'class'=> 'maskDate',
									'style'=> 'width:30%',
									'value'=> $snk_start
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
								if($row['p_snk_end']=="0000-00-00"){$snk_end = '00-00-0000';}
								else{$snk_end = mdate($datestring,strtotime($row['p_snk_end']));}
								$tmt_end = array(
									'name' => 'tmt_end',
									'id'   => 'tmt_end',
									'class'=> 'maskDate',
									'style'=> 'width:30%',
									'value'=> $snk_end
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
							<?php echo form_textarea('keterangan', $row['p_snk_keterangan']); ?>
						</div>
						<div class="clear"></div>
                    </div>
				</fieldset>
				<div class="wizButtons"> 
                    <div class="status" id="status2"></div>
					<span class="wNavButtons">
						<?php 
						$submit = array(
							'class' => 'blueB m110',
							'id'	=> 'next2',
							'value'	=> 'Submit',
						);
						echo form_submit($submit)?>
                    </span>
				</div>
                <div class="clear"></div>
			<?php echo form_close(); }?>
			<div class="data" id="w2"></div>
    </div>
</div>
