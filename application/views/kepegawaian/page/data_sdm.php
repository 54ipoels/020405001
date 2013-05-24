<?php $this->load->helper('asset');?>

<div class="widget">
<fieldset class="step" id="w2first"><br> 
<table><tr><td width = "470px">
<?php echo form_open('pekerja/search_data_sdm');?>
	<div class="formBaru"><label>Unit Kerja: &nbsp </label>	
	<?php
		$unit = array();
		$unit['ALL']	= "ALL" ;
		foreach ($list_unit as $row_unit) :
			{ $unit[$row_unit['kode_unit']] = ($row_unit['nama_unit']); } 
		endforeach; 
		echo form_dropdown('unit',$unit); 
	?>
	</div>
	</td>
	<td width="550px"><div class="searchWidget1">
	                    <input type="text" name="search"  placeholder="Enter search text..." />
                        <input type="submit" name="find" value="" class="blueB m110"/></div>
                    </form></td></tr>

</div></div></table></fieldset>
</div>

<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Data Pegawai</h6><div style="color:red;";><h6><?php echo "$count pegawai";?></h6> </div></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>NIPP</td>
                        <td>Unit</td>
                        <td>T.M.T</td>
                        <td>Nama</td>
                        <td>Tempat Lahir</td>
                        <td>Tanggal Lahir</td>
                        <td>Umur</td>
                        <td>Jenis Kelamin</td>
                        <td>Status</td>
                        <td>Status Kawin</td>
                        <td>Alamat</td>
                        <td>Telp</td>
                        <td>Agama</td>
                    </tr>
                </thead>
				<tfoot>
					<tr><td colspan=14><center><div class="pagination"><?php echo $this->pagination->create_links();?></div></center></td></td></tr>
				</tfoot>
				<tbody>
				<?php 
				if ($this->uri->segment(3)== NULL)
				{
					$number = 1;
				} else {
					if($this->uri->segment(2) == 'sort_unit_pegawai') {$number = $this->uri->segment(4)+1;} else {
					$number = $this->uri->segment(3)+1;}
				}
				foreach ($pegawai as $row_pegawai) :
				{ 
					// pengambilan data anak pegawai //
					$anak = get_data_anak($row_pegawai['peg_nipp']);
					$jumlah_anak = count_jumlah_anak($row_pegawai['peg_nipp']);
					//
					$yearstring = '%Y';
					$umur = mdate($yearstring,now()) - mdate($yearstring, strtotime($row_pegawai['peg_tgl_lahir']));
					$umur_ps = mdate($yearstring,now()) - mdate($yearstring, strtotime($row_pegawai['p_ps_tgl_lahir']));
					$datestring = "%d-%M-%Y" ;
					$tgl_lahir = mdate($datestring,strtotime($row_pegawai['peg_tgl_lahir']));
					$tgl_lahir_ps = mdate($datestring,strtotime($row_pegawai['p_ps_tgl_lahir']));
					if($row_pegawai['p_unt_tmt_start'] == '0000-00-00' OR $row_pegawai['p_unt_tmt_start']==""){
						$unit_tmt= "-";
					}else{
						$unit_tmt= mdate($datestring,strtotime($row_pegawai['p_unt_tmt_start']));
					}
					if ($row_pegawai['peg_jns_kelamin'] == 'L')
					{
						$status_ps = 'ISTERI';
						$sex_ps = 'P';
					} else 
					{
						$status_ps = 'SUAMI';
						$sex_ps = 'L';
					}
					if (($row_pegawai['p_stk_status_keluarga'] != 'TK') && ($row_pegawai['p_stk_status_keluarga'] != ''))
					{
						$rowspan = $jumlah_anak+2;
					} else
					if ($row_pegawai['p_stk_status_keluarga'] == 'K')
					{
						$rowspan = 2;
					} else
					if ($row_pegawai['p_stk_status_keluarga'] == 'TK')
					{
						$rowspan = 1;
					}else
					if ($row_pegawai['p_stk_status_keluarga'] == '')
					{
						$rowspan = 1;
					}
					$detail = anchor('pekerja/get_pegawai/'.$row_pegawai['peg_nipp'],$row_pegawai['peg_nipp']);  ?>
					<tr>
                        <td rowspan="<?php echo $rowspan;?>"><center><?php echo $number; ?></center></td>
						<td rowspan="<?php echo $rowspan;?>"><center><?php echo $detail; ?></center></td>
						<td rowspan="<?php echo $rowspan;?>"><center><?php echo $row_pegawai['p_unt_kode_unit']; ?></center></td>
						<td rowspan="<?php echo $rowspan;?>"><center><?php echo $unit_tmt; ?></center></td>
						<td><?php echo strtoupper($row_pegawai['peg_nama']); ?></td>
						<td><?php echo strtoupper($row_pegawai['peg_tmpt_lahir']); ?></td>
						<td><center><?php echo $tgl_lahir; ?></center></td>
						<td><center><?php echo $umur; ?></td>
						<td><center><?php echo strtoupper($row_pegawai['peg_jns_kelamin']); ?></td>
						<td><center><?php echo 'PEGAWAI'; ?></td>
						<td><center><?php echo strtoupper($row_pegawai['p_stk_status_keluarga']); ?></center></td>
						<td rowspan="<?php echo $rowspan;?>"><center><?php echo strtoupper($row_pegawai['p_al_jalan'].' '.$row_pegawai['p_al_kelurahan'].' '.$row_pegawai['p_al_kecamatan'].' '.$row_pegawai['p_al_kabupaten'].' '.$row_pegawai['p_al_provinsi']); ?></center></td>
						<td rowspan="<?php echo $rowspan;?>"><center><?php echo strtoupper($row_pegawai['p_al_no_telp']); ?></center></td>
						<td><center><?php echo strtoupper($row_pegawai['p_ag_agama']); ?></center></td>
                    </tr>
					<?php if (($row_pegawai['p_stk_status_keluarga'] != 'TK') && ($row_pegawai['p_stk_status_keluarga'] != NULL))
					{?>
					<tr>
						<td><?php echo strtoupper($row_pegawai['p_ps_nama']); ?></td>
						<td><?php echo strtoupper($row_pegawai['p_ps_tmpt_lahir']); ?></td>
						<td><center><?php echo $tgl_lahir_ps; ?></center></td>
						<td><center><?php echo $umur_ps; ?></td>
						<td><center><?php echo $sex_ps; ?></td>
						<td><center><?php echo $status_ps; ?></td>
						<td><center><?php echo strtoupper($row_pegawai['p_stk_status_keluarga']); ?></center></td>
						<td><center><?php echo strtoupper($row_pegawai['p_ps_agama']); ?></center></td>
                    </tr> <?php
					$num_anak = 1;
					foreach ($anak as $row_anak)
					{ 
						$umur_ank = mdate($yearstring,now()) - mdate($yearstring, strtotime($row_anak['peg_ank_tgl_lahir']));?>
						<tr>
						<td><?php echo strtoupper($row_anak['peg_ank_nama']); ?></td>
						<td><?php echo strtoupper($row_anak['peg_ank_tempat_lahir']); ?></td>
						<td><center><?php echo mdate($datestring,strtotime($row_anak['peg_ank_tgl_lahir'])); ?></center></td>
						<td><center><?php echo $umur_ank; ?></td>
						<td><center><?php echo strtoupper($row_anak['peg_ank_jns_kelamin']); ?></td>
						<td><center><?php echo 'ANAK '.$num_anak; ?></td>
						<td><center><?php echo strtoupper($row_anak['peg_ank_status']); ?></center></td>
						<td><center><?php echo strtoupper($row_anak['peg_ank_agama']); ?></center></td>
                    </tr>
					<?php 
					$num_anak++;
					}
					}
					$number++; ?> <tr><td colspan="14" style="background-color:#ffdfdf"></td></tr><?php
				}endforeach; 
				?>
                </tbody>
            </table>
			
        </div>
		<?php $attr= array('target' => '_blank');
			echo anchor('pekerja/excel_data_sdm','Export to Excel',$attr); ?>