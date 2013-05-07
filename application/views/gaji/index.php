<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <?php $this->load->view('template/head') ?>

<body>

<!-- Left side content -->
<div id="leftSide">
    <div class="logo"><a href=""><img src="<?php echo base_url()?>images/logo.png" alt="" /></a></div>
    
    <div class="sidebarSep mt0"></div>
	
    <?php $this->load->view('template/navigation') ?>


<!-- Right side -->
<div id="rightSide">
	<!-- Top fixed navigation -->
    <?php $this->load->view('template/fixed_nav') ?>
    
    <!-- Title area -->
    <?php $this->load->view('template/title_area'); ?>
    
    <div class="line"></div>
	
	<!-- Page statistics and control buttons area 
    <?php $this->load->view('kepegawaian/template/statistic'); ?>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
    
		<?php 	
		#master gaji 
		if ($page == 'master_gaji')
		{
			$this->load->view('gaji/page/gaji/master_gaji');
		}
		else if ($page == 'add_gaji')
		{
			$this->load->view('gaji/page/gaji/add_gaji');
		}
		else if ($page == 'edit_gaji')
		{
			$this->load->view('gaji/page/gaji/edit_gaji');
		} 
		else if ($page == 'master_gaji_potongan')
		{
			$this->load->view('gaji/page/penggajian/master_gaji_pot');
		}
		else if ($page == 'add_master_gaji_potongan')
		{
			$this->load->view('gaji/page/penggajian/add_master_gaji_potongan');
		}
		
		#gaji pegawai 
		else if ($page == 'gaji_pegawai')
		{
			$this->load->view('gaji/page/penggajian/gaji_pegawai');
		}
		else if ($page == 'add_gaji_peg')
		{
			$this->load->view('gaji/page/penggajian/add_gaji_peg');
		}
		else if ($page == 'edit_gaji_peg')
		{
			$this->load->view('gaji/page/penggajian/edit_gaji_peg');
		}
		else if ($page == 'view_gaji_peg')
		{
			$this->load->view('gaji/page/penggajian/view_gaji_peg');
		}
		else if ($page == 'view_detail_gaji_peg')
		{
			$this->load->view('gaji/page/penggajian/view_detail_gaji_peg');
		}
		else if ($page == 'edit potongan pegawai')
		{
			$this->load->view('gaji/page/penggajian/edit_gaji_pot_peg');
		}
		else if ($page == 'edit potongan perusahaan')
		{
			$this->load->view('gaji/page/penggajian/edit_gaji_pot_per');
		}
		else if ($page == 'hasil import')
		{
			$this->load->view('gaji/page/penggajian/hasil_import');
		}
		else if ($page == 'import data')
		{
			$this->load->view('gaji/page/penggajian/import_file');
		}
		#lembur pegawai
		/*
		else if ($page == 'lembur_pegawai')
		{
			$this->load->view('absensi/page/lembur/lembur_pegawai');
		}
		else if ($page == 'view_lembur_pegawai')
		{
			$this->load->view('absensi/page/lembur/view_lembur');
		}
		else if ($page == 'view_detail_lembur')
		{
			$this->load->view('absensi/page/lembur/view_detail_lembur');
		}
		else if ($page == 'add_lembur')
		{
			$this->load->view('absensi/page/lembur/add_lembur');
		}
		else if ($page == 'edit_lembur')
		{
			$this->load->view('absensi/page/lembur/edit_lembur');
		}
		*/
		else if ($page == 'lembur_pegawai')
		{
			$this->load->view('gaji/page/lembur/lembur_pegawai');
		}
		else if ($page == 'view_lembur_pegawai')
		{
			$this->load->view('gaji/page/lembur/view_lembur');
		}
		else if ($page == 'view_detail_lembur')
		{
			$this->load->view('gaji/page/lembur/view_detail_lembur');
		}
		else if ($page == 'add_lembur')
		{
			$this->load->view('gaji/page/lembur/add_lembur');
		}
		else if ($page == 'edit_lembur')
		{
			$this->load->view('gaji/page/lembur/edit_lembur');
		}
		# master lembur
		else if ($page == 'master_lembur')
		{
			$this->load->view('gaji/page/lembur/master_lembur');
		}
		else if ($page == 'edit_master_lembur')
		{
			$this->load->view('gaji/page/lembur/edit_master_lembur');
		}
		else if ($page == 'add_master_lembur')
		{
			$this->load->view('gaji/page/lembur/add_master_lembur');
		}
		
		
		#absensi
		else if ($page == 'absensi')
		{
			$this->load->view('absensi/page/absensi/absensi');
		}
		else if ($page == 'view_absensi')
		{
			$this->load->view('absensi/page/absensi/view_absensi');
		}
		else if ($page == 'view_detail_absensi')
		{
			$this->load->view('absensi/page/absensi/view_detail_absensi');
		}
		else if ($page == 'edit_detail_absensi')
		{
			$this->load->view('absensi/page/absensi/edit_detail_absensi');
		}
		
		?>
	</div>
    <!-- Footer line -->
    <div id="footer">
        <div class="wrapper">StudioKami</div>
    </div>
	
<div class="clear"></div>

</body>
</html>