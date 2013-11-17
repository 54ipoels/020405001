<div class="twoOne">
<div class="widget"> 
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Rekapitulasi Pegawai</h6></div>
<fieldset class="step" id="w2first">
<?php echo form_open('pekerja/excel_rekapitulasi_pegawai'); ?>
<table>
<tr><td width="350px">
<div class="formBaru"><label> &nbsp </label>
<?php
	$jenis = array(
		'' => 'jenis pegawai',
		'Tetap' => 'TETAP',
		'PKWT' => 'PKWT',
		'Outsource' => 'Outsource',
		);
	echo form_dropdown('jenis',$jenis) ;
	
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
</table></fieldset>
<?php echo form_close();?>
</div>
</div>