<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class C_absensi extends Application {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('m_absensi');
		$this->load->model('m_asset');
		$this->ag_auth->restrict('user');
    }
	
	public function index()
	{
		$this->hari_libur();
	}
	
	
	/*
	=================================================================================
	  Apps Name CONTROLLER UNTUK LIBUR NASIONAL
	  Apps ID 1.1.1.3 ver 1.0.0
	  Developed By www.studiokami.com
	  Programmer : agok@studiokami.com
	=================================================================================
	*/
	
	//function untuk menampilkan data master libur nasional
	function hari_libur()
	{
		#ambil data hari libur
		$data['showdata'] = $this->m_absensi->lnas_viewall();
		$data['page'] = 'hari_libur';		
		$data['view_hari_libur'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	//function untuk menampilkan form add master libur nasional
	function add_hari_libur()
	{
		//pemanggillan sub view
		$data['page'] = 'add_hari_libur';
		$data['add_hari_libur'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	//function untuk menghapus master data libur nasional
	function del_hari_libur()
	{
		$lnas_id = $this->uri->segment(3);
		$this->m_absensi->lnas_del($lnas_id);
		
		redirect('c_absensi/hari_libur');
	}
	
	//function untuk mengedit master data libur nasional
	function edit_hari_libur()
	{
		$lnas_id = $this->uri->segment(3);
		$data['showdata'] = $this->m_absensi->lnas_viewedit($lnas_id);
		$data['page'] = 'edit_hari_libur';
		$data['edit_hari_libur'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
		
	//function untuk mengatur lalu lintas submit (add, edit) Master Libur Nasional
	function submit_hari_libur()
	{	
		//submit dari Add Libur Nasional
		if($this->input->post('submit_lnas_add'))
		{
			$lnas_date = $this->input->post('date');
			$lnas_desc = $this->input->post('desc');
			$lnas_user = 'admin';
			
			//check same data @DB
			$check = $this->m_absensi->lnas_check($lnas_date);
			
			if($check)
			{
				$data['lnas_date'] = $lnas_date; $data['lnas_desc'] = $lnas_desc;
				$data['page'] = 'add_hari_libur';				
				redirect('c_absensi/add_hari_libur');
			}
			else
			{
				$result = $this->m_absensi->lnas_add($lnas_date, $lnas_desc, $lnas_user);
				redirect('c_absensi/hari_libur');
			}
		}
		//submit dari Add Libur Nasional
		else if($this->input->post('submit_lnas_edit'))
		{
			$lnas_id = $this->input->post('lnas_id');
			$lnas_date = $this->input->post('lnas_date');
			$lnas_desc = $this->input->post('lnas_desc');
			$lnas_user = 'admin';
				
			$result = $this->m_absensi->lnas_edit($lnas_id, $lnas_date, $lnas_desc, $lnas_user);
				
			redirect('c_absensi/hari_libur');
		}
		
	}
	
	
	/*
	======================================================================================================
	 CONTROLLER UNTUK FORMAT SCHEDULE
	======================================================================================================
	*/
	
	//function untuk menampilkan data master format schedule
	function format_schedule()
	{
		//show semua data master format schedule
		$data['showdata'] = $this->m_absensi->fsch_viewall();
		$data['page'] = 'format_schedule';		
		$data['view_format_schedule'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function detail_format_schedule()
	{
		$fsch_id = $this->uri->segment(3);
		
		//show detail data master format schedule
		$data['showdata'] = $this->m_absensi->fsch_viewdetail($fsch_id);
		$data['page'] = 'detail_format_schedule';		
		$data['view_format_schedule'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	//function untuk menampilkan form add master format schedule
	function add_format_schedule()
	{
		$data['page'] = 'add_format_schedule';		
		$data['add_format_schedule'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function add_next_format_schedule()
	{
		$data['page'] = 'add_next_format_schedule';		
		$data['add_format_schedule'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	//function untuk menghapus master format schedule
	function del_format_schedule()
	{
		$fsch_id = $this->uri->segment(3);
		$this->m_absensi->fsch_del($fsch_id);
		$this->m_absensi->fschtime_del($fsch_id);
		redirect('c_absensi/format_schedule');
	}
	
	//function untuk mengatur lalu lintas submit (add, edit) Master format schedule
	function submit_format_schedule()
	{	
		//submit next dari add format schedule
		if($this->input->post('submit_fsch_add'))
		{
			$data['fsch_name'] = $this->input->post('fsch_name');
			$data['fsch_total_day'] = $this->input->post('fsch_total_day');
			
			$this->load->vars($data);
			$this->add_next_format_schedule();
		}
		
		//submit next dari add format schedule
		if($this->input->post('submit_fsch_add_next'))
		{
			$fsch_name = $this->input->post('fsch_name');
			$fsch_total_day = $this->input->post('fsch_total_day');
			$fschtime_update_by = 'admin';
			
			//insert data ke tabel v3_format_schedule
			$result = $this->m_absensi->fsch_add($fsch_name, $fsch_total_day, $fschtime_update_by);
			
			if($result == '1')
			{				
				//ambil fsch_id data yang diinput ke tabel v3_format_schedule
				$fschtime_fsch_id = $this->m_absensi->fsch_getid($fsch_name);
			
				for($i=1;$i<=$fsch_total_day;$i++){ 
					$in = 'fschtime_time_in_'.$i;
					$break_out = 'fschtime_break_out_'.$i;
					$break_in = 'fschtime_break_in_'.$i;
					$out = 'fschtime_time_out_'.$i;
					$status = 'fschtime_off_status_'.$i;
					$breakstatus = 'fschtime_break_status_'.$i;
					
					$fschtime_time_in = $this->input->post($in);
					$fschtime_time_out = $this->input->post($out);
					$fschtime_break_in = "00:00:00";
					$fschtime_break_out = "00:00:00";
					$fschtime_off_status = $this->input->post($status);
					$fschtime_break_status = $this->input->post($breakstatus);
					
					if ($fschtime_break_status == 1 ){
						$fschtime_break_in = $this->input->post($break_in);
						$fschtime_break_out = $this->input->post($break_out);
					}
					
					//urutan data
					$fschtime_order = $i;
					
					//insert data ke tabel v3_fsch_time
					$result = $this->m_absensi->fsch_add_next($fschtime_fsch_id, $fschtime_order, $fschtime_time_in, $fschtime_break_out, $fschtime_break_in, $fschtime_time_out, $fschtime_update_by, $fschtime_off_status, $fschtime_break_status);
				}
			}
			redirect('c_absensi/format_schedule');
		}
	}		
	
	
	function fsch_edit($fsch_id)
	{
		$data['showdata'] = $this->m_absensi->fsch_getdata($fsch_id);
		$data['page'] = 'edit_format_schedule';		
		$data['edit_format_schedule'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function edit_next_format_schedule($fsch_id)
	{
		$data['showdata'] = $this->m_absensi->fsch_getdetail($fsch_id);
		$data['page'] = 'edit_next_format_schedule';		
		$data['add_format_schedule'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function update_format_schedule()
	{	
		//submit next dari add format schedule
		if($this->input->post('submit_fsch_add'))
		{
			$data['fsch_id'] = $this->input->post('fsch_id');
			$data['fsch_name'] = $this->input->post('fsch_name');
			$data['fsch_total_day'] = $this->input->post('fsch_total_day');
			
			$this->load->vars($data);
			$this->edit_next_format_schedule($this->input->post('fsch_id'));
		}
		
		//submit next dari add format schedule
		if($this->input->post('submit_fsch_add_next'))
		{
			$fsch_id = $this->input->post('fsch_id');
			$fsch_name = $this->input->post('fsch_name');
			$fsch_total_day = $this->input->post('fsch_total_day');
			$fschtime_update_by = 'admin';
			
			//insert data ke tabel v3_format_schedule
			$result = $this->m_absensi->fsch_edit($fsch_id, $fsch_name, $fsch_total_day, $fschtime_update_by);
			
			//if($result == '1')
			//{				
				//ambil fsch_id data yang diinput ke tabel v3_format_schedule
				$fschtime_fsch_id = $this->m_absensi->fsch_getid($fsch_name);
				
				for($i=1;$i<=$fsch_total_day;$i++){ 
					$id = 'fschtime_id_'.$i;
					$in = 'fschtime_time_in_'.$i;
					$out = 'fschtime_time_out_'.$i;
					$status = 'fschtime_off_status_'.$i;
					$fschtime_id = $this->input->post($id);
					$fschtime_time_in = $this->input->post($in);
					$fschtime_time_out = $this->input->post($out);
					$fschtime_off_status = $this->input->post($status);
					
					//urutan data
					$fschtime_order = $i;
					
					//insert data ke tabel v3_fsch_time
					$result = $this->m_absensi->fsch_edit_next($fschtime_id, $fschtime_fsch_id, $fschtime_order, $fschtime_time_in, $fschtime_time_out, $fschtime_update_by, $fschtime_off_status);
				}
			
			//}
				
			redirect('c_absensi/format_schedule');
		}
	}	
	
	/*
	======================================================================================================
	 CONTROLLER UNTUK FORMAT SCHEDULE TO ABSENSI
	======================================================================================================
	*/
	
	function schedule_pegawai()
	{	
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['page'] = 'schedule_pegawai';		
		$data['view_schedule_pegawai'] = 'class="this"';
		$data['form_absensi'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function add_schedule_pegawai()
	{
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['showdata2'] = $this->m_absensi->ambil_data_format_schedule();
		
		$data['page'] = 'add_schedule_pegawai';		
		$data['add_schedule_pegawai'] = 'class="this"';
		$data['form_absensi'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function submit_schedule_pegawai()
	{
		//submit dari Add Shcedule Pegawai
		if($this->input->post('submit_fschpeg_add'))
		{  
			$unit = $this->input->post('unit'); //unit_code
			$id_pegawai = $this->input->post('nipp'); //id_pegawai
			$fsch = $this->input->post('format_schedule'); //fsch_id
			$starttime = $this->input->post('starttime'); //fschtime_order
			$month = $this->input->post('month'); 
			$year = $this->input->post('year');
			$update_by = "admin";
		
			if($id_pegawai == "all") 
			{
				//ambil data pegawai per nipp per 1 unit
				$dataall= $this->m_asset->ambil_data_pegawai($unit);
				foreach($dataall as $data) : {
					
					//ambil id terbesar di v3_fsch_pegawai
					$fschpeg_id = $this->m_asset->ambil_fschpeg_id_terbesar();
					$fschpeg_id = $fschpeg_id +1;
					
					$id_pegawai = $data['id_pegawai'];
					
					//ambil total day dari format schedule yang digunakan
					$totalday = $this->m_asset->ambil_totalday_fsch_id($fsch);
					
					
					//cek dup  v3_fsch_pegawai
					$cekdup_fschpeg_id = $this->m_absensi->cek_dup_data_format_schedule_pegawai($id_pegawai, $month, $year);
					if($cekdup_fschpeg_id > 0){
						// update table v3_fsch_pegawai
						$fschpeg_id = $cekdup_fschpeg_id;
						$this->m_absensi->update_data_format_schedule_pegawai($fschpeg_id, $fsch, $update_by );
					} else {
						// insert data ke table v3_fsch_pegawai
						$this->m_absensi->insert_data_format_schedule_pegawai($fschpeg_id, $fsch, $id_pegawai, $month, $year, $update_by );
					}
					$start_order = $starttime;
					
					//insert data schedule ke table v3_fschpeg_absensi_(year)
						
					//change bulan 1 menjadi bulan 01
					$newmonth = $this->month($month);
						
					//Jika Bulan Desember, maka startdate tahunnya 2012, enddatenya tahunnya 2013 and next monthnya 01
					if($month == 12) { $newnextmonth = $this->month(1); $nextyear = $year+1; } 
					else { $newnextmonth = $this->month($month+1);	$nextyear = $year; 	}
						
					//inisial date start dan end date
					$startdate = "".$year."-".$newmonth."-01";
					$enddate = "".$nextyear."-".$newnextmonth."-01";
						
					//ambil tanggal dalam bulan itu
					$ambil_tanggal = $this->createDateRangeArray($startdate, $enddate);
						
					//hitung jumlah harinya
					$jmlhari = $this->hitunghari($startdate, $enddate);
						
					//start loop
					
					
					for($i = 0; $i<=$jmlhari; $i++) {
						
						$tgl = element($i, $ambil_tanggal);
						
						//ambil format schedule dimulai dari starttime
						$dataorder = $this->m_asset->ambil_data_fschtime_berdasarkan_fschtime_order($fsch, $start_order);
							
						foreach($dataorder as $datanew) : {
							$time_in = $datanew['fschtime_time_in'];
							$break_out = $datanew['fschtime_break_out'];
							$break_in = $datanew['fschtime_break_in'];
							$time_out = $datanew['fschtime_time_out'];
							$offstatus = $datanew['fschtime_off_status'];
							$breakstatus = $datanew['fschtime_break_status'];
						} endforeach;
						
						$check_libur = $this->m_asset->check_libur($tgl);
						if($check_libur == 1) { $offstatus = 2; }
						
						//check if nextday
						if($time_out < $time_in){ $tgl2 = $this->adddate($tgl, "+1 day"); } else { $tgl2 = $tgl; }
						if($break_out < $time_in){ $tgl3 = $this->adddate($tgl, "+1 day"); } else { $tgl3 = $tgl; }
						if($break_in < $time_in){ $tgl4 = $this->adddate($tgl, "+1 day"); } else { $tgl4 = $tgl; }
																						
						$time_in = "".$tgl." ".$time_in."";
						$time_out = "".$tgl2." ".$time_out."";							
						if ($breakstatus == "1" ){
							$break_out = "".$tgl3." ".$break_out."";							
							$break_in = "".$tgl4." ".$break_in."";							
						} else {
							$break_out = "0000-00-00 00:00:00";
							$break_in = "0000-00-00 00:00:00";
						}
						 
						$cek_dup_fschpeg_abs = $this->m_absensi->cek_dup_data_format_schedule_pegawai_absensi($fschpeg_id, $time_in, $year);
						//echo  $cek_dup_fschpeg_abs." aksjdkja ";
						if($cek_dup_fschpeg_abs > 0){
							$this->m_absensi->update_data_format_schedule_pegawai_absensi($cek_dup_fschpeg_abs, $fschpeg_id, $time_in, $break_out, $break_in, $time_out, $offstatus, $update_by, $year);
						} else {
							$this->m_absensi->insert_data_format_schedule_pegawai_absensi($fschpeg_id, $time_in, $break_out, $break_in, $time_out, $offstatus, $update_by, $year);
						}	
						
						if($start_order == $totalday) { $start_order = 1;} else { $start_order = $start_order + 1; }
						
					}
					
				} endforeach;// endforeach
				
				redirect('c_absensi/schedule_pegawai');
			
				
			} // end all
			else if($id_pegawai != "all") 
			{
					
					//ambil id terbesar di v3_fsch_pegawai
					$fschpeg_id = $this->m_asset->ambil_fschpeg_id_terbesar();
					$fschpeg_id = $fschpeg_id +1;
										
					//ambil total day dari format schedule yang digunakan
					$totalday = $this->m_asset->ambil_totalday_fsch_id($fsch);
					
					//cek dup  v3_fsch_pegawai
					$cekdup_fschpeg_id = $this->m_absensi->cek_dup_data_format_schedule_pegawai($id_pegawai, $month, $year);
					if($cekdup_fschpeg_id > 0){
						// update table v3_fsch_pegawai
						$fschpeg_id = $cekdup_fschpeg_id;
						$this->m_absensi->update_data_format_schedule_pegawai($fschpeg_id, $fsch, $update_by );
					} else {
						// insert data ke table v3_fsch_pegawai
						$this->m_absensi->insert_data_format_schedule_pegawai($fschpeg_id, $fsch, $id_pegawai, $month, $year, $update_by );
					}
										
					//insert data schedule ke table v3_fschpeg_absensi_2012
						
					//change bulan 1 menjadi bulan 01
					$newmonth = $this->month($month);
						
					//Jika Bulan Desember, maka startdate tahunnya 2012, enddatenya tahunnya 2013 and next monthnya 01
					if($month == 12) { $newnextmonth = $this->month(1); $nextyear = $year+1;} 
					else { $newnextmonth = $this->month($month+1);	$nextyear = $year; 	}
						
					//inisial date start dan end date
					$startdate = "".$year."-".$newmonth."-01";
					$enddate = "".$nextyear."-".$newnextmonth."-01";
						
					//ambil tanggal dalam bulan itu
					$ambil_tanggal = $this->createDateRangeArray($startdate, $enddate);
						
					//hitung jumlah harinya
					$jmlhari = $this->hitunghari($startdate, $enddate);
					
					$start_order = $starttime;
						
					//start loop
						
					
					for($i = 0; $i<=$jmlhari; $i++) {
						
						$tgl = element($i, $ambil_tanggal);
							
						//ambil format schedule dimulai dari starttime
						$dataorder = $this->m_asset->ambil_data_fschtime_berdasarkan_fschtime_order($fsch, $start_order);
							
						foreach($dataorder as $datanew) : {
							$time_in = $datanew['fschtime_time_in'];
							$break_out = $datanew['fschtime_break_out'];
							$break_in = $datanew['fschtime_break_in'];
							$time_out = $datanew['fschtime_time_out'];
							$offstatus = $datanew['fschtime_off_status'];
						} endforeach;
							
						$check_libur = $this->m_asset->check_libur($tgl);
						if($check_libur == 1) { $offstatus = 2; }
												
						//check if nextday
						if($time_out < $time_in){ $tgl2 = $this->adddate($tgl, "+1 day"); } else { $tgl2 = $tgl; }
						if($break_out < $time_in){ $tgl3 = $this->adddate($tgl, "+1 day"); } else { $tgl3 = $tgl; }
						if($break_in < $time_in){ $tgl4 = $this->adddate($tgl, "+1 day"); } else { $tgl4 = $tgl; }
																						
						$time_in = "".$tgl." ".$time_in."";
						$time_out = "".$tgl2." ".$time_out."";							
						if ($breakstatus == "1" ){
							$break_out = "".$tgl3." ".$break_out."";							
							$break_in = "".$tgl4." ".$break_in."";							
						} else {
							$break_out = "0000-00-00 00:00:00";
							$break_in = "0000-00-00 00:00:00";
						}
						
						$cek_dup_fschpeg_abs = $this->m_absensi->cek_dup_data_format_schedule_pegawai_absensi($fschpeg_id, $time_in, $year);
						if($cek_dup_fschpeg_abs > 0){
							$this->m_absensi->update_data_format_schedule_pegawai_absensi($cek_dup_fschpeg_abs, $fschpeg_id, $time_in, $break_out, $break_in, $time_out, $offstatus, $update_by, $year);
						} else {
							$this->m_absensi->insert_data_format_schedule_pegawai_absensi($fschpeg_id, $time_in, $break_out, $break_in, $time_out, $offstatus, $update_by, $year);
						}	
							
						if($start_order == $totalday) { $start_order = 1;} else { $start_order = $start_order + 1; }
					}
						
				redirect('c_absensi/schedule_pegawai');
				
			} //endelse
			
		}
		else if($this->input->post('submit_fschpeg_view'))
		{
		
			$unit = $this->input->post('unit'); //unit_code
			$month = $this->input->post('month'); 
			$year = $this->input->post('year');
			
			//change bulan 1 menjadi bulan 01
			$newmonth = $this->month($month);
						
			//Jika Bulan Desember, maka startdate tahunnya 2012, enddatenya tahunnya 2013 and next monthnya 01
			if($month == 12) { $newnextmonth = $this->month(1); $nextyear = $year+1; 
			} else { $newnextmonth = $this->month($month+1);	$nextyear = $year; 	}
						
			//inisial date start dan end date
			$startdate = "".$year."-".$newmonth."-01";
			$enddate = "".$nextyear."-".$newnextmonth."-01";
			
			$jmlhari = $this->hitunghari($startdate, $enddate);
			
			//ambil data pegawai per nipp per unit
			$data['showdata'] = $this->m_absensi->ambil_data_schedule_pegawai($unit, $month, $year);
			
			$data['bulantahun'] = "".$this->namabulan($month)." ".$year."";
			$data['year'] = $year;
			$data['unitshow'] = $unit;
			$data['startdate'] = $startdate;
			$data['enddate'] = $enddate;
			$data['jmlhari'] = $jmlhari;		
			
			
			$data['page'] = 'view_schedule_pegawai';		
			$data['view_schedule_pegawai'] = 'class="this"';
			$data['form_absensi'] = 'id="current"';
			$this->load->view('absensi/index',$data);
		
		} //end else if
		else{
			redirect('c_absensi/schedule_pegawai');
		}
	}
	
	
	/*
	======================================================================================================
	 CONTROLLER UNTUK ABSENSI
	======================================================================================================
	*/
	
	function absensi()
	{	
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['page'] = 'absensi';		
		$data['view_absensi'] = 'class="this"';
		$data['form_absensi'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function submit_absensi()
	{
		if($this->input->post('submit_absensi'))
		{
			$unit = $this->input->post('unit'); //unit_code
			$month = $this->input->post('month'); 
			$year = $this->input->post('year');
			
			//change bulan 1 menjadi bulan 01
			$newmonth = $this->month($month);
						
			//Jika Bulan Desember, maka startdate tahunnya 2012, enddatenya tahunnya 2013 and next monthnya 01
			if($month == 12) 
			{ 
				$newnextmonth = $this->month(1); 
				$nextyear = $year+1; 
			} 
			else 
			{ 
				$newnextmonth = $this->month($month+1);	
				$nextyear = $year; 	
			}
						
			//inisial date start dan end date
			$startdate = "".$year."-".$newmonth."-01";
			$enddate = "".$nextyear."-".$newnextmonth."-01";
			
			$jmlhari = $this->hitunghari($startdate, $enddate);
			
			//ambil data pegawai per nipp per unit
			$data['showdata'] = $this->m_absensi->ambil_data_absensi($unit, $month, $year);
			
			$data['bulantahun'] = "".$this->namabulan($month)." ".$year."";
			$data['year'] = $year;
			$data['month'] = $this->namabulan($month);
			$data['unitshow'] = $unit;
			$data['startdate'] = $startdate;
			$data['enddate'] = $enddate;
			$data['jmlhari'] = $jmlhari;		
			
			
			$data['page'] = 'view_absensi';		
			$data['view_absensi'] = 'class="this"';
			$data['form_absensi'] = 'id="current"';
			$this->load->view('absensi/index',$data);
		
		}//endif	
	
	}
	
	function view_detail_absensi()
	{
		$fschpeg_id = $this->uri->segment(3);
		$year = $this->uri->segment(5);
		
		//showdata 
		$data['showdata'] = $this->m_absensi->ambil_data_detail_absensi($fschpeg_id,$year);
		if($data['showdata'] !== 0){
			$data['page'] = 'view_detail_absensi';		
			$data['view_schedule_pegawai'] = 'class="this"';
			$data['form_absensi'] = 'id="current"';
			$this->load->view('absensi/index',$data);
		}else{
			redirect('c_absensi/absensi');
		}
	}
	
	function print_detail_absensi()
	{
		$fschpeg_id = $this->uri->segment(3);
		$year = $this->uri->segment(5);
		
		//showdata 
		$data['bulan']	=	$this->uri->segment(4);
		$data['tahun']	=	$this->uri->segment(5);
		$data['showdata'] = $this->m_absensi->ambil_data_detail_absensi($fschpeg_id,$year);
		
		$this->load->view('absensi/page/absensi/print_detail_absensi',$data);
		?>	
		<script>window.print();	</script>
		<?php
	}
	
	function edit_detail_absensi()
	{
		$fschpeg_id = $this->uri->segment(3);
		$fschpeg_tanggal = $this->uri->segment(4);
		$year = $this->uri->segment(7);
		
		//showdata 
		$data['showdata'] = $this->m_absensi->ambil_data_detail_absensi_by_tanggal($fschpeg_id,$fschpeg_tanggal,$year);
		
		$data['page'] = 'edit_detail_absensi';		
		$data['view_schedule_pegawai'] = 'class="this"';
		$data['form_absensi'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function submit_edit_detail_absensi()
	{
		$nipp = $this->input->post('nipp');
		$datestring = "%Y-%m-%d %H:%i:%s" ;
		$jam = "%H:%i";
		$time = time();
		$fschpeg_id = $this->input->post('fschpeg_id');
		$fschpeg_tanggal = $this->input->post('fschpeg_tanggal');
		
		// tgl out
		if (((mdate($jam, strtotime($this->input->post('real_out')))) - (mdate($jam,strtotime($this->input->post('real_in'))))) < 0)
		{
			$date_out = (int)$this->input->post('date')+ 1;
		} else {
			$date_out = $this->input->post('date');
		}
		if (strlen($this->input->post('date')) <= 1)
		{
			$date = '0'.$this->input->post('date');
		} else {
			$date = $this->input->post('date');
		}
		if (strlen($date_out) <= 1)
		{
			$date_out = '0'.$date_out;
		} else {
			$date_out = $date_out;
		}
		
		// tgl break out
		if (((mdate($jam, strtotime($this->input->post('real_break_out')))) - (mdate($jam,strtotime($this->input->post('real_in'))))) < 0)
		{
			$date_break_out = (int)$this->input->post('date')+ 1;
		} else {
			$date_break_out = $this->input->post('date');
		}
		if (strlen($date_break_out) <= 1)
		{
			$date_break_out = '0'.$date_break_out;
		} else {
			$date_break_out = $date_break_out;
		}
		
		// tgl break in
		if (((mdate($jam, strtotime($this->input->post('real_break_in')))) - (mdate($jam,strtotime($this->input->post('real_in'))))) < 0)
		{
			$date_break_in = (int)$this->input->post('date')+ 1;
		} else {
			$date_break_in = $this->input->post('date');
		}
		if (strlen($date_break_in) <= 1)
		{
			$date_break_in = '0'.$date_break_in;
		} else {
			$date_break_in = $date_break_in;
		}
		
		$month = $this->angkabulan($this->input->post('month'));
		$year = $this->input->post('year');
		$tanggal_in = $date.'-'.$month.'-'.$year; 
		$tanggal_out = $date_out.'-'.$month.'-'.$year; 
		$tanggal_break_in = $date_break_in.'-'.$month.'-'.$year;
		$tanggal_break_out = $date_break_out.'-'.$month.'-'.$year;
		
		/* ini sebelum diedit
		if ($this->input->post('sch_in') == NULL)
		{
			$data['sch_in'] = mdate($datestring, strtotime($tanggal_in.' '.$this->input->post('real_in').':00'));
		} else {
			$data['sch_in'] = mdate($datestring, strtotime($this->input->post('sch_in_date').' '.$this->input->post('sch_in').':00'));
		}
		if ($this->input->post('sch_out') == NULL)
		{
			$data['sch_out'] = mdate($datestring, strtotime($tanggal_in.' '.$this->input->post('real_out').':00'));
		} else {
			$data['sch_out'] = mdate($datestring, strtotime($this->input->post('sch_out_date').' '.$this->input->post('sch_out').':00'));
		}
		*/
		
		$data['sch_in'] = mdate($datestring, strtotime($tanggal_in.' '.$this->input->post('sch_in').':00'));
		$data['sch_out'] = mdate($datestring, strtotime($tanggal_out.' '.$this->input->post('sch_out').':00'));
		$data['real_in'] = mdate($datestring, strtotime($tanggal_in.' '.$this->input->post('real_in').':00'));
		$data['real_out'] = mdate($datestring, strtotime($tanggal_out.' '.$this->input->post('real_out').':00'));
	
		if($this->input->post('sch_break_out') == "00:00")
		{ 	
			$data['sch_break_out'] = "0000-00-00 00:00:00"; 
		}
		else
		{
			$tanggal_sch_break_out = $date_break_out.'-'.$month.'-'.$year;
			$data['sch_break_out'] = mdate($datestring, strtotime($tanggal_sch_break_out.' '.$this->input->post('sch_break_out').':00'));
		}
		
		if($this->input->post('sch_break_in') == "00:00")
		{
			$data['sch_break_in'] = "0000-00-00 00:00:00"; 
		}
		else
		{
			$tanggal_sch_break_in = $date_break_in.'-'.$month.'-'.$year;
			$data['sch_break_in'] = mdate($datestring, strtotime($tanggal_sch_break_in.' '.$this->input->post('sch_break_in').':00'));
		}
		
		if($this->input->post('real_break_out') == "00:00"){ 
			$data['real_break_out'] = "0000-00-00 00:00:00"; 
		}
		else
		{
			$tanggal_real_break_out = $date_break_out.'-'.$month.'-'.$year;
			$data['real_break_out'] = mdate($datestring, strtotime($tanggal_real_break_out.' '.$this->input->post('real_break_out').':00'));
		}
		if($this->input->post('real_break_in') == "00:00")
		{ 
			$data['real_break_in'] = "0000-00-00 00:00:00"; 
		}
		else
		{	
			$tanggal_real_break_in = $date_break_in.'-'.$month.'-'.$year;
			$data['real_break_in'] = mdate($datestring, strtotime($tanggal_real_break_in.' '.$this->input->post('real_break_in').':00'));
		}
		
		#real time in
		if($this->input->post('real_in') == "00:00")
		{ 
			$data['real_in'] = "0000-00-00 00:00:00"; 
		}
		else
		{	
			$data['real_in'] = mdate($datestring, strtotime($tanggal_in.' '.$this->input->post('real_in').':00'));
		}
		#real time out
		if($this->input->post('real_out') == "00:00")
		{ 
			$data['real_out'] = "0000-00-00 00:00:00"; 
		}
		else
		{	
			$data['real_out'] = mdate($datestring, strtotime($tanggal_out.' '.$this->input->post('real_out').':00'));
		}
		
		$data['off_status'] = $this->input->post('status');
		
		$this->m_absensi->submit_edit_detail_absensi($fschpeg_id,$fschpeg_tanggal,$year, $data, username());
				
		redirect('c_absensi/view_detail_absensi/'.$fschpeg_id.'/'.$this->input->post('month').'/'.$year.'/'.$nipp);
	}
	
	function tarik_absensi()
	{
		#tarik data dari mesin manual
		$ip = $this->uri->segment(3, 0);
		$key = "0";
		
		$Connect = fsockopen($ip, "80", $errno, $errstr, 1);
		
		if($Connect)
		{
			$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
			$newLine="\r\n";
			fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
			fputs($Connect, "Content-Type: text/xml".$newLine);
			fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
			fputs($Connect, $soap_request.$newLine);
			$buffer="";
				while($Response=fgets($Connect, 1024))
				{
					$buffer=$buffer.$Response;
				}
			}
		else
		{
			echo 'fail';
		}
		
		$buffer = $this->parse_data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
		$buffer = explode("\r\n",$buffer);
		
		echo "<table>";
		echo "<tr>";
		echo "<td>NIPP</td><td>Date</td><td>Status</td><td>Verified</td>";
		
		for($a=1;$a<count($buffer);$a++)
		{
			$data = $this->parse_data($buffer[$a],"<Row>","</Row>");
			$pin = $this->parse_data($data,"<PIN>","</PIN>");
			$datetime = $this->parse_data($data,"<DateTime>","</DateTime>");
			$status = $this->parse_data($data,"<Status>","</Status>");
			$verified = $this->parse_data($data,"<Verified>","</Verified>");
						
			#masukkan data dari mesin ke database tampung / backup
			$this->m_absensi->input_data_backup_mesin($pin,$datetime,$status, $verified);
			
			echo "<tr><td>" . $pin . "</td><td>" . $datetime . "</td><td>" . $status . "</td><td>" . $verified . "</td></tr>";
			#foreach ($query as $row)
			#	{
			#		echo $row->dbmesin_nipp . '<br />';
					#echo $row['name'];
					#echo $row['email'];
			#	}
			#ambil data dari mesin dimasukkan ke database absensi
			#$this->m_absensi->input_data_absensi_mesin($pin,$datetime,$status);
			
		}
		
		echo "</tr>";
		echo "</table>";
		
		# hapus null nipp dari table
		$this->m_absensi->del_null_dbmesin_nipp();
		
		# back up to excell 
		#hapus data dari mesin
		
		#redirect('c_absensi/absensi');
		
		// tambahan
		//$this->copy_data_tampung_to_absensi;
		
	}
	
	function check_dup()
	{
		$query = $this->m_absensi->del_dup_data_in();
			
			print_r($query);
	}
	
	# Parse Data untuk tarik data absensi dari mesin sidik jari, default bawaan pabrik
	function parse_data($data,$p1,$p2)
	{
		$data=" ".$data;
		$hasil="";
		$awal=strpos($data,$p1);
		if($awal!=""){
			$akhir=strpos(strstr($data,$p1),$p2);
			if($akhir!=""){
				$hasil=substr($data,$awal+strlen($p1),$akhir-strlen($p1));
			}
		}
		return $hasil;
		echo 'hasil' . $hasil;	
	}
	
	#################################
	# PENGGUNAAN CUTI
	#################################
	function add_pakai_cuti_pegawai()
	{
		//ambil data unit
		$data['showdata1'] = $this->m_asset->ambil_data_provider();
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['page'] = 'add_pakai_cuti_pegawai';		
		$data['add_pakai_cuti_pegawai'] = 'class="this"';
		$data['form_absensi'] = 'id="current"';
		$this->load->view('absensi/index',$data);	
	}
	function add_next_pakai_cuti_pegawai()
	{
		$data['page'] = 'add_next_pakai_cuti_pegawai';		
		$data['add_next_pakai_cuti_pegawai'] = 'class="this"';
		$data['form_absensi'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function submit_pakai_cuti()
	{
		//submit next dari add format schedule
		if($this->input->post('submit_pakai_cuti_add'))
		{
			$unit = $this->input->post('unit'); //unit_code
			$id_pegawai = $this->input->post('nipp'); //id_pegawai
			$data['unit'] = $this->input->post('unit');
			$data['id_pegawai'] = $this->input->post('nipp');
			if ($this->input->post('nipp') === 'all'){ redirect('c_absensi/add_pakai_cuti_pegawai'); } 
			$data['provider'] = $this->input->post('provider');
			$data['pegawai'] = $this->m_asset->ambil_data_pegawai_berdasarkan_id($id_pegawai);
			$tahun_lalu = date("Y") - 1;
			$sisa_cuti_tahun_lalu = 0;
			if ( date("n") < 4){
				$sisa_cuti_tahun_lalu = $this->m_asset->ambil_sisa_cuti_pegawai($id_pegawai,$tahun_lalu);
			}
			$tahun = date("Y");
			$sisa_cuti = $this->m_asset->ambil_sisa_cuti_pegawai($id_pegawai,$tahun);
			$data['sisa_cuti_tahun_lalu']=$sisa_cuti_tahun_lalu; 
			$data['sisa_cuti'] = $sisa_cuti + $sisa_cuti_tahun_lalu;
			
			
			$this->load->vars($data);
			$this->add_next_pakai_cuti_pegawai();
		}
		
		//submit next dari add format schedule
		if($this->input->post('submit_pakai_cuti_add_next'))
		{
		
			$unit = $this->input->post('unit'); //unit_code
			$nipp = $this->input->post('nipp'); //nipp
			$id_pegawai = $this->input->post('id_pegawai'); //id_pegawai
			$mulai_cuti = $this->input->post('date');
			$sisa_cuti_tahun_lalu = $this->input->post('sisa_cuti_tahun_lalu');
			$sisa_cuti = $this->input->post('sisa_cuti');
			$lama_cuti = $this->input->post('lama_cuti');
			$ket = $this->input->post('keterangan');
			$iter = $this->input->post('lama_cuti');
			$tahun_lalu = date("Y") - 1;
			$tahun = date("Y");
			
			$update_by = 'admin';
			
			//insert data ke tabel v3_format_schedule
			if ($sisa_cuti_tahun_lalu > 0)
			{
				$lama_cuti = $lama_cuti - $sisa_cuti_tahun_lalu;
				$result = $this->m_asset->update_cuti_terpakai($id_pegawai, $sisa_cuti_tahun_lalu, $tahun_lalu, $update_by);
			}  
			
			if ($lama_cuti > 0)
			{
				$result = $this->m_asset->update_cuti_terpakai($id_pegawai, $lama_cuti, $tahun, $update_by);
			}
			
			
			if($result == '1')
			{				
				$result = $this->m_asset->add_cuti_daily($id_pegawai, $iter, $mulai_cuti, $tahun, $ket, $update_by);
				$absen = $this->m_asset->update_absen_pegawai_cuti($id_pegawai, $tahun, $mulai_cuti, $iter);
			}
				
			redirect('c_absensi/cuti_pegawai');
		}
	}
	
	function detail_cuti_pegawai()
	{
		$cm_id = $this->uri->segment(3);
		$year = $this->uri->segment(4);
		$data['showdata'] = $this->m_asset->get_detail_cuti_pegawai($cm_id,$year);
		
		$data['page'] = 'detail_cuti_pegawai';
		$data['view_cuti_pegawai'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		#calling view
		$this->load->view('absensi/index',$data);
	}
	
	
	/*
	======================================================================================================
	 FUNCTION LEMBUR PEGAWAI
	======================================================================================================
	*/
	
	function lembur_pegawai()
	{	
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['page'] = 'lembur_pegawai';		
		$data['view_lembur_pegawai'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function view_lembur_pegawai()
	{	
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_lembur(); 
		$data['unitshow'] = $this->input->post('unit');
		$data['page'] = 'view_lembur_pegawai';		
		$data['view_lembur_pegawai'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function view_detail_lembur()
	{	
		//ambil data unit
		$id=$this->uri->segment(3);
		$data['showdata'] = $this->m_asset->ambil_data_lembur_by_id($id); 
		$show = $data['showdata'];
		foreach ($show as $row){
			$penerimaan = $row['lmb_hari_kerja'] + $row['lmb_hari_libur'] + $row['lmb_ex_voed'] + $row['lmb_shift_all'] - $row['lmb_potongan'] + $row['lmb_apresiasi'] + $row['lmb_koreksi'] + $row['lmb_natura'];
		};
		$data['terbilang']= $this->terbilang($penerimaan);
		$data['month']=	$this->namabulan($this->uri->segment(4));
		$data['year']=$this->uri->segment(5);
		$data['penerimaan'] = $penerimaan;
		$data['page'] = 'view_detail_lembur';		
		$data['view_detail_lembur'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	
	function add_lembur()
	{
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['page'] = 'add_lembur';		
		$data['add_lembur'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('absensi/index',$data);	
	}
	
	function edit_lembur()
	{
		//ambil data unit
		$id=$this->uri->segment(3);
		$data['showdata'] = $this->m_asset->ambil_data_lembur_by_id($id); 
		$show = $data['showdata'];
		foreach ($show as $row){
			$penerimaan = $row['lmb_hari_kerja'] + $row['lmb_hari_libur'] + $row['lmb_ex_voed'] + $row['lmb_shift_all'] - $row['lmb_potongan'] + $row['lmb_apresiasi'] + $row['lmb_koreksi'] + $row['lmb_natura'];
		};
		$data['penerimaan'] = $penerimaan;
		$data['page'] = 'edit_lembur';		
		$data['edit_lembur'] = 'class="this"';
		$data['form_gaji'] = 'id="current"';
		$this->load->view('absensi/index',$data);	
	}
	
	function submit_lembur_pegawai()
	{
		if($this->input->post('submit_lembur_view'))
		{
			$unit = $this->input->post('unit'); //unit_code
			$month = $this->input->post('month'); //unit_code
			$year = $this->input->post('year'); //unit_code
			$id_pegawai = $this->input->post('nipp'); //id_pegawai
			$data['page'] = 'view_lembur_pegawai';		
			$data['view_lembur_pegawai'] = 'class="this"';
			$data['form_gaji'] = 'id="current"';
			
			
			$data['showdata'] = $this->m_asset->ambil_data_lembur($unit,$id_pegawai,$month,$year); 
			$this->load->view('absensi/index',$data);
		}
		
		
		if($this->input->post('submit_lembur_add'))
		{
			$check = $this->m_asset->add_lembur();
			redirect('c_absensi/lembur_pegawai');
		}
		//submit dari Add Libur Nasional
		else if($this->input->post('submit_lembur_edit'))
		{
			$result = $this->m_asset->edit_lembur();
			redirect('c_absensi/lembur_pegawai');
		}
	}
	
	
	/*
	======================================================================================================
	 FUNCTION CUTI
	======================================================================================================
	*/
	
	function cuti_pegawai()
	{
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		
		$data['page'] = 'cuti_pegawai';		
		$data['view_cuti_pegawai'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);	
	}
	
	function cuti_add()
	{
		//ambil data unit
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		
		$data['page'] = 'add_cuti_pegawai';		
		$data['view_cuti_pegawai'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);	
	}
	
	//del cuti master
	function del_cuti()
	{
		$cm_id = $this->uri->segment(3);
		$unit = $this->uri->segment(4);
		$year = $this->uri->segment(5);
		
		#del cuti
		$this->m_absensi->cuti_del($cm_id);
		
		#ambil data cuti
		$data['showdata'] = $this->m_absensi->cuti_pegawai($unit, $year);
			
		$data['unit'] = $unit;
		$data['year'] = $year;
			
		$data['page'] = 'view_cuti_pegawai';		
		$data['view_cuti_pegawai'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);
	}
	
	function submit_cuti_pegawai()
	{
		if($this->input->post('submit_cuti_view'))
		{
			$unit = $this->input->post('unit'); //unit_code
			$year = $this->input->post('year');
			
			#ambil data cuti
			$data['showdata'] = $this->m_absensi->cuti_pegawai($unit, $year);
			
			$data['unit'] = $unit;
			$data['year'] = $year;
			
			$data['page'] = 'view_cuti_pegawai';		
			$data['view_cuti_pegawai'] = 'class="this"';
			$data['form_master'] = 'id="current"';
			$this->load->view('absensi/index',$data);
			
		}
		
		if($this->input->post('submit_cuti_add'))
		{
			$unit = $this->input->post('unit'); //unit_code
			$id_pegawai = $this->input->post('nipp'); //id_pegawai
			$totalcuti = $this->input->post('totalcuti');
			$year = $this->input->post('year');
			$update_by = "admin";
			
			if($id_pegawai == "all") 
			{
				//ambil data pegawai per nipp per 1 unit
				$dataall= $this->m_asset->ambil_data_pegawai($unit);
				foreach($dataall as $data) : 
				{
					$id_pegawai = $data['id_pegawai'];
					
					#insert data
					$this->m_absensi->cuti_add($id_pegawai, $totalcuti, $year, $update_by);
								
				} endforeach;// endforeach	
				
				#show data
				$data['showdata'] = $this->m_absensi->cuti_pegawai($unit, $year);
					
				$data['unit'] = $unit;
				$data['year'] = $year;
					
				$data['page'] = 'view_cuti_pegawai';		
				$data['view_cuti_pegawai'] = 'class="this"';
				$data['form_master'] = 'id="current"';
				$this->load->view('absensi/index',$data);	
						
			}
			else if($id_pegawai != "all") 
			{
				
				
				$this->m_absensi->cuti_add($id_pegawai, $totalcuti, $year, $update_by);
				
				#show data
				$data['showdata'] = $this->m_absensi->cuti_pegawai($unit, $year);
					
				$data['unit'] = $unit;
				$data['year'] = $year;
					
				$data['page'] = 'view_cuti_pegawai';		
				$data['view_cuti_pegawai'] = 'class="this"';
				$data['form_master'] = 'id="current"';
				$this->load->view('absensi/index',$data);	
			}
		}
	}
	
	function edit_cuti()
	{
		//ambil data unit
		$cm_id = $this->uri->segment(3);
		$unit = $this->uri->segment(4);
		$year = $this->uri->segment(5);
		
		$data['showdata'] = $this->m_asset->ambil_data_unit();
		$data['cuti'] = $this->m_asset->ambil_data_pegawai_cuti($cm_id);
		
		
		$data['page'] = 'edit_cuti_pegawai';		
		$data['view_cuti_pegawai'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('absensi/index',$data);	
	}
	
	function update_cuti_pegawai()
	{
		//$unit = $this->input->post('unit'); //unit_code
		$cm_id = $this->input->post('cm_id'); //id_pegawai
		$id_pegawai = $this->input->post('id_peg'); //id_pegawai
		$totalcuti = $this->input->post('totalcuti');
		$year = $this->input->post('year');
		$update_by = "admin";
		$result = $this->m_absensi->cuti_pegawai_edit($cm_id, $id_pegawai, $totalcuti, $year, $update_by);
		redirect('c_absensi/cuti_pegawai');
	}
	
	/*
	======================================================================================================
	 CONTROLLER ASSET
	======================================================================================================
	*/
	
	// ambil data nipp pegawai berdasarkan unit
	function cari_nipp()
	{
		$unit = $this->input->post('kode_unit');
		$data = $this->m_asset->ambil_data_pegawai($unit);
		?>
		<select class="nipp" name="nipp">
			<option value="all">ALL</option>
            
			<?php foreach($data as $row) : { ?>
		   	<option value="<?php echo $row['id_pegawai']; ?>"><?php echo $row['p_unt_nipp']; ?></option>
		    <?php } endforeach; ?>
            
		</select>
    	<?php	
	}
	
	// ambil data nipp pegawai berdasarkan unit
	function cari_time()
	{
		$fsch_id = $this->input->post('kode_time');
		$data['showdata'] = $this->m_asset->ambil_data_time_schedule($fsch_id);
		?>
		<select class="starttime" name="starttime">            
			<?php foreach($data['showdata']->result() as $data) { ?>
		   	<option value="<?php echo $data->fschtime_order; ?>">
			<?php echo "Day ".$data->fschtime_order. " / "; if($data->fschtime_off_status == "1") { echo "LIBUR"; } else { echo substr($data->fschtime_time_in, 0, 5); } ?></option>
		    <?php } ?>
    	</select>
    	<?php	
	}
	
	//Function membuat array tanggal sesuai range
	function createDateRangeArray($start, $end) 
	{
		$range = array();
		if (is_string($start) === true) $start = strtotime($start);
		if (is_string($end) === true ) $end = strtotime($end);
		if ($start > $end) return createDateRangeArray($end, $start);
		do {
		$range[] = date('Y-m-d', $start);
		$start = strtotime("+ 1 day", $start);
		}
		while($start < $end);
		
		return $range;
	} 
		
	//function untuk menambah atau mengurangi tanggal
	function adddate($vardate,$added)
	{
		$tanggal = new DateTime($vardate);            
		$tanggal->modify("".$added."");
		$hari= $tanggal->format("Y-m-d");
		return $hari;   

		/*
		$data = explode("-", $vardate);
		$date = new DateTime();            
		$date->setDate($data[0], $data[1], $data[2]);
		$date->modify("".$added."");
		$day= $date->format("Y-m-d");
		return $day;    
		*/
	}
		
	//function menghitung jumlah hari
	function hitunghari($datestart,$dateend)
	{
		$sql = "SELECT datediff('$dateend','$datestart') as selisih"; // for count summary date in a month
		$hasil = mysql_query($sql);
		$data = mysql_fetch_array($hasil);
		$jmlhari = $data['selisih']-1 ;
		return $jmlhari;
	}
		
	//function menamai bulan dengan inputan angka
	function namabulan($bulan)
	{
		if($bulan == "1") { $bulan = "JANUARI"; }
		else if($bulan == "2") { $bulan = "FEBRUARI"; }
		else if($bulan == "3") { $bulan = "MARET"; }
		else if($bulan == "4") { $bulan = "APRIL"; }
		else if($bulan == "5") { $bulan = "MEI"; }
		else if($bulan == "6") { $bulan = "JUNI"; }
		else if($bulan == "7") { $bulan = "JULI"; }
		else if($bulan == "8") { $bulan = "AGUSTUS"; }
		else if($bulan == "9") { $bulan = "SEPTEMBER"; }
		else if($bulan == "10") { $bulan = "OKTOBER"; }
		else if($bulan == "11") { $bulan = "NOVEMBER"; }
		else if($bulan == "12") { $bulan = "DESEMBER"; }
		return $bulan;
	}
	
	function angkabulan($bulan)
	{
		if($bulan == "JANUARI") { $bulan = "01"; }
		else if($bulan == "FEBRUARI") { $bulan = "02"; }
		else if($bulan == "MARET") { $bulan = "03"; }
		else if($bulan == "APRIL") { $bulan = "04"; }
		else if($bulan == "MEI") { $bulan = "05"; }
		else if($bulan == "JUNI") { $bulan = "06"; }
		else if($bulan == "JULI") { $bulan = "07"; }
		else if($bulan == "AGUSTUS") { $bulan = "08"; }
		else if($bulan == "SEPTEMBER") { $bulan = "09"; }
		else if($bulan == "OKTOBER") { $bulan = "10"; }
		else if($bulan == "NOVEMBER") { $bulan = "11"; }
		else if($bulan == "DESEMBER") { $bulan = "12"; }
		return $bulan;
	}
	
	//function untuk mengambil nilai 01 dari nilai 1
	function month($month)
	{
		$array = array('1'=>'01', '2'=>'02', '3'=>'03', '4'=>'04', '5'=>'05', '6'=>'06', '7'=>'07', '8'=>'08', '9'=>'09', '10'=>'10', '11'=>'11', '12'=>'12' );
		$newmonth = element($month, $array);
		return $newmonth;
	}
	
	//hitung selisih jam output dalam menit
	function selisihjam($in,$out) 
	{
		list($tgl,$jam_masuk) = explode(" ", $in);
		list($tgl2,$jam_keluar) = explode(" ", $out);
		
		list($h,$m,$s) = explode(":",$jam_masuk);
		$dtAwal = mktime($h,$m,$s,1,1,1);
		
		list($h,$m,$s) = explode(":",$jam_keluar);
		$dtAkhir = mktime($h,$m,$s,1,1,1);
		
		$dtSelisih = $dtAwal-$dtAkhir;
		
		$totalmenit=$dtSelisih/60;
		$jam =explode(".",$totalmenit/60);
		$sisamenit=($totalmenit/60)-$jam[0];
		$sisamenit2=$sisamenit*60;
		$jml_jam=$jam[0];
		$jml_jam = $jml_jam *60;
		$totalmenit = $jml_jam+$sisamenit2;
		return $totalmenit;
	}
	
	function hit_telat_dan_lembur($in, $out, $realin, $realout) 
	{
		$jml_jam_jadwal = selisihjam($in,$out);
		$jml_jam_real = selisihjam($realin,$realout);
			
			if($jml_jam_real >= $jml_jam_jadwal) 
			{ 
			$totallembur = $jml_jam_real - $jml_jam_jadwal;
			$totaltelat = 0;
			} 
			else 
			{
			$totallembur = 0;
			$totaltelat =  selisihjam($in, $realin);
			}
		
		return array($totallembur,$totaltelat);
	}
	
	
	
	
	function terbilang($angka) {
		$angka = (float)$angka; 
		$bilangan = array(
				'',
				'Satu',
				'Dua',
				'Tiga',
				'Empat',
				'Lima',
				'Enam',
				'Tujuh',
				'Delapan',
				'Sembilan',
				'Sepuluh',
				'Sebelas'
		);
	 
		if ($angka < 12) {
			return $bilangan[$angka];
		} else if ($angka < 20) {
			return $bilangan[$angka - 10] . ' belas';
		} else if ($angka < 100) {
			$hasil_bagi = (int)($angka / 10);
			$hasil_mod = $angka % 10;
			return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
		} else if ($angka < 200) {
			return sprintf('seratus %s', $this->terbilang($angka - 100));
		} else if ($angka < 1000) {
			$hasil_bagi = (int)($angka / 100);
			$hasil_mod = $angka % 100;
			return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], $this->terbilang($hasil_mod)));
		} else if ($angka < 2000) {
			return trim(sprintf('seribu %s', $this->terbilang($angka - 1000)));
		} else if ($angka < 1000000) {
			$hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
			$hasil_mod = $angka % 1000;
			return sprintf('%s ribu %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod));
		} else if ($angka < 1000000000) {
			$hasil_bagi = (int)($angka / 1000000);
			$hasil_mod = $angka % 1000000;
			return trim(sprintf('%s juta %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
		} else if ($angka < 1000000000000) {
			$hasil_bagi = (int)($angka / 1000000000);
			$hasil_mod = fmod($angka, 1000000000);
			return trim(sprintf('%s milyar %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
		} else if ($angka < 1000000000000000) {
			$hasil_bagi = $angka / 1000000000000;
			$hasil_mod = fmod($angka, 1000000000000);
			return trim(sprintf('%s triliun %s', $this->terbilang($hasil_bagi), $this->terbilang($hasil_mod)));
		} 
	}
	
	
	##############################
	#TARIK ABSENSI
	##############################
	
	function tarik_absensi_x()
	{	
		#tambahan -> kriteria copy data tampung ke absensi
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		#tarik data dari mesin manual
		//$ip = $this->uri->segment(3, 0);
		$ip_fingerprint = array(
					'0'		=>	'192.168.20.131',
					'1'		=>	'192.168.20.132',
					'2'		=>	'192.168.20.133',
					'3'		=>	'192.168.20.134',
					'4'		=>	'192.168.20.135',
					'5'		=>	'192.168.20.136',
					'6'		=>	'192.168.20.137',
					'7'		=>	'192.168.20.138',
					'8'		=>	'192.168.20.139',
					'9'		=>	'192.168.20.140',
					'10'	=>	'192.168.20.142',
			);
		
		for($i=0;$i<11;$i++){
			$ip = $ip_fingerprint[$i];
			$key = "0";
			
			$Connect = fsockopen($ip, "80", $errno, $errstr, 1);
			
			if($Connect)
			{
				$soap_request="<GetAttLog><ArgComKey xsi:type=\"xsd:integer\">".$key."</ArgComKey><Arg><PIN xsi:type=\"xsd:integer\">All</PIN></Arg></GetAttLog>";
				$newLine="\r\n";
				fputs($Connect, "POST /iWsService HTTP/1.0".$newLine);
				fputs($Connect, "Content-Type: text/xml".$newLine);
				fputs($Connect, "Content-Length: ".strlen($soap_request).$newLine.$newLine);
				fputs($Connect, $soap_request.$newLine);
				$buffer="";
					while($Response=fgets($Connect, 1024))
					{
						$buffer=$buffer.$Response;
					}
				}
			else
			{
				echo 'fail';
			}
			
			$buffer = $this->parse_data($buffer,"<GetAttLogResponse>","</GetAttLogResponse>");
			$buffer = explode("\r\n",$buffer);
			//print_r($buffer);
			echo "<table>";
			echo "<tr>";
			echo "<td>NIPP</td><td>Date</td><td>Status</td><td>Grab</td><td>Verified</td>";
			
			for($a=1;$a<count($buffer);$a++)
			{
				$data = $this->parse_data($buffer[$a],"<Row>","</Row>");
				$pin = $this->parse_data($data,"<PIN>","</PIN>");
				$datetime = $this->parse_data($data,"<DateTime>","</DateTime>");
				$status = $this->parse_data($data,"<Status>","</Status>");
				$verified = $this->parse_data($data,"<Verified>","</Verified>");
							
				#masukkan data dari mesin ke database tampung / backup
				
				
				$cek = $this->m_absensi->cek_data_backup_mesin($pin,$datetime,$status);
				if($cek > 0){ 
					$grab = 0;
				} else {
					$grab = 1;
				}
				$this->m_absensi->input_data_backup_mesin($pin,$datetime,$status,$grab);
				
				
				echo "<tr><td>" . $pin . "</td><td>" . $datetime . "</td><td>" . $status . "</td><td>". $grab ."</td><td>" . $verified . "</td></tr>";
			}
			
			echo "</tr>";
			echo "</table>";
			echo "<br>";
		};
		
		# hapus null nipp dari table
		$this->m_absensi->copy_dbmesin_to_datatampung();
		
		$this->copy_data_tampung_to_absensi();
	}
	
	public function copy_data_tampung_to_absensi()
	{
		$backup = $this->m_absensi->get_data_tampung();
		if($backup !== 0){
			foreach ($backup as $row){
				$year 		= substr($row['dt_datetime'],0,4);
				$nipp		= $row['dt_nipp'];
				$datetime	= $row['dt_datetime'];
				$status		= $row['dt_status'];
				
				if(($status == 1) OR ($status == 2) OR ($status == 3))
				{
					$hariini = date('Y-m-d', strtotime($datetime));
					$cek = $this->m_absensi->cek_date_null_tabel_absensi($nipp,$hariini,$status);
					if($cek == 0){
						$kemarin = date('Y-m-d', strtotime($datetime) - (24*60*60));
						$cek = $this->m_absensi->cek_date_null_tabel_absensi($nipp,$kemarin,$status);
					}

					if($status==1)
					{
						$subjek == "fschpegabs_real_time_out";
					} else if($status==2)
					{
						$subjek == "fschpegabs_real_break_in";
					} else if($status==3)
					{
						$subjek == "fschpegabs_real_break_out";
					} 
					
					foreach ($cek as $row_cek){
						$year	= substr($row_cek['fschpegabs_sch_time_in'],0,4);
						$nipp	= $row_cek['peg_nipp'];
						$id 	= $row_cek['fschpegabs_id']; //tanggal sebagai patokan row yg akan diupdate
					}
					
				} else if($status == 0)
				{
					$subjek = 'fschpegabs_real_break_out';
					$dataget = $this->m_absensi->ambil_data_absensi_by_time_in($year,$nipp,$datetime);
					foreach ($dataget as $row_data){}
					$id = $row_data['fschpegabs_id'];
				}
				$data = array(
						$subjek	=> $datetime,
					);
				$this->m_absensi->update_absensi_pegawai($data,$id,$year);
			}
			$this->m_absensi->truncate_data_tampung(); // mengosongkan tabel datatampung  dengan menyisakan 1 data terakhir sebagai kondisi selanjutnya 
		}
	}
	
	/*
	public function copy_data_tampung_to_absensi()
	{
		$backup = $this->m_absensi->get_data_tampung();
		if($backup !== 0){
		$nipp_sblm ="";
		$status_sblm ="";
			foreach ($backup as $row){
				// tambahkan seleksi $row['dt_status'] dengan $row['dt_status'] sebelumnya, jika bernilai sama maka masuk ke besok, jika 0(kemarin)-1(hr ini) update absensi tgl keluar di tgl kemarin 
				# if ($nipp_sblm == $row['dt_nipp'] ){}
				
				$year 		= substr($row['dt_datetime'],0,4);
				$nipp		= $row['dt_nipp'];
				$datetime	= $row['dt_datetime'];
				$status		= $row['dt_status'];
				$dup 		= $this->m_absensi->cek_dup_tabel_absensi($nipp,$datetime,$status);
				foreach ($dup as $row_dup)
				{
					$this->m_absensi->cek_selisih_absen_terdekat($datetime,$nipp,$status,$row_dup,$year);
				}
				# $nipp_sblm = $row['dt_nipp'];
				# $status_sblm = $row['dt_status']; 
			}
			$this->m_absensi->truncate_data_tampung(); // mengosongkan tabel datatampung  dengan menyisakan 1 data terakhir sebagai kondisi selanjutnya 
		}
	}
	*/
	
	

	/*public function copy_data_tampung_to_absensi($tanggal)
	{
		$backup = $this->m_absensi->get_data_tampung($tanggal);
		foreach ($backup as $row){
			$year 		=substr($row['dbmesin_datetime'],0,4);
			$nipp		=$row['dbmesin_nipp'];
			$datetime	=$row['dbmesin_datetime'];
			$status		=$row['dbmesin_status'];
			$dup = $this->m_absensi->cek_dup_tabel_absensi($nipp,$datetime,$status);
			foreach ($dup as $row_dup)
			{
				$this->m_absensi->cek_selisih_absen_terdekat($datetime,$nipp,$status,$row_dup,$year);
			}
		}
	}
	*/
	/*
	public function copy_data_tampung_to_absensi()
	{
		//echo "test";
		//echo $tanggal;
		$tanggal = '2013-04-29';
		$backup = $this->m_absensi->get_data_backup_mesin($tanggal);
		//print_r($backup);
		foreach ($backup as $row){
			$year 		=substr($row['dbmesin_datetime'],0,4);
			$nipp		=$row['dbmesin_nipp'];
			$datetime	=$row['dbmesin_datetime'];
			$status		=$row['dbmesin_status'];
			$dup = $this->m_absensi->cek_dup_tabel_absensi($nipp,$datetime,$status);
			//echo "$year $nipp $datetime $status ----";
			echo $nipp."  -  ";
			print_r($dup);
		
			foreach ($dup as $row_dup)
			{
				ECHO "TEST <BR>";
				$selisih = 0;
				$selisihbreak = 0;
				if($status == 1){
					if ($row_dup['fschpegabs_real_time_out'] == "0000-00-00 00:00:00"){
						$data =	array(
									'fschpegabs_real_time_out' => $datetime,
									'fschpegabs_update_by' => 'admin',
							);	
					}
					else
					{
						if(strtotime($row_dup['fschpegabs_real_time_out']) > strtotime($datetime)){
							$selisih = strtotime($row_dup['fschpegabs_real_time_out']) - strtotime($datetime);
						} else {
							$selisih = strtotime($datetime) - strtotime($row_dup['fschpegabs_real_time_out']);
						}
						// menentukan apakah merupakan breakout atau tidak
						if ($selisih > 3600){
							if( strtotime($row_dup['fschpegabs_break_out']) > strtotime($datetime))
							{ $selisihbreak = strtotime($row_dup['fschpegabs_break_out']) - strtotime($datetime);}						 
							else
							{ $selisihbreak = strtotime($datetime) - strtotime($row_dup['fschpegabs_break_out']);}						 
						}
						if($selisih < $selisihbreak){
							$data =	array(
									'fschpegabs_real_time_out' => $datetime,
									'fschpegabs_update_by' => 'admin',
							);
						}else{
							$data = array(
									'fschpegabs_real_break_out' => $datetime,
									'fschpegabs_update_by' => 'admin',
							);
						}
					}
				
				} else {
					if ($row_dup['fschpegabs_real_time_in'] == "0000-00-00 00:00:00"){
						$data =	array(
									'fschpegabs_real_time_in' => $datetime,
									'fschpegabs_update_by' => 'admin',
							);	
					} else {
						if(strtotime($row_dup['fschpegabs_real_time_in']) > strtotime($datetime)){
							$selisih = strtotime($row_dup['fschpegabs_real_time_in']) - strtotime($datetime);
						} else {
							$selisih = strtotime($datetime) - strtotime($row_dup['fschpegabs_real_time_in']);
						}
						// menentukan apakah merupakan breakin atau tidak
						if ($selisih > 3600){
							if( strtotime($row_dup['fschpegabs_real_break_in']) > strtotime($datetime))
							{ $selisihbreak = strtotime($row_dup['fschpegabs_real_break_in']) - strtotime($datetime);}						 
							else
							{ $selisihbreak = strtotime($datetime) - strtotime($row_dup['fschpegabs_real_break_in']);}						 
						}
						if($selisih < $selisihbreak){
							$data =	array(
									'fschpegabs_real_time_in' => $datetime,
									'fschpegabs_update_by' => 'admin',
							);
						}else{
							$data = array(
									'fschpegabs_real_break_in' => $datetime,
									'fschpegabs_update_by' => 'admin',
							);
						}
					}
				}
				$this->m_absensi->update_absensi_pegawai($data,$row_dup['fschpegabs_id'],$year);
			}
		}
	}
	*/
	

	
}


?>