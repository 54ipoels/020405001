<?php $this->load->helper('asset'); ?>
<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" />
          <h6>DATA GAJI <?php // echo $unitshow; ?></h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead >
                    <tr>
                    	<td >NO</td>
                        <td >NIPP </td>
                        <td >Gaji Bruto</td>
						<td >Masa Bakti</td>
						<td >Koreksi</td>
						<td >Insentive</td>
						<td >Potongan</td>
						<td >Pembulatan</td>
						<td >Terima</td>
						<td >Action</td>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=0;
						foreach ($showdata as $row){ $i++;
							$terima = $row['pgj_gaji_bruto'] + $row['pgj_pembulatan'] + $row['pgj_pembulatan'] + $row['pgj_koreksi'] + $row['pgj_insentive'] - $row['pgj_potongan'] ; 
					?>
						<tr>
							<td ><?php echo $i;?></td>
							<td ><?php echo $row['peg_nipp'];?> </td>
							<td ><?php echo $row['pgj_gaji_bruto'];?></td>
							<td ><?php echo $row['pgj_masa_bakti'];?></td>
							<td ><?php echo $row['pgj_koreksi'];?></td>
							<td ><?php echo $row['pgj_insentive'];?></td>
							<td ><?php echo $row['pgj_potongan'];?></td>
							<td ><?php echo $row['pgj_pembulatan'];?></td>
							<td ><?php echo number_format($row['pgj_terima'],0,'.',',');?></td>
							<td><?php 
								echo anchor('c_absensi/view_detail_penggajian/'.$row['id_pgj'].'/'.$row['pgj_bulan'].'/'.$row['pgj_tahun'].'', 
								img(array('src'=>'images/icons/control/16/project.png','border'=>'0','alt'=>'Detail')) , 'title="Detail"' );
								echo anchor('c_absensi/edit_penggajian/'.$row['id_pgj'].'/'.$row['pgj_bulan'].'/'.$row['pgj_tahun'].'', 
								img(array('src'=>'images/icons/control/16/pencil.png','border'=>'0','alt'=>'Edit')) , 'title="Edit"' );
								?>
        					</td>
						</tr>
					<?php 	} ?>
				</tbody>
               
            </table>
			
</div>