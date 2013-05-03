
<br /><?php echo anchor('gaji/add_master_lembur', img(array('src'=>'images/icons/control/32/plus.png','border'=>'0','alt'=>'ADD')), 'title="ADD"' ); ?>
<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Master Data Lembur</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td width="1%">No</td>
                        <td>Grade</td>
                        <td>U Makan</td>
                        <td>U Transport</td>
                        <td>Ex. Voed</td>
                        <td>Hari Kerja</td>
                        <td>Hari Libur</td>
                        <td>Shift </td>
                        <td>Tunj Spv</td>
                        <td>Natura</td>
                        <td>Action</td>
                    </tr>
                </thead>
				<tfoot>
					<tr><td colspan=13><center><div class="pagination"><?php echo $this->pagination->create_links();?></div></center></td></td></tr>
				</tfoot>
				<tbody>
				<?php 
				$time=time();
				if ($this->uri->segment(3)== NULL)
				{
					$number = 1;
				} else {
					$number = $this->uri->segment(3)+1;
				}
				$i=0;
				foreach ($showdata as $sd) :
				{  $i++;
				?>
					<tr>
                       <td><?php echo $i;?></td>
					   <td><?php echo $sd['ml_grade']; ?></td>
                       <td><?php echo $sd['ml_makan']; ?></td>
                       <td><?php echo $sd['ml_trans']; ?></td>
                       <td><?php echo $sd['ml_exvo']; ?></td>
                       <td><?php echo $sd['ml_hari_kerja']; ?></td>
                       <td><?php echo $sd['ml_hari_libur']; ?></td>
                       <td><?php echo $sd['ml_shift']; ?></td>
                       <td><?php echo $sd['ml_tunj_spv']; ?></td>
                       <td><?php echo $sd['ml_natura']; ?></td>
                       <td><?php echo anchor('gaji/edit_master_lembur/'.$sd['id_master_lembur'],'edit'); echo "&nbsp; &nbsp;&nbsp;"; #echo anchor('gaji/delete_master_lembur','delete');  ?></td>
                    </tr> <?php
					$number++;
				}endforeach; 
				?>
                </tbody>
            </table>
			
        </div>
		