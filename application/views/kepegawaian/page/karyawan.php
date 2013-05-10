<div class="widget">
<?php echo form_open('pekerja/sort_jenis_pegawai/') ?>
<fieldset class="step" id="w2first">
<table><tr><td width="440px">
<div class="formBaru"><label>Jenis Pegawai: &nbsp </label>
<?php $jenis = array(
		'all' => 'ALL',
		'Tetap' => 'TETAP',
		'PKWT' => 'PKWT',
		'Outsource' => 'Outsource',
		);
	echo form_dropdown('jenis',$jenis, 'ALL') ?></form>&nbsp
	<?php $submit = array(
		'class' => 'blueB m110',
		'id'	=> 'next2',
		'value'	=> 'Sort',
		);
	echo form_submit($submit)?></form></div></td><td width="410px"><?php echo form_open('pekerja/sort_unit_pegawai/'); ?>
<div class="formBaru"><label>Unit Kerja: &nbsp </label>
<?php $unit = array();
	foreach ($list_unit as $row_unit) :
		{
			$unit[$row_unit['kode_unit']] = ($row_unit['nama_unit']);
		} endforeach; 
	echo form_dropdown('unit',$unit); ?></form>&nbsp 
	<?php $submit = array(
		'class' => 'blueB m110',
		'id'	=> 'next2',
		'value'	=> 'Sort',
		); 
	echo form_submit($submit)?></form></div></td>
	<td width="250px"><div class="searchWidget1"><?php echo form_open('pekerja/search_pegawai');?>
                        <input type="text" name="search"  placeholder="Enter search text..." />
                        <input type="submit" name="find" value="" class="blueB m110"/></div>
                    </form></td></tr>

</div></div></table></fieldset>
</div>
<div class="oneTwo"> 
<div class="searchWidget">
                    
                </div><br/>
</div>
<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Data Pegawai  </h6><div style="color:red;";><h6><?php echo "$count row(s)";?></h6> </div></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>NIPP</td>
                        <td>Nama</td>
                        <td>Tempat Lahir</td>
                        <td>Tanggal Lahir</td>
                        <td>Jenis Kelamin</td>
                        <td>Golongan Darah</td>
                        <td>Detail</td>
                    </tr>
                </thead>
				<tfoot>
					<tr><td colspan=8><center><div class="pagination"><?php echo $this->pagination->create_links();?></div></center></td></td></tr>
				</tfoot>
				<tbody>
				<?php 
				if ($this->uri->segment(3)== NULL)
				{
					$number = 1;
				} else {
					if($this->uri->segment(2) == 'sort_unit_pegawai') {$number = $this->uri->segment(4)+1;} else {
					$number = $this->uri->segment(3)+1;}
				}
				foreach ($pegawai as $row_pegawai) :
				{ 
					if ($row_pegawai['peg_jns_kelamin'] == 'P')
					{
						$kelamin = 'Perempuan';
					}
					else
					{
						$kelamin = 'Laki Laki';
					}
					if ($row_pegawai['peg_gol_darah'] == NULL)
					{
						$gol_darah = '-';
					}
					else
					{
						$gol_darah = $row_pegawai['peg_gol_darah'];
					}
					$datestring = "%d-%m-%Y" ;
					$tgl_lahir = mdate($datestring,strtotime($row_pegawai['peg_tgl_lahir']));
					$detail = anchor('pekerja/get_pegawai/'.$row_pegawai['peg_nipp'],'Detail');  ?>
					<tr>
                        <td><center><?php echo $number; ?></center></td>
						<td><center><?php echo $row_pegawai['peg_nipp']; ?></center></td>
						<td><?php echo strtoupper($row_pegawai['peg_nama']); ?></td>
						<td><?php echo strtoupper($row_pegawai['peg_tmpt_lahir']); ?></td>
						<td><center><?php echo $tgl_lahir; ?></center></td>
						<td><center><?php echo strtoupper($kelamin); ?></center></td>
						<td><center><?php echo $gol_darah; ?></center></td>
						<td><center><?php echo $detail ?></center></td>
                    </tr> <?php
					$number++;
				}endforeach; 
				?>
                </tbody>
            </table>
			
        </div>
		<?php $attr= array('target' => '_blank');
			echo anchor('pekerja/excel_data_pegawai','Export to Excel',$attr); ?>