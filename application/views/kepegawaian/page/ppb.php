<?php $this->load->helper('asset'); ?>
<div class="widget">
<?php echo form_open('pekerja/sort_tahun_pensiun/') ?>
<fieldset class="step" id="w2first">
<table><tr>
<td width="340"><div class="formBaru"><label>Tahun: &nbsp </label>
<?php $tahun = array(
		'2005' => '2005',
		'2006' => '2006',
		'2007' => '2007',
		'2008' => '2008',
		'2009' => '2009',
		'2010' => '2010',
		'2011' => '2011',
		'2012' => '2012',
		'2013' => '2013',
		'2014' => '2014',
		'2015' => '2015',
		);
	echo form_input('tahun',$tanggal);?></form>&nbsp
	</form> </div></td><td width="340px">
<div class="formBaru"><label>Jenis: &nbsp </label>
<?php $jenis = array(
		'ALL'     => 'ALL',
		'MPP'     => 'Masa Persiapan Pensiun',
		'Pensiun' => 'Pensiun',
		'PPB'     => 'Pelatihan Purna Bakti',
		);
	echo form_dropdown('jenis',$jenis, $type); ?></div></td><td width="100"><div class="formBaru">&nbsp 
	<?php $submit = array(
		'class' => 'blueB m110',
		'id'	=> 'next2',
		'value'	=> 'Sort',
		); 
	echo form_submit($submit)?></form></div></td>
	<!--<td width="440px"><div class="searchWidget"><?php echo form_open('pekerja/search_pegawai');?>
                        <input type="text" name="search"  placeholder="Enter search text..." />
                        <input type="submit" name="find" value="" class="blueB m110"/></div>
                    </form></td> --></tr>

</div></div></table></fieldset>
</div>
<div class="oneTwo"> 
<div class="searchWidget">
                    
                </div><br/>
</div>
<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Data Pegawai</h6><div style="color:red;";><h6><?php echo "$count pegawai";?></h6> </div></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>NIPP</td>
                        <td>Nama</td>
                        <td>Tempat Lahir</td>
                        <td>Tanggal Lahir</td>
                        <td>Tanggal Pensiun</td>
                        <td>Jenis Kelamin</td>
                        <td>Jabatan</td>
                        <td>Keterangan</td>
						<td>Detail</td>
                    </tr>
                </thead>
				<tfoot>
					<tr><td colspan=10><center><div class="pagination"><?php echo $this->pagination->create_links();?></div></center></td></td></tr>
				</tfoot>
				<tbody>
				<?php 
				if ($this->uri->segment(3)== NULL)
				{
					$number = 1;
				} else {
					$number = $this->uri->segment(5)+1;
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
					$datestring = "%d-%m-%Y" ;
					$tgl_lahir = mdate($datestring,strtotime($row_pegawai['peg_tgl_lahir']));
					if (($row_pegawai['p_ppb_tanggal'] == '0000-00-00')OR($row_pegawai['p_ppb_tanggal']==NULL)){$tgl_ppb = '00-00-0000';}
					else { $tgl_ppb = mdate($datestring,strtotime($row_pegawai['p_ppb_tanggal'])); }
					$detail = anchor('pekerja/get_pegawai/'.$row_pegawai['peg_nipp'],img(array('src' => 'admin/images/icons/control/16/customers.png', 'alt' => 'Detail',  'title' => 'Detail'))); 
					$edit_ppb = anchor('pekerja/edit_ppb_pegawai/'.$row_pegawai['peg_nipp'],img(array('src' => 'admin/images/icons/control/16/pencil.png', 'alt' => 'edit ppb',  'title' => 'edit ppb'))); 
					$tanggal_pensiun = tanggal_pensiun($tgl_lahir);
					?>
					<tr>
                        <td><center><?php echo $number; ?></center></td>
						<td><center><?php echo $row_pegawai['peg_nipp']; ?></center></td>
						<td><?php echo strtoupper($row_pegawai['peg_nama']); ?></td>
						<td><?php echo strtoupper($row_pegawai['peg_tmpt_lahir']); ?></td>
						<td><center><?php echo $tgl_lahir; ?></center></td>
						<td><center><?php echo $tanggal_pensiun; ?></center></td>
						<td><center><?php echo strtoupper($kelamin); ?></center></td>
						<td><center><?php echo strtoupper($row_pegawai['p_jbt_jabatan']); ?></center></td>
						<td><?php echo $tgl_ppb; 
								if($row_pegawai['p_ppb_status'] == 1){echo "<img src=".base_url()."admin/images/icons/control/16/check.png >";}
							?></td>
						<td><center><?php echo $detail." ".$edit_ppb;  ?></center></td>
                    </tr> <?php
					$number++;
				}endforeach; 
				?>
                </tbody>
            </table>
		</div>
		<?php $attr= array('target' => '_blank');
				echo anchor('pekerja/excel_data_pensiun','Export to Excel',$attr); ?>