

<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Report Data STKP <?php echo $jenis_stkp.' / '.$bulan.'-'.$year;?></h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2">NIPP</td>
                        <td rowspan="2">Nama</td>
						<td rowspan="2">Jenis</td>
                        <td rowspan="2">Rating</td>
                        <td rowspan="2">No License / STKP</td>
                        <td colspan="2">Validitas</td>
                        <td rowspan="2">Lembaga</td>
                        <td colspan="2">Tanggal Pelaksanaan</td>
						<td rowspan="2">Type STKP</td>
						<td rowspan="2">Action</td>
                    </tr>
					<tr>
						<td>Mulai</td><td>Sampai</td><td>Mulai</td><td>Sampai</td>
                    </tr>
                </thead>
                
                <tfoot>
					<tr>
                    	<td colspan=4 align="left"><?php 
								$attr= array('target' => '_blank');
								if($year == ""){$year ="ALL";}
								if($bulan == ""){$bulan ="ALL";}
								echo anchor('diklat/excel_stkp_bulanan/'.$bulan.'/'.$year.'/'.$jenis_stkp,'Export to Excel',$attr); 
								?></td>
                        <td colspan="5"><div class="pagination"><?php echo $this->pagination->create_links();?></div></td>
                        <td colspan="4" align="right">EMS 2.0.1 | developed by www.studiokami.com</td>
                   	</tr>
				</tfoot>
				
				<tbody>
				<?php 
				$datestring = "%d-%M-%Y" ;
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
					if ($row_pegawai['p_stkp_nipp'] == $nipp)
					{
						$nipp = '';
						$nama = '';
					} 
					else
					{
						$nipp = $row_pegawai['p_stkp_nipp'];
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
						$selesai = mdate($datestring,strtotime( $row_pegawai['p_stkp_selesai']));
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
					$detail = anchor('pekerja/get_stkp_selection/'.$row_pegawai['peg_nipp'],'Detail'); 
					
					if ($nipp==""){$nipp_anchor = "";} else {
						if ($this->uri->segment(3) == 'nipp'){$nipp_anchor =  anchor('diklat/detail_kompetensi/'.$nipp, $nipp); } else {$nipp_anchor =  anchor('diklat/get_stkp_selection/nipp/'.$nipp, $nipp);}}
					if ($nama==""){$nama_anchor = "";} else {$nama_anchor =  anchor('diklat/get_stkp_selection/nama/'.$nama, $nama);}
					?>
					
					<tr>
                        <td  ><center><?php echo $number; ?></center></td>
						<td  ><center><?php echo $nipp_anchor; ?></a></center></td>
						<td  ><?php echo $nama; ?></td>
						<td  ><?php echo $row_pegawai['p_stkp_jenis']; ?></td>
						<td  ><?php echo $row_pegawai['p_stkp_rating']; ?></td>
						<td  ><center><?php echo $row_pegawai['p_stkp_no_license']; ?></center></td>
						<td  ><center><?php echo $stkp_mulai; ?></center></td>
						<td  ><center><?php echo $stkp_selesai; ?></center></td>
						<td  ><center><?php echo $row_pegawai['p_stkp_lembaga']; ?></center></td>
						<td  ><center><?php echo $mulai; ?></center></td>
						<td  ><center><?php echo $selesai; ?></center></td>
						<td  ><center><?php echo $row_pegawai['p_stkp_type']; ?></center></td>
						<td  ><center></center> 
						<?php  
							if($row_pegawai['p_stkp_type'] == "RECC")
							{ 
								$add_anchor = anchor('diklat/search_pegawai/'.$row_pegawai['peg_nipp'], "add"); 
								echo $add_anchor." | ";
							}
							echo anchor('diklat/edit_stkp/'.$row_pegawai['id_peg_stkp'], 'edit');
							echo " | ";
							echo anchor('diklat/delete_stkp/'.$row_pegawai['id_peg_stkp'], 'delete');
							
						?> 
						</td>
                    </tr> 
						<?php
						$number++;;
						$nipp = $row_pegawai['peg_nipp'];
						}
						endforeach; 
						?>
                    
                </tbody>
                
                
                
            </table>
			
        </div>
		