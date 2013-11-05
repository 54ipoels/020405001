<html>
<head>
<title>DATA GAJI PEGAWAI <?php echo $namabulan." ".$year; ?></title>
<style type="text/css">
body{ 
	width : 40cm;
	font-size:10px;
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
	font-size:10px;
}
#photo{
	float:right;
}
table.withborder{
	border-collapse:collapse;
	border: 1px solid black;
}
table.withborder th{
	border: 1px solid black;
	font-size:8px;
}
table.withborder td{
	border-left: 1px solid black;
	border-right: 1px solid black;
	border-bottom : 0px solid black;
	font-size:8px;
}

.clear{
	clear:both;
}
</style>
	
</head>
<body>
<h1>DAFTAR GAJI PEGAWAI <?php echo $namabulan." ".$year; ?> <br>PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI DENPASAR </h1>
<div class="hr"></hr></div>
<br>
<div id="content">
	<table class="withborder" width="100%">
		<thead>
			<tr>
				<th rowspan="2">NO</th>
				<th rowspan="2">CABANG</th>
				<th rowspan="2">NAMA</th>
				<th rowspan="2">NIPP</th>
				<th rowspan="2">JABATAN</th>
				<th rowspan="2">GRADE</th>
				<th rowspan="2">GAJI BRUTO</th>
				<th rowspan="2">KOREKSI</th>
				<th rowspan="2">INFLASI</th>
				<th rowspan="2">MASA BAKTI</th>
				<th rowspan="2">THR</th>
				<th rowspan="2">BPAS</th>
				<th rowspan="2">BONUS</th>
				<th rowspan="2">TOTAL GAJI</th>
				<th rowspan="2">PEMBULATAN</th>
				<th rowspan="2">GAJI NETTO</th>
				<th colspan="10">POTONGAN PEGAWAI</th>
				<th rowspan="2">TOTAL POTONGAN PEGAWAI</th>
				<th colspan="8">POTONGAN PERUSAHAAN</th>
				<th rowspan="2">TOTAL POTONGAN PERUSAHAAN</th>
			</tr>
			<tr>
				<th>PENSIUN</th>
				<th>THT</th>
				<th>JHT</th>
				<th>SIHARTA</th>
				<th>SIPERKASA</th>
				<th>KOKARGA</th>
				<th>KOKARASA</th>
				<th>KOSIGARDEN</th>
				<th>KOSAKARGO</th>
				<th>KOKAGAYO</th>
				
				<th>PENSIUN</th>
				<th>THT</th>
				<th>JHT</th>
				<th>JK</th>
				<th>JKK</th>
				<th>JAMSOSTEK (JHT+JK+JKK)</th>
				<th>SIHARTA</th>
				<th>AS. JIWA</th>
				
			</tr>
		</thead>
		<tbody>
		<?php 
		$no = 1;
		foreach($showdata as $sd){ ?>
			<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo "DPS"; ?></td>
				<td><?php echo strtoupper($sd['peg_nama']); ?></td>
				<td><?php echo $sd['peg_nipp']; ?></td>
				<td><?php echo strtoupper($sd['p_jbt_jabatan']); ?></td>
				<td align="center"><?php echo $sd['p_grd_grade']; ?></td>
				<td align="right"><?php echo number_format($sd['pgj_gaji_bruto']); ?></td>
				<td align="right"><?php echo number_format($sd['pgj_koreksi']); ?></td>
				<td align="right"><?php echo number_format($sd['pgj_inflasi']);?></td>
				<td align="center"><?php echo $sd['pgj_masa_bakti'];?></td>
				<td><?php // echo $sd['pgj_thr'];?></td>
				<td><?php // echo $sd['pgj_bpas'];?></td>
				<td><?php // echo $sd['pgj_bonus']?></td>
				<td align="right"><?php $total_gaji = $sd['pgj_gaji_bruto'] - $sd['pgj_koreksi'] + $sd['pgj_inflasi']; echo number_format($total_gaji);  ?></td>
				<td align="right"><?php echo number_format($sd['pgj_pembulatan']); ?></td>
				<td align="right"><?php echo number_format($sd['pgj_terima']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_peg_pensiun']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_peg_tht']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_peg_jht']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_peg_siharta']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_peg_siperkasa']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_peg_kokarga']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_peg_kokarasa']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_peg_kosigarden']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_peg_koskargo']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_peg_kokagayo']); ?></td>
				<td align="right"><?php  $tot_pot_peg = $sd['pot_peg_pensiun'] + $sd['pot_peg_tht'] + $sd['pot_peg_jht'] + $sd['pot_peg_siharta'] + $sd['pot_peg_siperkasa'] + $sd['pot_peg_kokarga'] + $sd['pot_peg_kokarasa'] + $sd['pot_peg_kosigarden'] + $sd['pot_peg_koskargo'] + $sd['pot_peg_kokagayo'] ; echo number_format($tot_pot_peg); ?></td>
				<td align="right"><?php echo number_format($sd['pot_per_pensiun']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_per_tht']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_per_jht']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_per_jk']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_per_jkk']); ?></td>
				<td align="right"><?php $jamsostek = $sd['pot_per_jht'] + $sd['pot_per_jk'] + $sd['pot_per_jkk']; echo number_format($jamsostek); ?></td>
				<td align="right"><?php echo number_format($sd['pot_per_siharta']); ?></td>
				<td align="right"><?php echo number_format($sd['pot_per_as_jiwa']); ?></td>
				<td align="right"><?php $tot_pot_per = $sd['pot_per_pensiun'] + $sd['pot_per_tht'] + $sd['pot_per_jht'] + $sd['pot_per_jk'] + $sd['pot_per_jkk'] + $sd['pot_per_siharta'] + $sd['pot_per_as_jiwa']; echo number_format($tot_pot_per);?></td>
				
			</tr>
		<?php } ?>	
		
		</tbody>
		
	</table>
</div>

</body>
</html>



