<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerja_data_pribadi extends Application {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('detail/detail_kepegawaian');
		$this->load->library('table');
	}
	public function (){}
	
	public function index2($nipp)
	{
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		if($data['pegawai'] == 0){}
		else{
			$data['data_agama'] = $this->kepegawaian->get_detail_pegawai_agama($nipp);
			$data['data_fisik'] = $this->kepegawaian->get_detail_pegawai_fisik($nipp);
		}
		$this->load->view('detail_kepegawaian/data_pribadi',$data);
	}
	
}
?>