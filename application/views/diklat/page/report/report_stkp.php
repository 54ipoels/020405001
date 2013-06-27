<div class="widget">
<?php echo form_open('diklat/sort_stkp/') ?>
<fieldset class="step" id="w2first">
<table>
	<tr>
		<td width="50px">
            <div class="formBaru"><label><!--STKP: &nbsp --></label>
                <?php $jenis_stkp = array(
                    'ALL' 	=> 	'Jenis STKP',
                    'GSE'	=>	'GSE',
                    'FOO'	=>	'FOO',
                    'DGR'	=>	'DGR',
                    'AVSEC'	=>	'AVSEC',
                );
                echo form_dropdown('jenis_stkp',$jenis_stkp);?>
            </div>
		</td>

		<td width="50px">
            <div class="formBaru"><label><!-- Rating STKP :--></label>
           	 	<?php $rating_stkp = array();
                    $rating_stkp['ALL'] = 'Type Rating';
                    foreach ($list_stkp as $row_stkp_list) :
                        {
                            $rating_stkp[$row_stkp_list['stkp']] = ($row_stkp_list['stkp']);
                        } endforeach; 
                    echo form_dropdown('stkp',$rating_stkp,$this->uri->segment(3));?> 
            </div>
		</td>
        
        <td width="50px">
            <div class="formBaru"><label><!-- Rating STKP :--></label>
           	 	<?php $unit = array();
					$unit['ALL'] = 'Unit Kerja';
				foreach ($list_unit as $row_unit) :
					{
						$unit[$row_unit['kode_unit']] = ($row_unit['nama_unit']);
					} endforeach; 
				echo form_dropdown('unit',$unit,$this->uri->segment(4)); ?>
            </div>
		</td>
        
        <td width="50px">
            <div class="formBaru"><label><!--Unit Kerja:--></label>
                <?php $submit = array(
                    'class' => 'blueB m110',
                    'id'	=> 'next2',
                    'value'	=> 'Search',
                    ); 
                echo form_submit($submit)?></form>
            </div>
		</td>
    </tr>
    <tr>
            <td></td>
            <td>&nbsp;</td>
            <td>
                <div class="searchWidget1">
                <?php 
                /* echo form_open('diklat/search_pegawai'); */ 
                echo form_open('diklat/search_stkp');?>
                <input type="text" name="search" width="45px" placeholder="Enter search text..." />
                </div>
            </td>
            <td>
                <div class="formBaru">
                <input type="submit" name="find" value="Search" class="blueB m110"/>
                </div>
                </form>
            </td>
    </tr>
</table>
</fieldset>
</div>


<div class="oneTwo"></div>


