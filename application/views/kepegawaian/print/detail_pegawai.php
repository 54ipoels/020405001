<html>
<head>
	<title>DATA PEGAWAI</title>
</head>
<body>
<?php 
				foreach ($pegawai as $row_pegawai) :
				{ 
					if ($row_pegawai['peg_jns_kelamin'] == 'P')
					{
						$kelamin = 'Perempuan';
					}
					else
					{
						$kelamin = 'Laki Laki';
					}
					if ($row_pegawai['peg_gol_darah'] == NULL)
					{
						$gol_darah = '-';
					}
					else
					{
						$gol_darah = $row_pegawai['peg_gol_darah'];
					}
					$datestring = "%d-%m-%Y" ;
					$tgl_lahir = mdate($datestring,strtotime($row_pegawai['peg_tgl_lahir']));
					$detail = anchor('pekerja/get_pegawai/'.$row_pegawai['peg_nipp'],'Detail'); 
				}endforeach; 
				if ($data_agama == NULL)
					{ $agama = '-';}
				else {
					foreach ($data_agama as $row_agama) :
					{ 
						$agama = $row_agama['p_ag_agama'];
					}endforeach;
				}
				
				if ($data_fisik == NULL)
					{ $foto = '';
					  $tinggi = '-';
					  $berat = '-';}
				foreach ($data_fisik as $row_fisik) :
				{ 
					$foto = $row_fisik['p_fs_foto'];
					$tinggi = $row_fisik['p_fs_tinggi'];
					$berat = $row_fisik['p_fs_berat'];
				}endforeach;
				if ($data_alamat == NULL)
					{ $telp = '-';
					  $jalan = '-';
					  $kelurahan = '-';
					  $kecamatan = '-';
					  $kabupaten = '-';
					  $provinsi = '-';
					  $email = '-';
					  }
				foreach ($data_alamat as $row_alamat) :
				{ 
					$telp = $row_alamat['p_al_no_telp'];
					$jalan = $row_alamat['p_al_jalan'];
					$kelurahan = $row_alamat['p_al_kelurahan'];
					$kecamatan = $row_alamat['p_al_kecamatan'];
					$kabupaten = $row_alamat['p_al_kabupaten'];
					$provinsi = $row_alamat['p_al_provinsi'];
					$email = $row_alamat['p_al_email'];
				}endforeach;
				if ($data_status_keluarga == NULL)
					{ $row_stk['p_stk_status_keluarga'] = '-';}
				foreach ($data_status_keluarga as $row_stk) :
				{ 
				}endforeach;
				if ($data_pendidikan == NULL)
				{
					$row_pdd['p_pdd_tingkat'] = '';
					$row_pdd['p_pdd_lp']='';
					$row_pdd['p_pdd_masuk']='';
					$row_pdd['p_pdd_keluar']='';
				}else{
					foreach ($data_pendidikan as $row_pdd) :
					{ 
					}endforeach;
				}
				?>  
				<?php
				if($data_jabatan==NULL){
					$jabatan = "-";
					$tmt_jabatan = "-";
					
				}
				else{
				foreach ($data_jabatan as $row_jbt) :
				{
					$datestring = "%d-%m-%Y" ;
					$jabatan = $row_jbt['p_jbt_jabatan'];
					$tmt_jabatan = mdate($datestring,strtotime($row_jbt['p_jbt_tmt_start']));
				} endforeach;
				}
				
				if($data_tmt==NULL)
				{
					$status="-";
					$tmt = "-";
					$provider ="-";
					$tmt_reason = "-";
				} else {
					foreach ($data_tmt as $row_tmt) :
					{
						$datestring = "%d-%m-%Y" ;
						$tmt = mdate($datestring,strtotime($row_tmt['p_tmt_tmt']));
						$status = $row_tmt['p_tmt_status'];
						$provider = $row_tmt['p_tmt_provider'];
						$tmt_reason = $row_tmt['p_tmt_reason'];
					} endforeach;
					
					
				}
				
				if($data_unit==NULL){
					$kode_unit="-";
					$grade = "-";
				} else {
				foreach ($data_unit as $row_unit) :
				{
					$kode_unit = $row_unit['p_unt_kode_unit'];
				} endforeach;
				if ($data_grade == NULL)
				{ $grade = '';} else {
					foreach ($data_grade as $row_grade) :
					{
						$grade = $row_grade['p_grd_grade'];
					} endforeach;
				}
				}
				?>

