<br /><?php echo anchor('c_absensi/add_gaji', img(array('src'=>'images/icons/control/32/plus.png','border'=>'0','alt'=>'ADD')), 'title="ADD"' ); ?>
<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Data Hari Libur</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2">Grade</td>
                        <td colspan="2">Range Gaji</td>
						<td rowspan="2">Action</td>
                    </tr>
					<tr>
                        <td>Minimal</td>
                        <td>Maksimal</td>
                    </tr>
                </thead>
				<tbody>
				<?php $i = 1 ?>
   				<?php foreach ($showdata as $sd): ?>
					<tr>
                        <td><center><?php echo $i++ ?></center></td>
						<td><?php echo $sd->gj_grade ?></td>
						<td><?php echo $sd->gj_range_min ?></td>
						<td><?php echo $sd->gj_range_max ?></td>
						<td>
						<?php echo anchor('c_absensi/edit_gaji/'.$sd->no_gaji.'', 
						img(array('src'=>'images/icons/color/pencil.png','border'=>'0','alt'=>'Edit')), 'title="Edit"' ); ?>
                        <?php echo " "; ?>
        				<?php echo anchor('c_absensi/delete_gaji/'.$sd->no_gaji.'', 
						img(array('src'=>'images/icons/color/cross.png','border'=>'0','alt'=>'Delete')), 'title="Delete"' ); ?>
        				</td>
                    </tr>
				<?php endforeach ?>
                </tbody>
            </table>
			
        </div>