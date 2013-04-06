<?php
class pendidikan extends CI_Model
{

	function __construct()
	{
        parent::__construct();
		$this->load->database();
    }

	function get_data_pegawai()
	{
		$this->db->select('*');
		$query = $this->db->get('v3_pegawai');
		return $query->result_array();
	}
	
	function search_data_pegawai($num, $offset, $search)
	{
		$query = ('
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN (SELECT * FROM v3_peg_unit) AS peg_unt
			ON peg.peg_nipp = peg_unt.p_unt_nipp
			WHERE peg.peg_nipp LIKE \''. $search .'\' OR peg.peg_nama LIKE \'' . $search . '\'
			LIMIT '.$offset.' , '.$num.'
		');
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function get_data_stkp_with_unit_and_name($num, $offset)
	{
		$query = ('
		SELECT * FROM v3_peg_stkp AS peg_stkp
		LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
		ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
		LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
		ON peg_stkp.p_stkp_nipp = peg.peg_nipp
		ORDER BY peg_stkp.p_stkp_nipp, peg_stkp.p_stkp_jenis
		LIMIT '.$offset.' , '.$num.'
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_data_nstkp_with_unit_and_name($num, $offset)
	{
		$query = ('
		SELECT * FROM v3_peg_non_stkp AS peg_stkp
		LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
		ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
		LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
		ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
		ORDER BY peg_stkp.p_nstkp_nipp
		LIMIT '.$offset.' , '.$num.'
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_nilai_non_stkp($id)
	{
		$query = ('
		SELECT * FROM v3_peg_non_stkp AS peg_stkp
		LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
		ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
		WHERE peg_stkp.id_peg_non_stkp = \''.$id.'\'
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_data_pegawai_with_unit($num, $offset)
	{
		$query = ('
		SELECT * FROM v3_pegawai AS peg
		LEFT JOIN (SELECT * FROM v3_peg_unit) AS peg_unt
		ON peg.peg_nipp = peg_unt.p_unt_nipp
		LIMIT '.$offset.' , '.$num.'
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_data_pegawai_by_nipp($nipp)
	{
		$this->db->select('*');
		$this->db->where('peg_nipp',$nipp);
		$query = $this->db->get('v3_pegawai');
		return $query->result_array();
	}
	
	function get_list_unit()
	{
		$query = $this->db->get('unit');
		return $query->result_array();
	}
	
	function get_list_stkp()
	{
		$this->db->order_by('stkp', 'ASC');
		$query = $this->db->get('v3_peg_list_stkp');
		return $query->result_array();
	}
	
	function countPegawai()
	{
		return $this->db->count_all_results('v3_pegawai');
	}
	
	function count_search_pegawai($search)
	{
		$query = ('
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN (SELECT * FROM v3_peg_unit) AS peg_unt
			ON peg.peg_nipp = peg_unt.p_unt_nipp
			WHERE peg.peg_nipp LIKE \''. $search .'\' OR peg.peg_nama LIKE \'' . $search . '\'
		');
		$query = $this->db->query($query); 
		return $query->num_rows();
	}
	
	#SUBMIT DATA STKP
	function insert_data_stkp($data_stkp)
	{
		$this->db->insert('v3_peg_stkp',$data_stkp);
	}
	
	function input_nilai_stkp($stkp, $jumlah, $tanggal_start, $tanggal_end, $user)
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		for($i=1;$i<=$jumlah;$i++)
		{
			if ($this->input->post('recc'.$i) === 'yes')
			{
				$rec = 'RECC';
			} else
			{
				$rec = 'INIT';
			}
			if ($this->input->post('mandatory'.$i) !== 'yes')
			{
				$mand = 'THTT/GP';
			} else
			{
				$mand = $this->input->post('license'.$i);
			}
			
			if ($tanggal_start == NULL)
				{$tanggal_start = '';} else {$tanggal_start =  mdate($datestring, strtotime(str_replace('/','-',$tanggal_start)));}
			if ($tanggal_end == NULL)
				{$tanggal_end = '';} else {$tanggal_end =  mdate($datestring, strtotime(str_replace('/','-',$tanggal_end)));}
			if ($this->input->post('start'.$i) == NULL)
				{$valid_start = '';} else {$valid_start =  mdate($datestring, strtotime(str_replace('/','-',$this->input->post('start'.$i))));}
			if ($this->input->post('end'.$i) == NULL)
				{$valid_end = '';} else {$valid_end =  mdate($datestring, strtotime(str_replace('/','-',$this->input->post('end'.$i))));}
			$data_stkp = array(
				'p_stkp_nipp' 			=> $this->input->post('nipp'.$i),
				'p_stkp_type' 			=> $rec,
				'p_stkp_jenis' 			=> $stkp,
				'p_stkp_lembaga'		=> $this->input->post('lp'),
				'p_stkp_no_license'		=> $mand,
				'p_stkp_pelaksanaan'	=> $tanggal_start,
				'p_stkp_selesai'		=> $tanggal_end,
				'p_stkp_mulai'			=> $valid_start,
				'p_stkp_finish'			=> $valid_end,
				'p_stkp_update_on'		=> $tanggal,
				'p_stkp_update_by'		=> $user,
			);
			
			//print_r($data_stkp);
			$this->db->insert('v3_peg_stkp',$data_stkp);
		}
	}
	
	function input_nilai_nstkp($stkp, $jumlah, $tanggal_start, $tanggal_end, $user)
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		for($i=1;$i<=$jumlah;$i++)
		{
			if ($this->input->post('recc'.$i) === 'yes')
			{
				$rec = 'RECC';
			} else
			{
				$rec = 'INIT';
			}
			if ($this->input->post('mandatory'.$i) !== 'yes')
			{
				$mand = 'THTT/GP';
			} else
			{
				$mand = $this->input->post('license'.$i);
			}
			
			if ($tanggal_start == NULL)
				{$tanggal_start = '';} else {$tanggal_start =  mdate($datestring, strtotime(str_replace('/','-',$tanggal_start)));}
			if ($tanggal_end == NULL)
				{$tanggal_end = '';} else {$tanggal_end =  mdate($datestring, strtotime(str_replace('/','-',$tanggal_end)));}
			if ($this->input->post('start'.$i) == NULL)
				{$valid_start = '';} else {$valid_start =  mdate($datestring, strtotime(str_replace('/','-',$this->input->post('start'.$i))));}
			if ($this->input->post('end'.$i) == NULL)
				{$valid_end = '';} else {$valid_end =  mdate($datestring, strtotime(str_replace('/','-',$this->input->post('end'.$i))));}
			$data_stkp = array(
				'p_nstkp_nipp' 			=> $this->input->post('nipp'.$i),
				'p_nstkp_type' 			=> $rec,
				'p_nstkp_jenis' 		=> $stkp,
				'p_nstkp_lembaga'		=> $this->input->post('lp'),
				'p_nstkp_no_license'	=> $mand,
				'p_nstkp_pelaksanaan'	=> $tanggal_start,
				'p_nstkp_selesai'		=> $tanggal_end,
				'p_nstkp_rating'		=> $this->input->post('rating'),
				'p_nstkp_update_on'		=> $tanggal,
				'p_nstkp_update_by'		=> $user,
			);
			
			//print_r($data_stkp);
			$this->db->insert('v3_peg_non_stkp',$data_stkp);
		}
	}
	
	#sort STKP
	function search_data_stkp_with_unit_and_name($num, $offset, $stkp, $unit)
	{
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_stkp_jenis LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
			ORDER BY peg_stkp.p_stkp_nipp
			LIMIT '.$offset.' , '.$num.'
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function search_data_nstkp_with_unit_and_name($num, $offset, $stkp, $unit)
	{
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_nstkp_jenis LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
			ORDER BY peg_stkp.p_nstkp_nipp
			LIMIT '.$offset.' , '.$num.'
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	#Count
	
	function countSTKP()
	{
		return $this->db->count_all_results('v3_peg_stkp');
	}
	
	function countNon_STKP()
	{
		return $this->db->count_all_results('v3_peg_non_stkp');
	}
	
	function countSTKP_Unit($stkp, $unit)
	{
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_stkp_jenis LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
		');
		$query = $this->db->query($query); 
		return $query->num_rows();
	}
	
	function count_non_STKP_Unit($stkp, $unit)
	{
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_nstkp_jenis LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
		');
		$query = $this->db->query($query); 
		return $query->num_rows();
	}
	
	function update_data_non_stkp($id)
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
	
		$data_non_stkp = array(
					//'p_nstkp_nipp' 			=> $this->input->post('nipp'),
					'p_nstkp_type' 			=> $this->input->post('type'),
					'p_nstkp_jenis' 		=> $this->input->post('non_stkp'),
					'p_nstkp_lembaga'		=> $this->input->post('lembaga'),
					'p_nstkp_no_license'	=> $this->input->post('license'),
					'p_nstkp_pelaksanaan'	=> mdate($datestring, strtotime($this->input->post('pelaksanaan'))),
					'p_nstkp_mulai'			=> mdate($datestring, strtotime($this->input->post('validitas_awal'))),
					'p_nstkp_finish'		=> mdate($datestring, strtotime($this->input->post('validitas_akhir'))),
					'p_nstkp_rating'		=> $this->input->post('rating'),
					'p_nstkp_update_on'		=> $tanggal,
					'p_nstkp_update_by'		=> 'admin'
				);
		
		$this->db->where('id_peg_non_stkp',$id);
		$this->db->update('v3_peg_non_stkp',$data_non_stkp);
	}
	
	function delete_data_non_stkp($id)
	{
		$this->db->where('id_peg_non_stkp', $id);
		$this->db->delete('v3_peg_non_stkp'); 
	}
	
	function get_data_nstkp_with_unit_and_name_unlimited()
	{
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			ORDER BY peg_stkp.p_nstkp_nipp
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_data_stkp_with_unit_and_name_unlimited()
	{
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			ORDER BY peg_stkp.p_stkp_nipp
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
}
/* End of file myfile.php */
/* Location: ./system/modules/mymodule/myfile.php */