<div class="widget">
<fieldset class="step" id="w2first"><br> 
<table><tr><td width = "770px"> </td>
	<td width="250px"><div class="searchWidget1"><?php echo form_open('pekerja/search_phk');?>
                        <input type="text" name="search"  placeholder="Enter search text..." />
                        <input type="submit" name="find" value="" class="blueB m110"/></div>
                    </form></td></tr>

</div></div></table></fieldset>
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
                        <td>Jenis Kelamin</td>
                        <td>T.M.T.</td>
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
					$number = $this->uri->segment(5)+1;
				}
				foreach ($phk as $row_phk) :
				{ 
					if ($row_phk['peg_jns_kelamin'] == 'P')
					{
						$kelamin = 'Perempuan';
					}
					else
					{
						$kelamin = 'Laki Laki';
					}
					$datestring = "%d-%m-%Y" ;
					$tgl_lahir = mdate($datestring,strtotime($row_phk['peg_tgl_lahir']));
					$detail = anchor('pekerja/get_pegawai/'.$row_phk['peg_nipp'],'Detail'); ?>
					<tr>
                        <td><center><?php echo $number; ?></center></td>
						<td><center><?php echo $row_phk['peg_nipp']; ?></center></td>
						<td><?php echo strtoupper($row_phk['peg_nama']); ?></td>
						<td><?php echo strtoupper($row_phk['peg_tmpt_lahir']); ?></td>
						<td><center><?php echo $tgl_lahir; ?></center></td>
						<td><center><?php echo strtoupper($kelamin); ?></center></td>
						<td><center><?php echo mdate($datestring,strtotime($row_phk['p_tmt_end'])); ?></center></td>
						<td><center><?php echo $detail ?></center></td>
                    </tr> <?php
					$number++;
				}endforeach; 
				?>
                </tbody>
            </table>
		</div>
		<?php $attr= array('target' => '_blank');
				//echo anchor('pekerja/excel_data_pensiun','Export to Excel',$attr); ?>