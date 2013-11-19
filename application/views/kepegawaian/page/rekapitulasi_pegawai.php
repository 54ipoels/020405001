<div class="twoOne">
<div class="widget"> 
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Rekapitulasi Pegawai</h6></div>
<fieldset class="step" id="w2first">
<?php echo form_open('pekerja/rekapitulasi_pegawai'); ?>
<table>

<tr><td width="350px">
<div class="formBaru"><label> &nbsp </label>
<?php
	$jenis = array(
		'ALL' => 'jenis pegawai',
		'Tetap' => 'TETAP',
		'PKWT' => 'PKWT',
		'Outsource' => 'Outsource',
		);
	echo form_dropdown('jenis',$jenis,$jenispegawai) ;
	
	?>
	</div></td>
	<td><div class="formBaru"><label> &nbsp </label>
	<?php $submit = array(
			'class' => 'blueB m110',
			'id'	=> 'next2',
			'value'	=> 'Export',
			);
		echo form_submit($submit);?>
		</div>
	</td>
</tr>

<tr>
<td colspan="2">
	<?php  if($jenispegawai != "ALL"){ ?>
	<table>
	<tr>
		<td>
		<?php
		$attribut="target='_blank'";
		echo anchor('pekerja/excel_rekapitulasi_pegawai/'.$jenispegawai,"  <input type='button'  value='Data Pegawai' title='Excel Rekapitulasi Pegawai'>",$attribut);
		?>
		</td>
		<td>
		<?php
		echo anchor('pekerja/excel_rekapitulasi_jumlah_pegawai/'.$jenispegawai,"<input type='button'  value='Jumlah SDM' title='Rekapitulasi Jumlah SDM'>",$attribut);
		?>
		</td>
		<td>
		<?php
		echo anchor('pekerja/excel_rekapitulasi_jumlah_pegawai_jenis_kelamin/'.$jenispegawai,"<input type='button'  value='Jumlah SDM II' title='Rekapitulasi Jumlah SDM Berdasarkan Jenis Kelamin'>",$attribut);
		?>
		</td>
	</tr>
	</table>
	<?php 	}	 ?>
</td>
</tr>
</table>
<?php echo form_close();?>
</fieldset>
</div>
</div>