<h1>DATA PEGAWAI</h1>
<table border="1" width="700">
    <tr>
		<td colspan="3"><strong>DATA PRIBADI</strong></td>
	</tr>
	<tr>
		<td><strong>Nama</strong></td>
		<td colspan="2">: <?php echo $row_pegawai['peg_nama']?></td>
	</tr>
	<tr>
		<td><strong>Nipp</strong></td>
		<td colspan="2">: <?php echo $row_pegawai['peg_nipp']?></td>
	</tr>
	<tr>
		<td><strong>Tempat, Tanggal Lahir</strong></td>
		<td colspan="2">:  <?php echo $row_pegawai['peg_tmpt_lahir'].'/'.mdate($datestring,strtotime($tgl_lahir));?></td>
	</tr>
	<tr>
		<td><strong>TMT</strong></td>
		<td colspan="2">: <?php echo $tmt;?></tr>
	<tr>
		<td><strong>Grade</strong></td>
		<td colspan="2">: <?php echo $grade;?></td>
	</tr>
	<tr>
		<td><strong>Unit Kerja</strong></td>
		<td colspan="2">: <?php echo $kode_unit;?></td>
	</tr>
	<tr>
		<td><strong>Jabatan Terakhir</strong></td>
		<td colspan="2">: <?php echo $jabatan;?></td>
	</tr>
	<tr>
		<td><strong>Status Keluarga</strong></td>
		<td colspan="2">: <?php echo $row_stk['p_stk_status_keluarga'];?></td>
	</tr>
	<tr>
		<td><strong>Jenis Kelamin</strong></td>
		<td colspan="2">: <?php if($row_pegawai['peg_jns_kelamin'] == 'P'){echo 'Perempuan';} else {echo 'Laki Laki';};?></td>
	</tr>
	<tr>
		<td><strong>Golongan Darah</strong></td>
		<td colspan="2">: <?php echo $row_pegawai['peg_gol_darah'];?></td>
	</tr>
	<tr>
		<td><strong>Tinggi</strong></td>
		<td colspan="2">: <?php echo $tinggi.' cm';?></td>
	</tr>
	<tr>
		<td><strong>Berat</strong></td>
		<td colspan="2">: <?php echo $berat.' kg';?></td>
	</tr>
	<tr>
		<td><strong>Alamat</strong></td>
		<td colspan="2">&nbsp;</td>
	</tr>
	<tr>
		<td><div align="right"><strong>Jl dan No</strong></div></td>
	    <td colspan="2">: <?php echo $jalan;?></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Kelurahan</strong></div></td>
	    <td>: <?php echo $kelurahan;?></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Kecamatan</strong></div></td>
	    <td>: <?php echo $kecamatan;?></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Kabupaten</strong></div></td>
	    <td>: <?php echo $kabupaten;?></td>
	</tr>
	<tr>
		<td><div align="right"><strong>Propinsi</strong></div></td>
	    <td>: <?php echo $provinsi;?></td>
	</tr>
	<tr>
		<td><strong>Pendidikan terakhir</strong></td>
		<td colspan="2">: <?php echo $row_pdd['p_pdd_tingkat'];?></td>
	</tr>
	<tr>
		<td><strong>No Telepon</strong></td>
		<td colspan="2">: <?php echo $telp;?></td>
	</tr>
	<tr>
		<td><strong>Email</strong></td>
		<td colspan="2">: <?php echo $email;?></td>
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
	<!--
	<tr>
		<td><strong>Anak ke</strong></td>
		<td colspan="2">: <?php //echo $sdr_ke.' dari '.$jumlah_sdr.' bersaudara';?></td>
	</tr>
	-->
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
	foreach ($data_pendidikan as $row_pdd_full){ ?>
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
  <?php
	if ($data_grade == NULL) {}
	else {
		$no_grade=0;
		$datestring = "%d-%M-%Y" ;
		foreach ($data_grade as $row_grade)
		{
			$no_grade++;
			$tmt = mdate($datestring, $row_grade['p_grd_update_on']) ;
		?>	
			<tr>
				<td><?php echo $no_grade; ?></td>
				<td><?php echo $row_grade['p_grd_grade']; ?></td>
				<td><?php echo $tmt; ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
		<?php
		}
	}
  
  ?>
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
  <?php	if ($data_jabatan_detail !== NULL ){ $no_jbt=0;
		foreach($data_jabatan_detail as $row_djd ){ 
			$no_jbt++;
		?>
			<tr>
			<td><?php echo $no_jbt; ?></td>
			<td><?php echo $row_djd['p_jbt_jabatan']; ?></td>
			<td><?php echo $row_djd['p_unt_kode_unit']; ?></td>
			<td><?php echo $row_djd['p_jbt_tmt_start']; ?></td>
			<td><?php //echo $row_djd['p_jbt_sk']; ?></td>
			<td><?php //echo $row_djd['p_jbt_keterangan']; ?></td>
			<td><?php // echo $row_djd['p_jbt_jabatan']; ?></td>
			<td><?php //echo $row_djd['p_jbt_jabatan']; ?></td>
			</tr>
  <?php }
		}?>
 <!-- <tr>
    <td><div align='center'>$nomor</div></td>
    <td><div align='center'>$dd[jabatan]</div></td>
	<td><div align='center'>$dd[unit]</div></td>
    <td><div align='center'>";$indo = explode("-",$dd[tmt_capeg_pegttp]);echo "$indo[2]-$indo[1]-$indo[0]";echo"</div></td>
    <td><div align='center'>$dd[pejabat]</div></td>
    <td><div align='center'>$dd[nomor]</div></td>
	<td><div align='center'>";$indo = explode("-",$dd[tanggal]);echo "$indo[2]-$indo[1]-$indo[0]";echo"</div></td>
	<td><div align='center'>$dd[ket]</div></td>
  </tr> -->
</table>
<br>
<!--
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
  <!--<tr>
    <td><div align='center'>$nomor</div></td>
    <td><div align='center'>$ee[jenis_sanksi]</div></td>
	<td><div align='center'>";$indo = explode("-",$ee[dari]);echo "$indo[2]-$indo[1]-$indo[0]";echo"</div></td>
    <td><div align='center'>";$indo = explode("-",$ee[sampai]);echo "$indo[2]-$indo[1]-$indo[0]";echo"</div></td>
    <td><div align='center'>$ee[jenis_pelanggaran]</div></td>
  </tr>-->
<!--
</table>
<br>
-->

<table border="1" width="700">
	<tr><td colspan="7"><strong>PASANGAN</strong></td></tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">Nama </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tempat Lahir </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tanggal Lahir </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tanggal Meninggal</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Alamat</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Pekerjaan</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Jenis Kelamin</div></td>
  </tr>
	<?php if ($data_pasangan == NULL)
			{
				$row_pasangan['p_ps_nama'] = '-';
				$row_pasangan['p_ps_tmpt_lahir'] = '-';
				$ps_tgl_lahir = '-';
				$ps_tgl_meninggal = '-';
				$row_pasangan['p_ps_alamat'] = '-';
				$row_pasangan['p_ps_pekerjaan'] = '-';
				$row_pasangan['p_ps_agama'] = '-';
				$row_pasangan['p_ps_jns_kelamin'] = '-';
					
			}else{
				foreach ($data_pasangan as $row_pasangan) :
				{
				$datestring = "%d-%m-%Y" ;
				//$tgl_lahir = mdate($datestring,strtotime($row_pasangan['p_ps_tgl_lahir']));
						
				if ($row_pasangan['p_ps_tgl_lahir'] == '0000-00-00'){$ps_tgl_lahir="-";} 
				else {$ps_tgl_lahir = mdate($datestring,strtotime($row_pasangan['p_ps_tgl_lahir']));}
				if ($row_pasangan['p_ps_tgl_meninggal'] == '0000-00-00'){$ps_tgl_meninggal="-";} 
				else {$ps_tgl_meninggal = mdate($datestring,strtotime($row_pasangan['p_ps_tgl_meninggal']));}
				?>
				<tr>
					<td><?php  echo $row_pasangan['p_ps_nama']; ?></td>
					<td><?php  echo $row_pasangan['p_ps_tmpt_lahir']; ?></td>
					<td><?php  echo $ps_tgl_lahir; ?></td>
					<td><?php  echo $ps_tgl_meninggal; ?></td>
					<td><?php  echo $row_pasangan['p_ps_alamat']; ?></td>
					<td><?php  echo $row_pasangan['p_ps_pekerjaan']; ?></td>
					<td><?php  echo $row_pasangan['p_ps_jns_kelamin']; ?></td>
				</tr>	
				<?php
				} endforeach;
			}?>
	
</table>
<br>


<table border="1" width="700">
<tr><td colspan="7"><strong>ANAK</strong></td></tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">Nama </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tempat Lahir </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tanggal Lahir </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Pendidikan</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Jenis Kelamin</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Agama</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Status</div></td>
  </tr>
	<?php  
		$number = 1;
		$datestring = "%d-%m-%Y" ;
		foreach ($data_anak as $row_anak) :
		{ 
			if($row_anak['peg_ank_tgl_lahir']=='0000-00-00'){$tgl_lahir_anak="00-00-0000";}
			else { $tgl_lahir_anak = mdate($datestring,strtotime($row_anak['peg_ank_tgl_lahir']));}
	?>
            <tr>
				<td><?php echo $row_anak['peg_ank_nama']; ?></td>
				<td><?php echo $row_anak['peg_ank_tempat_lahir'] ?></td>
				<td><?php echo $tgl_lahir_anak;?></td>
				<td><?php echo $row_anak['peg_ank_pendidikan'];?></td>
				<td><?php if($row_anak['peg_ank_jns_kelamin']=='L'){$jk='Laki-Laki';}
					else if($row_anak['peg_ank_jns_kelamin']=='P'){$jk='Perempuan';}
					else {$jk='-';}
					echo $jk;
					?></td>
				<td><?php echo $row_anak['peg_ank_agama']; ?></td>
				<td><?php echo $row_anak['peg_ank_status']; ?></td>
            </tr>
			<?php 
			$number++;
		} endforeach;
	?>
</table>
<br>

<table border="1" width="700">
<tr><td colspan="7"><strong>ORANG TUA</strong></td></tr>
  <tr>
    <td bgcolor="#CCCCCC"><div align="center">Nama </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tempat Lahir </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tanggal Lahir </div></td>
    <td bgcolor="#CCCCCC"><div align="center">Tanggal Meninggal</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Alamat</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Pekerjaan</div></td>
    <td bgcolor="#CCCCCC"><div align="center">Keterangan</div></td>
  </tr>
<?php 
	if ($data_ayah == NULL)
	{}else{
		foreach($data_ayah as $row_ayah) :
		{
			$datestring = "%d-%m-%Y" ;
			if ($row_ayah['p_ay_tgl_lahir'] == '0000-00-00'){$ay_tgl_lahir="-";} 
			else {$ay_tgl_lahir = mdate($datestring,strtotime($row_ayah['p_ay_tgl_lahir']));}
			if ($row_ayah['p_ay_tgl_meninggal'] == '0000-00-00'){$ay_tgl_meninggal="-";} 
			else {$ay_tgl_meninggal = mdate($datestring,strtotime($row_ayah['p_ay_tgl_meninggal']));}
			?>
			<tr>
				<td><?php echo $row_ayah['p_ay_nama'];?></td>
				<td><?php echo $row_ayah['p_ay_tmpt_lahir'];?></td>
				<td><?php echo $ay_tgl_lahir;?></td>
				<td><?php echo $ay_tgl_meninggal;?></td>
				<td><?php echo $row_ayah['p_ay_alamat'];?></td>
				<td><?php echo $row_ayah['p_ay_pekerjaan'];?></td>
				<td>Ayah</td>
			</tr>
			<?php
		} endforeach;
	}
					
	if ($data_ibu == NULL)
	{} else {
		foreach($data_ibu as $row_ibu) :
		{
			$datestring = "%d-%m-%Y" ;
			if ($row_ibu['p_ibu_tgl_lahir'] == '0000-00-00'){$ibu_tgl_lahir="-";} 
			else {$ibu_tgl_lahir = mdate($datestring,strtotime($row_ibu['p_ibu_tgl_lahir']));}
			if ($row_ibu['p_ibu_tgl_meninggal'] == '0000-00-00'){$ibu_tgl_meninggal="-";} 
			else {$ibu_tgl_meninggal = mdate($datestring,strtotime($row_ibu['p_ibu_tgl_meninggal']));}
		?>
			<tr>
				<td><?php echo $row_ibu['p_ibu_nama'];?></td>
				<td><?php echo $row_ibu['p_ibu_tmpt_lahir'];?></td>
				<td><?php echo $ibu_tgl_lahir;?></td>
				<td><?php echo $ibu_tgl_meninggal;?></td>
				<td><?php echo $row_ibu['p_ibu_alamat'];?></td>
				<td><?php echo $row_ibu['p_ibu_pekerjaan'];?></td>
				<td>Ibu</td>
			</tr>
		<?php
		} endforeach;
	}
	if ($data_mert_ayah == NULL)
	{}else{
		foreach($data_mert_ayah as $row_m_ayah) :
		{
			$datestring = "%d-%m-%Y" ;
			if ($row_m_ayah['p_may_tgl_lahir'] == '0000-00-00'){$m_ay_tgl_lahir="-";} 
			else {$m_ay_tgl_lahir = mdate($datestring,strtotime($row_m_ayah['p_may_tgl_lahir']));}
			if ($row_m_ayah['p_may_tgl_meninggal'] == '0000-00-00'){$m_ay_tgl_meninggal="-";} 
			else {$m_ay_tgl_meninggal = mdate($datestring,strtotime($row_m_ayah['p_may_tgl_meninggal']));}
			?>
			<tr>
				<td><?php echo $row_m_ayah['p_may_nama'];?></td>
				<td><?php echo $row_m_ayah['p_may_tmpt_lahir'];?></td>
				<td><?php echo $m_ay_tgl_lahir;?></td>
				<td><?php echo $m_ay_tgl_meninggal;?></td>
				<td><?php echo $row_m_ayah['p_may_alamat'];?></td>
				<td><?php echo $row_m_ayah['p_may_pekerjaan'];?></td>
				<td>Ayah</td>
			</tr>
			<?php
					
		} endforeach;}
	if ($data_mert_ibu == NULL)
	{} else {
		foreach($data_mert_ibu as $row_m_ibu) :
		{
			$datestring = "%d-%m-%Y" ;
			if ($row_m_ibu['p_mib_tgl_lahir'] == '0000-00-00'){$m_ibu_tgl_lahir="-";} 
			else {$m_ibu_tgl_lahir = mdate($datestring,strtotime($row_m_ibu['p_mib_tgl_lahir']));}
			if ($row_m_ibu['p_mib_tgl_meninggal'] == '0000-00-00'){$m_ibu_tgl_meninggal="-";} 
			else {$m_ibu_tgl_meninggal = mdate($datestring,strtotime($row_m_ibu['p_mib_tgl_meninggal']));}
		?>
			<tr>
				<td><?php echo $row_m_ibu['p_mib_nama'];?></td>
				<td><?php echo $row_m_ibu['p_mib_tmpt_lahir'];?></td>
				<td><?php echo $m_ibu_tgl_lahir;?></td>
				<td><?php echo $m_ibu_tgl_meninggal;?></td>
				<td><?php echo $row_m_ibu['p_mib_alamat'];?></td>
				<td><?php echo $row_m_ibu['p_mib_pekerjaan'];?></td>
				<td>Ibu Mertua</td>
			</tr>
		<?php
		} endforeach;}
	?>
</table>
<br>

</body>
</html>



