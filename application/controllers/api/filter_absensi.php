<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filter_absensi extends Application {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('m_filter_absensi');
	}
	
	public function index()
	{
		$this->m_filter_absensi->copy_dbmesin_to_datatampung();
		
		$backup = $this->m_filter_absensi->get_data_tampung();
		if($backup !== 0){
			foreach ($backup as $row){
				print_r($row);
				$year 		=substr($row['dt_datetime'],0,4);
				$nipp		=$row['dt_nipp'];
				$datetime	=$row['dt_datetime'];
				$status		=$row['dt_status'];
				if(($datetime !== "0000-00-00 00:00:00") OR ($nipp !== "") ){
					$dup = $this->m_filter_absensi->cek_dup_tabel_absensi($nipp,$datetime,$status);
					foreach ($dup as $row_dup)
					{
						$this->m_filter_absensi->cek_selisih_absen_terdekat($datetime,$nipp,$status,$row_dup,$year);
					}
				}
			}
			$this->m_filter_absensi->truncate_data_tampung(); // mengosongkan tabel datatampung  dengan menyisakan 1 data terakhir sebagai kondisi selanjutnya 
		}
	}

}	