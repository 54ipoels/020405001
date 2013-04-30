<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_gaji extends CI_Model 
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	function input_data_gaji_per_unit($nipp_unit, $mp)
	{
		foreach ($nipp_unit as $nipp) :
		{
			$data = array(
				'pgj_id_peg'	=> $nipp['id_pegawai'],
				'pgj_gaji_bruto' => $this->input->post('gaji_bruto'),
				'pgj_insentive' => $this->input->post('insentive'),
				'pgj_bulan' => $this->input->post('month'),
				'pgj_tahun' => $this->input->post('year'),
				'pgj_update_by' =>"adminems",
				);
			$this->db->insert('v3_penggajian', $data); 
			
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
			$this->db->insert('v3_pot_gaji_pegawai', $data_pot_peg);
						
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
			$this->db->insert('v3_pot_gaji_perusahaan', $data_pot_per);
			
		} endforeach;
	}
	
	function input_data_gaji($nipp, $mp)
	{
		$data = array(
				'pgj_id_peg'	=> $nipp,
				'pgj_gaji_bruto' => $this->input->post('gaji_bruto'),
				'pgj_insentive' => $this->input->post('insentive'),
				'pgj_bulan' => $this->input->post('month'),
				'pgj_tahun' => $this->input->post('year'),
				'pgj_update_by' =>"admin",
				);
		$this->db->insert('v3_penggajian', $data); 
		
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
			$this->db->insert('v3_pot_gaji_pegawai', $data_pot_peg);
						
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
			$this->db->insert('v3_pot_gaji_perusahaan', $data_pot_per);
	}
	
	function ambil_data_penggajian($unit,$month,$year)
	{		
		$query="
				SELECT * FROM v3_penggajian 
				LEFT JOIN (SELECT * FROM v3_pegawai ORDER BY id_pegawai DESC) AS pegawai ON pegawai.id_pegawai  = v3_penggajian.pgj_id_peg
				LEFT JOIN (SELECT * FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS unit ON unit.p_unt_nipp = pegawai.peg_nipp
				LEFT JOIN (SELECT * FROM v3_peg_grade ORDER BY id_peg_grade DESC)AS grade ON grade.p_grd_nipp = pegawai.peg_nipp
				LEFT JOIN (SELECT id_peg_jabatan ,p_jbt_nipp, p_jbt_jabatan FROM v3_peg_jabatan ORDER BY id_peg_jabatan DESC) AS jabatan ON jabatan.p_jbt_nipp = pegawai.peg_nipp
				LEFT JOIN (SELECT * FROM v3_pot_gaji_pegawai) AS pot_peg ON pegawai.id_pegawai = pot_peg.id_peg_pot_peg_gaji
				LEFT JOIN (SELECT * FROM v3_pot_gaji_perusahaan) AS pot_per ON pegawai.id_pegawai = pot_per.id_peg_pot_per_gaji
				WHERE unit.p_unt_kode_unit LIKE '$unit'
				AND pgj_bulan='$month' AND pgj_tahun='$year'
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
	
	function get_gaji()
	{
		$query = $this->db->get('v3_penggajian_sementara');
		return  $query->result_array();
	}
	
	function ambil_data_penggajian_id($id)
	{
		$query="
				SELECT * FROM `v3_penggajian` 
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
		$this->db->where('pot_peg_tahun', $this->uri->segment(5));
		$this->db->order_by('id_pot_gaji_pegawai','DESC');
		$this->db->limit(1);
		$query = $this->db->get('v3_pot_gaji_pegawai');
		return $query->result_array();
	}
	
	function ambil_data_pot_perusahaan_id($id)
	{
		$this->db->where('id_peg_pot_per_gaji', $id);
		$this->db->where('pot_per_bulan', $this->uri->segment(4));
		$this->db->where('pot_per_tahun', $this->uri->segment(5));
		$this->db->order_by('id_pot_gaji_perusahaan','DESC');
		$this->db->limit(1);
		$query = $this->db->get('v3_pot_gaji_perusahaan');
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
					'temp_tahun' => $row_penggajian['pgj_tahun'],
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
		$this->db->update('v3_pot_gaji_pegawai', $data_pot_peg);
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
		$this->db->update('v3_pot_gaji_perusahaan', $data_pot_per);
	}
	
	function submit_edit_penggajian($id, $mp)
	{
		$data = array(
				'pgj_gaji_bruto' => $this->input->post('gaji_bruto'),
				'pgj_insentive' => $this->input->post('insentive'),
				'pgj_update_by' =>"admin",
				);
		$this->db->where('id_pgj',$id);
		$this->db->update('v3_penggajian', $data); 
		
		$data_pot_peg = array(
				'pot_peg_jht' => $mp['peg_jht']*$this->input->post('gaji_bruto'),
				'pot_peg_tht' => $mp['peg_tht']*$this->input->post('gaji_bruto'),
				'pot_peg_pensiun' => $mp['peg_pensiun']*$this->input->post('gaji_bruto'),
				'pot_peg_update_by' => 'adminems',
			);
		$this->db->where('id_pot_gaji_pegawai',$id);
		$this->db->update('v3_pot_gaji_pegawai', $data_pot_peg);
						
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
		$this->db->update('v3_pot_gaji_perusahaan', $data_pot_per);
	}
	
	
	function insert_data_gaji_pegawai($data_gaji)
	{
		$this->db->insert('v3_penggajian',$data_gaji);
	}
	function insert_data_gaji_pot_pegawai($data_pot_peg)
	{
		$this->db->insert('v3_pot_gaji_pegawai',$data_pot_peg);
	}
	function insert_data_gaji_pot_perusahaan($data_pot_perusahaan)
	{
		$this->db->insert('v3_pot_gaji_perusahaan',$data_pot_perusahaan);
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
}