<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_gaji extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function input_data_gaji_per_unit($nipp_unit, $mp, $year)
	{
		foreach ($nipp_unit as $nipp) :
		{
			$data = array(
				'pgj_id_peg'	=> $nipp['id_pegawai'],
				'pgj_gaji_bruto' => $this->input->post('gaji_bruto'),
				'pgj_insentive' => $this->input->post('insentive'),
				'pgj_bulan' => $this->input->post('month'),
				//'pgj_tahun' => $this->input->post('year'),
				'pgj_update_by' =>"adminems",
				);
			$this->db->insert('v3_penggajian_'.$year, $data); 
			
			$data_pot_peg = array(
				'id_peg_pot_peg_gaji' => $nipp['id_pegawai'],
				'pot_peg_siperkasa' => $mp['peg_siperkasa'],
				'pot_peg_jht' => $mp['peg_jht']*$this->input->post('gaji_bruto'),
				'pot_peg_tht' => $mp['peg_tht']*$this->input->post('gaji_bruto'),
				'pot_peg_pensiun' => $mp['peg_pensiun']*$this->input->post('gaji_bruto'),
				'pot_peg_bulan' => $this->input->post('month'),
				//'pot_peg_tahun' => $this->input->post('year'),
				'pot_peg_update_by' => 'adminems',
			);
			$this->db->insert('v3_pot_gaji_pegawai_'.$year, $data_pot_peg);
						
			$data_pot_per = array(
				'id_peg_pot_per_gaji' => $nipp['id_pegawai'],
				'pot_per_jht' => $mp['per_jht']*$this->input->post('gaji_bruto'),
				'pot_per_tht' => $mp['per_tht']*$this->input->post('gaji_bruto'),
				'pot_per_jk' => $mp['per_jk']*$this->input->post('gaji_bruto'),
				'pot_per_jkk' => $mp['per_jkk']*$this->input->post('gaji_bruto'),
				'pot_per_as_jiwa' => $mp['per_as_jiwa']*$this->input->post('gaji_bruto'),
				'pot_per_pensiun' => $mp['per_pensiun']*$this->input->post('gaji_bruto'),
				'pot_per_bulan' => $this->input->post('month'),
				//'pot_per_tahun' => $this->input->post('year'),
				'pot_per_update_by' => 'adminems',
			);
			$this->db->insert('v3_pot_gaji_perusahaan_'.$year, $data_pot_per);
			
		} endforeach;
	}
	
	function input_data_gaji($nipp, $mp, $year)
	{
		$data = array(
				'pgj_id_peg'	=> $nipp,
				'pgj_gaji_bruto' => $this->input->post('gaji_bruto'),
				'pgj_insentive' => $this->input->post('insentive'),
				'pgj_bulan' => $this->input->post('month'),
				'pgj_tahun' => $this->input->post('year'),
				'pgj_update_by' =>"admin",
				);
		$this->db->insert('v3_penggajian_'.$year, $data); 
		
		$data_pot_peg = array(
				'id_peg_pot_peg_gaji' => $nipp['id_pegawai'],
				'pot_peg_siperkasa' => $mp['peg_siperkasa'],
				'pot_peg_jht' => $mp['peg_jht']*$this->input->post('gaji_bruto'),
				'pot_peg_tht' => $mp['peg_tht']*$this->input->post('gaji_bruto'),
				'pot_peg_pensiun' => $mp['peg_pensiun']*$this->input->post('gaji_bruto'),
				'pot_peg_bulan' => $this->input->post('month'),
				'pot_peg_tahun' => $this->input->post('year'),
				'pot_peg_update_by' => 'adminems',
			);
			$this->db->insert('v3_pot_gaji_pegawai_'.$year, $data_pot_peg);
						
			$data_pot_per = array(
				'id_peg_pot_per_gaji' => $nipp['id_pegawai'],
				'pot_per_jht' => $mp['per_jht']*$this->input->post('gaji_bruto'),
				'pot_per_tht' => $mp['per_tht']*$this->input->post('gaji_bruto'),
				'pot_per_jk' => $mp['per_jk']*$this->input->post('gaji_bruto'),
				'pot_per_jkk' => $mp['per_jkk']*$this->input->post('gaji_bruto'),
				'pot_per_as_jiwa' => $mp['per_as_jiwa']*$this->input->post('gaji_bruto'),
				'pot_per_pensiun' => $mp['per_pensiun']*$this->input->post('gaji_bruto'),
				'pot_per_bulan' => $this->input->post('month'),
				'pot_per_tahun' => $this->input->post('year'),
				'pot_per_update_by' => 'adminems',
			);
			$this->db->insert('v3_pot_gaji_perusahaan_'.$year, $data_pot_per);
	}
	
	function ambil_data_penggajian($unit,$month,$year)
	{		
		$query="
				SELECT * FROM v3_penggajian_$year  AS v3_penggajian
				LEFT JOIN (SELECT * FROM v3_pegawai ORDER BY id_pegawai DESC) AS pegawai ON pegawai.id_pegawai  = v3_penggajian.pgj_id_peg
				LEFT JOIN (SELECT * FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS unit ON unit.p_unt_nipp = pegawai.peg_nipp
				LEFT JOIN (SELECT * FROM v3_peg_grade ORDER BY id_peg_grade DESC)AS grade ON grade.p_grd_nipp = pegawai.peg_nipp
				LEFT JOIN (SELECT id_peg_jabatan ,p_jbt_nipp, p_jbt_jabatan FROM v3_peg_jabatan ORDER BY id_peg_jabatan DESC) AS jabatan ON jabatan.p_jbt_nipp = pegawai.peg_nipp
				LEFT JOIN (SELECT * FROM v3_pot_gaji_pegawai_$year) AS pot_peg ON pegawai.id_pegawai = pot_peg.id_peg_pot_peg_gaji
				LEFT JOIN (SELECT * FROM v3_pot_gaji_perusahaan_$year) AS pot_per ON pegawai.id_pegawai = pot_per.id_peg_pot_per_gaji
				WHERE unit.p_unt_kode_unit LIKE '$unit'
				AND pgj_bulan='$month' 
		";
		$query = $this->db->query($query);
		
		return  $query->result_array();
	}
	
	function ambil_master_potongan()
	{
		$this->db->order_by('id_master_pot','DESC');
		$this->db->limit(1);
		$query = $this->db->get('v3_master_pot_gaji');
		return $query->result_array();
	}
	
	function ambil_data_master_potongan_gaji()
	{
		$this->db->order_by('id_master_pot','DESC');
		$query = $this->db->get('v3_master_pot_gaji');
		return $query->result_array();
	}
	
	function count_master_potongan_gaji()
	{
		$query = $this->db->get('v3_master_pot_gaji');
		return $query->num_rows();
	}
		
	
	
	function get_gaji()
	{
		$query = $this->db->get('v3_penggajian_sementara');
		return  $query->result_array();
	}
	
	function ambil_data_penggajian_id($id,$year)
	{
		$query="
				SELECT * FROM `v3_penggajian_$year` AS v3_penggajian
				LEFT JOIN v3_pegawai ON v3_pegawai.id_pegawai  = v3_penggajian.pgj_id_peg
				LEFT JOIN v3_peg_unit ON v3_peg_unit.p_unt_nipp = v3_pegawai.peg_nipp
				LEFT JOIN v3_peg_grade ON v3_peg_grade.p_grd_nipp = v3_pegawai.peg_nipp
				LEFT JOIN v3_peg_jabatan ON v3_peg_jabatan.p_jbt_nipp = v3_pegawai.peg_nipp
				WHERE `v3_penggajian`.`id_pgj` LIKE '$id'
		";
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	
	function ambil_data_pot_pegawai_id($id)
	{
		$this->db->where('id_peg_pot_peg_gaji', $id);
		$this->db->where('pot_peg_bulan', $this->uri->segment(4));
		//$this->db->where('pot_peg_tahun', $this->uri->segment(5));
		$this->db->order_by('id_pot_gaji_pegawai','DESC');
		$this->db->limit(1);
		$query = $this->db->get('v3_pot_gaji_pegawai_'.$this->uri->segment(5));
		return $query->result_array();
	}
	
	function ambil_data_pot_perusahaan_id($id)
	{
		$this->db->where('id_peg_pot_per_gaji', $id);
		$this->db->where('pot_per_bulan', $this->uri->segment(4));
		//$this->db->where('pot_per_tahun', $this->uri->segment(5));
		$this->db->order_by('id_pot_gaji_perusahaan','DESC');
		$this->db->limit(1);
		$query = $this->db->get('v3_pot_gaji_perusahaan_'.$this->uri->segment(5));
		return $query->result_array();
	}
	
	function create_table()
	{
		$create = "
			CREATE TABLE  `v3_penggajian_sementara` (
			 `id_pgj_temp` INT NOT NULL  AUTO_INCREMENT PRIMARY KEY,
			 `id_pgj` INT NOT NULL ,
			 `temp_nama` VARCHAR( 255 ) NOT NULL ,
			 `temp_nipp` VARCHAR( 7 ) NOT NULL ,
			 `temp_grade` VARCHAR( 4 ) NULL ,
			 `temp_jabatan` VARCHAR( 255 ) NOT NULL ,
			 `temp_gaji_bruto` DOUBLE NOT NULL ,
			 `temp_insentive` DOUBLE NULL,
			 `temp_pot_peg` DOUBLE NOT NULL,
			 `temp_pot_per` DOUBLE NOT NULL,
			 `temp_bulan` INT NOT NULL,
			 `temp_tahun` INT NOT NULL
			) ENGINE = INNODB;
		";
		$this->db->query($create);
	}
	
	function drop_table()
	{
		$query = "DROP TABLE  `v3_penggajian_sementara`";
		$this->db->query($query);
	}
	
	function insert_gaji_sementara($data)
	{
		$nipp = '';
		foreach ($data as $row_penggajian) :
		{
			$pot_peg = $row_penggajian['pot_peg_siperkasa'] + $row_penggajian['pot_peg_kokarga'] + $row_penggajian['pot_peg_kosigarden'] + $row_penggajian['pot_peg_flexy'] + $row_penggajian['pot_peg_other'] + $row_penggajian['pot_peg_ggc'] + $row_penggajian['pot_peg_jht'] + $row_penggajian['pot_peg_tht'] + $row_penggajian['pot_peg_pensiun'];
			$pot_per = $row_penggajian['pot_per_as_jiwa'] + $row_penggajian['pot_per_jk'] + $row_penggajian['pot_per_siharta'] + $row_penggajian['pot_per_other'] + $row_penggajian['pot_per_jht'] + $row_penggajian['pot_per_tht'] + $row_penggajian['pot_per_pensiun'];
			$data = array(
					'id_pgj'	=> $row_penggajian['id_pgj'],
					'temp_nama' => $row_penggajian['peg_nama'],
					'temp_nipp' => $row_penggajian['peg_nipp'],
					'temp_grade' => $row_penggajian['p_grd_grade'],
					'temp_jabatan' => $row_penggajian['p_jbt_jabatan'],
					'temp_gaji_bruto' => $row_penggajian['pgj_gaji_bruto'],
					'temp_insentive' => $row_penggajian['pgj_insentive'],
					'temp_pot_peg' => $pot_peg,
					'temp_pot_per' => $pot_per,
					'temp_bulan' => $row_penggajian['pgj_bulan'],
					'temp_tahun' => $this->input->post('year'),
				);
			if ($row_penggajian['peg_nipp'] != $nipp)
			{
				$this->db->insert('v3_penggajian_sementara',$data);	
				$nipp = $row_penggajian['peg_nipp'];
			}else{
				$this->db->where('temp_nipp', $row_penggajian['peg_nipp']);
				$this->db->update('v3_penggajian_sementara',$data);	
				$nipp = $row_penggajian['peg_nipp'];
			}
		} endforeach;
	}
	
	function submit_edit_pot_pegawai($id)
	{
		$data_pot_peg = array(
				'pot_peg_siperkasa' => $this->input->post('siperkasa'),
				'pot_peg_kokarga' => $this->input->post('kokarga'),
				'pot_peg_kosigarden' => $this->input->post('kosigarden'),
				'pot_peg_flexy' => $this->input->post('flexy'),
				'pot_peg_ggc' => $this->input->post('ggc'),
				'pot_peg_other' => $this->input->post('other'),
				'pot_peg_jht' => $this->input->post('jht'),
				'pot_peg_tht' => $this->input->post('tht'),
				'pot_peg_pensiun' => $this->input->post('pensiun'),
				'pot_peg_update_by' => 'adminems',
			);
		$this->db->where('id_pot_gaji_pegawai',$id);
		$this->db->update('v3_pot_gaji_pegawai_'.$this->input->post('year'), $data_pot_peg);
	}
	
	function submit_edit_pot_perusahaan($id)
	{
		$data_pot_per = array(
				'pot_per_jht' => $this->input->post('jht'),
				'pot_per_tht' => $this->input->post('tht'),
				'pot_per_jk' => $this->input->post('jk'),
				'pot_per_jkk' => $this->input->post('jkk'),
				'pot_per_as_jiwa' => $this->input->post('as_jiwa'),
				'pot_per_pensiun' => $this->input->post('pensiun'),
				'pot_per_siharta' => $this->input->post('siharta'),
				'pot_per_other' => $this->input->post('other'),
				'pot_per_update_by' => 'adminems',
			);
		$this->db->where('id_pot_gaji_perusahaan',$id);
		$this->db->update('v3_pot_gaji_perusahaan_'.$this->input->post('year'), $data_pot_per);
	}
	
	function submit_edit_penggajian($id, $mp, $year)
	{
		$data = array(
				'pgj_gaji_bruto' => $this->input->post('gaji_bruto'),
				'pgj_insentive' => $this->input->post('insentive'),
				'pgj_update_by' =>"admin",
				);
		$this->db->where('id_pgj',$id);
		$this->db->update('v3_penggajian_'.$year, $data); 
		
		$data_pot_peg = array(
				'pot_peg_jht' => $mp['peg_jht']*$this->input->post('gaji_bruto'),
				'pot_peg_tht' => $mp['peg_tht']*$this->input->post('gaji_bruto'),
				'pot_peg_pensiun' => $mp['peg_pensiun']*$this->input->post('gaji_bruto'),
				'pot_peg_update_by' => 'adminems',
			);
		$this->db->where('id_pot_gaji_pegawai',$id);
		$this->db->update('v3_pot_gaji_pegawai_'.$year, $data_pot_peg);
						
		$data_pot_per = array(
				'pot_per_jht' => $mp['per_jht']*$this->input->post('gaji_bruto'),
				'pot_per_tht' => $mp['per_tht']*$this->input->post('gaji_bruto'),
				'pot_per_jk' => $mp['per_jk']*$this->input->post('gaji_bruto'),
				'pot_per_jkk' => $mp['per_jkk']*$this->input->post('gaji_bruto'),
				'pot_per_as_jiwa' => $mp['per_as_jiwa']*$this->input->post('gaji_bruto'),
				'pot_per_pensiun' => $mp['per_pensiun']*$this->input->post('gaji_bruto'),
				'pot_per_update_by' => 'adminems',
			);
		$this->db->where('id_pot_gaji_perusahaan',$id);
		$this->db->update('v3_pot_gaji_perusahaan_'.$year, $data_pot_per);
	}
	
	
	function insert_data_gaji_pegawai($data_gaji,$year)
	{
		$this->db->insert('v3_penggajian_'.$year,$data_gaji);
	}
	function insert_data_gaji_pot_pegawai($data_pot_peg,$year)
	{
		$this->db->insert('v3_pot_gaji_pegawai_'.$year,$data_pot_peg);
	}
	function insert_data_gaji_pot_perusahaan($data_pot_perusahaan,$year)
	{
		$this->db->insert('v3_pot_gaji_perusahaan_'.$year,$data_pot_perusahaan);
	}
	
	function get_id_peg_by_nipp($nipp)
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
	
	function ambil_data_absen($unit,$month,$year)
	{
			$query = "
				
				SELECT * FROM v3_fschpeg_absensi_$year AS absen
				LEFT JOIN (SELECT * FROM v3_fsch_pegawai) AS sch
				ON absen.fschpegabs_fschpeg_id = sch.fschpeg_id
				LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
				ON peg.id_pegawai =  sch.fschpeg_id_pegawai
				LEFT JOIN (SELECT * FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS unit
				ON peg.peg_nipp = unit.p_unt_nipp 
				LEFT JOIN (SELECT id_peg_jabatan,p_jbt_nipp,p_jbt_jabatan FROM v3_peg_jabatan ORDER BY id_peg_jabatan DESC) AS jbt 
				ON jbt.p_jbt_nipp = peg.peg_nipp
				LEFT JOIN (SELECT * FROM v3_peg_grade ORDER BY id_peg_grade DESC) AS grade
				ON grade.p_grd_nipp = peg.peg_nipp
				LEFT JOIN (SELECT * FROM v3_master_lembur) AS maslembur
				ON maslembur.ml_grade = grade.p_grd_grade
				WHERE unit.p_unt_kode_unit = '$unit'
				AND sch.fschpeg_month = '$month'
				AND sch.fschpeg_year = '$year'
		";
		
		$query = $this->db->query($query);
		return  $query->result_array();
		
	}
	
	function ambil_data_master_lembur($num,$offset)
	{
		$query = "SELECT * FROM v3_master_lembur ORDER BY ml_grade DESC, id_master_lembur DESC LIMIT $offset , $num";
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	
	function count_master_lembur()
	{
		$query = "SELECT * FROM v3_master_lembur ORDER BY  ml_grade DESC, id_master_lembur DESC ";
		$query = $this->db->query($query);
		return  $query->num_rows();
	}
	
	function ambil_data_master_lembur_by_id($id)
	{
		$query = "SELECT * FROM v3_master_lembur WHERE id_master_lembur = $id ORDER BY id_master_lembur";
		$query = $this->db->query($query);
		return  $query->result_array();
	}
	
	
	function add_master_lembur()
	{
		$data = array(
				'ml_grade'	=>	strtoupper($this->input->post('grade')),
				'ml_makan'	=>	$this->input->post('makan'),
				'ml_trans'	=>	$this->input->post('transport'),
				'ml_exvo'	=>	$this->input->post('exvoed'),
				'ml_hari_kerja'	=>	$this->input->post('harikerja'),
				'ml_hari_libur'	=>	$this->input->post('harilibur'),
				'ml_hari_kerja'	=>	$this->input->post('harikerja'),
				'ml_shift'	=>	$this->input->post('shift'),
				'ml_tunj_spv'	=>	$this->input->post('tunj_spv'),
				'ml_natura'	=>	$this->input->post('natura'),
				'ml_update_by'	=>	"admin",
		
		);
		
		$this->db->insert('v3_master_lembur', $data); 
	}
	
	function edit_master_lembur()
	{
		$id = $this->input->post('id_master_lembur');
		$data = array(
				'ml_grade'	=>	strtoupper($this->input->post('grade')),
				'ml_makan'	=>	$this->input->post('makan'),
				'ml_trans'	=>	$this->input->post('transport'),
				'ml_exvo'	=>	$this->input->post('exvoed'),
				'ml_hari_kerja'	=>	$this->input->post('harikerja'),
				'ml_hari_libur'	=>	$this->input->post('harilibur'),
				'ml_hari_kerja'	=>	$this->input->post('harikerja'),
				'ml_shift'	=>	$this->input->post('shift'),
				'ml_tunj_spv'	=>	$this->input->post('tunj_spv'),
				'ml_natura'	=>	$this->input->post('natura'),
				'ml_update_by'	=>	"admin",
		
		);
		$this->db->update('v3_master_lembur', $data, array('id_master_lembur' => $id));
		if($this->db->affected_rows())
      		return '1';
      	else
      		return '0';
	}
	
	
	
	
	function proses_hitung_lembur($absen,$month,$year)
	{ 
		$nipp="";
		$telathk=0;
		$lemburhk=0;  
		$lemburhl=0;
		$exvo=0;
		$jumlahhk = 0;
		foreach ($absen as $row_absen)
		{ 	$in = $row_absen['fschpegabs_sch_time_in'];
			$b_out = $row_absen['fschpegabs_sch_break_out'];
			$b_in = $row_absen['fschpegabs_sch_break_in'];
			$out = $row_absen['fschpegabs_sch_time_out'];
			$realin = $row_absen['fschpegabs_real_time_in'];
			$realb_out = $row_absen['fschpegabs_real_break_out'];
			$realb_in = $row_absen['fschpegabs_real_break_in'];
			$realout = $row_absen['fschpegabs_real_time_out'];
			$statusoff = $row_absen['fschpegabs_off_status'];
			
			if ( substr($realin,11,8) !== "00:00:00"  ){
			$jumlahhk++;
			
			$lembur=$this->hit_telat_dan_lembur($in, $b_out, $b_in, $out, $realin, $realb_out, $realb_in, $realout, $statusoff); 
			
			if ($nipp == $row_absen['peg_nipp'])
			{
				$telathk = $telathk + $lembur[0];
				$lemburhk = $lemburhk + $lembur[1];
				$lemburhl = $lemburhl + $lembur[2];
				$exvo = $exvo + $lembur[3];
			} else {
				if(substr($row_absen['p_jbt_jabatan'],0,10)=="Supervisor"){
					$spv = 1;
				}
				
				#persiapkan data lembur
				if ($row_absen['ml_trans'] == NULL){$ml_trans = 0;}
				
				$data_lembur= array(
						'lmb_id_peg'		=>	$row_absen['id_pegawai'],
						'lmb_uang_makan'	=>	$jumlahhk * $row_absen['ml_makan'],
						'lmb_uang_transport'=>	$ml_trans,
						'lmb_jumlah_hari_kerja'	=>	$jumlahhk,
						'lmb_hari_kerja'	=>	$lemburhk * $row_absen['ml_hari_kerja'], // jumlah uang/jam
						'lmb_jml_hr_kerja' 	=> 	$lemburhk, // jumlah jam
						'lmb_hari_libur'	=>	$lemburhl * $row_absen['ml_hari_libur'], // jumlah uang/jam
						'lmb_jml_hr_libur '	=>	$lemburhl, // jumlah jam
						'lmb_jml_ex_voed'	=>	$exvo, 
						'lmb_ex_voed'		=>	$exvo * $row_absen['ml_exvo'], 
						'lmb_shift_all'		=>	'',
						'lmb_natura'		=>	'',
						'lmb_tunj_stkp'		=>	'',
						//'lmb_potongan'		=>	'',
						'lmb_apresiasi'		=>	'',
						'lmb_koreksi'		=>	'',
						'lmb_bulan'			=>	$month,
						//'lmb_tahun'			=> 	$year,
						'lmb_update_by'		=>	'admin' ,
					);
				//print_r($data_lembur);echo "<br>";
				# insert ke db 
				$this->db->insert('v3_lembur_'.$year,$data_lembur);
				
				
				$nipp = $row_absen['peg_nipp'];
				$telathk = $lembur[0];
				$lemburhk = $lembur[1];
				$lemburhl = $lembur[2];
				$exvo = $lembur[3];
				$jumlahhk=1;
			}
			}
		}
	}
	
	function hit_telat_dan_lembur($in, $b_out, $b_in, $out, $realin, $realb_out, $realb_in, $realout, $statusoff) 
	{
		$telathk = 0;
		$lemburhk = 0;
		$lemburhl = 0;
		$exvo = 0;
		/* asli
		list($tglin,$cekin) = explode(" ", $in);
		list($tglout,$cekout) = explode(" ", $out);
		*/
		list($tglin,$cekin) = explode(" ", $in);
		list($tglout,$cekout) = explode(" ", $out);
		list($tglbreakin,$cekbreakin) = explode(" ", $b_in);
		list($tglbreakout,$cekbreakout) = explode(" ", $b_out);
		
		if (($realin != "0000-00-00 00:00:00") && ($realout != "0000-00-00 00:00:00"))
		{
			if($statusoff != 0)
			{
				if($realin < $realout) 
				{ 	$lemburhl = $this->selisihjam($realin,$realout); 
					#break
					if($realb_out < $realb_in) 
					{	$breakhl = $this->selisihjam($realb_out,$realb_in); }
					else
					{ 	$breakhl = $this->selisihjam($realb_in,$realb_out); }
				} else 
				{ 	$lemburhl = $this->selisihjam($realout,$realin); 
					#break
					if($realb_out < $realb_in) 
					{	$breakhl = $this->selisihjam($realb_out,$realb_in); }
					else
					{ 	$breakhl = $this->selisihjam($realb_in,$realb_out); }
				}
				$lemburhl = $lemburhl - $breakhl;  
			}
			else
			{
			
				if($cekin < $cekout)
				{
					if ($cekbreakout < $cekbreakin){
						$jml_break_jadwal = $this->selisihjam($b_out,$b_in);
						$jml_break_real = $this->selisihjam($realb_out,$realb_in);
					}else {
						$jml_break_jadwal = $this->selisihjam($b_out,"0000-00-00 24:00:00") + $this->selisihjam("0000-00-00 00:00:00",$b_in) ;
						$jml_break_real = $this->selisihjam($realb_out,"0000-00-00 24:00:00") + $this->selisihjam("0000-00-00 00:00:00",$realb_in);
					}
					
					$jml_jam_jadwal = $this->selisihjam($in,$out) - $jml_break_jadwal;
					$jml_jam_real = $this->selisihjam($realin,$realout) - $jml_break_real;
					
					// cek exvo jika jam masuk kurang atau sama dengan jam 5 pagi maka exvo ditambah 1
					list($tglin, $jamrealin) = explode(" ", $realin);
					if($realin <= "".$tglin." 05:00:00") { $exvo = 1; } 					
					
				}
				else if($cekin > $cekout)
				{
					if ($cekbreakout < $cekbreakin){
						$jml_break_jadwal = $this->selisihjam($b_out,$b_in);
						$jml_break_real = $this->selisihjam($realb_out,$realb_in);
					}else {
						$jml_break_jadwal = $this->selisihjam($b_out,"0000-00-00 24:00:00") + $this->selisihjam("0000-00-00 00:00:00",$b_in) ;
						$jml_break_real = $this->selisihjam($realb_out,"0000-00-00 24:00:00") + $this->selisihjam("0000-00-00 00:00:00",$realb_in);
					}
					
					$jml_jam_jadwal = $this->selisihjam($in, "0000-00-00 24:00:00") + $this->selisihjam("0000-00-00 00:00:00", $out);							
					$jml_jam_real = $this->selisihjam($realin, "0000-00-00 24:00:00") + $this->selisihjam("0000-00-00 00:00:00", $realout);
					
					// cek exvo jika jam pulang lebih atau sama dengan jam 1 pagi maka exvo ditambah 1
					list($tglout, $jamrealout) = explode(" ", $realout);
					if($realout >= "".$tglout." 01:00:00") { $exvo = 1; } 	
				}
				
				//---------------------------------------------------------
			
				# jika > artinya bahwa jika total jam jadwal sama dengan total jam realita, maka telat tetap dihitung dan lembur tidak dihitung
				# jika >= artinya bahwa jika total jam jadwal sama dengan total jam realita, maka telat tidak dihitung dan lembur tidak dihitung
				if($jml_jam_real > $jml_jam_jadwal) 
				{ 
					$lemburhk = ($jml_jam_real - $jml_jam_jadwal) - $jml_break_jadwal - ($jml_break_real - $jml_break_jadwal);
					$telathk = 0;
				} 
				else 
				{
					$lemburhk = 0;
					$telathk =  $this->selisihjam($in, $realin) + $this->selisihjam($b_in, $realb_in) ;
				}
			
			} //endelse
			
		}
		return array($telathk,$lemburhk,$lemburhl,$exvo);
	}
	
	function selisihjam($in,$out) 
	{
		list($tgl,$jam_masuk) = explode(" ", $in);
		list($tgl2,$jam_keluar) = explode(" ", $out);
		
		list($h,$m,$s) = explode(":",$jam_masuk);
		$dtAwal = mktime($h,$m,$s,1,1,1);
		
		list($h,$m,$s) = explode(":",$jam_keluar);
		if ($tgl2 != $tgl)
		{ $h = (int)$h+24;}
		$dtAkhir = mktime($h,$m,$s,1,1,1);
		
		$dtSelisih = $dtAkhir-$dtAwal;
		
		$totalmenit=$dtSelisih/60;
		$jam =explode(".",$totalmenit/60);
		$sisamenit=($totalmenit/60)-$jam[0];
		$sisamenit2=$sisamenit*60;
		$jml_jam=$jam[0];
		$jml_jam = $jml_jam *60;
		$totalmenit = $jml_jam+$sisamenit2;
		return $totalmenit;
	}
	
	function add_master_gaji_potongan()
	{
		$data = array(
				'peg_siperkasa'	=>	$this->input->post('peg_siperkasa'),
				'peg_jht'		=>	$this->input->post('peg_jht'),
				'peg_tht'		=>	$this->input->post('peg_tht'),
				'peg_pensiun'	=>	$this->input->post('peg_pensiun'),
				'per_pensiun'	=>	$this->input->post('per_pensiun'),
				'per_tht'		=>	$this->input->post('per_tht'),
				'per_jht'		=>	$this->input->post('per_jht'),
				'per_jk'		=>	$this->input->post('per_jk'),
				'per_jkk'		=>	$this->input->post('per_jkk'),
				'per_as_jiwa'	=>	$this->input->post('per_as_jiwa'),
				'mas_update_by'	=>	'admin',
		);
		
		$this->db->insert('v3_master_pot_gaji', $data); 
	}
	
}