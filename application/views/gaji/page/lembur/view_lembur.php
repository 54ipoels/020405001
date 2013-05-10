<?php $this->load->helper('asset'); ?>
<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" />
          <h6>DATA LEMBUR&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;UNIT <?php // echo $unitshow; ?></h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead >
                    <tr>
                    	<td rowspan="2">NO</td>
                        <td rowspan="2">NIPP </td>
                        <td rowspan="2">JHK</td>
						<td colspan="2" >Jam Lembur</td>
						<td >Ex-Vo</td>
						<td >Shift</td>
						<td rowspan="2">Koreksi</td>
						<td rowspan="2">STKP</td>
						<td rowspan="2">U.Apresiasi</td>
                    	<td rowspan="2">Penerimaan</td>
                    	<td rowspan="2">Action</td>
                    </tr>
					<tr>
						<td>HK</td>
						<td>HL</td>
						<td>@</td>
						<td>@</td>
					</tr>
                </thead>
				<tbody>
					<?php 
						$i=0;
						foreach ($showdata as $row){ $i++;	?>
						<tr>
							<td ><?php echo $i;?></td>
							<td ><?php echo $row['peg_nipp'];?> </td>
							<td ><?php echo $row['lmb_jml_hr_kerja'];?></td>
							<td ><?php echo $row['lmb_hari_kerja'];?></td>
							<td ><?php echo $row['lmb_hari_libur'];?></td>
							<td ><?php echo $row['lmb_ex_voed'];?></td>
							<td ><?php echo $row['lmb_shift_all'];?></td>
							<td ><?php echo $row['lmb_koreksi'];?></td>
							<td ><?php echo $row['lmb_tunj_stkp'];?></td>
							<td ><?php echo $row['lmb_apresiasi'];?></td>
							<td ><?php $penerimaan = $row['lmb_hari_kerja'] + $row['lmb_hari_libur'] + $row['lmb_ex_voed'] + $row['lmb_shift_all'] - $row['lmb_potongan'] + $row['lmb_apresiasi'] + $row['lmb_koreksi'] + $row['lmb_natura'];
									echo $penerimaan;
							?>
							</td>
							<td><?php 
								echo anchor('gaji/view_detail_lembur/'.$row['id_lembur'].'/'.$row['lmb_bulan'].'/'.$year.'', 
								img(array('src'=>'images/icons/control/16/project.png','border'=>'0','alt'=>'Detail')) , 'title="Detail"' );
								echo anchor('gaji/edit_lembur/'.$row['id_lembur'].'/'.$row['lmb_bulan'].'/'.$year.'', 
								img(array('src'=>'images/icons/control/16/pencil.png','border'=>'0','alt'=>'Edit')) , 'title="Edit"' );
								?>
        					</td>
						</tr>
					<?php 	} ?>
				</tbody>
               
            </table>
			
</div>