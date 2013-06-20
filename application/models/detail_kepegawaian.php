<?php
class Detail_kepegawaian extends CI_Model
{

	function __construct()
	{
        parent::__construct();
		$this->load->database();
    }
	
	function get_data_pegawai_by_nipp($nipp)
	{
		$query = ("SELECT * FROM v3_pegawai WHERE peg_nipp = '$nipp'");
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
		/*
		$this->db->select('*');
		$this->db->where('p_jbt_nipp',$nipp);
		$this->db->order_by('id_peg_jabatan', 'DESC');
		$query = $this->db->get('v3_peg_jabatan');
		return $query->result_array();
		*/
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
		$this->db->select('*');
		$this->db->where('p_unt_nipp',$nipp);
		$query = $this->db->get('v3_peg_unit');
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
		$query = $this->db->get('v3_peg_stkp');
		return $query->result_array();
	}
	
	function get_detail_pegawai_nstkp($nipp)
	{
		$this->db->select('*');
		$this->db->where('p_nstkp_nipp',$nipp);
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

} 
?>	