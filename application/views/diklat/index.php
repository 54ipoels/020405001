<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
 <?php $this->load->view('template/head') ?>

<body>

<!-- Left side content -->
<div id="leftSide">
    <div class="logo"><a href=""><img src="<?php echo base_url()?>images/logo.png" alt="" /></a></div>
    
    <div class="sidebarSep mt0"></div>
    
    <!-- Search widget 
    <form action="" class="sidebarSearch">
        <input type="text" name="search" placeholder="search..." id="ac" />
        <input type="submit" value="" />
    </form> 
    
    <div class="sidebarSep"></div>

    <!-- General balance widget 
    <div class="genBalance">
        <a href="#" title="" class="amount">
            <span>General balance:</span>
            <span class="balanceAmount">$10,900.36</span>
        </a>
        <a href="#" title="" class="amChanges">
            <strong class="sPositive">+0.6%</strong>
        </a>
    </div> 
    
    <!-- Next update progress widget 
    <div class="nextUpdate">
        <ul>
            <li>Next update in:</li>
            <li>23 hrs 14 min</li>
        </ul>
        <div class="pWrapper"><div class="progressG" title="78%"></div></div>
    </div> 
    
    <div class="sidebarSep"></div> -->
    
    <?php $this->load->view('template/navigation') ?>


<!-- Right side -->
<div id="rightSide">
	<!-- Top fixed navigation -->
    <?php $this->load->view('template/fixed_nav') ?>
    
    <!-- Title area -->
    <?php $this->load->view('template/title_area'); ?>
    
    <div class="line"></div>
    
    <!-- Page statistics and control buttons area
    <?php $this->load->view('diklat/template/statistic'); ?>  
    
    <div class="line"></div> -->
    
    <!-- Main content wrapper -->
    <div class="wrapper">
    
		<?php 
		if ($page == 'Pegawai')
		{
			$this->load->view('diklat/page/list_karyawan');
		}
		elseif ($page == 'Add STKP')
		{
			$this->load->view('diklat/page/add/add_new_stkp');
		}
		elseif ($page == 'Search Result')
		{
			$this->load->view('diklat/page/list_karyawan');
		}
		elseif ($page == 'Report Non STKP')
		{
			$this->load->view('diklat/page/report/report_non_stkp');
		}
		elseif ($page == 'Report Training Bulanan')
		{
			$this->load->view('diklat/page/search_report');
		}
		elseif ($page == 'Report STKP Bulanan')
		{
			$this->load->view('diklat/page/report/report_stkp_bulanan');
		}
		elseif ($page == 'Report NSTKP Bulanan')
		{
			$this->load->view('diklat/page/report/report_non_stkp_bulanan');
		}
		elseif ($page == 'STKP Bulanan')
		{
			$this->load->view('diklat/page/add/input_stkp_bulanan');
		}
		elseif ($page == 'STKP Bulanan Next')
		{
			$this->load->view('diklat/page/add/input_stkp_bulanan_2');
		}
		elseif ($page == 'Detail Kompetensi')
		{
			$this->load->view('diklat/page/report/data_kompetensi');
		}
		// -------- submit data karyawan ---------------//
		elseif ($page == 'Report STKP')
		{
			$this->load->view('diklat/page/report/report_stkp');
		} 
		elseif ($page == 'Input Data Pasangan')
		{
			$this->load->view('diklat/page/submit/submit_data_pasangan');
		} 
		elseif ($page == 'Input Data Ortu')
		{
			$this->load->view('diklat/page/submit/submit_data_ortu');
		} 
		elseif ($page == 'Input Data Mertua')
		{
			$this->load->view('diklat/page/submit/submit_data_mertua');
		}
		//--------- edit data karyawan ---------------//
		elseif ($page == 'Edit Data Diri')
		{
			$this->load->view('diklat/page/edit/edit_data_pribadi');
		}
		elseif ($page == 'Edit Data Alamat')
		{ 
			$this->load->view('diklat/page/edit/edit_data_alamat');
		}
		elseif ($page == 'Edit Data Pasangan')
		{
			$this->load->view('diklat/page/edit/edit_data_pasangan');
		}
		elseif ($page == 'Edit Data Ortu')
		{
			$this->load->view('diklat/page/edit/edit_data_ortu');
		}
		elseif ($page == 'Edit Data Mertua')
		{
			$this->load->view('diklat/page/edit/edit_data_mertua');
		}
		elseif ($page == 'Edit Data Anak')
		{
			$this->load->view('diklat/page/edit/edit_data_anak');
		}
		elseif ($page == 'Edit Data Jabatan')
		{
			$this->load->view('diklat/page/edit/edit_data_jabatan');
		}
		elseif ($page == 'Edit Data Pendidikan')
		{
			$this->load->view('diklat/page/edit/edit_data_pendidikan');
		}
		elseif ($page == 'Add Data Anak')
		{
			$this->load->view('diklat/page/add/add_data_anak');
		}
		elseif ($page == 'Add Data Bahasa')
		{
			$this->load->view('diklat/page/add/add_data_bahasa');
		}
		elseif ($page == 'Edit non STKP')
		{
			$this->load->view('diklat/page/edit/edit_non_stkp');
		}
		elseif ($page == 'Edit STKP')
		{
			$this->load->view('diklat/page/edit/edit_stkp');
		}
		?>
	</div>
    
    <!-- Footer line -->
    <div id="footer">
        <div class="wrapper"></div>
    </div>

</div>

<div class="clear"></div>

</body>
</html>