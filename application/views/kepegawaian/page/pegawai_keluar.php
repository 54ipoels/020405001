<?php $this->load->helper('asset');?>

<div class="widget">
<fieldset class="step" id="w2first"><br> 
<table><tr><td width='30px'></td><td width = "740px">    
				<div class="searchWidget1">
					<a href="<?php echo base_url().'index.php/pekerja/pegawai_pensiun' ;?>"><input type="button" name="Pensiun" value="Pensiun" class="blueB m110"/></a>
					<a href="<?php echo base_url().'index.php/pekerja/get_pindah_cabang' ;?>"><input type="button" name="Pindah" value="Pindah Cabang" class="blueB m110"/></a>
					<a href="<?php echo base_url().'index.php/pekerja/get_pegawai_phk' ;?>"><input type="button" name="PHK" value="PHK" class="blueB m110"/></a>
				</div>
            </td>
	<td width="250px"><div class="searchWidget1"><?php echo form_open('pekerja/search_pegawai_keluar');?>
                        <input type="text" name="search"  placeholder="Enter search text..." />
                        <input type="submit" name="find" value="" class="blueB m110"/></div>
                    </form></td></tr>

</div></div></table></fieldset>
</div>

<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Data Pegawai </h6><div style="color:red;";><h6><?php echo "$count pegawai";?></h6></div></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>NIPP</td>
                        <td>Nama</td>
                        <td>Tempat Lahir</td>
                        <td>Tanggal Lahir</td>
                        <td>Jenis Kelamin</td>
                        <td>Jabatan</td>
						<td>Status</td>
                        <td>Detail</td>
                    </tr>
                </thead>
				<tfoot>
					<tr><td colspan=9><center><div class="pagination"><?php echo $this->pagination->create_links();?></div></center></td></td></tr>
				</tfoot>
				<tbody>
				<?php 
				if ($this->uri->segment(3)== NULL)
				{
					$number = 1;
				} else {
					$number = $this->uri->segment(5)+1;
				}
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
					$datestring = "%d-%m-%Y" ;
					$tgl_lahir = mdate($datestring,strtotime($row_pegawai['peg_tgl_lahir']));
					$detail = anchor('pekerja/get_pegawai/'.$row_pegawai['peg_nipp'],'Detail'); ?>
					<tr>
                        <td><center><?php echo $number; ?></center></td>
						<td><center><?php echo $row_pegawai['peg_nipp']; ?></center></td>
						<td><?php echo strtoupper($row_pegawai['peg_nama']); ?></td>
						<td><?php echo strtoupper($row_pegawai['peg_tmpt_lahir']); ?></td>
						<td><center><?php echo $tgl_lahir; ?></center></td>
						<td><center><?php echo strtoupper($kelamin); ?></center></td>
						<td><center><?php echo strtoupper($row_pegawai['p_jbt_jabatan']); ?></center></td>
						<td>
							<center>
								<?php  
									$yearstring = '%Y';
									$usia_end = mdate($yearstring,strtotime($row_pegawai['p_tmt_end'])) - mdate($yearstring, strtotime($row_pegawai['peg_tgl_lahir']));
									$usia = mdate($yearstring,now()) - mdate($yearstring, strtotime($row_pegawai['peg_tgl_lahir']));
									if($row_pegawai['p_tmt_reason'] == "Pindah Cabang" ){
										echo "Pindah Cabang ".$row_pegawai['p_cab_kode_cabang'];
									} else
									if ($usia > 52){
										if(($usia > 55)  ){
											echo "Pensiun";										
										} else
										if(($usia >= 52) AND ($usia < 54) ){
											echo "PPB";										
										} else
										if(($usia >= 54) AND ($usia < 56) ){
											echo "MPP";										
										}
									}
									else {
										echo $row_pegawai['p_tmt_reason'];
									} 
									
								?>
							</center>
						</td>
						<td><center><?php echo $detail ?></center></td>
                    </tr> <?php
					$number++;
				}endforeach; 
				?>
                </tbody>
            </table>
		</div>
		<?php $attr= array('target' => '_blank');
				echo anchor('pekerja/excel_data_pensiun','Export to Excel',$attr); ?>