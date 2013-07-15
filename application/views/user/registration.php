<div class="row-fluid">
	
    <div class="dialog">
    
    <div class="alert alert-error">
		<?php echo $message; ?>
  	</div>
    
        <div class="block">
            <p class="block-heading">User Register</p>
            	<div class="block-body">
                <?php echo form_open('user/do_registration'); ?>
                    <label>Nama</label>
                    <input type="text" class="span12" name="nama" size="50" width="50">
                    <font color="#FF0000" size="-1"><?php echo form_error('nama'); ?></font>
                    
                    <label>NIPP</label>
                    <input type="text" class="span12" name="nipp">
                    <font color="#FF0000" size="-1"><?php echo form_error('nipp'); ?></font>
                    
                    <label>No Handphone</label>
                    <input type="text" class="span12" name="hp">
                    <font color="#FF0000" size="-1"><?php echo form_error('hp'); ?></font>
                    
                    <label>Email</label>
                    <input type="text" name="email" width="50%" >@gapura.co.id
                    
                    <label>Station</label>                    
                    <select name="station" id="station">
						<option value="none">select station</option>
						<?php foreach ( $station as $item ) : ?>
							<option value="<?php echo $item->stn_level ?>"><?php echo ucfirst( $item->stn_name ) ?></option>
						<?php endforeach ?>
                    </select>
                    
                   <label>Unit</label>
                    <select  name="unit" id="unit">
						<option value="none">select unit</option>
                    </select>
                    
                    <label>Sub Unit</label>
                    <select name="sub_unit" id="subunit">
                        <option value="none">select sub unit</option>
                    </select>
                    
                    <label>Team</label>
                    <select name="team" id="team">
                        <option value="none">select team</option>
                    </select>
                                    
                    <label>Jabatan</label>
                    <select name="jabatan" id="jabatan">
                        <option value="12">Staff</option>
                        <option value="11">Supervisor</option>
                        <option value="10">Assistant Manager</option>
                        <option value="09">Manager</option>
                        <option value="06">General Manager</option>
                    </select>
                    
                   <!-- <label>Password</label>
                    <input type="password" class="span12">-->
                    
                    <?php echo form_submit('submit', 'Sign Up!', 'class = "btn btn-primary pull-right"'); ?>
                    
                    
                    <div class="clearfix"></div>
                <?php echo form_close(); ?>
                
            	</div>
        </div>
        <p><a href="#">Privacy Policy</a></p>
    </div>
</div>

<script type="text/javascript">

	$(document).ready(function(){
	
		/* pengaturan id select dropdown */
		$_station	= $('select#station');
		$_unit 		= $('select#unit');
		$_subunit	= $('select#subunit');
		$_team		= $('select#team');
		
		/* select dengan id station on change */
		$_station.change(function(){
		
			$this = $(this);
			
			/* 	ambil konten ke '/ajax_station/select_unit/' + id station
				Contoh: '/ajax_station/select_unit/04'
			*/
			$.get( '<?php echo base_url() ?>ajax_station/select_unit/' + $this.val(), function(data){
				
				/* replace konten select unit dengan data dari server, jika data tidak kosong */				
				$_unit.html( data ? data : '<option value="none">(empty)</option>' );
				
				/** menyesuaikan data subunit, untuk menghindari kesalahan data **/
				
				/* 	ambil konten ke '/ajax_station/select_subunit/' + id unit
					Contoh: '/ajax_station/select_subunit/04'
				*/
				$.get( '<?php echo base_url() ?>ajax_station/select_subunit/' + $_unit.val(), function(data){
			
					/* replace select subunit dengan data dari server, jika tidak kosong */
					$_subunit.html( data ? data : '<option value="none">(empty)</option>' );
					
					
					$.get( '<?php echo base_url() ?>ajax_station/select_team/' + $this.val(), function(data){
			
					// replace select subunit dengan data dari server, jika tidak kosong
					$_team.html( data ? data : '<option value="none">(empty)</option>' );
				
					});
				
				});
			
			});
			
		});
		
		/* select unit on change */
		$_unit.change(function(){
		
			$this = $(this);

			/* 	ambil konten ke '/ajax_station/select_subunit/' + id unit
				Contoh: '/ajax_station/select_subunit/04'
			*/
			$.get( '<?php echo base_url() ?>ajax_station/select_subunit/' + $this.val(), function(data){
			
				/* replace select subunit dengan data dari server, jika tidak kosong */
				$_subunit.html( data ? data : '<option value="none">(empty)</option>' );
				
				
				$.get( '<?php echo base_url() ?>ajax_station/select_team/' + $this.val(), function(data){
			
				// replace select subunit dengan data dari server, jika tidak kosong
				$_team.html( data ? data : '<option value="none">(empty)</option>' );
				
				});
				
				
			});
			
		});
		
		 
		
		// select unit on change
		$_subunit.change(function(){
		
			$this = $(this);

			// 	ambil konten ke '/ajax_station/select_subunit/' + id unit
			//	Contoh: '/ajax_station/select_subunit/04'
			
			$.get( '<?php echo base_url() ?>ajax_station/select_team/' + $this.val(), function(data){
			
				// replace select subunit dengan data dari server, jika tidak kosong
				$_team.html( data ? data : '<option value="none">(empty)</option>' );
				
			});
			
		});
		
		
		return false;
	
	});
	
</script>