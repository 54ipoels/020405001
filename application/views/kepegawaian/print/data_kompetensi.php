<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DATA KOMPETENSI PEGAWAI</title>

</head>
<body>
<?php 
$datestring = "%d-%m-%Y" ;
foreach($pegawai as $row_peg){}
foreach($data_jabatan_tmt as $row_jt){}

foreach($data_unit as $row_unit){}
foreach($data_status_keluarga as $row_stk){}
foreach($data_fisik as $row_fis){}
foreach($data_alamat as $row_al){}
if($data_pendidikan == NULL)
{
	$pendidikan_terakhir="-";
}
else 
{
	foreach($data_pendidikan as $row_pdk){}
	$pendidikan_terakhir = $row_pdk['p_pdd_tingkat'];
}

if ($data_grade==NULL){
	$grade="";
}else {
	foreach($data_grade as $row_grd){}
	$grade=$row_grd['p_grd_grade'];
}
if ($data_unit == NULL){
	$unit="";
	
}else {
	foreach($data_unit as $row_unit){}
	$unit = $row_unit['p_unt_kode_unit'];
}

?>
<h1>DATA KOMPETENSI</h1>
<table border="1" width="700">
    <tr>
		<td colspan="3"><strong>DATA PRIBADI</strong></td>
	</tr>
	<tr>
		<td><strong>Nama</strong></td>
		<td colspan="2">: <?php echo $row_peg['peg_nama']?></td>
	</tr>
	<tr>
		<td><strong>Nipp</strong></td>
		<td colspan="2">: <?php echo $row_peg['peg_nipp']?></td>
	</tr>
	<tr>
		<td><strong>Tempat, Tanggal Lahir</strong></td>
		<td colspan="2">:  <?php echo $row_peg['peg_tmpt_lahir'].'/'.mdate($datestring,strtotime($row_peg['peg_tgl_lahir']));?></td>
	</tr>
	<tr>
		<td><strong>TMT</strong></td>
		<td colspan="2">: <?php echo mdate($datestring,strtotime($row_jt['p_tmt_tmt']));?></tr>
	<tr>
		<td><strong>Grade</strong></td>
		<td colspan="2">: <?php echo $grade;?></td>
	</tr>
	<tr>
		<td><strong>Unit Kerja</strong></td>
		<td colspan="2">: <?php echo $unit;?></td>
	</tr>
	<tr>
		<td><strong>Jabatan Terakhir</strong></td>
		<td colspan="2">: <?php echo $row_jt['p_jbt_jabatan'];?></td>
	</tr>
	<tr>
		<td><strong>Status Keluarga</strong></td>
		<td colspan="2">: <?php echo $row_stk['p_stk_status_keluarga'];?></td>
	</tr>
	<tr>
		<td><strong>Jenis Kelamin</strong></td>
		<td colspan="2">: <?php if($row_peg['peg_jns_kelamin'] == 'P'){echo 'Perempuan';} else {echo 'Laki Laki';};?></td>
	</tr>
	<tr>
		<td><strong>Golongan Darah</strong></td>
		<td colspan="2">: <?php echo $row_peg['peg_gol_darah'];?></td>
	</tr>
	<tr>
		<td><strong>Tinggi</strong></td>
		<td colspan="2">: <?php echo $row_fis['p_fs_tinggi'].' cm';?></td>
	</tr>
	<tr>
		<td><strong>Berat</strong></td>
		<td colspan="2">: <?php echo $row_fis['p_fs_berat'].' kg';?></td>
	</tr>
	<tr>
		<td><strong>Alamat</strong></td>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td><div align="right"><strong>Jl dan No</strong></div></td>
	    <td colspan="2">: <?php echo $row_al['p_al_jalan'];?></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Kelurahan</strong></div></td>
	    <td>: <?php echo $row_al['p_al_kelurahan'];?></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Kecamatan</strong></div></td>
	    <td>: <?php echo $row_al['p_al_kecamatan'];?></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Kabupaten</strong></div></td>
	    <td>: <?php echo $row_al['p_al_kabupaten'];?></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Propinsi</strong></div></td>
	    <td>: <?php echo $row_al['p_al_provinsi'];?></td>
	</tr>
	<tr>
		<td><strong>Pendidikan terakhir</strong></td>
		<td colspan="2">: <?php echo $pendidikan_terakhir;?></td>
	</tr>
	<tr>
		<td><strong>No Telepon</strong></td>
		<td colspan="2">: <?php echo $row_al['p_al_no_telp'];?></td>
	</tr>
	<tr>
		<td><strong>Email</strong></td>
		<td colspan="2">: <?php echo $row_al['p_al_email'];?></td>
	</tr>
	<?php if ($jumlah_bahasa == 0)
							{
								$jumlah_bahasa = 1;
							} ?>
							<tr><td rowspan=<?php echo $jumlah_bahasa ?>><strong>Bahasa yang dikuasai</strong></td>
							<?php 
							$jumlah_bhs = 1;
							if ($data_bahasa == NULL)
							{ ?>
								<td></td>
							<?php }
							foreach ($data_bahasa as $row_bhs) :
							{ 	
							if ($jumlah_bhs == 1)
							{?>
								<td>: <?php echo $row_bhs['p_bhs_bahasa'];?></td>
							<?php } else {
							?>
								<tr><td>: <?php echo $row_bhs['p_bhs_bahasa'];?></td></tr>
							<?php }
							$jumlah_bhs++;
							}endforeach; ?>
	
