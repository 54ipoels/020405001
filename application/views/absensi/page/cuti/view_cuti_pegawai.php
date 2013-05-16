<br /><?php echo anchor('c_absensi/cuti_add', img(array('src'=>'images/icons/control/32/plus.png','border'=>'0','alt'=>'ADD')), 'title="ADD"' ); ?>
<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Data Cuti Pegawai</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>NIPP</td>
                        <td>Masa Berlaku</td>
                        <td>Total Cuti</td>
                        <td>Cuti Terpakai</td>
                        <td>Action</td>
                    </tr>
                </thead>
				<tbody>
				<?php $i = 1 ?>
   				<?php foreach ($showdata as $sd): ?>
					<tr>
                        <td><center><?php echo $i++ ?></center></td>
						<td><center><?php echo $sd['peg_nipp'] ?></center></td>
						<td><center><?php echo $sd['cm_year'] ?></center></td>
						<td><center><?php echo $sd['cm_total'] ?></center></td>
						<td><center><?php echo anchor('c_absensi/detail_cuti_pegawai/'.$sd['cm_id'].'/'.$year.'',$sd['cm_penggunaan']); ?></center></td>
						<td>
						<?php echo anchor('c_absensi/edit_cuti/'.$sd['cm_id'].'/'.$unit.'/'.$year.'', 
						img(array('src'=>'images/icons/color/pencil.png','border'=>'0','alt'=>'Edit')), 'title="Edit"' ); ?>
                        <?php echo " "; ?>
        				<?php echo anchor('c_absensi/del_cuti/'.$sd['cm_id'].'/'.$unit.'/'.$year.'', 
						img(array('src'=>'images/icons/color/cross.png','border'=>'0','alt'=>'Delete')), 'title="Delete"' ); ?>
        				</td>
                    </tr>
				<?php endforeach ?>
                </tbody>
            </table>
			
        </div>