<html>
<head>
<title>DATA PEGAWAI</title>
<style type="text/css">
body{ 
	width : 21cm;
	font-size:20px;
	margin-left:5px;
	margin-right:5px;
}
h1{ 
	margin-left:10px;
	font-size:30px; 
}	
h2{ 
	font-size:20px; 
}
.hr{
	border: 0;
	width: 100%;
	color: #f00;
	background-color: #f00;
	height: 5px;
}
#left{
	float:left;
	width:70%;
}
#right{
	float:right;
	width:20%;
}
#content{
	margin-left:10px;
}
#photo{
	float:right;
}
table.withborder{
	border-collapse:collapse;
	border: 3px solid black;
}
table.withborder th{
	border: 2px solid black;
}
table.withborder td{
	border: 1px solid black;
}

.clear{
	clear:both;
}
		
</style>
	
</head>
<body>
<h1>CURRICULUM - VITAE</h1>
<div class="hr"></hr></div>
<br>
<h2>I. KETERANGAN PEGAWAI</h2>
<div id="content">
	<div id="left">
	<table>
		<?php 
		$peg_nama="";
		$peg_nipp=$this->uri->segment(3);
		$peg_tmt="";
		$peg_golongan="";
		$peg_jabatan="";
		$peg_unit="";
		$peg_tempatlahir ="";
		$peg_tanggallahir ="";
		$peg_usia ="";
		$peg_jeniskelamin = "";
		$peg_statusmenikah = "";
		$peg_alamatrumah ="";
		$peg_telephone ="";
		//$peg_ktp ="";
		//$peg_npwp ="";
		//$peg_jamsostek ="";
		foreach($pegawai as $row_pegawai){ 
			$peg_nama=$row_pegawai['peg_nama'];
			$peg_tempatlahir=$row_pegawai['peg_tmpt_lahir'];
			$peg_tanggallahir=$row_pegawai['peg_tgl_lahir'];
			if($row_pegawai['peg_jns_kelamin'] == "L")
			{
				$peg_jns_kelamin = "LAKI_LAKI";
			} else if($row_pegawai['peg_jns_kelamin'] == "P")
			{
				$peg_jns_kelamin = "PEREMPUAN";
			}
			if($peg_tanggallahir > "0000-00-00")
			{
				$now = date('Y-m-d');
				$peg_usia =  floor((strtotime($now) - strtotime($peg_tanggallahir)) / (365*24*60*60));
			}
			
		}
		foreach($data_alamat as $row_alamat)
		{
			$peg_alamatrumah = $peg_alamatrumah." ".$row_alamat['p_al_jalan']." ".$row_alamat['p_al_jalan']." ".$row_alamat['p_al_kelurahan']." ".$row_alamat['p_al_kelurahan']." ".$row_alamat['p_al_kecamatan']." ".$row_alamat['p_al_kabupaten']." ".$row_alamat['p_al_provinsi'].". ";
			$peg_telephone = $peg_telephone." ".$row_alamat['p_al_no_telp']." . ";
		}
		foreach($data_tmt as $row_tmt)
		{
			$peg_tmt = $row_tmt['p_tmt_tmt'];
		}
		foreach($data_jabatan as $row_jabatan)
		{
			$peg_jabatan = $row_jabatan['p_jbt_jabatan'];
		}
		foreach($data_unit as $row_unit)
		{
			$peg_unit = $row_unit['p_unt_kode_unit'];
		}
		
		
		?>
		<tr>
			<td>Nama Lengkap</td>
			<td>:</td>
			<td><?php echo $peg_nama;?></td>
		</tr>
		<tr>
			<td>NIP</td>
			<td>:</td>
			<td><?php echo $peg_nipp;?></td>
		</tr>
		<tr>
			<td>T.M.T</td>
			<td>:</td>
			<td><?php echo $peg_tmt;?></td>
		</tr>
		<tr>
			<td>Pangkat/Golongan</td>
			<td>:</td>
			<td><?php echo $peg_golongan;?></td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td>:</td>
			<td><?php echo $peg_jabatan;?></td>
		</tr>
		<tr>
			<td>Unit Kerja</td>
			<td>:</td>
			<td><?php echo $peg_unit;?></td>
		</tr>
		<tr>
			<td>Tempat, Tanggal Lahir</td>
			<td>:</td>
			<td><?php echo $peg_tempatlahir.", ".$peg_tanggallahir;?></td>
		</tr>
		<tr>
			<td>Usia</td>
			<td>:</td>
			<td><?php echo $peg_usia;?></td>
		</tr>
		<tr>
			<td>Jenis Kelamin</td>
			<td>:</td>
			<td><?php echo $peg_jeniskelamin;?></td>
		</tr>
		<tr>
			<td>Alamat Rumah</td>
			<td>:</td>
			<td><?php echo $peg_alamatrumah;?></td>
		</tr>
		<tr>
			<td>Telephone</td>
			<td>:</td>
			<td><?php echo $peg_telephone;?></td>
		</tr>
	</table>
	</div>
	<div id="right">
		<img src="<?php echo base_url()."/pegawai/foto/marsu.jpg" ?>" width="150px" height="200px">
	</div>
