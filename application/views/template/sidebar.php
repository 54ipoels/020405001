 <div class="sidebar-nav">
        
        <a href="<?php echo base_url(); ?>dashboard/" class="nav-header" data-toggle="collapse"><i class="icon-home"></i>AMS DPS V1.0</a>
        <ul id="dashboard-menu" class="nav nav-list collapse in">
            <li><?php echo anchor('dashboard', 'Home', 'Home'); ?></li>
        </ul>

        <a href="#accounts-menu" class="nav-header" data-toggle="collapse"><i class="icon-file"></i>Surat Masuk <i class="icon-chevron-up"></i></a>
        <ul id="accounts-menu" class="nav nav-list collapse">
        	<li ><?php echo anchor('docs/add','Input Surat Masuk'); ?></li>
            
        </ul>

        <a href="#error-menu" class="nav-header collapsed" data-toggle="collapse"><i class="icon-exclamation-sign"></i>Surat Keluar  <i class="icon-chevron-up"></i></a>
        <ul id="error-menu" class="nav nav-list collapse">
            <li ><?php echo anchor('docs/add','Nota Dinas'); ?></li>
            <li ><?php echo anchor('docs/add','Memo'); ?></li>
        </ul>

       
      
    </div>