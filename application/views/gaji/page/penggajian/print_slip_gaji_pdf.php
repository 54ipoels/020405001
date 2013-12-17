<html>
<head>
<title>DATA PEGAWAI</title>
<style type="text/css">
body{ 
	width : 300px;
	font-size:8px;
	margin-left:5px;
	margin-right:5px;
}
h1{ 
	margin-left:10px;
	font-size:15px; 
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
	margin-right:30px;
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
<h1>SLIP GAJI</h1>
<div class="hr"></hr></div>
<br>
<h2> </h2>
<div id="content">

            <?php 
				foreach ($showdata as $row){}
				foreach ($pot_pegawai as $pp){}
				foreach ($pot_perusahaan as $pr){}
			?>
			<table cellpadding="0" cellspacing="0" >
				<tr><td width="60px">Nama</td><td width="8px">:</td><td width="120px"><?php echo $row['peg_nama'];?></td><td> </td><td>No.</td><td><?php echo $row['id_pgj'];?></td></tr>
				<tr><td>Pangkat</td><td>:</td><td><?php echo $row['p_jbt_jabatan'];?></td><td> </td><td width="80px">NIPP</td><td><?php echo $row['peg_nipp'];?></td></tr>
				<tr><td>Bagian</td><td>:</td><td colspan="4"><i><b><?php echo $row['p_unt_kode_unit'];?></b></i></td></tr>
				<tr><td colspan="6" align="center"><i><b><?php echo $month." ".$year;?></b></i></td></tr>
				<tr><td colspan="6"> <br></td></tr>
				<tr><td>Gaji Bruto</td><td>:</td><td><?php echo $row['pgj_gaji_bruto'];?></td><td> </td><td></td><td></td></tr>
				<tr><td>Masa Bakti 20 thn</td><td>:</td><td><?php echo $row['pgj_masa_bakti'];?></td><td> </td><td></td><td></td></tr>
				<tr><td>Koreksi</td><td>:</td><td><?php echo $row['pgj_koreksi'];?></td><td> </td><td></td><td></td></tr>
				<tr><td>Insentive</td><td>:</td><td><?php echo $row['pgj_insentive'];?></td><td> </td><td></td><td></td></tr>
				<tr><td>Potongan Pegawai</td><td>:</td><td><?php echo round($pot_peg,0);?></td><td> </td><td></td><td></td></tr>
				<tr><td>Potongan Perusahaan</td><td>:</td><td><?php echo round($pot_per,0);?></td><td> </td><td></td><td></td></tr>
				<tr><td colspan="6"> <br></td></tr>
				<tr><td>Pembulatan</td><td>:</td><td><?php echo $pembulatan;?></td><td> </td><td></td><td></td></tr>
				<tr><td>Penerimaan</td><td>:</td><td><?php echo $gaji_nett;?></td><td> </td><td></td><td></td></tr>
				<tr><td colspan="6"> <br></td></tr>
				<tr><td colspan="6" align="center"> <?php echo "# ".$terbilang." #";?></td></tr>
			</table>
			<br><br><br><br>
			<div align="right">
			Dicetak : <?php echo $tanggal_cetak; ?>
			</div>
</div>
</body>
</html>



