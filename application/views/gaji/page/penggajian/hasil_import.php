<?php $this->load->helper('asset'); ?>
<div class="widget">
        <fieldset>
			<div style="padding-left:50px;">
				
			<?php
				if($n_gagal>0){
					echo "<strong>Proses Import Telah Selesai</strong><br><br>";
					echo "Data yang gagal diinput <br>";
					echo "NIPP : ";
					for ($i=0;$i<$n_gagal;$i++)
					{
						if($gagal[$i] !== ""){
							echo " <strong>$gagal[$i]</strong>";
							if ($i<($n_gagal-1)){echo ",";}
						}
					}
					?>
					</table>
					<?php
				} else if($n_gagal == "gagal"){
					echo "<strong>Proses Import Gagal</strong>";
				}
				else{
					echo "<strong>semua data berhasil diimport</strong>";
				}
			?>
			</div>
		</fieldset>
			
</div>