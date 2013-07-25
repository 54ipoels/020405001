<?php
class kepegawaian extends CI_Model
{

	function __construct()
	{
        parent::__construct();
		$this->load->database();
    }

	#----- GETTING DATA FROM DATABASE -----#
	function get_data_lama ()
	{
		$this->db->select('*');
		$query = $this->db->get('pegawai');
		return $query->result_array();
	}
	
	function get_data_outsource ()
	{
		$this->db->select('*');
		$query = $this->db->get('outsource');
		return $query->result_array();
	}
	
	function get_data_pegawai($num, $offset)
	{
		$this->db->select('*');
		$query = $this->db->get('v3_pegawai', $num, $offset);
		return $query->result_array();
	}
	
	function get_data_pegawai_aktif($num,$offset)
	{
		
		$query = "	SELECT * FROM v3_pegawai AS peg
					LEFT JOIN (SELECT * from v3_peg_tmt ORDER BY id_peg_tmt DESC) AS tmt ON tmt.p_tmt_nipp = peg.peg_nipp
					WHERE tmt.p_tmt_end = '0000-00-00'
					GROUP BY peg.peg_nipp 
					ORDER BY tmt.p_tmt_nipp DESC
					LIMIT $offset , $num
				";
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function get_data_pegawai_full($num, $offset)
	{
		
		$query = ("
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN (SELECT p_stk_nipp, p_stk_status_keluarga FROM v3_peg_status_keluarga ORDER BY id_peg_status_keluarga DESC) AS stk
			ON peg.peg_nipp = stk.p_stk_nipp
			LEFT JOIN (SELECT p_ag_nipp, p_ag_agama FROM v3_peg_agama ORDER BY id_peg_agama DESC) AS agm
			ON peg.peg_nipp = agm.p_ag_nipp
			LEFT JOIN (SELECT p_al_nipp, p_al_jalan, p_al_kelurahan, p_al_kecamatan, p_al_kabupaten, p_al_provinsi, p_al_no_telp FROM v3_peg_alamat) AS alm
			ON peg.peg_nipp = alm.p_al_nipp
			LEFT JOIN (SELECT p_ps_nipp, p_ps_nama, p_ps_tmpt_lahir, p_ps_tgl_lahir, p_ps_agama FROM v3_peg_pasangan) AS ps
			ON peg.peg_nipp = ps.p_ps_nipp
			LEFT JOIN (SELECT * FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS unit
			ON peg.peg_nipp = unit.p_unt_nipp
			
			GROUP BY id_pegawai
			ORDER BY peg.peg_nipp ASC 
			LIMIT $offset , $num
		");
		
		
		/*$this->db->select('*');
		$query = $this->db->get('v3_pegawai'); */
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function search_data_pegawai_full($num, $offset, $search)
	{
		$search=str_replace("'", '', $search);
		$query = ("
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN (SELECT p_stk_nipp, p_stk_status_keluarga FROM v3_peg_status_keluarga ORDER BY id_peg_status_keluarga DESC) AS stk
			ON peg.peg_nipp = stk.p_stk_nipp
			LEFT JOIN (SELECT p_ag_nipp, p_ag_agama FROM v3_peg_agama ORDER BY id_peg_agama DESC) AS agm
			ON peg.peg_nipp = agm.p_ag_nipp
			LEFT JOIN (SELECT p_al_nipp, p_al_jalan, p_al_kelurahan, p_al_kecamatan, p_al_kabupaten, p_al_provinsi, p_al_no_telp FROM v3_peg_alamat) AS alm
			ON peg.peg_nipp = alm.p_al_nipp
			LEFT JOIN (SELECT p_ps_nipp, p_ps_nama, p_ps_tmpt_lahir, p_ps_tgl_lahir, p_ps_agama FROM v3_peg_pasangan) AS ps
			ON peg.peg_nipp = ps.p_ps_nipp
			WHERE peg.peg_nipp LIKE '%$search%' OR peg.peg_nama LIKE '%$search%' OR ps.p_ps_nama LIKE '%$search%'
			GROUP BY id_pegawai
			ORDER BY peg.peg_nipp ASC 
			LIMIT $offset , $num
		");
		
		/*$this->db->select('*');
		$query = $this->db->get('v3_pegawai'); */
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	
	function search_data_pegawai_full_unit($num, $offset, $search, $unit)
	{
		$search=str_replace("'", '', $search);
		$selection = " ";
		if (strtoupper($unit) !== 'ALL'){
			$selection .= " AND unit.p_unt_kode_unit = '$unit' ";
		}
		if ($search == "ALL" ){$search="";}
		
		$query = ("
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN (SELECT p_stk_nipp, p_stk_status_keluarga FROM v3_peg_status_keluarga ORDER BY id_peg_status_keluarga DESC) AS stk
			ON peg.peg_nipp = stk.p_stk_nipp
			LEFT JOIN (SELECT p_ag_nipp, p_ag_agama FROM v3_peg_agama ORDER BY id_peg_agama DESC) AS agm
			ON peg.peg_nipp = agm.p_ag_nipp
			LEFT JOIN (SELECT p_al_nipp, p_al_jalan, p_al_kelurahan, p_al_kecamatan, p_al_kabupaten, p_al_provinsi, p_al_no_telp FROM v3_peg_alamat) AS alm
			ON peg.peg_nipp = alm.p_al_nipp
			LEFT JOIN (SELECT p_ps_nipp, p_ps_nama, p_ps_tmpt_lahir, p_ps_tgl_lahir, p_ps_agama FROM v3_peg_pasangan) AS ps
			ON peg.peg_nipp = ps.p_ps_nipp
			LEFT JOIN (SELECT * FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS unit
			ON peg.peg_nipp = unit.p_unt_nipp
			WHERE ( peg.peg_nipp LIKE '%$search%' OR peg.peg_nama LIKE '%$search%' ) $selection
			GROUP BY id_pegawai
			ORDER BY peg.peg_nipp ASC 
			LIMIT $offset , $num
		");
		
		/*$this->db->select('*');
		$query = $this->db->get('v3_pegawai'); */
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function get_data_sdm_unlimited()
	{
		$query = ("
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN (SELECT p_stk_nipp, p_stk_status_keluarga FROM v3_peg_status_keluarga ORDER BY id_peg_status_keluarga DESC) AS stk
			ON peg.peg_nipp = stk.p_stk_nipp
			LEFT JOIN (SELECT p_ag_nipp, p_ag_agama FROM v3_peg_agama ORDER BY id_peg_agama DESC) AS agm
			ON peg.peg_nipp = agm.p_ag_nipp
			LEFT JOIN (SELECT p_al_nipp, p_al_jalan, p_al_kelurahan, p_al_kecamatan, p_al_kabupaten, p_al_provinsi, p_al_no_telp FROM v3_peg_alamat) AS alm
			ON peg.peg_nipp = alm.p_al_nipp
			LEFT JOIN (SELECT p_ps_nipp, p_ps_nama, p_ps_tmpt_lahir, p_ps_tgl_lahir FROM v3_peg_pasangan) AS ps
			ON peg.peg_nipp = ps.p_ps_nipp
			GROUP BY id_pegawai
			ORDER BY peg.peg_nipp ASC
		");
		
		/*$this->db->select('*');
		$query = $this->db->get('v3_pegawai'); */
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function get_data_pegawai_pensiun($num, $offset, $tahun, $type, $limit)
	{
		$type2=$type+1; // utk pegawai lahir desember
		$tahun2=$tahun-1;
		$query = ('
			SELECT * FROM v3_pegawai AS peg 
			LEFT JOIN (SELECT p_jbt_nipp, p_jbt_jabatan FROM v3_peg_jabatan ORDER BY id_peg_jabatan DESC) AS peg_jbt 
			ON peg.peg_nipp = peg_jbt.p_jbt_nipp 
			LEFT JOIN (SELECT p_tmt_nipp, p_tmt_tmt, p_tmt_end FROM v3_peg_tmt ORDER BY id_peg_tmt DESC) AS peg_tmt 
			ON peg.peg_nipp = peg_tmt.p_tmt_nipp 
			LEFT JOIN (SELECT * FROM v3_peg_ppb ORDER BY p_ppb_update_on DESC) AS peg_ppb
			ON peg.peg_nipp = peg_ppb.p_ppb_nipp
			WHERE (\''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) > \''.$type.'\'  
			AND \''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) < \''.$limit.'\'
			AND MONTH(peg.peg_tgl_lahir) <> 12 ) 
			OR (MONTH(peg.peg_tgl_lahir) = 12 AND DATE(peg.peg_tgl_lahir) > 1 AND  \''.$tahun2.'\' - YEAR(peg.peg_tgl_lahir) > \''.$type.'\' AND \''.$tahun2.'\' - YEAR(peg.peg_tgl_lahir) < \''.$limit.'\')
			AND peg_tmt.p_tmt_end = \'0000-00-00\'
			GROUP BY peg.peg_nipp DESC
			ORDER BY peg.peg_tgl_lahir DESC
			LIMIT '.$offset.' , '.$num.'
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_data_pegawai_keluar($num, $offset, $tahun, $type, $limit)
	{
		$query = ('
					SELECT * FROM v3_pegawai AS peg
					LEFT JOIN (	SELECT * FROM v3_peg_jabatan ORDER BY id_peg_jabatan DESC) AS peg_jbt ON peg.peg_nipp = peg_jbt.p_jbt_nipp
					LEFT JOIN (	SELECT * FROM v3_peg_tmt ORDER BY id_peg_tmt DESC) AS peg_tmt ON peg.peg_nipp = peg_tmt.p_tmt_nipp
					LEFT JOIN (	SELECT * FROM v3_peg_cabang) AS cab ON peg_tmt.p_tmt_nipp = cab.p_cab_nipp
					WHERE (\''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) > \''.$type.'\'
					AND \''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) < \''.$limit.'\'
					AND peg_tmt.p_tmt_end = \'0000-00-00\')  OR ((peg_tmt.p_tmt_reason = \'Pindah Cabang\') AND (peg_tmt.p_tmt_ket <> \'aktif\') )
					GROUP BY peg.id_pegawai
					ORDER BY peg.peg_tgl_lahir DESC
					LIMIT '.$offset.' , '.$num
		);
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	function countPegawaiKeluar( $tahun, $type, $limit)
	{
		$query = ('
					SELECT * FROM v3_pegawai AS peg
					LEFT JOIN (	SELECT * FROM v3_peg_jabatan ORDER BY id_peg_jabatan DESC) AS peg_jbt ON peg.peg_nipp = peg_jbt.p_jbt_nipp
					LEFT JOIN (	SELECT * FROM v3_peg_tmt ORDER BY id_peg_tmt DESC) AS peg_tmt ON peg.peg_nipp = peg_tmt.p_tmt_nipp
					LEFT JOIN (	SELECT * FROM v3_peg_cabang) AS cab ON peg_tmt.p_tmt_nipp = cab.p_cab_nipp
					WHERE (\''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) > \''.$type.'\'
					AND \''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) < \''.$limit.'\'
					AND peg_tmt.p_tmt_end = \'0000-00-00\')  OR ((peg_tmt.p_tmt_reason = \'Pindah Cabang\') AND (peg_tmt.p_tmt_ket <> \'aktif\') )
					GROUP BY peg.id_pegawai
					ORDER BY peg.peg_tgl_lahir DESC
		');
		$query = $this->db->query($query); 
		return $query->num_rows();
	}
	
	function search_data_pegawai_keluar($num, $offset, $tahun, $type, $limit, $search)
	{
		$search=str_replace("'", '', $search);
		$query = ('
					SELECT * FROM v3_pegawai AS peg
					LEFT JOIN (	SELECT * FROM v3_peg_jabatan ORDER BY id_peg_jabatan DESC) AS peg_jbt ON peg.peg_nipp = peg_jbt.p_jbt_nipp
					LEFT JOIN (	SELECT * FROM v3_peg_tmt ORDER BY id_peg_tmt DESC) AS peg_tmt ON peg.peg_nipp = peg_tmt.p_tmt_nipp
					LEFT JOIN (	SELECT * FROM v3_peg_cabang) AS cab ON peg_tmt.p_tmt_nipp = cab.p_cab_nipp
					WHERE ((\''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) > \''.$type.'\'
					AND \''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) < \''.$limit.'\'
					AND peg_tmt.p_tmt_end = \'0000-00-00\')  OR ((peg_tmt.p_tmt_reason = \'Pindah Cabang\') AND (peg_tmt.p_tmt_ket <> \'aktif\') ))
					AND ((peg_nipp LIKE \'%'.$search.'%\')  OR  (peg_nama LIKE \'%'.$search.'%\') )
					GROUP BY peg.id_pegawai
					ORDER BY peg.peg_tgl_lahir DESC
					LIMIT '.$offset.' , '.$num
		);
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	function countSearchPegawaiKeluar( $tahun, $type, $limit, $search)
	{
		$search=str_replace("'", '', $search);
		$query = ('
					SELECT * FROM v3_pegawai AS peg
					LEFT JOIN (	SELECT * FROM v3_peg_jabatan ORDER BY id_peg_jabatan DESC) AS peg_jbt ON peg.peg_nipp = peg_jbt.p_jbt_nipp
					LEFT JOIN (	SELECT * FROM v3_peg_tmt ORDER BY id_peg_tmt DESC) AS peg_tmt ON peg.peg_nipp = peg_tmt.p_tmt_nipp
					LEFT JOIN (	SELECT * FROM v3_peg_cabang) AS cab ON peg_tmt.p_tmt_nipp = cab.p_cab_nipp
					WHERE ((\''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) > \''.$type.'\'
					AND \''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) < \''.$limit.'\'
					AND peg_tmt.p_tmt_end = \'0000-00-00\')  OR ((peg_tmt.p_tmt_reason = \'Pindah Cabang\') AND (peg_tmt.p_tmt_ket <> \'aktif\') ))
					AND ((peg_nipp LIKE \'%'.$search.'%\')  OR  (peg_nama LIKE \'%'.$search.'%\') )
					GROUP BY peg.id_pegawai
					ORDER BY peg.peg_tgl_lahir DESC
		');
		$query = $this->db->query($query); 
		return $query->num_rows();
	}
	
	function get_data_pegawai_pindah_cabang($num,$offset)
	{
		$query = "
					SELECT * FROM v3_peg_tmt AS tmt
					LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
					ON tmt.p_tmt_nipp = peg.peg_nipp
					LEFT JOIN (SELECT * FROM v3_peg_cabang) AS cab
					ON tmt.p_tmt_nipp = cab.p_cab_nipp
					WHERE tmt.p_tmt_reason = 'pindah cabang' 
					AND	tmt.p_tmt_ket <> 'aktif'
					ORDER BY tmt.p_tmt_nipp DESC
					LIMIT $offset , $num
			";
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_data_pegawai_phk($num,$offset)
	{
		$query = "
					SELECT * FROM v3_peg_tmt AS tmt
					LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
					ON tmt.p_tmt_nipp = peg.peg_nipp
					WHERE tmt.p_tmt_reason = 'PHK' 
					AND	tmt.p_tmt_ket <> 'aktif'
					ORDER BY tmt.p_tmt_nipp DESC
					LIMIT $offset , $num
			";
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function search_pegawai_pindah_cabang($num, $offset ,$search)
	{
		$search=str_replace("'", '', $search);
		$query = "
					SELECT * FROM v3_peg_tmt AS tmt
					LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
					ON tmt.p_tmt_nipp = peg.peg_nipp
					LEFT JOIN (SELECT * FROM v3_peg_cabang) AS cab
					ON tmt.p_tmt_nipp = cab.p_cab_nipp
					WHERE tmt.p_tmt_reason = 'pindah cabang'  
					AND	tmt.p_tmt_ket <> 'aktif' 
					AND ( peg.peg_nipp LIKE '%$search%' OR cab.p_cab_tmt_start LIKE '%$search%' OR peg.peg_nama LIKE '%$search%' OR cab.p_cab_kode_cabang LIKE '%$search%' )
					ORDER BY tmt.p_tmt_nipp DESC
					LIMIT $offset , $num
			";
		$query = $this->db->query($query); 
		return $query->result_array();
		
	
	}
	
	function search_pegawai_phk($num, $offset ,$search)
	{
		$search=str_replace("'", '', $search);
		$query = "
					SELECT * FROM v3_peg_tmt AS tmt
					LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
					ON tmt.p_tmt_nipp = peg.peg_nipp
					WHERE tmt.p_tmt_reason = 'PHK'  
					AND	tmt.p_tmt_ket <> 'aktif' 
					AND ( peg.peg_nipp LIKE '%$search%' OR peg.peg_nama LIKE '%$search%' OR tmt.p_tmt_end LIKE '%$search%'  )
					ORDER BY tmt.p_tmt_nipp DESC
					LIMIT $offset , $num
			";
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_data_jenis_pegawai($num, $offset, $type, $unit, $kelamin, $stk, $sub_unit)
	{
		$selection = "";
		if ($type !== 'all'){
			$selection .= " AND peg_tmt.p_tmt_status = '$type' "  ;
		}
		if ($unit !== 'all'){
			$selection .= " AND peg_unit.p_unt_kode_unit = '$unit' AND peg_unit.p_unt_tmt_end='0000-00-00' "  ;
		}
		if ($kelamin !== 'all'){
			$selection .= " AND peg.peg_jns_kelamin = '$kelamin' "  ;
		}
		if ($stk !== 'all'){
			$selection .= " AND peg_stk.p_stk_status_keluarga = '$stk' AND peg_stk.p_stk_aktif='1' "  ;
		}
		if ($sub_unit !== 'all'){
			$selection .= " AND peg_unit.p_unt_kode_sub_unit = '$sub_unit'  "  ;
		}
		
		
		$query = ('
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN (SELECT * FROM v3_peg_tmt ORDER BY id_peg_tmt DESC) AS peg_tmt
			ON peg.peg_nipp = peg_tmt.p_tmt_nipp
			LEFT JOIN (SELECT * FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unit
			ON peg.peg_nipp = peg_unit.p_unt_nipp
			LEFT JOIN (SELECT * FROM v3_peg_status_keluarga ORDER BY id_peg_status_keluarga DESC) AS peg_stk 
			ON peg.peg_nipp = peg_stk.p_stk_nipp
			WHERE peg_tmt.p_tmt_end = 0000-00-00 '.$selection.'
			GROUP BY peg.peg_nipp
			LIMIT '.$offset.' , '.$num.'
		');
		$query = $this->db->query($query);  
		return $query->result_array();
	}
	
	function get_data_unit_pegawai($num, $offset, $unit)
	{
		$query = ('
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN (SELECT * FROM v3_peg_unit) AS peg_unt
			ON peg.peg_nipp = peg_unt.p_unt_nipp
			WHERE peg_unt.p_unt_kode_unit = \'' . $unit . '\'
			LIMIT '.$offset.' , '.$num.'
		');
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function search_data_pegawai($num, $offset, $search)
	{
		$search=str_replace("'", '', $search);
		$query = "SELECT * from v3_peg_tmt  AS tmt
				LEFT JOIN (SELECT * FROM v3_pegawai) AS peg ON tmt.p_tmt_nipp = peg.peg_nipp
				WHERE tmt.p_tmt_end = '0000-00-00' AND (peg.peg_nipp LIKE '%$search%'  OR peg.peg_nama LIKE '%$search%')
				ORDER BY tmt.p_tmt_nipp DESC
				LIMIT $offset , $num ";
		$query = $this->db->query($query);
		return $query->result_array();
		
	}
	
	function get_data_pegawai_by_nipp($nipp)
	{
		$query = (" SELECT * FROM v3_pegawai WHERE peg_nipp = '$nipp' ");
		$query = $this->db->query($query); 
		if ($query->num_rows()>0){
			return $query->result_array();
		} else {
			return 0;
		}
		
	}
	
	function get_detail_pegawai_agama($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_ag_nipp',$nipp);
		$query = $this->db->get('v3_peg_agama');
		return $query->result_array();
	}
	
	function get_detail_pegawai_alamat($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_al_nipp',$nipp);
		$query = $this->db->get('v3_peg_alamat');
		return $query->result_array();
	}
	
	function get_detail_pegawai_ayah($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_ay_nipp',$nipp);
		$query = $this->db->get('v3_peg_ayah');
		return $query->result_array();
	}
	
	function get_detail_pegawai_bahasa($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_bhs_nipp',$nipp);
		$query = $this->db->get('v3_peg_bahasa');
		return $query->result_array();
	}
	
	function get_detail_pegawai_fisik($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_fs_nipp',$nipp);
		$query = $this->db->get('v3_peg_fisik');
		return $query->result_array();
	}
	
	function get_detail_pegawai_ibu($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_ibu_nipp',$nipp);
		$query = $this->db->get('v3_peg_ibu');
		return $query->result_array();
	}
	
	function get_detail_pegawai_jabatan($nipp)
	{
		$query = " 
				SELECT * FROM  `v3_peg_jabatan` AS jabatan
				LEFT JOIN (	SELECT * FROM  `v3_peg_unit` ORDER BY id_peg_unit DESC) AS unit 
				ON ( p_jbt_nipp = p_unt_nipp AND jabatan.p_jbt_tmt_start >= unit.p_unt_tmt_start ) 
				WHERE p_jbt_nipp = '$nipp'
				GROUP BY p_jbt_nipp,id_peg_jabatan,id_peg_unit
				ORDER BY id_peg_jabatan, id_peg_unit
				";
		$query = $this->db->query($query); 
		return $query->result_array();
	}
	
	function get_detail_pegawai_jabatan_tmt($nipp)
	{
		
		$query = ('
		SELECT * FROM v3_peg_jabatan AS peg_jbt
		LEFT JOIN (SELECT * FROM v3_peg_tmt) AS peg_tmt
		ON peg_jbt.p_jbt_nipp = peg_tmt.p_tmt_nipp
		WHERE peg_jbt.p_jbt_nipp = \'' . $nipp . '\'
		ORDER BY peg_tmt.id_peg_tmt DESC LIMIT 1
		');
		$query = $this->db->query($query); 
		return $query->result_array();
		
	}
	
	
	function get_detail_pegawai_mert_ayah($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_may_nipp',$nipp);
		$query = $this->db->get('v3_peg_mert_ayah');
		return $query->result_array();
	}
	
	function get_detail_pegawai_mert_ibu($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_mib_nipp',$nipp);
		$query = $this->db->get('v3_peg_mert_ibu');
		return $query->result_array();
	}
	
	function get_detail_pegawai_pasangan($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_ps_nipp',$nipp);
		$query = $this->db->get('v3_peg_pasangan');
		return $query->result_array();
	}
	
	function get_detail_pegawai_pendidikan($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_pdd_nipp',$nipp);
		$query = $this->db->get('v3_peg_pendidikan');
		return $query->result_array();
	}
	function get_detail_pegawai_pendidikan_full($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_pdd_nipp',$nipp);
		$query = $this->db->get('v3_peg_pendidikan');
		return $query->result_array();
	}
	
	function get_detail_pegawai_status_keluarga($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_stk_nipp',$nipp);
		$query = $this->db->get('v3_peg_status_keluarga');
		return $query->result_array();
	}
	
	function get_detail_pegawai_tmt($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_tmt_nipp',$nipp);
		//$this->db->order_by('p_tmt_nipp','DESC');
		$this->db->order_by('id_peg_tmt','DESC');
		$this->db->limit(1);
		$query = $this->db->get('v3_peg_tmt');
		return $query->result_array();
	}
	
	function get_detail_pegawai_unit($nipp)
	{
		$query = "
					SELECT * FROM v3_peg_unit AS peg_unit 
					LEFT JOIN (SELECT * FROM v3_sub_unit ) AS sub_unit
					ON peg_unit.p_unt_kode_sub_unit = sub_unit.su_kode_sub_unit
					WHERE peg_unit.p_unt_nipp = '$nipp'
					ORDER BY peg_unit.id_peg_unit ASC
				";
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	
	function get_last_pegawai_unit_team($nipp)
	{
		$query = "	
					SELECT * FROM v3_peg_unit AS peg_unt
					LEFT JOIN ( SELECT * FROM v3_peg_unit_team ORDER BY id_peg_unit_team DESC ) AS peg_team
					ON peg_unt.id_peg_unit = peg_team.id_peg_unit_team 
					WHERE peg_unt.p_unt_nipp = '$nipp'
					ORDER BY id_peg_unit DESC, id_peg_unit_team DESC
					LIMIT 1
				";
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function get_detail_pegawai_grade($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_grd_nipp',$nipp);
		$query = $this->db->get('v3_peg_grade');
		return $query->result_array();
	}
	
	function get_detail_pegawai_stkp($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_stkp_nipp',$nipp);
		$this->db->order_by('p_stkp_pelaksanaan', 'ASC');
		$query = $this->db->get('v3_peg_stkp');
		return $query->result_array();
	}
	
	function get_detail_pegawai_nstkp($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_nstkp_nipp',$nipp);
		$this->db->order_by('p_nstkp_pelaksanaan', 'ASC');
		$query = $this->db->get('v3_peg_non_stkp');
		return $query->result_array();
	}
	
	function get_detail_pegawai_anak($nipp)
	{
		$this->db->select('*');
		$this->db->where('peg_ank_nipp',$nipp);
		$this->db->order_by('peg_ank_tgl_lahir', 'ASC');
		$query = $this->db->get('v3_peg_anak');
		return $query->result_array();
	}
	
	function get_list_unit()
	{
		$query = $this->db->get('unit');
		return $query->result_array();
	}
	
	function get_list_sub_unit()
	{
		$query = "
				SELECT * FROM v3_sub_unit
				ORDER BY su_kode_unit,su_kode_sub_unit
		";	
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function get_list_team()
	{
		$query = "
				SELECT * FROM v3_subunit_team
				ORDER BY sut_kode_sub_unit,sut_kode_team
		";	
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function get_list_jabatan()
	{
		$query = $this->db->get('v3_peg_tab_jabatan');
		return $query->result_array();
	}
	
	function get_data_pegawai_last_status_keluarga($nipp)
	{
		$query = "
				SELECT * FROM v3_peg_status_keluarga 
				WHERE p_stk_nipp = '$nipp'
				ORDER BY p_stk_update_on,id_peg_status_keluarga DESC
				LIMIT 1
		";	
		$query = $this->db->query($query);
		$result = $query->result_array();
		$id_peg_stk= "";
		foreach($result as $row){
			$id_peg_stk = $row['id_peg_status_keluarga'];
		}
		return $id_peg_stk;
	}
	
	function add_list_jabatan()
	{
		$data = array('peg_tab_jab' => $this->input->post('jabatan'));
		$this->db->insert('v3_peg_tab_jabatan', $data);
	}
	
	function edit_list_jabatan()
	{
		$data = array('peg_tab_jab' => $this->input->post('jabatan'));
		$this->db->where('peg_tab_jab', $this->input->post('list_jabatan'));
		$this->db->update('v3_peg_tab_jabatan', $data);
	}
	
	function get_supervisor($num, $offset)
	{
		$supervisor = '%Supervisor%';
		$query = ('SELECT peg_nipp, peg_nama, peg_jns_kelamin, peg_tgl_lahir, p_jbt_jabatan, p_unt_kode_unit, p_tmt_tmt, p_grd_grade FROM v3_pegawai AS peg
			LEFT JOIN (SELECT p_jbt_nipp, p_jbt_jabatan FROM v3_peg_jabatan) AS peg_jbt
			ON peg.peg_nipp = peg_jbt.p_jbt_nipp 
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt
			ON peg.peg_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT p_tmt_nipp, p_tmt_end, p_tmt_tmt FROM v3_peg_tmt) AS peg_tmt
			ON peg.peg_nipp = peg_tmt.p_tmt_nipp 
			LEFT JOIN (SELECT p_grd_nipp, p_grd_grade FROM v3_peg_grade) AS peg_grd
			ON peg.peg_nipp = peg_grd.p_grd_nipp 
			WHERE peg_jbt.p_jbt_jabatan LIKE \''.$supervisor.'\'
			AND peg_tmt.p_tmt_end = \'0000-00-00\'
			ORDER BY peg_unt.p_unt_kode_unit
			LIMIT '.$offset.' , '.$num.'');
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	#----- COUNT DATA -------#
	function countPegawai()
	{
		return $this->db->count_all_results('v3_pegawai');
	}
	
	function countPegawaiPensiun($tahun, $type, $limit)
	{
		$type2=$type+1; // utk pegawai lahir desember
		$tahun2=$tahun-1;
		$query = ('
			SELECT * FROM v3_pegawai AS peg 
			LEFT JOIN (SELECT p_jbt_nipp, p_jbt_jabatan FROM v3_peg_jabatan ORDER BY id_peg_jabatan DESC) AS peg_jbt 
			ON peg.peg_nipp = peg_jbt.p_jbt_nipp 
			LEFT JOIN (SELECT p_tmt_nipp, p_tmt_tmt, p_tmt_end FROM v3_peg_tmt ORDER BY id_peg_tmt DESC) AS peg_tmt 
			ON peg.peg_nipp = peg_tmt.p_tmt_nipp 
			LEFT JOIN (SELECT * FROM v3_peg_ppb ORDER BY p_ppb_update_on DESC) AS peg_ppb
			ON peg.peg_nipp = peg_ppb.p_ppb_nipp
			WHERE (\''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) > \''.$type.'\'  
			AND \''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) < \''.$limit.'\'
			AND MONTH(peg.peg_tgl_lahir) <> 12 ) 
			OR (MONTH(peg.peg_tgl_lahir) = 12 AND DATE(peg.peg_tgl_lahir) > 1 AND  \''.$tahun2.'\' - YEAR(peg.peg_tgl_lahir) > \''.$type.'\' AND \''.$tahun2.'\' - YEAR(peg.peg_tgl_lahir) < \''.$limit.'\')
			AND peg_tmt.p_tmt_end = \'0000-00-00\'
			GROUP BY peg.peg_nipp DESC
			ORDER BY peg.peg_tgl_lahir DESC
		');
		
		$query = $this->db->query($query); 
		return $query->num_rows();
	}
	
	function count_jenis_Pegawai($type,$unit,$kelamin,$stk,$sub_unit)
	{
		$selection = "";
		if ($type !== 'all'){
			$selection .= " AND peg_tmt.p_tmt_status = '$type' "  ;
		}
		if ($unit !== 'all'){
			$selection .= " AND peg_unit.p_unt_kode_unit = '$unit' "  ;
		}
		if ($kelamin !== 'all'){
			$selection .= " AND peg.peg_jns_kelamin = '$kelamin' "  ;
		}
		if ($stk !== 'all'){
			$selection .= " AND peg_stk.p_stk_status_keluarga = '$stk' AND peg_stk.p_stk_aktif='1' "  ;
		}
		if ($sub_unit !== 'all'){
			$selection .= " AND peg_unit.p_unt_kode_sub_unit = '$sub_unit' "  ;
		}
		
		
		$query = ('
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN (SELECT * FROM v3_peg_tmt ORDER BY id_peg_tmt DESC) AS peg_tmt
			ON peg.peg_nipp = peg_tmt.p_tmt_nipp
			LEFT JOIN (SELECT * FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unit
			ON peg.peg_nipp = peg_unit.p_unt_nipp
			LEFT JOIN (SELECT * FROM v3_peg_status_keluarga ORDER BY id_peg_status_keluarga DESC) AS peg_stk 
			ON peg.peg_nipp = peg_stk.p_stk_nipp
			WHERE peg_tmt.p_tmt_end = 0000-00-00 '.$selection.'
			GROUP BY peg.peg_nipp
		');
		$query = $this->db->query($query);  
		return $query->num_rows();
		
		/*
		$search = array('p_tmt_status'=>$type, 'p_tmt_end'=>'0000-00-00');
		$this->db->where($search);
		return $this->db->count_all_results('v3_peg_tmt');
		*/
	}
	
	function count_unit_Pegawai($unit)
	{
		$this->db->where('p_unt_kode_unit',$unit);
		return $this->db->count_all_results('v3_peg_unit');
	}
	
	function count_result_bahasa($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_bhs_nipp',$nipp);
		$this->db->from('v3_peg_bahasa');
		return $this->db->count_all_results();
	}
	
	function count_search_pegawai($search)
	{	$search=str_replace("'", '', $search);
		$query = "SELECT * from v3_peg_tmt  AS tmt
				LEFT JOIN (SELECT * FROM v3_pegawai) AS peg ON tmt.p_tmt_nipp = peg.peg_nipp
				WHERE tmt.p_tmt_end = '0000-00-00' AND (peg.peg_nipp LIKE '%$search%'  OR peg.peg_nama LIKE '%$search%')
				ORDER BY tmt.p_tmt_nipp DESC";
		$query = $this->db->query($query);
		return $query->num_rows();
		
		/*$this->db->select('*');
		$this->db->like('peg_nipp', $search);
		$this->db->or_like('peg_nama', $search);
		$this->db->from('v3_pegawai');
		return $this->db->count_all_results();
		*/
	}
	
	function count_search_pegawai_unit($search,$unit)
	{
		$search=str_replace("'", '', $search);
		$selection = " ";
		if (strtoupper($unit) !== 'ALL'){
			$selection .= " AND unit.p_unt_kode_unit = '$unit' ";
		}
		if ($search == "ALL" ){$search="";}
		
		$query = ("
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN (SELECT * FROM v3_peg_unit ORDER BY id_peg_unit DESC) AS unit
			ON peg.peg_nipp = unit.p_unt_nipp
			WHERE ( peg.peg_nipp LIKE '%$search%' OR peg.peg_nama LIKE '%$search%' ) $selection
			GROUP BY id_pegawai
		");
		
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	function count_supervisor()
	{
		$supervisor = '%Supervisor%';
		$query = ('SELECT peg_nipp, peg_nama, peg_jns_kelamin, peg_tgl_lahir, p_jbt_jabatan, p_unt_kode_unit, p_tmt_tmt, p_grd_grade FROM v3_pegawai AS peg
			LEFT JOIN (SELECT p_jbt_nipp, p_jbt_jabatan FROM v3_peg_jabatan) AS peg_jbt
			ON peg.peg_nipp = peg_jbt.p_jbt_nipp 
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt
			ON peg.peg_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT p_tmt_nipp, p_tmt_end, p_tmt_tmt FROM v3_peg_tmt) AS peg_tmt
			ON peg.peg_nipp = peg_tmt.p_tmt_nipp 
			LEFT JOIN (SELECT p_grd_nipp, p_grd_grade FROM v3_peg_grade) AS peg_grd
			ON peg.peg_nipp = peg_grd.p_grd_nipp 
			WHERE peg_jbt.p_jbt_jabatan LIKE \''.$supervisor.'\'
			AND peg_tmt.p_tmt_end = \'0000-00-00\'
			ORDER BY peg_unt.p_unt_kode_unit');
		
		$query = $this->db->query($query); 
		return $query->num_rows();
	}
	
	function count_data_jumlah_anak($nipp)
	{
		$this->db->where('peg_ank_nipp', $nipp);
		return $this->db->count_all_results('v3_peg_anak');
	}
	
	function count_pegawai_aktif()
	{
		$query = "	
		SELECT * FROM v3_pegawai AS peg
		LEFT JOIN (SELECT * from v3_peg_tmt ORDER BY id_peg_tmt DESC) AS tmt ON tmt.p_tmt_nipp = peg.peg_nipp
		WHERE tmt.p_tmt_end = '0000-00-00'
		GROUP BY peg.peg_nipp 
		ORDER BY tmt.p_tmt_nipp DESC
				";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	function count_pindah_cabang()
	{
		$query = "
					SELECT * FROM v3_peg_tmt AS tmt
					LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
					ON tmt.p_tmt_nipp = peg.peg_nipp
					WHERE tmt.p_tmt_reason = 'pindah cabang' 
					AND	tmt.p_tmt_ket <> 'aktif'
					ORDER BY tmt.p_tmt_nipp DESC
			";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	function count_phk()
	{
		$query = "
					SELECT * FROM v3_peg_tmt AS tmt
					LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
					ON tmt.p_tmt_nipp = peg.peg_nipp
					WHERE tmt.p_tmt_reason = 'PHK' 
					AND	tmt.p_tmt_ket <> 'aktif'
					ORDER BY tmt.p_tmt_nipp DESC
			";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	function count_search_pindah_cabang($search)
	{
		$search=str_replace("'", '', $search);
		$query = "
					SELECT * FROM v3_peg_tmt AS tmt
					LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
					ON tmt.p_tmt_nipp = peg.peg_nipp
					LEFT JOIN (SELECT * FROM v3_peg_cabang) AS cab
					ON tmt.p_tmt_nipp = cab.p_cab_nipp
					WHERE tmt.p_tmt_reason = 'pindah cabang'  
					AND	tmt.p_tmt_ket <> 'aktif' 
					AND ( peg.peg_nipp LIKE '%$search%' OR cab.p_cab_tmt_start LIKE '%$search%' OR peg.peg_nama LIKE '%$search%' OR cab.p_cab_kode_cabang LIKE '%$search%' )
					ORDER BY tmt.p_tmt_nipp DESC
				";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
	
	function count_search_phk($search)
	{
		$search=str_replace("'", '', $search);
		$query = "
					SELECT * FROM v3_peg_tmt AS tmt
					LEFT JOIN (SELECT * FROM v3_pegawai) AS peg
					ON tmt.p_tmt_nipp = peg.peg_nipp
					WHERE tmt.p_tmt_reason = 'PHK'  
					AND	tmt.p_tmt_ket <> 'aktif' 
					AND ( peg.peg_nipp LIKE '%$search%' OR peg.peg_nama LIKE '%$search%' OR tmt.p_tmt_end LIKE '%$search%' )
					ORDER BY tmt.p_tmt_nipp DESC
				";
		$query = $this->db->query($query);
		return $query->num_rows();
	}
					
	#----- INSERTING DATA TO DATABASE -----#
	function insert_data_pegawai($data_pegawai)
	{
		$this->db->insert('v3_pegawai',$data_pegawai);
	}
	
	function insert_data_pegawai_agama($data_agama)
	{
		$this->db->insert('v3_peg_agama',$data_agama);
	}
	
	function insert_data_pegawai_alamat($data_alamat)
	{
		$this->db->insert('v3_peg_alamat',$data_alamat);
	}
	
	function insert_data_pegawai_ayah($data_ayah)
	{
		$this->db->insert('v3_peg_ayah',$data_ayah);
	}
	
	function insert_data_pegawai_bahasa($data_bahasa)
	{
		$this->db->insert('v3_peg_bahasa',$data_bahasa);
	}
	
	function insert_data_pegawai_fisik($data_fisik)
	{
		$this->db->insert('v3_peg_fisik',$data_fisik);
	}
	
	function insert_data_pegawai_ibu($data_ibu)
	{
		$this->db->insert('v3_peg_ibu',$data_ibu);
	}
	
	function insert_data_pegawai_jabatan($data_jabatan)
	{
		$this->db->insert('v3_peg_jabatan',$data_jabatan);
	}
	
	function insert_data_pegawai_mert_ayah($data_mert_ayah)
	{
		$this->db->insert('v3_peg_mert_ayah',$data_mert_ayah);
	}
	
	function insert_data_pegawai_mert_ibu($data_mert_ibu)
	{
		$this->db->insert('v3_peg_mert_ibu',$data_mert_ibu);
	}
	
	function insert_data_pegawai_pasangan($data_pasangan)
	{
		$this->db->insert('v3_peg_pasangan',$data_pasangan);
	}
	
	function insert_data_pegawai_pendidikan($data_pendidikan)
	{
		$this->db->insert('v3_peg_pendidikan',$data_pendidikan);
	}
	
	function insert_data_pegawai_status_keluarga($data_status_keluarga)
	{
		$this->db->insert('v3_peg_status_keluarga',$data_status_keluarga);
	}
	
	function insert_data_pegawai_tmt($data_tmt)
	{
		$this->db->insert('v3_peg_tmt',$data_tmt);
	}
	
	function insert_data_pegawai_unit($data_unit)
	{
		$this->db->insert('v3_peg_unit',$data_unit);
	}
	
	function insert_data_pegawai_anak($data_anak)
	{
		$this->db->insert('v3_peg_anak',$data_anak);
	}
	
	function insert_data_pegawai_grade($data_grade)
	{
		$this->db->insert('v3_peg_grade',$data_grade);
	}
	
	function add_pindah_cabang($data_pegawai)
	{
		$this->db->insert('v3_peg_cabang',$data_pegawai);
	}
	function insert_data_pegawai_stkp($data_stkp)
	{
		$this->db->insert('v3_peg_stkp',$data_stkp);
	}
	function insert_data_pegawai_nstkp($data_nstkp)
	{
		$this->db->insert('v3_peg_non_stkp',$data_nstkp);
	}
	
	
//-------- update data pegawai --------------//
	
	function update_data_pegawai($data_pegawai)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('peg_nipp', $nipp);
		$this->db->update('v3_pegawai',$data_pegawai);
	}
	
	function update_data_telp($data_telp)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('p_al_nipp', $nipp);
		$this->db->update('v3_peg_alamat',$data_telp);
	}
	
	function update_data_alamat($data_alamat)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('p_al_nipp', $nipp);
		$this->db->update('v3_peg_alamat',$data_alamat);
	}
	
	function update_data_pasangan($data_pasangan)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('p_ps_nipp', $nipp);
		$this->db->update('v3_peg_pasangan',$data_pasangan);
	}
	
	function update_data_ayah($data_ayah)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('p_ay_nipp', $nipp);
		$this->db->update('v3_peg_ayah',$data_ayah);
		
		if($this->db->affected_rows()){
      		return '1';
      	}else{
      		return '0';
		}
	}
	
	function update_data_ibu($data_ibu)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('p_ibu_nipp', $nipp);
		$this->db->update('v3_peg_ibu',$data_ibu);
		if($this->db->affected_rows()){
      		return '1';
      	}else{
      		return '0';
		}
	}
	
	function update_data_mert_ayah($data_mert_ayah)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('p_may_nipp', $nipp);
		$this->db->update('v3_peg_mert_ayah',$data_mert_ayah);
		if($this->db->affected_rows()){
      		return '1';
      	}else{
      		return '0';
		}
	}
	
	function update_data_mert_ibu($data_mert_ibu)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('p_mib_nipp', $nipp);
		$this->db->update('v3_peg_mert_ibu',$data_mert_ibu);
		if($this->db->affected_rows()){
      		return '1';
      	}else{
      		return '0';
		}
	}
	
	function update_data_anak($data_anak)
	{
		$datestring = "%Y-%m-%d" ;
		for ($i=1; $i<=$this->input->post('jumlah'); $i++)
		{
		$tanggal='0000-00-00';
		if($this->input->post('tanggal_'.$i) !== '00/00/0000'){$tanggal = mdate($datestring, strtotime(str_replace('/','-',$this->input->post('tanggal_'.$i))));}
		
		$data_anak = array(
				'peg_ank_nama'			=> $this->input->post('nama_'.$i),
				'peg_ank_tempat_lahir'	=> $this->input->post('tempat_'.$i),
				'peg_ank_tgl_lahir'		=> $tanggal,
				'peg_ank_pendidikan'	=> $this->input->post('pendidikan_'.$i),
				'peg_ank_jns_kelamin'	=> $this->input->post('jns_klm_'.$i),
				'peg_ank_agama'			=> $this->input->post('agama_'.$i),
				'peg_ank_status'		=> $this->input->post('status_'.$i),
			);
		$this->db->where('id_peg_anak', $this->input->post('id_anak_'.$i));
		$this->db->update('v3_peg_anak',$data_anak);
		}
	}
	
	function update_data_pendidikan($data_pendidikan)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('p_pdd_nipp', $nipp);
		$this->db->update('v3_peg_pendidikan',$data_pendidikan);
	}
	
	function update_data_tmt($tanggal)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('p_tmt_nipp', $nipp);
		$this->db->update('v3_peg_tmt',$tanggal);
	}
	
	function update_data_last_tmt($data,$id)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('id_peg_tmt', $id);
		$this->db->update('v3_peg_tmt',$data);
	}
	
	function update_data_bahasa($data_bahasa, $id_bahasa)
	{
		$this->db->where('id_peg_bahasa', $id_bahasa);
		$this->db->update('v3_peg_bahasa',$data_bahasa);
	}
	
	function update_data_pegawai_agama($data_agama)
	{
		$nipp = $this->uri->segment(3);
		$this->db->where('p_ag_nipp', $nipp);
		$this->db->update('v3_peg_agama',$data_agama);
	}
	
	function delete_data_pasangan($nipp)
	{
		$this->db->where('p_ps_nipp', $nipp);
		$this->db->delete('v3_peg_pasangan');
	}
	
	function update_data_status_keluarga($data_stk,$id_stk)
	{
		$this->db->where('id_peg_status_keluarga', $id_stk);
		$this->db->update('v3_peg_status_keluarga',$data_stk);
	}
	
	
	function delete_pegawai($nipp)
	{
		$this->db->where('peg_nipp', $nipp);
		$this->db->delete('v3_pegawai'); 
		$this->db->where('p_ag_nipp', $nipp);
		$this->db->delete('v3_peg_agama'); 
		$this->db->where('p_al_nipp', $nipp);
		$this->db->delete('v3_peg_alamat'); 
		$this->db->where('p_ay_nipp', $nipp);
		$this->db->delete('v3_peg_ayah'); 
		$this->db->where('p_bhs_nipp', $nipp);
		$this->db->delete('v3_peg_bahasa'); 
		$this->db->where('p_fs_nipp', $nipp);
		$this->db->delete('v3_peg_fisik'); 
		$this->db->where('p_ibu_nipp', $nipp);
		$this->db->delete('v3_peg_ibu'); 
		$this->db->where('p_jbt_nipp', $nipp);
		$this->db->delete('v3_peg_jabatan'); 
		$this->db->where('p_may_nipp', $nipp);
		$this->db->delete('v3_peg_mert_ayah'); 
		$this->db->where('p_mib_nipp', $nipp);
		$this->db->delete('v3_peg_mert_ibu'); 
		$this->db->where('p_ps_nipp', $nipp);
		$this->db->delete('v3_peg_pasangan');
		$this->db->where('p_pdd_nipp', $nipp);
		$this->db->delete('v3_peg_pendidikan');
		$this->db->where('p_stk_nipp', $nipp);
		$this->db->delete('v3_peg_status_keluarga');
		$this->db->where('p_tmt_nipp', $nipp);
		$this->db->delete('v3_peg_tmt');
		$this->db->where('p_unt_nipp', $nipp);
		$this->db->delete('v3_peg_unit');
	}

	function get_data_pegawai_unlimited()
	{
		$query="
			SELECT * FROM v3_pegawai AS peg
			LEFT JOIN v3_peg_agama ON peg.peg_nipp = v3_peg_agama.p_ag_nipp 
			LEFT JOIN v3_peg_alamat ON peg.peg_nipp = v3_peg_alamat.p_al_nipp
			LEFT JOIN ( SELECT * FROM v3_peg_grade ORDER BY id_peg_grade DESC) AS peg_grade 
			ON peg.peg_nipp = peg_grade.p_grd_nipp
			LEFT JOIN (SELECT id_peg_unit, p_unt_nipp, p_unt_kode_unit, p_unt_kode_sub_unit FROM v3_peg_unit ORDER BY id_peg_unit DESC ) AS peg_unt 
			ON peg.peg_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT * FROM unit ORDER BY kode_unit DESC) AS unit
			ON unit.kode_unit = peg_unt.p_unt_kode_unit
			LEFT JOIN (SELECT * FROM v3_sub_unit ORDER BY su_kode_sub_unit DESC) AS sub_unit
			ON sub_unit.su_kode_sub_unit = peg_unt.p_unt_kode_sub_unit
			
			GROUP BY peg.id_pegawai 
			ORDER BY unit.kode_unit,sub_unit.su_kode_sub_unit,peg.peg_nipp ASC
			
		";
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function get_data_pensiun_unlimited($tahun, $type, $limit)
	{
		$query='
			SELECT * FROM v3_pegawai AS peg 
			LEFT JOIN (SELECT p_jbt_nipp, p_jbt_jabatan FROM v3_peg_jabatan) AS peg_jbt 
			ON peg.peg_nipp = peg_jbt.p_jbt_nipp 
			LEFT JOIN (SELECT p_tmt_nipp, p_tmt_tmt, p_tmt_end FROM v3_peg_tmt) AS peg_tmt 
			ON peg.peg_nipp = peg_tmt.p_tmt_nipp 
			WHERE \''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) > \''.$type.'\'
			AND \''.$tahun.'\' - YEAR(peg.peg_tgl_lahir) < \''.$limit.'\'
			AND peg_tmt.p_tmt_end = \'0000-00-00\'
			ORDER BY peg.peg_tgl_lahir DESC
		';
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function get_data_spv_unlimited()
	{
		$supervisor = '%Supervisor%';
		$query = ('SELECT peg_nipp, peg_nama, peg_jns_kelamin, peg_tgl_lahir, p_jbt_jabatan, p_unt_kode_unit, p_tmt_tmt, p_grd_grade FROM v3_pegawai AS peg
			LEFT JOIN (SELECT p_jbt_nipp, p_jbt_jabatan FROM v3_peg_jabatan) AS peg_jbt
			ON peg.peg_nipp = peg_jbt.p_jbt_nipp 
			LEFT JOIN (SELECT p_unt_nipp, p_unt_kode_unit FROM v3_peg_unit) AS peg_unt
			ON peg.peg_nipp = peg_unt.p_unt_nipp 
			LEFT JOIN (SELECT p_tmt_nipp, p_tmt_end, p_tmt_tmt FROM v3_peg_tmt) AS peg_tmt
			ON peg.peg_nipp = peg_tmt.p_tmt_nipp 
			LEFT JOIN (SELECT p_grd_nipp, p_grd_grade FROM v3_peg_grade) AS peg_grd
			ON peg.peg_nipp = peg_grd.p_grd_nipp 
			WHERE peg_jbt.p_jbt_jabatan LIKE \''.$supervisor.'\'
			AND peg_tmt.p_tmt_end = \'0000-00-00\'
			ORDER BY peg_unt.p_unt_kode_unit
			');
		$query = $this->db->query($query);
		return $query->result_array();
	}
	
	function get_last_tmt_by_nipp($nipp)
	{
		$query = "
			SELECT * FROM v3_peg_tmt 
			WHERE p_tmt_nipp ='$nipp' 
			ORDER BY id_peg_tmt DESC
			LIMIT 1
		";
		$query = $this->db->query($query);
		$result = $query->result_array();
		$id_peg_tmt = "";
		foreach($result as $row){
			$id_peg_tmt = $row['id_peg_tmt'];
		}
		return $id_peg_tmt;
	}
	
	function get_last_jabatan($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_jbt_nipp',$nipp);
		$this->db->order_by('id_peg_jabatan', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('v3_peg_jabatan');
		return $query->result_array();
	}
	
	function get_data_ppb($nipp){
		$query = "SELECT * FROM v3_peg_ppb WHERE p_ppb_nipp = '$nipp' ORDER BY p_ppb_update_on DESC LIMIT 1";
		$query = $this->db->query($query);
		if ($query->num_rows()>0){
			return $query->result_array();
		} else {
			return 0;
		}
	}
	
	function insert_data_ppb($data)
	{
		$this->db->insert('v3_peg_ppb',$data);
	}
	
	
	function update_tmt_end($id,$tmt)
	{
		$this->db->where('id_peg_tmt', $id);
		$this->db->update('v3_peg_tmt',$tmt);
	}
	
	function delete_data_anak($id)
	{
		$this->db->where('id_peg_anak', $id);
		$this->db->delete('v3_peg_anak');
	}
	
	function get_new_pegawai_status_keluarga($nipp,$kriteria)
	{
		$query = "
			SELECT * FROM v3_peg_status_keluarga 
			WHERE p_stk_nipp ='$nipp' 
			ORDER BY id_peg_status_keluarga DESC
			LIMIT 1
		";
		
		$query = $this->db->query($query);
		$result = $query->result_array();
		$id_peg_tmt = "";
		foreach($result as $row){
			$stk = $row['p_stk_status_keluarga'];
		}
		
		if($stk !== NULL){
			$daftar	= array (
					'1' => 'TK',
					'2' => 'K',
					'3'	=> 'K1',
					'4'	=> 'K2',
					'5' => 'K3',
					'6' => 'K4',
					'7' => 'K5',
				);
			$status="";	
			for ($i=1;$i<=7;$i++){
				if ($stk == $daftar[$i]){$n=$i;}
			}
			if($kriteria=='delete'){$n--;}
			else if($kriteria=='add'){
				$n++; 
				if($n>7){$n=7;}
			}
			$newstk=$daftar[$n];
		}
		return $newstk;
	}
	
	function update_data_pegawai_jabatan($tmt,$id)
	{
		$this->db->where('id_peg_jabatan', $id);
		$this->db->update('v3_peg_jabatan',$tmt);
	}
	
	function update_data_pegawai_unit($tmt,$id)
	{
		$this->db->where('id_peg_unit', $id);
		$this->db->update('v3_peg_unit',$tmt);
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
	/*
	function copy_data_pegawai($nipp,$nipp_baru)
	{
		$pegawai= get_data_pegawai_by_nipp($nipp);
		$agama = get_detail_pegawai_agama($nipp);
		$alamat = get_detail_pegawai_alamat($nipp);
		$ayah = get_detail_pegawai_ayah($nipp);
		$bahasa = get_detail_pegawai_bahasa($nipp);
		$fisik = get_detail_pegawai_fisik($nipp);
		$ibu = get_detail_pegawai_ibu($nipp);
		$mert_ayah = get_detail_pegawai_mert_ayah($nipp);
		$mert_ibu = get_detail_pegawai_mert_ibu($nipp);
		$pasangan = get_detail_pegawai_pasangan($nipp);
		$pendidikan = get_detail_pegawai_pendidikan($nipp);
		$status_keluarga = get_detail_pegawai_status_keluarga($nipp);
		$tmt = get_detail_pegawai_tmt($nipp);
		$unit = get_detail_pegawai_unit($nipp);
		$grade = get_detail_pegawai_grade($nipp);
		$stkp = get_detail_pegawai_stkp($nipp);		
		$anak = get_detail_pegawai_anak($nipp);
		$jabatan = get_last_jabatan($nipp);
		
		#copy data pegawai
		foreach($pegawai as $row_pegawai){}
		$data_pegawai = array(
			'peg_nipp'			=> 	$nipp_baru,
			'peg_nama'			=>	$row_pegawai['peg_nama'],	
			'peg_tmpt_lahir'	=>	$row_pegawai['peg_tmpt_lahir'],
			'peg_tgl_lahir'		=>	$row_pegawai['peg_tgl_lahir'],
			'peg_jns_kelamin'	=>	$row_pegawai['peg_jns_kelamin'],
			'peg_gol_darah'		=>	$row_pegawai['peg_gol_darah'],
			'peg_update_by'		=>	'admin',
		);
		insert_data_pegawai($data_pegawai);
		
	}
	*/
}
/* End of file myfile.php */
/* Location: ./system/modules/mymodule/myfile.php */