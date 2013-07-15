<?php $this->load->helper('asset'); ?>
          <div class="title">
          <h6>SLIP GAJI <?php // echo $unitshow; ?></h6></div>
            <?php foreach ($showdata as $row){};?>
			<table cellpadding="0" cellspacing="0" width="400px" >
				<tr><td width="120px">Nama</td><td width="8px">:</td><td width="250px"><?php echo $row['peg_nama'];?></td><td> </td><td>No.</td><td><?php echo $row['id_pgj'];?></td><tr>
				<tr><td>Pangkat</td><td>:</td><td><?php // echo $row['peg_nama'];?></td><td> </td><td width="80px">NIPP</td><td><?php echo $row['peg_nipp'];?></td><tr>
				<tr><td>Bagian</td><td>:</td><td colspan="4"><i><b><?php echo $row['p_jbt_jabatan'];?></b></i></td><tr>
				<tr><td colspan="6" align="center"><i><b><?php echo $month." ".$year;?></b></i></td></tr>
				<tr><td colspan="6"> <br></td><tr>
				<tr><td>Gaji Bruto</td><td>:</td><td><?php echo $row['pgj_gaji_bruto'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Masa Bakti 20 thn</td><td>:</td><td><?php echo $row['pgj_masa_bakti'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Koreksi</td><td>:</td><td><?php echo $row['pgj_koreksi'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Insentive</td><td>:</td><td><?php echo $row['pgj_insentive'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Potongan</td><td>:</td><td><?php echo $row['pgj_potongan'];?></td><td> </td><td></td><td></td><tr>
				<tr><td colspan="6"> <br></td><tr>
				<tr><td>Pembulatan</td><td>:</td><td><?php echo $row['pgj_pembulatan'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Penerimaan</td><td>:</td><td><?php echo $row['pgj_terima'];?></td><td> </td><td></td><td></td><tr>
				<tr><td colspan="6"> <br></td><tr>
				<tr><td colspan="6" align="center"> <?php echo "# ".$terbilang." #";?></td><tr>
				
			
			</table>
			
			
