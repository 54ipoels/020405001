
<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Jabatan Pegawai</h6></div>
			<?php
			$datestring = "%d-%m-%Y" ;
			
			if($ppb == 0){
				$tanggal = "00-00-0000";
				$status_ppb = 0;
			} else {
				foreach($ppb as $row_ppb){
					if($row_ppb['p_ppb_tanggal'] == '0000-00-00'){$tanggal = "00-00-0000";}
					else {$tanggal = mdate($datestring,strtotime($row_ppb['p_ppb_tanggal']));}
					$status_ppb = $row_ppb['p_ppb_status'];
				}
			}
					
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/submit_ppb_pegawai/'.$this->uri->segment(3), $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1>Edit Status PPB</h1>
                    <div class="formRow">
                        <label>NIPP :</label>
                        <div class="formRight"><?php 
						$nipp_form = array(
							'nipp'=> $nipp
						);
						echo form_hidden($nipp_form);
						echo $nipp;?></div>
                        <div class="clear"></div>
                    </div>
				
					<div class="formRow">
                        <label>Tanggal PPB :</label>
                        <div class="formRight"><?php 
						$tanggal = array(
							'name' => 'tanggal',
							'id'   => 'tanggal',
							'style'=> 'width:30%',
							'class'=> 'maskDate',
							'value'=> $tanggal
						);
						echo form_input($tanggal)." <br> ";
						if($status_ppb == 1){
							echo form_checkbox('status_ppb', '1', TRUE)." OK"; 
						} else {
							echo form_checkbox('status_ppb', '1', FALSE)." OK"; 
						}
						?><br/>
						<?php echo form_error('tanggal')?></div>
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
			<?php echo form_close();?>
			<div class="data" id="w2"></div>
        </div>
</div>