</table>
<br />
<!-- =============================================================================== -->
<table border="1" width="700">
	<tr><td colspan="5"><strong>PENDIDIKAN UMUM</strong></td></tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">No</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tingkat</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Sekolah</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Dari</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Sampai</div></td>
  </tr>
  <?php 
	$nomor = '1';
	foreach ($data_pendidikan_full as $row_pdd_full){ ?>
		<tr>
			<td><div align='center'><?php echo $nomor ?></div></td>
			<td><div align='center'><?php echo $row_pdd_full['p_pdd_tingkat'];?></div></td>
			<td><div align='center'><?php echo $row_pdd_full['p_pdd_lp'];?></div></td>
			<td><div align='center'><?php echo $row_pdd_full['p_pdd_masuk'];?></div></td>
			<td><div align='center'><?php echo $row_pdd_full['p_pdd_keluar'];?></div></td>
		</tr>
	<?php $nomor++;} ?>
</table>
<br>

<table border="1" width="700">
	<tr><td colspan="7"><strong>PENDIDIKAN LATIHAN PENJENJANGAN / KECAKAPAN</strong></td></tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">No</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Diklat</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Rating</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Penyelenggara</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Dari</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Sampai</div></td>
    <td bgcolor="#CCCCCC"><div align="center">No License </div></td>
  </tr>
  <?php 
  $nomor = '1';
  $stkp = '';
  $waktu = '';
  foreach ($data_stkp as $row_stkp) {
  if ($stkp != $row_stkp['p_stkp_rating']){
	?>
	  <tr>
		<td><div align='center'><?php echo $nomor; ?></div></td>
		<td><div align='center'><?php echo $row_stkp['p_stkp_jenis'];?></div></td>
		<td><div align='center'><?php echo $row_stkp['p_stkp_rating'];?></div></td>
		<td><div align='center'><?php echo $row_stkp['p_stkp_lembaga'];?></div></td>
		<td><div align='center'><?php echo mdate($datestring,strtotime($row_stkp['p_stkp_mulai'])) ;?></div></td>
		<td><div align='center'><?php echo mdate($datestring,strtotime($row_stkp['p_stkp_finish'])) ;?></div></td>
		<td><div align='center'><?php echo $row_stkp['p_stkp_no_license'];?></div></td>
	  </tr>
  <?php $nomor++;} else {
  if ($waktu < $row_stkp['p_stkp_finish']) { ?>
	<tr>
		<td><div align='center'><?php echo $nomor; ?></div></td>
		<td><div align='center'><?php echo $row_stkp['p_stkp_jenis'];?></div></td>
		<td><div align='center'><?php echo $row_stkp['p_stkp_lembaga'];?></div></td>
		<td><div align='center'><?php echo mdate($datestring,strtotime($row_stkp['p_stkp_mulai'])) ;?></div></td>
		<td><div align='center'><?php echo mdate($datestring,strtotime($row_stkp['p_stkp_finish'])) ;?></div></td>
		<td><div align='center'><?php echo $row_stkp['p_stkp_no_license'];?></div></td>
	  </tr>
	<?php $nomor++;}
	}
  $stkp = $row_stkp['p_stkp_rating'];
  $waktu = $row_stkp['p_stkp_finish'];
  } ?>
</table>
<br>

