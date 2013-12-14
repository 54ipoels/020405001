<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerja extends Application {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('kepegawaian/kepegawaian');
		$this->load->library('table');
		$this->load->library('form_validation');
		$this->ag_auth->restrict('user');
    }

	public function index()
	{
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/index/'; 
		$config['total_rows'] = $this->kepegawaian->count_pegawai_aktif(); 
		$config['per_page'] = 10; 
		$config['uri_segment'] = 3; 
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_aktif($config['per_page'],$page);
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		$data['list_sub_unit'] = $this->kepegawaian->get_list_sub_unit();
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Pegawai';
		$data['view_pekerja'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		
		#calling view
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function pegawai_pensiun()
	{
		$datestring = "%Y" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$type = '52';
		$limit = '100';
		
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/pegawai_pensiun/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->countPegawaiPensiun($tanggal,$type, $limit); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_pensiun($config['per_page'],$page, $tanggal, $type, $limit);
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Data Pensiun';
		$data['tanggal'] = $tanggal;
		$data['type'] = 'ALL';
		$data['view_pensiun'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		#calling view
		$this->load->view('kepegawaian/index',$data);
	}
	public function pegawai_ppb()
	{
		$datestring = "%Y" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$type = '52';
		$limit = '54';
		
		#pagination config
		//$config['base_url'] = base_url().'index.php/pekerja/pegawai_pensiun/'; //set the base url for pagination
		$config['base_url'] = base_url().'index.php/pekerja/sort_tahun_pensiun/'.$tanggal.'/PPB'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->countPegawaiPensiun($tanggal,$type, $limit); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_pensiun($config['per_page'],$page, $tanggal, $type, $limit);
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Data PPB';
		$data['tanggal'] = $tanggal;
		$data['type'] = 'ALL';
		$data['view_ppb'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		#calling view
		$this->load->view('kepegawaian/index',$data);
	}
	public function pegawai_mpp()
	{
		$datestring = "%Y" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$type = '54';
		$limit = '56';
		
		#pagination config
		//$config['base_url'] = base_url().'index.php/pekerja/pegawai_pensiun/'; //set the base url for pagination
		$config['base_url'] = base_url().'index.php/pekerja/sort_tahun_pensiun/'.$tanggal.'/MPP'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->countPegawaiPensiun($tanggal,$type, $limit); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_pensiun($config['per_page'],$page, $tanggal, $type, $limit);
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Data Pensiun';
		$data['tanggal'] = $tanggal;
		$data['type'] = 'ALL';
		$data['view_mpp'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		#calling view
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function sort_jenis_pegawai()
	{
		if ($this->input->post('jenis')==NULL)
		{
			$type = $this->uri->segment(3);
			$unit = $this->uri->segment(4);
			$kelamin = $this->uri->segment(5);
			$stk = $this->uri->segment(6);
			$sub_unit = $this->uri->segment(7);
		}else{
			$type = $this->input->post('jenis');
			$unit = $this->input->post('unit');
			$kelamin = $this->input->post('kelamin');
			$stk = $this->input->post('stk');
			$sub_unit = $this->input->post('sub_unit');
		}
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/sort_jenis_pegawai/'.$type.'/'.$unit.'/'.$kelamin.'/'.$stk.'/'.$sub_unit.'/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->count_jenis_Pegawai($type,$unit,$kelamin,$stk,$sub_unit); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 8; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(8)) ? $this->uri->segment(8) : 0;
		
		#data preparing
		$data['pegawai'] = $this->kepegawaian->get_data_jenis_pegawai($config['per_page'],$page,$type,$unit,$kelamin,$stk,$sub_unit);
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		$data['list_sub_unit'] = $this->kepegawaian->get_list_sub_unit();
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Pegawai';
		$data['page_karyawan'] = 'yes';
		
		#calling view
		$this->load->view('kepegawaian/index',$data);
		/*if ($type=='all')
		{
			redirect('pekerja/index');
		}else{
			$this->load->view('kepegawaian/index',$data);
		}*/
	}
	
	public function get_supervisor()
	{
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/get_supervisor/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->count_supervisor(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['supervisor'] = $this->kepegawaian->get_supervisor($config['per_page'],$page);
		//print_r($data['supervisor']);
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Data Supervisor';
		$data['view_supervisor'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function get_pindah_cabang()
	{
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/get_pindah_cabang/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->count_pindah_cabang(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['pindah_cabang'] = $this->kepegawaian->get_data_pegawai_pindah_cabang($config['per_page'],$page);
		//print_r($data['supervisor']);
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Data Pindah Cabang';
		$data['view_pindah_cabang'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function get_pegawai_phk()
	{
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/get_pegawai_phk/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->count_phk(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['phk'] = $this->kepegawaian->get_data_pegawai_phk($config['per_page'],$page);
		//print_r($data['supervisor']);
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Data PHK';
		$data['view_keluar'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function search_pindah_cabang()
	{
		if ($this->input->post('search') == NULL )
		{
			$search_data = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$search_data = $this->input->post('search');
		}
		
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/search_pindah_cabang/'.$search_data.'/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->count_search_pindah_cabang($search_data); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$data['pindah_cabang'] = $this->kepegawaian->search_pegawai_pindah_cabang($config['per_page'],$page,$search_data);
		//print_r($data['supervisor']);
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Data Pindah Cabang';
		$data['view_pindah_cabang'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function search_phk()
	{
		if ($this->input->post('search') == NULL )
		{
			$search_data = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$search_data = $this->input->post('search');
		}
		
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/search_phk/'.$search_data.'/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->count_search_phk($search_data); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$data['phk'] = $this->kepegawaian->search_pegawai_phk($config['per_page'],$page,$search_data);
		//print_r($data['supervisor']);
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Data PHK';
		$data['view_keluar'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function sort_tahun_pensiun()
	{
		if ($this->input->post('tahun')==NULL)
		{
			$tanggal = $this->uri->segment(3);
		}else{
			$tanggal = $this->input->post('tahun');
		}
		if ($this->input->post('jenis')==NULL)
		{
			$type = $this->uri->segment(4);
		}else{
			$type = $this->input->post('jenis');
		}
		
		if ($type === 'ALL')
		{
			$jenis = '55';
			$limit = '100';
		}else
		if ($type === 'MPP')
		{
			$jenis = '54';
			$limit = '56';
		}else
		if ($type === 'Pensiun')
		{
			$jenis = '55';
			$limit = '57';
		}else
		if ($type === 'PPB')
		{
			$jenis = '52';
			$limit = '54';
		}
		
		//print_r($type);print_r($jenis);print_r($limit);
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/sort_tahun_pensiun/'.$tanggal.'/'.$type.'/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->countPegawaiPensiun($tanggal, $jenis, $limit); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 5; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		#data preparing
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_pensiun($config['per_page'],$page, $tanggal, $jenis, $limit);
		$data['tanggal'] = $tanggal;
		$data['type']	 = $type;
		$data['count']	= $config['total_rows'];
		if($type == 'PPB'){ 
			$data['page'] = 'Data PPB';
			$data['view_ppb'] = 'class="this"';
		}else{ 
			$data['page'] = 'Data Pensiun'; 
			$data['view_pensiun'] = 'class="this"';
		}
		
		$data['page_karyawan'] = 'yes';
		
		#calling view
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function sort_unit_pegawai()
	{
		if ($this->input->post('unit') == NULL )
		{
			$unit = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$unit = $this->input->post('unit');
		}
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/sort_unit_pegawai/'.$unit.'/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->count_unit_Pegawai($unit); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		#data preparing
		$data['pegawai'] = $this->kepegawaian->get_data_unit_pegawai($config['per_page'], $page, $unit);
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Pegawai';
		$data['page_karyawan'] = 'yes';
		
		#calling view
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function delete_pegawai()
	{
		$data['NIPP'] = $this->uri->segment(3);
		$data['page'] = 'Delete Pegawai';
		$data['page_karyawan'] = 'yes';
		
		$this->load->view('kepegawaian/index', $data);
	}
		
	public function search_pegawai()
	{
		if ($this->input->post('search') == NULL )
		{
			$search_data = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$search_data = $this->input->post('search');
		}
		
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/search_pegawai/'.$search_data.'/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->count_search_pegawai($search_data); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		$data['pegawai'] = $this->kepegawaian->search_data_pegawai($config['per_page'], $page, $search_data);
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		$data['list_sub_unit'] = $this->kepegawaian->get_list_sub_unit();
		$data['count']	= $config['total_rows'];
		$data['page'] = 'Search Result';
		$data['page_karyawan'] = 'yes';
		 
		#calling view
		$this->load->view('kepegawaian/index', $data);
	}
	// FUNGSI PENGAMBILAN DATA PEGAWAI //
	public function get_pegawai($nipp)
	{
		
		#retrieve data
		$data['page'] = 'Data Perorangan';
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		if($data['pegawai'] == 0){ redirect('pekerja'); }
		else{
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
			$data['data_grade'] = $this->kepegawaian->get_last_grade_by_nipp($nipp);
			$data['data_stkp'] = $this->kepegawaian->get_detail_pegawai_stkp($nipp);		
			$data['data_anak'] = $this->kepegawaian->get_detail_pegawai_anak($nipp);
			$data['data_jabatan'] = $this->kepegawaian->get_last_jabatan($nipp);
			$data['data_riwayat_jabatan'] = $this->kepegawaian->get_riwayat_jabatan($nipp);
			$data['data_riwayat_golongan'] = $this->kepegawaian->get_riwayat_golongan($nipp);
			$data['data_riwayat_sanksi'] = $this->kepegawaian->get_riwayat_sanksi($nipp);
			#count data
			$data['jumlah_bahasa'] = $this->kepegawaian->count_result_bahasa($nipp);
			$data['page_karyawan'] = 'yes';
		
			$this->load->view('kepegawaian/index',$data);
		}
		
	}
	
	// FUNGSI PEMANGGILAN VIEW ADD DATA //
	public function add_pegawai()
	{
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		$data['list_sub_unit'] = $this->kepegawaian->get_list_sub_unit();
		$data['list_jabatan'] = $this->kepegawaian->get_list_jabatan();
		$data['view_add_pekerja'] = 'class="this"';
		$data['page'] = 'Input Data Diri';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function add_pegawai_pasangan()
	{
		$data['page'] = 'Input Data Pasangan';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function add_pegawai_pasangan_baru()
	{
		$data['page'] = 'Input Data Pasangan Baru';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function add_pegawai_ortu()
	{
		$data['page'] = 'Input Data Ortu';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function add_pegawai_mertua()
	{
		$data['page'] = 'Input Data Mertua';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function add_bahasa_pegawai()
	{
		$data['page'] = 'Add Data Bahasa';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	// FUNGSI PENAMBAHAN DATA PEGAWAI KE DATABASE //
	public function submit_data_diri()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		$data['list_sub_unit'] = $this->kepegawaian->get_list_sub_unit();
		$data['list_jabatan'] = $this->kepegawaian->get_list_jabatan();
		
		#set validation		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nipp', 'nipp', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('tempat', 'tempat', 'required');		
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('jns_klm', 'jns_klm', 'required');
		$this->form_validation->set_rules('gol_drh', 'gol_drh', 'required');

		#cek nipp ada atau tidak
		$nipp = $this->input->post('nipp');
		$validasi = $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		if ( $validasi == NULL){
		
			if ($this->form_validation->run() == FALSE)
			{
				$data['page'] = 'Input Data Diri';
				$data['page_karyawan'] = 'yes';
				$this->load->view('kepegawaian/index',$data);
			}
			else
			{
			#preparing data for input
			if(($this->input->post('tanggal')==NULL) OR ($this->input->post('tanggal')=="00/00/0000")){$tgl_lahir = "0000-00-00";}
			else{ $tgl_lahir = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal'))));}
		
			$data_pegawai = array(
					'peg_nipp' 			=> trim($this->input->post('nipp')),
					'peg_nama' 			=> $this->input->post('nama'),
					'peg_tmpt_lahir'	=> $this->input->post('tempat'),
					'peg_tgl_lahir'		=> $tgl_lahir,
					'peg_jns_kelamin'	=> $this->input->post('jns_klm'),
					'peg_gol_darah'		=> $this->input->post('gol_drh'),
					//'peg_update_on'		=> $tanggal,
					'peg_update_by'		=> 'admin'
				);
			
			#input data to table pegawai
			$this->kepegawaian->insert_data_pegawai($data_pegawai);
			
			$data_agama = array(
					'p_ag_nipp' 		=> trim($this->input->post('nipp')),
					'p_ag_agama' 		=> $this->input->post('agama'),
					//'p_ag_update_on'	=> $tanggal,
					'p_ag_update_by'	=> 'admin'
				);
				
			$this->kepegawaian->insert_data_pegawai_agama($data_agama);
			
			$data_alamat = array(
					'p_al_nipp' 		=> trim($this->input->post('nipp')),
					'p_al_jalan' 		=> $this->input->post('jalan'),
					'p_al_kelurahan'	=> $this->input->post('kelurahan'),
					'p_al_kecamatan' 	=> $this->input->post('kecamatan'),
					'p_al_kabupaten' 	=> $this->input->post('kabupaten'),
					'p_al_provinsi' 	=> $this->input->post('provinsi'),
					'p_al_no_telp' 		=> $this->input->post('notelp'),
					'p_al_email' 		=> $this->input->post('email'),
					//'p_al_update_on'	=> $tanggal,
					'p_al_update_by'	=> 'admin'
				);
				
			$this->kepegawaian->insert_data_pegawai_alamat($data_alamat);
			
			$data_bahasa = array(
					'p_bhs_nipp' 		=> trim($this->input->post('nipp')),
					'p_bhs_bahasa' 		=> $this->input->post('bahasa'),
					'p_bhs_update_on'	=> $tanggal,
					'p_bhs_update_by'	=> 'admin'
				);
				
			$this->kepegawaian->insert_data_pegawai_bahasa($data_bahasa);
				
			$data_fisik = array(
					'p_fs_nipp' 		=> trim($this->input->post('nipp')),
					'p_fs_tinggi' 		=> $this->input->post('tinggi'),
					'p_fs_berat' 		=> $this->input->post('berat'),
					'p_fs_foto'	 		=> '',
					//'p_fs_update_on'	=> $tanggal,
					'p_fs_update_by'	=> 'admin'
				);
				
			$this->kepegawaian->insert_data_pegawai_fisik($data_fisik);
				
			$data_jabatan = array(
					'p_jbt_nipp' 		=> trim($this->input->post('nipp')),
					'p_jbt_jabatan' 	=> $this->input->post('jabatan'),
					'p_jbt_unit'		=> $this->input->post('unit'),
					'p_jbt_tmt_start'	=> mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt')))),
					//'p_jbt_update_on'	=> $tanggal,
					'p_jbt_update_by'	=> 'admin'
				);
				
			$this->kepegawaian->insert_data_pegawai_jabatan($data_jabatan);
			
			$data_pendidikan = array(
					'p_pdd_nipp' 		=> trim($this->input->post('nipp')),
					'p_pdd_tingkat' 	=> $this->input->post('tgk_pdd'),
					'p_pdd_lp' 			=> $this->input->post('lembaga'),
					'p_pdd_masuk'		=> $this->input->post('masuk'),
					'p_pdd_keluar'		=> $this->input->post('keluar'),
					//'p_pdd_update_on'	=> $tanggal,
					'p_pdd_update_by'	=> 'admin'
				);
				
			$this->kepegawaian->insert_data_pegawai_pendidikan($data_pendidikan);
			
			#preparing data
			#cek apakah pegawai tetap atau outsource
			if ($this->input->post('stp') == 'PKWT')
			{
				$provider = 'PT Gapura Angkasa';
			} else
			{
				$provider = $this->input->post('provider');
			}
			
			$data_tmt = array(
					'p_tmt_nipp' 			=> trim($this->input->post('nipp')),
					'p_tmt_status'			=> $this->input->post('stp'),
					'p_tmt_provider'		=> $provider,
					'p_tmt_tmt'				=> mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt')))),
					//'p_tmt_update_on'		=> $tanggal,
					'p_tmt_update_by'		=> 'admin'
				);
				
			$this->kepegawaian->insert_data_pegawai_tmt($data_tmt);
				
			$data_unit = array(
					'p_unt_nipp' 			=> trim($this->input->post('nipp')),
					'p_unt_kode_unit'		=> $this->input->post('unit'),
					'p_unt_kode_sub_unit'	=> $this->input->post('sub_unit'),
					'p_unt_tmt_start'				=> mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt')))),
					//'p_unt_update_on'		=> $tanggal,
					'p_unt_update_by'		=> 'admin'
				);
				
			$this->kepegawaian->insert_data_pegawai_unit($data_unit);
			
			$data_stk = array(
					'p_stk_nipp' 			  => trim($this->input->post('nipp')),
					'p_stk_status_keluarga'   => $this->input->post('stk'),
					'p_stk_aktif'   		  => '0',
					//'p_stk_update_on'		  => $tanggal,
					'p_stk_update_by'		  => 'admin'
				);
			
			$this->kepegawaian->insert_data_pegawai_status_keluarga($data_stk);
			
			#redirecting
			if ($this->input->post('stk') != 'TK')
			{
				redirect('pekerja/add_pegawai_pasangan/'.trim($this->input->post('nipp')));
			}
			else
			{
				redirect('pekerja/add_pegawai_ortu/pribadi/'.trim($this->input->post('nipp')));
			}
			}
		} else {
			?><script>alert("Nipp tersebut sudah digunakan");window.history.back(-1);</script><?php	
		}
	}
	
	public function submit_data_pasangan()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$nipp = $this->input->post('nipp');
		
		if($this->input->post('tanggal_psgn')=='00/00/0000' ){$tanggal_psgn='0000-00-00';}
		else{$tanggal_psgn = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal_psgn'))));}
		if($this->input->post('meninggal_psgn')=='00/00/0000' ){$meninggal_psgn='0000-00-00';}
		else{$meninggal_psgn = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('meninggal_psgn'))));}
		
		$data_pasangan = array(
				'p_ps_nipp' 			=> $nipp,
				'p_ps_nama' 			=> $this->input->post('nama_psg'),
				'p_ps_tmpt_lahir'		=> $this->input->post('tmpt_psgn'),
				'p_ps_tgl_lahir'		=> $tanggal_psgn,
				'p_ps_tgl_meninggal'	=> $meninggal_psgn,
				'p_ps_alamat'			=> $this->input->post('almt_psgn'),
				'p_ps_pekerjaan'		=> $this->input->post('kerja_psgn'),
				//'p_ps_update_on'		=> $tanggal,
				'p_ps_update_by'		=> 'admin'
			);
		$this->kepegawaian->insert_data_pegawai_pasangan($data_pasangan);
		
		redirect('pekerja/add_pegawai_ortu/'.$nipp);
	}
	
	public function submit_data_pasangan_baru()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$nipp = $this->input->post('nipp');
		
		if($this->input->post('tanggal_psgn')=='00/00/0000' ){$tanggal_psgn='0000-00-00';}
		else{$tanggal_psgn = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal_psgn'))));}
		if($this->input->post('meninggal_psgn')=='00/00/0000' ){$meninggal_psgn='0000-00-00';}
		else{$meninggal_psgn = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('meninggal_psgn'))));}
		
		$data_pasangan = array(
				'p_ps_nipp' 			=> $nipp,
				'p_ps_nama' 			=> $this->input->post('nama_psgn'),
				'p_ps_tmpt_lahir'		=> $this->input->post('tempat_psgn'),
				'p_ps_tgl_lahir'		=> $tanggal_psgn,
				'p_ps_tgl_meninggal'	=> $meninggal_psgn,
				'p_ps_alamat'			=> $this->input->post('almt_psgn'),
				'p_ps_pekerjaan'		=> $this->input->post('kerja_psgn'),
				//'p_ps_update_on'		=> $tanggal,
				'p_ps_update_by'		=> 'admin'
			);
		$this->kepegawaian->insert_data_pegawai_pasangan($data_pasangan);
		
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	public function submit_data_ortu()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		if ($this->uri->segment(3) != 'pribadi' )
		{
			$nipp = $this->uri->segment(3);
			$stk = $this->uri->segment(3);
		} else {
			$nipp = $this->uri->segment(4);
			$stk = $this->uri->segment(3);
		}
		
		if($this->input->post('tanggal_ayah')=='00/00/0000' ){$tgl_ayah='0000-00-00';}
		else{$tgl_ayah = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal_ayah'))));}
		if($this->input->post('meninggal_ayah')=='00/00/0000' ){$meninggal_ayah='0000-00-00';}
		else{$meninggal_ayah = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('meninggal_ayah'))));}
		
		$data_ayah = array(
				'p_ay_nipp' 			=> $nipp,
				'p_ay_nama' 			=> $this->input->post('nama_ayah'),
				'p_ay_tmpt_lahir'		=> $this->input->post('tempat_ayah'),
				'p_ay_tgl_lahir'		=> $tgl_ayah,
				'p_ay_tgl_meninggal'	=> $meninggal_ayah,
				'p_ay_alamat'			=> $this->input->post('almt_ayah'),
				'p_ay_pekerjaan'		=> $this->input->post('kerja_ayah'),
				//'p_ay_update_on'		=> $tanggal,
				'p_ay_update_by'		=> 'admin'
			);
			
		$this->kepegawaian->insert_data_pegawai_ayah($data_ayah);
			
		
		if($this->input->post('tanggal_ibu')=='00/00/0000' ){$tgl_ibu='0000-00-00';}
		else{$tgl_ibu = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal_ibu'))));}
		if($this->input->post('meninggal_ibu')=='00/00/0000' ){$meninggal_ibu='0000-00-00';}
		else{$meninggal_ibu = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('meninggal_ibu'))));}
		
		$data_ibu = array(
				'p_ibu_nipp' 			=> $nipp,
				'p_ibu_nama' 			=> $this->input->post('nama_ibu'),
				'p_ibu_tmpt_lahir'		=> $this->input->post('tempat_ibu'),
				'p_ibu_tgl_lahir'		=> $tgl_ibu,
				'p_ibu_tgl_meninggal'	=> $meninggal_ibu,
				'p_ibu_alamat'			=> $this->input->post('almt_ibu'),
				'p_ibu_pekerjaan'		=> $this->input->post('kerja_ibu'),
				//'p_ibu_update_on'		=> $tanggal,
				'p_ibu_update_by'		=> 'admin'
			);
			
		$this->kepegawaian->insert_data_pegawai_ibu($data_ibu);
		
		if ($stk != 'pribadi')
		{
			redirect('pekerja/add_pegawai_mertua/'.$this->uri->segment(3));
		} else {
			redirect('pekerja/index');
		}
	}
	
	public function submit_data_mertua()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$nipp = $this->input->post('nipp');
		
		if(($this->input->post('tanggal_mert_ayah')=='00/00/0000' ) OR ($this->input->post('tanggal_mert_ayah')==NULL)){$tgl_mert_ayah='0000-00-00';}
		else{$tgl_mert_ayah = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal_mert_ayah'))));}
		if(($this->input->post('meninggal_mert_ayah')=='00/00/0000' ) OR ($this->input->post('meninggal_mert_ayah')==NULL)){$meninggal_mert_ayah='0000-00-00';}
		else{$meninggal_mert_ayah = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('meninggal_mert_ayah'))));}
		
		$data_mert_ayah = array(
				'p_may_nipp' 			=> $nipp,
				'p_may_nama' 			=> $this->input->post('nama_mert_ayah'),
				'p_may_tmpt_lahir'		=> $this->input->post('tempat_mert_ayah'),
				'p_may_tgl_lahir'		=> $tgl_mert_ayah,
				'p_may_tgl_meninggal'	=> $meninggal_mert_ayah,
				'p_may_alamat'			=> $this->input->post('almt_mert_ayah'),
				'p_may_pekerjaan'		=> $this->input->post('kerja_mert_ayah'),
				//'p_may_update_on'		=> $tanggal,
				'p_may_update_by'		=> 'admin'
			);
			
		$this->kepegawaian->insert_data_pegawai_mert_ayah($data_mert_ayah);
			
		
		if(($this->input->post('tanggal_mert_ibu')=='00/00/0000' ) OR  ($this->input->post('tanggal_mert_ibu')==NULL)) {$tgl_mert_ibu='0000-00-00';}
		else{$tgl_mert_ibu = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal_mert_ibu'))));}
		if(($this->input->post('meninggal_mert_ibu')=='00/00/0000') OR  ($this->input->post('mrninggal_mert_ibu')==NULL)){$meninggal_mert_ibu='0000-00-00';}
		else{$meninggal_mert_ibu = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('meninggal_mert_ibu'))));}
		
		$data_mert_ibu = array(
				'p_mib_nipp' 			=> $nipp,
				'p_mib_nama' 			=> $this->input->post('nama_mert_ibu'),
				'p_mib_tmpt_lahir'		=> $this->input->post('tempat_mert_ibu'),
				'p_mib_tgl_lahir'		=> $tgl_mert_ibu,
				'p_mib_tgl_meninggal'	=> $meninggal_mert_ibu,
				'p_mib_alamat'			=> $this->input->post('almt_mert_ibu'),
				'p_mib_pekerjaan'		=> $this->input->post('kerja_mert_ibu'),
				//'p_mib_update_on'		=> $tanggal,
				'p_mib_update_by'		=> 'admin'
			);
			
		$this->kepegawaian->insert_data_pegawai_mert_ibu($data_mert_ibu);
		
		redirect('pekerja/index');
	}
	
	public function add_data_anak()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$nipp = $this->input->post('nipp');
		#set validation		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('tempat', 'tempat', 'required');		
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		#$this->form_validation->set_rules('pendidikan', 'pendidikan', 'required');

		if ($this->form_validation->run() == FALSE)
		{
			redirect('pekerja/add_anak_pegawai/'.$nipp);
		}
		else
		{
			#preparing data for input
			
			if($this->input->post('tanggal')=='00/00/0000' ){$tgl_lahir='0000-00-00';}
			else{ $tgl_lahir =  mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal'))));}
			
			
			$data_anak = array(
					'peg_ank_nipp'			=> $nipp,
					'peg_ank_nama'			=> $this->input->post('nama'),
					'peg_ank_tempat_lahir'	=> $this->input->post('tempat'),
					'peg_ank_tgl_lahir'		=> $tgl_lahir,
					'peg_ank_pendidikan'	=> $this->input->post('pendidikan'),
					'peg_ank_jns_kelamin'	=> $this->input->post('jns_klm'),
					'peg_ank_agama'			=> $this->input->post('agama'),
					'peg_ank_status'		=> $this->input->post('status'),
					//'p_ank_update_on'		=> $tanggal,
					'p_ank_update_by'		=> 'admin'
				);
			
			$this->kepegawaian->insert_data_pegawai_anak($data_anak);
			
			#stk baru 
			$stk = $this->kepegawaian->get_new_pegawai_status_keluarga($nipp,'add');
			$data_stk = array(
						'p_stk_nipp' 			  => $nipp,
						'p_stk_status_keluarga'   => $stk,
					//	'p_stk_update_on'		  => $tanggal,
						'p_stk_update_by'		  => 'admin'
					);
				
			$this->kepegawaian->insert_data_pegawai_status_keluarga($data_stk);	
			
			redirect('pekerja/get_pegawai/'.$nipp);
			
		}
	}
	
	public function add_data_bahasa()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$nipp = $this->input->post('nipp');
		#set validation		
		$this->load->library('form_validation');

		$this->form_validation->set_rules('bahasa', 'bahasa', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			redirect('pekerja/add_bahasa_pegawai/'.$nipp);
		}
		else
		{
			#preparing data for input
			$data_bahasa = array(
					'p_bhs_nipp'			=> $nipp,
					'p_bhs_bahasa'			=> $this->input->post('bahasa'),
					//'p_bhs_update_on'		=> $tanggal,
					'p_bhs_update_by'		=> 'admin'
				);
				
			$this->kepegawaian->insert_data_pegawai_bahasa($data_bahasa);
			
			redirect('pekerja/get_pegawai/'.$nipp);
		}
	}
	
	function add_data_jabatan()
	{
		$data['page'] = 'Add data jabatan';
		$data['view_master_jabatan'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		
		if (($this->uri->segment(3) == 'part_one') || ($this->uri->segment(3) == NULL)) 
			{
				$data['list_jabatan'] = $this->kepegawaian->get_list_jabatan();
				$this->load->view('kepegawaian/index', $data);
			}
		else if ($this->uri->segment(3)== 'part_two')
			{
				if ($this->input->post('edit') == 'yes')
				{
					$this->kepegawaian->edit_list_jabatan();
				} else {
					$this->kepegawaian->add_list_jabatan();
				}
				redirect ('pekerja/add_data_jabatan/part_one');
			}
	}
	
	// FUNGSI PEMANGGILAN VIEW EDIT DATA //
	public function edit_data($nipp)
	{
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		$data['agama'] = $this->kepegawaian->get_detail_pegawai_agama($nipp);
		$data['fisik'] = $this->kepegawaian->get_detail_pegawai_fisik($nipp);
		$data['alamat'] = $this->kepegawaian->get_detail_pegawai_alamat($nipp);
		$data['status_keluarga'] = $this->kepegawaian->get_detail_pegawai_status_keluarga($nipp);
		$data['page'] = 'Edit Data Diri';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function edit_alamat_pegawai($nipp)
	{
		$data['alamat'] = $this->kepegawaian->get_detail_pegawai_alamat($nipp);
		$data['page'] = 'Edit Data Alamat';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function edit_pasangan_pegawai($nipp)
	{
		$data['pasangan'] = $this->kepegawaian->get_detail_pegawai_pasangan($nipp);
		$data['page'] = 'Edit Data Pasangan';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function edit_ortu_pegawai($nipp)
	{
		$data['ayah'] = $this->kepegawaian->get_detail_pegawai_ayah($nipp);
		$data['ibu'] = $this->kepegawaian->get_detail_pegawai_ibu($nipp);
		$data['page'] = 'Edit Data Ortu';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function edit_mertua_pegawai($nipp)
	{
		$data['mertua_ayah'] = $this->kepegawaian->get_detail_pegawai_mert_ayah($nipp);
		$data['mertua_ibu'] = $this->kepegawaian->get_detail_pegawai_mert_ibu($nipp);
		$data['page'] = 'Edit Data Mertua';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function edit_anak_pegawai($nipp)
	{		
		$data['anak'] = $this->kepegawaian->get_detail_pegawai_anak($nipp);
		$data['page'] = 'Edit Data Anak';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function edit_jabatan_pegawai($nipp)
	{		
		#$data['jabatan'] = $this->kepegawaian->get_detail_pegawai_jabatan($nipp);
		$data['jabatan'] = $this->kepegawaian->get_last_jabatan($nipp);
		$data['list_jabatan'] = $this->kepegawaian->get_list_jabatan();
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		$data['list_sub_unit'] = $this->kepegawaian->get_list_sub_unit();
		$data['list_team'] = $this->kepegawaian->get_list_team();
		$data['unit'] = $this->kepegawaian->get_detail_pegawai_unit($nipp);
		$data['grade'] = $this->kepegawaian->get_detail_pegawai_grade($nipp);
		$data['page'] = 'Edit Data Jabatan';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	#riwayat jabatan
	public function add_riwayat_jabatan()
	{		
		$data['nipp'] = $this->uri->segment(3);
		$data['list_jabatan'] = $this->kepegawaian->get_list_jabatan();
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		$data['page'] = 'Add Data Riwayat Jabatan';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	public function add_data_riwayat_jabatan()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$no_sk = $this->input->post('no_sk');
		if($this->input->post('tmt_jbt')=='00/00/0000'){$tanggal_tmt_jbt='0000-00-00';}
		else{ $tanggal_tmt_jbt = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt_jbt'))));}
		if($this->input->post('tmt_end_jbt')=='00/00/0000'){$tanggal_tmt_end='0000-00-00';}
		else{ $tanggal_tmt_end = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt_end_jbt'))));}
		$filenamebantu = "";
		$nipp = $this->input->post('nipp');
		$last_unit_tmt = $this->kepegawaian->get_latest_unit_by_nipp($nipp); 
		
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
			
			$config['upload_path'] = './pegawai/skjabatan/';
			$config['allowed_types'] = 'pdf|gif|jpg|png';
			$config['max_size']  = '9999';
			$config['overwrite']	=	TRUE;
			//$filenamebantu = str_replace(' ','_',$no_sk)."-$id_peg_jabatan-".$update_on.".".$ext[1];
			$filenamebantu = str_replace(' ','_',$no_sk).".".$ext[1]; //filenya ditindih dengan file baru
			$config['file_name']=$filenamebantu;
			
			
			//Initialize
			$this->load->library('upload');
			$this->upload->initialize($config);
			//Upload file
			if( ! $this->upload->do_upload("file")){
				echo $this->upload->display_errors();
			} else {
			//If the upload success
				$file_name = $this->upload->file_name;
			}
		} 
		if($tanggal_tmt_jbt > $last_unit_tmt)
		{
			$this->kepegawaian->update_tmt_end_latest_unit($nipp,$tanggal_tmt_jbt);
			$data_unit = array(
						"p_unt_nipp"		=>	$nipp,
						"p_unt_kode_unit"	=>	$this->input->post('unit'),
						"p_unt_tmt_start"	=>	$tanggal_tmt_jbt,
						"p_unt_update_by"	=>	username(),
				);
			$this->kepegawaian->insert_data_pegawai_unit($data_unit);
		}
		
		$data_jabatan = array(
					'p_jbt_nipp'		=> $nipp,
					'p_jbt_jabatan'		=> $this->input->post('jabatan'),
					'p_jbt_unit'		=> $this->input->post('unit'),
					'p_jbt_tmt_start'	=> $tanggal_tmt_jbt,
					'p_jbt_tmt_end'		=> $tanggal_tmt_end,
					'p_jbt_skno'		=> $no_sk,
					'p_jbt_skfile'		=> $filenamebantu,
					'p_jbt_keterangan'	=> $this->input->post('keterangan'),
					'p_jbt_update_by'	=> username(),
				);
		$this->kepegawaian->insert_data_riwayat_jabatan($data_jabatan);	
		redirect('pekerja/get_pegawai/'.$nipp);
		
	}
	
	
	public function edit_riwayat_jabatan()
	{		
		$id_peg_jabatan = $this->uri->segment(3);
		$data['id_peg_jabatan'] = $id_peg_jabatan;
		$data['jabatan'] = $this->kepegawaian->get_jabatan_by_id_jabatan($id_peg_jabatan);
		$data['list_jabatan'] = $this->kepegawaian->get_list_jabatan();
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		$data['page'] = 'Edit Data Riwayat Jabatan';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	public function edit_data_riwayat_jabatan()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$no_sk = $this->input->post('no_sk');
		if($this->input->post('tmt_jbt')=='00/00/0000'){$tanggal_tmt_jbt='0000-00-00';}
		else{ $tanggal_tmt_jbt = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt_jbt'))));}
		if($this->input->post('tmt_end_jbt')=='00/00/0000'){$tanggal_tmt_end='0000-00-00';}
		else{ $tanggal_tmt_end = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt_end_jbt'))));}
		/*if($this->input->post('sktanggal')=='00/00/0000'){$sktanggal='0000-00-00';}
		else{ $sktanggal = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('sktanggal'))));}
		*/
		$id_peg_jabatan = $this->input->post('id_peg_jbt');
		$nipp = $this->input->post('nipp');
		$last_unit_tmt = $this->kepegawaian->get_latest_unit_by_nipp($nipp); 
		
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
			
			$config['upload_path'] = './pegawai/skjabatan/';
			$config['allowed_types'] = 'pdf|gif|jpg|png';
			$config['max_size']  = '9999';
			$config['overwrite']	=	TRUE;
			//$filenamebantu = str_replace(' ','_',$no_sk)."-$id_peg_jabatan-".$update_on.".".$ext[1];
			$filenamebantu = str_replace(' ','_',$no_sk).".".$ext[1]; //filenya ditindih dengan file baru
			$config['file_name']=$filenamebantu;
			
			
			//Initialize
			$this->load->library('upload');
			$this->upload->initialize($config);
			//Upload file
			if( ! $this->upload->do_upload("file")){
				echo $this->upload->display_errors();
			} else {
			//If the upload success
				$file_name = $this->upload->file_name;
				$data_jabatan = array(
						'p_jbt_nipp'		=> $nipp,
						'p_jbt_jabatan'		=> $this->input->post('jabatan'),
						'p_jbt_unit'		=>	$this->input->post('unit'),
						'p_jbt_tmt_start'	=> $tanggal_tmt_jbt,
						'p_jbt_tmt_end'		=> $tanggal_tmt_end,
						'p_jbt_skno'		=> $no_sk,
						'p_jbt_skfile'		=> $filenamebantu,
						'p_jbt_skpejabat'	=> $this->input->post('skpejabat'),
						//'p_jbt_sktanggal'	=> $sktanggal,
						'p_jbt_keterangan'	=> $this->input->post('keterangan'),
						'p_jbt_update_by'	=> username(),
					);
				$this->kepegawaian->update_data_riwayat_jabatan($id_peg_jabatan,$data_jabatan);	
				
				if($tanggal_tmt_jbt > $last_unit_tmt)
				{
					$this->kepegawaian->update_tmt_end_latest_unit($nipp,$tanggal_tmt_jbt);
					$data_unit = array(
								"p_unt_nipp"		=>	$nipp,
								"p_unt_kode_unit"	=>	$this->input->post('unit'),
								"p_unt_tmt_start"	=>	$tanggal_tmt_jbt,
								"p_unt_update_by"	=>	username(),
						);
					$this->kepegawaian->insert_data_pegawai_unit($data_unit);
				}
				
				
				redirect('pekerja/get_pegawai/'.$nipp);
			}
		} 
		else{
			$data_jabatan = array(
						'p_jbt_nipp'		=> $nipp,
						'p_jbt_jabatan'		=> $this->input->post('jabatan'),
						'p_jbt_unit'		=>	$this->input->post('unit'),
						'p_jbt_tmt_start'	=> $tanggal_tmt_jbt,
						'p_jbt_tmt_end'		=> $tanggal_tmt_end,
						'p_jbt_skno'		=> $no_sk,
						'p_jbt_skpejabat'	=> $this->input->post('skpejabat'),
						//'p_jbt_sktanggal'	=> $sktanggal,
						'p_jbt_keterangan'	=> $this->input->post('keterangan'),
						'p_jbt_update_by'	=> username(),
					);
				$this->kepegawaian->update_data_riwayat_jabatan($id_peg_jabatan,$data_jabatan);	
				
				if($tanggal_tmt_jbt > $last_unit_tmt)
				{
					$this->kepegawaian->update_tmt_end_latest_unit($nipp,$tanggal_tmt_jbt);
					$data_unit = array(
								"p_unt_nipp"		=>	$nipp,
								"p_unt_kode_unit"	=>	$this->input->post('unit'),
								"p_unt_tmt_start"	=>	$tanggal_tmt_jbt,
								"p_unt_update_by"	=>	username(),
						);
					$this->kepegawaian->insert_data_pegawai_unit($data_unit);
				}
		
				redirect('pekerja/get_pegawai/'.$nipp);
		}
	}
	public function delete_riwayat_jabatan()
	{
		$id_jabatan = $this->uri->segment(3); 
		$this->kepegawaian->delete_riwayat_jabatan($id_jabatan);
		$nipp = $this->uri->segment(4);
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	#riwayat golongan
	public function add_riwayat_golongan()
	{		
		$data['nipp'] = $this->uri->segment(3);
		$data['page'] = 'Add Data Riwayat Golongan';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	public function add_data_golongan()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$no_sk = $this->input->post('no_sk');
		if(($this->input->post('tmt')=='00/00/0000') OR ($this->input->post('tmt')=='')){$tmt='0000-00-00';}
		else{ $tmt = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt'))));}
		$filenamebantu = "";
		$nipp = $this->input->post('nipp');
		
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
			
			$config['upload_path'] = './pegawai/skgolongan/';
			$config['allowed_types'] = 'pdf|gif|jpg|png';
			$config['max_size']  = '9999';
			$config['overwrite']	=	TRUE;
			//$filenamebantu = str_replace(' ','_',$no_sk)."-$id_peg_jabatan-".$update_on.".".$ext[1];
			$filenamebantu = str_replace(' ','_',$no_sk).".".$ext[1]; //filenya ditindih dengan file baru
			$config['file_name']=$filenamebantu;
			
			
			//Initialize
			$this->load->library('upload');
			$this->upload->initialize($config);
			//Upload file
			if( ! $this->upload->do_upload("file")){
				echo $this->upload->display_errors();
			} else {
			//If the upload success
				$file_name = $this->upload->file_name;
			}
		} 
		$data_golongan = array(
						'p_grd_nipp'		=> $nipp,
						'p_grd_grade'		=> $this->input->post('golongan'),
						'p_grd_skno'		=> $this->input->post('no_sk'),
						'p_grd_skfile'		=> $filenamebantu,
						'p_grd_tmt'			=> $tmt,
						'p_grd_keterangan'	=> $this->input->post('keterangan'),
						'p_grd_update_by'	=> username(),
					);
		$this->kepegawaian->insert_data_riwayat_golongan($data_golongan);
		
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	public function edit_riwayat_golongan()
	{		
		$id_peg_grade = $this->uri->segment(3);
		$data['id_peg_grade'] = $id_peg_grade;
		$data['golongan'] = $this->kepegawaian->get_golongan_by_id_golongan($id_peg_grade);
		$data['page'] = 'Edit Data Riwayat Golongan';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	public function edit_data_riwayat_golongan()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$no_sk = $this->input->post('no_sk');
		if(($this->input->post('tmt')=='00/00/0000') OR ($this->input->post('tmt')=='')){$tmt='0000-00-00';}
		else{ $tmt = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt'))));}
		$nipp = $this->input->post('nipp');
		$id_peg_grade = $this->input->post('id_peg_grade');
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
			
			$config['upload_path'] = './pegawai/skgolongan/';
			$config['allowed_types'] = 'pdf|gif|jpg|png';
			$config['max_size']  = '9999';
			$config['overwrite']	=	TRUE;
			//$filenamebantu = str_replace(' ','_',$no_sk)."-$id_peg_jabatan-".$update_on.".".$ext[1];
			$filenamebantu = str_replace(' ','_',$no_sk).".".$ext[1]; //filenya ditindih dengan file baru
			$config['file_name']=$filenamebantu;
			
			
			//Initialize
			$this->load->library('upload');
			$this->upload->initialize($config);
			//Upload file
			if( ! $this->upload->do_upload("file")){
				echo $this->upload->display_errors();
			} else {
			//If the upload success
				$file_name = $this->upload->file_name;
				$data_golongan = array(
						'p_grd_nipp'		=> $nipp,
						'p_grd_grade'		=> $this->input->post('golongan'),
						'p_grd_skno'		=> $this->input->post('no_sk'),
						'p_grd_skfile'		=> $filenamebantu,
						'p_grd_tmt'			=> $tmt,
						'p_grd_keterangan'	=> $this->input->post('keterangan'),
						'p_grd_update_by'	=> username(),
					);
				$this->kepegawaian->update_data_riwayat_golongan($id_peg_grade,$data_golongan);
			}
		} 
		else {
				$data_golongan = array(
						'p_grd_nipp'		=> $nipp,
						'p_grd_grade'		=> $this->input->post('golongan'),
						'p_grd_skno'		=> $this->input->post('no_sk'),
						'p_grd_tmt'			=> $tmt,
						'p_grd_keterangan'	=> $this->input->post('keterangan'),
						'p_grd_update_by'	=> username(),
					);
				$this->kepegawaian->update_data_riwayat_golongan($id_peg_grade,$data_golongan);
		}
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	public function delete_riwayat_golongan()
	{
		$id_grade = $this->uri->segment(3); 
		$this->kepegawaian->delete_riwayat_golongan($id_grade);
		$nipp = $this->uri->segment(4);
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	#riwayat sanksi
	public function add_riwayat_sanksi()
	{		
		$data['nipp'] = $this->uri->segment(3);
		$data['page'] = 'Add Data Riwayat Sanksi';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	public function add_data_sanksi()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$no_sk = $this->input->post('no_sk');
		if(($this->input->post('tmt_start')=='00/00/0000') OR ($this->input->post('tmt_start')=='')){$tmt_start='0000-00-00';}
		else{ $tmt_start = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt_start'))));}
		if(($this->input->post('tmt_end')=='00/00/0000') OR ($this->input->post('tmt_end')=='')){$tmt_end='0000-00-00';}
		else{ $tmt_end = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt_end'))));}
		$filenamebantu = "";
		$nipp = $this->input->post('nipp');
		
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
			
			$config['upload_path'] = './pegawai/sksanksi/';
			$config['allowed_types'] = 'pdf|gif|jpg|png';
			$config['max_size']  = '9999';
			$config['overwrite']	=	TRUE;
			//$filenamebantu = str_replace(' ','_',$no_sk)."-$id_peg_jabatan-".$update_on.".".$ext[1];
			$filenamebantu = str_replace(' ','_',$no_sk).".".$ext[1]; //filenya ditindih dengan file baru
			$config['file_name']=$filenamebantu;
			
			
			//Initialize
			$this->load->library('upload');
			$this->upload->initialize($config);
			//Upload file
			if( ! $this->upload->do_upload("file")){
				echo $this->upload->display_errors();
			} else {
			//If the upload success
				$file_name = $this->upload->file_name;
			}
		} 
		$data_sanksi = array(
						'p_snk_nipp'		=> $nipp,
						'p_snk_jenis'		=> $this->input->post('sanksi'),
						'p_snk_no'			=> $this->input->post('no_sk'),
						'p_snk_file'		=> $filenamebantu,
						'p_snk_start'		=> $tmt_start,
						'p_snk_end'			=> $tmt_end,
						'p_snk_keterangan'	=> $this->input->post('keterangan'),
						'p_snk_update_by'	=> username(),
					);
		$this->kepegawaian->insert_data_riwayat_sanksi($data_sanksi);
		
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	public function edit_riwayat_sanksi()
	{		
		$id_peg_sanksi = $this->uri->segment(3);
		$data['id_peg_sanksi'] = $id_peg_sanksi;
		$data['sanksi'] = $this->kepegawaian->get_sanksi_by_id_sanksi($id_peg_sanksi);
		$data['page'] = 'Edit Data Riwayat Sanksi';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	public function edit_data_riwayat_sanksi()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$no_sk = $this->input->post('no_sk');
		if(($this->input->post('tmt_start')=='00/00/0000') OR ($this->input->post('tmt_start')=='')){$tmt_start='0000-00-00';}
		else{ $tmt_start = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt_start'))));}
		if(($this->input->post('tmt_end')=='00/00/0000') OR ($this->input->post('tmt_end')=='')){$tmt_end='0000-00-00';}
		else{ $tmt_end = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt_end'))));}
		$id_peg_sanksi = $this->input->post('id_peg_sanksi');
		$nipp = $this->input->post('nipp');
		
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
			
			$config['upload_path'] = './pegawai/sksanksi/';
			$config['allowed_types'] = 'pdf|gif|jpg|png';
			$config['max_size']  = '9999';
			$config['overwrite']	=	TRUE;
			//$filenamebantu = str_replace(' ','_',$no_sk)."-$id_peg_jabatan-".$update_on.".".$ext[1];
			$filenamebantu = str_replace(' ','_',$no_sk).".".$ext[1]; //filenya ditindih dengan file baru
			$config['file_name']=$filenamebantu;
			
			
			//Initialize
			$this->load->library('upload');
			$this->upload->initialize($config);
			//Upload file
			if( ! $this->upload->do_upload("file")){
				echo $this->upload->display_errors();
			} else {
			//If the upload success
				$file_name = $this->upload->file_name;
				$data_sanksi = array(
						'p_snk_nipp'		=> $nipp,
						'p_snk_jenis'		=> $this->input->post('sanksi'),
						'p_snk_no'			=> $this->input->post('no_sk'),
						'p_snk_file'		=> $filenamebantu,
						'p_snk_start'		=> $tmt_start,
						'p_snk_end'			=> $tmt_end,
						'p_snk_keterangan'	=> $this->input->post('keterangan'),
						'p_snk_update_by'	=> username(),
					);
				$this->kepegawaian->update_data_riwayat_sanksi($id_peg_sanksi,$data_sanksi);
			}
		} 
		else {
				$data_sanksi = array(
						'p_snk_nipp'		=> $nipp,
						'p_snk_jenis'		=> $this->input->post('sanksi'),
						'p_snk_no'			=> $this->input->post('no_sk'),
						'p_snk_start'		=> $tmt_start,
						'p_snk_end'			=> $tmt_end,
						'p_snk_keterangan'	=> $this->input->post('keterangan'),
						'p_snk_update_by'	=> username(),
					);
				$this->kepegawaian->update_data_riwayat_sanksi($id_peg_sanksi,$data_sanksi);
		}
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	public function delete_riwayat_sanksi()
	{
		$id_sanksi = $this->uri->segment(3); 
		$this->kepegawaian->delete_riwayat_sanksi($id_sanksi);
		$nipp = $this->uri->segment(4);
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	#edit status pegawai
	public function edit_status_pegawai($nipp)
	{		
		$data['peg_tmt'] = $this->kepegawaian->get_detail_pegawai_tmt($nipp);
		$data['page'] = 'Edit Data Status';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	public function edit_data_status_pegawai($nipp)
	{		
		$id_tmt = $this->input->post('id_tmt');
		$datestring = "%Y-%m-%d" ;
		$tmt = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt'))));
		$data_baru = array(
				'p_tmt_nipp' => $this->input->post('nipp'),
				'p_tmt_status' => $this->input->post('status'),
				'p_tmt_provider' => $this->input->post('provider'),
				'p_tmt_tmt' => $tmt,
				'p_tmt_update_by' => username(),
			);
		
		//update tmt end, peg_tmt terakhir
		$data_update_tmt = array (
				'p_tmt_end' 	=> $tmt,
			);
		#input data to table pegawai
				
		$this->kepegawaian->update_data_last_tmt($data_update_tmt,$id_tmt); //update tmt terakhir 
		$this->kepegawaian->insert_data_pegawai_tmt($data_baru);
		
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	#akhir edit status pegawai
	
	public function edit_pendidikan_pegawai($nipp)
	{		
		$data['bahasa'] = $this->kepegawaian->get_detail_pegawai_bahasa($nipp);
		$data['pendidikan'] = $this->kepegawaian->get_detail_pegawai_pendidikan($nipp);
		$data['page'] = 'Edit Data Pendidikan';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
		
	public function add_anak_pegawai($nipp)
	{
		$data['page'] = 'Add Data Anak';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function edit_provider_pegawai($nipp)
	{		
		#$data['jabatan_tmt'] = $this->kepegawaian->get_detail_pegawai_jabatan_tmt($nipp);
		$data['list_jabatan'] = $this->kepegawaian->get_list_jabatan();
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		$data['unit'] = $this->kepegawaian->get_detail_pegawai_unit($nipp);
		$data['grade'] = $this->kepegawaian->get_detail_pegawai_grade($nipp);
		$data['jabatan'] = $this->kepegawaian->get_last_jabatan($nipp);
		$data['data_tmt'] = $this->kepegawaian->get_detail_pegawai_tmt($nipp);
		
		$data['page'] = 'Edit Data Provider';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	//FUNGSI PENGUBAHAN DATA PEGAWAI YANG DI DATABASE //
	public function edit_data_diri()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		#set validation		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('tempat', 'tempat', 'required');		
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('jns_klm', 'jns_klm', 'required');
		$this->form_validation->set_rules('gol_drh', 'gol_drh', 'required');
		$nipp = $this->uri->segment(3);
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['page'] = 'Input Data Diri';
			$this->load->view('kepegawaian/index',$data);
		}
		else
		{
		if($this->input->post('tanggal')=="00/00/0000"){$tanggal_lahir="0000-00-00";}
		else{$tanggal_lahir=mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal'))));}
		
		
		$data_pegawai = array(
				'peg_nama' 			=> $this->input->post('nama'),
				'peg_tmpt_lahir'	=> $this->input->post('tempat'),
				'peg_tgl_lahir'		=> $tanggal_lahir,
				'peg_jns_kelamin'	=> $this->input->post('jns_klm'),
				'peg_gol_darah'		=> $this->input->post('gol_drh'),
				//'peg_update_on'		=> $tanggal,
				'peg_update_by'		=> 'admin'
			);
		
		$data_telp = array(
				'p_al_no_telp'	=> $this->input->post('no_telp')
			);
		#input data to table pegawai
		$this->kepegawaian->update_data_pegawai($data_pegawai);
		$this->kepegawaian->update_data_telp($data_telp);
		
		$data_agama = array(
					'p_ag_nipp' 		=> $nipp,
					'p_ag_agama' 		=> $this->input->post('agama'),
					//'p_ag_update_on'	=> $tanggal,
					'p_ag_update_by'	=> 'admin'
				);
				
		$this->kepegawaian->insert_data_pegawai_agama($data_agama);
		
		//update data stk terakhir
		$id_stk = $this->kepegawaian->get_data_pegawai_last_status_keluarga($nipp);		
		$data_stk_last = array(
					'p_stk_aktif'			  => '0',
					'p_stk_update_by'		  => 'admin'
				);
			
		$this->kepegawaian->update_data_status_keluarga($data_stk_last,$id_stk);		
				
		$data_stk = array(
					'p_stk_nipp' 			  => $nipp,
					'p_stk_status_keluarga'   => $this->input->post('stk'),
					'p_stk_aktif'			=>	'1',
					//'p_stk_update_on'		  => $tanggal,
					'p_stk_update_by'		  => 'admin'
				);
			
		$this->kepegawaian->insert_data_pegawai_status_keluarga($data_stk);		
		}
		
		$data_fisik = array(
					'p_fs_nipp' 		=> $nipp,
					'p_fs_tinggi' 		=> $this->input->post('tinggi'),
					'p_fs_berat' 		=> $this->input->post('berat'),
					'p_fs_foto'	 		=> '',
					//'p_fs_update_on'	=> $tanggal,
					'p_fs_update_by'	=> 'admin'
				);
				
		$this->kepegawaian->insert_data_pegawai_fisik($data_fisik);
			
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	public function edit_data_alamat()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
				
		$nipp = $this->uri->segment(3);
		$data_alamat = array(
				'p_al_jalan'		=> $this->input->post('jalan'),
				'p_al_kelurahan'	=> $this->input->post('kelurahan'),
				'p_al_kecamatan'	=> $this->input->post('kecamatan'),
				'p_al_kabupaten'	=> $this->input->post('kabupaten'),
				'p_al_provinsi'		=> $this->input->post('provinsi'),
				'p_al_email'		=> $this->input->post('email'),
				//'p_al_update_on'	=> $tanggal,
				'p_al_update_by'	=> 'admin'
			);
		#input data to table pegawai
		$this->kepegawaian->update_data_alamat($data_alamat);
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	public function edit_data_pasangan()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		if ($this->input->post('tgl_lahir')=='00/00/0000'){ $tgl_lahir='0000-00-00';} 
		else {$tgl_lahir = mdate($datestring,strtotime(str_replace('/','-',$this->input->post('tgl_lahir'))));}
		if ($this->input->post('tgl_meninggal')=='00/00/0000'){ $tgl_meninggal='0000-00-00';} 
		else {$tgl_meninggal = mdate($datestring,strtotime(str_replace('/','-',$this->input->post('tgl_meninggal'))));}
		$nipp = $this->uri->segment(3);
		$data_pasangan = array(
				'p_ps_nama'			=> $this->input->post('nama'),
				'p_ps_tmpt_lahir'	=> $this->input->post('tempat_lahir'),
				'p_ps_tgl_lahir'	=> $tgl_lahir,
				'p_ps_tgl_meninggal'=> $tgl_meninggal,
				'p_ps_alamat'		=> $this->input->post('alamat'),
				'p_ps_pekerjaan'	=> $this->input->post('pekerjaan'),
				'p_ps_agama'		=> $this->input->post('agama'),
				'p_ps_jns_kelamin'	=> $this->input->post('jns_klm'),
				//'p_ps_update_on'	=> $tanggal,
				'p_ps_update_by'	=> 'admin'
			);
		#input data to table pegawai
		$this->kepegawaian->update_data_pasangan($data_pasangan);
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	public function delete_pasangan_pegawai($nipp)
	{
		$this->kepegawaian->delete_data_pasangan($nipp);
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	public function edit_data_ortu()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		if($this->input->post('tgl_ayah')=="00/00/0000"){$tgl_ayah="0000-00-00";}
		else{$tgl_ayah = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tgl_ayah'))));}
		if($this->input->post('meninggal_ayah')=="00/00/0000"){$meninggal_ayah="0000-00-00";}
		else{$meninggal_ayah = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('meninggal_ayah'))));}
		
		$nipp = $this->uri->segment(3);		
		$data_ayah = array(
				'p_ay_nama' 			=> $this->input->post('nama_ayah'),
				'p_ay_tmpt_lahir'		=> $this->input->post('tempat_ayah'),
				'p_ay_tgl_lahir'		=> $tgl_ayah,
				'p_ay_tgl_meninggal'	=> $meninggal_ayah,
				'p_ay_alamat'			=> $this->input->post('almt_ayah'),
				'p_ay_pekerjaan'		=> $this->input->post('kerja_ayah'),
				//'p_ay_update_on'		=> $tanggal,
				'p_ay_update_by'		=> 'admin'
			);
			
		if ($this->input->post('nama_ayah') !== ""){	
			if ($this->kepegawaian->update_data_ayah($data_ayah) == 0){
				$data_ayah['p_ay_nipp'] = $nipp;
				$this->kepegawaian->insert_data_pegawai_ayah($data_ayah);
			}
		}
		
		if($this->input->post('tgl_ibu')=="00/00/0000"){$tgl_ibu="0000-00-00";}
		else{$tgl_ibu = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tgl_ibu'))));}
		if($this->input->post('meninggal_ibu')=="00/00/0000"){$meninggal_ibu="0000-00-00";}
		else{$meninggal_ibu = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('meninggal_ibu'))));}
		
		$data_ibu = array(
				'p_ibu_nama' 			=> $this->input->post('nama_ibu'),
				'p_ibu_tmpt_lahir'		=> $this->input->post('tempat_ibu'),
				'p_ibu_tgl_lahir'		=> $tgl_ibu,
				'p_ibu_tgl_meninggal'	=> $meninggal_ibu,
				'p_ibu_alamat'			=> $this->input->post('almt_ibu'),
				'p_ibu_pekerjaan'		=> $this->input->post('kerja_ibu'),
				//'p_ibu_update_on'		=> $tanggal,
				'p_ibu_update_by'		=> 'admin'
			);
		if ($this->input->post('nama_ibu') !== ""){	
			if ($this->kepegawaian->update_data_ibu($data_ibu) == 0){
				$data_ibu['p_ibu_nipp'] = $nipp;
				$this->kepegawaian->insert_data_pegawai_ibu($data_ibu);
			}
		}
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	public function edit_data_mertua()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$nipp = $this->uri->segment(3);	
		
		if($this->input->post('tgl_ayah')=="00/00/0000"){$tgl_ayah="0000-00-00";}
		else{$tgl_ayah = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tgl_ayah'))));}
		if($this->input->post('meninggal_ayah')=="00/00/0000"){$meninggal_ayah="0000-00-00";}
		else{$meninggal_ayah = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('meninggal_ayah'))));}
				
		$data_mert_ayah = array(
				'p_may_nama' 			=> $this->input->post('nama_ayah'),
				'p_may_tmpt_lahir'		=> $this->input->post('tempat_ayah'),
				'p_may_tgl_lahir'		=> $tgl_ayah,
				'p_may_tgl_meninggal'	=> $meninggal_ayah,
				'p_may_alamat'			=> $this->input->post('almt_ayah'),
				'p_may_pekerjaan'		=> $this->input->post('kerja_ayah'),
				//'p_may_update_on'		=> $tanggal,
				'p_may_update_by'		=> 'admin'
			);
			
		$this->kepegawaian->update_data_mert_ayah($data_mert_ayah);
		
		if($this->input->post('tgl_ibu')=="00/00/0000"){$tgl_ibu="0000-00-00";}
		else{$tgl_ibu = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tgl_ibu'))));}
		if($this->input->post('meninggal_ibu')=="00/00/0000"){$meninggal_ibu="0000-00-00";}
		else{$meninggal_ibu = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('meninggal_ibu'))));}
		
		$data_mert_ibu = array(
				'p_mib_nama' 			=> $this->input->post('nama_ibu'),
				'p_mib_tmpt_lahir'		=> $this->input->post('tempat_ibu'),
				'p_mib_tgl_lahir'		=> $tgl_ibu,
				'p_mib_tgl_meninggal'	=> $meninggal_ibu,
				'p_mib_alamat'			=> $this->input->post('almt_ibu'),
				'p_mib_pekerjaan'		=> $this->input->post('kerja_ibu'),
				//'p_mib_update_on'		=> $tanggal,
				'p_mib_update_by'		=> 'admin'
			);
			
		$this->kepegawaian->update_data_mert_ibu($data_mert_ibu);
		
		
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	public function edit_data_anak()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
				
		$nipp = $this->uri->segment(3);
		$data_anak = array(
				'peg_ank_nama'			=> $this->input->post('nama'),
				'peg_ank_tempat_lahir'	=> $this->input->post('tempat'),
				'peg_ank_tgl_lahir'		=> mdate($datestring, strtotime($this->input->post('tanggal'))),
				'peg_ank_pendidikan'	=> $this->input->post('pendidikan'),
				//'p_ank_update_on'		=> $tanggal,
				'p_ank_update_by'		=> 'admin'
			);
		#input data to table pegawai
		$this->kepegawaian->update_data_anak($data_anak);
		redirect('pekerja/get_pegawai/'.$nipp);
		
	}
	
	public function edit_data_jabatan()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		if($this->input->post('tmt_jbt')=='00/00/0000'){$tanggal_tmt_jbt='0000-00-00';}
		else{ $tanggal_tmt_jbt = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt_jbt'))));}
		if($this->input->post('tmt_unt')=='00/00/0000'){$tanggal_tmt_unit='0000-00-00';}
		else{ $tanggal_tmt_unit = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt_unt'))));}
		
		$nipp = $this->uri->segment(3);
		$data_jabatan = array(
				'p_jbt_nipp'		=> $nipp,
				'p_jbt_jabatan'		=> $this->input->post('jabatan'),
				'p_jbt_tmt_start'	=> $tanggal_tmt_jbt,
				//'p_jbt_update_on'	=> $tanggal,
				'p_jbt_update_by'	=> 'admin'
			);
		$data_unit = array(
				'p_unt_nipp'		=> $nipp,
				'p_unt_kode_unit'	=> $this->input->post('unit'),
				'p_unt_kode_sub_unit'	=> $this->input->post('sub_unit'),
				'p_unt_team'		=> $this->input->post('team'),
				'p_unt_tmt_start'	=> $tanggal_tmt_unit,
				//'p_unt_update_on'	=> $tanggal,
				'p_unt_update_by'	=> 'admin'
			);
		
		$data_grade = array(
				'p_grd_nipp'		=> $nipp,
				'p_grd_grade'		=> $this->input->post('grade'),
				//'p_grd_update_on'	=> $tanggal,
				'p_grd_update_by'	=> 'admin'
			);
		
		
		if ($tanggal_tmt_jbt !== '0000-00-00'){
			$data_jabatan_tmt_end = array ('p_jbt_tmt_end' => $tanggal);
			$this->kepegawaian->update_data_pegawai_jabatan($data_jabatan_tmt_end,$this->input->post('id_peg_jbt'));
			$this->kepegawaian->insert_data_pegawai_jabatan($data_jabatan);
		}
		if ($tanggal_tmt_unit !== '0000-00-00'){
			$data_unit_tmt_end = array ('p_unt_tmt_end' => $tanggal);
			$this->kepegawaian->update_data_pegawai_unit($data_unit_tmt_end,$this->input->post('id_peg_unit'));
			$this->kepegawaian->insert_data_pegawai_unit($data_unit);
		}		
				
		#input data to table pegawai
		if($this->input->post('grade') !== 0){
			$this->kepegawaian->insert_data_pegawai_grade($data_grade);
		}
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	
	public function edit_data_provider()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		#validation
		$this->load->library('form_validation');
		$this->form_validation->set_rules('nipp_baru', 'nipp_baru', 'required');
		$nipp = $this->uri->segment(3);
		
		if ($this->form_validation->run() == FALSE)
		{
			redirect('pekerja/edit_provider_pegawai/'.$nipp);
		}
		else
		{
		
		$tanggal_tmt = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tmt'))));
		$nipp_baru = $this->input->post('nipp_baru');
		
		# data provider baru
		$data_jabatan = array(
				'p_jbt_nipp'		=> $nipp_baru,
				'p_jbt_jabatan'		=> $this->input->post('jabatan'),
				'p_jbt_tmt_start'	=> $tanggal_tmt,
				//'p_jbt_update_on'	=> $tanggal,
				'p_jbt_update_by'	=> username(),
			);
			
		$data_unit = array(
				'p_unt_nipp'		=> $nipp_baru,
				'p_unt_kode_unit'	=> $this->input->post('unit'),
				'p_unt_kode_sub_unit'	=> $this->input->post('sub_unit'),
				'p_unt_tmt_start'	=> $tanggal_tmt,
				//'p_unt_update_on'	=> $tanggal,
				'p_unt_update_by'	=> username(),
			);
		
		$data_grade = array(
				'p_grd_nipp'		=> $nipp_baru,
				'p_grd_grade'		=> $this->input->post('grade'),
				//'p_grd_update_on'	=> $tanggal,
				'p_grd_update_by'	=> username(),
			);
			
		$data_tmt = array(
				'p_tmt_nipp'		=> $nipp_baru,
				'p_tmt_status'		=> $this->input->post('status'),
				'p_tmt_provider'	=> $this->input->post('provider'),
				'p_tmt_tmt'			=> $tanggal_tmt,
				//'p_tmt_update_on'	=> $tanggal,
				'p_tmt_update_by'	=> username(),
			);
		
		$data_jabatan_tmt_end = array ('p_jbt_tmt_end' => $tanggal);
		$data_unit_tmt_end = array ('p_unt_tmt_end' => $tanggal);
		$this->kepegawaian->update_data_pegawai_jabatan($data_jabatan_tmt_end,$this->input->post('id_peg_jabatan'));
		$this->kepegawaian->update_data_pegawai_unit($data_unit_tmt_end,$this->input->post('id_peg_unit'));
		
		$data_update_tmt = array (
				'p_tmt_end' 	=> $tanggal,
				'p_tmt_reason'	=> "PHK",
				'p_tmt_ket'		=> "Pindah Provider",
			);
			
		$id_tmt = $this->kepegawaian->get_last_tmt_by_nipp($nipp);
		
		
		#input data to table pegawai
				
		$this->kepegawaian->insert_data_pegawai_jabatan($data_jabatan);
		$this->kepegawaian->update_data_last_tmt($data_update_tmt,$id_tmt); //update tmt terakhir 
		$this->kepegawaian->insert_data_pegawai_tmt($data_tmt);
		//$this->kepegawaian->insert_data_pegawai_grade($data_grade);
		
		#copy data pegawai 
		$this->copy_data_pegawai($nipp,$nipp_baru);
		}
	}
	
	function copy_data_pegawai($nipp,$nipp_baru)
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		#tarik data dari database
		$pegawai= $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		$agama = $this->kepegawaian->get_detail_pegawai_agama($nipp);
		$alamat = $this->kepegawaian->get_detail_pegawai_alamat($nipp);
		$ayah = $this->kepegawaian->get_detail_pegawai_ayah($nipp);
		$bahasa = $this->kepegawaian->get_detail_pegawai_bahasa($nipp);
		$fisik = $this->kepegawaian->get_detail_pegawai_fisik($nipp);
		$ibu = $this->kepegawaian->get_detail_pegawai_ibu($nipp);
		$mert_ayah = $this->kepegawaian->get_detail_pegawai_mert_ayah($nipp);
		$mert_ibu = $this->kepegawaian->get_detail_pegawai_mert_ibu($nipp);
		$pasangan = $this->kepegawaian->get_detail_pegawai_pasangan($nipp);
		$pendidikan = $this->kepegawaian->get_detail_pegawai_pendidikan($nipp);
		$status_keluarga = $this->kepegawaian->get_detail_pegawai_status_keluarga($nipp);
		$tmt = $this->kepegawaian->get_detail_pegawai_tmt($nipp);
		$unit = $this->kepegawaian->get_detail_pegawai_unit($nipp);
		$grade = $this->kepegawaian->get_detail_pegawai_grade($nipp);
		$stkp = $this->kepegawaian->get_detail_pegawai_stkp($nipp);		
		$nstkp = $this->kepegawaian->get_detail_pegawai_nstkp($nipp);		
		$anak = $this->kepegawaian->get_detail_pegawai_anak($nipp);
		$jabatan = $this->kepegawaian->get_last_jabatan($nipp);
		
		echo $nipp;
		#copy data pegawai
		foreach($pegawai as $row_pegawai){}
		$data_pegawai = array(
			'peg_nipp'			=> 	$nipp_baru,
			'peg_nama'			=>	$row_pegawai['peg_nama'],	
			'peg_tmpt_lahir'	=>	$row_pegawai['peg_tmpt_lahir'],
			'peg_tgl_lahir'		=>	$row_pegawai['peg_tgl_lahir'],
			'peg_jns_kelamin'	=>	$row_pegawai['peg_jns_kelamin'],
			'peg_gol_darah'		=>	$row_pegawai['peg_gol_darah'],
			'peg_update_by'		=>	'admin',
		);
		$this->kepegawaian->insert_data_pegawai($data_pegawai);
		
		#copy data agama
		if($agama == NULL){}
		else{
			foreach($agama as $row_agama){}
			$data_agama = array(
				'p_ag_nipp' 	=>	$nipp_baru,
				'p_ag_agama'	=>	$row_agama['p_ag_agama'],
				'p_ag_update_by'=>	'admin',
			);
			$this->kepegawaian->insert_data_pegawai_agama($data_agama);
		}
		
		#copy data alamat
		if($alamat == NULL){}
		else{
			foreach($alamat as $row_alamat){}
			$data_alamat = array(
				'p_al_nipp' 	=>	$nipp_baru,
				'p_al_jalan'	=>	$row_alamat['p_al_jalan'],
				'p_al_kelurahan'=>	$row_alamat['p_al_kelurahan'],
				'p_al_kecamatan'	=>	$row_alamat['p_al_kecamatan'],
				'p_al_kabupaten'	=>	$row_alamat['p_al_kabupaten'],
				'p_al_provinsi'		=>	$row_alamat['p_al_provinsi'],
				'p_al_no_telp'	=>	$row_alamat['p_al_no_telp'],
				'p_al_email'	=>	$row_alamat['p_al_email'],
				'p_al_update_by'=>	'admin',
			);
			$this->kepegawaian->insert_data_pegawai_alamat($data_alamat);
		}
		
		#copy data anak
		if($anak == NULL){}
		else{
			foreach($anak as $row_anak){
			$data_anak = array(
				'peg_ank_nipp' 	=>	$nipp_baru,
				'peg_ank_nama'	=>	$row_anak['peg_ank_nama'],
				'peg_ank_tempat_lahir'	=>	$row_anak['peg_ank_tempat_lahir'],
				'peg_ank_tgl_lahir'		=>	$row_anak['peg_ank_tgl_lahir'],
				'peg_ank_pendidikan'	=>	$row_anak['peg_ank_pendidikan'],
				'peg_ank_jns_kelamin'	=>	$row_anak['peg_ank_jns_kelamin'],
				'peg_ank_agama' 	=>	$row_anak['peg_ank_agama'],
				'peg_ank_status' 	=> $row_anak['peg_ank_status'],
				'p_ank_update_by'=>	'admin',
			);
			$this->kepegawaian->insert_data_pegawai_anak($data_anak);
			}
		}
		
		#copy data ayah
		if($ayah == NULL){}
		else{
			foreach($ayah as $row_ayah){}
			$data_ayah = array(
				'p_ay_nipp' 	=>	$nipp_baru,
				'p_ay_nama'	=>	$row_ayah['p_ay_nama'],
				'p_ay_tmpt_lahir' => $row_ayah['p_ay_tmpt_lahir'],
				'p_ay_tgl_lahir' => $row_ayah['p_ay_tgl_lahir'],
				'p_ay_tgl_meninggal' => $row_ayah['p_ay_tgl_meninggal'],
				'p_ay_alamat' => $row_ayah['p_ay_alamat'],
				'p_ay_pekerjaan' => $row_ayah['p_ay_pekerjaan'],
				'p_ay_update_by'=>	'admin',
			);
			$this->kepegawaian->insert_data_pegawai_ayah($data_ayah);
		}
		
		#copy data ibu
		if($ibu == NULL){}
		else{
			foreach($ibu as $row_ibu){}
			$data_ibu = array(
				'p_ibu_nipp' 	=>	$nipp_baru,
				'p_ibu_nama'	=>	$row_ibu['p_ibu_nama'],
				'p_ibu_tmpt_lahir' => $row_ibu['p_ibu_tmpt_lahir'],
				'p_ibu_tgl_lahir' => $row_ibu['p_ibu_tgl_lahir'],
				'p_ibu_tgl_meninggal' => $row_ibu['p_ibu_tgl_meninggal'],
				'p_ibu_alamat' => $row_ibu['p_ibu_alamat'],
				'p_ibu_pekerjaan' => $row_ibu['p_ibu_pekerjaan'],
				'p_ibu_update_by'=>	'admin',
			);
			$this->kepegawaian->insert_data_pegawai_ibu($data_ibu);
		}
		
		#copy data mertua ayah
		if($mert_ayah == NULL){}
		else{
			foreach($mert_ayah as $row_mert_ayah){}
			$data_mert_ayah = array(
				'p_may_nipp' 	=>	$nipp_baru,
				'p_may_nama'	=>	$row_mert_ayah['p_may_nama'],
				'p_may_tmpt_lahir' => $row_mert_ayah['p_may_tmpt_lahir'],
				'p_may_tgl_lahir' => $row_mert_ayah['p_may_tgl_lahir'],
				'p_may_tgl_meninggal' => $row_mert_ayah['p_may_tgl_meninggal'],
				'p_may_alamat' => $row_mert_ayah['p_may_alamat'],
				'p_may_pekerjaan' => $row_mert_ayah['p_may_pekerjaan'],
				'p_may_update_by'=>	'admin',
			);
			$this->kepegawaian->insert_data_pegawai_mert_ayah($data_mert_ayah);
		}
		
		#copy data ibu
		if($mert_ibu == NULL){}
		else{
			foreach($mert_ibu as $row_mert_ibu){}
			$data_mert_ibu = array(
				'p_mib_nipp' 	=>	$nipp_baru,
				'p_mib_nama'	=>	$row_mert_ibu['p_mib_nama'],
				'p_mib_tmpt_lahir' => $row_mert_ibu['p_mib_tmpt_lahir'],
				'p_mib_tgl_lahir' => $row_mert_ibu['p_mib_tgl_lahir'],
				'p_mib_tgl_meninggal' => $row_mert_ibu['p_mib_tgl_meninggal'],
				'p_mib_alamat' => $row_mert_ibu['p_mib_alamat'],
				'p_mib_pekerjaan' => $row_mert_ibu['p_mib_pekerjaan'],
				'p_mib_update_by'=>	'admin',
			);
			$this->kepegawaian->insert_data_pegawai_mert_ibu($data_mert_ibu);
		}
		
		#copy data fisik
		if($fisik == NULL){}
		else{
			foreach($fisik as $row_fisik){}
			$data_fisik = array(
				'p_fs_nipp' 	=>	$nipp_baru,
				'p_fs_tinggi' 	=>	$row_fisik['p_fs_tinggi'],
				'p_fs_berat' 	=>	$row_fisik['p_fs_berat'],
				'p_fs_foto' 	=>	$row_fisik['p_fs_berat'],
				'p_fs_update_by'=>	'admin',
			);
			$this->kepegawaian->insert_data_pegawai_fisik($data_fisik);
		}
		
		#copy data non stkp
		if($nstkp == NULL){}
		else{
			foreach($nstkp as $row_nstkp){
				$data_nstkp = array(
					'p_nstkp_nipp' 	=>	$nipp_baru,
					'p_nstkp_type' 	=>	$row_nstkp['p_nstkp_type'],
					'p_nstkp_jenis'	=>	$row_nstkp['p_nstkp_jenis'],
					'p_nstkp_lembaga' 	=>	$row_nstkp['p_nstkp_lembaga'],
					'p_nstkp_no_license' 	=>	$row_nstkp['p_nstkp_no_license'],
					'p_nstkp_pelaksanaan' 	=>	$row_nstkp['p_nstkp_pelaksanaan'],
					'p_nstkp_selesai' 	=>	$row_nstkp['p_nstkp_selesai'],
					'p_nstkp_update_by'=>	'admin',
				);
				$this->kepegawaian->insert_data_pegawai_nstkp($data_nstkp);
			}
		}
		
		#copy data stkp
		if($stkp == NULL){}
		else{
			foreach($stkp as $row_stkp){
				$data_stkp = array(
					'p_stkp_nipp' 	=>	$nipp_baru,
					'p_stkp_type' 	=>	$row_stkp['p_stkp_type'],
					'p_stkp_jenis'	=>	$row_stkp['p_stkp_jenis'],
					'p_stkp_rating'	=>	$row_stkp['p_stkp_rating'],
					'p_stkp_lembaga' 	=>	$row_stkp['p_stkp_lembaga'],
					'p_stkp_no_license' 	=>	$row_stkp['p_stkp_no_license'],
					'p_stkp_pelaksanaan' 	=>	$row_stkp['p_stkp_pelaksanaan'],
					'p_stkp_selesai' 	=>	$row_stkp['p_stkp_selesai'],
					'p_stkp_mulai' 	=>	$row_stkp['p_stkp_mulai'],
					'p_stkp_finish' 	=>	$row_stkp['p_stkp_finish'],
					'p_stkp_update_by'=>	'admin',
				);
				$this->kepegawaian->insert_data_pegawai_stkp($data_stkp);
			}
		}
		
		#copy data pasangan
		if($pasangan == NULL){}
		else{
			foreach($pasangan as $row_pasangan){}
			$data_pasangan = array(
				'p_ps_nipp' 	=>	$nipp_baru,
				'p_ps_nama'		=>	$row_pasangan['p_ps_nama'],
				'p_ps_tmpt_lahir'	=>	$row_pasangan['p_ps_tmpt_lahir'],
				'p_ps_tgl_lahir'	=>	$row_pasangan['p_ps_tgl_lahir'],
				'p_ps_tgl_meninggal'=>	$row_pasangan['p_ps_tgl_meninggal'],
				'p_ps_alamat'		=>	$row_pasangan['p_ps_alamat'],
				'p_ps_jns_kelamin'	=>	$row_pasangan['p_ps_jns_kelamin'],
				'p_ps_agama' 	=>	$row_pasangan['p_ps_agama'],
				'p_ps_pekerjaan' 	=> $row_pasangan['p_ps_pekerjaan'],
				'p_ps_update_by'=>	'admin',
			);
			$this->kepegawaian->insert_data_pegawai_pasangan($data_pasangan);
		}
		
		#copy data pendidikan
		if($pendidikan == NULL){}
		else{
			foreach($pendidikan as $row_pendidikan){
				$data_pendidikan = array(
					'p_pdd_nipp' 	=>	$nipp_baru,
					'p_pdd_tingkat'	=>	$row_pendidikan['p_pdd_tingkat'],
					'p_pdd_lp'		=>	$row_pendidikan['p_pdd_lp'],
					'p_pdd_masuk'		=>	$row_pendidikan['p_pdd_masuk'],
					'p_pdd_keluar'		=>	$row_pendidikan['p_pdd_keluar'],
					'p_pdd_update_by'=>	'admin',
				);
				$this->kepegawaian->insert_data_pegawai_pendidikan($data_pendidikan);
			}
		}
		
		#copy data status keluarga
		if($status_keluarga == NULL){}
		else{
			foreach($status_keluarga as $row_stk){}
				$data_stk = array(
					'p_stk_nipp' 	=>	$nipp_baru,
					'p_stk_status_keluarga' => $row_stk['p_stk_status_keluarga'],
					'p_stk_update_by'=>	'admin',
				);
				$this->kepegawaian->insert_data_pegawai_status_keluarga($data_stk);
		}
		
		//redirect setelah proses selesai
		redirect('pekerja/get_pegawai/'.$nipp_baru);
	}
	
	public function edit_data_pendidikan()
	{
		#preparing date update
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
					
		$nipp = $this->uri->segment(3);
		$data_pendidikan = array(
				'p_pdd_tingkat'		=> $this->input->post('pendidikan'),
				'p_pdd_lp'			=> $this->input->post('lp'),
				'p_pdd_masuk'		=> $this->input->post('masuk'),
				'p_pdd_keluar'		=> $this->input->post('keluar'),
				//'p_pdd_update_on'	=> $tanggal,
				'p_pdd_update_by'	=> 'admin'
			);
		
		$this->kepegawaian->update_data_pendidikan($data_pendidikan);
		
		$data_id_bahasa = $this->kepegawaian->get_detail_pegawai_bahasa($nipp);
		$nomer = 1;
		foreach ($data_id_bahasa as $row_bahasa) :
		{
			$data_bahasa = array(
					'p_bhs_bahasa'		=> $this->input->post('bahasa'.$nomer),
					//'p_bhs_update_on'	=> $tanggal,
					'p_bhs_update_by'	=> 'admin'
				);
			$id_bahasa = $row_bahasa['id_peg_bahasa'];
			$nomer++;
			$this->kepegawaian->update_data_bahasa($data_bahasa, $id_bahasa);
		} endforeach;
		#input data to table pegawai
		$this->kepegawaian->update_data_pendidikan($data_pendidikan);
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	function view_data_sdm()
	{
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/view_data_sdm/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->countPegawai(); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		$data['count'] = $config['total_rows'];
		$data['page'] = 'Data SDM';
		$data['page_karyawan'] = 'yes';
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_full($config['per_page'],$page);
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		//print_r($data['pegawai']);
		$this->load->view('kepegawaian/index', $data);
	}

	function search_data_sdm()
	{
		
		if ($this->input->post('unit')==NULL)
		{
			$search_unit = $this->uri->segment(3);
			$search_data = $this->uri->segment(4);
		}else{
			$search_unit = $this->input->post('unit');
			if ($this->input->post('search') == ""){$search_data = 'ALL'; }
			else{$search_data = $this->input->post('search');}
			//echo $this->input->post('search')."---$search_unit$search_data--kasldkaslk";
		}
		
		
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/search_data_sdm/'.$search_unit.'/'.$search_data.'/'; //set the base url for pagination
		#$config['total_rows'] = $this->kepegawaian->count_search_pegawai($search_data); //total rows
		$config['total_rows'] = $this->kepegawaian->count_search_pegawai_unit($search_data,$search_unit); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 5; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
		
		$data['count'] = $config['total_rows'];
		$data['page'] = 'Data SDM';
		$data['page_karyawan'] = 'yes';
		#$data['pegawai'] = $this->kepegawaian->search_data_pegawai_full($config['per_page'],$page,$search_data);
		$data['pegawai'] = $this->kepegawaian->search_data_pegawai_full_unit($config['per_page'],$page,$search_data,$search_unit);
		$data['list_unit'] = $this->kepegawaian->get_list_unit();
		//print_r($data['pegawai']);
		$this->load->view('kepegawaian/index', $data);
	}
	
	function print_kompetensi($nipp)
	{
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		$data['data_agama'] = $this->kepegawaian->get_detail_pegawai_agama($nipp);
		$data['data_alamat'] = $this->kepegawaian->get_detail_pegawai_alamat($nipp);
		$data['data_bahasa'] = $this->kepegawaian->get_detail_pegawai_bahasa($nipp);
		$data['data_fisik'] = $this->kepegawaian->get_detail_pegawai_fisik($nipp);
		$data['data_jabatan_tmt'] = $this->kepegawaian->get_detail_pegawai_jabatan_tmt($nipp);
		$data['data_pendidikan'] = $this->kepegawaian->get_detail_pegawai_pendidikan($nipp);
		$data['data_status_keluarga'] = $this->kepegawaian->get_detail_pegawai_status_keluarga($nipp);
		$data['data_tmt'] = $this->kepegawaian->get_detail_pegawai_tmt($nipp);
		$data['data_unit'] = $this->kepegawaian->get_detail_pegawai_unit($nipp);
		$data['data_grade'] = $this->kepegawaian->get_detail_pegawai_grade($nipp);
		$data['data_stkp'] = $this->kepegawaian->get_detail_pegawai_stkp($nipp);
		$data['data_nstkp'] = $this->kepegawaian->get_detail_pegawai_nstkp($nipp);
		$data['jumlah_bahasa'] = $this->kepegawaian->count_result_bahasa($nipp);
		$data['data_pendidikan_full'] = $this->kepegawaian->get_detail_pegawai_pendidikan_full($nipp);
		
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		$this->load->view('kepegawaian/print/data_kompetensi',$data);	
	?>	<script>window.print();	</script>
	<?php
	}
	
	
	function print_detail_pegawai($nipp)
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
		$data['data_jabatan_detail'] = $this->kepegawaian->get_detail_pegawai_jabatan($nipp);
		$data['riwayat_jabatan'] = $this->kepegawaian->get_riwayat_jabatan($nipp);
		$data['riwayat_golongan'] = $this->kepegawaian->get_riwayat_golongan($nipp);
		$data['riwayat_sanksi'] = $this->kepegawaian->get_riwayat_sanksi($nipp);
		
		#count data
		$data['jumlah_bahasa'] = $this->kepegawaian->count_result_bahasa($nipp);
		
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		$this->load->view('kepegawaian/print/detail_pegawai',$data);	
	?>	<script>window.print();	</script>
	<?php
	}
	
	function print_detail_pegawai_pdf($nipp)
	{
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		$data['data_alamat'] = $this->kepegawaian->get_detail_pegawai_alamat($nipp);
		$data['data_tmt'] = $this->kepegawaian->get_latest_tmt_pegawai_by_nipp($nipp);
		$data['data_jabatan'] = $this->kepegawaian->get_last_jabatan($nipp);
		$data['data_unit'] = $this->kepegawaian->get_latest_unit_pegawai_by_nipp($nipp);
		$data['data_grade'] = $this->kepegawaian->get_last_grade_by_nipp($nipp);
		$data['riwayat_jabatan'] = $this->kepegawaian->get_riwayat_jabatan($nipp);
		$data['riwayat_golongan'] = $this->kepegawaian->get_riwayat_golongan($nipp);
		$data['riwayat_sanksi'] = $this->kepegawaian->get_riwayat_sanksi($nipp);
		$data['data_pendidikan'] = $this->kepegawaian->get_detail_pegawai_pendidikan($nipp);
		$data['data_nstkp'] = $this->kepegawaian->get_detail_pegawai_nstkp($nipp);
		$data['data_pasangan'] = $this->kepegawaian->get_detail_pegawai_pasangan($nipp);
		$data['data_anak'] = $this->kepegawaian->get_detail_pegawai_anak($nipp);
	
		
		$monthstring = "%m" ;
		$yearstring = "%Y" ;
		$time = time();
		$data['month'] = mdate($monthstring, $time);
		$data['year'] = mdate($yearstring, $time);
		
		
		$this->load->helper('skm_pdf');
		$stream = TRUE; 
		$papersize = 'letter'; 
		$orientation = 'portrait';
		$filename = "Curriculum Vitae  ".$nipp;
		$stn = "DPS";
		$html = $this->load->view('kepegawaian/print/detail_pegawai_pdf',$data, true); 
     	pdf_create($html, $filename, $stream, $papersize, $orientation);
		$full_filename = $filename . '.pdf';
	}
	
	
	
	# Function untuk delete pegawai
	public function submit_delete_pegawai()
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		if($this->input->post('tanggal')=="00-00-0000"){$tmt="0000-00-00";}
		else{$tmt = mdate($datestring, strtotime($this->input->post('tanggal')));}
		
		$nipp = $this->uri->segment(3);
		
		if ($this->input->post('reason') == "Pindah Cabang"){
			if ($this->input->post('cabang') == ""){
				redirect('pekerja/get_pegawai/'.$nipp);
			}
			else { 
				$data_pegawai = array(
						"p_cab_nipp"		=> $nipp,
						"p_cab_kode_cabang"	=> $this->input->post('cabang'),
						"p_cab_tmt_start"	=> $tmt,
						"p_cab_ket"			=> $this->input->post('ket'),
					//	"p_cab_update_on"	=> $tanggal,
						"p_cab_update_by"	=> 'admin',
					);
				
				$data_peg_tmt = array(
						"p_tmt_end"			=> $tmt,
						"p_tmt_reason"		=> $this->input->post('reason'),
						"p_tmt_ket"	=> $this->input->post('ket'),
						
					);
				
				#ubah tmt end
				$id_tmt = $this->kepegawaian->get_last_tmt_by_nipp($nipp);
				if ($id_tmt !== NULL){
					$this->kepegawaian->update_tmt_end($id_tmt,$data_peg_tmt);
				}
				
				#add data pegawai ke pindah cabang
				$this->kepegawaian->add_pindah_cabang($data_pegawai);
				
				redirect('pekerja');
			}
		}

		else {
			$data_peg_tmt = array(
						"p_tmt_end"			=> $tmt,
						"p_tmt_reason"		=> $this->input->post('reason'),
						"p_tmt_ket"	=> $this->input->post('ket'),
						
					);
					
			#ubah tmt end
			$id_tmt = $this->kepegawaian->get_last_tmt_by_nipp($nipp);
			if ($id_tmt !== NULL){
				$this->kepegawaian->update_tmt_end($id_tmt,$data_peg_tmt);
			}
						
			redirect('pekerja');
		}
		/*
		if ($this->input->post('reason') == "Pensiun Dini"){
		}
		if ($this->input->post('reason') == "Pensiun"){
		}
		if ($this->input->post('reason') == "Pemutusan Hubungan Kerja"){
		}
		if ($this->input->post('reason') == "Other"){
		}
		*/
		//$this->load->view('kepegawaian/index', $data);
	}
	
	function submit_aktifkan_pegawai($nipp)
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$data_peg_tmt = array(
					"p_tmt_ket"		=> "aktif",
					);
					
		#ubah tmt end
		$id_tmt = $this->kepegawaian->get_last_tmt_by_nipp($nipp);
		if ($id_tmt !== NULL){
			$this->kepegawaian->update_tmt_end($id_tmt,$data_peg_tmt);
		}
		
		#pengaktifan kembali
		$tmt_start = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal'))));
			
		$data_tmt = array(
				'p_tmt_nipp'		=> $nipp,
				'p_tmt_status'		=> $this->input->post('status'),
				'p_tmt_provider'	=> $this->input->post('provider'),
				'p_tmt_tmt'			=> $tmt_start,
				'p_tmt_update_by'	=> 'admin'
			);
		
		$this->kepegawaian->insert_data_pegawai_tmt($data_tmt);
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	function delete_data_anak($id,$nipp)
	{
		
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$stk = $this->kepegawaian->get_new_pegawai_status_keluarga($nipp,'delete');
			
		$data_stk = array(
					'p_stk_nipp' 			  => $nipp,
					'p_stk_status_keluarga'   => $stk,
					//'p_stk_update_on'		  => $tanggal,
					'p_stk_update_by'		  => 'admin'
				);
			
		$this->kepegawaian->delete_data_anak($id);
		$this->kepegawaian->insert_data_pegawai_status_keluarga($data_stk);	
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	public function edit_ppb_pegawai(){
		$nipp = $this->uri->segment(3);
		$data['nipp'] = $nipp;
		$data['ppb']  = $this->kepegawaian->get_data_ppb($nipp);
		$data['page'] = 'Edit PPB';
		$data['view_ppb'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		$this->load->view('kepegawaian/index',$data);
	}
	
	function submit_ppb_pegawai(){
		$datestring = "%Y-%m-%d" ;
		if ($this->input->post('tanggal') == '00/00/0000'){$tanggal = "00-00-0000";}
		else { $tanggal = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal'))));}
		$data = array(
						"p_ppb_nipp"	=> $this->input->post('nipp'),
						"p_ppb_tanggal"	=> $tanggal,
						"p_ppb_status"	=> $this->input->post('status_ppb'),
						"p_ppb_update_by" => username(),
			);
		$this->kepegawaian->insert_data_ppb($data);
		redirect('pekerja/pegawai_ppb');
	}
	
	# Export Excel
	function excel_data_pegawai()
	{
		//pengalokasian memory untuk run this function
		ini_set("memory_limit","300M");
		
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$pegawai = $this->kepegawaian->get_data_pegawai_unlimited();
				
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle("Data Pegawai ");
		//set cell A1 content with some text
		//JUDUL KOP
		$this->excel->getActiveSheet()->setCellValue('A2', 'DATA PEGAWAI');
		$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
		$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
		
		$this->excel->getActiveSheet()->setCellValue('A6', 'No');
		$this->excel->getActiveSheet()->setCellValue('B6', 'NIPP');
		$this->excel->getActiveSheet()->setCellValue('C6', 'Nama');
		$this->excel->getActiveSheet()->setCellValue('D6', 'Tempat Lahir');
		$this->excel->getActiveSheet()->setCellValue('E6', 'Tanggal Lahir');
		$this->excel->getActiveSheet()->setCellValue('F6', 'Jenis Kelamin');
		$this->excel->getActiveSheet()->setCellValue('G6', 'Golongan Darah');
		$this->excel->getActiveSheet()->setCellValue('H6', 'Agama');
		$this->excel->getActiveSheet()->setCellValue('I6', 'No Telepon');
		$this->excel->getActiveSheet()->setCellValue('J6', 'Email');
		$this->excel->getActiveSheet()->setCellValue('K6', 'Alamat');
		
		$this->excel->getActiveSheet()->setCellValue('K7', 'Jalan');
		$this->excel->getActiveSheet()->setCellValue('L7', 'Kelurahan');
		$this->excel->getActiveSheet()->setCellValue('M7', 'Kecamatan');
		$this->excel->getActiveSheet()->setCellValue('N7', 'Kabupaten');
		$this->excel->getActiveSheet()->setCellValue('O7', 'Provinsi');
		
		$i=7;
		$number=0;
		$unit="kosong";
		$sub_unit="kosong";
		
		$nipp = '';
		foreach ($pegawai as $row_pegawai) :
		{ 
			$i++;
			$number++;
			if($row_pegawai['peg_jns_kelamin'] == "P"){ $jk="Perempuan"; }
			else{$jk="Laki-Laki";}
			if ($row_pegawai['peg_tgl_lahir'] == "0000-00-00" ){ $tgl_lahir = "-";}
			else{$tgl_lahir = mdate("%d-%m-%Y",strtotime($row_pegawai['peg_tgl_lahir']));}
			 
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
			
			//masukkan data ke tabel excel
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", "$row_pegawai[peg_nipp]");
			$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$row_pegawai[peg_nama]"));
			$this->excel->getActiveSheet()->setCellValue("D$i", "$row_pegawai[peg_tmpt_lahir]");
			$this->excel->getActiveSheet()->setCellValue("E$i", "$tgl_lahir");
			$this->excel->getActiveSheet()->setCellValue("F$i", "$jk");
			$this->excel->getActiveSheet()->setCellValue("G$i", "$row_pegawai[peg_gol_darah]");
			$this->excel->getActiveSheet()->setCellValue("H$i", "$row_pegawai[p_ag_agama]");
			$this->excel->getActiveSheet()->setCellValue("I$i", "'$row_pegawai[p_al_no_telp]");
			$this->excel->getActiveSheet()->setCellValue("J$i", "$row_pegawai[p_al_email]");
			$this->excel->getActiveSheet()->setCellValue("K$i", "$row_pegawai[p_al_jalan]");
			$this->excel->getActiveSheet()->setCellValue("L$i", "$row_pegawai[p_al_kelurahan]");
			$this->excel->getActiveSheet()->setCellValue("M$i", "$row_pegawai[p_al_kecamatan]");
			$this->excel->getActiveSheet()->setCellValue("N$i", "$row_pegawai[p_al_kabupaten]");
			$this->excel->getActiveSheet()->setCellValue("O$i", "$row_pegawai[p_al_provinsi]");
		
			$unit = $row_pegawai['p_unt_kode_unit'];
			$sub_unit = $row_pegawai['p_unt_kode_sub_unit'];
		}endforeach;
		
		//change the font size
		$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
		$this->excel->getActiveSheet()->getStyle("A6:O7")->getFont()->setSize(12);
		$this->excel->getActiveSheet()->getStyle("A8:O$i")->getFont()->setSize(8);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A6:K6')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('G7:H7')->getFont()->setBold(true);
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A6:A7');
		$this->excel->getActiveSheet()->mergeCells('B6:B7');
		$this->excel->getActiveSheet()->mergeCells('C6:C7');
		$this->excel->getActiveSheet()->mergeCells('D6:D7');
		$this->excel->getActiveSheet()->mergeCells('E6:E7');
		$this->excel->getActiveSheet()->mergeCells('F6:F7');
		$this->excel->getActiveSheet()->mergeCells('G6:G7');
		$this->excel->getActiveSheet()->mergeCells('H6:H7');
		$this->excel->getActiveSheet()->mergeCells('I6:I7');
		$this->excel->getActiveSheet()->mergeCells('J6:J7');
		$this->excel->getActiveSheet()->mergeCells('K6:O6');
		$this->excel->getActiveSheet()->mergeCells('A2:H2');
		$this->excel->getActiveSheet()->mergeCells('A3:H3');
		$this->excel->getActiveSheet()->mergeCells('A4:H4');
		
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A6:O6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A6:O6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		//Set column widths                                                       
		$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
		$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(10.75); 
		$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(26);    
		$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(20.5);  
		$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10.88); 
		$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10.88); 
		$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(14.63); 
		$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.88); 
		$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(14.88); 
		$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(25.88); 
		$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(35.88); 
		$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15.88); 
		$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15.88); 
		$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15.88); 
		$this->excel->getActiveSheet()->getColumnDimension('O')->setWidth(15.88); 
		
		 
		$filename="Data Pegawai.xls"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	
	function excel_data_pensiun()
	{
		$datestring = "%Y" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$type = '52';
		$limit = '100';
		
		$pegawai = $this->kepegawaian->get_data_pensiun_unlimited($tanggal,$type,$limit);
				
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle("Data Pegawai Pensiun ");
		//set cell A1 content with some text
		
		$this->excel->getActiveSheet()->setCellValue('A1', 'NO');
		$this->excel->getActiveSheet()->setCellValue('B1', 'NIPP');
		$this->excel->getActiveSheet()->setCellValue('C1', 'NAMA');
		$this->excel->getActiveSheet()->setCellValue('D1', 'TEMPAT LAHIR');
		$this->excel->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$this->excel->getActiveSheet()->setCellValue('F1', 'JENIS KELAMIN');
		$this->excel->getActiveSheet()->setCellValue('G1', 'GOLONGAN DARAH');
		$this->excel->getActiveSheet()->setCellValue('H1', 'TMT');
		
		
		$i=1;
		$number=0;
		
		$nipp = '';
		foreach ($pegawai as $row_pegawai) :
		{ 
			$i++;
			$number++;
			if($row_pegawai['peg_jns_kelamin'] == "P"){ $jk="Perempuan"; }
			else{$jk="Laki-Laki";}
			
						
			//masukkan data ke tabel excel
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", "$row_pegawai[peg_nipp]");
			$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$row_pegawai[peg_nama]"));
			$this->excel->getActiveSheet()->setCellValue("D$i", "$row_pegawai[peg_tmpt_lahir]");
			$this->excel->getActiveSheet()->setCellValue("E$i", mdate("%d-%m-%Y",strtotime($row_pegawai['peg_tgl_lahir'])));
			$this->excel->getActiveSheet()->setCellValue("F$i", "$jk");
			$this->excel->getActiveSheet()->setCellValue("G$i", "$row_pegawai[peg_gol_darah]");
			$this->excel->getActiveSheet()->setCellValue("H$i", mdate("%d-%m-%Y",strtotime($row_pegawai['p_tmt_tmt'])));
			
		}endforeach;
		
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setSize(14);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:H1')->getFont()->setBold(true);
		//merge cell A1 until D1
		
		
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		 
		$filename="Data Pegawai Pensiun.xls"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}
	
	function excel_data_supervisor()
	{
		$datestring = "%Y" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$supervisor = $this->kepegawaian->get_data_spv_unlimited();
				
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle("Data Supervisor ");
		//set cell A1 content with some text
		
		$this->excel->getActiveSheet()->setCellValue('A1', 'NO');
		$this->excel->getActiveSheet()->setCellValue('B1', 'NO UNIT');
		$this->excel->getActiveSheet()->setCellValue('C1', 'NIPP');
		$this->excel->getActiveSheet()->setCellValue('D1', 'NAMA PEGAWAI');
		$this->excel->getActiveSheet()->setCellValue('E1', 'GRADE');
		$this->excel->getActiveSheet()->setCellValue('F1', 'M.K.A');
		$this->excel->getActiveSheet()->setCellValue('G1', 'T.M.T GA/GS');
		$this->excel->getActiveSheet()->setCellValue('H1', 'JENIS KELAMIN');
		$this->excel->getActiveSheet()->setCellValue('I1', 'TGL LAHIR');
		$this->excel->getActiveSheet()->setCellValue('J1', 'UMUR');
		$this->excel->getActiveSheet()->setCellValue('K1', 'T.M.T MUTASI');
		$this->excel->getActiveSheet()->setCellValue('L1', 'JABATAN');
		
		
		$i=1;
		$number=0;
		
		$nipp = '';
		foreach ($supervisor as $row_supervisor) :
		{ 
			$datestring = "%d-%m-%Y" ;
			$tgl_lahir = mdate($datestring,strtotime($row_supervisor['peg_tgl_lahir']));
			$umur=floor(($time - strtotime($row_supervisor['peg_tgl_lahir']))/(365*24*60*60));
			
			if ($row_supervisor['p_grd_grade'] == NULL)
			{
				$grade = '-';
			}
			else
			{
				$grade = $row_supervisor['p_grd_grade'];
			}
			if (($row_supervisor['p_tmt_tmt'] == NULL) OR ($row_supervisor['p_tmt_tmt'] == '0000-00-00'))
			{
				$tmt = '-';
				$mka = '-';
			}
			else
			{
				$tmt = mdate($datestring,strtotime($row_supervisor['p_tmt_tmt']));
				$mka = floor(($time-strtotime($row_supervisor['p_tmt_tmt']))/(365*24*60*60));
			}			
			
			
			
			$i++;
			$number++;
			if($row_supervisor['peg_jns_kelamin'] == "P"){ $jk="Perempuan"; }
			else{$jk="Laki-Laki";}
			
						
			//masukkan data ke tabel excel
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", "$row_supervisor[p_unt_kode_unit]");
			$this->excel->getActiveSheet()->setCellValue("C$i", "$row_supervisor[peg_nipp]");
			$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_supervisor[peg_nama]"));
			$this->excel->getActiveSheet()->setCellValue("E$i", "$grade");
			$this->excel->getActiveSheet()->setCellValue("F$i", "$mka");
			$this->excel->getActiveSheet()->setCellValue("G$i", "$tmt");
			$this->excel->getActiveSheet()->setCellValue("H$i", "$jk");
			$this->excel->getActiveSheet()->setCellValue("I$i", mdate("%d-%m-%Y",strtotime($row_supervisor['peg_tgl_lahir'])));
			$this->excel->getActiveSheet()->setCellValue("J$i", "$umur");
			$this->excel->getActiveSheet()->setCellValue("K$i", "-");
			$this->excel->getActiveSheet()->setCellValue("L$i", "$row_supervisor[p_jbt_jabatan]");
			
			
		}endforeach;
		
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setSize(14);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
		//merge cell A1 until D1
		
		
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		 
		$filename="Data Supervisor.xls"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}
	
	function excel_data_sdm()
	{
		$datestring = "%Y" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$sdm = $this->kepegawaian->get_data_sdm_unlimited();
						
		//load our new PHPExcel library
		$this->load->library('excel');
		//activate worksheet number 1
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle("Data SDM ");
		//set cell A1 content with some text
		
		$this->excel->getActiveSheet()->setCellValue('A1', 'NO');
		$this->excel->getActiveSheet()->setCellValue('B1', 'NIPP');
		$this->excel->getActiveSheet()->setCellValue('C1', 'NAMA');
		$this->excel->getActiveSheet()->setCellValue('D1', 'TEMPAT LAHIR');
		$this->excel->getActiveSheet()->setCellValue('E1', 'TANGGAL LAHIR');
		$this->excel->getActiveSheet()->setCellValue('F1', 'UMUR');
		$this->excel->getActiveSheet()->setCellValue('G1', 'JENIS KELAMIN');
		$this->excel->getActiveSheet()->setCellValue('H1', 'STATUS');
		$this->excel->getActiveSheet()->setCellValue('I1', 'STATUS KAWIN');
		$this->excel->getActiveSheet()->setCellValue('J1', 'ALAMAT');
		$this->excel->getActiveSheet()->setCellValue('K1', 'NO TELP');
		$this->excel->getActiveSheet()->setCellValue('L1', 'AGAMA');
		
		
		$i=2;
		$number=0;
		
		$nipp = '';
		foreach ($sdm as $row_sdm) :
		{ 
			$datestring = "%d-%M-%Y" ;
			$tgl_lahir = mdate($datestring,strtotime($row_sdm['peg_tgl_lahir']));
			$umur=floor(($time - strtotime($row_sdm['peg_tgl_lahir']))/(365*24*60*60));
			$umur_ps=floor(($time - strtotime($row_sdm['p_ps_tgl_lahir']))/(365*24*60*60));
			//$alamat = $row_sdm['p_al_jalan'].' '.$row_sdm['p_al_kelurahan'].' '.$row_sdm['p_al_kecamatan'].' '.$row_sdm'p_al_kabupaten'].' '.$row_sdm['p_al_provinsi'];
			$alamat = '';
			$anak = $this->kepegawaian->get_detail_pegawai_anak($row_sdm['peg_nipp']);
			$jumlah_anak = $this->kepegawaian->count_data_jumlah_anak($row_sdm['peg_nipp']);
			
			if ($row_sdm['peg_jns_kelamin'] == 'L')
				{
					$status_ps = 'ISTERI';
					$sex_ps = 'P';
				} else 
				{
					$status_ps = 'SUAMI';
					$sex_ps = 'L';
				}
			
			$i++;
			$number++;
			$merge_start = $i;
						
			//masukkan data ke tabel excel
			//data pegawai
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", "$row_sdm[peg_nipp]");
			$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$row_sdm[peg_nama]"));
			$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_sdm[peg_tmpt_lahir]"));
			$this->excel->getActiveSheet()->setCellValue("E$i", "$tgl_lahir");
			$this->excel->getActiveSheet()->setCellValue("F$i", "$umur");
			$this->excel->getActiveSheet()->setCellValue("G$i", strtoupper("$row_sdm[peg_jns_kelamin]"));
			$this->excel->getActiveSheet()->setCellValue("H$i", strtoupper("PEGAWAI"));
			$this->excel->getActiveSheet()->setCellValue("I$i", strtoupper("$row_sdm[p_stk_status_keluarga]"));
			$this->excel->getActiveSheet()->setCellValue("J$i", strtoupper(" $row_sdm[p_al_jalan] $row_sdm[p_al_kelurahan] $row_sdm[p_al_kecamatan] $row_sdm[p_al_kabupaten] $row_sdm[p_al_provinsi]"));
			$this->excel->getActiveSheet()->setCellValue("K$i", strtoupper("$row_sdm[p_al_no_telp]"));
			$this->excel->getActiveSheet()->setCellValue("L$i", strtoupper("$row_sdm[p_ag_agama]"));
			//data pasangan
			$i++;
			$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$row_sdm[p_ps_nama]"));
			$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_sdm[p_ps_tmpt_lahir]"));
			$this->excel->getActiveSheet()->setCellValue("E$i", mdate($datestring,strtotime("$row_sdm[p_ps_tgl_lahir]")));
			$this->excel->getActiveSheet()->setCellValue("F$i", "$umur_ps");
			$this->excel->getActiveSheet()->setCellValue("G$i", "$sex_ps");
			$this->excel->getActiveSheet()->setCellValue("H$i", "$status_ps");
			$this->excel->getActiveSheet()->setCellValue("I$i", strtoupper("$row_sdm[p_stk_status_keluarga]"));
			$this->excel->getActiveSheet()->setCellValue("L$i", strtoupper("$row_sdm[p_ag_agama]"));
			//data anak
			$num_anak = 1;
			foreach ($anak as $row_anak)
			{
				$umur_ank=floor(($time - strtotime($row_anak['peg_ank_tgl_lahir']))/(365*24*60*60));
				$i++;
				$this->excel->getActiveSheet()->setCellValue("C$i", strtoupper("$row_anak[peg_ank_nama]"));
				$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_anak[peg_ank_tempat_lahir]"));
				$this->excel->getActiveSheet()->setCellValue("E$i", mdate($datestring,strtotime("$row_anak[peg_ank_tgl_lahir]")));
				$this->excel->getActiveSheet()->setCellValue("F$i", "$umur_ank");
				$this->excel->getActiveSheet()->setCellValue("G$i", "$sex_ps");
				$this->excel->getActiveSheet()->setCellValue("H$i", "ANAK $num_anak");
				$this->excel->getActiveSheet()->setCellValue("I$i", strtoupper("$row_sdm[p_stk_status_keluarga]"));
				$this->excel->getActiveSheet()->setCellValue("L$i", strtoupper("$row_sdm[p_ag_agama]"));
				$num_anak++;
			} 
		$i++;
		}endforeach;
		
		//change the font size
		$this->excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setSize(14);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
		//merge cell A1 until D1
		
		
		//set aligment to center for that merged cell (A1 to D1)
		$this->excel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
		
		//merge cell A1 until D1
		$this->excel->getActiveSheet()->mergeCells('A1:A2');
		$this->excel->getActiveSheet()->mergeCells('B1:B2');
		$this->excel->getActiveSheet()->mergeCells('C1:C2');
		$this->excel->getActiveSheet()->mergeCells('D1:D2');
		$this->excel->getActiveSheet()->mergeCells('E1:E2');
		$this->excel->getActiveSheet()->mergeCells('F1:F2');
		$this->excel->getActiveSheet()->mergeCells('G1:G2');
		$this->excel->getActiveSheet()->mergeCells('H1:H2');
		$this->excel->getActiveSheet()->mergeCells('I1:I2');
		$this->excel->getActiveSheet()->mergeCells('J1:J2');
		$this->excel->getActiveSheet()->mergeCells('K1:K2');
		$this->excel->getActiveSheet()->mergeCells('L1:L2');
		 
		$filename="Data SDM.xls"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					 
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
		
	}
	
	function export_detail_pegawai_word()
	{
		$nipp = $this->uri->segment(3);
		$datestring = "%Y" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$sdm = $this->kepegawaian->get_data_sdm_unlimited();
						
		//load our new PHPExcel library
		$this->load->library('word');
		// New Word Document
		$PHPWord = new PHPWord();

		// New portrait section
		$section = $PHPWord->createSection();

		
		$pegawai = $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		$data_alamat = $this->kepegawaian->get_detail_pegawai_alamat($nipp);
		$data_tmt = $this->kepegawaian->get_latest_tmt_pegawai_by_nipp($nipp);
		$data_jabatan = $this->kepegawaian->get_last_jabatan($nipp);
		$data_unit = $this->kepegawaian->get_latest_unit_pegawai_by_nipp($nipp);
		$data_grade = $this->kepegawaian->get_last_grade_by_nipp($nipp);
		$riwayat_jabatan = $this->kepegawaian->get_riwayat_jabatan($nipp);
		$riwayat_golongan = $this->kepegawaian->get_riwayat_golongan($nipp);
		$riwayat_sanksi = $this->kepegawaian->get_riwayat_sanksi($nipp);
		$data_pendidikan = $this->kepegawaian->get_detail_pegawai_pendidikan($nipp);
		$data_nstkp = $this->kepegawaian->get_detail_pegawai_nstkp($nipp);
		$data_pasangan = $this->kepegawaian->get_detail_pegawai_pasangan($nipp);
		$data_anak = $this->kepegawaian->get_detail_pegawai_anak($nipp);
	
		
		$peg_nama="";
		$peg_nipp=$nipp;
		$peg_tmt="";
		$peg_golongan="";
		$peg_jabatan="";
		$peg_unit="";
		$peg_tempatlahir ="";
		$peg_tanggallahir ="";
		$peg_usia ="";
		$peg_jeniskelamin = "";
		$peg_statusmenikah = "";
		$peg_alamatrumah ="";
		$peg_telephone ="";
		foreach($pegawai as $row_pegawai){ 
			$peg_nama=$row_pegawai['peg_nama'];
			$peg_tempatlahir=$row_pegawai['peg_tmpt_lahir'];
			$peg_tanggallahir=$row_pegawai['peg_tgl_lahir'];
			if($row_pegawai['peg_jns_kelamin'] == "L")
			{
				$peg_jeniskelamin = "LAKI-LAKI";
			} else if($row_pegawai['peg_jns_kelamin'] == "P")
			{
				$peg_jeniskelamin = "PEREMPUAN";
			}
			if($peg_tanggallahir > "0000-00-00")
			{
				$now = date('Y-m-d');
				$peg_usia =  floor((strtotime($now) - strtotime($peg_tanggallahir)) / (365*24*60*60));
				$peg_tanggallahir = mdate('%d-%m-%Y',strtotime($peg_tanggallahir));
			}
		}
		foreach($data_alamat as $row_alamat)
		{
			$peg_alamatrumah = $peg_alamatrumah." ".$row_alamat['p_al_jalan']." ".$row_alamat['p_al_jalan']." ".$row_alamat['p_al_kelurahan']." ".$row_alamat['p_al_kelurahan']." ".$row_alamat['p_al_kecamatan']." ".$row_alamat['p_al_kabupaten']." ".$row_alamat['p_al_provinsi'].". ";
			$peg_telephone = $peg_telephone." ".$row_alamat['p_al_no_telp']." . ";
		}
		foreach($data_tmt as $row_tmt)
		{
			if($row_tmt['p_tmt_tmt'] != "0000-00-00")
			{
				$peg_tmt = strtotime('%d %F %Y',strtotime($row_tmt['p_tmt_tmt']));
			}
		}
		foreach($data_jabatan as $row_jabatan)
		{
			$peg_jabatan = $row_jabatan['p_jbt_jabatan'];
		}
		foreach($data_unit as $row_unit)
		{
			$peg_unit = $row_unit['p_unt_kode_unit'];
		}
		foreach($data_grade as $row_grade)
		{
			$peg_golongan = $row_grade['p_grd_grade'];
		}
		
		// Add header
		$PHPWord->addFontStyle('r_headerStyle', array('name'=>'Verdana','bold'=>true, 'size'=>16));
		$PHPWord->addParagraphStyle('p_headerStyle', array('align'=>'left', 'spaceAfter'=>100));
		$header = $section->createHeader();
		$header->addText('CURRICULUM VITAE', 'r_headerStyle', 'p_headerStyle');
		// Title Style
		$PHPWord->addFontStyle('r_titleStyle', array('name'=>'Verdana','bold'=>true, 'size'=>12));
		$PHPWord->addParagraphStyle('p_titleStyle', array('align'=>'left', 'spaceAfter'=>80));
				
		// Define table style arrays
		$styleTable1 = array('cellMargin'=>30);
		//$styleTable1 = array('borderSize'=>0, 'borderColor'=>'000000', 'cellMargin'=>30);
		$styleFirstRow1 = array();

		// Define cell style arrays
		$styleCell = array('valign'=>'top');
		
		// Add table style
		//$PHPWord->addTableStyle('TableStyle1', $styleTable1);
		$PHPWord->addTableStyle('TableStyle1', $styleTable1, $styleFirstRow1);

		$section->addTextBreak(1);
		$section->addText('I. KETERANGAN PEGAWAI', 'r_titleStyle', 'p_titleStyle');
		$section->addTextBreak(1);
		// Add table
		$table1 = $section->addTable('TableStyle1');

		# Keterangan Pegawai
		// Add row
		$table1->addRow(80);
		$table1->addCell(2000, $styleCell)->addText('NAMA LENGKAP');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText(strtoupper($peg_nama));
		
		$table1->addRow();
		$table1->addCell(2000, $styleCell)->addText('NIP');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText(strtoupper($peg_nipp));
		
		$table1->addRow();
		$table1->addCell(2000, $styleCell)->addText('T.M.T');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText(strtoupper($peg_tmt));
		
		$table1->addRow();
		$table1->addCell(2000, $styleCell)->addText('PANGKAT / GOLONGAN');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText(strtoupper($peg_golongan));
		
		$table1->addRow();
		$table1->addCell(2000, $styleCell)->addText('JABATAN');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText(strtoupper($peg_jabatan));
		
		$table1->addRow();
		$table1->addCell(2000, $styleCell)->addText('UNIT KERJA');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText(strtoupper($peg_unit));
		
		$table1->addRow();
		$table1->addCell(2000, $styleCell)->addText('TEMPAT, TANGGAL LAHIR');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText(strtoupper($peg_tempatlahir).", $peg_tanggallahir");
		
		$table1->addRow();
		$table1->addCell(2000, $styleCell)->addText('USIA');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText("$peg_usia");
		
		$table1->addRow();
		$table1->addCell(2000, $styleCell)->addText('JENIS KELAMIN');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText("$peg_jeniskelamin");
		
		$table1->addRow();
		$table1->addCell(2000, $styleCell)->addText('ALAMAT RUMAH');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText(strtoupper($peg_alamatrumah));
		
		$table1->addRow();
		$table1->addCell(2000, $styleCell)->addText('TELEPHONE');
		$table1->addCell(200, $styleCell)->addText(':');
		$table1->addCell(4400, $styleCell)->addText("$peg_telephone");
		
		/*
		$image = base_url()."pegawai/foto/".$peg_nipp.".jpg";
		$section->addImage("$image", array('width'=>100, 'height'=>100, 'align'=>'right'));	
		*/
		$section->addTextBreak(1);
		

# II. PENDIDIKAN FORMAL		
		
		// Define table style arrays
		$styleTableBorder = array('borderSize'=>2, 'borderColor'=>'000000', 'cellMargin'=>30);
		$styleFirstRow = array('borderBottomSize'=>2, 'borderBottomColor'=>'0000FF', 'bgColor'=>'AAAAAA');
//'borderBottomSize'=>1,
		// Define cell style arrays
		$styleCellBorder = array('valign'=>'center');
		//$styleCellBTLR = array('valign'=>'center', 'textDirection'=>PHPWord_Style_Cell::TEXT_DIR_BTLR);

		// Define font style for first row
		$fontStyle = array('bold'=>true, 'align'=>'center');

		// Add table style
		$PHPWord->addTableStyle('TableStyleBorder', $styleTableBorder, $styleFirstRow);
		
		$section->addText('II. PENDIDIKAN FORMAL', 'r_titleStyle', 'p_titleStyle');
		
		
		// Add table
		$table2 = $section->addTable('TableStyleBorder');

		// Add row
		$table2->addRow(300);

		// Add cells
		$table2->addCell(300, $styleCellBorder)->addText('NO', $fontStyle);
		$table2->addCell(2000, $styleCellBorder)->addText('PENDIDIKAN', $fontStyle);
		$table2->addCell(2000, $styleCellBorder)->addText('TAHUN', $fontStyle);
		$table2->addCell(2000, $styleCellBorder)->addText('TEMPAT', $fontStyle);
		$table2->addCell(3000, $styleCellBorder)->addText('KETERANGAN', $fontStyle);

		$no = 0;
		foreach($data_pendidikan as $row_pendidikan){ 
		$no++;
			$table2->addRow();
			$table2->addCell(300)->addText("$no");
			$table2->addCell(2000)->addText("$row_pendidikan[p_pdd_tingkat]");
			$table2->addCell(1000)->addText("$row_pendidikan[p_pdd_masuk]");
			$table2->addCell(2000)->addText("$row_pendidikan[p_pdd_lp]");
			$table2->addCell(3000)->addText(" ");
		}
		$section->addTextBreak(1);
		
		
# III. PENDIDIKAN INFORMAL		
		$section->addText('III. PENDIDIKAN INFORMAL', 'r_titleStyle', 'p_titleStyle');
		// Add table
		$table3 = $section->addTable('TableStyleBorder');

		// Add row
		$table3->addRow(300);

		// Add cells
		$table3->addCell(300, $styleCellBorder)->addText('NO', $fontStyle);
		$table3->addCell(2000, $styleCellBorder)->addText('PENDIDIKAN', $fontStyle);
		$table3->addCell(1500, $styleCellBorder)->addText('TGL. MULAI', $fontStyle);
		$table3->addCell(1500, $styleCellBorder)->addText('TGL. SELESAI', $fontStyle);
		$table3->addCell(2000, $styleCellBorder)->addText('TEMPAT', $fontStyle);
		$table3->addCell(2000, $styleCellBorder)->addText('KETERANGAN', $fontStyle);

		$no = 0;
		foreach($data_nstkp as $row_nstkp){ 
			$p_nstkp_pelaksanaan = mdate('%d-%m-%Y',strtotime($row_nstkp['p_nstkp_pelaksanaan']) );
			$p_nstkp_selesai = mdate('%d-%m-%Y',strtotime($row_nstkp['p_nstkp_selesai']) );
			$no++;
			$table3->addRow();
			$table3->addCell(300)->addText("$no");
			$table3->addCell(2000)->addText("$row_nstkp[p_nstkp_jenis]");
			$table3->addCell(1500)->addText("$p_nstkp_pelaksanaan");
			$table3->addCell(1500)->addText("$p_nstkp_selesai");
			$table3->addCell(2000)->addText("$row_nstkp[p_nstkp_lembaga]");
			$table3->addCell(2000)->addText('');
		}
		$section->addTextBreak(1);

# IV. RIWAYAT GOLONGAN		
		$section->addText('IV. RIWAYAT GOLONGAN', 'r_titleStyle', 'p_titleStyle');
		// Add table
		$table4 = $section->addTable('TableStyleBorder');

		// Add row
		$table4->addRow(300);

		// Add cells
		$table4->addCell(300, $styleCellBorder)->addText('NO', $fontStyle);
		$table4->addCell(2000, $styleCellBorder)->addText('GOL/PANGKAT', $fontStyle);
		$table4->addCell(5000, $styleCellBorder)->addText('SK-GOLONGAN', $fontStyle);
		$table4->addCell(2000, $styleCellBorder)->addText('T.M.T GOLONGAN', $fontStyle);
		
		$no = 0;
		foreach($riwayat_golongan as $row_riwayatgolongan){ 
			if($row_riwayatgolongan['p_grd_tmt'] == "0000-00-00"){ $grade_tmt = "-";}
			else{$grade_tmt = mdate('%d-%m-%Y',strtotime($row_riwayatgolongan['p_grd_tmt']));}
			$no++;
			$table4->addRow();
			$table4->addCell(300, $styleCellBorder)->addText("$no");
			$table4->addCell(2000, $styleCellBorder)->addText("$row_riwayatgolongan[p_grd_grade]");
			$table4->addCell(5000, $styleCellBorder)->addText("$row_riwayatgolongan[p_grd_skno]");
			$table4->addCell(2000, $styleCellBorder)->addText("$row_riwayatgolongan[p_grd_tmt]");
		}
		$section->addTextBreak(1);		

# V. RIWAYAT JABATAN		
		$section->addText('V. RIWAYAT JABATAN', 'r_titleStyle', 'p_titleStyle');
		// Add table
		$table5 = $section->addTable('TableStyleBorder');

		// Add row
		$table5->addRow(300);

		// Add cells
		$table5->addCell(300, $styleCellBorder)->addText('NO', $fontStyle);
		$table5->addCell(2500, $styleCellBorder)->addText('JABATAN', $fontStyle);
		$table5->addCell(2000, $styleCellBorder)->addText('DEPARTEMEN', $fontStyle);
		$table5->addCell(3000, $styleCellBorder)->addText('SK', $fontStyle);
		$table5->addCell(1500, $styleCellBorder)->addText('T.M.T', $fontStyle);
		
		$no = 0;
		foreach($riwayat_jabatan as $row_riwayatjabatan){ 
			if($row_riwayatjabatan['p_jbt_tmt_start'] == "0000-00-00"){ $jbt_tmt_start = "-";}
			else{$jbt_tmt_start = mdate('%d-%m-%Y',strtotime($row_riwayatjabatan['p_jbt_tmt_start']));}
			$no++;
			$table5->addRow();
			$table5->addCell(300, $styleCellBorder)->addText("$no");
			$table5->addCell(2500, $styleCellBorder)->addText(strtoupper($row_riwayatjabatan['p_jbt_jabatan']));
			$table5->addCell(2000, $styleCellBorder)->addText("$row_riwayatjabatan[p_jbt_unit]");
			$table5->addCell(3000, $styleCellBorder)->addText(strtoupper($row_riwayatjabatan['p_jbt_skno']));
			$table5->addCell(1500, $styleCellBorder)->addText("$jbt_tmt_start");
		}
		$section->addTextBreak(1);		
		

# VI. DATA KELUARGA		
		$section->addText('VI. DATA KELUARGA', 'r_titleStyle', 'p_titleStyle');
		// Add table
		$table6 = $section->addTable('TableStyleBorder');

		// Add row
		$table6->addRow(300);

		// Add cells
		$table6->addCell(300, $styleCellBorder)->addText('NO', $fontStyle);
		$table6->addCell(3000, $styleCellBorder)->addText('NAMA', $fontStyle);
		$table6->addCell(2000, $styleCellBorder)->addText('TGL LAHIR', $fontStyle);
		$table6->addCell(1000, $styleCellBorder)->addText('UMUR', $fontStyle);
		$table6->addCell(3000, $styleCellBorder)->addText('HUBUNGAN', $fontStyle);
		
		$no = 0;
		# PASANGAN
		foreach($data_pasangan as $row_pasangan){ 
			$no++;
			if($row_pasangan['p_ps_jns_kelamin']=="L"){$status_pasangan = "SUAMI";}
			else if($row_pasangan['p_ps_jns_kelamin']=="P"){$status_pasangan = "ISTRI";}
			if($row_pasangan['p_ps_tgl_lahir']=="0000-00-00"){
				$umur = "-";
				$tgl_lahir_pasangan = "-";
			}else{ 
				$umur = floor((strtotime(date('Y-m-d'))-strtotime($row_pasangan['p_ps_tgl_lahir']))/(365*24*60*60));
				$tgl_lahir_pasangan = mdate('%d-%m-%Y',strtotime($row_pasangan['p_ps_tgl_lahir']));
			}
			
			$table6->addRow();
			$table6->addCell(300, $styleCellBorder)->addText("$no");
			$table6->addCell(3000, $styleCellBorder)->addText(strtoupper($row_pasangan['p_ps_nama']));
			$table6->addCell(2000, $styleCellBorder)->addText("$tgl_lahir_pasangan");
			$table6->addCell(1000, $styleCellBorder)->addText("$umur");
			$table6->addCell(3000, $styleCellBorder)->addText("$status_pasangan");
		}	
		# ANAK
		$anak = 0;
		foreach($data_anak as $row_anak){ 
			$no++;
			$anak++;
			if($row_anak['peg_ank_tgl_lahir']=="0000-00-00"){
				$umur_anak = "-";
				$tgl_lahir_anak = "-";
			}else{ 
				$umur_anak = floor((strtotime(date('Y-m-d'))-strtotime($row_anak['peg_ank_tgl_lahir']))/(365*24*60*60)); 
				$tgl_lahir_anak = mdate('%d-%m-%Y',strtotime($row_anak['peg_ank_tgl_lahir']));
			}
			
			$table6->addRow();
			$table6->addCell(300, $styleCellBorder)->addText("$no");
			$table6->addCell(3000, $styleCellBorder)->addText(strtoupper($row_anak['peg_ank_nama']));
			$table6->addCell(2000, $styleCellBorder)->addText("$tgl_lahir_anak");
			$table6->addCell(1000, $styleCellBorder)->addText("$umur_anak");
			$table6->addCell(3000, $styleCellBorder)->addText("ANAK KE-$anak");
		}	
		$section->addTextBreak(1);		
		

# VII.  SANKSI JABATAN 		
		$section->addText('VII. SANKSI JABATAN', 'r_titleStyle', 'p_titleStyle');
		// Add table
		$table7 = $section->addTable('TableStyleBorder');

		// Add row
		$table7->addRow(300);

		// Add cells
		$table7->addCell(300, $styleCellBorder)->addText('NO', $fontStyle);
		$table7->addCell(3000, $styleCellBorder)->addText('JENIS SANKSI', $fontStyle);
		$table7->addCell(2000, $styleCellBorder)->addText('NO SK ', $fontStyle);
		$table7->addCell(1500, $styleCellBorder)->addText('AWAL', $fontStyle);
		$table7->addCell(1500, $styleCellBorder)->addText('AKHIR', $fontStyle);
		$table7->addCell(1000, $styleCellBorder)->addText('KETERANGAN', $fontStyle);
		
		$no = 0;
		foreach($riwayat_sanksi as $row_sanksi){ 
			$no++;
			if($row_sanksi['p_snk_start'] == "0000-00-00"){$start = "-";}
			else{$start = mdate('%d-%m-%Y',strtotime($row_sanksi['p_snk_start']));}
			if($row_sanksi['p_snk_end'] == "0000-00-00"){$end = "-";}
			else{$end = mdate('%d-%m-%Y',strtotime($row_sanksi['p_snk_end']));}
			
			
			$table7->addRow();
			$table7->addCell(300, $styleCellBorder)->addText("$no");
			$table7->addCell(3000, $styleCellBorder)->addText(strtoupper($row_sanksi['p_snk_jenis']));
			$table7->addCell(2000, $styleCellBorder)->addText("$row_sanksi[p_snk_no]");
			$table7->addCell(1500, $styleCellBorder)->addText("$start");
			$table7->addCell(1500, $styleCellBorder)->addText("$end");
			$table7->addCell(1000, $styleCellBorder)->addText(strtoupper($row_sanksi['p_snk_keterangan']));
			
		}	
		$section->addTextBreak(1);
	
	
		// Save File
		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		$objWriter->save('TextXXXX.docx');
		
		$filename="TextXXXX.docx"; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-word');
		header('Content-Disposition: attachment;filename="'.$filename.'"');
		header('Cache-Control: max-age=0');

		// output the file to the browser
		$objWriter = PHPWord_IOFactory::createWriter($PHPWord, 'Word2007');
		$objWriter->save('php://output');
		exit; //you must have the exit!
	}
	
	public function pegawai_keluar()
	{
		$datestring = "%Y" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		//$type = '52';
		$type = '55';
		$limit = '100';
		
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/pegawai_keluar/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->countPegawaiKeluar($tanggal,$type, $limit); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 3; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		
		#data preparing
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_keluar($config['per_page'],$page, $tanggal, $type, $limit);
		$data['count'] = $config['total_rows'];
		$data['page'] = 'Data Pegawai Keluar';
		$data['tanggal'] = $tanggal;
		$data['type'] = 'ALL';
		$data['view_keluar'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		#calling view
		$this->load->view('kepegawaian/index',$data);
	}
	
	public function search_pegawai_keluar()
	{
		if ($this->input->post('search') == NULL )
		{
			$search_data = str_replace('%20',' ',$this->uri->segment(3));
		}else{
			$search_data = $this->input->post('search');
		}
		
		$datestring = "%Y" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		//$type = '52';
		$type = '55';
		$limit = '100';
		
		#pagination config
		$config['base_url'] = base_url().'index.php/pekerja/search_pegawai_keluar/'.$search_data.'/'; //set the base url for pagination
		$config['total_rows'] = $this->kepegawaian->countSearchPegawaiKeluar($tanggal, $type, $limit,$search_data); //total rows
		$config['per_page'] = 10; //the number of per page for pagination
		$config['uri_segment'] = 4; //see from base_url. 3 for this case
		$this->pagination->initialize($config);
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		
		#data preparing
		$data['pegawai'] = $this->kepegawaian->search_data_pegawai_keluar($config['per_page'],$page, $tanggal, $type, $limit, $search_data);
		$data['count'] = $config['total_rows'];
		$data['page'] = 'Data Pegawai Keluar';
		$data['tanggal'] = $tanggal;
		$data['type'] = 'ALL';
		$data['view_keluar'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		#calling view
		$this->load->view('kepegawaian/index',$data);
	}
	
	
	
	public function upload()
	{
		$data['page'] = 'Upload';
		$data['view_upload'] = 'class="this"';
		$data['form_master'] = 'id="current"';
		$this->load->view('kepegawaian/index',$data);
	}
	
	function do_upload_foto()
   {
      $config['upload_path'] = './pegawai/foto';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']  = '100';
      $config['max_width']  = '1024';
      $config['max_height']  = '768';
 
      
      $this->load->library('upload', $config);

	  if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$error['page'] = 'Upload';
			$error['view_upload'] = 'class="this"';
			$error['form_master'] = 'id="current"';
			$this->load->view('kepegawaian/index', $error);
			//redirect('pekerja/upload');
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			redirect('pekerja/upload');
			//$this->load->view('upload_success', $data);
		}
	}
	
	function do_upload_diklat()
   {
      $config['upload_path'] = './pegawai/diklat/';
      $config['allowed_types'] = 'gif|jpg|png';
      $config['max_size']  = '100';
      $config['max_width']  = '1024';
      $config['max_height']  = '768';
 
      
      $this->load->library('upload', $config);

	  if ( ! $this->upload->do_upload())
		{
			$error = array('error' => $this->upload->display_errors());
			$error['page'] = 'Upload';
			$error['view_upload'] = 'class="this"';
			$error['form_master'] = 'id="current"';
			$this->load->view('kepegawaian/index', $error);
			
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			redirect('pekerja/upload');
		}

	}
	
	function upload_sk_jabatan()
	{
		#preparing date 
		$update_on = date('YmdHis');
		
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$id_peg_jabatan = $this->input->post('id_peg_jbt');
		$nipp = $this->input->post('nipp');
		$no_sk = $this->input->post('no_sk');
				
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
			
			$config['upload_path'] = './pegawai/skjabatan/';
			$config['allowed_types'] = 'pdf|gif|jpg|png';
			$config['max_size']  = '9999';
			$config['overwrite']	=	TRUE;
			//$filenamebantu = str_replace(' ','_',$no_sk)."-$id_peg_jabatan-".$update_on.".".$ext[1];
			$filenamebantu = str_replace(' ','_',$no_sk).".".$ext[1]; //filenya ditindih dengan file baru
			$config['file_name']=$filenamebantu;
			
			
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
				$data_jabatan = array(
					
					'p_jbt_skfile'			=> $filenamebantu,
					'p_jbt_update_by'		=> username(),
				);
				$this->kepegawaian->update_data_riwayat_jabatan($id_peg_jabatan,$data_jabatan);	
			}
		} 
		redirect('pekerja/get_pegawai/'.$nipp);
	}
	
	function view_skjabatanfile($nama_file)
	{
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
		$file = base_url()."pegawai/skjabatan/".$nama_file;
		echo "<embed src= '".$file."' width='1200' height='666' ></embed>";
		?>
		<br><br>
		<!-- <input type="button" value="Back" onclick="goBack()"> -->
		</body>
		</html>
		<?php 
	}
	function view_skgolonganfile($nama_file)
	{
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
		$file = base_url()."pegawai/skgolongan/".$nama_file;
		echo "<embed src= '".$file."' width='1200' height='666' ></embed>";
		?>
		<br><br>
		<!-- <input type="button" value="Back" onclick="goBack()"> -->
		</body>
		</html>
		<?php 
	}
	function view_sksanksifile($nama_file)
	{
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
		$file = base_url()."pegawai/sksanksi/".$nama_file;
		echo "<embed src= '".$file."' width='1200' height='666' ></embed>";
		?>
		<br><br>
		<!-- <input type="button" value="Back" onclick="goBack()"> -->
		</body>
		</html>
		<?php 
	}
	
	#rekapitulasi pegawai
	function rekapitulasi_pegawai()
	{
		#data preparing
		if($this->input->post('jenis') == NULL){
			$data['jenispegawai'] = "ALL";
		} else {
			$data['jenispegawai'] = $this->input->post('jenis');
		}
		
		$data['page'] = 'Rekapitulasi Pegawai';
		$data['view_rekapitulasi_pegawai'] = 'class="this"';
		$data['page_karyawan'] = 'yes';
		
		#calling view
		$this->load->view('kepegawaian/index',$data);
	}
	
	function excel_rekapitulasi_pegawai()
	{
		$jenis = $this->uri->segment(3);
		if($jenis != 'ALL'){
			ini_set("memory_limit","300M");
			
			$datestring = "%Y-%m-%d" ;
			$time = time();
			$tanggal = mdate($datestring, $time);
			
			$pegawai = $this->kepegawaian->get_data_pegawai_aktif_unlimited($jenis);
					
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle("Data Pegawai ");
			//JUDUL KOP
			$this->excel->getActiveSheet()->setCellValue('A2', 'REKAPITULASI DATA PEGAWAI '.strtoupper($jenis));
			$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
			$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
			
			$this->excel->getActiveSheet()->setCellValue('M5', 'Update : '.mdate('%d %F %Y',time()));
			
			$this->excel->getActiveSheet()->setCellValue('A6', 'NO URUT');
			$this->excel->getActiveSheet()->setCellValue('B6', 'NO JLH');
			$this->excel->getActiveSheet()->setCellValue('C6', 'NO UNIT');
			$this->excel->getActiveSheet()->setCellValue('D6', 'NAMA PEGAWAI');
			$this->excel->getActiveSheet()->setCellValue('E6', 'NIPP');
			$this->excel->getActiveSheet()->setCellValue('F6', 'GRADE');
			$this->excel->getActiveSheet()->setCellValue('G6', 'M.K.A');
			$this->excel->getActiveSheet()->setCellValue('H6', 'T.M.T GA/GP');
			$this->excel->getActiveSheet()->setCellValue('I6', 'JENIS KELAMIN');
			$this->excel->getActiveSheet()->setCellValue('J6', 'TGL LAHIR');
			$this->excel->getActiveSheet()->setCellValue('K6', 'UMUR');
			$this->excel->getActiveSheet()->setCellValue('L6', 'T.M.T MUTASI');
			$this->excel->getActiveSheet()->setCellValue('M6', 'JABATAN');
			$this->excel->getActiveSheet()->setCellValue('N6', 'KET');
			
			
			
			$i=7;
			$number=0;
			$nojumlah=0;
			$nounit=0;
			$unit="kosong";
			$sub_unit="kosong";
			
			$nipp = '';
			foreach ($pegawai as $row_pegawai) :
			{ 
				$i++;
				$number++;
				if($row_pegawai['peg_jns_kelamin'] == "P"){ $jk="Perempuan"; }
				else{$jk="Laki-Laki";}
				if ($row_pegawai['peg_tgl_lahir'] == "0000-00-00" ){ $tgl_lahir = "-";}
				else{$tgl_lahir = mdate("%d-%m-%Y",strtotime($row_pegawai['peg_tgl_lahir']));}
				 
				if($row_pegawai['p_unt_kode_unit'] !== $unit){
					$nojumlah = 0;
					$nounit = 0;
					$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_pegawai[nama_unit]"));
					$this->excel->getActiveSheet()->getStyle("D$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff00');
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getFont()->setBold(true);
					$i++;
				}
				if($row_pegawai['p_unt_kode_sub_unit'] !== $sub_unit){
					$nounit = 0;
					$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_pegawai[su_sub_unit]"));
					$this->excel->getActiveSheet()->getStyle("D$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff77');
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getFont()->setBold(true);
					$i++;
				}
				$nojumlah++;
				$nounit++;
				
				$mka = floor((time() -(strtotime($row_pegawai['p_tmt_tmt'])))/(365*24*60*60));
				$umur = floor((time() -(strtotime($row_pegawai['peg_tgl_lahir'])))/(365*24*60*60));
				
				//masukkan data ke tabel excel
				$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
				$this->excel->getActiveSheet()->setCellValue("B$i", "$nojumlah");
				$this->excel->getActiveSheet()->setCellValue("C$i", "$nounit");
				$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_pegawai[peg_nama]"));
				$this->excel->getActiveSheet()->setCellValue("E$i", strtoupper("$row_pegawai[peg_nipp]"));
				$this->excel->getActiveSheet()->setCellValue("F$i", strtoupper("$row_pegawai[p_grd_grade]"));
				$this->excel->getActiveSheet()->setCellValue("G$i", $mka);
				$this->excel->getActiveSheet()->setCellValue("H$i", "$row_pegawai[peg_jns_kelamin]");
				$this->excel->getActiveSheet()->setCellValue("I$i", "$row_pegawai[p_tmt_tmt]");
				$this->excel->getActiveSheet()->setCellValue("J$i", mdate('%d-%M-%y',strtotime($row_pegawai['peg_tgl_lahir'])));
				$this->excel->getActiveSheet()->setCellValue("K$i", $umur);
				$this->excel->getActiveSheet()->setCellValue("L$i", "-");
				$this->excel->getActiveSheet()->setCellValue("M$i", strtoupper($row_pegawai['p_jbt_jabatan']));
				$this->excel->getActiveSheet()->setCellValue("N$i", "-");//masukkan data ke tabel excel
			
				$unit = $row_pegawai['p_unt_kode_unit'];
				$sub_unit = $row_pegawai['p_unt_kode_sub_unit'];
			}endforeach;
			
			//change the font size
			$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle("A6:N7")->getFont()->setSize(8);
			$this->excel->getActiveSheet()->getStyle("A8:N$i")->getFont()->setSize(8);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A6:N6')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells('A2:N2');
			$this->excel->getActiveSheet()->mergeCells('A3:N3');
			$this->excel->getActiveSheet()->mergeCells('A4:N4');
			$this->excel->getActiveSheet()->getStyle("M5")->getFont()->setSize(7);
			
			//set aligment to center for that merged cell (A1 to D1)
			$this->excel->getActiveSheet()->getStyle('A6:N6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:N6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:N6')->getAlignment()->setWrapText(true);
			//Set column widths                                                       
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5.54); 
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(5.54);    
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(26.5);  
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10.88); 
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10.88); 
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(5.63); 
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.88); 
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(14.88); 
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(10.88); 
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(5.88); 
			$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15.88); 
			$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15.88); 
			$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15.88); 
			
			 
			$filename="Data Rekapitulasi Pegawai $jenis.xls"; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		
		}
		
	}
	
	function excel_rekapitulasi_jumlah_pegawai_jenis_kelamin()
	{
		$jenis = $this->uri->segment(3);
		if($jenis != 'ALL'){
			ini_set("memory_limit","300M");
			
			$datestring = "%Y-%m-%d" ;
			$time = time();
			$tanggal = mdate($datestring, $time);
			
			$pegawai = $this->kepegawaian->get_data_pegawai_aktif_unlimited($jenis);
					
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle("Data Pegawai ");
			//JUDUL KOP
			$this->excel->getActiveSheet()->setCellValue('A2', 'DATA JUMLAH PEGAWAI '.strtoupper($jenis).' BERDASARKAN JENIS KELAMIN');
			$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
			$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
			
			$this->excel->getActiveSheet()->setCellValue('F5', 'Update : '.mdate('%d %F %Y',time()));
			
			$this->excel->getActiveSheet()->setCellValue('A6', 'NO');
			$this->excel->getActiveSheet()->setCellValue('B6', 'UNIT');
			$this->excel->getActiveSheet()->setCellValue('C6', 'LAKI-LAKI');
			$this->excel->getActiveSheet()->setCellValue('D6', 'PEREMPUAN');
			$this->excel->getActiveSheet()->setCellValue('E6', 'JUMLAH');
			$this->excel->getActiveSheet()->setCellValue('F6', 'KET');
			
			$i=7;
			$number=0;
			$unitl=0;
			$unitp=0;
			$totall=0;
			$totalp=0;
			
			$unit="kosong";
			
			$nipp = '';
			foreach ($pegawai as $row_pegawai) :
			{ 
				
				if($row_pegawai['p_unt_kode_unit'] !== $unit){
					$i++;
					$number++;
					$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
					$this->excel->getActiveSheet()->setCellValue("B$i", strtoupper("$row_pegawai[nama_unit]"));
					$this->excel->getActiveSheet()->setCellValue("C$i", $unitl);
					$this->excel->getActiveSheet()->setCellValue("D$i", $unitp);
					$this->excel->getActiveSheet()->setCellValue("E$i", $unitl+$unitp);
					$unitl=0;
					$unitp=0;
				}else{
					if($row_pegawai['peg_jns_kelamin']=='L'){
						$unitl++;
						$totall++;
					} else 
					if($row_pegawai['peg_jns_kelamin']=='P'){
						$unitp++;
						$totalp++;
					}
				}
							
			
				$unit = $row_pegawai['p_unt_kode_unit'];
				$sub_unit = $row_pegawai['p_unt_kode_sub_unit'];
			}endforeach;
			$this->excel->getActiveSheet()->setCellValue("A$i", "");
			$this->excel->getActiveSheet()->setCellValue("B$i", "TOTAL");
			$this->excel->getActiveSheet()->setCellValue("C$i", $totall);
			$this->excel->getActiveSheet()->setCellValue("D$i", $totalp);
			$this->excel->getActiveSheet()->setCellValue("E$i", $totall+$totalp);
			
			$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle("A6:F7")->getFont()->setSize(8);
			$this->excel->getActiveSheet()->getStyle("A8:F$i")->getFont()->setSize(8);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells('A2:F2');
			$this->excel->getActiveSheet()->mergeCells('A3:F3');
			$this->excel->getActiveSheet()->mergeCells('A4:F4');
			$this->excel->getActiveSheet()->getStyle("F5")->getFont()->setSize(7);
			
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getAlignment()->setWrapText(true);
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(8.54);  
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(25.54); 
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15.54);    
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15.54);  
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15.54); 
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(18.88); 
			
			 
			$filename="Data Rekapitulasi Jumlah Pegawai $jenis Berdasarkan Jenis Kelamin.xls"; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		
		}
	}
	
	function excel_kekuatan_sdm()
	{
		$jenis = $this->uri->segment(3);
		if($jenis != 'ALL'){
			ini_set("memory_limit","300M");
			
			$datestring = "%Y-%m-%d" ;
			$time = time();
			$tanggal = mdate($datestring, $time);
			
			$pegawai = $this->kepegawaian->get_data_pegawai_aktif_unlimited($jenis);
					
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle("Data Kekuatan SDM ");
			//JUDUL KOP
			$this->excel->getActiveSheet()->setCellValue('A2', 'DATA KEKUATAN SDM');
			$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
			$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
			
			$this->excel->getActiveSheet()->setCellValue('F5', 'Update : '.mdate('%d %F %Y',time()));
			
			$this->excel->getActiveSheet()->setCellValue('A6', 'NO');
			$this->excel->getActiveSheet()->setCellValue('B6', 'ALOKASI UNIT');
			$this->excel->getActiveSheet()->setCellValue('C6', 'TETAP');
			$this->excel->getActiveSheet()->setCellValue('D6', 'PKWT');
			$this->excel->getActiveSheet()->setCellValue('E6', 'JUMLAH');
			$this->excel->getActiveSheet()->setCellValue('F6', 'KETERANGAN');
			
			$i=7;
			$number=0;
			$unit="kosong";
			$jum_peg_tetap=0;
			$jum_peg_pkwt=0;
			$jum_peg_grand=0;
			$tot_peg_tetap=0;
			$tot_peg_pkwt=0;
			$tot_peg_grand=0;
			
			foreach ($pegawai as $row_pegawai) :
			{ 
				if(($row_pegawai['p_unt_kode_unit'] != $unit) AND ($unit !='kosong')){
					$i++;
					$number++;
					$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
					$this->excel->getActiveSheet()->setCellValue("B$i", $nama_unit);
					$this->excel->getActiveSheet()->setCellValue("C$i", $jum_peg_tetap);
					$this->excel->getActiveSheet()->setCellValue("D$i", $jum_peg_pkwt);
					$this->excel->getActiveSheet()->setCellValue("E$i", $jum_peg_grand);
					$this->excel->getActiveSheet()->setCellValue("F$i", "");
				
					$tot_peg_tetap=$tot_peg_tetap + $jum_peg_tetap;
					$tot_peg_pkwt=$tot_peg_pkwt + $jum_peg_pkwt;
					$tot_peg_grand=$tot_peg_grand + $jum_peg_grand;
					
					//reset nilai
					$jum_peg_tetap = 0;
					$jum_peg_pkwt = 0;
					$jum_peg_grand = 0;
					$unit = $row_pegawai['p_unt_kode_unit'];
					$nama_unit = $row_pegawai['nama_unit'];
				}
				if($row_pegawai['p_tmt_status'] == 'Tetap' ){
						$jum_peg_tetap++;
						$jum_peg_grand++;
				}
				if($row_pegawai['p_tmt_status'] == 'PKWT' ){
						$jum_peg_pkwt++;
						$jum_peg_grand++;
				}
				$unit = $row_pegawai['p_unt_kode_unit'];
				$nama_unit = $row_pegawai['nama_unit'];
			}endforeach;
			$i++;
			$number++;
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", strtoupper($nama_unit));
			$this->excel->getActiveSheet()->setCellValue("C$i", $jum_peg_tetap);
			$this->excel->getActiveSheet()->setCellValue("D$i", $jum_peg_pkwt);
			$this->excel->getActiveSheet()->setCellValue("E$i", $jum_peg_grand);
			$this->excel->getActiveSheet()->setCellValue("F$i", "");
			
			#total
			$i++;
			$number++;
			$tot_peg_tetap=$tot_peg_tetap + $jum_peg_tetap;
			$tot_peg_pkwt=$tot_peg_pkwt + $jum_peg_pkwt;
			$tot_peg_grand=$tot_peg_grand + $jum_peg_grand;
			$this->excel->getActiveSheet()->setCellValue("A$i", "");
			$this->excel->getActiveSheet()->setCellValue("B$i", 'TOTAL SDM');
			$this->excel->getActiveSheet()->setCellValue("C$i", $tot_peg_tetap);
			$this->excel->getActiveSheet()->setCellValue("D$i", $tot_peg_pkwt);
			$this->excel->getActiveSheet()->setCellValue("E$i", $tot_peg_grand);
			$this->excel->getActiveSheet()->setCellValue("F$i", "");
			
					
			//change the font size
			$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle("A6:F7")->getFont()->setSize(8);
			$this->excel->getActiveSheet()->getStyle("A8:F$i")->getFont()->setSize(8);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells('A2:F2');
			$this->excel->getActiveSheet()->mergeCells('A3:F3');
			$this->excel->getActiveSheet()->mergeCells('A4:F4');
			$this->excel->getActiveSheet()->getStyle("F5")->getFont()->setSize(7);
			
			//set aligment to center for that merged cell (A1 to D1)
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getAlignment()->setWrapText(true);
			//Set column widths                                                       
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20.54); 
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(10.5);    
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(10.5);  
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10.88); 
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20.88); 
			
			 
			$filename="Data Kekuatan SDM Pegawai $jenis.xls"; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		
		}
		
	}
	
	# rekapitulasi sdm kontrak
	function excel_rekapitulasi_pegawai_kontrak()
	{
		$jenis = $this->uri->segment(3);
		if($jenis != 'ALL'){
			ini_set("memory_limit","300M");
			
			$datestring = "%Y-%m-%d" ;
			$time = time();
			$tanggal = mdate($datestring, $time);
			
			$pegawai = $this->kepegawaian->get_data_pegawai_aktif_unlimited($jenis);
					
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle("Data Pegawai ");
			//JUDUL KOP
			$this->excel->getActiveSheet()->setCellValue('A2', 'REKAPITULASI DATA PEGAWAI KONTRAK SDM');
			$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
			$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
			
			$this->excel->getActiveSheet()->setCellValue('M5', 'Update : '.mdate('%d %F %Y',time()));
			
			$this->excel->getActiveSheet()->setCellValue('A6', 'NO URUT');
			$this->excel->getActiveSheet()->setCellValue('B6', 'NO JLH');
			$this->excel->getActiveSheet()->setCellValue('C6', 'NO UNIT');
			$this->excel->getActiveSheet()->setCellValue('D6', 'NAMA PEGAWAI');
			$this->excel->getActiveSheet()->setCellValue('E6', 'NIPP');
			$this->excel->getActiveSheet()->setCellValue('F6', 'JENIS KELAMIN');
			$this->excel->getActiveSheet()->setCellValue('G6', 'TGL LAHIR');
			$this->excel->getActiveSheet()->setCellValue('H6', 'UMUR');
			$this->excel->getActiveSheet()->setCellValue('I6', 'JABATAN');
			$this->excel->getActiveSheet()->setCellValue('J6', 'UNIT KERJA');
			$this->excel->getActiveSheet()->setCellValue('K6', 'KET');
			
			
			
			$i=7;
			$number=0;
			$nojumlah=0;
			$nounit=0;
			$unit="kosong";
			$sub_unit="kosong";
			
			$nipp = '';
			foreach ($pegawai as $row_pegawai) :
			{ 
				$i++;
				$number++;
				if($row_pegawai['peg_jns_kelamin'] == "P"){ $jk="Perempuan"; }
				else{$jk="Laki-Laki";}
				if ($row_pegawai['peg_tgl_lahir'] == "0000-00-00" ){ $tgl_lahir = "-";}
				else{$tgl_lahir = mdate("%d-%m-%Y",strtotime($row_pegawai['peg_tgl_lahir']));}
				 
				if($row_pegawai['p_unt_kode_unit'] !== $unit){
					$nojumlah = 0;
					$nounit = 0;
					$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_pegawai[nama_unit]"));
					$this->excel->getActiveSheet()->getStyle("D$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff00');
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getFont()->setBold(true);
					$i++;
				}
				if($row_pegawai['p_unt_kode_sub_unit'] !== $sub_unit){
					$nounit = 0;
					$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_pegawai[su_sub_unit]"));
					$this->excel->getActiveSheet()->getStyle("D$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff77');
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getFont()->setBold(true);
					$i++;
				}
				$nojumlah++;
				$nounit++;
				
				$mka = floor((time() -(strtotime($row_pegawai['p_tmt_tmt'])))/(365*24*60*60));
				$umur = floor((time() -(strtotime($row_pegawai['peg_tgl_lahir'])))/(365*24*60*60));
				
				//masukkan data ke tabel excel
				$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
				$this->excel->getActiveSheet()->setCellValue("B$i", "$nojumlah");
				$this->excel->getActiveSheet()->setCellValue("C$i", "$nounit");
				$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_pegawai[peg_nama]"));
				$this->excel->getActiveSheet()->setCellValue("E$i", strtoupper("$row_pegawai[peg_nipp]"));
				$this->excel->getActiveSheet()->setCellValue("F$i", "$row_pegawai[peg_jns_kelamin]");
				$this->excel->getActiveSheet()->setCellValue("G$i", mdate('%d-%M-%y',strtotime($row_pegawai['peg_tgl_lahir'])));
				$this->excel->getActiveSheet()->setCellValue("H$i", $umur);
				$this->excel->getActiveSheet()->setCellValue("I$i", strtoupper($row_pegawai['p_jbt_jabatan']));
				$this->excel->getActiveSheet()->setCellValue("J$i", strtoupper($row_pegawai['nama_unit']));
				$this->excel->getActiveSheet()->setCellValue("K$i", " ");//masukkan data ke tabel excel
			
				$unit = $row_pegawai['p_unt_kode_unit'];
				$sub_unit = $row_pegawai['p_unt_kode_sub_unit'];
			}endforeach;
			
			//change the font size
			$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle("A6:K7")->getFont()->setSize(8);
			$this->excel->getActiveSheet()->getStyle("A8:K$i")->getFont()->setSize(8);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A6:K6')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells('A2:K2');
			$this->excel->getActiveSheet()->mergeCells('A3:K3');
			$this->excel->getActiveSheet()->mergeCells('A4:K4');
			$this->excel->getActiveSheet()->getStyle("K5")->getFont()->setSize(7);
			
			//set aligment to center for that merged cell (A1 to D1)
			$this->excel->getActiveSheet()->getStyle('A6:K6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:K6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:K6')->getAlignment()->setWrapText(true);
			//Set column widths                                                       
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5.54); 
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(5.54);    
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(26.5);  
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10.88); 
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(7.77); 
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(10.88); 
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.88); 
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(24.88); 
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(18.88); 
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(15.88); 
			
			
			
			 
			$filename="Data Rekapitulasi Pegawai Kontrak.xls"; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		}
	}
	function excel_kekuatan_sdm_kontrak()
	{
		$jenis = $this->uri->segment(3);
		if($jenis != 'ALL'){
			ini_set("memory_limit","300M");
			
			$datestring = "%Y-%m-%d" ;
			$time = time();
			$tanggal = mdate($datestring, $time);
			
			$pegawai = $this->kepegawaian->get_data_pegawai_aktif_unlimited($jenis);
					
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle("Data Kekuatan SDM ");
			//JUDUL KOP
			$this->excel->getActiveSheet()->setCellValue('A2', 'DATA KEKUATAN SDM PEG. KONTRAK SDM');
			$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
			$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
			
			$this->excel->getActiveSheet()->setCellValue('D5', 'Update : '.mdate('%d %F %Y',time()));
			
			$this->excel->getActiveSheet()->setCellValue('A6', 'NO');
			$this->excel->getActiveSheet()->setCellValue('B6', 'ALOKASI UNIT');
			$this->excel->getActiveSheet()->setCellValue('C6', 'JUMLAH');
			$this->excel->getActiveSheet()->setCellValue('D6', 'KETERANGAN');
			
			$i=7;
			$number=0;
			$unit="kosong";
			$jum_peg_kontrak = 0;
			$tot_peg_kontrak = 0;
			foreach ($pegawai as $row_pegawai) :
			{ 
				if(($row_pegawai['p_unt_kode_unit'] != $unit) AND ($unit !='kosong')){
					$i++;
					$number++;
					$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
					$this->excel->getActiveSheet()->setCellValue("B$i", $nama_unit);
					$this->excel->getActiveSheet()->setCellValue("C$i", $jum_peg_kontrak);
					$this->excel->getActiveSheet()->setCellValue("D$i", "");
				
					$tot_peg_kontrak=$tot_peg_kontrak + $jum_peg_kontrak;
					
					//reset nilai
					$jum_peg_kontrak = 0;
					$unit = $row_pegawai['p_unt_kode_unit'];
					$nama_unit = $row_pegawai['nama_unit'];
				}
				$jum_peg_kontrak++;
				$unit = $row_pegawai['p_unt_kode_unit'];
				$nama_unit = $row_pegawai['nama_unit'];
			}endforeach;
			$i++;
			$number++;
			$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
			$this->excel->getActiveSheet()->setCellValue("B$i", strtoupper($nama_unit));
			$this->excel->getActiveSheet()->setCellValue("C$i", $jum_peg_kontrak);
			$this->excel->getActiveSheet()->setCellValue("D$i", "");
			
			#total
			$i++;
			$number++;
			$tot_peg_kontrak=$tot_peg_kontrak + $jum_peg_kontrak;
			$this->excel->getActiveSheet()->setCellValue("A$i", "");
			$this->excel->getActiveSheet()->setCellValue("B$i", 'TOTAL SDM');
			$this->excel->getActiveSheet()->setCellValue("C$i", $tot_peg_kontrak);
			$this->excel->getActiveSheet()->setCellValue("D$i", "");
			
					
			$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle("A6:D7")->getFont()->setSize(8);
			$this->excel->getActiveSheet()->getStyle("A8:D$i")->getFont()->setSize(8);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A6:D6')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells('A2:D2');
			$this->excel->getActiveSheet()->mergeCells('A3:D3');
			$this->excel->getActiveSheet()->mergeCells('A4:D4');
			$this->excel->getActiveSheet()->getStyle("D5")->getFont()->setSize(7);
			$this->excel->getActiveSheet()->getStyle('A6:D6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:D6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:D6')->getAlignment()->setWrapText(true);
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(20.54); 
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(10.5);    
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(10.5);  
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10.88); 
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(20.88); 
			
			 
			$filename="Data Kekuatan SDM Pegawai Kontrak.xls"; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		
		}
		
	}
	
	function excel_rekapitulasi_jumlah_pegawai_kontrak_jenis_kelamin()
	{
		$jenis = $this->uri->segment(3);
		if($jenis != 'ALL'){
			ini_set("memory_limit","300M");
			
			$datestring = "%Y-%m-%d" ;
			$time = time();
			$tanggal = mdate($datestring, $time);
			
			$pegawai = $this->kepegawaian->get_data_pegawai_aktif_unlimited($jenis);
					
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle("Data Pegawai ");
			//JUDUL KOP
			$this->excel->getActiveSheet()->setCellValue('A2', 'DATA JUMLAH PEGAWAI KONTRAK BERDASARKAN JENIS KELAMIN');
			$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
			$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
			
			$this->excel->getActiveSheet()->setCellValue('F5', 'Update : '.mdate('%d %F %Y',time()));
			
			$this->excel->getActiveSheet()->setCellValue('A6', 'NO');
			$this->excel->getActiveSheet()->setCellValue('B6', 'UNIT');
			$this->excel->getActiveSheet()->setCellValue('C6', 'LAKI-LAKI');
			$this->excel->getActiveSheet()->setCellValue('D6', 'PEREMPUAN');
			$this->excel->getActiveSheet()->setCellValue('E6', 'JUMLAH');
			$this->excel->getActiveSheet()->setCellValue('F6', 'KET');
			
			$i=7;
			$number=0;
			$unitl=0;
			$unitp=0;
			$totall=0;
			$totalp=0;
			
			$unit="kosong";
			
			$nipp = '';
			foreach ($pegawai as $row_pegawai) :
			{ 
				
				if($row_pegawai['p_unt_kode_unit'] !== $unit){
					$i++;
					$number++;
					$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
					$this->excel->getActiveSheet()->setCellValue("B$i", strtoupper("$row_pegawai[nama_unit]"));
					$this->excel->getActiveSheet()->setCellValue("C$i", $unitl);
					$this->excel->getActiveSheet()->setCellValue("D$i", $unitp);
					$this->excel->getActiveSheet()->setCellValue("E$i", $unitl+$unitp);
					$unitl=0;
					$unitp=0;
				}else{
					if($row_pegawai['peg_jns_kelamin']=='L'){
						$unitl++;
						$totall++;
					} else 
					if($row_pegawai['peg_jns_kelamin']=='P'){
						$unitp++;
						$totalp++;
					}
				}
							
			
				$unit = $row_pegawai['p_unt_kode_unit'];
				$sub_unit = $row_pegawai['p_unt_kode_sub_unit'];
			}endforeach;
			$this->excel->getActiveSheet()->setCellValue("A$i", "");
			$this->excel->getActiveSheet()->setCellValue("B$i", "TOTAL");
			$this->excel->getActiveSheet()->setCellValue("C$i", $totall);
			$this->excel->getActiveSheet()->setCellValue("D$i", $totalp);
			$this->excel->getActiveSheet()->setCellValue("E$i", $totall+$totalp);
			
			$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle("A6:F7")->getFont()->setSize(8);
			$this->excel->getActiveSheet()->getStyle("A8:F$i")->getFont()->setSize(8);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells('A2:F2');
			$this->excel->getActiveSheet()->mergeCells('A3:F3');
			$this->excel->getActiveSheet()->mergeCells('A4:F4');
			$this->excel->getActiveSheet()->getStyle("F5")->getFont()->setSize(7);
			
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:F6')->getAlignment()->setWrapText(true);
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(8.54);  
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(25.54); 
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15.54);    
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15.54);  
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15.54); 
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(18.88); 
			
			 
			$filename="Data Rekapitulasi Jumlah Pegawai $jenis Berdasarkan Jenis Kelamin.xls"; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		
		}
	}
	
	
	function excel_rekapitulasi_jumlah_sdm()
	{
		$jenis = $this->uri->segment(3);
		if($jenis != 'ALL'){
			ini_set("memory_limit","300M");
			
			$datestring = "%Y-%m-%d" ;
			$time = time();
			$tanggal = mdate($datestring, $time);
			
			$pegawai = $this->kepegawaian->get_data_pegawai_aktif_jabatan_unlimited($jenis);
					
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			$this->excel->getActiveSheet()->setTitle("Data Pegawai ");
			//JUDUL KOP
			$this->excel->getActiveSheet()->setCellValue('A2', 'REKAPITULASI DATA PEGAWAI '.strtoupper($jenis));
			$this->excel->getActiveSheet()->setCellValue('A3', 'PT. GAPURA ANGKASA CABANG BANDARA NGURAH RAI');
			$this->excel->getActiveSheet()->setCellValue('A4', 'DENPASAR');
			
			$this->excel->getActiveSheet()->setCellValue('M5', 'Update : '.mdate('%d %F %Y',time()));
			
			$this->excel->getActiveSheet()->setCellValue('A6', 'NO URUT');
			$this->excel->getActiveSheet()->setCellValue('B6', 'NO JLH');
			$this->excel->getActiveSheet()->setCellValue('C6', 'NO UNIT');
			$this->excel->getActiveSheet()->setCellValue('D6', 'NAMA PEGAWAI');
			$this->excel->getActiveSheet()->setCellValue('E6', 'NIPP');
			$this->excel->getActiveSheet()->setCellValue('F6', 'GRADE');
			$this->excel->getActiveSheet()->setCellValue('G6', 'M.K.A');
			$this->excel->getActiveSheet()->setCellValue('H6', 'T.M.T GA/GP');
			$this->excel->getActiveSheet()->setCellValue('I6', 'JENIS KELAMIN');
			$this->excel->getActiveSheet()->setCellValue('J6', 'TGL LAHIR');
			$this->excel->getActiveSheet()->setCellValue('K6', 'UMUR');
			$this->excel->getActiveSheet()->setCellValue('L6', 'T.M.T MUTASI');
			$this->excel->getActiveSheet()->setCellValue('M6', 'JABATAN');
			$this->excel->getActiveSheet()->setCellValue('N6', 'KET');
			
			
			
			$i=7;
			$number=0;
			$nojumlah=0;
			$nounit=0;
			$unit="kosong";
			$sub_unit="kosong";
			
			$nipp = '';
			foreach ($pegawai as $row_pegawai) :
			{ 
				$i++;
				$number++;
				if($row_pegawai['peg_jns_kelamin'] == "P"){ $jk="Perempuan"; }
				else{$jk="Laki-Laki";}
				if ($row_pegawai['peg_tgl_lahir'] == "0000-00-00" ){ $tgl_lahir = "-";}
				else{$tgl_lahir = mdate("%d-%m-%Y",strtotime($row_pegawai['peg_tgl_lahir']));}
				 
				if($row_pegawai['p_unt_kode_unit'] !== $unit){
					$nojumlah = 0;
					$nounit = 0;
					$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_pegawai[nama_unit]"));
					$this->excel->getActiveSheet()->getStyle("D$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff00');
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getFont()->setBold(true);
					$i++;
				}
				if($row_pegawai['p_unt_kode_sub_unit'] !== $sub_unit){
					$nounit = 0;
					$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_pegawai[su_sub_unit]"));
					$this->excel->getActiveSheet()->getStyle("D$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('ffff77');
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
					$this->excel->getActiveSheet()->getStyle("D$i")->getFont()->setBold(true);
					$i++;
				}
				$nojumlah++;
				$nounit++;
				
				$mka = floor((time() -(strtotime($row_pegawai['p_tmt_tmt'])))/(365*24*60*60));
				$umur = floor((time() -(strtotime($row_pegawai['peg_tgl_lahir'])))/(365*24*60*60));
				
				//masukkan data ke tabel excel
				$this->excel->getActiveSheet()->setCellValue("A$i", "$number");
				$this->excel->getActiveSheet()->setCellValue("B$i", "$nojumlah");
				$this->excel->getActiveSheet()->setCellValue("C$i", "$nounit");
				$this->excel->getActiveSheet()->setCellValue("D$i", strtoupper("$row_pegawai[peg_nama]"));
				$this->excel->getActiveSheet()->setCellValue("E$i", strtoupper("$row_pegawai[peg_nipp]"));
				$this->excel->getActiveSheet()->setCellValue("F$i", strtoupper("$row_pegawai[p_grd_grade]"));
				$this->excel->getActiveSheet()->setCellValue("G$i", $mka);
				$this->excel->getActiveSheet()->setCellValue("H$i", "$row_pegawai[peg_jns_kelamin]");
				$this->excel->getActiveSheet()->setCellValue("I$i", "$row_pegawai[p_tmt_tmt]");
				$this->excel->getActiveSheet()->setCellValue("J$i", mdate('%d-%M-%y',strtotime($row_pegawai['peg_tgl_lahir'])));
				$this->excel->getActiveSheet()->setCellValue("K$i", $umur);
				$this->excel->getActiveSheet()->setCellValue("L$i", "-");
				$this->excel->getActiveSheet()->setCellValue("M$i", strtoupper($row_pegawai['p_jbt_jabatan']));
				$this->excel->getActiveSheet()->setCellValue("N$i", "-");//masukkan data ke tabel excel
			
				$unit = $row_pegawai['p_unt_kode_unit'];
				$sub_unit = $row_pegawai['p_unt_kode_sub_unit'];
			}endforeach;
			
			//change the font size
			$this->excel->getActiveSheet()->getStyle("A2:A4")->getFont()->setSize(14);
			$this->excel->getActiveSheet()->getStyle("A6:N7")->getFont()->setSize(8);
			$this->excel->getActiveSheet()->getStyle("A8:N$i")->getFont()->setSize(8);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A6:N6')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells('A2:N2');
			$this->excel->getActiveSheet()->mergeCells('A3:N3');
			$this->excel->getActiveSheet()->mergeCells('A4:N4');
			$this->excel->getActiveSheet()->getStyle("M5")->getFont()->setSize(7);
			
			//set aligment to center for that merged cell (A1 to D1)
			$this->excel->getActiveSheet()->getStyle('A6:N6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:N6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('A6:N6')->getAlignment()->setWrapText(true);
			//Set column widths                                                       
			$this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(5.54);  
			$this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(5.54); 
			$this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(5.54);    
			$this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(26.5);  
			$this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(10.88); 
			$this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(10.88); 
			$this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(5.63); 
			$this->excel->getActiveSheet()->getColumnDimension('H')->setWidth(8.88); 
			$this->excel->getActiveSheet()->getColumnDimension('I')->setWidth(14.88); 
			$this->excel->getActiveSheet()->getColumnDimension('J')->setWidth(10.88); 
			$this->excel->getActiveSheet()->getColumnDimension('K')->setWidth(5.88); 
			$this->excel->getActiveSheet()->getColumnDimension('L')->setWidth(15.88); 
			$this->excel->getActiveSheet()->getColumnDimension('M')->setWidth(15.88); 
			$this->excel->getActiveSheet()->getColumnDimension('N')->setWidth(15.88); 
			
			 
			$filename="Data Rekapitulasi Pegawai $jenis.xls"; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache
						 
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			$objWriter->save('php://output');
		
		}
		
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */