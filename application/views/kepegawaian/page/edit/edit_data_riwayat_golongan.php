<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Golongan Pegawai</h6></div>
			<?php
			$datestring = "%d-%m-%Y" ;
			$attributes = array('class'=>'form','id'=>'wizard3');
			foreach($golongan as $row){
				echo form_open_multipart('pekerja/edit_data_riwayat_golongan/'.$id_peg_grade, $attributes);
				?>
                <fieldset class="step" id="w2first">
                    <?php echo form_hidden('id_peg_grade',$id_peg_grade); ?>
					<h1>Edit Data Golongan</h1>
                    <div class="formRow">
                        <label>NIPP :<span class="req">*</span></label>
                        <div class="formRight">
							<input type="text" name="nipp" value="<?php echo $row['p_grd_nipp'];?>" style="width:80%;" readonly />
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Golongan</label>
						<div class="formRight">
                        <?php 
								$list_golongan = array(
									"I"			=>	"I",
									"II"		=>	"II",
									"III"		=>	"III",
									"IV"		=>	"IV",
									"V"			=>	"V",
									"VI"		=>	"VI",
									"VII"		=>	"VII",
									"VIII"		=>	"VIII",
									"IX"		=>	"IX",
									"X"			=>	"X",
									"XI"		=>	"XI",
									"XII"		=>	"XII",
								);
								echo form_dropdown('golongan',$list_golongan,$row['p_grd_grade']);
						?>
						</div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>No SK :</label>
						<div class="formRight">
							<?php echo form_input('no_sk',$row['p_grd_skno']);?>
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
                        <label>TMT :</label>
						<div class="formRight">
							<?php 
								if($row['p_grd_tmt']=="0000-00-00"){$grd_tmt = '00-00-0000';}
								else{$grd_tmt = mdate($datestring,strtotime($row['p_grd_tmt']));}
								$tmt = array(
									'name' => 'tmt',
									'id'   => 'tmt',
									'class'=> 'maskDate',
									'style'=> 'width:30%',
									'value'=> $grd_tmt
								);
								echo form_input($tmt); 
							?>
							<br/>
						</div>
						<div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Keterangan :</label>
						<div class="formRight">
							<?php echo form_textarea('keterangan',$row['p_grd_keterangan']); ?>
						</div>
						<div class="clear"></div>
                    </div>
				</fieldset>
				<div class="clear"></div>
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

</div>