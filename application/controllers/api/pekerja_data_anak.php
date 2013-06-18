<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerja_data_anak extends Application {

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
			$data['data_anak'] = $this->kepegawaian->get_detail_pegawai_anak($nipp);
		}
	}
	
}
?>