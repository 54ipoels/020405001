<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_tarik_absensi extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function cek_dup_backup_mesin($pin,$datetime,$status){
		$tgl=$datetime;
		$query ="
					SELECT * FROM v3_databackup_mesin 
					WHERE dbmesin_nipp = '$pin'
					AND dbmesin_datetime = '$tgl'  
					AND dbmesin_status = '$status'
				";
		$query = $this->db->query($query);
		return $query->num_rows(); 
	}
	
	function cek_data_backup_mesin($pin,$datetime,$status){
		$tgl=substr($datetime,0,10);
		if(($status == 0) OR ($status == 2) ){
			$query ="
					SELECT * FROM v3_databackup_mesin 
					WHERE dbmesin_nipp='$pin'
					AND dbmesin_datetime LIKE '$tgl%'  
					AND dbmesin_status = '$status'
				";
			$query = $this->db->query($query);
			return $query->num_rows(); 
		} else if( ($status == 1) OR ($status=3)){
			$query = "
					UPDATE v3_databackup_mesin 
					SET dbmesin_grab = 0
					WHERE dbmesin_nipp='$pin'
					AND dbmesin_datetime LIKE '$tgl%'  
					AND dbmesin_status = '$status' 
				";
			$query = $this->db->query($query);
			return 0; 
		}
	}
	
	
	#insert data mesin backup
	function input_data_backup_mesin($pin,$datetime,$status,$grab)
	{
		$data = array(
			'dbmesin_nipp' => $pin,
			'dbmesin_datetime' => $datetime, 
			'dbmesin_status' => $status,
			'dbmesin_grab' => $grab,
			'dbmesin_update_by' => 'admin'
      	);
      	$this->db->insert('v3_databackup_mesin', $data); 	
	}
	
}	
?>