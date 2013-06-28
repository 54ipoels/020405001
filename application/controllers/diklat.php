<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class diklat extends Application {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('diklat/pendidikan');
		$this->load->model('kepegawaian/kepegawaian');
		$this->load->library('table');
		$this->load->library('form_validation');  
		$this->ag_auth->restrict('user');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//pagination config
		$config['base_url'] = base_url().'index.php/diklat/index/'; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->countPegawai(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['pegawai'] = $this->pendidikan->get_data_pegawai_with_unit($config['per_page'],$page);
		$data['page'] = 'Pegawai';
		$data['page_diklat'] = 'yes';
		#calling view
		$this->load->view('diklat/index',$data);
	}
	
	public function add_new_stkp($nipp)
	{
		$data['pegawai'] = $this->pendidikan->get_data_pegawai_by_nipp($nipp);
		$data['list_stkp'] = $this->pendidikan->get_list_stkp();
		$data['page'] = 'Add STKP';
		$data['page_diklat'] = 'yes';
		#calling view
		$this->load->view('diklat/index',$data);
	}
	
	public function add_data_stkp($nipp)
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		if ($this->input->post('pelaksanaan')=="00-00-0000"){$pelaksanaan="0000-00-00";}
		else {$pelaksanaan = mdate($datestring, strtotime($this->input->post('pelaksanaan')));}
		if ($this->input->post('selesai')=="00-00-0000"){$selesai="0000-00-00";}
		else {$selesai = mdate($datestring, strtotime($this->input->post('selesai')));}
		if ($this->input->post('validitas_awal')=="00-00-0000"){$validitas_awal="0000-00-00";}
		else {$validitas_awal = mdate($datestring, strtotime($this->input->post('validitas_awal')));}
		if ($this->input->post('validitas_akhir')=="00-00-0000"){$validitas_akhir="0000-00-00";}
		else {$validitas_akhir = mdate($datestring, strtotime($this->input->post('validitas_akhir')));}
		
		$data_stkp = array(
				'p_stkp_nipp' 			=> $nipp,
				'p_stkp_type' 			=> $this->input->post('type'),
				'p_stkp_jenis' 			=> $this->input->post('stkp'),
				'p_stkp_lembaga'		=> $this->input->post('lembaga'),
				'p_stkp_no_license'		=> $this->input->post('license'),
				'p_stkp_pelaksanaan'	=> $pelaksanaan,
				'p_stkp_selesai'		=> $selesai,
				'p_stkp_mulai'			=> $validitas_awal,
				'p_stkp_finish'			=> $validitas_akhir,
				'p_stkp_rating'			=> $this->input->post('rating'),
				'p_stkp_update_on'		=> $tanggal,
				'p_stkp_update_by'		=> 'admin'
			);
		
		
		#input data to table pegawai
		$this->pendidikan->insert_data_stkp($data_stkp);
		
		redirect('diklat/');
	}
	
	public function get_stkp()
	{
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
		 
		#pagination config
		$config['base_url'] = base_url().'index.php/diklat/get_stkp/'; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->countSTKP(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$config['num_links'] = 5;
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['list_stkp'] = $this->pendidikan->get_list_stkp();
		$data['list_unit'] = $this->pendidikan->get_list_unit();
		$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->get_data_stkp_with_unit_and_name($config['per_page'],$page);
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		$data['page'] = 'Report STKP';
		$data['page_diklat'] = 'yes';
		$data['view_stkp'] = 'class="this"';
		
		$this->load->view('diklat/index',$data);
	}
	
	public function get_non_stkp()
	{
		#pagination config
		$config['base_url'] = base_url().'index.php/diklat/get_non_stkp/'; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->countNon_STKP(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['list_unit'] = $this->pendidikan->get_list_unit();
		$data['list_sub_unit'] = $this->kepegawaian->get_list_sub_unit();
		$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->get_data_nstkp_with_unit_and_name($config['per_page'],$page);
		$data['page'] = 'Report Non STKP';
		$data['view_input_nstkp'] = 'class="this"';
		$data['page_diklat'] = 'yes';
		$data['view_nstkp'] = 'class="this"';
		
		$this->load->view('diklat/index',$data);
	}
	
	public function sort_stkp()
	{
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
		if ($this->input->post('jenis_stkp')== NULL)
		{
			$jenis = $this->uri->segment(3);
		}else{
			$jenis = $this->input->post('jenis_stkp');
		}
				
		if ($this->input->post('stkp')== NULL)
		{
			$stkp = $this->uri->segment(4);
		}else{
			$stkp = $this->input->post('stkp');
		}
		
		if (($this->input->post('unit')== NULL))
		{
			$unit = str_replace('%20',' ',$this->uri->segment(5));
		}else{
			$unit = $this->input->post('unit');
		}
		
		if ($jenis == 'ALL')
		{
			$jenis = '%';
		}
		
		if ($unit == 'ALL')
		{
			$unit = '%';
		}
		
		if ($stkp == 'ALL')
		{
			$stkp = '%';
		}
		
		if ($jenis == '%')
		{
			$jenis_search = 'ALL';
		}else{
			$jenis_search = $jenis;
		}
		
		if ($unit == '%')
		{
			$unit_search = 'ALL';
		}else{
			$unit_search = $unit;
		}
		
		if ($stkp == '%')
		{
			$stkp_search = 'ALL';
		}else{
			$stkp_search = $stkp;
		}
		
		#pagination config
		$config['base_url'] = base_url().'index.php/diklat/sort_stkp/'.$jenis_search.'/'.$stkp_search.'/'.$unit_search; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->countSTKP_Unit($jenis, $stkp, $unit); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 6; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(6)) ? $this->uri->segment(6) : 0;
		
		$data['list_stkp'] = $this->pendidikan->get_list_stkp();
		$data['list_unit'] = $this->pendidikan->get_list_unit();
		$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->search_data_stkp_with_unit_and_name($config['per_page'],$page, $jenis, $stkp, $unit);
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		$data['jenis_search'] = $jenis_search;
		
		$data['page'] = 'Report STKP';
		$data['page_diklat'] = 'yes';
		$data['view_stkp'] = 'class="this"';
				
		$this->load->view('diklat/index',$data);
	}
	
	public function sort_non_stkp()
	{
		/*
		if ($this->input->post('license')== NULL)
		{
			$stkp = '%'.str_replace('%20',' ',$this->uri->segment(3)).'%';
		}else{
			$stkp = '%'.$this->input->post('license').'%';
		}
		
		if (($this->input->post('unit')== NULL))
		{
			$unit = str_replace('%20',' ',$this->uri->segment(4));
		}else{
			$unit = $this->input->post('unit');
		}
		
		if ($unit == 'ALL')
		{
			$unit = '%';
		}
		
		if ($stkp == 'ALL' or $stkp == '%ALL%')
		{
			$stkp = '%';
		}
		
		if ($unit == '%')
		{
			$unit_search = 'ALL';
		}else{
			$unit_search = $unit;
		}
		
		if ($stkp == '%' OR $stkp == '%%')
		{
			$stkp_search = 'ALL';
		}else{
			if ($this->input->post('license')== NULL)
			{
				$stkp_search = str_replace('%20',' ',$this->uri->segment(3));
			}else{
				$stkp_search = $this->input->post('license');
			}
		}
		*/
		
		if (($this->input->post('unit')== NULL))
		{
			$unit = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$unit = $this->input->post('unit');
		}
		if (($this->input->post('sub_unit')== NULL))
		{
			$sub_unit = str_replace('%20',' ',$this->uri->segment(4));
		}else{
			$sub_unit = $this->input->post('sub_unit');
		}
		
		
		#pagination config
		//$config['base_url'] = base_url().'index.php/diklat/sort_non_stkp/'.$stkp_search.'/'.$unit_search; //set the base url for pagination
		$config['base_url'] = base_url().'index.php/diklat/sort_non_stkp/'.$unit.'/'.$sub_unit; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->count_non_STKP_Unit($unit,$sub_unit); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 5; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$data['view_nstkp'] = 'class="this"';
		$data['list_unit'] = $this->pendidikan->get_list_unit();
		$data['list_sub_unit'] = $this->kepegawaian->get_list_sub_unit();
		//$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->search_data_nstkp_with_unit_and_name($config['per_page'],$page, $stkp, $unit);
		$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->search_data_nstkp_with_unit_and_name($config['per_page'],$page,$unit,$sub_unit);		
		$data['page'] = 'Report Non STKP';
		$data['page_diklat'] = 'yes';
		
		//print_r($config);
		$this->load->view('diklat/index',$data);
	}
	
	public function search_pegawai()
	{
		if ($this->input->post('search') == NULL )
		{
			$search_data = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$search_data = $this->input->post('search');
		}
				
		
		$search = '%'.$search_data.'%';
		#pagination config
		$config['base_url'] = base_url().'index.php/diklat/search_pegawai/'.$search_data.'/'; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->count_search_Pegawai($search); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$data['pegawai'] = $this->pendidikan->search_data_pegawai($config['per_page'], $page, $search);
		$data['list_unit'] = $this->pendidikan->get_list_unit();
		$data['page'] = 'Search Result';
		$data['page_diklat'] = 'yes';
		
		//print_r($data);
		//print_r($search);
		#calling view
		$this->load->view('diklat/index', $data);
	}
	
	function report_bulanan()
	{
		$monthstring = '%M';
		if (($this->uri->segment(3) == 'part_one') || ($this->uri->segment(3) == NULL))
		{
			$data['page'] = 'Report Training Bulanan';
			$data['view_report_bulanan'] = 'class="this"';
			$data['page_diklat'] = 'yes';
			$this->load->view('diklat/index', $data);
		} else
		if ($this->uri->segment(3) == 'part_two')
		{
			$data['view_report_bulanan'] = 'class="this"';
			$data['page_diklat'] = 'yes';
			if ($this->input->post('jenis') == 'STKP')
			{
				$data['page'] = 'Report STKP Bulanan';
				$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->search_report_stkp_bulanan($this->input->post('bulan'), $this->input->post('tahun'), $this->input->post('jenis_stkp'));
				$data['bulan'] = $this->input->post('bulan');
				$data['year'] = $this->input->post('tahun');
				//$data['rating'] = $this->input->post('rating');
				$data['jenis_stkp'] = $this->input->post('jenis_stkp');
				$this->load->view('diklat/index', $data);
			} else
			if ($this->input->post('jenis') == 'NSTKP')
			{
				$data['page'] = 'Report NSTKP Bulanan';
				$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->search_report_nstkp_bulanan($this->input->post('bulan'), $this->input->post('tahun'), $this->input->post('jenis_stkp'));
				$data['bulan'] = $this->input->post('bulan');
				$data['year'] = $this->input->post('tahun');
				//$data['rating'] = $this->input->post('rating');
				$data['training'] = $this->input->post('jenis_stkp');
				$data['url_training']= $this->pendidikan->myUrlEncode($data['training']);
				$this->load->view('diklat/index', $data);
			}
		}
	}
	
	
	
	public function input_stkp_bulanan()
	{
		if ($this->uri->segment(3) === 'part_one' )
		{
			$data['page'] = 'STKP Bulanan';
			$data['view_input_stkp'] = 'class="this"';
			$data['page_diklat'] = 'yes';
			$this->load->view('diklat/index', $data);
		} else 
		if ($this->uri->segment(3) === 'part_two' )
		{
			$data['page'] = 'STKP Bulanan Next';
			$data['STKP'] = $this->input->post('stkp');
			$data['rating'] = $this->input->post('rating');
			$data['jumlah'] = $this->input->post('jumlah');
			$data['tanggal_start'] = $this->input->post('tanggal_start');
			$data['tanggal_end'] = $this->input->post('tanggal_end');
			$data['license'] = $this->input->post('license');
			$data['lp'] = $this->input->post('lp');
			$data['instruktur'] = $this->input->post('instruktur');
			$data['instruktur_from'] = $this->input->post('instruktur_from');
			$data['view_input_stkp'] = 'class="this"';
			$data['page_diklat'] = 'yes';
			
			$this->load->view('diklat/index', $data);
		}
	}
	
	public function input_nilai_stkp()
	{
		$stkp = $this->input->post('stkp');
		$jumlah = $this->input->post('jumlah');
		$tanggal_start = $this->input->post('tanggal_start');
		$tanggal_end = $this->input->post('tanggal_end');
		
		$datestring = "%Y-%m-%d" ;
		$time = time();
				
		//print_r((str_replace('/','-',$tanggal_stkp)));
		//print_r(mdate($datestring, strtotime(str_replace('/','-',$tanggal_stkp))));
		if ($this->input->post('license') == 'yes')
		{
			$this->pendidikan->input_nilai_stkp($stkp, $jumlah, $tanggal_start, $tanggal_end, username());
		} else {
			$this->pendidikan->input_nilai_nstkp($stkp, $jumlah, $tanggal_start, $tanggal_end, username());
		}
		redirect('diklat/input_stkp_bulanan/part_one');
	}
	
	function edit_non_stkp($id)
	{
		$data['nstkp'] = $this->pendidikan->get_nilai_non_stkp($id);
		
		$data['page'] = 'Edit non STKP';
		$data['page_diklat'] = 'yes';
		$this->load->view('diklat/index', $data);
	}
	
	function update_non_stkp($id)
	{
		#preparing date 
		$update_on = date('YmdHis');
		
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
				
		if ($this->input->post('tanggal_start')=="00/00/0000"){$tanggal_start="0000-00-00";}
		else {$tanggal_start = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('tanggal_start')))));}
		if ($this->input->post('tanggal_end')=="00/00/0000"){$tanggal_end="0000-00-00";}
		else {$tanggal_end = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('tanggal_end')))));}
		
		$no_sertifikat = str_replace('/','',$this->input->post('license'));
		$no_sertifikat = str_replace('.','-',$no_sertifikat);
		
		//upload file
		
		if($_FILES["file"]["size"] > 0){
			$tmpName = $_FILES["file"]['tmp_name'];         
			$fp = fopen($tmpName, 'r');
			$file = fread($fp, filesize($tmpName));
			$file = addslashes($file);
			fclose($fp);
		}
		
		//Check if the file exists in the form
		
		if($_FILES['file']['name']!=""){
			$str=$_FILES['file']['name'];
			$ext=explode('.',$str);
			
			$config['upload_path'] = './pegawai/diklat/';
			$config['allowed_types'] = 'pdf|gif|jpg|png';
			$config['max_size']  = '9999';
			$config['overwrite']	=	TRUE;
			$filenamebantu = str_replace(' ','_',$no_sertifikat)."-$id-".$update_on.".".$ext[1];
			$config['file_name']=$filenamebantu;
			
			//$this->load->library('upload', $config);
			//$data = array('upload_data' => $this->upload->data());
			
			//Initialize
			$this->load->library('upload');
			$this->upload->initialize($config);
			//Upload file
			if( ! $this->upload->do_upload("file")){
				echo $this->upload->display_errors();
			} else {
			//If the upload success
				$file_name = $this->upload->file_name;
			
			//persiapan data yang akan diupdate
			$data_non_stkp = array(
					'p_nstkp_type' 			=> $this->input->post('type'),
					'p_nstkp_jenis' 		=> $this->input->post('non_stkp'),
					'p_nstkp_lembaga'		=> $this->input->post('lembaga'),
					'p_nstkp_no_license'	=> $this->input->post('license'),
					'p_nstkp_pelaksanaan'	=> $tanggal_start,
					'p_nstkp_selesai'		=> $tanggal_end,
					'p_nstkp_image'			=> $filenamebantu,
					'p_nstkp_instruktur'	=> $this->input->post('instruktur'),
					'p_nstkp_instruktur_from' => $this->input->post('instruktur_from'),
					'p_nstkp_update_by'		=> username(),
				);
			}
		} else {
			$data_non_stkp = array(
					'p_nstkp_type' 			=> $this->input->post('type'),
					'p_nstkp_jenis' 		=> $this->input->post('non_stkp'),
					'p_nstkp_lembaga'		=> $this->input->post('lembaga'),
					'p_nstkp_no_license'	=> $this->input->post('license'),
					'p_nstkp_pelaksanaan'	=> $tanggal_start,
					'p_nstkp_selesai'		=> $tanggal_end,
					'p_nstkp_instruktur'	=> $this->input->post('instruktur'),
					'p_nstkp_instruktur_from' => $this->input->post('instruktur_from'),
					'p_nstkp_update_by'		=> username(),
				);
		}
		$this->pendidikan->update_data_non_stkp($id,$data_non_stkp);
		redirect('diklat/get_non_stkp');
	
	}
	
	function edit_stkp($id)
	{
		$data['stkp'] = $this->pendidikan->get_nilai_stkp($id);
		$data['list_stkp'] = $this->pendidikan->get_list_stkp();
		
		$data['page'] = 'Edit STKP';
		$data['page_diklat'] = 'yes';
		$this->load->view('diklat/index', $data);
	}
	
	function update_stkp($id)
	{
		#preparing date 
		$update_on = date('YmdHis');
		
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		 
		if ($this->input->post('pelaksanaan')=="00/00/0000"){$pelaksanaan="0000-00-00";}
		else {$pelaksanaan = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('pelaksanaan')))));}
		if ($this->input->post('selesai')=="00/00/0000"){$selesai="0000-00-00";}
		else {$selesai = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('selesai')))));}
		if ($this->input->post('validitas_awal')=="00/00/0000"){$validitas_awal="0000-00-00";}
		else {$validitas_awal = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('validitas_awal')))));}
		if ($this->input->post('validitas_akhir')=="00/00/0000"){$validitas_akhir="0000-00-00";}
		else {$validitas_akhir = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('validitas_akhir')))));}
		
		$no_sertifikat = str_replace('/','',$this->input->post('license'));
		$no_sertifikat = str_replace('.','-',$no_sertifikat);
		
		//upload file
		
		if($_FILES["file"]["size"] > 0){
			$tmpName = $_FILES["file"]['tmp_name'];         
			$fp = fopen($tmpName, 'r');
			$file = fread($fp, filesize($tmpName));
			$file = addslashes($file);
			fclose($fp);
		}
		
		//Check if the file exists in the form
		
		if($_FILES['file']['name']!=""){
			$str=$_FILES['file']['name'];
			$ext=explode('.',$str);
			
			$config['upload_path'] = './pegawai/diklat/';
			$config['allowed_types'] = 'pdf|gif|jpg|png';
			$config['max_size']  = '9999';
			$config['overwrite']	=	TRUE;
			if($this->input->post('rating') == "FWM" ){
				$filenamebantu = trim($no_sertifikat)."-".$id."-".$update_on."FWM.".$ext[1];
			}else{
				$filenamebantu = trim($no_sertifikat)."-".$id."-".$update_on.".".$ext[1];
			}
			$config['file_name']=$filenamebantu;
			
			//$this->load->library('upload', $config);
			//$data = array('upload_data' => $this->upload->data());
			
			//Initialize
			$this->load->library('upload');
			$this->upload->initialize($config);
			//Upload file
			if( ! $this->upload->do_upload("file")){
				//echo the errors
				echo $this->upload->display_errors();
			} else {
				//If the upload success
				$file_name = $this->upload->file_name;
				
				//persiapan data yang akan diupdate
				$data_stkp = array(
						//'p_nstkp_nipp' 			=> $this->input->post('nipp'),
						'p_stkp_type' 			=> $this->input->post('type'),
						'p_stkp_jenis' 			=> $this->input->post('jenis_stkp'),
						'p_stkp_lembaga'		=> $this->input->post('lembaga'),
						'p_stkp_no_license'		=> $this->input->post('license'),
						'p_stkp_pelaksanaan'	=> $pelaksanaan,
						'p_stkp_selesai'		=> $selesai,
						'p_stkp_mulai'			=> $validitas_awal,
						'p_stkp_finish'			=> $validitas_akhir,
						'p_stkp_rating'			=> $this->input->post('rating'),
						'p_stkp_image'			=> $filenamebantu,
						'p_stkp_instruktur'		=> $this->input->post('instruktur'),
						'p_stkp_instruktur_from'=> $this->input->post('instruktur_from'),
						//'p_stkp_update_on'		=> $tanggal,
						'p_stkp_update_by'		=> username(),
					);
				$this->pendidikan->update_data_stkp($id,$data_stkp);
				//update data stkp image yang memiliki no sertifikat yang sama
				$this->pendidikan->update_image_no_sertifikat_data_stkp( $filenamebantu, $this->input->post('license'), $this->input->post('rating') );
				//redirect('diklat/view_pdf/'.$filenamebantu);
				redirect('diklat/get_stkp');
			}
		} else {
			$data_stkp = array(
					//'p_nstkp_nipp' 			=> $this->input->post('nipp'),
					'p_stkp_type' 			=> $this->input->post('type'),
					'p_stkp_jenis' 			=> $this->input->post('jenis_stkp'),
					'p_stkp_lembaga'		=> $this->input->post('lembaga'),
					'p_stkp_no_license'		=> $this->input->post('license'),
					'p_stkp_pelaksanaan'	=> $pelaksanaan,
					'p_stkp_selesai'		=> $selesai,
					'p_stkp_mulai'			=> $validitas_awal,
					'p_stkp_finish'			=> $validitas_akhir,
					'p_stkp_rating'			=> $this->input->post('rating'),
					'p_stkp_instruktur'		=> $this->input->post('instruktur'),
					'p_stkp_instruktur_from'=> $this->input->post('instruktur_from'),
					'p_stkp_update_by'		=> username(),
				);
			$this->pendidikan->update_data_stkp($id,$data_stkp);
			redirect('diklat/get_stkp');
		}
	}
	
	function view_pdf($nama_file){
		?>
		<html>
		<title><?php echo $nama_file;?></title>
		<head>
			<script>
				function goBack()
				{
					window.history.go(-2);
				}
			</script>
		</head>
		<body align="center">
		<?php
		$file = base_url()."pegawai/diklat/".$nama_file;
		echo "<embed src= '".$file."' width='1200' height='666' ></embed>";
		?>
		<br><br>
		<!-- <input type="button" value="Back" onclick="goBack()"> -->
		</body>
		</html>
		<?php 
	}
	
	function remove_file_stkp($id){
		$this->pendidikan->remove_link_file_stkp($id);
		redirect('diklat/get_stkp');
	}
	
	function remove_file_non_stkp($id){
		$this->pendidikan->remove_link_file_non_stkp($id);
		redirect('diklat/get_non_stkp');
	}
	
	function delete_non_stkp($id)
	{
		#update data to table pegawai
		$this->pendidikan->delete_data_non_stkp($id);
		redirect('diklat/get_non_stkp');
	}
	
	function delete_stkp($id)
	{
		#update data to table pegawai
		$this->pendidikan->delete_data_stkp($id);
		redirect('diklat/get_stkp');
	}
	
	function get_stkp_selection()
	{ 
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
		
		$type = $this->uri->segment(3);
		$select = str_replace("%20"," ",$this->uri->segment(4));
		
		#pagination config
		$config['base_url'] = base_url().'index.php/diklat/get_stkp_selection/'.$type.'/'.$select; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->countSTKPselection($type,$select); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 5; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$data['list_stkp'] = $this->pendidikan->get_list_stkp();
		$data['list_unit'] = $this->pendidikan->get_list_unit();
		$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->get_data_stkp_with_unit_and_name_selection($config['per_page'],$page,$type,$select);
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		$data['page'] = 'Report STKP';
		$data['page_diklat'] = 'yes';
		$data['view_stkp'] = 'class="this"';
		
		$this->load->view('diklat/index',$data);
		
	}
	
	function get_nstkp_selection()
	{ 
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
		
		$type = $this->uri->segment(3);
		$select = str_replace("%20"," ",$this->uri->segment(4));
		
		#pagination config
		$config['base_url'] = base_url().'index.php/diklat/get_nstkp_selection/'.$type.'/'.$select; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->countNon_STKPselection($type,$select); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 5; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$data['list_stkp'] = $this->pendidikan->get_list_stkp();
		$data['list_unit'] = $this->pendidikan->get_list_unit();
		$data['list_sub_unit'] = $this->kepegawaian->get_list_sub_unit();
		$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->get_data_nstkp_with_unit_and_name_selection($config['per_page'],$page,$type,$select);
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		$data['page'] = 'Report Non STKP';
		$data['page_diklat'] = 'yes';
		$data['view_nstkp'] = 'class="this"';
		
		$this->load->view('diklat/index',$data);
	}
	
	function search_stkp()
	{
		if ($this->input->post('search') == NULL )
		{
			$search_data = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$search_data = $this->input->post('search');
		}
		
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
		
		#pagination config
		$config['base_url'] = base_url().'index.php/diklat/search_stkp/'.$search_data.'/'; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->count_search_stkp($search_data); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		
		$data['list_stkp'] = $this->pendidikan->get_list_stkp();
		$data['list_unit'] = $this->pendidikan->get_list_unit();
		$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->search_stkp($config['per_page'],$page,$search_data);
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		$data['page'] = 'Report STKP';
		$data['page_diklat'] = 'yes';
		$data['view_stkp'] = 'class="this"';
		
		
		//print_r($data);
		//print_r($search);
		#calling view
		$this->load->view('diklat/index', $data);
	}
	
	
	function search_nstkp()
	{ 
		if ($this->input->post('search') == NULL )
		{
			$search_data_link = str_replace('%20',' ',$this->uri->segment(3));
			$search_data = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$search_data_link = $this->input->post('search');
			$search_data = $this->input->post('search');
		}
		$search_data_link = str_replace('/','_',$search_data_link);
		$search_data = str_replace('/','_',$search_data);
		
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
			
		#pagination config
		$config['base_url'] = base_url().'index.php/diklat/search_nstkp/'.$search_data_link; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->count_search_nstkp($search_data); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$data['list_stkp'] = $this->pendidikan->get_list_stkp();
		$data['list_unit'] = $this->pendidikan->get_list_unit();
		$data['list_sub_unit'] = $this->kepegawaian->get_list_sub_unit();
		$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->search_nstkp($config['per_page'],$page,$search_data);
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		$data['page'] = 'Report Non STKP';
		$data['page_diklat'] = 'yes';
		$data['view_nstkp'] = 'class="this"';
		
		$this->load->view('diklat/index',$data);
	}
	
