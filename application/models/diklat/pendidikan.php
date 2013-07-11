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
		LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS peg_unt 
		ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
		LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
		ON peg_stkp.p_stkp_nipp = peg.peg_nipp
		GROUP BY peg_stkp.id_peg_stkp
		ORDER BY peg_stkp.p_stkp_nipp, peg_stkp.p_stkp_rating
		LIMIT '.$offset.' , '.$num.'
		');
		
		$query = $this->db->query($query); 
		return $query->result_array();
	}

	function get_data_nstkp_with_unit_and_name($num, $offset)
	{
		
		$query = ('
		SELECT * FROM v3_peg_non_stkp AS peg_stkp
		LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS peg_unt 
		ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
		LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
		ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
		GROUP BY peg_stkp.id_peg_non_stkp
		ORDER BY peg_stkp.p_nstkp_nipp,  peg_stkp.p_nstkp_pelaksanaan ASC
		LIMIT '.$offset.' , '.$num.'
		');
		
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function search_report_stkp_bulanan($bulan, $tahun, $jenis_stkp)
	{
		$jenis_stkp = str_replace('%20',' ',$jenis_stkp);
		if (($tahun=="") OR ($tahun=="ALL")){
			$selection = "WHERE peg_stkp.p_stkp_jenis LIKE '%$jenis_stkp%' ";
		}else
		if (($bulan=="" AND $tahun !=="") OR ($bulan=="ALL" AND $tahun !=="ALL") ){
			$selection = "  WHERE YEAR(peg_stkp.p_stkp_pelaksanaan) = '$tahun'
							AND peg_stkp.p_stkp_jenis LIKE '%$jenis_stkp%' ";
		}else
		{
			$selection = "  WHERE MONTH(peg_stkp.p_stkp_pelaksanaan) = '$bulan'
							AND YEAR(peg_stkp.p_stkp_pelaksanaan) = '$tahun'
							AND peg_stkp.p_stkp_jenis LIKE '%$jenis_stkp%'
							";
		}
		$query = ("
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT id_peg_unit,p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			$selection 	
			GROUP BY peg_stkp.id_peg_stkp 
			ORDER BY peg_stkp.p_stkp_nipp,  peg_stkp.p_stkp_pelaksanaan ASC
			
		");
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	
	function search_report_nstkp_bulanan($bulan, $tahun, $jenis)
	{
		$jenis = str_replace('%20',' ',$jenis);
		if ($tahun==""){
			$selection = "WHERE peg_stkp.p_nstkp_jenis LIKE '%$jenis%' ";
		}else
		if ($bulan=="" AND $tahun !=="" ){
			$selection = "  WHERE YEAR(peg_stkp.p_nstkp_pelaksanaan) = '$tahun'
							AND peg_stkp.p_nstkp_jenis LIKE '%$jenis%' ";
		}else
		{
			$selection = "  WHERE MONTH(peg_stkp.p_nstkp_pelaksanaan) = '$bulan'
							AND YEAR(peg_stkp.p_nstkp_pelaksanaan) = '$tahun'
							AND peg_stkp.p_nstkp_jenis LIKE '%$jenis%'
							";
		}
		
		$query = ("
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT id_peg_unit, p_unt_nipp, p_unt_kode_unit, p_unt_kode_sub_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY peg_nipp DESC) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			LEFT JOIN (SELECT * FROM unit ORDER BY kode_unit DESC) AS unit
			ON unit.kode_unit = peg_unt.p_unt_kode_unit
			LEFT JOIN (SELECT * FROM v3_sub_unit ORDER BY su_kode_sub_unit DESC) AS sub_unit
			ON sub_unit.su_kode_sub_unit = peg_unt.p_unt_kode_sub_unit
			$selection 
			GROUP BY peg_stkp.id_peg_non_stkp
			ORDER BY unit.kode_unit,sub_unit.su_kode_sub_unit,peg_stkp.p_nstkp_nipp, peg_stkp.p_nstkp_pelaksanaan ASC
			
		");
		
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function search_report_nstkp_bulanan_sort_pelaksanaan_training($bulan, $tahun, $jenis)
	{
		$jenis = str_replace('%20',' ',$jenis);
		if ($tahun == "ALL"){
			$selection = "WHERE peg_stkp.p_nstkp_jenis LIKE '%$jenis%' ";
		}else
		if ($bulan=="ALL" AND $tahun !=="ALL" ){
			$selection = "  WHERE YEAR(peg_stkp.p_nstkp_pelaksanaan) = '$tahun'
							AND peg_stkp.p_nstkp_jenis LIKE '%$jenis%' ";
		}else
		{
			$selection = "  WHERE MONTH(peg_stkp.p_nstkp_pelaksanaan) = '$bulan'
							AND YEAR(peg_stkp.p_nstkp_pelaksanaan) = '$tahun'
							AND peg_stkp.p_nstkp_jenis LIKE '%$jenis%'
							";
		}
	
		$query = ("
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY peg_nipp DESC) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			$selection 
			GROUP BY peg_stkp.id_peg_non_stkp
			ORDER BY peg_stkp.p_nstkp_pelaksanaan,peg_stkp.p_nstkp_jenis,peg_stkp.p_nstkp_nipp ASC
		");
		//return $query;
		$query = $this->db->query($query);
		if($query->num_rows() > 0){
			return $query->result_array();
		} else {
			return 0;
		}
		
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
				'p_stkp_instruktur'		=> $this->input->post('instruktur'),
				'p_stkp_instruktur_from'=> $this->input->post('instruktur_from'),
				'p_stkp_no_license'		=> $mand,
				'p_stkp_pelaksanaan'	=> $tanggal_start,
				'p_stkp_selesai'		=> $tanggal_end,
				'p_stkp_mulai'			=> $valid_start,
				'p_stkp_finish'			=> $valid_end,
				//'p_stkp_update_on'		=> $tanggal,
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
				'p_nstkp_instruktur'	=> $this->input->post('instruktur'),
				'p_nstkp_instruktur_from'=> $this->input->post('instruktur_from'),
				'p_nstkp_no_license'	=> $mand,
				'p_nstkp_pelaksanaan'	=> $tanggal_start,
				'p_nstkp_selesai'		=> $tanggal_end,
				//'p_nstkp_update_on'		=> $tanggal,
				'p_nstkp_update_by'		=> $user,
			);

			//print_r($data_stkp);
			$this->db->insert('v3_peg_non_stkp',$data_stkp);
		}
	}

	#sort STKP
	function search_data_stkp_with_unit_and_name($num, $offset, $jenis, $stkp, $unit)
	{
		
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT id_peg_unit,p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY peg_nipp) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_stkp_jenis LIKE \'' . $jenis . '\' AND peg_stkp.p_stkp_rating LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
			GROUP BY peg_stkp.id_peg_stkp
			ORDER BY peg_stkp.p_stkp_nipp
			LIMIT '.$offset.' , '.$num.'
		');
		
		$query = $this->db->query($query); 
		return $query->result_array();
	}

	function search_data_nstkp_with_unit_and_name($num, $offset,$unit,$sub_unit)
	{
		
		if($unit=="ALL"){$unit="";}
		if($sub_unit=="ALL"){$sub_unit="";}
		$query = "
				SELECT * FROM v3_peg_non_stkp AS peg_stkp
				LEFT JOIN (SELECT id_peg_unit,p_unt_nipp, p_unt_kode_unit, p_unt_kode_sub_unit, p_unt_tmt_end FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
				ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
				LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai) AS peg
				ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
				WHERE peg_unt.p_unt_kode_unit LIKE '%$unit%' AND peg_unt.p_unt_kode_sub_unit LIKE '%$sub_unit%' AND peg_unt.p_unt_tmt_end = '0000-00-00'
				GROUP BY peg_stkp.id_peg_non_stkp
				ORDER BY peg_stkp.p_nstkp_nipp,  peg_stkp.p_nstkp_pelaksanaan ASC
				LIMIT $offset , $num
			";
		
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
			LEFT JOIN (SELECT id_peg_unit,p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_stkp_jenis LIKE \'' . $jenis . '\' AND peg_stkp.p_stkp_rating LIKE \'' . $stkp . '\' AND peg_unt.p_unt_kode_unit LIKE \'' . $unit. '\'
			GROUP BY peg_stkp.id_peg_stkp
			ORDER BY peg_stkp.p_stkp_nipp
		');
		$query = $this->db->query($query); 
		return $query->num_rows();
	}

	function count_non_STKP_Unit($unit,$sub_unit)
	{
		
		if($unit=="ALL"){$unit="";}
		if($sub_unit=="ALL"){$sub_unit="";}
		$query = "
				SELECT * FROM v3_peg_non_stkp AS peg_stkp
				LEFT JOIN (SELECT id_peg_unit,p_unt_nipp, p_unt_kode_unit, p_unt_kode_sub_unit, p_unt_tmt_end FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
				ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
				LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
				ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
				WHERE peg_unt.p_unt_kode_unit LIKE '%$unit%' AND peg_unt.p_unt_kode_sub_unit LIKE '%$sub_unit%' AND peg_unt.p_unt_tmt_end ='0000-00-00'
				GROUP BY peg_stkp.id_peg_non_stkp
				ORDER BY peg_stkp.p_nstkp_nipp,  peg_stkp.p_nstkp_pelaksanaan ASC
			";
		$query = $this->db->query($query); 
		return $query->num_rows();
	}

	function update_data_non_stkp($id,$data_non_stkp)
	{
		$this->db->where('id_peg_non_stkp',$id);
		$this->db->update('v3_peg_non_stkp',$data_non_stkp);
	}
	
	function update_data_stkp($id,$data_stkp)
	{
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
		
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT id_peg_unit, p_unt_nipp, p_unt_kode_unit, p_unt_kode_sub_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY peg_nipp DESC) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			LEFT JOIN (SELECT * FROM unit ORDER BY kode_unit DESC) AS unit
			ON unit.kode_unit = peg_unt.p_unt_kode_unit
			LEFT JOIN (SELECT * FROM v3_sub_unit ORDER BY su_kode_sub_unit DESC) AS sub_unit
			ON sub_unit.su_kode_sub_unit = peg_unt.p_unt_kode_sub_unit
			GROUP BY peg_stkp.id_peg_non_stkp
			ORDER BY unit.kode_unit,sub_unit.su_kode_sub_unit,peg_stkp.p_nstkp_nipp, peg_stkp.p_nstkp_pelaksanaan ASC
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}

	function get_data_nstkp_with_unit_and_name_and_status_unlimited()
	{
		$query = ('
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT id_peg_unit, p_unt_nipp, p_unt_kode_unit, p_unt_kode_sub_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY peg_nipp DESC) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			LEFT JOIN (SELECT * FROM unit ORDER BY kode_unit DESC) AS unit
			ON unit.kode_unit = peg_unt.p_unt_kode_unit
			LEFT JOIN (SELECT * FROM v3_sub_unit ORDER BY su_kode_sub_unit DESC) AS sub_unit
			ON sub_unit.su_kode_sub_unit = peg_unt.p_unt_kode_sub_unit
			LEFT JOIN (SELECT p_tmt_nipp,p_tmt_status FROM v3_peg_tmt ORDER BY id_peg_tmt DESC) AS tmt
			ON peg.peg_nipp = tmt.p_tmt_nipp
			GROUP BY peg_stkp.id_peg_non_stkp
			ORDER BY unit.kode_unit,sub_unit.su_kode_sub_unit,peg_stkp.p_nstkp_nipp, peg_stkp.p_nstkp_pelaksanaan ASC
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_data_stkp_with_unit_and_name_unlimited()
	{
		
		$jenis_search=$this->uri->segment(3);
		$query = ('
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_stkp.p_stkp_jenis = \''.$jenis_search.'\'
			GROUP BY peg_stkp.id_peg_stkp
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
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			'.$selection.'
			GROUP BY peg_stkp.id_peg_stkp
			ORDER BY peg_stkp.p_stkp_nipp, peg_stkp.p_stkp_rating
			LIMIT '.$offset.' , '.$num.'
			
		');
		
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
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			'.$selection.'
			GROUP BY peg_stkp.id_peg_non_stkp
			ORDER BY peg_stkp.p_nstkp_nipp, peg_stkp.p_nstkp_pelaksanaan ASC
			LIMIT '.$offset.' , '.$num.'
		');
		
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
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			'.$selection.'
			GROUP BY peg_stkp.id_peg_stkp
		');
		
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
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			'.$selection.'
			GROUP BY peg_stkp.id_peg_non_stkp
		');
		$query = $this->db->query($query); 
		return $query->num_rows();
	}
	
	function search_stkp($num, $offset, $search)
	{
		
		$query = ("
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_nama LIKE   '%$search%' OR peg_nipp LIKE  '%$search%'
			GROUP BY peg_stkp.id_peg_stkp
			ORDER BY peg_stkp.p_stkp_nipp ASC, peg_stkp.p_stkp_rating ASC, peg_stkp.p_stkp_pelaksanaan ASC
			LIMIT $offset , $num
			
		");
		
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function count_search_stkp($search)
	{
		
		$query = ("
			SELECT * FROM v3_peg_stkp AS peg_stkp
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS peg_unt 
			ON peg_stkp.p_stkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_stkp_nipp = peg.peg_nipp
			WHERE peg_nama LIKE   '%$search%' OR peg_nipp LIKE  '%$search%'
			GROUP BY peg_stkp.id_peg_stkp
		");
		
		$query = $this->db->query($query); 
		return $query->num_rows();
	}
	
	function search_nstkp($num, $offset, $search)
	{
		$search= str_replace('_','/',$search);
		
		$query = ("
			SELECT * FROM v3_peg_non_stkp AS peg_stkp
			LEFT JOIN (SELECT id_peg_unit,p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			WHERE peg_nama LIKE   '%$search%' OR peg_nipp LIKE  '%$search%' OR p_nstkp_jenis LIKE '%$search%' OR p_nstkp_no_license LIKE '%$search%'
			GROUP BY peg_stkp.id_peg_non_stkp
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
			LEFT JOIN (SELECT id_peg_unit,p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
			ON peg_stkp.p_nstkp_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT peg_nipp,peg_nama FROM v3_pegawai ORDER BY id_pegawai DESC) AS peg
			ON peg_stkp.p_nstkp_nipp = peg.peg_nipp
			WHERE peg_nama LIKE   '%$search%' OR peg_nipp LIKE  '%$search%' OR p_nstkp_jenis LIKE '%$search%' OR p_nstkp_no_license LIKE '%$search%'
			GROUP BY peg_stkp.id_peg_non_stkp
			
		");
		$query = $this->db->query($query); 
		return $query->num_rows();
		
	}
	
	function update_image_no_sertifikat_data_stkp($filenamebantu, $license, $rating){
		if($rating == 'FWM'){
			$query	="	UPDATE v3_peg_stkp SET p_stkp_image = '$filenamebantu'
						WHERE p_stkp_no_license = '$license'  AND p_stkp_rating = 'FWM' 
				";
		} else {
			$query	="	UPDATE v3_peg_stkp SET p_stkp_image = '$filenamebantu'
						WHERE (p_stkp_no_license = '$license')  AND (p_stkp_rating <> 'FWM')
				";
		}
		$this->db->query($query);
	}
	
	function remove_link_file_stkp($id){
		$query ="
				UPDATE v3_peg_stkp SET p_stkp_image = ''
				WHERE id_peg_stkp = $id
			";
		$this->db->query($query);
	}
	
	function remove_link_file_non_stkp($id){
		$query ="
				UPDATE v3_peg_non_stkp SET p_nstkp_image = ''
				WHERE id_peg_non_stkp = $id
			";
		$this->db->query($query);
	}
	
	function myUrlEncode($string) {
		//$replacements = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F',  '%23', '%5B', '%5D');
		$replacements = array('_', '_', "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_",  "_", "_", "_");
		$entities = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?",  "#", "[", "]");
		return str_replace($entities, $replacements, $string);
		//return str_replace($entities, $replacements, urlencode($string));
	}
	
	function myUrlDecode($string) {
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%23', '%5B', '%5D');
		$replacements = array('_', '_', "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_", "_",  "_", "_", "_");
		# $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?",  "#", "[", "]"); 
		return str_replace($entities, $replacements, $string);
	}

	
}
/* End of file myfile.php */
/* Location: ./system/modules/mymodule/myfile.php */