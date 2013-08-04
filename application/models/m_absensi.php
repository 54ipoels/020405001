<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_absensi extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/*
	=====================================================================================================
	 MODEL UNTUK LIBUR NASIONAL
	=====================================================================================================
	*/
	
	//tambah data libur nasional
	function lnas_add($lnas_date, $lnas_desc, $lnas_user)
	{
      $data = array(
      	'lnas_date' => $lnas_date, 
		'lnas_desc' => $lnas_desc,
        'lnas_update_by' => $lnas_user
      );
      
	  $this->db->insert('v3_libur_nasional', $data); 
      
	  if($this->db->affected_rows())
      	return '1';
      else
      	return '0';             
    }  
	
	//lihat data libur nasional keseluruhan
	function lnas_viewall()
	{
		return $this->db->order_by('lnas_date', 'asc')->get('v3_libur_nasional')->result();
	}
	
	//untuk check date apakah sudah ada dalam db
	function lnas_check($lnas_date)
	{
		return $this->db->get_where('v3_libur_nasional', array('lnas_date' => $lnas_date))->result(); 
	}
	
	function lnas_date($lnas_id)
	{
		$data = $this->db->get_where('v3_libur_nasional', array('lnas_id' => $lnas_id));
		
		if($this->db->affected_rows())
		{
			foreach ($data->result() as $row)
            {
				return $row->lnas_date;
			}
		}
	}
	
	//untuk menghapus data libur nasional
	function lnas_del($lnas_id)
	{
		return $this->db->delete('v3_libur_nasional', array('lnas_id' => $lnas_id)); 
	}
	
	//untuk mengambil data libur nasional yang mau diedit
	function lnas_viewedit($lnas_id)
	{
		return $this->db->order_by('lnas_date', 'asc')->get_where('v3_libur_nasional', array('lnas_id' => $lnas_id))->result(); 
	}
	
	//untuk menyimpan hasil data libur nasional yang sudah diedit
	function lnas_edit($lnas_id, $lnas_date, $lnas_desc, $lnas_user)
	{
		$data = array(
               'lnas_date' => $lnas_date,
               'lnas_desc' => $lnas_desc,
			   'lnas_update_by' => $lnas_user
        );
		
		$this->db->update('v3_libur_nasional', $data, array('lnas_id' => $lnas_id));
		
		if($this->db->affected_rows())
      		return '1';
      	else
      		return '0';
	}
	
	/*
	=====================================================================================================
	 MODEL UNTUK FORMAT SCHEDULE
	=====================================================================================================
	*/
	
	//lihat data format schedule keseluruhan
	function fsch_viewall()
	{
		return $this->db->order_by('fsch_id', 'asc')->get('v3_format_schedule')->result();
	}
	
	//lihat data format schedule detail
	function fsch_viewdetail($fsch_id)
	{
		return $this->db->order_by('fschtime_id', 'asc')->get_where('v3_fsch_time', array('fschtime_fsch_id' => $fsch_id))->result(); 
	}
	
	function fsch_getdata($fsch_id)
	{
		$query=	"	
					SELECT *
					FROM v3_format_schedule
					WHERE (fsch_id = $fsch_id)
				";
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	function fsch_getdetail($fsch_id)
	{
		$query=	"	
					SELECT *
					FROM v3_fsch_time
					WHERE (fschtime_fsch_id = $fsch_id)
					ORDER BY fschtime_id ASC
				";
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	
	//ambil data fsch_id dari tabel v3_format_schedule by name
	function fsch_getid($fsch_name)
	{
		$data =  $this->db->get_where('v3_format_schedule', array('fsch_name' => $fsch_name));
		if($this->db->affected_rows())
		{
			foreach ($data->result() as $row)
            {
				return $row->fsch_id;
			}
		}
		
	}
	
	//tambah data format schedule
	function fsch_add($fsch_name, $fsch_total_day, $fschtime_update_by)
	{
      $data = array(
      	'fsch_name' => $fsch_name, 
		'fsch_total_day' => $fsch_total_day,
		'fsch_update_by' => $fschtime_update_by
      );
      
	  $this->db->insert('v3_format_schedule', $data); 
      
	  if($this->db->affected_rows())
      	return '1';
      else
      	return '0';             
    }  
	
	//tambah data detail format schedule
	function fsch_add_next($fschtime_fsch_id, $fschtime_order, $fschtime_time_in, $fschtime_break_out, $fschtime_break_in, $fschtime_time_out, $fschtime_update_by, $fschtime_off_status,$fschtime_break_status)
	{
      $data = array(
      	'fschtime_fsch_id' => $fschtime_fsch_id, 
		'fschtime_order' => $fschtime_order,
		'fschtime_time_in' => $fschtime_time_in,
		'fschtime_break_out' => $fschtime_break_out,
		'fschtime_break_in' => $fschtime_break_in,
		'fschtime_time_out' => $fschtime_time_out,
		'fschtime_update_by' => $fschtime_update_by,
		'fschtime_off_status' => $fschtime_off_status,
		'fschtime_break_status' => $fschtime_break_status,
	 );
      
	  $this->db->insert('v3_fsch_time', $data); 
      
	  if($this->db->affected_rows())
      	return '1';
      else
      	return '0';             
    } 
	
	//untuk menghapus data master format schedule
	function fsch_del($fsch_id)
	{
		return $this->db->delete('v3_format_schedule', array('fsch_id' => $fsch_id)); 
	}
	
	//untuk menghapus data master format schedule time
	function fschtime_del($fsch_id)
	{
		return $this->db->delete('v3_fsch_time', array('fschtime_fsch_id' => $fsch_id)); 
	}
	
	function fsch_edit($fsch_id, $fsch_name, $fsch_total_day, $fschtime_update_by)
	{
      $data = array(
      	'fsch_name' => $fsch_name, 
		'fsch_total_day' => $fsch_total_day,
		'fsch_update_by' => $fschtime_update_by
      );
      
	 //$this->db->insert('v3_format_schedule', $data); 
	  $this->db->update('v3_format_schedule', $data, array('fsch_id' => $fsch_id));
      
	  if($this->db->affected_rows())
      	return '1';
      else
      	return '0';             
    }  
	
	function fsch_edit_next($fschtime_id, $fschtime_fsch_id, $fschtime_order, $fschtime_time_in, $fschtime_time_out, $fschtime_update_by, $fschtime_off_status)
	{
      $data = array(
      	'fschtime_fsch_id' => $fschtime_fsch_id, 
		'fschtime_order' => $fschtime_order,
		'fschtime_time_in' => $fschtime_time_in,
		'fschtime_time_out' => $fschtime_time_out,
		'fschtime_update_by' => $fschtime_update_by,
		'fschtime_off_status' => $fschtime_off_status
      );
      
	  $this->db->update('v3_fsch_time', $data, array('fschtime_id' => $fschtime_id)); 
      
	  if($this->db->affected_rows())
      	return '1';
      else
      	return '0';             
    } 
	
	
	/*
	=====================================================================================================
	 MODEL UNTUK FORMAT SCHEDULE ABSENSI
	=====================================================================================================
	*/
	
	// ambil data format schedule
	function ambil_data_format_schedule() 
	{
		return $this->db->get('v3_format_schedule')->result();
	}
	
	
	function cek_dup_data_format_schedule_pegawai($id_pegawai, $month, $year)
	{
		$query = " 	SELECT * FROM v3_fsch_pegawai 
					WHERE fschpeg_id_pegawai = '$id_pegawai' 
					AND fschpeg_month = '$month' 
					AND fschpeg_year = '$year' 
				";
		$query = $this->db->query($query);
	
		if( $query->num_rows() > 0 ){
			$result = $query->result_array();
			foreach($result as $row){}
			return $row['fschpeg_id'];
		} else {
			return 0;
		}
    }
	
	function insert_data_format_schedule_pegawai($fschpeg_id, $fsch, $id_pegawai, $month, $year, $update_by )
	{
		$data = array(
			'fschpeg_id' => $fschpeg_id,
			'fschpeg_fsch_id' => $fsch, 
			'fschpeg_id_pegawai' => $id_pegawai,
			'fschpeg_month' => $month,
			'fschpeg_year' => $year,
			'fschpeg_update_by' => $update_by
		);
      
		$this->db->insert('v3_fsch_pegawai', $data); 
		  
		if($this->db->affected_rows())
			return '1';
		else
			return '0';
	}
	
	function update_data_format_schedule_pegawai($fschpeg_id, $fsch, $update_by )
	{
		
		$data = array(
			'fschpeg_fsch_id' => $fsch, 
			'fschpeg_update_by' => $update_by,
		);
		
		$this->db->where('fschpeg_id', $fschpeg_id);
		$this->db->update('v3_fsch_pegawai', $data); 
		  
		if( $this->db->affected_rows() )
		{	return '1';}
		else
		{	return '0';}
	
	}
	
	 
	function cek_dup_data_format_schedule_pegawai_absensi($fschpeg_id, $time_in, $year)
	{
		$waktu = substr($time_in,0,10);
		$query = " 	SELECT * FROM v3_fschpeg_absensi_$year 
					WHERE fschpegabs_fschpeg_id = '$fschpeg_id' 
					AND fschpegabs_sch_time_in LIKE '$waktu%' 
				";
		$query = $this->db->query($query);
	
		if( $query->num_rows() > 0 ){
			$result = $query->result_array();
			foreach($result as $row){}
			return $row['fschpegabs_id'];
		} else {
			return 0;
		}
	}
	
	
	function insert_data_format_schedule_pegawai_absensi($fschpeg_id, $time_in, $break_out, $break_in, $time_out, $offstatus, $update_by, $year)
	{
		$data = array(
		'fschpegabs_fschpeg_id' => $fschpeg_id,
      	'fschpegabs_sch_time_in' => $time_in, 
		'fschpegabs_sch_break_out' => $break_out, 
		'fschpegabs_sch_break_in' => $break_in, 
		'fschpegabs_sch_time_out' => $time_out,
		'fschpegabs_off_status' => $offstatus,
		'fschpegabs_update_by' => $update_by
      );
      
	  $this->db->insert('v3_fschpeg_absensi_'.$year, $data); 
      
	  if($this->db->affected_rows())
      	return '1';
      else
      	return '0';
	}
	
	
	
	function update_data_format_schedule_pegawai_absensi($fschpegabs_id,$fschpeg_id, $time_in, $break_out, $break_in, $time_out, $offstatus, $update_by, $year)
	{
		$data = array(
				'fschpegabs_fschpeg_id' => $fschpeg_id,
				'fschpegabs_sch_time_in' => $time_in, 
				'fschpegabs_sch_break_out' => $break_out, 
				'fschpegabs_sch_break_in' => $break_in, 
				'fschpegabs_sch_time_out' => $time_out,
				'fschpegabs_off_status' => $offstatus,
				'fschpegabs_update_by' => $update_by
			);
      
	    $this->db->where('fschpegabs_id', $fschpegabs_id); 
        $this->db->update('v3_fschpeg_absensi_'.$year, $data); 
      
	    if($this->db->affected_rows())
        	return '1';
        else
			return '0';
	}
	
	//untuk ambil schedule pegwai
	// ambil data pegawai berdasarkan unit
	function ambil_data_schedule_pegawai($unit, $month, $year) 
	{
		$this->db->group_by('v3_pegawai.peg_nipp');
		$this->db->join('v3_pegawai', 'v3_pegawai.peg_nipp = v3_peg_unit.p_unt_nipp', 'left');
		$this->db->join('v3_fsch_pegawai', 'v3_fsch_pegawai.fschpeg_id_pegawai = v3_pegawai.id_pegawai', 'left');
		$this->db->where('v3_peg_unit.p_unt_kode_unit', $unit);
		$this->db->where('v3_peg_unit.p_unt_tmt_end', '0000-00-00');
		$this->db->where('v3_fsch_pegawai.fschpeg_month', $month); 
		$this->db->where('v3_fsch_pegawai.fschpeg_year', $year); 
		$data = $this->db->get('v3_peg_unit');
		
		return $data->result_array();
	}
	
	/*
	=====================================================================================================
	 MODEL UNTUK CUTI
	=====================================================================================================
	*/
	
	function cuti_add($id_pegawai, $totalcuti, $year, $update_by)
	{
      $data = array(
      	'cm_id_peg' => $id_pegawai, 
		'cm_total' => $totalcuti,
        'cm_year' => $year,
		'cm_status_aktif' => '1',
		'cm_update_by' => $update_by
      );
      
	  $this->db->insert('v3_cuti_master', $data); 
      
	  if($this->db->affected_rows())
      	return '1';
      else
      	return '0';             
    }  
	
	function cuti_pegawai($unit, $year)
	{
		$this->db->order_by('cm_id', 'asc');
		$this->db->join('v3_pegawai', 'v3_pegawai.id_pegawai = v3_cuti_master.cm_id_peg', 'left');
		$this->db->join('v3_peg_unit', 'v3_peg_unit.p_unt_nipp = v3_pegawai.peg_nipp', 'left');
		$this->db->where('v3_peg_unit.p_unt_kode_unit', $unit);
		$this->db->where('v3_peg_unit.p_unt_tmt_end', '0000-00-00');
		$this->db->where('v3_cuti_master.cm_year', $year);
		$data = $this->db->get('v3_cuti_master');
		
		return $data->result_array();
	}
		
	function cuti_del($cm_id)
	{
		return $this->db->delete('v3_cuti_master', array('cm_id' => $cm_id)); 
	}
	
	function cuti_viewedit($lnas_id)
	{
		return $this->db->order_by('lnas_date', 'asc')->get_where('v3_libur_nasional', array('lnas_id' => $lnas_id))->result(); 
	}
	
	function cuti_edit($lnas_id, $lnas_date, $lnas_desc, $lnas_user)
	{
		$data = array(
               'lnas_date' => $lnas_date,
               'lnas_desc' => $lnas_desc,
			   'lnas_update_by' => $lnas_user
        );
		
		$this->db->update('v3_libur_nasional', $data, array('lnas_id' => $lnas_id));
		
		if($this->db->affected_rows())
      		return '1';
      	else
      		return '0';
	}
	
	function cuti_pegawai_edit($cm_id, $id_pegawai, $totalcuti, $year, $update_by)
	{
		$data = array(
               'cm_total' => $totalcuti,
			   'cm_year' => $year,
			   'cm_update_by' => $update_by
        );
		
		$this->db->update('v3_cuti_master', $data, array('cm_id' => $cm_id,'cm_year' => $year,'cm_id_peg'=>$id_pegawai));
		
		if($this->db->affected_rows())
      		return '1';
      	else
      		return '0';
	}
	
	function get_detail_cuti_pegawai($cm_id,$year)
	{
		$query = "	
				SELECT * FROM v3_cuti_daily AS cd 
				LEFT JOIN (SELECT * FROM v3_cuti_master) AS cm
				ON cd.cd_cm_id = cm.cm_id
				LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
				ON cm.cm_id_peg = peg.id_pegawai
				WHERE cd.cd_cm_id='$cm_id' 
				AND cd.cd_tanggal LIKE '$year%' 
				ORDER BY cd.cd_tanggal DESC
			";
		$query = $this->db->query($query);
		if ($query->num_rows > 0 ){
			return  $query->result_array();
		} else {
			return 0;
		}
	}
	
	/*
	=====================================================================================================
	 MODEL UNTUK  ABSENSI
	=====================================================================================================
	*/
	
	function ambil_data_absensi($unit, $month, $year) 
	{
		$query ="
				SELECT * FROM (`v3_peg_unit`) 
				LEFT JOIN `v3_pegawai` ON `v3_pegawai`.`peg_nipp` = `v3_peg_unit`.`p_unt_nipp` 
				LEFT JOIN `v3_fsch_pegawai` ON `v3_fsch_pegawai`.`fschpeg_id_pegawai` = `v3_pegawai`.`id_pegawai` 
				WHERE `v3_peg_unit`.`p_unt_kode_unit` = '$unit' 
				AND `v3_peg_unit`.`p_unt_tmt_end` = '0000-00-00' 
				AND `v3_fsch_pegawai`.`fschpeg_month` = '$month' 
				AND `v3_fsch_pegawai`.`fschpeg_year` = '$year'
				GROUP BY `v3_pegawai`.`peg_nipp` 
				";
		$query = $this->db->query($query);
		return $query->result_array();
		
		/*
		$this->db->join('v3_pegawai', 'v3_pegawai.peg_nipp = v3_peg_unit.p_unt_nipp', 'left');
		$this->db->join('v3_fsch_pegawai', 'v3_fsch_pegawai.fschpeg_id_pegawai = v3_pegawai.id_pegawai', 'left');
		$this->db->where('v3_peg_unit.p_unt_kode_unit', $unit);
		$this->db->where('v3_peg_unit.p_unt_tmt_end', '0000-00-00');
		$this->db->where('v3_fsch_pegawai.fschpeg_month', $month); 
		$this->db->where('v3_fsch_pegawai.fschpeg_year', $year); 
		$data = $this->db->get('v3_peg_unit');
		
		return $data->result_array();
		*/
	}
	
	function ambil_data_detail_absensi($fschpeg_id,$year) 
	{
		$this->db->join('v3_fsch_pegawai', 'v3_fsch_pegawai.fschpeg_id = v3_fschpeg_absensi_'.$year.'.fschpegabs_fschpeg_id', 'left');
		$this->db->join('v3_pegawai', 'v3_pegawai.id_pegawai = v3_fsch_pegawai.fschpeg_id_pegawai', 'left');
		$this->db->where('fschpegabs_fschpeg_id', $fschpeg_id); 
		$data = $this->db->get('v3_fschpeg_absensi_'.$year);
		if($data->num_rows() > 0){
			return $data->result_array();
		} else {
			return 0;
		}
	}
	
	function ambil_data_detail_absensi_by_tanggal($fschpeg_id, $fschpeg_tanggal, $year) 
	{
		$this->db->join('v3_fsch_pegawai', 'v3_fsch_pegawai.fschpeg_id = v3_fschpeg_absensi_'.$year.'.fschpegabs_fschpeg_id', 'left');
		$this->db->join('v3_pegawai', 'v3_pegawai.id_pegawai = v3_fsch_pegawai.fschpeg_id_pegawai', 'left');
		$this->db->where('fschpegabs_fschpeg_id', $fschpeg_id); 
		$this->db->where('fschpegabs_id', $fschpeg_tanggal); 
		$data = $this->db->get('v3_fschpeg_absensi_'.$year);
		
		return $data->result_array();
	}
	
	function submit_edit_detail_absensi($fschpeg_id,$fschpeg_tanggal,$year, $data, $user)
	{
		$datestring = "%Y-%m-%d";
		$time = time();
		$date = mdate($datestring, $time);
		
		$data_absensi = array(
			'fschpegabs_sch_time_in' => $data['sch_in'], 
			'fschpegabs_sch_break_in' => $data['sch_break_in'], 
			'fschpegabs_sch_break_out' => $data['sch_break_out'], 
			'fschpegabs_sch_time_out' => $data['sch_out'],
			'fschpegabs_real_time_in' => $data['real_in'], 
			'fschpegabs_real_break_in' => $data['real_break_in'], 
			'fschpegabs_real_break_out' => $data['real_break_out'],
			'fschpegabs_real_time_out' => $data['real_out'],
			'fschpegabs_off_status' => $data['off_status'],
			//'fschpegabs_update_on' => $date,
			'fschpegabs_update_by' => $user
		);
		
		$this->db->where('fschpegabs_fschpeg_id', $fschpeg_id); 
		$this->db->where('fschpegabs_id', $fschpeg_tanggal); 
		
		$this->db->update('v3_fschpeg_absensi_'.$year, $data_absensi); 
	}
	
	
	/*
	=====================================================================================================
	 MODEL UNTUK  FINGER PRINT
	=====================================================================================================
	*/
	
	# delete null dbmesin_nipp
	function del_null_dbmesin_nipp()
	{
		$this->db->delete('v3_databackup_mesin', array('dbmesin_nipp' => '')); 
	}
	
	function del_dup_data_in()
	{
		/*# find dup in data
		$query = ('
		SELECT dbmesin_nipp, COUNT(*) nipp FROM v3_databackup_mesin GROUP BY dbmesin_nipp HAVING nipp > 1;
		');
		
		$data = $this->db->query($query);
		
		#if ( $query->result() > 1 )
		#{
			foreach ($data->result() as $row) :
				echo $row->dbmesin_nipp . '<br />';
			endforeach;
		#}*/
		
		$query = $this->db->query("SELECT dbmesin_nipp, COUNT(*) c FROM v3_databackup_mesin GROUP BY dbmesin_nipp HAVING c > 1");
		#$query = $this->db->query("SELECT DISTINCT dbmesin_nipp FROM v3_databackup_mesin GROUP BY dbmesin_nipp");
		
		return $query->result();
			
			#echo $query->num_rows();
			#print_r($query);
			#if($q->num_rows() > 1)
			#{
				/*foreach ($query->result() as $row)
				{
					echo $row->dbmesin_nipp . '<br />';
					#echo $row['name'];
					#echo $row['email'];
				}*/
				/*foreach ($q as $row) :
					echo $row->dbmesin_nipp . '<br />';
				endforeach;*/
			#}
			#else 
			#{
			#	echo "somethings wrong";
			#} 
		
		
		/*// select double data and remove the duplicate
				$sql="SELECT * FROM v3_databackup_mesin WHERE efvr_nipp = '$nipp' AND efvr_date = '$tanggal_bulan_tahun' AND efvr_status = '0'";
				$result=mysql_query($sql);
	
				$count=mysql_num_rows($result);
				
					if($count>1)
					{
						$sql="SELECT * FROM v2_ems_finger_verified_record WHERE efvr_nipp = '$nipp' AND efvr_date = '$tanggal_bulan_tahun' AND efvr_status = '0' ORDER BY efvr_id DESC LIMIT 1";
							$result = mysql_query($sql);
	
								while($row = mysql_fetch_array($result, MYSQL_ASSOC))
							{
								$efvr_id_del = $row['efvr_id'];
								mysql_query("DELETE FROM v2_ems_finger_verified_record WHERE efvr_id =  '$efvr_id_del'");
							} 
						
					}
				// select double data and remove the duplicate*/
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
	
	#insert data mesin to db absensi
	function input_data_absensi_mesin($pin,$datetime,$status)
	{
		# v3_fsch_pegawai cari nilai fschpeg_id-nya berdasarkan id_pegawai, month, dan year
		$this->db->update('v3_libur_nasional', $data, array('lnas_id' => $lnas_id));
	}
	
	function get_data_backup_mesin($tanggal)
	{
		$query = " 	SELECT * FROM v3_databackup_mesin WHERE dbmesin_update_on > '$tanggal'";
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	
	
	function cek_dup_tabel_absensi($nipp,$datetime,$status)
	{
		if($datetime == "0000-00-00 00:00:00"){$datetime = date('Y-m-d H:i:s');}
		$tahun = substr($datetime,0,4);
		$bulan = substr($datetime,5,2);
		$selection="";
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
		
		$query = "  SELECT * FROM v3_fschpeg_absensi_$tahun
					LEFT JOIN (SELECT * FROM v3_fsch_pegawai) AS fschpeg
					ON fschpeg.fschpeg_id = v3_fschpeg_absensi_$tahun.fschpegabs_fschpeg_id 
					LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
					ON fschpeg.fschpeg_id_pegawai = peg.id_pegawai 
					WHERE peg.peg_nipp = '$nipp' 
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
	
	# cek tanggal abensi null
	function cek_date_null_tabel_absensi($nipp,$kemarin,$status)
	{
		$year = substr($kemarin,0,4);
		if($status == 1){
			$subjek = 'fschpegabs_real_time_out';
		}elseif($status == 2){
			$subjek = 'fschpegabs_real_break_in';
		}elseif($status == 3){
			$subjek = 'fschpegabs_real_break_out';
		}
		
		$query = " 	SELECT * FROM v3_fschpeg_absensi_$year AS absen 
					LEFT JOIN (SELECT fschpeg_id,fschpeg_id_pegawai FROM v3_fsch_pegawai) AS schpeg
					ON schpeg.fschpeg_id = absen.fschpegabs_fschpeg_id 
					LEFT JOIN (SELECT id_pegawai,peg_nipp FROM v3_pegawai) AS peg
					ON peg.id_pegawai = schpeg.fschpeg_id_pegawai
					WHERE absen.fschpegabs_real_time_in LIKE '$kemarin%'
					AND peg.peg_nipp = '$nipp'
				";
		$query = $this->db->query($query);
		$result = $query->result_array();
		foreach ($result as $row){}
		if( (substr($row[$subjek],11,8) == "00:00:00")  AND  ( $row['fschpegabs_real_time_in'] !== "0000-00-00 00:00:00" ) )
		{
			return $result;
		} else {
			return 0;
		}
	}
	
	function ambil_data_absensi_by_time_in($year,$nipp,$datetime)
	{
		$query = " 	SELECT * FROM v3_fschpeg_absensi_$year AS absen 
					LEFT JOIN (SELECT fschpeg_id,fschpeg_id_pegawai FROM v3_fsch_pegawai) AS schpeg
					ON schpeg.fschpeg_id = absen.fschpegabs_fschpeg_id 
					LEFT JOIN (SELECT id_pegawai,peg_nipp FROM v3_pegawai) AS peg
					ON peg.id_pegawai = schpeg.fschpeg_id_pegawai
					WHERE absen.fschpegabs_real_time_in LIKE '$datetime%'
					AND peg.peg_nipp = '$nipp'
				";
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	# akhir cek 
	
	function cek_selisih_absen_terdekat($datetime,$nipp,$status,$row_dup,$year)
	{
		$kemarin = date('Y-m-d',(strtotime($datetime) - (24*60*60)));
		$cek_kemarin = $this->cek_dup_tabel_absensi($nipp,$kemarin,$status);
		foreach ($cek_kemarin as $row_kemarin){}
		$besok = date('Y-m-d',(strtotime($datetime) + (24*60*60)));
		$cek_besok = $this->cek_dup_tabel_absensi($nipp,$besok,$status);
		foreach ($cek_besok as $row_besok){$n_besok=1;}
/*
		echo "<br>$kemarin - $besok<br><br>";
		echo "row_dup";print_r($row_dup);
		echo "<br><br>";	
		echo "row_kemarin";print_r($row_kemarin);
		echo "<br><br>";	
		echo "row_besok";print_r($row_besok);
		echo "<br><br>$n_besok";	
*/		
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
		
		if (($status == 0) OR ($status == 2)){
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
		} else if( ($status == 1) OR ($status=3)) {
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
			$datafilter = array(
						'filabs_nipp' 		=> $row['dbmesin_nipp'] , 
						'filabs_datetime' 	=> $row['dbmesin_datetime'] , 
						'filabs_status' 	=> $row['dbmesin_status'] , 
						'filabs_update_by'	=> 'admin',
					);
			$this->db->insert('v3_filter_absensi', $datafilter); 			
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
	
	function get_data_tampung()
	{
		$query = "SELECT * FROM v3_datatampung ORDER BY dt_nipp,dt_datetime";
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