/*
	function search_nstkp()
	{ 
		if ($this->input->post('jenis_stkp') == NULL )
		{
			$search_jenis = str_replace('%20',' ',$this->uri->segment(3));
			$search_data_link = str_replace('%20',' ',$this->uri->segment(4));
			$search_data = str_replace('%20',' ',$this->uri->segment(4));
			echo "1 $search_jenis";
		}else{
			$search_jenis = $this->input->post('jenis_stkp');
			$search_data_link = $this->input->post('search');
			$search_data = $this->input->post('search');
			echo "2 $search_jenis";
		}
		
		$search_data_link = str_replace('/','_',$search_data_link);
		$search_data = str_replace('/','_',$search_data);
		
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
			
		#pagination config
		$config['base_url'] = base_url().'index.php/diklat/search_nstkp/'.$search_jenis.'/'.$search_data_link.'/'; //set the base url for pagination
		$config['total_rows'] = $this->pendidikan->count_search_nstkp($search_data,$search_jenis); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 5; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$data['list_stkp'] = $this->pendidikan->get_list_stkp();
		$data['list_unit'] = $this->pendidikan->get_list_unit();
		$data['pegawai_with_stkp_and_unit'] = $this->pendidikan->search_nstkp($config['per_page'],$page,$search_data,$search_jenis);
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		$data['page'] = 'Report Non STKP';
		$data['page_diklat'] = 'yes';
		$data['view_nstkp'] = 'class="this"';
		
		$this->load->view('diklat/index',$data);
	}
*/
	
	
	
	function detail_kompetensi($nipp)
	{
		
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		$data['data_agama'] = $this->kepegawaian->get_detail_pegawai_agama($nipp);
		$data['data_alamat'] = $this->kepegawaian->get_detail_pegawai_alamat($nipp);
		$data['data_ayah'] = $this->kepegawaian->get_detail_pegawai_ayah($nipp);
		$data['data_bahasa'] = $this->kepegawaian->get_detail_pegawai_bahasa($nipp);
		$data['data_fisik'] = $this->kepegawaian->get_detail_pegawai_fisik($nipp);
		$data['data_ibu'] = $this->kepegawaian->get_detail_pegawai_ibu($nipp);
		$data['data_jabatan_tmt'] = $this->kepegawaian->get_detail_pegawai_jabatan_tmt($nipp);
		$data['data_mert_ayah'] = $this->kepegawaian->get_detail_pegawai_mert_ayah($nipp);
		$data['data_mert_ibu'] = $this->kepegawaian->get_detail_pegawai_mert_ibu($nipp);
		$data['data_pasangan'] = $this->kepegawaian->get_detail_pegawai_pasangan($nipp);
		$data['data_pendidikan'] = $this->kepegawaian->get_detail_pegawai_pendidikan($nipp);
		$data['data_status_keluarga'] = $this->kepegawaian->get_detail_pegawai_status_keluarga($nipp);
		$data['data_tmt'] = $this->kepegawaian->get_detail_pegawai_tmt($nipp);
		$data['data_unit'] = $this->kepegawaian->get_detail_pegawai_unit($nipp);
		$data['data_grade'] = $this->kepegawaian->get_detail_pegawai_grade($nipp);
		$data['data_stkp'] = $this->kepegawaian->get_detail_pegawai_stkp($nipp);		
		$data['data_nstkp'] = $this->kepegawaian->get_detail_pegawai_nstkp($nipp);
		$data['data_anak'] = $this->kepegawaian->get_detail_pegawai_anak($nipp);
		$data['data_jabatan'] = $this->kepegawaian->get_last_jabatan($nipp);
		$data['jumlah_bahasa'] = $this->kepegawaian->count_result_bahasa($nipp);
		
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		$data['page'] = 'Detail Kompetensi';
		$data['page_diklat'] = 'yes';
		$data['view_stkp'] = 'class="this"';
		$this->load->view('diklat/index',$data);		
	}
	
	
	
	# EXPORT TO EXCEL
	
	function excel_non_stkp()
	{
		//pengalokasian memory untuk run this function
		ini_set("memory_limit","1024M");
		ini_set('max_execution_time','600');
		
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$pegawai_with_stkp_and_unit = $this->pendidikan->get_data_nstkp_with_unit_and_name_unlimited();
				
		//load our new PHPExcel library
		$this->load->library('excel');
		
		
		for($n=0;$n<3;$n++){
		//name the worksheet
		if($n == 0){
			$status="Tetap";
		}
		if($n == 1){
			$status="Outsource";
			$this->excel->createSheet(1);
		}
		if($n == 2){
			$status="PKWT";
			$this->excel->createSheet(2);
		}
		
			$this->excel->setActiveSheetIndex($n);
			$this->excel->getActiveSheet()->setTitle("Diklat Non STKP $status");
			//set cell A1 content with some text
		
			$this->excel->getActiveSheet()->setCellValue('A6', 'NO');
			$this->excel->getActiveSheet()->setCellValue('B6', 'NIPP');
			$this->excel->getActiveSheet()->setCellValue('C6', 'NAMA');
			$this->excel->getActiveSheet()->setCellValue('D6', 'TRAINING');
			$this->excel->getActiveSheet()->setCellValue('E6', 'NO SERTIFIKAT');
			$this->excel->getActiveSheet()->setCellValue('F6', 'PELAKSANAAN');
			$this->excel->getActiveSheet()->setCellValue('H6', 'LEMBAGA PELAKSANAAN');
			$this->excel->getActiveSheet()->setCellValue('I6', 'INSTRUKTUR');
			$this->excel->getActiveSheet()->setCellValue('F7', 'From');
			$this->excel->getActiveSheet()->setCellValue('G7', 'Until');
			$this->excel->getActiveSheet()->setCellValue('I7', 'Nama');
			$this->excel->getActiveSheet()->setCellValue('J7', 'From');
			
			//JUDUL KOP
			$this->excel->getActiveSheet()->setCellValue('A2', 'DATA NON STKP');
			$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
			$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
					
			$tetap=7;
			$os=7;
			$pkwt=7;
			$number=0;
			$unit="kosong";
			$sub_unit="kosong";
			
			$nipp = '';
			$nipp_tetap = '';
			$nipp_os = '';
			$nipp_pkwt = '';
			$unit_tetap = '';
			$sub_unit_tetap = '';
			$unit_os = '';
			$sub_unit_os = '';
			$unit_pkwt = '';
			$sub_unit_pkwt = '';
			$number_tetap=0;
			$number_pkwt=0;
			$number_os=0;
		}
		
		
		$pegawai_with_stkp_and_unit = $this->pendidikan->get_data_nstkp_with_unit_and_name_and_status_unlimited();
		
		$n=0;
		foreach ($pegawai_with_stkp_and_unit as $row_pegawai) :
		{ 
			//echo "xxxxxx".$row_pegawai['p_tmt_status']." ".$n;;
			if ($row_pegawai['p_tmt_status'] !== NULL){
			if($row_pegawai['p_tmt_status'] == "Tetap"){
				$tetap++;
				$i=$tetap;
				$n=0;
				$unit=$unit_tetap;
				$sub_unit=$sub_unit_tetap;
				$number_tetap++;
				$number=$number_tetap;
			}
			if($row_pegawai['p_tmt_status'] == "Outsource"){
				$os++;
				$i=$os;
				$n=1;
				$unit=$unit_os;
				$sub_unit=$sub_unit_os;
				$number_os++;
				$number=$number_os;
			}
			if($row_pegawai['p_tmt_status'] == "PKWT"){
				$pkwt++;
				$i=$pkwt;	
				$n=2;
				$unit=$unit_pkwt;
				$sub_unit=$sub_unit_pkwt;
				$number_pkwt++;
				$number=$number_pkwt;
			}
			
			$this->excel->setActiveSheetIndex($n);
			
			//$number++;
			
			if($row_pegawai['p_unt_kode_unit'] !== $unit){
				$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$row_pegawai[nama_unit]"));
				$this->excel->getActiveSheet()->getStyle("C$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff00');
				$this->excel->getActiveSheet()->getStyle("C$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("C$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("C$i")->getFont()->setBold(true);
				$i++;
			}
			if($row_pegawai['p_unt_kode_sub_unit'] !== $sub_unit){
				$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$row_pegawai[su_sub_unit]"));
				$this->excel->getActiveSheet()->getStyle("C$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff77');
				$this->excel->getActiveSheet()->getStyle("C$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("C$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("C$i")->getFont()->setBold(true);
				$i++;
			}
			
			
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
			if ($row_pegawai['p_nstkp_selesai'] == '0000-00-00')
			{
				$stkp_selesai = '-';
			}
			else
			{
				$stkp_selesai = mdate($datestring,strtotime($row_pegawai['p_nstkp_selesai']));
			}
			
					
			//masukkan data ke tabel excel
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", "$nipp");
			$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$nama"));
			$this->excel->getActiveSheet()->setCellValue("D$i", "$row_pegawai[p_nstkp_jenis]");
			$this->excel->getActiveSheet()->setCellValue("E$i", "$row_pegawai[p_nstkp_no_license]");
			$this->excel->getActiveSheet()->setCellValue("F$i", "$pelaksanaan");
			$this->excel->getActiveSheet()->setCellValue("G$i", "$stkp_selesai");
			$this->excel->getActiveSheet()->setCellValue("H$i", "$row_pegawai[p_nstkp_lembaga]");
			$this->excel->getActiveSheet()->setCellValue("I$i", "$row_pegawai[p_nstkp_instruktur]");
			$this->excel->getActiveSheet()->setCellValue("J$i", "$row_pegawai[p_nstkp_instruktur_from]");
					
			if($row_pegawai['p_tmt_status'] == "Tetap"){
				$tetap = $i;
				$unit_tetap = $row_pegawai['p_unt_kode_unit'];
				$sub_unit_tetap = $row_pegawai['p_unt_kode_sub_unit'];
			}
			if($row_pegawai['p_tmt_status'] == "Outsource"){
				$os = $i;
				$unit_os = $row_pegawai['p_unt_kode_unit'];
				$sub_unit_os = $row_pegawai['p_unt_kode_sub_unit'];
			}
			if($row_pegawai['p_tmt_status'] == "PKWT"){
				$pkwt = $i;	
				$unit_pkwt = $row_pegawai['p_unt_kode_unit'];
				$sub_unit_pkwt = $row_pegawai['p_unt_kode_sub_unit'];
			}
			
			$nipp = $row_pegawai['peg_nipp'];
			//$unit = $row_pegawai['p_unt_kode_unit'];
			//$sub_unit = $row_pegawai['p_unt_kode_sub_unit'];
			
			}
		}endforeach;
		
		for($no=0;$no<3;$no++){
		
		if($no == 0){ $i=$tetap; }
		else if($no == 1){ $i=$os;}
		else if($no == 2){ $i=$pkwt;}
		
		$this->excel->setActiveSheetIndex($no);
		//change the font size
		$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle("A6:J7")->getFont()->setSize(11);
		$this->excel->getActiveSheet()->getStyle("A8:J$i")->getFont()->setSize(8);
		//$this->excel->getActiveSheet()->getStyle('H2')->getFont()->setSize(11);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A6:J6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('F7:J7')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A6:A7');
		$this->excel->getActiveSheet()->mergeCells('B6:B7');
		$this->excel->getActiveSheet()->mergeCells('C6:C7');
		$this->excel->getActiveSheet()->mergeCells('D6:D7');
		$this->excel->getActiveSheet()->mergeCells('E6:E7');
		$this->excel->getActiveSheet()->mergeCells('F6:G6');
		$this->excel->getActiveSheet()->mergeCells('I6:J6');
		$this->excel->getActiveSheet()->mergeCells('H6:H7');
		$this->excel->getActiveSheet()->mergeCells('A2:H2');
		$this->excel->getActiveSheet()->mergeCells('A3:H3');
		$this->excel->getActiveSheet()->mergeCells('A4:H4');
		
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A6:J6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A6:J6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		//Set Border
		//$this->excel->getActiveSheet()->getStyle('A6:H6')->getBorders()->getAllBorders()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
		//$this->excel->getActiveSheet()->getStyle('A7:H7')->getBorders()->getAllBorders()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
		
		//Set column widths                                                       
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10.75); 
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(26);    
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(47.5);  
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20.88); 
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14.63); 
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(14.63); 
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(25.88); 
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20.88); 
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20.88); 
		
		//Set paper size to A4
		//$this->excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
		
		}
		
		$filename="Report Non STKP.xls"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}
	
	# excel non_stkp kelompokkan per jenis
	function excel_non_stkp_bulanan()
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$pegawai_with_stkp_and_unit = $this->pendidikan->search_report_nstkp_bulanan_sort_pelaksanaan_training( $this->uri->segment(3), $this->uri->segment(4), $this->uri->segment(5));
		
		
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle("Diklat Non STKP ");
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A6', 'NO');
		$this->excel->getActiveSheet()->setCellValue('B6', 'NIPP');
		$this->excel->getActiveSheet()->setCellValue('C6', 'NAMA');
		$this->excel->getActiveSheet()->setCellValue('D6', 'TRAINING');
		$this->excel->getActiveSheet()->setCellValue('E6', 'PELAKSANAAN');
		$this->excel->getActiveSheet()->setCellValue('G6', 'LEMBAGA PELAKSANAAN');
		$this->excel->getActiveSheet()->setCellValue('H6', 'INSTRUKTUR');
		//$this->excel->getActiveSheet()->setCellValue('H2', 'Pelaksanaan');
		$this->excel->getActiveSheet()->setCellValue('E7', 'From');
		$this->excel->getActiveSheet()->setCellValue('F7', 'Until');
		$this->excel->getActiveSheet()->setCellValue('H7', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('I7', 'From');
		
		//JUDUL KOP
		$this->excel->getActiveSheet()->setCellValue('A2', 'DATA NON STKP');
		$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
		$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
				
		$i=7;
		$number=0;
		//$unit="kosong";
		//$sub_unit="kosong";
		
		$nipp = '';
		foreach ($pegawai_with_stkp_and_unit as $row_pegawai) :
		{ 
			
			$i++;
			$number++;
			
			//untuk memasukkan data ke excel
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
			if ($row_pegawai['p_nstkp_selesai'] == '0000-00-00')
			{
				$stkp_selesai = '-';
			}
			else
			{
				$stkp_selesai = mdate($datestring,strtotime($row_pegawai['p_nstkp_selesai']));
			}
					
			//masukkan data ke tabel excel
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", "$nipp");
			$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$nama"));
			$this->excel->getActiveSheet()->setCellValue("D$i", "$row_pegawai[p_nstkp_jenis]");
			$this->excel->getActiveSheet()->setCellValue("E$i", "$pelaksanaan");
			$this->excel->getActiveSheet()->setCellValue("F$i", "$stkp_selesai");
			$this->excel->getActiveSheet()->setCellValue("G$i", "$row_pegawai[p_nstkp_lembaga]");
			$this->excel->getActiveSheet()->setCellValue("H$i", "$row_pegawai[p_nstkp_instruktur]");
			$this->excel->getActiveSheet()->setCellValue("I$i", "$row_pegawai[p_nstkp_instruktur_from]");
					
			$nipp = $row_pegawai['peg_nipp'];
			$jenis = $row_pegawai['p_nstkp_jenis'];
			//$sub_unit = $row_pegawai['p_unt_kode_sub_unit'];
			
		}endforeach;
		
		//change the font size
		$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle("A6:I7")->getFont()->setSize(11);
		$this->excel->getActiveSheet()->getStyle("A8:I$i")->getFont()->setSize(9);
		//$this->excel->getActiveSheet()->getStyle('H2')->getFont()->setSize(11);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A6:I6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('E7:I7')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A6:A7');
		$this->excel->getActiveSheet()->mergeCells('B6:B7');
		$this->excel->getActiveSheet()->mergeCells('C6:C7');
		$this->excel->getActiveSheet()->mergeCells('D6:D7');
		$this->excel->getActiveSheet()->mergeCells('E6:F6');
		$this->excel->getActiveSheet()->mergeCells('G6:G7');
		$this->excel->getActiveSheet()->mergeCells('H6:I6');
		$this->excel->getActiveSheet()->mergeCells('A2:H2');
		$this->excel->getActiveSheet()->mergeCells('A3:H3');
		$this->excel->getActiveSheet()->mergeCells('A4:H4');
		
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A6:I6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A6:I6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('E7:I7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('E7:I7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		// change cells color
		$this->excel->getActiveSheet()->getStyle("A6:I7")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('FFD000');
	
		//Set Border
		$this->excel->getActiveSheet()->getStyle('A6:H6')->getBorders()->getAllBorders()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
		$this->excel->getActiveSheet()->getStyle('A7:H7')->getBorders()->getAllBorders()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
		
		//Set column widths                                                       
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10.75); 
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(26);    
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(47.5);  
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20.88); 
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14.63); 
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(24.63); 
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(25.88); 
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20.88); 
		
		
		$filename="Report Non STKP Bulan ".$this->uri->segment(3)."-".$this->uri->segment(4).".xls"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}
	
	/*  Dikelompokkan Per UNIT
	function excel_non_stkp_bulanan()
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$pegawai_with_stkp_and_unit = $this->pendidikan->search_report_nstkp_bulanan($this->uri->segment(3), $this->uri->segment(4), $this->uri->segment(5));
				
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle("Diklat Non STKP ");
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A6', 'NO');
		$this->excel->getActiveSheet()->setCellValue('B6', 'NIPP');
		$this->excel->getActiveSheet()->setCellValue('C6', 'NAMA');
		$this->excel->getActiveSheet()->setCellValue('D6', 'TRAINING');
		$this->excel->getActiveSheet()->setCellValue('E6', 'NO SERTIFIKAT');
		$this->excel->getActiveSheet()->setCellValue('F6', 'PELAKSANAAN');
		$this->excel->getActiveSheet()->setCellValue('H6', 'LEMBAGA PELAKSANAAN');
		$this->excel->getActiveSheet()->setCellValue('I6', 'INSTRUKTUR');
		//$this->excel->getActiveSheet()->setCellValue('H2', 'Pelaksanaan');
		$this->excel->getActiveSheet()->setCellValue('F7', 'From');
		$this->excel->getActiveSheet()->setCellValue('G7', 'Until');
		$this->excel->getActiveSheet()->setCellValue('I7', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('J7', 'From');
		
		//JUDUL KOP
		$this->excel->getActiveSheet()->setCellValue('A2', 'DATA NON STKP');
		$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
		$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
				
		$i=7;
		$number=0;
		$unit="kosong";
		$sub_unit="kosong";
		
		$nipp = '';
		foreach ($pegawai_with_stkp_and_unit as $row_pegawai) :
		{ 
			$i++;
			$number++;
			
			if($row_pegawai['p_unt_kode_unit'] !== $unit){
				$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$row_pegawai[nama_unit]"));
				$this->excel->getActiveSheet()->getStyle("C$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff00');
				$this->excel->getActiveSheet()->getStyle("C$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("C$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("C$i")->getFont()->setBold(true);
				$i++;
			}
			if($row_pegawai['p_unt_kode_sub_unit'] !== $sub_unit){
				$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$row_pegawai[su_sub_unit]"));
				$this->excel->getActiveSheet()->getStyle("C$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff77');
				$this->excel->getActiveSheet()->getStyle("C$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("C$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
				$this->excel->getActiveSheet()->getStyle("C$i")->getFont()->setBold(true);
				$i++;
			}
			
			
			//untuk memasukkan data ke excel
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
			if ($row_pegawai['p_nstkp_selesai'] == '0000-00-00')
			{
				$stkp_selesai = '-';
			}
			else
			{
				$stkp_selesai = mdate($datestring,strtotime($row_pegawai['p_nstkp_selesai']));
			}
					
			//masukkan data ke tabel excel
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", "$nipp");
			$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$nama"));
			$this->excel->getActiveSheet()->setCellValue("D$i", "$row_pegawai[p_nstkp_jenis]");
			$this->excel->getActiveSheet()->setCellValue("E$i", "$row_pegawai[p_nstkp_no_license]");
			$this->excel->getActiveSheet()->setCellValue("F$i", "$pelaksanaan");
			$this->excel->getActiveSheet()->setCellValue("G$i", "$stkp_selesai");
			$this->excel->getActiveSheet()->setCellValue("H$i", "$row_pegawai[p_nstkp_lembaga]");
			$this->excel->getActiveSheet()->setCellValue("I$i", "$row_pegawai[p_nstkp_instruktur]");
			$this->excel->getActiveSheet()->setCellValue("J$i", "$row_pegawai[p_nstkp_instruktur_from]");
					
			$nipp = $row_pegawai['peg_nipp'];
			$unit = $row_pegawai['p_unt_kode_unit'];
			$sub_unit = $row_pegawai['p_unt_kode_sub_unit'];
			
		}endforeach;
		
		//change the font size
		$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle("A6:J$i")->getFont()->setSize(11);
		//$this->excel->getActiveSheet()->getStyle('H2')->getFont()->setSize(11);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A6:J6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('F7:J7')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A6:A7');
		$this->excel->getActiveSheet()->mergeCells('B6:B7');
		$this->excel->getActiveSheet()->mergeCells('C6:C7');
		$this->excel->getActiveSheet()->mergeCells('D6:D7');
		$this->excel->getActiveSheet()->mergeCells('E6:E7');
		$this->excel->getActiveSheet()->mergeCells('F6:G6');
		$this->excel->getActiveSheet()->mergeCells('I6:J6');
		$this->excel->getActiveSheet()->mergeCells('H6:H7');
		$this->excel->getActiveSheet()->mergeCells('A2:H2');
		$this->excel->getActiveSheet()->mergeCells('A3:H3');
		$this->excel->getActiveSheet()->mergeCells('A4:H4');
		
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A6:J6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A6:J6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		//Set Border
		//$this->excel->getActiveSheet()->getStyle('A6:H6')->getBorders()->getAllBorders()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
		//$this->excel->getActiveSheet()->getStyle('A7:H7')->getBorders()->getAllBorders()->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
		
		//Set column widths                                                       
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10.75); 
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(26);    
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(47.5);  
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(20.88); 
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14.63); 
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(14.63); 
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(25.88); 
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20.88); 
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(20.88); 
		
		
		$filename="Report Non STKP Bulan ".$this->uri->segment(3)."-".$this->uri->segment(4).".xls"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}
	
	*/
	
	
	function excel_stkp()
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$jenis_stkp=$this->uri->segment(3);
		
		$pegawai_with_stkp_and_unit = $this->pendidikan->get_data_stkp_with_unit_and_name_unlimited();
				
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle("Diklat STKP $jenis_stkp ");
		//set cell A1 content with some text
		
		$this->excel->getActiveSheet()->setCellValue('A2', "$jenis_stkp LICENSE HOLDER");
		$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
		$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
			
		$this->excel->getActiveSheet()->setCellValue('A6', 'No');
		$this->excel->getActiveSheet()->setCellValue('B6', 'NIPP');
		$this->excel->getActiveSheet()->setCellValue('C6', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('D6', 'Jenis');
		$this->excel->getActiveSheet()->setCellValue('E6', 'Rating');
		$this->excel->getActiveSheet()->setCellValue('F6', 'No Sertifikat');
		$this->excel->getActiveSheet()->setCellValue('G6', 'Validitas');
		$this->excel->getActiveSheet()->setCellValue('I6', 'Lembaga');
		$this->excel->getActiveSheet()->setCellValue('J6', 'Tanggal Pelaksanaan');
		$this->excel->getActiveSheet()->setCellValue('L6', 'Jenis STKP');
		$this->excel->getActiveSheet()->setCellValue('M6', 'Instruktur');
		
		$this->excel->getActiveSheet()->setCellValue('G7', 'From');
		$this->excel->getActiveSheet()->setCellValue('H7', 'Until');
		$this->excel->getActiveSheet()->setCellValue('J7', 'From');
		$this->excel->getActiveSheet()->setCellValue('K7', 'Until');
		$this->excel->getActiveSheet()->setCellValue('M7', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('N7', 'From');
		
		$i=7;
		$number=0;
		
		$nipp = '';
		foreach ($pegawai_with_stkp_and_unit as $row_pegawai) :
		{ 
			$i++;
			$number++;
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
				$pelaksanaan = '-';
			}
			else
			{
				$pelaksanaan = $row_pegawai['p_stkp_pelaksanaan'];
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
			if ($row_pegawai['p_stkp_selesai'] == '0000-00-00')
			{
				$selesai = '-';
			}
			else
			{
				$selesai = mdate($datestring,strtotime( $row_pegawai['p_stkp_selesai']));
			}
			
			//masukkan data ke tabel excel
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", "$nipp");
			$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$nama"));
			$this->excel->getActiveSheet()->setCellValue("D$i", "$row_pegawai[p_stkp_jenis]");
			$this->excel->getActiveSheet()->setCellValue("E$i", "$row_pegawai[p_stkp_rating]");
			$this->excel->getActiveSheet()->setCellValue("F$i", "$row_pegawai[p_stkp_no_license]");
			$this->excel->getActiveSheet()->setCellValue("G$i", "$stkp_mulai");
			$this->excel->getActiveSheet()->setCellValue("H$i", "$stkp_selesai");
			$this->excel->getActiveSheet()->setCellValue("I$i", "$row_pegawai[p_stkp_lembaga]");
			$this->excel->getActiveSheet()->setCellValue("J$i", "$pelaksanaan");
			$this->excel->getActiveSheet()->setCellValue("K$i", "$selesai");
			$this->excel->getActiveSheet()->setCellValue("L$i", "$row_pegawai[p_stkp_type]");
			$this->excel->getActiveSheet()->setCellValue("M$i", "$row_pegawai[p_stkp_instruktur]");
			$this->excel->getActiveSheet()->setCellValue("N$i", "$row_pegawai[p_stkp_instruktur_from]");
			
			$nipp = $row_pegawai['peg_nipp'];
			
		}endforeach;
		
		// change cells color
		$this->excel->getActiveSheet()->getStyle("A6:M7")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('AAAAAA');
				
		//change the font size
		$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle("A6:M7")->getFont()->setSize(11);
		$this->excel->getActiveSheet()->getStyle("A8:M$i")->getFont()->setSize(8);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A6:M6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A7:M7')->getFont()->setBold(true);
		
		//merge cell 
		$this->excel->getActiveSheet()->mergeCells('A2:M2');
		$this->excel->getActiveSheet()->mergeCells('A3:M3');
		$this->excel->getActiveSheet()->mergeCells('A4:M4');
		
		$this->excel->getActiveSheet()->mergeCells('A6:A7');
		$this->excel->getActiveSheet()->mergeCells('B6:B7');
		$this->excel->getActiveSheet()->mergeCells('C6:C7');
		$this->excel->getActiveSheet()->mergeCells('D6:D7');
		$this->excel->getActiveSheet()->mergeCells('E6:E7');
		$this->excel->getActiveSheet()->mergeCells('F6:F7');
		$this->excel->getActiveSheet()->mergeCells('G6:H6');
		$this->excel->getActiveSheet()->mergeCells('I6:I7');
		$this->excel->getActiveSheet()->mergeCells('J6:K6');
		$this->excel->getActiveSheet()->mergeCells('L6:L7');
		$this->excel->getActiveSheet()->mergeCells('M6:N6');
		
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A6:N6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A6:N6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		//set coloumn's width
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10.75); 
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(26);    
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(7.5);  
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14.63); 
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20.88); 
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20.88); 
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20.88); 
		
		
		$filename="Report STKP $jenis_stkp.xls"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}
	
	function excel_stkp_bulanan()
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$jenis_stkp=$this->uri->segment(5);
		$pegawai_with_stkp_and_unit = $this->pendidikan->search_report_stkp_bulanan($this->uri->segment(3), $this->uri->segment(4), $this->uri->segment(5));
				
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle("Diklat STKP $jenis_stkp");
		//set cell A1 content with some text
		
		$this->excel->getActiveSheet()->setCellValue('A2', "$jenis_stkp LICENSE HOLDER");
		$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
		$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
			
		$this->excel->getActiveSheet()->setCellValue('A6', 'No');
		$this->excel->getActiveSheet()->setCellValue('B6', 'NIPP');
		$this->excel->getActiveSheet()->setCellValue('C6', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('D6', 'Jenis');
		$this->excel->getActiveSheet()->setCellValue('E6', 'Rating');
		$this->excel->getActiveSheet()->setCellValue('F6', 'No Sertifikat');
		$this->excel->getActiveSheet()->setCellValue('G6', 'Validitas');
		$this->excel->getActiveSheet()->setCellValue('I6', 'Lembaga');
		$this->excel->getActiveSheet()->setCellValue('J6', 'Tanggal Pelaksanaan');
		$this->excel->getActiveSheet()->setCellValue('L6', 'Jenis STKP');
		$this->excel->getActiveSheet()->setCellValue('M6', 'Instruktur');
	
		$this->excel->getActiveSheet()->setCellValue('G7', 'From');
		$this->excel->getActiveSheet()->setCellValue('H7', 'Until');
		$this->excel->getActiveSheet()->setCellValue('J7', 'From');
		$this->excel->getActiveSheet()->setCellValue('K7', 'Until');
		$this->excel->getActiveSheet()->setCellValue('M7', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('N7', 'From');
		
		
		$i=7;
		$number=0;
		
		$nipp = '';
		foreach ($pegawai_with_stkp_and_unit as $row_pegawai) :
		{ 
			$i++;
			$number++;
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
				$pelaksanaan = '-';
			}
			else
			{
				$pelaksanaan = $row_pegawai['p_stkp_pelaksanaan'];
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
			if ($row_pegawai['p_stkp_selesai'] == '0000-00-00')
			{
				$selesai = '-';
			}
			else
			{
				$selesai = mdate($datestring,strtotime( $row_pegawai['p_stkp_selesai']));
			}
			
			//masukkan data ke tabel excel
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", "$nipp");
			$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$nama"));
			$this->excel->getActiveSheet()->setCellValue("D$i", "$row_pegawai[p_stkp_jenis]");
			$this->excel->getActiveSheet()->setCellValue("E$i", "$row_pegawai[p_stkp_rating]");
			$this->excel->getActiveSheet()->setCellValue("F$i", "$row_pegawai[p_stkp_no_license]");
			$this->excel->getActiveSheet()->setCellValue("G$i", "$stkp_mulai");
			$this->excel->getActiveSheet()->setCellValue("H$i", "$stkp_selesai");
			$this->excel->getActiveSheet()->setCellValue("I$i", "$row_pegawai[p_stkp_lembaga]");
			$this->excel->getActiveSheet()->setCellValue("J$i", "$pelaksanaan");
			$this->excel->getActiveSheet()->setCellValue("K$i", "$selesai");
			$this->excel->getActiveSheet()->setCellValue("L$i", "$row_pegawai[p_stkp_type]");
			$this->excel->getActiveSheet()->setCellValue("M$i", "$row_pegawai[p_stkp_instruktur]");
			$this->excel->getActiveSheet()->setCellValue("N$i", "$row_pegawai[p_stkp_instruktur_from]");
			
			$nipp = $row_pegawai['peg_nipp'];
			
		}endforeach;
		
		// change cells color
		$this->excel->getActiveSheet()->getStyle("A6:N7")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('AAAAAA');
		//change the font size
		$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle("A6:N7")->getFont()->setSize(11);
		$this->excel->getActiveSheet()->getStyle("A8:N$i")->getFont()->setSize(8);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A6:N6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A7:N7')->getFont()->setBold(true);
		
		//merge cell 
		$this->excel->getActiveSheet()->mergeCells('A2:N2');
		$this->excel->getActiveSheet()->mergeCells('A3:N3');
		$this->excel->getActiveSheet()->mergeCells('A4:N4');
		
		$this->excel->getActiveSheet()->mergeCells('A6:A7');
		$this->excel->getActiveSheet()->mergeCells('B6:B7');
		$this->excel->getActiveSheet()->mergeCells('C6:C7');
		$this->excel->getActiveSheet()->mergeCells('D6:D7');
		$this->excel->getActiveSheet()->mergeCells('E6:E7');
		$this->excel->getActiveSheet()->mergeCells('F6:F7');
		$this->excel->getActiveSheet()->mergeCells('G6:H6');
		$this->excel->getActiveSheet()->mergeCells('I6:I7');
		$this->excel->getActiveSheet()->mergeCells('J6:K6');
		$this->excel->getActiveSheet()->mergeCells('L6:L7');
		$this->excel->getActiveSheet()->mergeCells('M6:N6');
		
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A6:M6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A6:M6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		//set coloumn's width
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10.75); 
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(26);    
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(7.5);  
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(14.63); 
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(20.88); 
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(20.88); 
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(20.88); 
		
		
		$filename="Report STKP $jenis_stkp Bulan ".$this->uri->segment(3)."-".$this->uri->segment(4).".xls"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */