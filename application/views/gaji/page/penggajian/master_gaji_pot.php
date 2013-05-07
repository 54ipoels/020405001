<br /><?php echo anchor('gaji/add_master_gaji_potongan', img(array('src'=>'images/icons/control/32/plus.png','border'=>'0','alt'=>'ADD')), 'title="ADD"' ); ?>
<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Data Master Potongan Gaji</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td rowspan="2">No</td>
                        <td colspan="4">Potongan Pegawai </td>
                        <td colspan="6">Potongan Perusahaan</td>
					   
                    </tr>
					<tr>
                        <td>Siperkasa</td>
                        <td>JHT</td>
                        <td>THT</td>
                        <td>Pensiun</td>
						<td>Pensiun</td>
						<td>THT</td>
						<td>JHT</td>
						<td>JK</td>
						<td>JKK</td>
						<td>Asuransi Jiwa</td>
					</tr>
                </thead>
				<tbody>
				<?php $i = 1 ?>
   				<?php foreach ($showdata as $sd): ?>
					<tr>
                        <td><center><?php echo $i++ ?></center></td>
						<td><?php echo $sd['peg_siperkasa']; ?></td>
						<td><?php echo $sd['peg_jht'] ?></td>
						<td><?php echo $sd['peg_tht'] ?></td>
						<td><?php echo $sd['peg_pensiun'] ?></td>
						<td><?php echo $sd['per_pensiun'] ?></td>
						<td><?php echo $sd['per_tht'] ?></td>
						<td><?php echo $sd['per_jht'] ?></td>
						<td><?php echo $sd['per_jk'] ?></td>
						<td><?php echo $sd['per_jkk'] ?></td>
						<td><?php echo $sd['per_as_jiwa'] ?></td>
						
                    </tr>
				<?php endforeach ?>
                </tbody>
            </table>
			
        </div>