<div class = "oneTwo">
	<div class="widget">
            <div class="title"><img src="<?php echo base_url()?>images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Data Pribadi Pegawai</h6></div>
			<?php 
			$datestring = "%d-%m-%Y" ;
			
			$nama_ayah = "";
			$tempat_ayah = "";
			$tgl_ayah = "";
			$meninggal_ayah = "";
			$almt_ayah = "";
			$kerja_ayah = "";
			foreach ($ayah as $row_ayah) : 
			{
				$nama_ayah = $row_ayah['p_ay_nama'];
				$tempat_ayah = $row_ayah['p_ay_tmpt_lahir'];
				$tgl_ayah = $row_ayah['p_ay_tgl_lahir'];
				$meninggal_ayah = $row_ayah['p_ay_tgl_meninggal'];
				$almt_ayah = $row_ayah['p_ay_alamat'];
				$kerja_ayah = $row_ayah['p_ay_pekerjaan'];
			} endforeach;
			
			if (($tgl_ayah=="")  OR  ($tgl_ayah=="0000-00-00")){$tgl_ayah = "00-00-0000";}
			else {$tgl_ayah = mdate($datestring, strtotime($row_ayah['p_ay_tgl_lahir']));}
			if (($meninggal_ayah=="")  OR  ($meninggal_ayah=="0000-00-00")){$meninggal_ayah = "00-00-0000";}
			else {$meninggal_ayah = mdate($datestring, strtotime($row_ayah['p_ay_tgl_meninggal']));}
			
				
			$nama_ibu = "";
			$tempat_ibu = "";
			$tgl_ibu = "";
			$meninggal_ibu = "";
			$almt_ibu = "";
			$kerja_ibu = "";
			foreach ($ibu as $row_ibu) : 
			{
				$nama_ibu = $row_ibu['p_ibu_nama'];
				$tempat_ibu = $row_ibu['p_ibu_tmpt_lahir'];
				$tgl_ibu = $row_ibu['p_ibu_tgl_lahir'];
				$meninggal_ibu = $row_ibu['p_ibu_tgl_meninggal'];
				$almt_ibu = $row_ibu['p_ibu_alamat'];
				$kerja_ibu = $row_ibu['p_ibu_pekerjaan'];
			} endforeach;
			
			if (($tgl_ibu=="")  OR  ($tgl_ibu=="0000-00-00")){$tgl_ibu = "00-00-0000";}
			else {$tgl_ibu = mdate($datestring, strtotime($row_ibu['p_ibu_tgl_lahir']));}
			if (($meninggal_ibu=="")  OR  ($meninggal_ibu=="0000-00-00")){$meninggal_ibu = "00-00-0000";}
			else {$meninggal_ibu = mdate($datestring, strtotime($row_ibu['p_ibu_tgl_meninggal']));}
			
			/*foreach ($ibu as $row_ibu) : 
			{} endforeach;
			*/
			$attributes = array('class'=>'form','id'=>'wizard3');
			echo form_open('pekerja/edit_data_ortu/'.$this->uri->segment(3), $attributes) ?>
                <fieldset class="step" id="w2first">
                    <h1>Edit Data Orang Tua - Ayah</h1>
                    <div class="formRow">
                        <label>Nama:</label>
                        <div class="formRight"><?php
						$nama = array(
							'name' => 'nama_ayah',
							'id'   => 'nama_ayah',
							'value'=> $nama_ayah
						);
						echo form_input($nama) ?><br/>
						<?php echo form_error('nama')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Tempat Lahir:</label>
                        <div class="formRight"><?php 
						$tempat = array(
							'name' => 'tempat_ayah',
							'id'   => 'tempat_ayah',
							'value'=> $tempat_ayah
						);
						echo form_input($tempat) ?><br/>
						<?php echo form_error('tempat')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Lahir:</label>
                        <div class="formRight"><?php 
						$tgl_lahir = array(
							'name' => 'tgl_ayah',
							'id'   => 'tgl_ayah',
							'class'=> 'maskDate',
							'style'=> 'width:20%',
							'value'=> $tgl_ayah
						);
						echo form_input($tgl_lahir) ?><br/>
						<?php echo form_error('tgl_lahir')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Meninggal:</label>
                        <div class="formRight"><?php 
						$tgl_meninggal = array(
							'name' => 'meninggal_ayah',
							'id'   => 'meninggal_ayah',
							'class'=> 'maskDate',
							'style'=> 'width:20%',
							'value'=> $meninggal_ayah
						);
						echo form_input($tgl_meninggal) ?><br/>
						<?php echo form_error('tgl_meninggal')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Alamat:</label>
                        <div class="formRight"><?php 
						$alamat = array(
							'name' => 'almt_ayah',
							'id'   => 'almt_ayah',
							'value'=> $almt_ayah
						);
						echo form_input($alamat) ?><br/>
						<?php echo form_error('alamat')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pekerjaan:</label>
                        <div class="formRight"><?php 
						$pekerjaan = array(
							'name' => 'kerja_ayah',
							'id'   => 'kerja_ayah',
							'value'=> $kerja_ayah
						);
						echo form_input($pekerjaan) ?><br/>
						<?php echo form_error('pekerjaan')?></div>
                        <div class="clear"></div>
                    </div>
                </fieldset>
				<fieldset id="w2confirmation" class="step">
                    <h1>Edit Data Orang Tua - Ibu</h1>
                    <div class="formRow">
                        <label>Nama:</label>
                        <div class="formRight"><?php 
						$nama = array(
							'name' => 'nama_ibu',
							'id'   => 'nama_ibu',
							'value'=> $nama_ibu
						);
						echo form_input($nama) ?><br/>
						<?php echo form_error('nama')?></div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <label>Tempat Lahir:</label>
                        <div class="formRight"><?php 
						$tempat = array(
							'name' => 'tempat_ibu',
							'id'   => 'tempat_ibu',
							'value'=> $tempat_ibu
						);
						echo form_input($tempat) ?><br/>
						<?php echo form_error('tempat')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Lahir:</label>
                        <div class="formRight"><?php 
						$tgl_lahir = array(
							'name' => 'tgl_ibu',
							'id'   => 'tgl_ibu',
							'class'=> 'maskDate',
							'style'=> 'width:20%',
							'value'=> $tgl_ibu
						);
						echo form_input($tgl_lahir) ?><br/>
						<?php echo form_error('tgl_lahir')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Tanggal Meninggal:</label>
                        <div class="formRight"><?php 
						$tgl_meninggal = array(
							'name' => 'meninggal_ibu',
							'id'   => 'meninggal_ibu',
							'class'=> 'maskDate',
							'style'=> 'width:20%',
							'value'=> $meninggal_ibu
						);
						echo form_input($tgl_meninggal) ?><br/>
						<?php echo form_error('tgl_meninggal')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Alamat:</label>
                        <div class="formRight"><?php 
						$alamat = array(
							'name' => 'almt_ibu',
							'id'   => 'almt_ibu',
							'value'=> $almt_ibu
						);
						echo form_input($alamat) ?><br/>
						<?php echo form_error('alamat')?></div>
                        <div class="clear"></div>
                    </div>
					<div class="formRow">
                        <label>Pekerjaan:</label>
                        <div class="formRight"><?php 
						$pekerjaan = array(
							'name' => 'kerja_ibu',
							'id'   => 'kerja_ibu',
							'value'=> $kerja_ibu
						);
						echo form_input($pekerjaan) ?><br/>
						<?php echo form_error('pekerjaan')?></div>
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