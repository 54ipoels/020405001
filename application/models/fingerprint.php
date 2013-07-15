<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fingerprint extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_ip()
	{
		$query = $this->db->get('v3_fingerprint_machine');
		return $query->result();
	}
	
	public function save_log($fp_ip, $fp_status)
	{
		$this->db->insert('v3_fingerprint_log', array('fl_ip' => $fp_ip, 'fl_log' => $fp_status)); 
	}

	function save_data($fd_ip,$fd_nipp,$fd_datetime,$fd_status,$fd_grab, $fd_update_by)
	{
		$data = array(
		   'fd_ip' => $fd_ip,
		   'fd_nipp' => $fd_nipp,
		   'fd_datetime' => $fd_datetime,
		   'fd_status' => $fd_status,
		   'fd_grab' => $fd_grab,
		   'fd_update_by' => $fd_update_by,
		);

		$this->db->insert('v3_fingerprint_data', $data); 
	}
	
	function check_dup_data($fd_ip,$fd_nipp,$fd_datetime,$fd_status,$fd_grab, $fd_update_by)
	{
		$this->db->where('fd_ip', $fd_ip); 
		$this->db->where('fd_nipp', $fd_nipp); 
		$this->db->where('fd_datetime', $fd_datetime); 
		$this->db->where('fd_status', $fd_status); 
		$this->db->from('v3_fingerprint_data');
		$dup = $this->db->get();
		return $dup->num_rows();
	}
	
	function del_invalid_data()
	{
		$this->db->delete('v3_fingerprint_data', array('fd_datetime' => '0000-00-00 00:00:00')); 
	}
	
	# in data ----------------------
	
	function get_unverify_data_in()
	{
		$today = mdate("%Y-%m-%d", time());
		$this->db->where('fd_status	', '0'); 
		$this->db->where('fd_grab	', '0');
		$this->db->where('DATE(fd_datetime)', $today);
		$this->db->from('v3_fingerprint_data');
		$this->db->group_by(array("fd_nipp", "DATE(fd_datetime)")); 
		$query_in =  $this->db->get();
		return $query_in->result();
	}
	
	
	function get_first_in($nipp, $datetime)
	{
		$datetime = mdate("%Y-%m-%d",strtotime($datetime));
		/*$query_first_in = ('
			SELECT *, MIN(fd_id) as id FROM v3_fingerprint_data 
			WHERE fd_nipp = "' . $nipp . '"
			AND  DATE(fd_datetime) = "' . $datetime . '"
			AND fd_status = 0
			AND fd_grab = 0
			');	*/
			
			$query_first_in = ('
			SELECT * FROM v3_fingerprint_data 
			WHERE fd_nipp = "' . $nipp . '"
			AND  DATE(fd_datetime) = "' . $datetime . '"
			AND fd_status = 0
			AND fd_grab = 0
			ORDER BY fd_id ASC
			LIMIT 1
			');
			
			$query_first_in = $this->db->query($query_first_in);
			return $query_first_in->result();
	}
	
	function save_first_in($fd_nipp_in, $fd_datetime_in)
	{
		$data = array(
               'fdv_nipp' => $fd_nipp_in,
			   'fdv_datetime' => $fd_datetime_in,
			   'fdv_status' => '0',
			   'fdv_grab' => '0',
			   'fdv_update_by' => 'system',
            );

		$this->db->insert('v3_fingerprint_data_verified', $data); 
		$verifiy_id = $this->db->insert_id();
		return $verifiy_id;	
	}
	
	function update_grab($id)
	{
		$data = array(
               'fd_grab' => '1',
            );

		$this->db->where('fd_id', $id);
		$this->db->update('v3_fingerprint_data', $data); 
	}
	
	function get_id_sched_in($fd_nipp_in, $fd_datetime_in)
	{
		$max_before_schedule = 2;
		$max_after_schedule = 4;
		$month = mdate("%m", strtotime($fd_datetime_in));
		$year = mdate("%Y", strtotime($fd_datetime_in));
		
		#echo $fd_nipp . '/' . $fd_datetime . '/' . $fd_status . '/' . $month . '/' . $year . '/' ;
		
		$query_id_sched = ('
				SELECT * 
				FROM  `v3_fschpeg_absensi_' . $year . '` AS fschpegabs
				LEFT JOIN ( SELECT * FROM  `v3_fsch_pegawai`) AS fschpeg ON  `fschpegabs`.`fschpegabs_fschpeg_id` =  `fschpeg`.`fschpeg_id` 
				LEFT JOIN ( SELECT id_pegawai, peg_nipp FROM  `v3_pegawai`) AS peg ON  `fschpeg`.`fschpeg_id_pegawai` =  `peg`.`id_pegawai` 
				WHERE  `peg`.`peg_nipp` =  "' . $fd_nipp_in . '"
				AND  `fschpeg`.`fschpeg_month` =  " ' . $month . ' "
				AND  `fschpeg`.`fschpeg_year` =  "' . $year . '"
				AND 
				(
				HOUR(TIMEDIFF("'. $fd_datetime_in .'", `fschpegabs_sch_time_in`) ) <= ' .  $max_before_schedule . '
				OR
				HOUR(TIMEDIFF(`fschpegabs_sch_time_in`, "'. $fd_datetime_in .'") ) <= ' .  $max_after_schedule . '
				)
				LIMIT 1
			');
		#AND `fschpegabs_real_time_in` = "0000-00-00 00:00:00"
		$query_id_sched = $this->db->query($query_id_sched);
		return $query_id_sched->result();
				
	}
	
	function inject_schedule_in($id_sched, $datetime)
	{
		$year = mdate("%Y", strtotime($datetime));
		
		$data = array(
               'fschpegabs_real_time_in' => $datetime,
            );

		$this->db->where('fschpegabs_id', $id_sched);
		$this->db->update('v3_fschpeg_absensi_'. $year, $data); 
	}

	function update_grab_verify($verifiy_id)
	{
		$data = array(
               'fdv_grab' => '1',
            );

		$this->db->where('fdv_id', $verifiy_id);
		$this->db->update('v3_fingerprint_data_verified', $data); 
	}
	
	
	# in data ----------------------
	
	
	# out data ----------------------
	
	function get_unverify_data_out()
	{
		$today = mdate("%Y-%m-%d", time());
		$this->db->where('fd_status	', '1'); 
		$this->db->where('fd_grab	', '0');
		$this->db->where('DATE(fd_datetime)', $today);
		$this->db->from('v3_fingerprint_data');
		$this->db->group_by(array("fd_nipp", "DATE(fd_datetime)")); 
		$query_out =  $this->db->get();
		return $query_out->result();
	}
	
	function get_last_out($nipp, $datetime)
	{
		$datetime = mdate("%Y-%m-%d",strtotime($datetime));
		$query_last_out = ('
			SELECT * FROM v3_fingerprint_data 
			WHERE fd_nipp = "' . $nipp . '"
			AND  DATE(fd_datetime) = "' . $datetime . '"
			AND fd_status = 1
			AND fd_grab = 0
			ORDER BY fd_id DESC
			LIMIT 1
			');	
			
			$query_last_out = $this->db->query($query_last_out);
			return $query_last_out->result();
	}
	
	function save_last_out($fd_nipp_out, $fd_datetime_out)
	{
		$data = array(
               'fdv_nipp' => $fd_nipp_out,
			   'fdv_datetime' => $fd_datetime_out,
			   'fdv_status' => '1',
			   'fdv_grab' => '0',
			   'fdv_update_by' => 'system',
            );

		$this->db->insert('v3_fingerprint_data_verified', $data); 
		$verifiy_id = $this->db->insert_id();
		return $verifiy_id;	
	}
	
	function get_id_sched_out($fd_nipp_out, $fd_datetime_out)
	{
		$max_before_schedule = 4;
		$max_after_schedule = 4;
		$month = mdate("%m", strtotime($fd_datetime_out));
		$year = mdate("%Y", strtotime($fd_datetime_out));
		
		#echo $fd_nipp . '/' . $fd_datetime . '/' . $fd_status . '/' . $month . '/' . $year . '/' ;
		
		$query_id_sched = ('
				SELECT * 
				FROM  `v3_fschpeg_absensi_' . $year . '` AS fschpegabs
				LEFT JOIN ( SELECT * FROM  `v3_fsch_pegawai`) AS fschpeg ON  `fschpegabs`.`fschpegabs_fschpeg_id` =  `fschpeg`.`fschpeg_id` 
				LEFT JOIN ( SELECT id_pegawai, peg_nipp FROM  `v3_pegawai`) AS peg ON  `fschpeg`.`fschpeg_id_pegawai` =  `peg`.`id_pegawai` 
				WHERE  `peg`.`peg_nipp` =  "' . $fd_nipp_out . '"
				AND  `fschpeg`.`fschpeg_month` =  " ' . $month . ' "
				AND  `fschpeg`.`fschpeg_year` =  "' . $year . '"
				AND 
				(
				HOUR(TIMEDIFF("'. $fd_datetime_out .'", `fschpegabs_sch_time_out`) ) <= ' .  $max_after_schedule . '
				OR
				HOUR(TIMEDIFF(`fschpegabs_sch_time_out`, "'. $fd_datetime_out .'") ) <= ' .  $max_before_schedule . '
				)
				LIMIT 1
				
			');
		#AND `fschpegabs_real_time_out` = "0000-00-00 00:00:00"
		$query_id_sched = $this->db->query($query_id_sched);
		return $query_id_sched->result();
				
	}
	
	function inject_schedule_out($id_sched, $fd_datetime_out)
	{
		$year = mdate("%Y", strtotime($fd_datetime_out));
		
		$data = array(
               'fschpegabs_real_time_out' => $fd_datetime_out,
            );

		$this->db->where('fschpegabs_id', $id_sched);
		$this->db->update('v3_fschpeg_absensi_'. $year, $data); 
	}
	
	# out data ----------------------
	
	/*function get_last_out($fd_nipp, $fd_datetime, $fd_status)
	{
		$query = ('
			SELECT *, MAX(fd_id) as id FROM v3_fingerprint_data 
			WHERE fd_nipp = ' . $fd_nipp . '
			AND  DATE(fd_datetime) = " ' . $fd_datetime . '"
			AND fd_status = "1"
			AND fd_grab = "0"
			');	
			
			$query = $this->db->query($query);
			return $query->result();
	}*/
	
	# api ------------------------------
	
	function get_my_data_today($nipp)
	{
		#$today = mdate("%Y-%m-%d", time());
		$today = mdate("%Y-%m-%d", strtotime('-1 week', time())) ; 
		
		$this->db->where('fd_nipp', $nipp);
		$this->db->where('DATE(fd_datetime) >', $today);
		$this->db->order_by('fd_datetime', 'ASC');
		$this->db->from('v3_fingerprint_data');	
		
		$query = $this->db->get();
		return $query->result();
	}
	
	# api -----------------------------
	
	
	
	
	
	
}