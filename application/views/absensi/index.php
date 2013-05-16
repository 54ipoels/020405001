<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <?php $this->load->view('template/head') ?>

<body>

<!-- Left side content -->
<div id="leftSide">
    <div class="logo"><a href=""><img src="<?php echo base_url()?>images/logo.png" alt="" /></a></div>
    
    <div class="sidebarSep mt0"></div>
        
    <?php $this->load->view('absensi/template/navigation') ?>


<!-- Right side -->
<div id="rightSide">
	<!-- Top fixed navigation -->
    <?php $this->load->view('template/fixed_nav') ?>
    
    <!-- Title area -->
    <?php $this->load->view('template/title_area'); ?>
        
    <div class="line"></div>
    
    <!-- Main content wrapper -->
    <div class="wrapper">
    
		<?php 
		#hari libur
		if ($page == 'hari_libur')
		{
			$this->load->view('absensi/page/hari_libur/hari_libur');
		}
		else if ($page == 'add_hari_libur')
		{
			$this->load->view('absensi/page/hari_libur/add_hari_libur');
		} 
		else if ($page == 'edit_hari_libur')
		{
			$this->load->view('absensi/page/hari_libur/edit_hari_libur');
		} 
		
		#format schedule
		else if ($page == 'format_schedule')
		{
			$this->load->view('absensi/page/format_schedule/format_schedule');
		} 
		else if ($page == 'detail_format_schedule')
		{
			$this->load->view('absensi/page/format_schedule/detail_format_schedule');
		}
		else if ($page == 'add_format_schedule')
		{
			$this->load->view('absensi/page/format_schedule/add_format_schedule');
		}
		else if ($page == 'add_next_format_schedule')
		{
			$this->load->view('absensi/page/format_schedule/add_next_format_schedule');
		}
		else if ($page == 'edit_format_schedule')
		{
			$this->load->view('absensi/page/format_schedule/edit_format_schedule');
		}
		else if ($page == 'edit_next_format_schedule')
		{
			$this->load->view('absensi/page/format_schedule/edit_next_format_schedule');
		}

		#schedule pegawai
		else if ($page == 'add_schedule_pegawai')
		{
			$this->load->view('absensi/page/schedule_pegawai/add_schedule_pegawai');
		}
		else if ($page == 'schedule_pegawai')
		{
			$this->load->view('absensi/page/schedule_pegawai/schedule_pegawai');
		}
		else if ($page == 'view_schedule_pegawai')
		{
			$this->load->view('absensi/page/schedule_pegawai/view_schedule_pegawai');
		}
		
		#scuti
		else if ($page == 'cuti_pegawai')
		{
			$this->load->view('absensi/page/cuti/cuti_pegawai');
		}
		else if ($page == 'view_cuti_pegawai')
		{
			$this->load->view('absensi/page/cuti/view_cuti_pegawai');
		}
		else if ($page == 'add_cuti_pegawai')
		{
			$this->load->view('absensi/page/cuti/add_cuti_pegawai');
		}
		else if ($page == 'edit_cuti_pegawai')
		{
			$this->load->view('absensi/page/cuti/edit_cuti_pegawai');
		}
		else if ($page == 'detail_cuti_pegawai')
		{
			$this->load->view('absensi/page/cuti/detail_cuti_pegawai');
		}
		
		#pakai cuti pegawai
		else if ($page == 'add_pakai_cuti_pegawai')
		{
			$this->load->view('absensi/page/pakai_cuti/add_pakai_cuti_pegawai');
		}
		else if ($page == 'add_next_pakai_cuti_pegawai')
		{
			$this->load->view('absensi/page/pakai_cuti/add_next_pakai_cuti_pegawai');
		}
		
		#master gaji 
		else if ($page == 'master_gaji')
		{
			$this->load->view('absensi/page/gaji/master_gaji');
		}
		else if ($page == 'add_gaji')
		{
			$this->load->view('absensi/page/gaji/add_gaji');
		}
		else if ($page == 'edit_gaji')
		{
			$this->load->view('absensi/page/gaji/edit_gaji');
		}
		
		#gaji pegawai 
		else if ($page == 'gaji_pegawai')
		{
			$this->load->view('absensi/page/penggajian/gaji_pegawai');
		}
		else if ($page == 'add_gaji_peg')
		{
			$this->load->view('absensi/page/penggajian/add_gaji_peg');
		}
		else if ($page == 'edit_gaji_peg')
		{
			$this->load->view('absensi/page/penggajian/edit_gaji_peg');
		}
		else if ($page == 'view_gaji_peg')
		{
			$this->load->view('absensi/page/penggajian/view_gaji_peg');
		}
		else if ($page == 'view_detail_gaji_peg')
		{
			$this->load->view('absensi/page/penggajian/view_detail_gaji_peg');
		}
		
		
		#lembur pegawai
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

</div>

<div class="clear"></div>

</body>
</html>