<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" />
          <h6>DATA ABSENSI <?php echo " BULAN ".$this->uri->segment(4)." ".$this->uri->segment(5)." ( NIPP : ".$this->uri->segment(6)." ) "; ?></h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                    	<td>Tanggal</td>
                        <td>Jadwal Masuk</td>
                        <td>Jadwal Break Out</td>
                        <td>Jadwal Break In</td>
                        <td>Jadwal Pulang</td>
                        <td>Absensi Masuk</td>
                        <td>Absensi Break Out</td>
                        <td>Absensi Break In</td>
                        <td>Absensi Pulang</td>
						<td>Action</td>
                    </tr>
                </thead>
                <tbody>
                	<?php $numbering=1; foreach($showdata as $sd) { ?>
					<tr>
                		<td><?php echo $numbering++; ?></td>
                        <?php 
						if($sd['fschpegabs_off_status'] == 0) 
						{ ?>
							<td><?php echo substr($sd['fschpegabs_sch_time_in'],11,5); ?></td>
							<td><?php echo substr($sd['fschpegabs_sch_break_out'],11,5); ?></td>
							<td><?php echo substr($sd['fschpegabs_sch_break_in'],11,5); ?></td>
							<td><?php echo substr($sd['fschpegabs_sch_time_out'],11,5); ?></td>
							<td><?php echo substr($sd['fschpegabs_real_time_in'],11,5); ?></td>
							<td><?php echo substr($sd['fschpegabs_real_break_out'],11,5); ?></td>
							<td><?php echo substr($sd['fschpegabs_real_break_in'],11,5); ?></td>
							<td><?php echo substr($sd['fschpegabs_real_time_out'],11,5); ?></td>
                        <?php } 
						if($sd['fschpegabs_off_status'] == 1) 
						{ ?>
                        	<?php if($sd['fschpegabs_real_time_in'] != "0000-00-00 00:00:00" or $sd['fschpegabs_real_time_out'] != "0000-00-00 00:00:00") { ?>
                        	<td colspan="4" style="background-color:#ffdfdf">OFF</td>
                        	<td style="background-color:#ffdfdf"><?php echo substr($sd['fschpegabs_real_time_in'],11,5); ?></td>
                        	<td style="background-color:#ffdfdf"><?php echo substr($sd['fschpegabs_real_break_out'],11,5); ?></td>
                        	<td style="background-color:#ffdfdf"><?php echo substr($sd['fschpegabs_real_break_in'],11,5); ?></td>
                        	<td style="background-color:#ffdfdf"><?php echo substr($sd['fschpegabs_real_time_out'],11,5); ?></td>
                            <?php } else { ?>
                            <td colspan="8" style="background-color:#ffdfdf">OFF</td>
                            <?php } ?>
                        <?php } if($sd['fschpegabs_off_status'] == 2) { ?>
                        	<?php if($sd['fschpegabs_real_time_in'] != "0000-00-00 00:00:00" or $sd['fschpegabs_real_time_out'] != "0000-00-00 00:00:00") { ?>
                        	<td colspan="4" style="background-color:#FFCCCC">LIBUR NASIONAL</td>
                        	<td style="background-color:#ffdfdf"><?php echo substr($sd['fschpegabs_real_time_in'],11,5); ?></td>
                        	<td style="background-color:#ffdfdf"><?php echo substr($sd['fschpegabs_real_break_out'],11,5); ?></td>
                        	<td style="background-color:#ffdfdf"><?php echo substr($sd['fschpegabs_real_break_in'],11,5); ?></td>
                        	<td style="background-color:#ffdfdf"><?php echo substr($sd['fschpegabs_real_time_out'],11,5); ?></td>
                            <?php } else { ?>
                            <td colspan="8" style="background-color:#FFCCCC">LIBUR NASIONAL</td>
                            <?php } ?>
                        <?php } ?>
						<td><?php echo anchor('c_absensi/edit_detail_absensi/'.$sd['fschpegabs_fschpeg_id'].'/'.$sd['fschpegabs_id'].'/'.($numbering-1).'/'.$this->uri->segment(4).'/'.$this->uri->segment(5).'/'.$this->uri->segment(6), 'edit'); ?></td>
                    </tr>
                    <?php } ?>
                    <tr>
                    	<td colspan="5" style="text-align:left; padding:5px;">
                        <input class="basic" value="Back" type="reset" onClick="javascript:history.back(1)" />
                        </td>
                    	<td colspan="5" style="text-align:right; padding:5px;">
							<a href ="<?php echo base_url()?>index.php/c_absensi/print_detail_absensi/<?php echo $sd['fschpegabs_fschpeg_id'].'/'.$this->uri->segment(4).'/'.$this->uri->segment(5); ?>">
								<image src="<?php echo base_url();?>images/icons/control/32/print.png" title="print" />
							</a>
                        </td>
                    </tr>
                 </tbody>
            </table>
			
        </div>