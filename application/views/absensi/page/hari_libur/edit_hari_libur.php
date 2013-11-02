<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Hari Libur</h6></div>
			<?php 
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('c_absensi/submit_hari_libur', $attributes);
			foreach ($showdata as $sd):
			echo form_hidden('lnas_id', $sd->lnas_id);
			?>
                <fieldset class="step" id="w2first">
                    <h1>Edit Hari Libur</h1>
                    <div class="formRow">
                        <label>TANGGAL:<span class="req">*</span></label>
                        <div class="formRight">
						<?php 
						$lnas_date = $sd->lnas_date;
						$date = array('name' => 'lnas_date', 'id'   => 'date', 'value' =>  mdate('%d-%m-%Y',strtotime($lnas_date)), 'class'=>'maskDate');
						echo form_input($date) ?><br/>
						<?php echo form_error('date')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>DESKRIPSI:<span class="req">*</span></label>
                        <div class="formRight">
						<?php 
						$desc = array('name' => 'lnas_desc', 'id' => 'desc', 'value' => $sd->lnas_desc);
						echo form_input($desc) ?><br/>
						<?php echo form_error('desc')?></div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
				<div class="wizButtons"> 
                    <div class="status" id="status2"></div>
					<span class="wNavButtons">
                        <input class="basic" id="back2" value="Back" type="reset" />
						<?php 
						$submit = array(
							'class' => 'blueB m110',
							'value'	=> 'SIMPAN',
							'name' => 'submit_lnas_edit',
						);
						echo form_submit($submit)?>
                    </span>
				</div>
                <div class="clear"></div>
            <?php endforeach ?>
			<?php echo form_close();?>
        </div>
</div>