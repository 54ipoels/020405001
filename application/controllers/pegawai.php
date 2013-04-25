<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pegawai extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
		$this->load->model('kepegawaian/kepegawaian');
		$this->load->model('pindah');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index($nipp)
	{
		//$data_lama = $this->kepegawaian->get_data_lama();
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		//foreach ($data_lama as $row_data_lama ) :
		//{
			/*$data_pegawai = array(
				'nipp' 			=> $row_data_lama['nip'],
				'nama' 			=> $row_data_lama['nama'],
				'tmpt_lahir'	=> $row_data_lama['tempat_lahir'],
				'tgl_lahir'		=> $row_data_lama['tgl_lahir'],
				'jns_kelamin'	=> $row_data_lama['jenis_kelamin'],
				'gol_darah'		=> $row_data_lama['gol_darah'],
				'update_on'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai($data_pegawai);
			
			$data_agama = array(
				'nipp' 			=> $row_data_lama['nip'],
				'agama' 		=> $row_data_lama['agama'],
				'tanggal'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_agama($data_agama);
			
			$data_alamat = array(
				'nipp' 			=> $row_data_lama['nip'],
				'jalan' 		=> $row_data_lama['jl_no'],
				'kelurahan'		=> $row_data_lama['kelurahan'],
				'kecamatan' 	=> $row_data_lama['kecamatan'],
				'kabupaten' 	=> $row_data_lama['kabupaten'],
				'provinsi' 		=> $row_data_lama['propinsi'],
				'no_telp' 		=> $row_data_lama['NO_TELP'],
				'email' 		=> $row_data_lama['E_MAIL'],
				'tanggal'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_alamat($data_alamat);
			
			$data_ayah = array(
				'nipp' 			=> $row_data_lama['nip'],
				'nama' 			=> $row_data_lama['ortu_bapak'],
				'tgl_lahir'		=> $row_data_lama['ttl_bapak'],
				'tgl_meninggal'	=> '',
				'alamat'		=> $row_data_lama['alamat_bapak'],
				'pekerjaan'		=> $row_data_lama['pekerjaan_bapak'],
				'update_on'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_ayah($data_ayah);
			
			$data_ibu = array(
				'nipp' 			=> $row_data_lama['nip'],
				'nama' 			=> $row_data_lama['ortu_ibu'],
				'tgl_lahir'		=> $row_data_lama['ttl_ibu'],
				'tgl_meninggal'	=> '',
				'alamat'		=> $row_data_lama['alamat_ibu'],
				'pekerjaan'		=> $row_data_lama['pekerjaan_ibu'],
				'update_on'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_ibu($data_ibu);
			
			$data_mert_ayah = array(
				'nipp' 			=> $row_data_lama['nip'],
				'nama' 			=> $row_data_lama['mertua_bapak'],
				'tgl_lahir'		=> $row_data_lama['ttl_bapak_mertua'],
				'tgl_meninggal'	=> '',
				'alamat'		=> $row_data_lama['alamat_bapak_mertua'],
				'pekerjaan'		=> $row_data_lama['pekerjaan_bapak_mertua'],
				'update_on'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_mert_ayah($data_mert_ayah);
			
			$data_mert_ibu = array(
				'nipp' 			=> $row_data_lama['nip'],
				'nama' 			=> $row_data_lama['mertua_ibu'],
				'tgl_lahir'		=> $row_data_lama['ttl_ibu_mertua'],
				'tgl_meninggal'	=> '',
				'alamat'		=> $row_data_lama['alamat_ibu_mertua'],
				'pekerjaan'		=> $row_data_lama['pekerjaan_ibu_mertua'],
				'update_on'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_mert_ibu($data_mert_ibu); 
			
			$data_bahasa = array(
				'nipp' 			=> $row_data_lama['nip'],
				'bahasa' 		=> $row_data_lama['bhs_2'],
				'tanggal'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_bahasa($data_bahasa);
			
			$data_fisik = array(
				'nipp' 			=> $row_data_lama['nip'],
				'tinggi' 		=> $row_data_lama['tinggi'],
				'berat' 		=> $row_data_lama['berat'],
				'foto'	 		=> $row_data_lama['FOTO'],
				'tanggal'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_fisik($data_fisik);
			
			$data_jabatan = array(
				'nipp' 			=> $row_data_lama['nip'],
				'jabatan' 		=> $row_data_lama['jabatan_terakhir'],
				'tanggal'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_jabatan($data_jabatan);
			
			$data_pasangan = array(
				'nipp' 			=> $row_data_lama['nip'],
				'nama' 			=> $row_data_lama['nama_istri'],
				'tgl_lahir'		=> $row_data_lama['tgl_lhr_istri'],
				'tgl_meninggal'	=> '',
				'alamat'		=> $row_data_lama['alamat_istri'],
				'pekerjaan'		=> $row_data_lama['pekerjaan_istri'],
				'update_on'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_pasangan($data_pasangan);
			
			$data_pendidikan = array(
				'nipp' 			=> $row_data_lama['nip'],
				'tingkat' 		=> $row_data_lama['pend_terakhir'],
				'lp' 			=> '',
				'tanggal'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_pendidikan($data_pendidikan);
			
			$data_status_keluarga = array(
				'nipp' 			  => $row_data_lama['nip'],
				'status_keluarga' => $row_data_lama['status_keluarga'],
				'tanggal'		  => $tanggal,
				'update_by'		  => 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_status_keluarga($data_status_keluarga); 
			
			$data_tmt = array(
				'p_tmt_nipp' 			=> $row_data_lama['nip'],
				'p_tmt_status'		=> '',
				'p_tmt_tmt'			=> $row_data_lama['tmt_capeg_pegttp'],
				'p_tmt_update_on'		=> $tanggal,
				'p_tmt_update_by'		=> 'admin'
			); 
			
			$this->kepegawaian->insert_data_pegawai_tmt($data_tmt);
			
			$data_unit = array(
				'nipp' 			=> $row_data_lama['nip'],
				'kode_unit'		=> $row_data_lama['kode_unit'],
				'tanggal'		=> $tanggal,
				'update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_unit($data_unit); */
			
		//} endforeach;
		$this->kepegawaian->delete_pegawai($nipp);
		echo 'sukses';
	}
	
	function outsource()
	{
		$data_lama = $this->kepegawaian->get_data_lama();
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		$num = 1;
		
		$outsource = $this->kepegawaian->get_data_outsource();
		foreach ($outsource as $row_data_lama) :
		{
			$data_pegawai = array(
				'peg_nipp' 			=> $row_data_lama['nip'],
				'peg_nama' 			=> $row_data_lama['nama'],
				'peg_tgl_lahir'		=> $row_data_lama['ttl'],
				'peg_jns_kelamin'	=> $row_data_lama['jns_kelamin'],
				'peg_update_on'		=> $tanggal,
				'peg_update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai($data_pegawai);
			
			$data_jabatan = array(
				'p_jbt_nipp' 			=> $row_data_lama['nip'],
				'p_jbt_jabatan' 		=> $row_data_lama['jabatan'],
				'p_jbt_update_on'		=> $tanggal,
				'p_jbt_update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_jabatan($data_jabatan);
			
			if ($row_data_lama['provider'] === '2')
			{
				$provider = 'PT. Purnawira Cipta Karsa';
			}else
			if ($row_data_lama['provider'] === '3')
			{
				$provider = 'PT. Bali Perkasa International';
			}else
			if ($row_data_lama['provider'] === '4')
			{
				$provider = 'KOSIGARDEN';
			}else
			if ($row_data_lama['provider'] === '5')
			{
				$provider = 'PT. Safari Dharma Sakti';
			}else
			if ($row_data_lama['provider'] === '6')
			{
				$provider = 'PT. Prima Mitra Piranti';
			}else
			if ($row_data_lama['provider'] === '9')
			{
				$provider = 'PT. Grha Humanindo Manajemen';
			}
			
			$data = array(
				'p_tmt_nipp' 		=> $row_data_lama['nip'],
				'p_tmt_status'		=> 'Outsource',
				'p_tmt_tmt'			=> $row_data_lama['tgl_kerja'],
				'p_tmt_provider'	=> $provider,
				'p_tmt_update_on'	=> $tanggal,
				'p_tmt_update_by'	=> 'admin'
			); 
			
			//$this->kepegawaian->insert_data_pegawai_tmt($data);
			
			$data_unit = array(
				'p_unt_nipp' 			=> $row_data_lama['nip'],
				'p_unt_kode_unit'		=> $row_data_lama['kode_unit'],
				'p_unt_update_on'		=> $tanggal,
				'p_unt_update_by'		=> 'admin'
			);
			
			$this->kepegawaian->insert_data_pegawai_unit($data_unit);
			
			echo $num++;
		} endforeach;
		
	}
	
	/*function pindah_stkp()
	{
		$datestring = "%Y-%m-%d" ;
		$time = time();
		$tanggal = mdate($datestring, $time);
		
		$stkp = $this->pindah->get_stkp();
		foreach ($stkp as $stk) :
		{
			$n_lembaga = strtolower($stk['stkp']);
			$n_lembaga = str_replace('_',' ', $n_lembaga);
			$data_stkp = array(
				'p_stkp_nipp'		=> $stk['nip'],
				'p_stkp_lembaga'	=> $stk['nama_kursus'],
				'p_stkp_nama_lembaga'		=> $n_lembaga,
				'p_stkp_no_license'		=> $stk['license_num'],
				'p_stkp_mulai'		=> $stk['tanggal'],
				'p_stkp_finish'		=> $stk['sampai'],
				'p_stkp_rating'		=> $stk['rating'],
				'p_stkp_update_on'		=> $tanggal,
				'p_stkp_update_by'		=> 'admin',
			);
			$this->pindah->pindah_stkp($data_stkp);
			print_r($data_stkp);
		} endforeach;
	} */
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */