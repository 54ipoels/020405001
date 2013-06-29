<?php $this->load->helper('asset'); ?>
<div class = "Two">
<br /><?php echo anchor('c_absensi/add_schedule_pegawai', img(array('src'=>'images/icons/control/32/plus.png','border'=>'0','alt'=>'ADD')), 'title="ADD"' ); ?>

<div class="widget">
          <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" />
          <h6>DATA SCHEDULE PEGAWAI&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;UNIT <?php echo $unitshow; ?></h6></div>
            <div style="margin:0; overflow:scroll">
			<table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                    	<td rowspan="2">NO</td>
                        <td rowspan="2">NIPP </td>
                        <td colspan="<?php echo $jmlhari+1; ?>"><?php echo $bulantahun; ?></td>
						<td rowspan="2">NIPP </td>
                    </tr>
                    <tr>
                    	<?php for($z=0;$z<=$jmlhari;$z++) { ?>
                        <td><?php echo $z+1?></td>
                        <?php } ?>
                    </tr>
                 <?php 	$numbering=1; 
						foreach($showdata as $sd) { 
				?>
				<tr>
                	<td rowspan="2"><?php echo $numbering++; ?></td>
                    <td rowspan="2"><?php echo $sd['peg_nipp'];?></td>
                    <?php $tgl = createDateRangeArray($startdate, $enddate); ?>
                    <?php for($i=0;$i<=$jmlhari;$i++) { ?>
                    <td>
					<?php echo ambil_timein_absensi($sd['fschpeg_id'], $tgl[$i], $year); ?>
                    </td>
                    <?php } ?>
					<td rowspan="2"><?php echo $sd['peg_nipp'];?></td>
                </tr>
                
				<tr>
                    <?php $tgl = createDateRangeArray($startdate, $enddate); ?>
                    <?php for($i=0;$i<=$jmlhari;$i++) { ?>
                    <td>
					<?php echo ambil_breakin_absensi($sd['fschpeg_id'], $tgl[$i], $year); ?>
                    </td>
                    <?php } ?>
                </tr>
                
				<?php } ?>
                </thead>
            </table>
			</div>
        </div>
</div>