<div class="widget">
<?php echo form_open('diklat/sort_stkp/') ?>
<fieldset class="step" id="w2first">
<table><tr><td width="350px">
<div class="formBaru"><label>Jenis STKP: &nbsp </label>
<?php $jenis_stkp = array();
		$jenis_stkp['ALL'] = 'ALL';
		foreach ($list_stkp as $row_stkp_list) :
			{
				$jenis_stkp[$row_stkp_list['stkp']] = ($row_stkp_list['stkp']);
			} endforeach; 
		echo form_dropdown('stkp',$jenis_stkp,$this->uri->segment(3));?>&nbsp </div></td><td width="410px">
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
						<td rowspan="2">Rating</td>
                        <td rowspan="2">No License / STKP</td>
                        <td colspan="2">Validitas</td>
                        <td rowspan="2">Lembaga</td>
                        <td colspan="2">Tanggal Pelaksanaan</td>
						<td rowspan="2">Jenis STKP</td>
						<td rowspan="2">Action</td>
                    </tr>
					<tr>
					<td>From</td><td>Until</td><td>From</td><td>Until</td></tr>
                </thead>
				<tfoot>
					<tr><td colspan=12><center><div class="pagination"><?php echo $this->pagination->create_links();?></div></center></td></td></tr>
				</tfoot>
				<tbody>
				<?php 
				$datestring = "%d-%m-%Y" ;
				$monthstring = "%m";
				$yearstring = "%Y";
				$nipp = '';
				$stkp = '';
				$waktu = '';
				if ($this->uri->segment(3)== NULL)
				{
					$number = 1;
				} else {
					if ($this->uri->segment(2) == 'get_stkp')
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
						$nipp = $row_pegawai['peg_nipp'];
						$nama = $row_pegawai['peg_nama'];
					}	
					if ($row_pegawai['p_stkp_pelaksanaan'] == '0000-00-00')
					{
						$mulai= '-';
					}
					else
					{
						$mulai = mdate($datestring,strtotime($row_pegawai['p_stkp_pelaksanaan']));
					}
					if ($row_pegawai['p_stkp_selesai'] == '0000-00-00')
					{
						$selesai = '-';
					}
					else
					{
						$selesai =mdate($datestring,strtotime( $row_pegawai['p_stkp_pelaksanaan']));
					}
					if ($row_pegawai['p_stkp_mulai'] == '0000-00-00')
					{
						$stkp_mulai = '-';
					}
					else
					{
						$stkp_mulai = mdate($datestring,strtotime($row_pegawai['p_stkp_mulai']));
					}
					if ($row_pegawai['p_stkp_finish'] == '0000-00-00')
					{
						$stkp_selesai = '-';
					}
					else
					{
						$stkp_selesai = mdate($datestring,strtotime($row_pegawai['p_stkp_finish']));
					}
					$color = '';
					if ((mdate($yearstring,strtotime($row_pegawai['p_stkp_finish'])) <= $year)){
						if (mdate($monthstring,strtotime($row_pegawai['p_stkp_finish']))-$month <= 4) {
							$color = 'style="background-color:#ffdfdf"';
						}
					}
					$detail = anchor('pekerja/get_pegawai/'.$row_pegawai['peg_nipp'],'Detail'); ?>
					<tr>
                        <td <?php echo $color ?>><center><?php echo $number; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $nipp; ?></center></td>
						<td <?php echo $color ?>><?php echo $nama; ?></td>
						<td <?php echo $color ?>><?php echo $row_pegawai['p_stkp_jenis']; ?></td>
						<td <?php echo $color ?>><center><?php echo $row_pegawai['p_stkp_no_license']; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $stkp_mulai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $stkp_selesai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $row_pegawai['p_stkp_lembaga']; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $mulai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $selesai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $row_pegawai['p_stkp_type']; ?></center></td>
						<td <?php echo $color ?>><center></center></td>
                    </tr> <?php
					$number++;;
					$nipp = $row_pegawai['peg_nipp'];
				}endforeach; 
				?>
                </tbody>
            </table>
			
        </div>
		<?php $attr= array('target' => '_blank');
			echo anchor('diklat/excel_stkp','Export to Excel',$attr); ?>