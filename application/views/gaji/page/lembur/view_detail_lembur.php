<?php $this->load->helper('asset'); ?>
          <div class="title">
          <h6>SLIP LEMBUR <?php // echo $unitshow; ?></h6></div>
            <?php foreach ($showdata as $row){};?>
			<table cellpadding="0" cellspacing="0" width="400px" >
				<tr><td width="80px">Nama</td><td width="8px">:</td><td width="250px"><?php echo $row['peg_nama'];?></td><td> </td><td>No.</td><td><?php echo $row['id_lembur'];?></td><tr>
				<tr><td>Pangkat</td><td>:</td><td><?php //echo  $row['peg_nama'];?></td><td> </td><td width="80px">NIPP</td><td><?php echo $row['peg_nipp'];?></td><tr>
				<tr><td>Bagian</td><td>:</td><td colspan="4"><i><b><?php echo $row['p_jbt_jabatan'];?></b></i></td><tr>
				<tr><td colspan="6" align="center"><i><b><?php echo $month." ".$year;?></b></i></td></tr>
				<tr><td colspan="6"> <br></td><tr>
				<tr><td>U.Makan</td><td>:</td><td><?php echo $row['lmb_uang_makan'];?></td><td> </td><td><?php  echo $row['lmb_jumlah_hari_kerja'] ;?></td><td>hari</td><tr>
				<tr><td>U.Transport</td><td>:</td><td><?php echo $row['lmb_uang_transport'];?></td><td> </td><td></td><td></td><tr>
				<tr><td colspan="6"> <br></td><tr>
				<tr><td>Lembur</td><td>:</td><td></td><td> </td><td></td><td></td><tr>
				<tr><td>H.Kerja</td><td>:</td><td><?php echo $row['lmb_hari_kerja'];?></td><td> </td><td><?php echo $row['lmb_jml_hr_kerja'];?></td><td>jam</td><tr>
				<tr><td>H.Libur</td><td>:</td><td><?php echo $row['lmb_hari_libur'];?></td><td> </td><td><?php echo $row['lmb_jml_hr_libur'];?></td><td>jam</td><tr>
				<tr><td>Ex-Voed</td><td>:</td><td><?php echo $row['lmb_ex_voed'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Shift All</td><td>:</td><td><?php echo $row['lmb_shift_all'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Natura</td><td>:</td><td><?php echo $row['lmb_natura'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Tunj. STKP</td><td>:</td><td><?php echo $row['lmb_tunj_stkp'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Potongan</td><td>:</td><td><?php echo $row['lmb_potongan'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Koreksi</td><td>:</td><td><?php echo $row['lmb_koreksi'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Apresiasi</td><td>:</td><td><?php echo $row['lmb_apresiasi'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Penerimaan</td><td>:</td><td><?php echo $penerimaan;?></td><td> </td><td></td><td></td><tr>
				<tr><td colspan="6"> <br></td><tr>
				<tr><td colspan="6" align="center"> <?php echo "# ".$terbilang." #";?></td><tr>
				
			
			</table>
			
			
