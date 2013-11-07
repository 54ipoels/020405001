

<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Report Data Non STKP <?php echo $training.' / '.$bulan.'-'.$year;?></h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2">Training</td>
                        <td colspan="2">Pelaksanaan</td>
                        <td rowspan="2">Lembaga</td>
						<td rowspan="2">Jumlah</td>
                    </tr>
					<tr>
					<td>From</td><td>Until</td></tr>
                </thead> 
				<tfoot>
					<tr>
                    	<td colspan="2" align="left">
							<?php 
								$attr= array('target' => '_blank');
								if($year == ""){$year ="ALL";}
								if($bulan == ""){$bulan ="ALL";}
								echo anchor('diklat/excel_rekap_non_stkp_bulanan/'.$bulan.'/'.$year.'/'.$url_training,'Export to Excel',$attr);
						 	?>
                       	</td>
                        <td colspan="2"><div class="pagination"><?php echo $this->pagination->create_links();?></div></td>
                        <td colspan="2" align="right">EMS 2.0.1 | developed by www.studiokami.com</td>
                   	</tr>
				</tfoot>
				<tbody>
				<?php 
				$datestring = "%d-%M-%Y" ;
				$nipp = '';
				$number = 0;
				foreach ($pegawai_with_stkp_and_unit as $row_pegawai) :
				{ 
					$number++;
					if ($row_pegawai['p_nstkp_jenis'] == ""){$jenis_anchor = "";} else {$jenis_anchor = anchor('diklat/get_nstkp_selection/jenis/'.$row_pegawai['p_nstkp_jenis'], 	$row_pegawai['p_nstkp_jenis']);}
					if ($row_pegawai['p_nstkp_lembaga'] == ""){$lembaga_anchor = "";} else {$lembaga_anchor = anchor('diklat/get_nstkp_selection/lembaga/'.$row_pegawai['p_nstkp_lembaga'], $row_pegawai['p_nstkp_lembaga']);}
					if ($row_pegawai['p_nstkp_selesai'] == '0000-00-00')
					{
						$selesai = '-';
					}
					else
					{
						$selesai =mdate($datestring,strtotime( $row_pegawai['p_nstkp_selesai']));
					}
					if ($row_pegawai['p_nstkp_pelaksanaan'] == '0000-00-00')
					{
						$mulai = '-';
					}else
					{
						$mulai = mdate($datestring,strtotime($row_pegawai['p_nstkp_pelaksanaan']));
					}
					
					?>
					<tr>
                     	<td><center><?php echo $number; ?></center></td>
						<td><?php echo $row_pegawai['p_nstkp_jenis']; ?></td>
						<td><center><?php echo $mulai; ?></center></td>
						<td><center><?php echo $selesai; ?></center></td>
						<td><center><?php echo $row_pegawai['p_nstkp_lembaga']; ?></center></td>
						<td><center><?php echo $row_pegawai['jumlah']; ?></center></td>
                    </tr> <?php
					
				}endforeach; 
				?>
                </tbody>
            </table>
			
        </div>
		