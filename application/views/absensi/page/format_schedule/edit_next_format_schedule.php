    <div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Input Data Format Schedule</h6></div>
            <?php 
				
				$attributes = array('class'=>'form' ); //,'id'=>'wizard3');
				echo form_open('c_absensi/update_format_schedule', $attributes);
                ?>
			<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td>Hari Ke</td>
                        <td>Jam Masuk</td>
                        <td>Break Out</td>
                        <td>Break In</td>
						<td>Jam Pulang</td>
                        <td>Status Libur</td>
                    </tr>
                </thead>
				<tbody>
                <?php
				//echo form_open('c_absensi/submit_format_schedule', $attributes);
                echo form_hidden('fsch_id', $fsch_id);
				echo form_hidden('fsch_name', $fsch_name);
				echo form_hidden('fsch_total_day', $fsch_total_day);
				?>
				<?php 
			//	for($i=1;$i<=$fsch_total_day;$i++) 
				foreach ($showdata as $sd)
				{ ?>
					<tr>
                        <td><center>
							<?php 
								echo $sd['fschtime_order']; 
								$id = 'fschtime_id_'.$sd['fschtime_order'];
								echo form_hidden($id, $sd['fschtime_id']);
							?>
							</center>
						</td>
						<td>
                        <?php
						$timein = array(
									  "000000" => "--:--",
									  "010000" => "01:00",
									  "020000" => "02:00",
									  "030000" => "03:00",
									  "040000" => "04:00",
									  "050000" => "05:00",
									  "060000" => "06:00",
									  "070000" => "07:00",
									  "080000" => "08:00",
									  "090000" => "09:00",
									  "100000" => "10:00",
									  "110000" => "11:00",
									  "120000" => "12:00",
									  "130000" => "13:00",
									  "140000" => "14:00",
									  "150000" => "15:00",
									  "160000" => "16:00",
									  "170000" => "17:00",
									  "180000" => "18:00",
									  "190000" => "19:00",
									  "200000" => "20:00",
									  "210000" => "21:00",
									  "220000" => "22:00",
									  "230000" => "23:00",
									  "235959" => "24:00",
									);
					
						
						$in = 'fschtime_time_in_'.$sd['fschtime_order'];
						$time_in=str_replace(":","",$sd['fschtime_time_in']);
						echo form_dropdown($in, $timein, $time_in);
						?>
						</td>
						<td>
                        <?php
						$time = array(
									  "000000" => "--:--",
									  "010000" => "01:00",
									  "020000" => "02:00",
									  "030000" => "03:00",
									  "040000" => "04:00",
									  "050000" => "05:00",
									  "060000" => "06:00",
									  "070000" => "07:00",
									  "080000" => "08:00",
									  "090000" => "09:00",
									  "100000" => "10:00",
									  "110000" => "11:00",
									  "120000" => "12:00",
									  "130000" => "13:00",
									  "140000" => "14:00",
									  "150000" => "15:00",
									  "160000" => "16:00",
									  "170000" => "17:00",
									  "180000" => "18:00",
									  "190000" => "19:00",
									  "200000" => "20:00",
									  "210000" => "21:00",
									  "220000" => "22:00",
									  "230000" => "23:00",
									  "235959" => "24:00",
									);
					
						
						$break_out = 'fschtime_break_out_'.$sd['fschtime_order'];
						$time_break_out=str_replace(":","",$sd['fschtime_break_out']);
						echo form_dropdown($break_out, $time, $time_break_out);
						?>
						</td>
						<td>
                        <?php
						$time = array(
									  "000000" => "--:--",
									  "010000" => "01:00",
									  "020000" => "02:00",
									  "030000" => "03:00",
									  "040000" => "04:00",
									  "050000" => "05:00",
									  "060000" => "06:00",
									  "070000" => "07:00",
									  "080000" => "08:00",
									  "090000" => "09:00",
									  "100000" => "10:00",
									  "110000" => "11:00",
									  "120000" => "12:00",
									  "130000" => "13:00",
									  "140000" => "14:00",
									  "150000" => "15:00",
									  "160000" => "16:00",
									  "170000" => "17:00",
									  "180000" => "18:00",
									  "190000" => "19:00",
									  "200000" => "20:00",
									  "210000" => "21:00",
									  "220000" => "22:00",
									  "230000" => "23:00",
									  "235959" => "24:00",
									);
					
						
						$break_in = 'fschtime_break_in_'.$sd['fschtime_order'];
						$time_break_in=str_replace(":","",$sd['fschtime_break_in']);
						echo form_dropdown($break_in, $time, $time_break_in);
						?>
						</td>
						<td>
						<?php
						$time = array(
									  "000000" => "--:--",
									  '010000' => '01:00',
									  '020000' => '02:00',
									  '030000' => '03:00',
									  '040000' => '04:00',
									  '050000' => '05:00',
									  '060000' => '06:00',
									  '070000' => '07:00',
									  '080000' => '08:00',
									  '090000' => '09:00',
									  '100000' => '10:00',
									  '110000' => '11:00',
									  '120000' => '12:00',
									  '130000' => '13:00',
									  '140000' => '14:00',
									  '150000' => '15:00',
									  '160000' => '16:00',
									  '170000' => '17:00',
									  '180000' => '18:00',
									  '190000' => '19:00',
									  '200000' => '20:00',
									  '210000' => '21:00',
									  '220000' => '22:00',
									  '230000' => '23:00',
									  '235959' => '24:00',
									);
					
						$out = 'fschtime_time_out_'.$sd['fschtime_order'];
						$time_out=str_replace(":","",$sd['fschtime_time_out']);
						echo form_dropdown($out, $time, $time_out);
						?>
                        </td>
                        <td>
                        <?php 
							$status = 'fschtime_off_status_'.$sd['fschtime_order'];
							if($sd['fschtime_off_status']==1){
								echo form_checkbox($status, '1', TRUE); 
							} else {
								echo form_checkbox($status, '1'); 
							}
							?> Centang jika libur
                        </td>
                    </tr>
					
                <?php  } 
				
				?>
                <tr>
                <td colspan="4">
					<span class="wNavButtons">
                        <input class="basic" value="Back" type="reset" onClick="javascript:history.back(1)" />
						<?php 
						$submit = array(
							'class' => 'blueB m110',
							'name' => 'submit_fsch_add_next',
							'value'	=> 'SIMPAN',
						);
						echo form_submit($submit)?>
                    </span>
                </td>
              	</tr>
                
				<?php // echo form_close();?>
                </tbody>
            </table>
			<?php  echo form_close();?>
                
        </div>