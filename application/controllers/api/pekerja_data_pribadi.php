<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Pekerja_data_pribadi extends REST_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('detail_kepegawaian');
	}
	
	public function pribadi_get()
	{
		if(!$this->get('nipp'))
        {
        	$this->response(NULL, 400);
        }
		else
		{
			$nipp = $this->get('nipp');
			$data = $this->detail_kepegawaian->get_data_pegawai_by_nipp($nipp);
			$this->response($data, 200); // 200 being the HTTP response code
		}
	}
	
	public function alamat_get()
	{
		if(!$this->get('nipp'))
        {
        	$this->response(NULL, 400);
        }
		else
		{
			$nipp = $this->get('nipp');
			$data = $this->detail_kepegawaian->get_detail_pegawai_alamat($nipp);
			$this->response($data, 200); // 200 being the HTTP response code
		}
	}
	
	public function pasangan_get()
	{
		if(!$this->get('nipp'))
        {
        	$this->response(NULL, 400);
        }
		else
		{
			$nipp = $this->get('nipp');
			$data = $this->detail_kepegawaian->get_detail_pegawai_pasangan($nipp);
			$this->response($data, 200); // 200 being the HTTP response code
		}
	}
	
	
	public function anak_get()
	{
		if(!$this->get('nipp'))
        {
        	$this->response(NULL, 400);
        }
		else
		{
			$nipp = $this->get('nipp');
			$data = $this->detail_kepegawaian->get_detail_pegawai_anak($nipp);
			$this->response($data, 200); // 200 being the HTTP response code
		}
	}
	
}
?>