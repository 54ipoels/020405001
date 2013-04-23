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
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			ORDER BY peg_stkp.p_stkp_nipp, peg_stkp.p_stkp_rating
			LIMIT '.$offset.' , '.$num.'
		');
		/*
		$query = ('
		SELECT * FROM v3_peg_stkp AS peg_stkp
		LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
		ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
		LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
		ON peg_stkp.p_stkp_nipp = peg.peg_nipp
		ORDER BY peg_stkp.p_stkp_nipp, peg_stkp.p_stkp_rating
		LIMIT '.$offset.' , '.$num.'
		');
		*/
		$query = $this->db->query($query); 
		return $query->result_array();
	}

	function get_data_nstkp_with_unit_and_name($num, $offset)
	{
		/*
		$query = ('
		SELECT * FROM v3_peg_non_stkp AS peg_stkp
		LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
		ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
		LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
		ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
		ORDER BY peg_stkp.p_nstkp_nipp,  peg_stkp.p_nstkp_pelaksanaan ASC
		LIMIT '.$offset.' , '.$num.'
		');
		*/
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			ORDER BY peg_stkp.p_nstkp_nipp,  peg_stkp.p_nstkp_pelaksanaan ASC
			LIMIT '.$offset.' , '.$num.'
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}

	function get_nilai_stkp($id)
	{
		$query = ('
		SELECT * FROM v3_peg_stkp AS peg_stkp
		LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
		ON peg_stkp.p_stkp_nipp = peg.peg_nipp
		WHERE peg_stkp.id_peg_stkp = \''.$id.'\'
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
				'p_stkp_jenis'			=> $stkp,
				'p_stkp_rating'			=> $this->input->post('rating'),
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
				'p_nstkp_update_on'		=> $tanggal,
				'p_nstkp_update_by'		=> $user,
			);

			//print_r($data_stkp);
			$this->db->insert('v3_peg_non_stkp',$data_stkp);
		}
	}

	#sort STKP
	function search_data_stkp_with_unit_and_name($num, $offset, $jenis, $stkp, $unit)
	{
		/*
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_stkp_jenis LIKE \'' . $jenis . '\' AND peg_stkp.p_stkp_rating LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
			ORDER BY peg_stkp.p_stkp_nipp
			LIMIT '.$offset.' , '.$num.'
		'); 
		*/
		
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_stkp_jenis LIKE \'' . $jenis . '\' AND peg_stkp.p_stkp_rating LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
			ORDER BY peg_stkp.p_stkp_nipp
			LIMIT '.$offset.' , '.$num.'
		');
		
		
		
		$query = $this->db->query($query); 
		return $query->result_array();
	}

	function search_data_nstkp_with_unit_and_name($num, $offset, $stkp, $unit)
	{
		/*
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg 
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_nstkp_jenis LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
			ORDER BY peg_stkp.p_nstkp_nipp,  peg_stkp.p_nstkp_pelaksanaan ASC
			LIMIT '.$offset.' , '.$num.'
		');
		*/
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_nstkp_jenis LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
			ORDER BY peg_stkp.p_nstkp_nipp,  peg_stkp.p_nstkp_pelaksanaan ASC
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

	function countSTKP_Unit($jenis,$stkp,$unit)
	{
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_stkp_jenis LIKE \'' . $jenis . '\' AND peg_stkp.p_stkp_rating LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
		');
		$query = $this->db->query($query); 
		return $query->num_rows();
	}

	function count_non_STKP_Unit($stkp, $unit)
	{
		/*
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_nstkp_jenis LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
		');
		*/
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

	function update_data_non_stkp($id,$user)
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
				
		if ($this->input->post('tanggal_start')=="00/00/0000"){$tanggal_start="0000-00-00";}
		else {$tanggal_start = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('tanggal_start')))));}
		if ($this->input->post('tanggal_end')=="00/00/0000"){$tanggal_end="0000-00-00";}
		else {$tanggal_end = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('tanggal_end')))));}
		
		$data_non_stkp = array(
					//'p_nstkp_nipp' 			=> $this->input->post('nipp'),
					'p_nstkp_type' 			=> $this->input->post('type'),
					'p_nstkp_jenis' 		=> $this->input->post('non_stkp'),
					'p_nstkp_lembaga'		=> $this->input->post('lembaga'),
					'p_nstkp_no_license'	=> $this->input->post('license'),
					'p_nstkp_pelaksanaan'	=> $tanggal_start,
					'p_nstkp_selesai'		=> $tanggal_end,
					'p_nstkp_update_on'		=> $tanggal,
					'p_nstkp_update_by'		=> $user,
				);

		$this->db->where('id_peg_non_stkp',$id);
		$this->db->update('v3_peg_non_stkp',$data_non_stkp);
	}
	
	function update_data_stkp($id,$user)
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		echo $this->input->post('pelaksanaan')."<br>"; 
		 
		if ($this->input->post('pelaksanaan')=="00/00/0000"){$pelaksanaan="0000-00-00";}
		else {$pelaksanaan = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('pelaksanaan')))));}
		if ($this->input->post('selesai')=="00/00/0000"){$selesai="0000-00-00";}
		else {$selesai = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('selesai')))));}
		if ($this->input->post('validitas_awal')=="00/00/0000"){$validitas_awal="0000-00-00";}
		else {$validitas_awal = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('validitas_awal')))));}
		if ($this->input->post('validitas_akhir')=="00/00/0000"){$validitas_akhir="0000-00-00";}
		else {$validitas_akhir = mdate($datestring, strtotime(str_replace('/','-',($this->input->post('validitas_akhir')))));}
		
		$data_stkp = array(
					//'p_nstkp_nipp' 			=> $this->input->post('nipp'),
					'p_stkp_type' 			=> $this->input->post('type'),
					'p_stkp_jenis' 			=> $this->input->post('jenis_stkp'),
					'p_stkp_lembaga'		=> $this->input->post('lembaga'),
					'p_stkp_no_license'		=> $this->input->post('license'),
					'p_stkp_pelaksanaan'	=> $pelaksanaan,
					'p_stkp_selesai'		=> $selesai,
					'p_stkp_mulai'			=> $validitas_awal,
					'p_stkp_finish'			=> $validitas_akhir,
					'p_stkp_rating'			=> $this->input->post('rating'),
					'p_stkp_update_on'		=> $tanggal,
					'p_stkp_update_by'		=> $user,
				);
		print_r($data_stkp);
		$this->db->where('id_peg_stkp',$id);
		$this->db->update('v3_peg_stkp',$data_stkp);
	}

	function delete_data_non_stkp($id)
	{
		$this->db->where('id_peg_non_stkp', $id);
		$this->db->delete('v3_peg_non_stkp'); 
	}
	function delete_data_stkp($id)
	{
		$this->db->where('id_peg_stkp', $id);
		$this->db->delete('v3_peg_stkp'); 
	}

	function get_data_nstkp_with_unit_and_name_unlimited()
	{
		/*
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			ORDER BY peg_stkp.p_nstkp_nipp
		');
		*/
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			ORDER BY peg_stkp.p_nstkp_nipp
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}

	function get_data_stkp_with_unit_and_name_unlimited()
	{
		/*
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			ORDER BY peg_stkp.p_stkp_nipp
		');
		*/
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			ORDER BY peg_stkp.p_stkp_nipp
		');
		
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_data_stkp_with_unit_and_name_selection($num, $offset,$type,$select)
	{
		$selection="";
		if ($type == "nipp"){
			$selection = " WHERE p_stkp_nipp = '$select' ";
		} else if ($type == "nama")
		{
			$selection = " WHERE peg_nama = '$select' ";
		} else if ($type == "jenis")
		{
			$selection = " WHERE p_stkp_jenis = '$select' ";
		} else if ($type == "rating")
		{
			$selection = " WHERE p_stkp_rating = '$select' ";
		} else if ($type == "type")
		{
			$selection = " WHERE p_stkp_type = '$select' ";
		} else if ( $type == "lembaga")
		{
			$selection = " WHERE p_stkp_lembaga = '$select' ";
		}

		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			'.$selection.'
			ORDER BY peg_stkp.p_stkp_nipp, peg_stkp.p_stkp_rating
			LIMIT '.$offset.' , '.$num.'
		');
		/*
		$query = ('
			
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			'.$selection.'
			ORDER BY peg_stkp.p_stkp_nipp, peg_stkp.p_stkp_rating
			LIMIT '.$offset.' , '.$num.'
			
		');
		*/
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_data_nstkp_with_unit_and_name_selection($num, $offset,$type,$select)
	{
		$selection="";
		if ($type == "nipp"){
			$selection = " WHERE p_nstkp_nipp = '$select' ";
		} else if ($type == "nama")
		{
			$selection = " WHERE peg_nama = '$select' ";
		} else if ($type == "jenis")
		{
			$selection = " WHERE p_nstkp_jenis = '$select' ";
		} else if ( $type == "lembaga")
		{
			$selection = " WHERE p_nstkp_lembaga = '$select' ";
		}

		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			'.$selection.'
			ORDER BY peg_stkp.p_nstkp_nipp, peg_stkp.p_nstkp_pelaksanaan ASC
			LIMIT '.$offset.' , '.$num.'
		');
		
		/*
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			'.$selection.'
			ORDER BY peg_stkp.p_nstkp_nipp, peg_stkp.p_nstkp_pelaksanaan ASC
			LIMIT '.$offset.' , '.$num.'
		');
		*/
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	
	function countSTKPselection($type,$select)
	{
		$selection = "";
		
		if ($type == "nipp"){
			$selection = " WHERE p_stkp_nipp = '$select' ";
		} else if ($type == "nama")
		{
			$selection = " WHERE peg_nama = '$select' ";
		} else if ($type == "jenis")
		{
			$selection = " WHERE p_stkp_jenis = '$select' ";
		} else if ($type == "rating")
		{
			$selection = " WHERE p_stkp_rating = '$select' ";
		} else if ($type == "type")
		{
			$selection = " WHERE p_stkp_type = '$select' ";
		} else if ( $type == "lembaga")
		{
			$selection = " WHERE p_stkp_lembaga = '$select' ";
		}
		
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			'.$selection.'
		');
		/*$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			'.$selection.'
		');
		*/
		$query = $this->db->query($query); 
		return $query->num_rows();
		
	}
	
	function countNon_STKPselection($type,$select)
	{
		$selection = "";
		
		if ($type == "nipp"){
			$selection = " WHERE p_nstkp_nipp = '$select' ";
		} else if ($type == "nama")
		{
			$selection = " WHERE peg_nama = '$select' ";
		} else if ($type == "jenis")
		{
			$selection = " WHERE p_nstkp_jenis = '$select' ";
		} else if ( $type == "lembaga")
		{
			$selection = " WHERE p_nstkp_lembaga = '$select' ";
		}
		
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			'.$selection.'
		');
		$query = $this->db->query($query); 
		return $query->num_rows();
	}
	
	function search_stkp($num, $offset, $search)
	{
		$query = ("
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_nama LIKE   '%$search%' OR peg_nipp LIKE  '%$search%'
			ORDER BY peg_stkp.p_stkp_nipp ASC, peg_stkp.p_stkp_rating ASC, peg_stkp.p_stkp_pelaksanaan ASC
			LIMIT $offset , $num
		");
		/*
		$query = ("
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_nama LIKE   '%$search%' OR peg_nipp LIKE  '%$search%'
			ORDER BY peg_stkp.p_stkp_nipp ASC, peg_stkp.p_stkp_rating ASC, peg_stkp.p_stkp_pelaksanaan ASC
			LIMIT $offset , $num
			
		");
		*/
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function count_search_stkp($search)
	{
		$query = ("
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_nama LIKE   '%$search%' OR peg_nipp LIKE  '%$search%'
		");
		/*
		$query = ("
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_nama LIKE   '%$search%' OR peg_nipp LIKE  '%$search%'
		");
		*/
		$query = $this->db->query($query); 
		return $query->num_rows();
		
	}
	
	function search_nstkp($num, $offset, $search)
	{
		$search= str_replace('_','/',$search);
		$query = ("
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			WHERE peg_nama LIKE   '%$search%' OR peg_nipp LIKE  '%$search%' OR p_nstkp_jenis LIKE '%$search%' OR p_nstkp_no_license LIKE '%$search%'
			ORDER BY peg_stkp.p_nstkp_nipp ASC, peg_stkp.p_nstkp_pelaksanaan ASC
			LIMIT $offset , $num
			
		");
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function count_search_nstkp($search)
	{
		$search= str_replace('_','/',$search);
		$query = ("
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT max(id_peg_unit),p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit GROUP BY p_unt_nipp ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai GROUP BY peg_nipp) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			WHERE peg_nama LIKE   '%$search%' OR peg_nipp LIKE  '%$search%' OR p_nstkp_jenis LIKE '%$search%' OR p_nstkp_no_license LIKE '%$search%'
		");
		$query = $this->db->query($query); 
		return $query->num_rows();
		
	}
	
}
/* End of file myfile.php */
/* Location: ./system/modules/mymodule/myfile.php */