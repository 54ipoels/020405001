
<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Data Pegawai</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>NIPP</td>
                        <td>Nama</td>
                        <td>Tempat Lahir</td>
                        <td>Tanggal Lahir</td>
                        <td>Umur</td>
                        <td>Jenis Kelamin</td>
                        <td>Status</td>
                        <td>Status Kawin</td>
                        <td>Alamat</td>
                        <td>Telp</td>
                        <td>Agama</td>
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
					$yearstring = '%Y';
					$umur = mdate($yearstring,now()) - mdate($yearstring, strtotime($row_pegawai['peg_tgl_lahir']));
					$umur_ps = mdate($yearstring,now()) - mdate($yearstring, strtotime($row_pegawai['p_ps_tgl_lahir']));
					$datestring = "%d-%m-%Y" ;
					$tgl_lahir = mdate($datestring,strtotime($row_pegawai['peg_tgl_lahir']));
					$tgl_lahir_ps = mdate($datestring,strtotime($row_pegawai['p_ps_tgl_lahir']));
					if ($row_pegawai['peg_jns_kelamin'] == 'L')
					{
						$status_ps = 'ISTERI';
					} else 
					{
						$status_ps = 'SUAMI';
					}
					if ($row_pegawai['p_stk_status_keluarga'] != 'TK')
					{
						$rowspan = (int)substr($row_pegawai['p_stk_status_keluarga'],-1)+2;
					}
					$detail = anchor('pekerja/get_pegawai/'.$row_pegawai['peg_nipp'],'Detail');  ?>
					<tr>
                        <td rowspan="<?php echo $rowspan;?>"><center><?php echo $number; ?></center></td>
						<td rowspan="<?php echo $rowspan;?>"><center><?php echo $row_pegawai['peg_nipp']; ?></center></td>
						<td><?php echo strtoupper($row_pegawai['peg_nama']); ?></td>
						<td><?php echo strtoupper($row_pegawai['peg_tmpt_lahir']); ?></td>
						<td><center><?php echo $tgl_lahir; ?></center></td>
						<td><center><?php echo $umur; ?></td>
						<td><center><?php echo strtoupper($row_pegawai['peg_jns_kelamin']); ?></td>
						<td><center><?php echo 'PEGAWAI'; ?></td>
						<td><center><?php echo strtoupper($row_pegawai['p_stk_status_keluarga']); ?></center></td>
						<td><center></center></td>
						<td><center><?php echo $detail ?></center></td>
                    </tr>
					<?php if ($row_pegawai['p_stk_status_keluarga'] != 'TK')
					{?>
					<tr>
						<td><?php echo strtoupper($row_pegawai['p_ps_nama']); ?></td>
						<td><?php echo strtoupper($row_pegawai['p_ps_tmpt_lahir']); ?></td>
						<td><center><?php echo $tgl_lahir_ps; ?></center></td>
						<td><center><?php echo $umur_ps; ?></td>
						<td><center><?php echo strtoupper($row_pegawai['peg_jns_kelamin']); ?></td>
						<td><center><?php echo $status_ps; ?></td>
						<td><center><?php echo strtoupper($row_pegawai['p_stk_status_keluarga']); ?></center></td>
						<td><center></center></td>
						<td><center><?php echo $detail ?></center></td>
                    </tr> <?php
					for ($anak = 1; $anak <= $rowspan-2; $anak++)
					{ ?>
						<tr>
						<td><?php echo strtoupper($row_pegawai['p_ps_nama']); ?></td>
						<td><?php echo strtoupper($row_pegawai['p_ps_tmpt_lahir']); ?></td>
						<td><center><?php echo $tgl_lahir_ps; ?></center></td>
						<td><center><?php echo $umur_ps; ?></td>
						<td><center><?php echo strtoupper($row_pegawai['peg_jns_kelamin']); ?></td>
						<td><center><?php echo $status_ps; ?></td>
						<td><center><?php echo strtoupper($row_pegawai['p_stk_status_keluarga']); ?></center></td>
						<td><center></center></td>
						<td><center><?php echo $detail ?></center></td>
                    </tr>
					<?php }
					}
					$number++;
				}endforeach; 
				?>
                </tbody>
            </table>
			
        </div>
		<?php $attr= array('target' => '_blank');
			echo anchor('pekerja/excel_data_pegawai','Export to Excel',$attr); ?>