<div class="widget">
<?php echo form_open('diklat/sort_non_stkp/') ?>
<fieldset class="step" id="w2first">
<table>
	<tr>
    	<!--<td>
			<div class="formBaru"><label><!--License: &nbsp --></label>
				
        <!--        <input type="text" name="license" width="100px" placeholder="Enter license..." />
           	</div>
      	</td>
		-->
        <td width="810px">
			<div class="formBaru"><label><!--Unit Kerja: &nbsp --></label>
				<?php $unit = array();
					$unit['ALL'] = 'Unit Kerja';
					foreach ($list_unit as $row_unit) :
					{
						$unit[$row_unit['kode_unit']] = ($row_unit['nama_unit']);
					} 
					endforeach; 
					echo form_dropdown('unit',$unit,$this->uri->segment(4)); 
				?>&nbsp 
				<?php $subunit = array();
					$sub_unit['ALL'] = 'Sub Unit';
					foreach ($list_sub_unit as $row_sub_unit) :
					{
						$sub_unit[$row_sub_unit['su_kode_sub_unit']] = ($row_sub_unit['su_sub_unit']);
					} 
					endforeach; 
					echo form_dropdown('sub_unit',$sub_unit,$this->uri->segment(5)); 
				?>&nbsp 
				<?php $submit = array(
					'class' => 'blueB m110',
					'id'	=> 'next2',
					'value'	=> 'Sort',
					); 
					echo form_submit($submit);
				?>
                </form>
           	</div>
     	</td>
		<td width="300px">
        	<div class="searchWidget1">
				<?php /*echo form_open('diklat/search_pegawai');*/ echo form_open('diklat/search_nstkp');?>
                <input type="text" name="search" width="100px" placeholder="Enter search text..." />
                <input type="submit" name="find" value="" class="blueB m110"/>
                </form>
           	</div>
       	</td>
   	</tr>
</table>
</fieldset>

</div><!--</div>-->
<!--</div>-->

<div class="oneTwo"> 
</div>

<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Report Data Non STKP</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2">NIPP</td>
                        <td rowspan="2">Nama</td>
                        <td rowspan="2">Training</td>
                        <td rowspan="2">No Sertifikat</td>
                        <td colspan="2">Pelaksanaan</td>
                        <td rowspan="2">Lembaga</td>
						<td colspan="2">Instruktur</td>
						<td rowspan="2">Actions</td>
                    </tr>
					<tr>
					<td>From</td><td>Until</td><td>Nama</td><td>From</td></tr>
                </thead> 
				<tfoot>
					<tr>
                    	<td colspan="3" align="left">
							<?php 
								$attr= array('target' => '_blank');
								echo anchor('diklat/excel_non_stkp','Export to Excel',$attr);
						 	?>
                       	</td>
                        <td colspan="5"><div class="pagination"><?php echo $this->pagination->create_links();?></div></td>
                        <td colspan="3" align="right">EMS 2.0.1 | developed by www.studiokami.com</td>
                   	</tr>
				</tfoot>
				<tbody>
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
				foreach ($pegawai_with_stkp_and_unit as $row_pegawai) :
				{ 
					if ($row_pegawai['p_nstkp_nipp'] == $nipp)
					{
						$nipp = '';
						$nama = '';
					}
					else
					{
						$nipp = $row_pegawai['p_nstkp_nipp'];
						$nama = $row_pegawai['peg_nama'];
					}
					if ($row_pegawai['p_nstkp_pelaksanaan'] == '0000-00-00')
					{
						$pelaksanaan = '-';
					}
					else
					{
						$pelaksanaan = $row_pegawai['p_nstkp_pelaksanaan'];
					}
					
					$detail = anchor('pekerja/get_pegawai/'.$row_pegawai['peg_nipp'],'Detail'); 
					if ($nipp==""){$nipp_anchor = "";} else {
						if($this->uri->segment(3)=='nipp'){$nipp_anchor =  anchor('diklat/detail_kompetensi/'.$nipp, $nipp);} else {$nipp_anchor =  anchor('diklat/get_nstkp_selection/nipp/'.$nipp, $nipp);}}
					if ($nama==""){$nama_anchor = "";} else {$nama_anchor =  anchor('diklat/get_nstkp_selection/nama/'.$nama, $nama);}
					if ($row_pegawai['p_nstkp_jenis'] == ""){$jenis_anchor = "";} else {$jenis_anchor = anchor('diklat/get_nstkp_selection/jenis/'.$row_pegawai['p_nstkp_jenis'], 	$row_pegawai['p_nstkp_jenis']);}
					if ($row_pegawai['p_nstkp_lembaga'] == ""){$lembaga_anchor = "";} else {$lembaga_anchor = anchor('diklat/get_nstkp_selection/lembaga/'.$row_pegawai['p_nstkp_lembaga'], $row_pegawai['p_nstkp_lembaga']);}
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
					
					?>
					<tr>
                        <td><center><?php echo $number; ?></center></td>
						<td><center><?php echo $nipp_anchor; ?></center></td>
						<td><?php echo $nama; ?></td>
						<td><?php echo $jenis_anchor; ?></td>
						<td><center>
									<?php if ($row_pegawai['p_nstkp_image'] !== ""){?>
										<a href="<?php echo base_url(); ?>index.php/diklat/view_pdf/<?php echo $row_pegawai['p_nstkp_image'];?>" target="_blank" >
											<?php echo $row_pegawai['p_nstkp_no_license']; ?> 
										</a>
									<?php } else {
											echo $row_pegawai['p_nstkp_no_license'];
										}
									?>
									<?php /*
									<a href="<?php echo base_url(); ?>pegawai/diklat/<?php echo $row_pegawai['p_nstkp_image']; ?>" title="<?php echo $row_pegawai['p_nstkp_no_license']; ?>" rel="lightbox">
									<?php echo $row_pegawai['p_nstkp_no_license']; ?></a>
									*/ ?>
							</center>
						</td>
						<td><center><?php echo $mulai; ?></center></td>
						<td><center><?php echo $selesai; ?></center></td>
						<td><center><?php echo $lembaga_anchor; ?></center></td>
						<td><center><?php echo $row_pegawai['p_nstkp_instruktur']; ?></center></td>
						<td><center><?php echo $row_pegawai['p_nstkp_instruktur_from']; ?></center></td>
						<td><center><?php 
										echo anchor('diklat/search_pegawai/'.$row_pegawai['peg_nipp'], "add"); 
										echo " | ";
										echo anchor('diklat/edit_non_stkp/'.$row_pegawai['id_peg_non_stkp'], 'edit');
										echo " | ";
										echo anchor('diklat/delete_non_stkp/'.$row_pegawai['id_peg_non_stkp'], 'delete'); 
										echo " | ";?>
										<a href="<?php echo base_url().'index.php/diklat/remove_file_non_stkp/'.$row_pegawai['id_peg_non_stkp']; ?>">
												<image src="<?php echo base_url();?>images/minus.png" title="remove file stkp">
										</a>
							</center></td>
                    </tr> <?php
					$number++;
					$nipp = $row_pegawai['peg_nipp'];
				}endforeach; 
				?>
                </tbody>
            </table>
			
        </div>
		