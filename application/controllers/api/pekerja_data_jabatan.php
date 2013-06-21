<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require APPPATH.'/libraries/REST_Controller.php';


class Pekerja_data_pribadi extends REST_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('detail/detail_kepegawaian');
	}
	
	public function jabatan_get()
	{
		if(!$this->get('nipp'))
        {
        	$this->response(NULL, 400);
        }
		else
		{
			$nipp = $this->get('nipp');
			$data = $this->detail_kepegawaian->get_detail_pegawai_jabatan_unit_grade_by_nipp($nipp);
			$this->response($data, 200); // 200 being the HTTP response code
		}
		
		/*
		$data['pegawai'] = $this->kepegawaian->get_data_pegawai_by_nipp($nipp);
		if($data['pegawai'] == 0){}
		else{
			$data['data_jabatan_tmt'] = $this->kepegawaian->get_detail_pegawai_jabatan_tmt($nipp);
			$data['data_tmt'] = $this->kepegawaian->get_detail_pegawai_tmt($nipp);
			$data['data_unit'] = $this->kepegawaian->get_detail_pegawai_unit($nipp);
			$data['data_grade'] = $this->kepegawaian->get_detail_pegawai_grade($nipp);
			$data['data_jabatan'] = $this->kepegawaian->get_last_jabatan($nipp);
		}
		*/
	}
	
}
?>