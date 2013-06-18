<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerja_data_pendidikan extends Application {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('detail/detail_kepegawaian');
		$this->load->library('table');
	}
	
	public function index($nipp)
	{
		$data['pegawai'] = $this->detail_kepegawaian->get_data_pegawai_by_nipp($nipp);
		if($data['pegawai'] == 0){}
		else{
			$data['data_pendidikan'] = $this->detail_kepegawaian->get_detail_pegawai_pendidikan($nipp);
			$data['jumlah_bahasa'] = $this->kepegawaian->count_result_bahasa($nipp);
			$data['data_bahasa'] = $this->kepegawaian->get_detail_pegawai_bahasa($nipp);
		}
	}
	
	
}
?>