<table border="1" width="700">
	<tr><td colspan="6"><strong>PENDIDIKAN LATIHAN PENJENJANGAN / KECAKAPAN (NON STKP)</strong></td></tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">No</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Training</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Penyelenggara</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Dari</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Sampai</div></td>
    <td bgcolor="#CCCCCC"><div align="center">No License </div></td>
  </tr>
  <?php 
				$datestring = "%d-%M-%Y" ;
				$nipp = '';
				if ($this->uri->segment(3)== NULL)
				{
					$number = 1;
				} else {
					if ($this->uri->segment(2) == 'get_non_stkp')
					{
						$number = $this->uri->segment(3)+1;
					} else {
						$number = $this->uri->segment(5)+1;
					}
				}
				foreach ($data_nstkp as $row_pegawai) :
				{ 
					if ($row_pegawai['p_nstkp_pelaksanaan'] == '0000-00-00')
					{
						$pelaksanaan = '-';
					}
					else
					{
						$pelaksanaan = $row_pegawai['p_nstkp_pelaksanaan'];
					}
					
					if ($row_pegawai['p_nstkp_jenis'] == ""){$jenis_anchor = "";} else {$jenis_anchor = $row_pegawai['p_nstkp_jenis'];}
					if ($row_pegawai['p_nstkp_lembaga'] == ""){$lembaga_anchor = "";} else {$lembaga_anchor = $row_pegawai['p_nstkp_lembaga'];}
					if ($row_pegawai['p_nstkp_selesai'] == '0000-00-00')
					{
						$selesai = '-';
					}
					else
					{
						$selesai =mdate($datestring,strtotime( $row_pegawai['p_nstkp_selesai']));
					}
					if ($row_pegawai['p_nstkp_pelaksanaan'] == '0000-00-00')
					{
						$mulai = '-';
					}else
					{
						$mulai = mdate($datestring,strtotime($row_pegawai['p_nstkp_pelaksanaan']));
					}
					
					?><tr>
                        <td><center><?php echo $number; ?></center></td>
						<td><?php echo $jenis_anchor; ?></td>
						<td><center><?php echo $row_pegawai['p_nstkp_no_license']; ?></center></td>
						<td><center><?php echo $mulai; ?></center></td>
						<td><center><?php echo $selesai; ?></center></td>
						<td><center><?php echo $lembaga_anchor; ?></center></td>
						
						<?php $number++;} endforeach;?>
					</tr>
</table>
<br>

<table border="1" width="700">
	<tr><td colspan="7"><strong>RIWAYAT GOLONGAN / KEPANGKATAN</strong></td></tr>
  <tr>
    <td bgcolor="#CCCCCC" rowspan="2" ><div align="center">No</div></td>
    <td bgcolor="#CCCCCC" rowspan="2"><div align="center">Pangkat</div></td>
    <td bgcolor="#CCCCCC" rowspan="2"><div align="center">TMT</div></td>
    <td bgcolor="#CCCCCC" colspan="3"><div align="center">Surat Keputusan </div></td>
    <td bgcolor="#CCCCCC" rowspan="2"><div align="center">Keterangan</div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">Pejabat</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Nomor</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tanggal</div></td>
  </tr>
</table>
<br>

<table border="1" width="700">
	<tr><td colspan="8"><strong>RIWAYAT JABATAN</strong></td></tr>
  <tr>
    <td rowspan="2" bgcolor="#CCCCCC" ><div align="center">No</div></td>
    <td rowspan="2" bgcolor="#CCCCCC"><div align="center">Jabatan</div></td>
    <td rowspan="2" bgcolor="#CCCCCC"><div align="center">Unit Kerja</div></td>
    <td rowspan="2" bgcolor="#CCCCCC"><div align="center">TMT</div></td>
    <td colspan="3" bgcolor="#CCCCCC"><div align="center">Surat Keputusan </div></td>
    <td rowspan="2" bgcolor="#CCCCCC"><div align="center">Keterangan</div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">Pejabat</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Nomor</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tanggal</div></td>
  </tr>
</table>
<br>

<table border="1" width="700">
	<tr><td colspan="5"><strong>SANKSI DISIPLIN YANG PERNAH DIJALANI</strong></td></tr>
  <tr>
    <td rowspan="2" bgcolor="#CCCCCC"><div align="center">No</div></td>
    <td rowspan="2" bgcolor="#CCCCCC"><div align="center">Jenis Sanksi </div></td>
    <td colspan="2" bgcolor="#CCCCCC"><div align="center">Masa Sanksi </div></td>
    <td rowspan="2" bgcolor="#CCCCCC"><div align="center">Keterangan</div></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">Dari</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Sampai</div>      <div align="center"></div></td>
  </tr>
  
</table>
<br>
</body>
</html>



