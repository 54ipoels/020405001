<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
require APPPATH.'/libraries/REST_Controller.php';

<<<<<<< HEAD
=======
require APPPATH.'/libraries/REST_Controller.php';

>>>>>>> 7060f40bea999e42cadbf58b1b92ec92d8adf287
class Pekerja_data_pribadi extends REST_Controller {

	
	public function __construct()
    {
        parent::__construct();
		$this->load->model('detail_kepegawaian');
<<<<<<< HEAD
		$this->load->library('table');
	}
	
	
	function pribadi_get()
	{
		
=======
	}
	
	public function pribadi_get()
	{
>>>>>>> 7060f40bea999e42cadbf58b1b92ec92d8adf287
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
	
}
?>