<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_filter_absensi extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function copy_dbmesin_to_datatampung(){
		$last = $this->latestpull();
		$query ="
				SELECT * FROM v3_databackup_mesin
				WHERE dbmesin_grab = 1
				AND dbmesin_update_on > '".$last."'
				";
		$query = $this->db->query($query);
		$result = $query->result_array();
		foreach($result as $row){
			$data = array(
						'dt_nipp' 		=> $row['dbmesin_nipp'] , 
						'dt_datetime' 	=> $row['dbmesin_datetime'] , 
						'dt_status' 	=> $row['dbmesin_status'] , 
						'dt_update_by'	=> 'admin',
					);
			$this->db->insert('v3_datatampung', $data); 
			
			$cekfilter = $this->cek_filter_absensi($row['dbmesin_nipp'], $row['dbmesin_datetime'], $row['dbmesin_status'] );
			if($cekfilter == 0 ){
				$datafilter = array(
							'filabs_nipp' 		=> $row['dbmesin_nipp'] , 
							'filabs_datetime' 	=> $row['dbmesin_datetime'] , 
							'filabs_status' 	=> $row['dbmesin_status'] , 
							'filabs_update_by'	=> 'admin',
						);
				$this->db->insert('v3_filter_absensi', $datafilter); 			
			} else {
				$datafilter = array(
							'filabs_datetime' 	=> $row['dbmesin_datetime'] , 
						);
				$this->db->where('filabs_id', $cekfilter);
				$this->db->update('v3_filter_absensi', $datafilter); 			
			}
		}
	}
	
	function cek_filter_absensi($nipp,$datetime,$status)
	{
		$tgl = substr($datetime,0,10);
		$query ="
					SELECT * FROM v3_filter_absensi
					WHERE filabs_nipp = '$nipp'
					AND filabs_status = '$status'
					AND filabs_datetime LIKE '$tgl%';
				";	
		$query = $this->db->query($query);
		if( $query->num_rows() > 0 ){
			$cek = $query->result_array();
			foreach ($cek as $row){}
			return $row['filabs_id'];
		} else {
			return 0;
		}
	}
	
	function latestpull(){
		$query = " SELECT MAX(filabs_update_on) AS 'lasttime' FROM v3_filter_absensi ";
		$query = $this->db->query($query);
		$result = $query->result_array();
		if ($query->num_rows() > 0 ){
			foreach($result as $row){}
			return $row['lasttime'];
		} else {
			return "0000-00-00 00:00:00";
		}
	}
	
	
	function cek_dup_tabel_absensi($nipp,$datetime,$status)
	{
		$tahun = substr($datetime,0,4);
		$bulan = substr($datetime,5,2);
		$selection = "";
		if ($status == '0')
		{
			$selection = " AND v3_fschpeg_absensi_$tahun.fschpegabs_sch_time_in LIKE '".substr($datetime,0,10)."%' ";
		}
		elseif ($status == '1')
		{
			$selection = " AND v3_fschpeg_absensi_$tahun.fschpegabs_sch_time_out LIKE '".substr($datetime,0,10)."%' ";
		} 
		elseif ($status == '2')
		{
			$selection = " AND v3_fschpeg_absensi_$tahun.fschpegabs_sch_break_in LIKE '".substr($datetime,0,10)."%' ";
		} 
		elseif ($status == '3')
		{
			$selection = " AND v3_fschpeg_absensi_$tahun.fschpegabs_sch_break_out LIKE '".substr($datetime,0,10)."%' ";
		} 
		
		$query = " SELECT * FROM v3_fschpeg_absensi_$tahun
					LEFT JOIN (SELECT * FROM v3_fsch_pegawai) AS fschpeg
					ON fschpeg.fschpeg_id = v3_fschpeg_absensi_$tahun.fschpegabs_fschpeg_id 
					LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
					ON fschpeg.fschpeg_id_pegawai = peg.id_pegawai 
					WHERE peg.peg_nipp=$nipp 
					$selection
				";
					
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function update_absensi_pegawai($data,$id,$year)
	{
		$this->db->where('fschpegabs_id', $id);
		$this->db->update('v3_fschpeg_absensi_'.$year, $data);
		//return $id;
	}
	
	function cek_selisih_absen_terdekat($datetime,$nipp,$status,$row_dup,$year)
	{
		$kemarin = date('Y-m-d',(strtotime($datetime) - (24*60*60)));
		$cek_kemarin = $this->cek_dup_tabel_absensi($nipp,$kemarin,$status);
		foreach ($cek_kemarin as $row_kemarin){}
		$besok = date('Y-m-d',(strtotime($datetime) + (24*60*60)));
		$cek_besok = $this->cek_dup_tabel_absensi($nipp,$besok,$status);
		foreach ($cek_besok as $row_besok){$n_besok=1;}
		
		if($status == 0){
			$sch = 'fschpegabs_sch_time_in';
			$real = 'fschpegabs_real_time_in';
		} 
		else if ($status == 1){
			$sch = 'fschpegabs_sch_time_out';
			$real = 'fschpegabs_real_time_out';
		}
		else if ($status == 2){
			$sch = 'fschpegabs_sch_break_in';
			$real = 'fschpegabs_real_break_in';
		}
		else if ($status == 3){
			$sch = 'fschpegabs_sch_break_out';
			$real = 'fschpegabs_real_break_out';
		}
		
		
		# cek selisih tgl masuk dengan sch  tgl ini
		if(strtotime($row_dup[$sch]) > strtotime($datetime)){
			$selisih[0] = strtotime($row_dup[$sch]) - strtotime($datetime);
		} else {
			$selisih[0] = strtotime($datetime) - strtotime($row_dup[$sch]);
		}
						
		# cek selisih tgl masuk dengan sch  tgl kemarin
		if(strtotime($row_kemarin[$sch]) > strtotime($datetime)){
			$selisih[1] = strtotime($row_kemarin[$sch]) - strtotime($datetime);
		} else {
			$selisih[1] = strtotime($datetime) - strtotime($row_kemarin[$sch]);
		}
		
		
		# cek selisih tgl masuk dengan sch  tgl besok
		if (isset($n_besok)){
			if(strtotime($row_besok[$sch]) > strtotime($datetime)){
				$selisih[2] = strtotime($row_besok[$sch]) - strtotime($datetime);
			} else {
				$selisih[2] = strtotime($datetime) - strtotime($row_besok[$sch]);
			}
		} else {
			$selisih[2] = 9999999999999;
		}		
		
		$terdekat=0;
		for ($i=1;$i<3;$i++){
			if ($selisih[$i] < $selisih[$terdekat]){
					$terdekat = $i;
			} 
		}
						
		$data =	array(
					$real => $datetime,
					'fschpegabs_update_by' => 'admin',
				);
		//print_r($data);echo " terdekat=$terdekat  status=$status  <br> ";
		
		if (($status == 0) OR ($status == 2)) {
			if($terdekat == 0){
				if($row_dup[$real]=="0000-00-00 00:00:00"){
					$this->update_absensi_pegawai($data,$row_dup['fschpegabs_id'],$year);
				}
			}
			else if($terdekat == 1){
				if($row_kemarin[$real]=="0000-00-00 00:00:00"){
					$this->update_absensi_pegawai($data,$row_kemarin['fschpegabs_id'],$year);
				}
			}
			else if($terdekat == 2){
				if($row_besok[$real]=="0000-00-00 00:00:00"){
					$this->update_absensi_pegawai($data,$row_besok['fschpegabs_id'],$year);
				}
			}
		} else 
		if(($status == 1) OR ($status == 3)) {
			if($terdekat == 0){
				$this->update_absensi_pegawai($data,$row_dup['fschpegabs_id'],$year);
			}
			else if($terdekat == 1){
				$this->update_absensi_pegawai($data,$row_kemarin['fschpegabs_id'],$year);
			}
			else if($terdekat == 2){
				$this->update_absensi_pegawai($data,$row_besok['fschpegabs_id'],$year);
			}
		}
		
	}
	
	function get_data_tampung()
	{
		$query = "SELECT * FROM v3_datatampung";
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result_array();
		}else{
			return 0;
		}
	}
	
	function truncate_data_tampung()
	{
		$query = " truncate table v3_datatampung ";
		$this->db->query($query);
	}
	
}

?>
