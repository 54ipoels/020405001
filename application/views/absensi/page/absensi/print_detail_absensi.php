<html>
<head>
	<title>DETAIL ABSENSI PEGAWAI</title>
</head>
<link href="<?php echo base_url(); ?>admin/css/kompetensi.css" rel="stylesheet" type="text/css" />
<body>

<h4>DETAIL ABSENSI PEGAWAI <?php echo "$bulan $tahun"; ?></h4>
<table border="0.5" width="700">
	<thead align='center'>
		<tr>
			<td rowspan='2'>NO</td>
			<td rowspan='2'>NIPP</td>
			<td rowspan='2'>NAMA</td>
			<td colspan='2'>JADWAL</td>
			<td colspan='2'>ABSENSI</td>
		</tr>
		<tr>
			<td> MASUK</td>
			<td> KELUAR</td>
			<td> MASUK</td>
			<td> KELUAR</td>
		</tr>
	</thead>
	<tbody>
<?php $numbering=1; 
		foreach($showdata as $sd) { ?>
			<tr>
           		<td><?php echo $numbering++; ?></td>
				<td><?php echo $sd['peg_nipp']; ?></td>
				<td><?php echo $sd['peg_nama']; ?></td>
			<?php
			if($sd['fschpegabs_off_status'] == 0){?>
				<td align='center'><?php echo substr($sd['fschpegabs_sch_time_in'],11,5); ?></td>
				<td align='center'><?php echo substr($sd['fschpegabs_sch_time_out'],11,5); ?></td>
				<td align='center'><?php echo substr($sd['fschpegabs_real_time_in'],11,5); ?></td>
				<td align='center'><?php echo substr($sd['fschpegabs_real_time_out'],11,5); ?></td>
			<?php }
			if($sd['fschpegabs_off_status'] == 1) 
			{ ?>
            <?php if($sd['fschpegabs_real_time_in'] != "0000-00-00 00:00:00" or $sd['fschpegabs_real_time_out'] != "0000-00-00 00:00:00") { ?>
                      	<td colspan="2" style="background-color:#ffdfdf">OFF</td>
                      	<td style="background-color:#ffdfdf" align="center"><?php echo substr($sd['fschpegabs_real_time_in'],11,5); ?></td>
                       	<td style="background-color:#ffdfdf" align="center"><?php echo substr($sd['fschpegabs_real_time_out'],11,5); ?></td>
            <?php } else { ?>
                        <td colspan="4" style="background-color:#ffdfdf">OFF</td>
            <?php } 
			} if($sd['fschpegabs_off_status'] == 2) { ?>
                        	<?php if($sd['fschpegabs_real_time_in'] != "0000-00-00 00:00:00" or $sd['fschpegabs_real_time_out'] != "0000-00-00 00:00:00") { ?>
                        	<td colspan="2" style="background-color:#FFCCCC">LIBUR NASIONAL</td>
                        	<td style="background-color:#ffdfdf" align="center"><?php echo substr($sd['fschpegabs_real_time_in'],11,5); ?></td>
                        	<td style="background-color:#ffdfdf" align="center"><?php echo substr($sd['fschpegabs_real_time_out'],11,5); ?></td>
                            <?php } else { ?>
                            <td colspan="8" style="background-color:#FFCCCC">LIBUR NASIONAL</td>
                            <?php } ?>
            <?php } ?> 			
			
			</tr>
<?php } ?>                       
	</tbody>
</table>
</body>
</html>