<div class="widget">  
		  <div class="title"><img src="<?php echo base_url()?>images/icons/dark/frames.png" alt="" class="titleIcon" /><h6>Report Data STKP</h6></div>
            <table cellpadding="0" cellspacing="0" width="100%" class="sTable">
                <thead>
                    <tr>
                        <td rowspan="2">No</td>
                        <td rowspan="2">NIPP</td>
                        <td rowspan="2">Nama</td>
						<td rowspan="2">Jenis</td>
                        <td rowspan="2">Rating</td>
                        <td rowspan="2">No License / STKP</td>
                        <td colspan="2">Validitas</td>
                        <td rowspan="2">Lembaga</td>
                        <td colspan="2">Instruktur</td>
                        <td colspan="2">Tanggal Pelaksanaan</td>
						<td rowspan="2">Type STKP</td>
						<td rowspan="2">Action</td>
                    </tr>
					<tr>
						<td>Mulai</td><td>Sampai</td><td>Nama</td><td>From</td><td>Mulai</td><td>Sampai</td>
                    </tr>
                </thead>
                
                <tfoot>
					<tr>
                    	<td colspan='4' align="left"><?php 
								$attr= array('target' => '_blank');
								if($this->uri->segment(2) == "sort_stkp" ){
									if($jenis_search !== 'all'){
										echo anchor('diklat/excel_stkp/'.$jenis_search,'Export to Excel',$attr); 
									}
								}
								?></td>
                        <td colspan="7"><div class="pagination"><?php echo $this->pagination->create_links();?></div></td>
                        <td colspan="4" align="right">EMS 2.0.1 | developed by www.studiokami.com</td>
                   	</tr>
				</tfoot>
				
				<tbody>
				<?php 
				$datestring = "%d-%M-%Y" ;
				$monthstring = "%m";
				$yearstring = "%Y";
				$nipp = '';
				$stkp = '';
				$waktu = '';
				if ($this->uri->segment(3)== NULL)
				{
					$number = 1;
				} else {
					if ($this->uri->segment(2) == 'get_stkp')
					{	
						$number = $this->uri->segment(3)+1;
					} else {
						$number = $this->uri->segment(5)+1;
					}
				}
				foreach ($pegawai_with_stkp_and_unit as $row_pegawai) :
				{ 
					//$nipp_bantu=$row_pegawai['p_stkp_nipp'];
					if ($row_pegawai['p_stkp_nipp'] == $nipp)
					{
						$nipp = '';
						$nama = '';
					} 
					else
					{
						$nipp = $row_pegawai['p_stkp_nipp'];
						$nama = $row_pegawai['peg_nama'];
					}	
					if ($row_pegawai['p_stkp_pelaksanaan'] == '0000-00-00')
					{
						$mulai= '-';
					}
					else
					{
						$mulai = mdate($datestring,strtotime($row_pegawai['p_stkp_pelaksanaan']));
					}
					if ($row_pegawai['p_stkp_selesai'] == '0000-00-00')
					{
						$selesai = '-';
					}
					else
					{
						$selesai = mdate($datestring,strtotime( $row_pegawai['p_stkp_selesai']));
					}
					if ($row_pegawai['p_stkp_mulai'] == '0000-00-00')
					{
						$stkp_mulai = '-';
					}
					else
					{
						$stkp_mulai = mdate($datestring,strtotime($row_pegawai['p_stkp_mulai']));
					}
					if ($row_pegawai['p_stkp_finish'] == '0000-00-00')
					{
						$stkp_selesai = '-';
					}
					else
					{
						$stkp_selesai = mdate($datestring,strtotime($row_pegawai['p_stkp_finish']));
					}
					$color = '';
					if ((mdate($yearstring,strtotime($row_pegawai['p_stkp_finish'])) <= $year)){
						if (mdate($monthstring,strtotime($row_pegawai['p_stkp_finish']))-$month <= 4) {
							$color = 'style="background-color:#ffdfdf"';
						}
					}
					$detail = anchor('pekerja/get_stkp_selection/'.$row_pegawai['peg_nipp'],'Detail'); 
					
					if ($nipp==""){$nipp_anchor = "";} else {
						if ($this->uri->segment(3) == 'nipp'){$nipp_anchor =  anchor('diklat/detail_kompetensi/'.$nipp, $nipp); } else {$nipp_anchor =  anchor('diklat/get_stkp_selection/nipp/'.$nipp, $nipp);}}
					if ($nama==""){$nama_anchor = "";} else {$nama_anchor =  anchor('diklat/get_stkp_selection/nama/'.$nama, $nama);}
					if ($row_pegawai['p_stkp_jenis']=="") {$jenis_anchor ="";} else {$jenis_anchor = anchor('diklat/get_stkp_selection/jenis/'.$row_pegawai['p_stkp_jenis'], $row_pegawai['p_stkp_jenis']);}
					if ($row_pegawai['p_stkp_rating']=="") {$rating_anchor ="";} else {$rating_anchor = anchor('diklat/get_stkp_selection/rating/'.$row_pegawai['p_stkp_rating'], $row_pegawai['p_stkp_rating']);}
					if ($row_pegawai['p_stkp_lembaga']=="") {$lembaga_anchor ="";} else {$lembaga_anchor = anchor('diklat/get_stkp_selection/lembaga/'.$row_pegawai['p_stkp_lembaga'], $row_pegawai['p_stkp_lembaga']);}
					if ($row_pegawai['p_stkp_type']=="") {$type_anchor ="";} else {$type_anchor = anchor('diklat/get_stkp_selection/type/'.$row_pegawai['p_stkp_type'], $row_pegawai['p_stkp_type']);}
					?>
					
					<tr>
                        <td <?php echo $color ?>><center><?php echo $number; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $nipp_anchor; ?></a></center></td>
						<td <?php echo $color ?>><?php echo $nama; ?></td>
						<td <?php echo $color ?>><?php echo $jenis_anchor; ?></td>
						<td <?php echo $color ?>><?php echo $rating_anchor; ?></td>
						<td <?php echo $color ?>>
							<center>
							<?php if ($row_pegawai['p_stkp_image'] !== ""){?>
								<a href="<?php echo base_url(); ?>index.php/diklat/view_pdf/<?php echo $row_pegawai['p_stkp_image'];?>" target="_blank" >
									<?php echo $row_pegawai['p_stkp_no_license']; ?> 
								</a>
							<?php } else {
									echo $row_pegawai['p_stkp_no_license'];
								}
							?>
							</center>
						</td>
						<td <?php echo $color ?>><center><?php echo $stkp_mulai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $stkp_selesai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $lembaga_anchor; ?></center></td>
						<td><center><?php echo $row_pegawai['p_stkp_instruktur']; ?></center></td>
						<td><center><?php echo $row_pegawai['p_stkp_instruktur_from']; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $mulai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $selesai; ?></center></td>
						<td <?php echo $color ?>><center><?php echo $type_anchor; ?></center></td>
						<td <?php echo $color ?>><center></center> 
						<?php  
							if($row_pegawai['p_stkp_type'] == "RECC")
							{ 
								$add_anchor = anchor('diklat/search_pegawai/'.$row_pegawai['peg_nipp'], "add"); 
								echo $add_anchor." | ";
							}
							echo anchor('diklat/edit_stkp/'.$row_pegawai['id_peg_stkp'], 'edit');
							echo " | ";
							echo anchor('diklat/delete_stkp/'.$row_pegawai['id_peg_stkp'], 'delete');
							echo " | ";
						?> 
							<a href="<?php echo base_url().'index.php/diklat/remove_file_stkp/'.$row_pegawai['id_peg_stkp']; ?>">
									<image src="<?php echo base_url();?>images/minus.png" title="remove file stkp">
							</a>
						</td>
                    </tr> 
						<?php
						$number++;;
						$nipp = $row_pegawai['peg_nipp'];
						}
						endforeach; 
						?>
                    
                </tbody>
                
                
                
            </table>
			
        </div>
		