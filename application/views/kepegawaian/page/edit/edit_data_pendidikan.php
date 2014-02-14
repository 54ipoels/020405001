<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Pendidikan Pegawai</h6></div>
			<?php 
			$row_pendidikan['p_pdd_tingkat'] = "" ;
			$row_pendidikan['p_pdd_lp'] = "";
			$row_pendidikan['p_pdd_masuk'] = "";
			$row_pendidikan['p_pdd_keluar'] = "";
			
			foreach ($pendidikan as $row_pendidikan) : 
			{} endforeach;
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/edit_data_pendidikan/'.$this->uri->segment(3), $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1>Edit Data Pendidikan</h1>
                    <div class="formRow">
                        <label>Pendidikan Terakhir:</label>
                        <div class="formRight"><?php 
						$pendidikan = array(
							'name' => 'pendidikan',
							'id'   => 'pendidikan',
							'value'=> $row_pendidikan['p_pdd_tingkat']
						);
						echo form_input($pendidikan) ?><br/>
						<?php echo form_error('pendidikan')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Lembaga Pendidikan:</label>
                        <div class="formRight"><?php 
						$lp = array(
							'name' => 'lp',
							'id'   => 'lp',
							'value'=> $row_pendidikan['p_pdd_lp']
						);
						echo form_input($lp) ?><br/>
						<?php echo form_error('lp')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tahun:</label>
                        <div class="formRight"><?php 
						$masuk = array(
							'name' => 'masuk',
							'id'   => 'masuk',
							'style'=> 'width: 41%',
							'value'=> $row_pendidikan['p_pdd_masuk']
						);
						echo form_input($masuk) ?>&nbsp s/d &nbsp<?php 
						$keluar = array(
							'name' => 'keluar',
							'id'   => 'keluar',
							'style'=> 'width: 41%',
							'value'=> $row_pendidikan['p_pdd_keluar']
						);
						echo form_input($keluar) ?><br/>
						<?php echo form_error('tgl_lahir')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Bahasa yang Dikuasai:</label>
                        <div class="formRight"><?php 
						$nomer = 1;
						foreach ($bahasa as $row_bahasa) :
						{
							$bahasa = array(
								'name' => 'bahasa'.$nomer,
								'id'   => 'bahasa'.$nomer,
								'value'=> $row_bahasa['p_bhs_bahasa']
							);
							echo form_input($bahasa) ; 
							$nomer++;
						} endforeach;?></div>
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