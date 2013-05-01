<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" />
          <h6>DATA ABSENSI <?php echo $this->uri->segment(5).'-'.$this->uri->segment(6).'-'.$this->uri->segment(7);?></h6></div>
		  <?php echo form_open('c_absensi/submit_edit_detail_absensi'); 
		  echo form_hidden('date', $this->uri->segment(5));
		  echo form_hidden('month', $this->uri->segment(6));
		  echo form_hidden('year', $this->uri->segment(7));
		  echo form_hidden('fschpeg_id', $this->uri->segment(3));
		  echo form_hidden('fschpeg_tanggal', $this->uri->segment(4));
		  echo form_hidden('sch_out_date', $this->uri->segment(4));
		  
		  ?>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                    	<td rowspan="2">Tanggal</td>
						<td colspan="4">Jadwal</td>
                    	<td colspan="4">Absensi</td>
                    </tr>
					<tr>
						<td>Jadwal Masuk</td>
                        <td>Jadwal Break Out</td>
                        <td>Jadwal Break In</td>
                        <td>Jadwal Pulang</td>
                        <td>Absensi Masuk</td>
                        <td>Absensi Break Out</td>
                        <td>Absensi Break In</td>
                        <td>Absensi Pulang</td>
                    </tr>
                </thead>
                <tbody>
                	<?php 
					foreach($showdata as $sd) { ?>
					<tr>
                		<td align="center"><?php echo $this->uri->segment(5); ?></td>
                        <?php 
						
						$real_break_out = substr($sd['fschpegabs_real_break_out'],11,5);
						#if($real_break_out == "00:00:00"){$real_break_out = "--:--:--";}
						$real_break_in = substr($sd['fschpegabs_real_break_in'],11,5); 
						#if($real_break_in == "00:00:00"){$real_break_in = "--:--:--";}
						
						
						if($sd['fschpegabs_off_status'] == 0) 
						{ 
							$sch_break_out = substr($sd['fschpegabs_sch_break_out'],11,5); 
							$sch_break_in = substr($sd['fschpegabs_sch_break_in'],11,5); 
							#if($sch_break_out == "00:00:00"){$sch_break_out = "--:--:--";}
							#if($sch_break_in == "00:00:00"){$sch_break_in = "--:--:--";}
							
							echo form_hidden('sch_in_date', substr($sd['fschpegabs_sch_time_in'],0,10));
							echo '<td align="center"><input style="width: 50px" type="text" name="sch_in" class="maskHour" value="'.substr($sd['fschpegabs_sch_time_in'],11,5).'" id="sch_in"  /></td>';
							echo form_hidden('sch_break_out_date', substr($sd['fschpegabs_sch_break_out'],0,10));
							echo '<td align="center"><input style="width: 50px" type="text" name="sch_break_out" class="maskHour" value="'.substr($sd['fschpegabs_sch_break_out'],11,5).'" id="sch_break_out"  /></td>';
							echo form_hidden('sch_break_in_date', substr($sd['fschpegabs_sch_break_in'],0,10));
							echo '<td align="center"><input style="width: 50px" type="text" name="sch_break_in" class="maskHour" value="'.substr($sd['fschpegabs_sch_break_in'],11,5).'" id="sch_break_in"  /></td>';
							echo form_hidden('sch_out_date', substr($sd['fschpegabs_sch_time_out'],0,10));
							echo '<td align="center"><input style="width: 50px" type="text" name="sch_out" class="maskHour" value="'.substr($sd['fschpegabs_sch_time_out'],11,5).'" id="sch_out"  /></td>';
							echo '<td align="center"><input style="width: 50px" type="text" name="real_in" class="maskHour" value="'.substr($sd['fschpegabs_real_time_in'],11,5).'" id="real_in"  /></td>';
							echo '<td align="center"><input style="width: 50px" type="text" name="real_break_out" class="maskHour" value="'.substr($sd['fschpegabs_real_break_out'],11,5).'" id="real_break_out"  /></td>';
							echo '<td align="center"><input style="width: 50px" type="text" name="real_break_in" class="maskHour" value="'.substr($sd['fschpegabs_real_break_in'],11,5).'" id="real_break_in"  /></td>';
							echo '<td align="center"><input style="width: 50px" type="text" name="real_out" class="maskHour" value="'.substr($sd['fschpegabs_real_time_out'],11,5).'" id="real_out"  /></td>';
						} 
						if($sd['fschpegabs_off_status'] == 1) 
						{ 
							
							echo form_hidden('sch_in_date', substr($sd['fschpegabs_sch_time_in'],0,10));
							echo form_hidden('sch_in', substr($sd['fschpegabs_sch_time_in'],11,5));
							echo form_hidden('sch_break_in_date', substr($sd['fschpegabs_sch_break_in'],0,10));
							echo form_hidden('sch_break_in', substr($sd['fschpegabs_sch_break_in'],11,5));
							echo form_hidden('sch_break_out_date', substr($sd['fschpegabs_sch_break_out'],0,10));
							echo form_hidden('sch_break_out', substr($sd['fschpegabs_sch_break_out'],11,5));
							echo form_hidden('sch_out_date', substr($sd['fschpegabs_sch_time_out'],0,10));
							echo form_hidden('sch_out', substr($sd['fschpegabs_sch_time_out'],11,5));
								
							if($sd['fschpegabs_real_time_in'] != "0000-00-00 00:00:00" or $sd['fschpegabs_real_time_out'] != "0000-00-00 00:00:00") 
							{ 
								echo '<td colspan="4" style="background-color:#ffdfdf">OFF</td>';
								echo '<td align="center" style="background-color:#ffdfdf"><input style="width: 50px" type="text" name="real_in" class="maskHour" value="'.substr($sd['fschpegabs_real_time_in'],11,5).'" id="real_in"  /></td>';
								echo '<td align="center" style="background-color:#ffdfdf"><input style="width: 50px" type="text" name="real_break_in" class="maskHour" value="'.substr($sd['fschpegabs_real_break_in'],11,5).'" id="real_break_in"  /></td>';
								echo '<td align="center" style="background-color:#ffdfdf"><input style="width: 50px" type="text" name="real_break_out" class="maskHour" value="'.substr($sd['fschpegabs_real_break_out'],11,5).'" id="real_break_out"  /></td>';
								echo '<td align="center" style="background-color:#ffdfdf"><input style="width: 50px" type="text" name="real_out" class="maskHour" value="'.substr($sd['fschpegabs_real_time_out'],11,5).'" id="real_out"  /></td>';
							} else {
								echo '<td colspan="4" style="background-color:#ffdfdf">OFF</td>';
								echo '<td align="center" style="background-color:#ffdfdf"><input style="width: 50px" type="text" name="real_in" class="maskHour" value="'.substr($sd['fschpegabs_real_time_in'],11,5).'" id="real_in"  /></td>';
								echo '<td align="center" style="background-color:#ffdfdf"><input style="width: 50px" type="text" name="real_break_in" class="maskHour" value="'.substr($sd['fschpegabs_real_break_in'],11,5).'" id="real_break_in"  /></td>';
								echo '<td align="center" style="background-color:#ffdfdf"><input style="width: 50px" type="text" name="real_break_out" class="maskHour" value="'.substr($sd['fschpegabs_real_break_out'],11,5).'" id="real_break_out"  /></td>';
								echo '<td align="center" style="background-color:#ffdfdf"><input style="width: 50px" type="text" name="real_out" class="maskHour" value="'.substr($sd['fschpegabs_real_time_out'],11,5).'" id="real_out"  /></td>';
							} 
						} 
						if($sd['fschpegabs_off_status'] == 2) 
						{ 
							echo form_hidden('sch_in_date', substr($sd['fschpegabs_sch_time_in'],0,10));
							echo form_hidden('sch_in', substr($sd['fschpegabs_sch_time_in'],11,5));
							echo form_hidden('sch_break_in_date', substr($sd['fschpegabs_sch_break_in'],0,10));
							echo form_hidden('sch_break_in', substr($sd['fschpegabs_sch_break_in'],11,5));
							echo form_hidden('sch_break_out_date', substr($sd['fschpegabs_sch_break_out'],0,10));
							echo form_hidden('sch_break_out', substr($sd['fschpegabs_sch_break_out'],11,5));
							echo form_hidden('sch_out_date', substr($sd['fschpegabs_sch_time_out'],0,10));
							echo form_hidden('sch_out', substr($sd['fschpegabs_sch_time_out'],11,5));
							
							
							if($sd['fschpegabs_real_time_in'] != "0000-00-00 00:00:00" or $sd['fschpegabs_real_time_out'] != "0000-00-00 00:00:00") 
							{ 
								echo '<td colspan="4" style="background-color:#FFCCCC">LIBUR NASIONAL</td>';
								echo '<td align="center" style="background-color:#FFCCCC"><input style="width: 50px" type="text" name="real_in" class="maskHour" value="'.substr($sd['fschpegabs_real_time_in'],11,5).'" id="real_in"  /></td>';
								echo '<td align="center" style="background-color:#FFCCCC"><input style="width: 50px" type="text" name="real_break_in" class="maskHour" value="'.substr($sd['fschpegabs_real_break_in'],11,5).'" id="real_break_in"  /></td>';
								echo '<td align="center" style="background-color:#FFCCCC"><input style="width: 50px" type="text" name="real_break_out" class="maskHour" value="'.substr($sd['fschpegabs_real_break_out'],11,5).'" id="real_break_out"  /></td>';
								echo '<td align="center" style="background-color:#FFCCCC"><input style="width: 50px" type="text" name="real_out" class="maskHour" value="'.substr($sd['fschpegabs_real_time_out'],11,5).'" id="real_out"  /></td>';
							} else {
								echo ' <td colspan="4" style="background-color:#FFCCCC">LIBUR NASIONAL</td>';
								echo '<td align="center" style="background-color:#FFCCCC"><input style="width: 50px" type="text" name="real_in" class="maskHour" value="'.substr($sd['fschpegabs_real_time_in'],11,5).'" id="real_in"  /></td>';
								echo '<td align="center" style="background-color:#FFCCCC"><input style="width: 50px" type="text" name="real_break_in" class="maskHour" value="'.substr($sd['fschpegabs_real_break_in'],11,5).'" id="real_break_in"  /></td>';
								echo '<td align="center" style="background-color:#FFCCCC"><input style="width: 50px" type="text" name="real_break_out" class="maskHour" value="'.substr($sd['fschpegabs_real_break_out'],11,5).'" id="real_break_out"  /></td>';
								echo '<td align="center" style="background-color:#FFCCCC"><input style="width: 50px" type="text" name="real_out" class="maskHour" value="'.substr($sd['fschpegabs_real_time_out'],11,5).'" id="real_out"  /></td>';
							}
						}?>
                    </tr>
                    <?php } ?>
                    <tr>
                    	<td colspan="5" style="text-align:left; padding:5px;">
                        <input class="basic" value="BACK" type="reset" onClick="javascript:history.back(1)" />
                        </td>
						<td colspan="4" style="text-align:right; padding:5px;">
						<input class="blueB ml10" value="SUBMIT" type="submit" />
						</td>
                    </tr>
                 </tbody>
            </table>
		</form>
			
        </div>