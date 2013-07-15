<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_asset extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	/*
	=======================================================================================
	 MULTI DROPDOWN GROUP => NIPP
	=======================================================================================
	*/
	
	// ambil data provider
	function ambil_data_provider() 
	{
		//return $this->db->order_by('unit_id', 'asc')->get('v3_unit')->result();
		$query=	" SELECT * FROM provider ORDER BY nomor ";
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	
	// ambil data unit
	function ambil_data_unit() 
	{
		//return $this->db->order_by('unit_id', 'asc')->get('v3_unit')->result();
		$query=	" SELECT * FROM unit ORDER BY kode_unit ";
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	
	// ambil data pegawai berdasarkan unit
	function ambil_data_pegawai($unit) 
	{
		
		$query = "
					SELECT * FROM v3_pegawai AS peg
					LEFT JOIN (	SELECT * FROM v3_peg_tmt ORDER BY p_tmt_update_on DESC ) AS peg_tmt ON peg.peg_nipp = peg_tmt.p_tmt_nipp
					LEFT JOIN (	SELECT * FROM v3_peg_unit ORDER BY p_unt_update_on DESC ) AS peg_unit ON peg.peg_nipp = peg_unit.p_unt_nipp
					WHERE peg_unit.p_unt_kode_unit =  '$unit'
					AND peg_unit.p_unt_tmt_end =  '0000-00-00'
					AND peg_tmt.p_tmt_end =  '0000-00-00'
					GROUP BY peg_unit.p_unt_nipp
				";
		$query = $this->db->query($query);
		return  $query->result_array();
		
	}
	
	function hitung_jumlah_pegawai_per_unit($unit)
	{
		$this->db->where('p_unt_kode_unit',$unit);
		$this->db->where('p_unt_tmt_end', '0000-00-00');
		return $this->db->count_all_results('v3_peg_unit');
	}
	
	
	
	
	// ambil data pegawai berdasarkan unit
	function ambil_data_pegawai_berdasarkan_nipp($nipp) 
	{
		$data = $this->db->get_where('v3_pegawai', array('peg_nipp' => $nipp));
		if($this->db->affected_rows())
		{
			foreach ($data->result() as $row)
            {
				return $row->id_pegawai;
			}
		}
	}
	
	// ambil data pegawai berdasarkan id
	function ambil_data_pegawai_berdasarkan_id($id) 
	{
		$data = $this->db->get_where('v3_pegawai', array('id_pegawai' => $id));
		return $data->result_array();
	}
	
	// ambil data pegawai berdasarkan unit
	function ambil_data_pegawai_cuti($id) 
	{
		$query="SELECT * 
				FROM  `v3_cuti_master` 
				LEFT JOIN v3_pegawai ON  `v3_cuti_master`.`cm_id_peg` =  `v3_pegawai`.`id_pegawai` 
				WHERE  `v3_cuti_master`.`cm_id`=$id
				";
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	
	// ambil data sisa cuti pegawai 
	function ambil_sisa_cuti_pegawai($id_pegawai,$tahun)
	{
		$data= $this->db->get_where('v3_cuti_master', array('cm_id_peg' => $id_pegawai , 'cm_year' => $tahun));
		
		if($this->db->affected_rows()){
			foreach ($data->result_array() as $result)
			{
				$hasil= $result['cm_total'] - $result['cm_penggunaan'];
			}
			return $hasil; 
		}else{
			return 0;
		}
	}
	
	// update penggunaan cuti pada cuti master
	function update_cuti_terpakai($id_pegawai, $lama_cuti, $year, $update_by)
	{
		
		$data1= $this->db->get_where('v3_cuti_master', array('cm_id_peg' => $id_pegawai , 'cm_year' => $year));
		foreach ($data1->result_array() as $result1)
		{
			$penggunaan_cuti = $result1['cm_penggunaan'];
		}
		
		$cuti_terpakai = $penggunaan_cuti + $lama_cuti;
		
		$data = array(
               'cm_id_peg' => $id_pegawai,
			   'cm_penggunaan' => $cuti_terpakai,
			   'cm_year' => $year,
			   'cm_update_by' => $update_by
        );
		
		$this->db->update('v3_cuti_master', $data, array('cm_id_peg' => $id_pegawai , 'cm_year' => $year ));
		
		if($this->db->affected_rows())
      		return '1';
      	else
      		return '0';
	}
	
	// tambah data pada cuti_daily
	function add_cuti_daily($id_pegawai, $iter, $mulai_cuti, $year, $ket, $update_by)
	{
		$data1 = $this->db->get_where('v3_cuti_master', array('cm_id_peg' => $id_pegawai , 'cm_year' => $year));
		foreach ($data1->result_array() as $result1)
		{
			$cm_id = $result1['cm_id'];
		}
		
		for ($i=0; $i<$iter; $i++)
		{
			$tanggal = strtotime($mulai_cuti) + ($i * 24 * 60 * 60);
			$tanggal_cuti = date('Y-m-d', $tanggal);
			$data = array(
				'cd_cm_id' => $cm_id, 
				'cd_tanggal' => $tanggal_cuti,
				'cd_ket' => $ket,
				'update_by'	=>	'admin',
			  );
		
			$this->db->insert('v3_cuti_daily', $data); 
		}
		  
		if($this->db->affected_rows())
			return '1';
		else
			return '0';    
	}
	
	//mengambil detail cuti pegawai per hari
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
	
	
	// ambil data time schedule berdasarkan fsch_id
	function ambil_data_time_schedule($fsch_id) 
	{
		return $this->db->order_by('fschtime_order', 'asc')->get_where('v3_fsch_time', array('fschtime_fsch_id' => $fsch_id));
	}
	
	// ambil data time schedule berdasarkan fsch_id
	function check_libur($tgl) 
	{
		$this->db->get_where('v3_libur_nasional', array('lnas_date' => $tgl));
		
		if($this->db->affected_rows())
			return 1; 
		else
			return 0;
	}
	
	// ambil data time schedule berdasarkan fsch_id dan order
	function ambil_data_time_schedule_order($fsch_id, $order) 
	{
		return $this->db->get_where('v3_fsch_time', array('fschtime_fsch_id' => $fsch_id, 'fschtime_order' => $order));
	}
	
	function ambil_fschpeg_id_terbesar()
	{
		$data = $this->db->order_by('fschpeg_id', 'desc')->limit(1)->get('v3_fsch_pegawai');
		
		if($this->db->affected_rows())
		{
			foreach ($data->result() as $row)
            {
				return $row->fschpeg_id;
			}
		}
		else
		{
			return 0;
		}
	}
	
	function ambil_data_fschtime_berdasarkan_fschtime_order($fsch_id, $order) 
	{
		$this->db->where('fschtime_fsch_id', $fsch_id);
		$this->db->where('fschtime_order', $order);
		$query = $this->db->get('v3_fsch_time');
		
		return $query->result_array();
	}
	
	function ambil_totalday_fsch_id($fsch_id)
	{
		$data = $this->db->get_where('v3_format_schedule', array('fsch_id' => $fsch_id));
		
		if($this->db->affected_rows())
		{
			foreach ($data->result() as $row)
            {
				return $row->fsch_total_day;
			}
		}
	}
	
	
	/*
	=====================================================================================================
	 MODEL UNTUK  LEMBUR
	=====================================================================================================
	*/
	
	function ambil_data_lembur($unit,$id,$month,$year)
	{
		if ($id ==="all"){
			$sel="  `v3_peg_unit`.`p_unt_kode_unit`='$unit' AND";
		} else {
			$sel="  `v3_lembur`.`lmb_id_peg`= '$id' AND";
		}
		$sel = " WHERE ".$sel." v3_lembur.lmb_bulan='$month' AND v3_peg_unit.p_unt_tmt_end='0000-00-00'  ";
		$query="
				SELECT * FROM `v3_lembur_$year` AS v3_lembur
				LEFT JOIN v3_pegawai ON v3_pegawai.id_pegawai  = v3_lembur.lmb_id_peg
				LEFT JOIN v3_peg_unit ON v3_peg_unit.p_unt_nipp = v3_pegawai.peg_nipp
				$sel
		";
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	
	function ambil_data_lembur_by_id($id,$year)
	{
		$this->db->join('v3_pegawai', 'v3_pegawai.id_pegawai = v3_lembur_'.$year.'.lmb_id_peg', 'left');
		$this->db->join('v3_peg_unit', 'v3_peg_unit.p_unt_nipp = v3_pegawai.peg_nipp', 'left');
		$this->db->join('v3_peg_jabatan', 'v3_peg_jabatan.p_jbt_nipp = v3_pegawai.peg_nipp', 'left');
		$this->db->where('id_lembur', $id);
		$query = $this->db->get('v3_lembur_'.$year);
		return $query->result_array();
	}
	
	function add_lembur()
	{
		$data = array(
			'lmb_id_peg' => $this->input->post('nipp'),
			'lmb_uang_makan' => $this->input->post('uang_makan'),
			'lmb_uang_transport' => $this->input->post('uang_transport'),
			'lmb_jumlah_hari_kerja' => $this->input->post('jumlah_hari_kerja'),
			'lmb_hari_kerja' => $this->input->post('hari_kerja'),
			'lmb_jml_hr_kerja' => $this->input->post('jml_hr_kerja'),
			'lmb_hari_libur' => $this->input->post('hari_libur'),
			'lmb_jml_hr_libur' => $this->input->post('jml_hr_libur'),
			'lmb_ex_voed' => $this->input->post('ex_voed'),
			'lmb_shift_all' => $this->input->post('shift_all'),
			'lmb_natura' => $this->input->post('natura'),
			'lmb_tunj_stkp' => $this->input->post('tunj_stkp'),
			'lmb_potongan' => $this->input->post('potongan'),
			'lmb_apresiasi' => $this->input->post('apresiasi'),
			'lmb_koreksi' => $this->input->post('koreksi'),
			'lmb_bulan' => $this->input->post('month'),
			//'lmb_tahun' => $this->input->post('year'),
			'lmb_update_by' => "admin",
		);
		
		$this->db->insert('v3_lembur_'.$this->input->post('year'), $data); 
	}
	
	function edit_lembur()
	{
		$id = $this->input->post('id_lembur');
		$data = array(
			'lmb_id_peg' => $this->input->post('id_peg'),
			'lmb_uang_makan' => $this->input->post('uang_makan'),
			'lmb_uang_transport' => $this->input->post('uang_transport'),
			'lmb_jumlah_hari_kerja' => $this->input->post('jumlah_hari_kerja'),
			'lmb_hari_kerja' => $this->input->post('hari_kerja'),
			'lmb_jml_hr_kerja' => $this->input->post('jml_hr_kerja'),
			'lmb_hari_libur' => $this->input->post('hari_libur'),
			'lmb_jml_hr_libur' => $this->input->post('jml_hr_libur'),
			'lmb_jml_ex_voed' => $this->input->post('jml_ex_voed'),
			'lmb_ex_voed' => $this->input->post('ex_voed'),
			'lmb_shift_all' => $this->input->post('shift_all'),
			'lmb_natura' => $this->input->post('natura'),
			'lmb_tunj_stkp' => $this->input->post('tunj_stkp'),
			'lmb_potongan' => $this->input->post('potongan'),
			'lmb_apresiasi' => $this->input->post('apresiasi'),
			'lmb_koreksi' => $this->input->post('koreksi'),
			'lmb_bulan' => $this->input->post('month'),
			//'lmb_tahun' => $this->input->post('year'),
			'lmb_update_by' => "admin",
		);
		$this->db->update('v3_lembur_'.$this->input->post('year'), $data, array('id_lembur' => $id));
		if($this->db->affected_rows())
      		return '1';
      	else
      		return '0';
	}
	
	/*
	=====================================================================================================
	 MODEL UNTUK  MASTER GAJI
	=====================================================================================================
	*/
	function ambil_data_master_gaji()
	{
		return $this->db->get('v3_gaji')->result();
	}
	
	function ambil_data_master_gaji_by_id($id)
	{
		$this->db->where('no_gaji', $id);
		return $this->db->get('v3_gaji')->result();
	}
	
	function add_gaji($grade,$min,$max,$update_by)
	{
		$data = array(
				'gj_grade' => $grade,
				'gj_range_min' => $min,
				'gj_range_max' => $max,
				'gj_update_by' => $update_by,
				
			);
		$this->db->insert('v3_gaji', $data); 
	}
	function edit_gaji()
	{
		$no = $this->input->post('no_gaji');
		$data = array(
				'gj_grade' => $this->input->post('grade'),
				'gj_range_min' => $this->input->post('min'),
				'gj_range_max' => $this->input->post('max'),
				'gj_update_by' => 'admin',
			);
		$this->db->update('v3_gaji', $data, array('no_gaji' => $no));
		if($this->db->affected_rows())
      		return '1';
      	else
      		return '0';
	}
	function delete_gaji($no)
	{
		return $this->db->delete('v3_gaji', array('no_gaji' => $no));
	}	
	/*
	=====================================================================================================
	 PENGGAJIAN
	=====================================================================================================
	*/
	function add_penggajian($data)
	{
		$this->db->insert('v3_penggajian', $data); 
	}
	
	function ambil_data_penggajian($unit,$id,$month,$year)
	{
		if ($id ==="all"){
			$sel="  `v3_peg_unit`.`p_unt_kode_unit`='$unit' AND";
		} else {
			$sel="  `v3_penggajian`.`pgj_id_peg`= '$id' AND";
		}
		//$sel = " WHERE ".$sel." pgj_bulan='$month' AND pgj_tahun='$year' ";
		$sel = " WHERE ".$sel." pgj_bulan='$month' AND v3_peg_unit.p_unt_tmt_end='0000-00-00' ";
		$query="
				SELECT * FROM `v3_penggajian_$year` AS v3_penggajian 
				LEFT JOIN v3_pegawai ON v3_pegawai.id_pegawai  = v3_penggajian.pgj_id_peg
				LEFT JOIN v3_peg_unit ON v3_peg_unit.p_unt_nipp = v3_pegawai.peg_nipp
				$sel
		";
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	
	function ambil_data_penggajian_by_id($id,$year)
	{
		$this->db->join('v3_pegawai', 'v3_pegawai.id_pegawai = v3_penggajian_'.$year.'.pgj_id_peg', 'left');
		$this->db->join('v3_peg_unit', 'v3_peg_unit.p_unt_nipp = v3_pegawai.peg_nipp', 'left');
		$this->db->join('v3_peg_jabatan', 'v3_peg_jabatan.p_jbt_nipp = v3_pegawai.peg_nipp', 'left');
		$this->db->where('id_pgj', $id);
		$query = $this->db->get('v3_penggajian_'.$year);
		return $query->result_array();
	}
	
	function edit_penggajian($data,$id_pgj)
	{
		$this->db->update('v3_penggajian', $data, array('id_pgj' => $id_pgj));
		if($this->db->affected_rows())
      		return '1';
      	else
      		return '0';
	}
	
	
	/*
	=====================================================================================================
	 ABSENSI PEGAWAI
	=====================================================================================================
	*/
	function update_absen_pegawai_cuti($id_pegawai, $tahun, $mulai_cuti, $iter)
	{
		$mulai_cuti = strtotime($mulai_cuti);
		for ($i=0;$i<$iter;$i++)
		{
			$tanggal_cuti = date('Y-m-d',($mulai_cuti + $i*24*60*60));
			
			$querysch=$this->db->query("SELECT * FROM v3_fsch_pegawai AS  fschpeg 
					WHERE (fschpeg.fschpeg_id_pegawai = $id_pegawai) 
					AND (fschpeg.fschpeg_year = ".substr($tanggal_cuti,0,4).") 
					AND (fschpeg.fschpeg_month = ".substr($tanggal_cuti,5,2).") 
					LIMIT 1"
					);
			$sch = $querysch->result_array();
			foreach($sch as $row){
				$fschpeg_id = $row['fschpeg_id'];
			}

			$query = "
					UPDATE v3_fschpeg_absensi_$tahun 
					SET	fschpegabs_off_status ='1'
					WHERE (fschpegabs_fschpeg_id = $fschpeg_id)
					AND ((fschpegabs_sch_time_in LIKE '$tanggal_cuti%') OR (fschpegabs_sch_break_in LIKE '$tanggal_cuti%'))
				";
			$this->db->query($query);
		}
	}
	
	/*
	=====================================================================================================
	 PLUS PLUS
	=====================================================================================================
	*/
	function data_grade()
	{
		$data=array(
			'I'		=>	'I',
			'II'	=>	'II',
			'III'	=>	'III',
			'IV'	=>	'IV',
			'V'		=>	'V',
			'VI'	=>	'VI',
			'VII'	=>	'VII',
			'VIII'	=>	'VIII',
			'IX'	=>	'IX',
			'X'		=>	'X',
			'XI'	=>	'XI',
			'XII'	=>	'XII',
		);
		return $data;
	}
	
	
	/*
	=======================================================================================
	*/
	
}
?>
