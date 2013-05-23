<?php $this->load->helper('asset'); ?>
<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" />
          <h6>DATA GAJI <?php // echo $unitshow; ?></h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead >
                    <tr>
                    	<td >NO</td>
                    	<td >Nama</td>
                        <td >NIPP </td>
                        <td >Grade </td>
                        <td >Unit Kerja</td>
                        <td >Gaji Bruto</td>
						<td >Insentive</td>
						<td >Koreksi</td>
						<td >Pot. Pegawai</td>
						<td >Pot. Perusahaan</td>
						<td >Pembulatan</td>
						<td >Gaji Netto</td>
						<td >Action</td>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i=0;
						foreach ($showdata as $row){ $i++;
							$nett =  ($row['temp_gaji_bruto']+$row['temp_insentive']-$row['temp_pot_peg'])/100;
							$gaji_nett = ceil($nett)*100;?>
						<tr>
							<td ><?php echo $i;?></td>
							<td ><?php echo strtoupper($row['temp_nama']);?> </td>
							<td ><?php echo $row['temp_nipp'];?> </td>
							<td ><?php echo $row['temp_grade']; //echo romawi($row['temp_grade']);?></td>
							<td ><?php echo strtoupper($row['temp_jabatan']);?></td>
							<td ><?php echo $row['temp_gaji_bruto'];?></td>
							<td ><?php echo $row['temp_insentive'];?></td>
							<td ><?php echo '-';?></td>
							<td ><?php echo round($row['temp_pot_peg'],0);?></td>
							<td ><?php echo round($row['temp_pot_per'],0);?></td>
							<td ><?php echo $gaji_nett - round(($row['temp_gaji_bruto']+$row['temp_insentive']-$row['temp_pot_peg']),0);?></td>
							<td ><?php echo (int)$gaji_nett;?></td>
							<td><?php 
								echo anchor('gaji/view_detail_penggajian/'.$row['id_pgj'].'/'.$row['temp_bulan'].'/'.$row['temp_tahun'].'', 
								img(array('src'=>'images/icons/control/16/project.png','border'=>'0','alt'=>'Detail')) , 'title="Detail"' );
								echo anchor('gaji/edit_penggajian/'.$row['id_pgj'].'/'.$row['temp_bulan'].'/'.$row['temp_tahun'].'', 
								img(array('src'=>'images/icons/control/16/pencil.png','border'=>'0','alt'=>'Edit')) , 'title="Edit"' );
								?>
        					</td>
						</tr>
					<?php 	} ?>
				</tbody>
               
            </table>
			
</div>