</div>
<div class="clear"></div>
<br>
<h2>II. PENDIDIKAN FORMAL</h2>
<div id="content">
	<table class="withborder" width="100%">
		<thead>
			<tr>
				<th>NO</th>
				<th>PENDIDIKAN</th>
				<th>TAHUN</th>
				<th>TEMPAT</th>
				<th>KETERANGAN</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 0;
			foreach($data_pendidikan as $row_pendidikan){ 
			$no++;
			?>	
			<tr>
				<td align="center"><?php echo $no;?></td>
				<td><?php echo $row_pendidikan['p_pdd_tingkat'];?></td>
				<td align="center"><?php echo $row_pendidikan['p_pdd_masuk'];?></td>
				<td><?php echo $row_pendidikan['p_pdd_lp'];?></td>
				<td></td>
				
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<div class="clear"></div>
<br>
<h2>III. PENDIDIKAN INFORMAL</h2>
<div id="content">
	<table class="withborder" width="100%">
		<thead>
			<tr>
				<th>NO</th>
				<th>PENDIDIKAN</th>
				<th>TGL MULAI</th>
				<th>TGL SELESAI</th>
				<th>TEMPAT</th>
				<th>KETERANGAN</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 0;
			foreach($data_nstkp as $row_nstkp){ 
			$no++;
			?>	
			<tr>
				<td align="center"><?php echo $no;?></td>
				<td><?php echo $row_nstkp['p_nstkp_jenis'];?></td>
				<td align="center"><?php echo $row_nstkp['p_nstkp_pelaksanaan'];?></td>
				<td align="center"><?php echo $row_nstkp['p_nstkp_selesai'];?></td>
				<td><?php echo $row_nstkp['p_nstkp_lembaga'];?></td>
				<td></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<div class="clear"></div>
<br>
<h2>IV. RIWAYAT GOLONGAN</h2>
<div id="content">
	<table class="withborder" width="100%">
		<thead>
			<tr>
				<th>NO</th>
				<th>GOL / PANGKAT</th>
				<th>SK-GOLONGAN</th>
				<th>T.M.T GOLONGAN</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 0;
			foreach($riwayat_golongan as $row_riwayatgolongan){ 
			$no++;
			?>	
			<tr>
				<td align="center"><?php echo $no;?></td>
				<td><?php echo $row_riwayatgolongan['p_grd_grade'];?></td>
				<td><?php echo $row_riwayatgolongan['p_grd_skno'];?></td>
				<td align="center"><?php echo $row_riwayatgolongan['p_grd_tmt'];?></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<div class="clear"></div>
<br>
<h2>V. RIWAYAT JABATAN </h2>
<div id="content">
	<table class="withborder" width="100%">
		<thead>
			<tr>
				<th>NO</th>
				<th>JABATAN</th>
				<th>DEPARTEMEN</th>
				<th>SK</th>
				<th>T.M.T</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 0;
			foreach($riwayat_jabatan as $row_riwayatjabatan){ 
			$no++;
			?>	
			<tr>
				<td align="center"><?php echo $no;?></td>
				<td><?php echo $row_riwayatjabatan['p_jbt_jabatan'];?></td>
				<td><?php echo $row_riwayatjabatan['p_jbt_unit'];?></td>
				<td><?php echo $row_riwayatjabatan['p_jbt_skno'];?></td>
				<td align="center"><?php if($row_riwayatjabatan['p_jbt_tmt_start']=="0000-00-00"){echo "-";}else{echo mdate('%d-%M-%Y',strtotime($row_riwayatjabatan['p_jbt_tmt_start']));};?></td>
			</tr>
		<?php } ?>
		</tbody>
		
	</table>
</div>
<div class="clear"></div>
<br>
<h2>VI. DATA KELUARGA </h2>
<div id="content">
	<table class="withborder" width="100%">
		<thead>
			<tr>
				<th>NO</th>
				<th>NAMA ANAK</th>
				<th>TGL LAHIR</th>
				<th>UMUR</th>
				<th>HUBUNGAN</th>
			</tr>
		</thead>
		<tbody>
		<?php
			$no = 0;
			# PASANGAN
			foreach($data_pasangan as $row_pasangan){ 
			$no++;
			?>
			<tr>
				<td align="center"><?php echo $no; ?></td>
				<td><?php echo $row_pasangan['p_ps_nama']; ?></td>
				<td align="center"><?php if($row_pasangan['p_ps_tgl_lahir']=="0000-00-00"){echo "-";}else{echo mdate('%d-%M-%Y',strtotime($row_pasangan['p_ps_tgl_lahir']));} ?></td>
				<td align="center"><?php if($row_pasangan['p_ps_tgl_lahir']=="0000-00-00"){echo "-";}else{echo floor((strtotime(date('Y-m-d'))-strtotime($row_pasangan['p_ps_tgl_lahir']))/(365*24*60*60));}?></td>
				<td><?php if($row_pasangan['p_ps_jns_kelamin']=="L"){echo "SUAMI";}elseif($row_pasangan['p_ps_jns_kelamin']=="P"){echo "ISTRI";} ?></td>
			</tr>
			<?php
			}
			
			# ANAK
			$noanak = 0;
			foreach($data_anak as $row_anak){ 
			$no++;
			$noanak++;
			?>	
			<tr>
				<td align="center"><?php echo $no; ?></td>
				<td><?php echo $row_anak['peg_ank_nama']; ?></td>
				<td align="center"><?php if($row_anak['peg_ank_tgl_lahir']=="0000-00-00"){echo "-";}else{echo mdate('%d-%M-%Y',strtotime($row_anak['peg_ank_tgl_lahir']));} ?></td>
				<td align="center"><?php if($row_anak['peg_ank_tgl_lahir']=="0000-00-00"){echo "-";}else{echo floor((strtotime(date('Y-m-d'))-strtotime($row_anak['peg_ank_tgl_lahir']))/(365*24*60*60));}?></td>
				<td><?php echo "ANAK KE-".$noanak; ?></td>
			</tr>
		<?php } ?>
		</tbody>
		
	</table>
</div>

</body>
</html>



