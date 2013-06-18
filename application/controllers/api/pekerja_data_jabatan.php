<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerja_data_jabatan extends Application {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('detail/detail_kepegawaian');
		$this->load->library('table');
	}
	
	public function index($nipp)
	{
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		if($data['pegawai'] == 0){}
		else{
			$data['data_jabatan_tmt'] = $this->kepegawaian->get_detail_pegawai_jabatan_tmt($nipp);
			$data['data_tmt'] = $this->kepegawaian->get_detail_pegawai_tmt($nipp);
			$data['data_unit'] = $this->kepegawaian->get_detail_pegawai_unit($nipp);
			$data['data_grade'] = $this->kepegawaian->get_detail_pegawai_grade($nipp);
			$data['data_jabatan'] = $this->kepegawaian->get_last_jabatan($nipp);
		}
	}
	
}
?>