<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pekerja_data_alamat extends Application {

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
			$data['data_alamat'] = $this->detail_kepegawaian->get_detail_pegawai_alamat($nipp);
		}
	}
	
}
?>