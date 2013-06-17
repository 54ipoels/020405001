<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creator extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->helper('html');
		$this->load->model('kepegawaian/kepegawaian');
		$this->load->model('pdf/pdf_creator');
		$this->load->library('table');
		$this->load->helper('skm_pdf');
    }

	public function pegawai_pdf()
	{
		$data['data_pegawai'] = $this->pdf_creator->get_data_pegawai_pdf();
		$stream = TRUE; 
		$papersize = 'letter'; 
		$orientation = 'potrait';
		$filename = 'ems-dps-' .mdate("%d%m%Y%H%i%s", time());
		
		$html = $this->load->view('pdf_view/pegawai_pdf', $data, true);
     	pdf_create($html, $filename, $stream, $papersize, $orientation);
	}
	
	public function create_pdf_kompetensi($nipp)
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
		
		
		$stream = TRUE; 
		$papersize = 'letter'; 
		$orientation = 'landscape';
		$filename = 'ems-dps-' .mdate("%d%m%Y%H%i%s", time());
		
		$html = $this->load->view('kepegawaian/print/data_kompetensi', $data, true);
		pdf_create($html, $filename, $stream, $papersize, $orientation);
	}
	
}