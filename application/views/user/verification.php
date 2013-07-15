<div class="row-fluid">
    <div class="dialog">
        <div class="block">
            <p class="block-heading">PIN Verification</p>
            	<div class="block-body">
                <?php echo form_open('user/do_pin_verification'); ?>
                
                    <label>Email</label>
                    <input type="text" class="span12" name="email" value="<?php echo $email; ?>">
                    <font color="#FF0000" size="-1"><?php echo form_error('pin'); ?></font>
                    
                    <label>Pin</label>
                    <input type="text" class="span12" name="pin">
                    <font color="#FF0000" size="-1"><?php echo form_error('pin'); ?></font>
                    
                    <?php echo form_submit('submit', 'verify', 'class = "btn btn-primary pull-right"'); ?>
                   
                    <div class="clearfix"></div>
                <?php echo form_close(); ?>
                
            	</div>
        </div>
        <p><a href="#">Privacy Policy</a></p>
    </div>
</div>