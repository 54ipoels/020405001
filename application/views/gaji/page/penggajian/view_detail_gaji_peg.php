<?php $this->load->helper('asset'); ?>
          <div class="title">
          <h6>SLIP GAJI <?php // echo $unitshow; ?></h6></div>
            <?php 
				foreach ($showdata as $row){}
				foreach ($pot_pegawai as $pp){}
				foreach ($pot_perusahaan as $pr){}
			?>
			<table cellpadding="0" cellspacing="0" width="400px" >
				<tr><td width="120px">Nama</td><td width="8px">:</td><td width="250px"><?php echo $row['peg_nama'];?></td><td> </td><td>No.</td><td><?php echo $row['id_pgj'];?></td><tr>
				<tr><td>Pangkat</td><td>:</td><td><?php echo $row['p_jbt_jabatan'];?></td><td> </td><td width="80px">NIPP</td><td><?php echo $row['peg_nipp'];?></td><tr>
				<tr><td>Bagian</td><td>:</td><td colspan="4"><i><b><?php echo $row['p_unt_kode_unit'];?></b></i></td><tr>
				<tr><td colspan="6" align="center"><i><b><?php echo $month." ".$year;?></b></i></td></tr>
				<tr><td colspan="6"> <br></td><tr>
				<tr><td>Gaji Bruto</td><td>:</td><td><?php echo $row['pgj_gaji_bruto'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Masa Bakti 20 thn</td><td>:</td><td><?php //echo $row['pgj_masa_bakti'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Koreksi</td><td>:</td><td><?php //echo $row['pgj_koreksi'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Insentive</td><td>:</td><td><?php echo $row['pgj_insentive'];?></td><td> </td><td></td><td></td><tr>
				<tr><td>Potongan Pegawai</td><td>:</td><td><?php echo round($pot_peg,0);?></td><td> </td><td></td><td></td><tr>
				<tr><td>Potongan Perusahaan</td><td>:</td><td><?php echo round($pot_per,0);?></td><td> </td><td></td><td></td><tr>
				<tr><td colspan="6"> <br></td><tr>
				<tr><td>Pembulatan</td><td>:</td><td><?php echo $pembulatan;?></td><td> </td><td></td><td></td><tr>
				<tr><td>Penerimaan</td><td>:</td><td><?php echo $gaji_nett;?></td><td> </td><td></td><td></td><tr>
				<tr><td colspan="6"> <br></td><tr>
				<tr><td colspan="6" align="center"> <?php echo "# ".$terbilang." #";?></td><tr>
				
			
			</table>
			
			
