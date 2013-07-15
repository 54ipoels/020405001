<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class Absensi_pribadi extends REST_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('fingerprint');
	}
	
	public function absensi_get()
	{
		if(!$this->get('nipp'))
        {
        	$this->response(NULL, 400);
        }
		else
		{
			$nipp = $this->get('nipp');
			$data = $this->fingerprint->get_my_data_today($nipp);
			$this->response($data, 200); // 200 being the HTTP response code
		}
	}
	

	
}
?>