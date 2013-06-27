<div class="widget">
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>STKP : <?php echo $STKP.' - Tanggal Pelaksanaan :'.$tanggal_start.'<b> s/d </b>'.$tanggal_end; ?></h6></div>
		  <?php echo form_open('diklat/input_nilai_stkp');?>
            <table cellpadding="0" cellspacing="0" width="100%" class="display sTable">
                <thead>
                    <tr>
						<td rowspan="2" width="19px">NO</td>
                        <td rowspan="2" width="50px">NIPP</td>
                        <td rowspan="2" width="19px">Mandatory</td>
						<td rowspan="2" width="400px">License</td>
						<?php if ($license == 'yes') {
							echo '<td colspan="2">Validity</td>'; } ?>
						<td rowspan="2" width="19px">Recurrent</td>
                    </tr>
					<?php if ($license == 'yes') {
						echo '<tr>' ;
						echo '<td width="120px">Start Date</td>';
						echo '<td width="120px">End Date</td>' ;
						echo '</tr>' ;} ?>
                </thead>
				<tbody>
				<?php 
				echo form_hidden('stkp', $STKP);
				echo form_hidden('rating', $rating);
				echo form_hidden('tanggal_start', $tanggal_start);
				echo form_hidden('tanggal_end', $tanggal_end);
				echo form_hidden('jumlah', $jumlah);
				echo form_hidden('license', $license);
				echo form_hidden('lp', $lp);
				echo form_hidden('instruktur', $instruktur);
				echo form_hidden('instruktur_from', $instruktur_from);
				for($i=1;$i<=$jumlah;$i++)
					{ 
					echo '<tr>';
					echo '<td>'.$i.'</td>';
					echo '<td align="center"><input type="text" name="nipp'.$i.'" value="" id="nipp'.$i.'"  /></td>';
					$check_mand = array(
								  'name'        => 'mandatory'.$i,
								  'id'          => 'mandatory'.$i,
								  'value'       => 'yes',
								  'checked'     => FALSE, 
								);
					echo '<td>'.form_checkbox($check_mand).'</td>';
					echo '<td align="center"><input type="text" name="license'.$i.'" value="" id="license'.$i.'" style="width:80%"  /></td>';
					if ($license == 'yes') {
						echo '<td align="center"><input type="text" name="start'.$i.'" value="" id="start'.$i.'" style="width:50%" class="maskDate"/></td>';
						echo '<td align="center"><input type="text" name="end'.$i.'" value="" id="end'.$i.'" style="width:50%" class="maskDate"/></td>';
					}
					$check_recc = array(
								  'name'        => 'recc'.$i,
								  'id'          => 'recc'.$i,
								  'value'       => 'yes',
								  'checked'     => TRUE,
								);
					echo '<td>'.form_checkbox($check_recc).'</td>';
					echo '</tr>';
					}?>
				
                </tbody>
				<tfoot>
				<tr><td colspan="7">
				<div class="wizButtons"> 
					<span class="wNavButtons">
                        <input class="blueB ml10" id="next2" value="Submit" type="submit" />
                    </span>
				</div>
				</tr></td>
				</tfoot>
			</table>
		</form>
</div>