<div class="widget">
<?php echo form_open('diklat/sort_non_stkp/') ?>
<fieldset class="step" id="w2first">
<table><tr><td>
<div class="formBaru"><label>License: &nbsp </label>
<?php $stkp = array(
							'name' => 'license',
							'id'   => 'license',
							'style'=> 'width:80%',
						);
echo form_input('license');?></div><td width="410px">
<div class="formBaru"><label>Unit Kerja: &nbsp </label>
<?php $unit = array();
		$unit['ALL'] = 'ALL';
	foreach ($list_unit as $row_unit) :
		{
			$unit[$row_unit['kode_unit']] = ($row_unit['nama_unit']);
		} endforeach; 
	echo form_dropdown('unit',$unit,$this->uri->segment(4)); ?>&nbsp 
	<?php $submit = array(
		'class' => 'blueB m110',
		'id'	=> 'next2',
		'value'	=> 'Sort',
		); 
	echo form_submit($submit)?></form></div></td>
	<td width="300px"><div class="searchWidget1"><?php echo form_open('diklat/search_pegawai');?>
                        <input type="text" name="search" width="100px" placeholder="Enter search text..." />
                        <input type="submit" name="find" value="" class="blueB m110"/></div>
                    </form></td></tr>

</div></div></table></fieldset>
</div>

<div class="oneTwo"> 
</div>

<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Data Pegawai</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2">NIPP</td>
                        <td rowspan="2">Nama</td>
                        <td rowspan="2">STKP</td>
						<td rowspan="2">Rating</td>
                        <td rowspan="2">No Sertifikat</td>
                        <td colspan="2">Validitas</td>
                        <td rowspan="2">Lembaga</td>
                        <td rowspan="2">Tanggal Pelaksanaan</td>
						<td rowspan="2">Jenis STKP</td>
						<td rowspan="2">Actions</td>
                    </tr>
					<tr>
					<td>From</td><td>Until</td></tr>
                </thead>
				<tfoot>
					<tr><td colspan=11><center><div class="pagination"><?php echo $this->pagination->create_links();?></div></center></td></td></tr>
				</tfoot>
				<tbody>
				<?php 
				$datestring = "%d-%m-%Y" ;
				$nipp = '';
				if ($this->uri->segment(3)== NULL)
				{
					$number = 1;
				} else {
					if ($this->uri->segment(2) == 'get_non_stkp')
					{
						$number = $this->uri->segment(3)+1;
					} else {
						$number = $this->uri->segment(5)+1;
					}
				}
				foreach ($pegawai_with_stkp_and_unit as $row_pegawai) :
				{ 
					if ($row_pegawai['peg_nipp'] == $nipp)
					{
						$nipp = '';
						$nama = '';
					}
					else
					{
						$nipp = $row_pegawai['p_nstkp_nipp'];
						$nama = $row_pegawai['peg_nama'];
					}
					if ($row_pegawai['p_nstkp_pelaksanaan'] == '0000-00-00')
					{
						$pelaksanaan = '-';
					}
					else
					{
						$pelaksanaan = $row_pegawai['p_nstkp_pelaksanaan'];
					}
					if ($row_pegawai['p_nstkp_mulai'] == '0000-00-00')
					{
						$stkp_mulai = '-';
					}
					else
					{
						$stkp_mulai = mdate($datestring,strtotime($row_pegawai['p_nstkp_mulai']));
					}
					if ($row_pegawai['p_nstkp_finish'] == '0000-00-00')
					{
						$stkp_selesai = '-';
					}
					else
					{
						$stkp_selesai = mdate($datestring,strtotime($row_pegawai['p_nstkp_finish']));
					}
					
					$detail = anchor('pekerja/get_pegawai/'.$row_pegawai['peg_nipp'],'Detail'); ?>
					<tr>
                        <td><center><?php echo $number; ?></center></td>
						<td><center><?php echo $nipp; ?></center></td>
						<td><?php echo $nama; ?></td>
						<td><?php echo $row_pegawai['p_nstkp_jenis']; ?></td>
						<td><center><?php echo $row_pegawai['p_nstkp_rating']; ?></center></td>
						<td><center><?php echo $row_pegawai['p_nstkp_no_license']; ?></center></td>
						<td><center><?php echo $stkp_mulai; ?></center></td>
						<td><center><?php echo $stkp_selesai; ?></center></td>
						<td><center><?php echo $row_pegawai['p_nstkp_lembaga']; ?></center></td>
						<td><center><?php echo $pelaksanaan; ?></center></td>
						<td><center><?php echo $row_pegawai['p_nstkp_type']; ?></center></td>
						<td><center><?php echo anchor('diklat/edit_non_stkp/'.$row_pegawai['id_peg_non_stkp'], 'edit');
										echo " | ";
										echo anchor('diklat/delete_non_stkp/'.$row_pegawai['id_peg_non_stkp'], 'delete'); ?>
							</center></td>
                    </tr> <?php
					$number++;
					$nipp = $row_pegawai['peg_nipp'];
				}endforeach; 
				?>
                </tbody>
            </table>
			
        </div>
		<?php $attr= array('target' => '_blank');
			echo anchor('diklat/excel_non_stkp','Export to Excel',$attr); ?>