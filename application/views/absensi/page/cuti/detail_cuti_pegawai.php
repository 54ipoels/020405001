<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Data Cuti Pegawai</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>NIPP</td>
                        <td>Nama</td>
                        <td>Tanggal Cuti</td>
                        <td>Keterangan</td>
                    </tr>
                </thead>
				<tbody>
				<?php 
					$i = 1; 
					if($showdata !== 0 ){
						foreach ($showdata as $sd): ?>
						<tr>
							<td><center><?php echo $i++ ?></center></td>
							<td><center><?php echo $sd['peg_nipp'] ?></center></td>
							<td><center><?php echo $sd['peg_nama'] ?></center></td>
							<td><center><?php echo date('d-m-Y',strtotime($sd['cd_tanggal'])); ?></center></td>
							<td><center><?php echo $sd['cd_ket'] ?></center></td>
						</tr>
				<?php 
						endforeach; 
					}
				?>
                </tbody>
            </table>
			
        </div>